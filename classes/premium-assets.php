<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Loads the Premium assets.
 */
class WPSEO_Premium_Assets implements WPSEO_WordPress_Integration {

	/**
	 * Registers the hooks.
	 *
	 * @codeCoverageIgnore Method relies on a WordPress function.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'admin_init', [ $this, 'register_assets' ] );
	}

	/**
	 * Registers the assets for premium.
	 *
	 * @return void
	 */
	public function register_assets() {
		$version = $this->get_version();
		$scripts = $this->get_scripts( $version );
		$styles  = $this->get_styles( $version );

		array_walk( $scripts, [ $this, 'register_script' ] );
		array_walk( $styles, [ $this, 'register_style' ] );
	}

	/**
	 * Retrieves a flatten version.
	 *
	 * @codeCoverageIgnore Method uses a dependency.
	 *
	 * @return string The flatten version.
	 */
	protected function get_version() {
		$asset_manager = new WPSEO_Admin_Asset_Manager();

		return $asset_manager->flatten_version( WPSEO_PREMIUM_VERSION );
	}

	/**
	 * Retrieves an array of script to register.
	 *
	 * @codeCoverageIgnore Returns a simple dataset.
	 *
	 * @param string $version Current version number.
	 *
	 * @return array The scripts.
	 */
	protected function get_scripts( $version ) {
		return [
			[
				'name'         => 'yoast-seo-premium-commons',
				'path'         => 'assets/js/dist/',
				'filename'     => 'commons-premium-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [],
			],
			[
				'name'         => 'yoast-seo-premium-metabox',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-metabox-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'clipboard',
					'jquery',
					'underscore',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-element',
					'wp-i18n',
					'wp-util',
					'yoast-seo-premium-commons',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'help-scout-beacon',
					WPSEO_Admin_Asset_Manager::PREFIX . 'legacy-components',
					WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-forms',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-previews-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'yoast-seo-premium-workouts',
				'path'         => 'assets/js/dist/',
				'filename'     => 'workouts-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'clipboard',
					'lodash',
					'wp-api-fetch',
					'wp-a11y',
					'wp-components',
					'wp-compose',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-i18n',
					'yoast-seo-premium-commons',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'admin-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'react-select',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'yoast-seo-social-metadata-previews-package',
				'path'         => 'assets/js/dist/yoast/',
				'filename'     => 'social-metadata-previews-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'in_footer'    => true,
				'dependencies' => [
					'lodash',
					'wp-a11y',
					'wp-components',
					'wp-element',
					'wp-i18n',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'draft-js',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'helpers',
					WPSEO_Admin_Asset_Manager::PREFIX . 'replacement-variable-editor',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-forms',
					WPSEO_Admin_Asset_Manager::PREFIX . 'style-guide',
					WPSEO_Admin_Asset_Manager::PREFIX . 'styled-components',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'yoast-social-metadata-previews',
				'path'         => 'assets/js/dist/',
				'filename'     => 'yoast-premium-social-metadata-previews-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'in_footer'    => true,
				'dependencies' => [
					'wp-components',
					'wp-element',
					'wp-plugins',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-previews-package',
				],
			],
			[
				'name'         => 'wp-seo-premium-custom-fields-plugin',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-custom-fields-plugin-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'jquery',
					'yoast-seo-premium-commons',
				],
			],
			[
				'name'         => 'wp-seo-premium-quickedit-notification',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-quickedit-notification-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'jquery',
					'wp-api',
					'wp-api-fetch',
					'yoast-seo-premium-commons',
				],
			],
			[
				'name'         => 'wp-seo-premium-redirect-notifications',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-redirect-notifications-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'jquery',
					'wp-api',
					'wp-api-fetch',
					'yoast-seo-premium-commons',
				],
			],
			[
				'name'         => 'wp-seo-premium-redirect-notifications-gutenberg',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-redirect-notifications-gutenberg-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'wp-api-fetch',
					'wp-components',
					'wp-element',
					'wp-i18n',
					'wp-plugins',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'wp-seo-premium-dynamic-blocks',
				'path'         => 'assets/js/dist/',
				'filename'     => 'dynamic-blocks-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'lodash',
					'wp-blocks',
					'wp-data',
					'wp-dom-ready',
					'wp-hooks',
					'wp-server-side-render',
				],
			],
			[
				'name'         => 'wp-seo-premium-blocks',
				'path'         => 'assets/js/dist/',
				'filename'     => 'blocks-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'wp-block-editor',
					'wp-blocks',
					'wp-components',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-i18n',
					'yoast-seo-premium-metabox',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'legacy-components',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'yoast-premium-prominent-words-indexation',
				'path'         => 'assets/js/dist/',
				'filename'     => 'yoast-premium-prominent-words-indexation-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'yoast-seo-premium-commons',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'indexation',
				],
			],
			[
				'name'         => 'elementor-premium',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-elementor-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'clipboard',
					'jquery',
					'underscore',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-element',
					'wp-hooks',
					'wp-i18n',
					'wp-util',
					'yoast-seo-premium-commons',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'help-scout-beacon',
					WPSEO_Admin_Asset_Manager::PREFIX . 'legacy-components',
					WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-forms',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-previews-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
				'footer'       => true,
			],
			[
				'name'         => 'wp-seo-premium-schema-blocks',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-schema-blocks-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					WPSEO_Admin_Asset_Manager::PREFIX . 'schema-blocks-package',
				],
			],
		];
	}

	/**
	 * Retrieves an array of styles to register.
	 *
	 * @codeCoverageIgnore Returns a simple dataset.
	 *
	 * @param string $version Current version number.
	 *
	 * @return array The styles.
	 */
	protected function get_styles( $version ) {
		return [
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox',
				'source'       => 'assets/css/dist/premium-metabox-' . $version . '.css',
				'dependencies' => [],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-workouts',
				'source'       => 'assets/css/dist/premium-workouts-' . $version . '.css',
				'dependencies' => [
					'wp-components',
				],
			],
			[
				'name'         => 'elementor-premium',
				'source'       => 'assets/css/dist/premium-elementor-' . $version . '.css',
				'dependencies' => [
					WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox',
				],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-schema-blocks',
				'source'       => 'assets/css/dist/premium-schema-blocks-' . $version . '.css',
				'dependencies' => [
					WPSEO_Admin_Asset_Manager::PREFIX . 'schema-blocks',
				],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-thank-you',
				'source'       => 'assets/css/dist/premium-thank-you-' . $version . '.css',
				'dependencies' => [],
			],
		];
	}

	/**
	 * Registers the given script to WordPress.
	 *
	 * @codeCoverageIgnore Method calls a WordPress function.
	 *
	 * @param array $script The script to register.
	 *
	 * @return void
	 */
	protected function register_script( $script ) {
		$url = plugin_dir_url( WPSEO_PREMIUM_FILE ) . $script['path'] . $script['filename'];

		if ( defined( 'YOAST_SEO_PREMIUM_DEV_SERVER' ) && YOAST_SEO_PREMIUM_DEV_SERVER ) {
			$url = 'http://localhost:8081/' . $script['filename'];
		}

		$in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;

		wp_register_script(
			$script['name'],
			$url,
			$script['dependencies'],
			WPSEO_PREMIUM_VERSION,
			$in_footer
		);
	}

	/**
	 * Registers the given style to WordPress.
	 *
	 * @codeCoverageIgnore Method calls a WordPress function.
	 *
	 * @param array $style The style to register.
	 *
	 * @return void
	 */
	protected function register_style( $style ) {
		wp_register_style(
			$style['name'],
			plugin_dir_url( WPSEO_PREMIUM_FILE ) . $style['source'],
			$style['dependencies'],
			WPSEO_PREMIUM_VERSION
		);
	}
}
