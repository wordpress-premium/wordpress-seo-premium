<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use WPSEO_Utils;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Importer class.
 */
class Importer implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Flag to determine if we need to do processing on import.
	 *
	 * @var bool
	 */
	private $do_processing;

	/**
	 * The current post ID being processed.
	 *
	 * @var int
	 */
	private $current_post_id;

	/**
	 * Media manager instance.
	 *
	 * @var Media_Manager
	 */
	private $media_manager;

	/**
	 * Gutenberg converter instance.
	 *
	 * @var Gutenberg_Converter
	 */
	private $gutenberg_converter;

	/**
	 * Footnote processor instance.
	 *
	 * @var Footnote_Processor
	 */
	private $footnote_processor;

	/**
	 * Construct the class.
	 *
	 * @param Media_Manager       $media_manager       The media manager instance.
	 * @param Gutenberg_Converter $gutenberg_converter The gutenberg converter instance.
	 * @param Footnote_Processor  $footnote_processor  The footnote processor instance.
	 */
	public function __construct(
		Media_Manager $media_manager,
		Gutenberg_Converter $gutenberg_converter,
		Footnote_Processor $footnote_processor
	) {
		$this->media_manager       = $media_manager;
		$this->gutenberg_converter = $gutenberg_converter;
		$this->footnote_processor  = $footnote_processor;
		$this->do_processing       = false;
		$this->current_post_id     = 0;
	}

	/**
	 * Registers WordPress hooks for the importer.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		/**
		 * Filter to check for raw data and check if export is from doc extension.
		 */
		\add_filter( 'wp_import_post_data_raw', [ $this, 'determine_processing' ] );

		/**
		 * Filter to actually format the content we get from Google Doc extension export.
		 */
		\add_filter( 'wp_import_post_data_processed', [ $this, 'execute_processing' ] );

		/**
		 * Action that fires after a post is inserted during import. Used to save footnotes as post meta.
		 */
		\add_action( 'wp_import_insert_post', [ $this, 'save_footnotes' ], 10, 2 );
	}

	/**
	 * Determines if the current import post should be processed as a documentation source.
	 *
	 * @param array<array{postmeta: array{key: string, value: string}}> $post_data The raw post data from the import.
	 *
	 * @return array<array{postmeta: array{key: string, value: string}}> The modified post data.
	 */
	public function determine_processing( $post_data ) {
		// Ensure the postmeta is available and has a key.
		if ( empty( $post_data['postmeta'] ) || ! isset( $post_data['postmeta'][0]['key'] ) ) {
			return $post_data;
		}

		// Check if the export is a documentation source.
		if ( $post_data['postmeta'][0]['key'] === 'yoast_is_docs_source' && $post_data['postmeta'][0]['value'] === 'true' ) {
			$this->do_processing = true;
			// Remove the first meta as not required.
			\array_shift( $post_data['postmeta'] );
		}

		return $post_data;
	}

	/**
	 * Processes content for documentation source posts.
	 *
	 * @param array<array{post_content: string}> $post_data The processed post data.
	 *
	 * @return array<array{post_content: string}> The post data with processed content.
	 */
	public function execute_processing( $post_data ) {

		// Bail early, if export is not from Google Doc extension.
		if ( ! $this->do_processing ) {
			return $post_data;
		}

		// Get the conent.
		$content = $post_data['post_content'];

		// Perform media processing and URL replacement.
		$content = $this->media_manager->process_post_data( $content );

		// Convert content and extract footnotes.
		$content = $this->gutenberg_converter->convert( $content );

		// Keep track of the post ID if it exists.
		$this->current_post_id = ! empty( $post_data['import_id'] ) ? $post_data['import_id'] : 0;

		// Replace the post content with new content.
		$post_data['post_content'] = $content;

		return $post_data;
	}

	/**
	 * Saves footnotes as post meta after a post is inserted.
	 *
	 * @param int $post_id          The post ID.
	 * @param int $original_post_id The original post ID from the import.
	 *
	 * @return void
	 */
	public function save_footnotes( $post_id, $original_post_id ): void {
		// Early bail if we don't need to process.
		if ( ! $this->do_processing ) {
			return;
		}

		// Only process if we have footnotes and the current post ID matches the original post ID.
		if ( ! empty( $this->footnote_processor->footnotes ) && $this->current_post_id === $original_post_id ) {
			// Format footnotes for WordPress meta storage (using UUIDs).
			$formatted_footnotes = [];

			foreach ( $this->footnote_processor->footnotes as $footnote ) {
				// Ensure we're using the UUID as the ID (already set in the converter).
				$formatted_footnotes[] = [
					'content' => $footnote['content'],
					'id'      => $footnote['id'], // This is already the UUID.
				];
			}

			// Save footnotes as post meta.
			if ( ! empty( $formatted_footnotes ) ) {
				\update_post_meta( $post_id, 'footnotes', WPSEO_Utils::format_json_encode( $formatted_footnotes ) );
			}
		}

		// Reset the footnote processor.
		$this->footnote_processor->reset();

		// Reset the processing flag for each item in the import.
		$this->do_processing = false;

		// Reset current post ID after saving.
		$this->current_post_id = 0;
	}
}
