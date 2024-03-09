<?php

namespace Yoast\WP\SEO\Premium\Integrations\Blocks;

use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Loads the Premium schema block templates into Gutenberg.
 *
 * @deprecated 20.5
 * @codeCoverageIgnore
 */
class Schema_Blocks implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Schema_Blocks constructor.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @param WPSEO_Admin_Asset_Manager $asset_manager The asset manager.
	 */
	public function __construct( WPSEO_Admin_Asset_Manager $asset_manager ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
	}

	/**
	 * Collects the Premium structured data blocks templates.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @param array $templates The templates from Yoast SEO.
	 *
	 * @return array All the templates that should be loaded.
	 */
	public function add_premium_templates( $templates ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );

		return [];
	}

	/**
	 * Enqueues the schema blocks css file.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
	}
}
