<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Initializer for the social previews.
 */
class WPSEO_Social_Previews implements WPSEO_WordPress_Integration {

	/**
	 * Registers the hooks.
	 *
	 * @codeCoverageIgnore Method uses dependencies.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueues the javascript and css files needed for the social previews.
	 *
	 * @codeCoverageIgnore Method uses dependencies.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		wp_enqueue_script( 'yoast-social-metadata-previews' );
	}

	/* ********************* DEPRECATED FUNCTIONS ********************* */

	/**
	 * Retrieves image data from an image URL.
	 *
	 * @deprecated 14.4
	 *
	 * @codeCoverageIgnore
	 */
	public function ajax_retrieve_image_data_from_url() {
		_deprecated_function( __METHOD__, '14.5' );
	}

	/**
	 * Determines an attachment ID from a URL which might be an attachment URL.
	 *
	 * @deprecated 14.4
	 *
	 * @codeCoverageIgnore
	 *
	 * @link https://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
	 *
	 * @param string $url The URL to retrieve the attachment ID for.
	 *
	 * @return bool|int The attachment ID or false.
	 */
	public function retrieve_image_id_from_url( $url ) {
		_deprecated_function( __METHOD__, '14.5' );
		return false;
	}
}
