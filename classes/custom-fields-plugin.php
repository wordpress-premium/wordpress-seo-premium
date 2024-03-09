<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Enqueues a JavaScript plugin for YoastSEO.js that adds custom fields to the content that were defined in the titles
 * and meta's section of the Yoast SEO settings when those fields are available.
 */
class WPSEO_Custom_Fields_Plugin implements WPSEO_WordPress_Integration {

	/**
	 * Initialize the AJAX hooks.
	 *
	 * @codeCoverageIgnore Method relies on dependencies.
	 *
	 * @return void
	 */
	public function register_hooks() {
		global $pagenow;

		if ( ! WPSEO_Metabox::is_post_edit( $pagenow ) && ! WPSEO_Metabox::is_post_overview( $pagenow ) ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
	}

	/**
	 * Enqueues all the needed JS scripts.
	 *
	 * @codeCoverageIgnore Method relies on WordPress functions.
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'wp-seo-premium-custom-fields-plugin' );
		wp_localize_script( 'wp-seo-premium-custom-fields-plugin', 'YoastCustomFieldsPluginL10', $this->localize_script() );
	}

	/**
	 * Loads the custom fields translations.
	 *
	 * @return array The fields to localize.
	 */
	public function localize_script() {
		return [
			'custom_field_names' => $this->get_custom_field_names(),
		];
	}

	/**
	 * Retrieve all custom field names set in SEO ->
	 *
	 * @return array The custom field names.
	 */
	protected function get_custom_field_names() {
		$custom_field_names = [];

		$post = $this->get_post();

		if ( ! is_object( $post ) ) {
			return $custom_field_names;
		}

		$options       = $this->get_titles_from_options();
		$target_option = 'page-analyse-extra-' . $post->post_type;

		if ( array_key_exists( $target_option, $options ) ) {
			$custom_field_names = explode( ',', $options[ $target_option ] );
		}

		return $custom_field_names;
	}

	/**
	 * Retrieves post data given a post ID or the global.
	 *
	 * @codeCoverageIgnore Method relies on dependencies.
	 *
	 * @return WP_Post|array|null Returns a post if found, otherwise returns an empty array.
	 */
	protected function get_post() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Reason: We are not controlling the request.
		if ( isset( $_GET['post'] ) && is_string( $_GET['post'] ) ) {
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are casting the unsafe value to an integer.
			$post_id = (int) wp_unslash( $_GET['post'] );
			if ( $post_id > 0 ) {
				return get_post( $post_id );
			}
		}
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		if ( isset( $GLOBALS['post'] ) ) {
			return $GLOBALS['post'];
		}

		return [];
	}

	/**
	 * Retrieves the value of the WPSEO_Titles option.
	 *
	 * @codeCoverageIgnore Method relies on the options.
	 *
	 * @return array The value from WPSEO_Titles option.
	 */
	protected function get_titles_from_options() {
		$option_name = WPSEO_Options::get_option_instance( 'wpseo_titles' )->option_name;

		return get_option( $option_name, [] );
	}
}
