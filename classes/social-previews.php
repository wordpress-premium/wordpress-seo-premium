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
}
