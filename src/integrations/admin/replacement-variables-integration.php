<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Admin_Asset_Manager;
use WPSEO_Metabox;
use WPSEO_Options;
use WPSEO_Post_Type;
use WPSEO_Taxonomy;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper;

/**
 * Replacement_Variables_Integration class
 */
class Replacement_Variables_Integration implements Integration_Interface {

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueue the replacement variables styles and component.
	 *
	 * @return void
	 */
	public function enqueue_assets() {

		/**
		 * Filter: 'wpseo_premium_load_emoji_picker' - Allow changing whether the emoji picker is loaded for the meta description and SEO title fields.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 19.0
		 *
		 * @param bool $load Whether to load the emoji picker.
		 */
		if ( ! \apply_filters( 'wpseo_premium_load_emoji_picker', true ) ) {
			return;
		}

		$is_elementor_action = false;
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['action'] ) && \is_string( $_GET['action'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are not processing form information, We are only strictly comparing.
			$is_elementor_action = ( \wp_unslash( $_GET['action'] ) === 'elementor' );
		}

		$is_settings_page = false;
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['page'] ) && \is_string( $_GET['page'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are not processing form information, We are only strictly comparing.
			$is_settings_page = ( \wp_unslash( $_GET['page'] ) === 'wpseo_page_settings' );
		}

		if ( ! $is_settings_page && ! $is_elementor_action && ! $this->load_metabox( $this->get_current_page() ) ) {
			return;
		}

		\wp_enqueue_script( 'yoast-seo-premium-draft-js-plugins' );

		\wp_enqueue_style( 'yoast-seo-premium-draft-js-plugins' );

		$draft_js_external_script_location = 'https://yoast.com/shared-assets/scripts/wp-seo-premium-draft-js-plugins-source-2.0.0.min.js';

		if ( \file_exists( \WPSEO_PREMIUM_PATH . 'assets/js/external/draft-js-emoji-picker.min.js' ) ) {
			$draft_js_external_script_location = \plugins_url( 'wordpress-seo-premium/assets/js/external/draft-js-emoji-picker.min.js' );
		}

		\wp_enqueue_script(
			'yoast-seo-premium-draft-js-plugins-external',
			$draft_js_external_script_location,
			[
				WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
			],
			\WPSEO_PREMIUM_VERSION,
			false
		);
	}

	/**
	 * Checks whether or not the metabox related scripts should be loaded.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param string $current_page The page we are on.
	 *
	 * @return bool True when it should be loaded.
	 */
	protected function load_metabox( $current_page ) {
		$page_helper = new Current_Page_Helper();
		// When the current page is a term related one.
		if ( WPSEO_Taxonomy::is_term_edit( $current_page ) || WPSEO_Taxonomy::is_term_overview( $current_page ) ) {
			return WPSEO_Options::get( 'display-metabox-tax-' . $page_helper->get_current_taxonomy() );
		}

		// When the current page isn't a post related one.
		if ( WPSEO_Metabox::is_post_edit( $current_page ) || WPSEO_Metabox::is_post_overview( $current_page ) ) {
			return WPSEO_Post_Type::has_metabox_enabled( $page_helper->get_current_post_type() );
		}

		// Make sure ajax integrations are loaded.
		return \wp_doing_ajax();
	}

	/**
	 * Retrieves the value of the pagenow variable.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string The value of pagenow.
	 */
	private function get_current_page() {
		global $pagenow;

		return $pagenow;
	}
}
