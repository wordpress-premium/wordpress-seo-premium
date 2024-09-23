<?php // phpcs:ignore Yoast.Files.FileName.InvalidClassFileName -- Reason: this is an old premium file.
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
		add_action( 'init', [ $this, 'register_frontend_assets' ], 11 );
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
	 * Registers the assets for premium.
	 *
	 * @return void
	 */
	public function register_frontend_assets() {
		$version = $this->get_version();
		$scripts = $this->get_frontend_scripts( $version );

		array_walk( $scripts, [ $this, 'register_script' ] );
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
	 * @return array<array<string|array>> The scripts.
	 */
	protected function get_frontend_scripts( $version ) {
		return [
			[
				'name'         => 'yoast-seo-premium-frontend-inspector',
				'path'         => 'assets/js/dist/',
				'filename'     => 'frontend-inspector-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'lodash',
					'react',
					'react-dom',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-i18n',
					WPSEO_Admin_Asset_Manager::PREFIX . 'frontend-inspector-resources',
					WPSEO_Admin_Asset_Manager::PREFIX . 'prop-types-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'style-guide',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
				'in_footer'    => true,
			],
		];
	}

	/**
	 * Retrieves an array of script to register.
	 *
	 * @codeCoverageIgnore Returns a simple dataset.
	 *
	 * @param string $version Current version number.
	 *
	 * @return array<array<string|array>> The scripts.
	 */
	protected function get_scripts( $version ) {
		return [
			[
				'name'         => 'yoast-seo-premium-metabox',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-metabox-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'clipboard',
					'jquery',
					'regenerator-runtime',
					'underscore',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-element',
					'wp-i18n',
					'wp-util',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'help-scout-beacon',
					WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-forms',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-previews-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'yoast-seo-premium-draft-js-plugins',
				'path'         => 'assets/js/dist/',
				'filename'     => 'wp-seo-premium-draft-js-plugins-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'in_footer'    => true,
				'dependencies' => [
					WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
				],
			],
			[
				'name'         => 'yoast-seo-premium-workouts',
				'path'         => 'assets/js/dist/',
				'filename'     => 'workouts-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'clipboard',
					'lodash',
					'regenerator-runtime',
					'wp-api-fetch',
					'wp-a11y',
					'wp-components',
					'wp-compose',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-i18n',
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
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
			],
			[
				'name'         => 'yoast-premium-prominent-words-indexation',
				'path'         => 'assets/js/dist/',
				'filename'     => 'yoast-premium-prominent-words-indexation-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'regenerator-runtime',
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
					'regenerator-runtime',
					'underscore',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-element',
					'wp-hooks',
					'wp-i18n',
					'wp-util',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'help-scout-beacon',
					WPSEO_Admin_Asset_Manager::PREFIX . 'search-metadata-previews',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-forms',
					WPSEO_Admin_Asset_Manager::PREFIX . 'social-metadata-previews-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'yoast-components',
				],
				'footer'       => true,
			],
			[
				'name'         => 'wp-seo-premium-ai-generator',
				'path'         => 'assets/js/dist/',
				'filename'     => 'ai-generator-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'lodash',
					'regenerator-runtime',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-hooks',
					'wp-i18n',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'ui-library-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'react-helmet-package',
				],
			],
			[
				'name'         => 'wp-seo-premium-ai-fix-assessments',
				'path'         => 'assets/js/dist/',
				'filename'     => 'ai-fix-assessments-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'lodash',
					'regenerator-runtime',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-hooks',
					'wp-i18n',
					WPSEO_Admin_Asset_Manager::PREFIX . 'analysis',
					WPSEO_Admin_Asset_Manager::PREFIX . 'editor-modules',
					WPSEO_Admin_Asset_Manager::PREFIX . 'ui-library-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'react-helmet-package',
				],
			],
			[
				'name'         => 'wp-seo-premium-manage-ai-consent-button',
				'path'         => 'assets/js/dist/',
				'filename'     => 'manage-ai-consent-button-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'lodash',
					'regenerator-runtime',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-hooks',
					'wp-i18n',
					WPSEO_Admin_Asset_Manager::PREFIX . 'ui-library-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'react-helmet-package',
				],
			],
			[
				'name'         => 'wp-seo-premium-introductions',
				'path'         => 'assets/js/dist/',
				'filename'     => 'introductions-' . $version . WPSEO_CSSJS_SUFFIX . '.js',
				'dependencies' => [
					'lodash',
					'regenerator-runtime',
					'wp-api-fetch',
					'wp-components',
					'wp-data',
					'wp-dom-ready',
					'wp-element',
					'wp-hooks',
					'wp-i18n',
					WPSEO_Admin_Asset_Manager::PREFIX . 'introductions',
					WPSEO_Admin_Asset_Manager::PREFIX . 'ui-library-package',
					WPSEO_Admin_Asset_Manager::PREFIX . 'react-helmet-package',
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
	 * @return array<array<string|array>> The styles.
	 */
	protected function get_styles( $version ) {
		$rtl_suffix = ( is_rtl() ) ? '-rtl' : '';

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
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-draft-js-plugins',
				'source'       => 'assets/css/dist/premium-draft-js-plugins-' . $version . '.css',
				'dependencies' => [],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-thank-you',
				'source'       => 'assets/css/dist/premium-thank-you-' . $version . '.css',
				'dependencies' => [],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-settings',
				'source'       => 'assets/css/dist/premium-settings-' . $version . '.css',
				'dependencies' => [],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-post-overview',
				'source'       => 'assets/css/dist/premium-post-overview-' . $version . '.css',
				'dependencies' => [],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-tailwind',
				'source'       => 'assets/css/dist/premium-tailwind-' . $version . $rtl_suffix . '.css',
				'dependencies' => [],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-ai-generator',
				'source'       => 'assets/css/dist/premium-ai-generator-' . $version . $rtl_suffix . '.css',
				'dependencies' => [
					WPSEO_Admin_Asset_Manager::PREFIX . 'premium-tailwind',
					WPSEO_Admin_Asset_Manager::PREFIX . 'monorepo',
				],
			],
			[
				'name'         => WPSEO_Admin_Asset_Manager::PREFIX . 'premium-ai-fix-assessments',
				'source'       => 'assets/css/dist/premium-ai-fix-assessments-' . $version . $rtl_suffix . '.css',
				'dependencies' => [
					WPSEO_Admin_Asset_Manager::PREFIX . 'premium-tailwind',
					WPSEO_Admin_Asset_Manager::PREFIX . 'monorepo',
				],
			],
		];
	}

	/**
	 * Registers the given script to WordPress.
	 *
	 * @codeCoverageIgnore Method calls a WordPress function.
	 *
	 * @param array<string|array> $script The script to register.
	 *
	 * @return void
	 */
	protected function register_script( $script ) {
		$url = plugin_dir_url( WPSEO_PREMIUM_FILE ) . $script['path'] . $script['filename'];

		if ( defined( 'YOAST_SEO_PREMIUM_DEV_SERVER' ) && YOAST_SEO_PREMIUM_DEV_SERVER ) {
			$url = 'http://localhost:8081/' . $script['filename'];
		}

		$in_footer = ( $script['in_footer'] ?? false );

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
	 * @param array<string|array> $style The style to register.
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
