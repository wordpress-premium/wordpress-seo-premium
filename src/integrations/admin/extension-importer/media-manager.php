<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use Exception;
use finfo;
use WP_Error;
use WP_HTML_Tag_Processor;

/**
 * Media_Manager class.
 */
class Media_Manager {

	/**
	 * The filename identifier give to the media files imported from the Google Doc extension.
	 *
	 * @var string
	 */
	private const FILENAME_IDENTIFIER = 'yoast_doc_extension_';

	/**
	 * Process post content to handle external images.
	 *
	 * @param string $content The post content.
	 *
	 * @return string The processed content.
	 */
	public function process_post_data( string $content ): string {
		// Process inserted images, linked and unlinked drawings, graphs and cover images that are not base64 encoded.
		$content = $this->process_images(
			$content,
			'/<img[^>]*src="(https:\/\/[a-zA-Z0-9-]+\.googleusercontent\.com\/docsz[^"]*)"[^>]*>/',
			[ $this, 'get_google_docs_filename' ],
			false
		);

		// Process base64 encoded Drawing and Equation images.
		$content = $this->process_images(
			$content,
			'/<img[^>]*src="(data:image\/[^;]+;base64,[^"]+)"[^>]*>/',
			null,
			true
		);

		return $content;
	}

	/**
	 * Generic method to process images based on a pattern.
	 *
	 * @param string        $content           The content to process.
	 * @param string        $pattern           The regex pattern to match image tags.
	 * @param callable|null $filename_callback Optional callback to determine filename.
	 * @param bool          $is_base64_image   Whether the image is base64 encoded.
	 *
	 * @return string The processed content.
	 */
	private function process_images(
		string $content,
		string $pattern,
		?callable $filename_callback,
		bool $is_base64_image = false
	): string {
		// Early bailout if content or pattern is empty.
		if ( $content === '' || $pattern === '' ) {
			return $content;
		}

		// Extract all image URLs that match the regex pattern from the content.
		\preg_match_all( $pattern, $content, $matches );

		// Early bailout if no matches are found.
		if ( empty( $matches[1] ) ) {
			return $content;
		}

		foreach ( $matches[1] as $index => $image_url ) {
			if ( $is_base64_image ) {
				// Convert the base64 encoded image to a temporary file.
				$file_array = $this->convert_base64_to_file( $image_url );
			}
			else {
				// Decode the image URL to make sure it's not encoded.
				$image_url = \html_entity_decode( $image_url );
				// Sanitize the image URL.
				$image_url = \sanitize_url( $image_url );
				// Download the image from the URL.
				$file_array = $this->download_image( $image_url, $filename_callback );
			}

			// original image tag.
			$original_img_tag = $matches[0][ $index ];

			// Process the file array.
			$content = $this->process_file_array( $file_array, $original_img_tag, $content );
		}

		return $content;
	}

	/**
	 * Convert base64 encoded image to file.
	 *
	 * @param string $base64_string The base64 encoded image string.
	 *
	 * @return array<array{name: string, tmp_name: string}> File array on success or false on failure.
	 */
	private function convert_base64_to_file( string $base64_string ): array {
		if ( $base64_string === '' ) {
			return [];
		}

		// Split the base64 string into the image type data.
		$image_data = \explode( ',', $base64_string );
		// Extract the image type. Can be sure about direct array access because we extract the exact base64 strings.
		$image_type = \str_replace( 'data:image/', '', \explode( ';', $image_data[0] )[0] );
		// Decode the image data strictly. Ignoring the warning because we know the data is base64 encoded. Sanitization is being performed later.
		$image_data = \base64_decode( $image_data[1], true ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode

		// When base64 decoding fails, bail early.
		if ( $image_data === false ) {
			return [];
		}

		if ( \class_exists( 'finfo' ) ) {
			try {
				// Validate image MIME type using Fileinfo.
				$finfo     = new finfo( \FILEINFO_MIME_TYPE );
				$mime_type = $finfo->buffer( $image_data );

				// Allowed safe image MIME types.
				$allowed_mime_types = [
					'image/jpeg',
					'image/png',
					'image/gif',
					'image/webp',
				];

				// If the MIME type is not an image, bail early.
				if ( ! \in_array( $mime_type, $allowed_mime_types, true ) ) {
					return [];
				}
			}
			catch ( Exception $e ) {
				return [];
			}
		}
		else {
			return [];
		}

		// Create temporary file.
		$temp_file = \wp_tempnam();

		// Write the image data to the temporary file. Ignoring the warning since this function has been used in the past.
		if ( \file_put_contents( $temp_file, $image_data ) === false ) { // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
			\wp_delete_file( $temp_file );
			return [];
		}

		// Hardcode the filename to keep naming consistent.
		$filename = self::FILENAME_IDENTIFIER . \uniqid() . '.' . $image_type;

		$file_array = [
			'name'     => $filename,
			'tmp_name' => $temp_file,
		];

		return $file_array;
	}

	/**
	 * Download an image from a URL.
	 *
	 * @param string        $image_url         The URL of the image.
	 * @param callable|null $filename_callback Optional callback to determine filename.
	 *
	 * @return array<array{name: string, tmp_name: string}> File array on success or false on failure.
	 */
	private function download_image( string $image_url, ?callable $filename_callback ): array {
		if ( $image_url === '' ) {
			return [];
		}

		// Download the image from the URL as a temporary file.
		$tmp = \download_url( $image_url );

		// If the image download fails, return an empty array.
		if ( \is_wp_error( $tmp ) ) {
			return [];
		}

		$filename = '';

		// Use the provided callback to get filename if specified.
		if ( \is_callable( $filename_callback, true ) ) {
			$filename = \call_user_func( $filename_callback, $image_url );
		}

		// If case no filename is set, use a fallback.
		if ( $filename === '' ) {
			$filename = self::FILENAME_IDENTIFIER . \uniqid() . '.jpg';
		}

		$file_array = [
			'name'     => $filename,
			'tmp_name' => $tmp,
		];

		return $file_array;
	}

	/**
	 * Handle extracting alt text and importing the image to the media library.
	 *
	 * @param array<array{name: string, tmp_name: string}> $file_array       The file array.
	 * @param string                                       $original_img_tag The original image tag.
	 * @param string                                       $content          The content.
	 *
	 * @return string Modified content string with the new image URL.
	 */
	private function process_file_array( array $file_array, string $original_img_tag, string $content ): string {
		if ( empty( $file_array ) || $original_img_tag === '' ) {
			return $content;
		}

		$alt = $this->get_alternative_text( $original_img_tag );

		$post_array = [
			'post_title' => $file_array['name'],
			'meta_input' => [
				'_wp_attachment_image_alt' => $alt,
			],
		];

		// Upload the image to the media library and get the attachment ID.
		$attachment_id = $this->import_to_media_library( $file_array, $post_array );

		if ( \is_wp_error( $attachment_id ) ) {
			\wp_delete_file( $file_array['tmp_name'] );
			return $content;
		}

		return $this->replace_image_url( $content, $original_img_tag, $attachment_id );
	}

	/**
	 * Import a file to the WordPress media library.
	 *
	 * @param array<array{name: string, tmp_name: string}>                                          $file_array File array with 'name' and 'tmp_name'.
	 * @param array<array{post_title: string, meta_input: array{_wp_attachment_image_alt: string}}> $post_array Array with 'post_title' and 'meta_input'.
	 *
	 * @return string|WP_Error The attachment ID on success, WP_Error on failure.
	 */
	private function import_to_media_library( array $file_array, array $post_array ) {
		if ( empty( $file_array ) ) {
			return new WP_Error( 'empty_file_array', 'No file array provided.' );
		}

		$attachment_id = \media_handle_sideload( $file_array, 0, null, $post_array );

		return $attachment_id;
	}

	/**
	 * Replace an image tag in content with the newly imported image.
	 *
	 * @param string $content          The content.
	 * @param string $original_img_tag The original img tag.
	 * @param int    $attachment_id    The attachment ID.
	 *
	 * @return string The updated content.
	 */
	private function replace_image_url( string $content, string $original_img_tag, int $attachment_id ): string {
		// Early bailout if content or original image tag is empty or attachment ID is 0.
		if (
			$content === ''
			|| $original_img_tag === ''
			|| $attachment_id === 0
		) {
			return $content;
		}

		$new_image_url = \wp_get_attachment_url( $attachment_id );

		// If the new image URL is not found, return the original content.
		if ( ! $new_image_url || $new_image_url === '' ) {
			return $content;
		}

		// Replace just the src attribute in the original img tag.
		$new_img_tag = \preg_replace(
			'/src="[^"]*"/',
			'src="' . \esc_url( $new_image_url ) . '"',
			$original_img_tag
		);

		// Replace the original img tag with the updated one.
		return \str_replace( $original_img_tag, $new_img_tag, $content );
	}

	/**
	 * Get filename from HTTP headers.
	 *
	 * @param string $url The URL to get headers from.
	 *
	 * @return string The filename or null if not found.
	 */
	private function get_filename_from_headers( string $url ): string {
		if ( $url === '' ) {
			return $url;
		}

		$response = \wp_safe_remote_get( $url, [ 'redirection' => 0 ] );

		if ( \is_wp_error( $response ) ) {
			return '';
		}

		// Get the Content-Disposition header which contains the filename with its extension.
		$headers             = \wp_remote_retrieve_headers( $response );
		$content_disposition = ( $headers['content-disposition'] ?? '' );

		// Extract filename from Content-Disposition used for file extension.
		if ( \preg_match( '/filename="([^"]+)"/', $content_disposition, $matches_filename ) ) {
			return $matches_filename[1];
		}

		return '';
	}

	/**
	 * Get the filename for Google Docs images.
	 *
	 * @param string $url The image URL.
	 *
	 * @return string The filename.
	 */
	private function get_google_docs_filename( string $url ): string {
		if ( $url === '' ) {
			return $url;
		}

		// Get the filename from the headers.
		$filename = $this->get_filename_from_headers( $url );
		// Generate a unique filename.
		$filename_start = self::FILENAME_IDENTIFIER . \uniqid();

		if ( $filename === '' ) {
			// Fallback filename is set to png if no filename is found.
			$filename = $filename_start . '.png';
		}
		else {
			// Process the filename to get the file's extension.
			$file_info = \wp_check_filetype( \basename( $filename ) );

			// Fallback extension is set to png if no extension is found.
			$filename = $filename_start . '.' . ( $file_info['ext'] ?? 'png' );
		}

		return $filename;
	}

	/**
	 * Get the alternative text for the image.
	 *
	 * @param string $image_tag The image tag.
	 *
	 * @return string
	 */
	private function get_alternative_text( string $image_tag ): string {
		if ( $image_tag === '' ) {
			return '';
		}

		// Process the image tag.
		$img_html = new WP_HTML_Tag_Processor( $image_tag );
		$alt      = '';

		// Extract the alt attribute from the image tag.
		if ( \method_exists( $img_html, 'next_tag' ) && $img_html->next_tag( 'img' ) ) {
			$alt = ( $img_html->get_attribute( 'alt' ) ?? '' );
		}

		return $alt;
	}
}
