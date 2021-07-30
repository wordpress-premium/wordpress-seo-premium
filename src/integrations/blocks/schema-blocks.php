<?php

namespace Yoast\WP\SEO\Premium\Integrations\Blocks;

use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Conditionals\Schema_Blocks_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Loads the Premium schema block templates into Gutenberg.
 */
class Schema_Blocks implements Integration_Interface {

	/**
	 * Represents the asset manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	protected $asset_manager;

	/**
	 * Schema_Blocks constructor.
	 *
	 * @param WPSEO_Admin_Asset_Manager $asset_manager The asset manager.
	 */
	public function __construct( WPSEO_Admin_Asset_Manager $asset_manager ) {
		$this->asset_manager = $asset_manager;
	}

	/**
	 * Returns the list of conditionals.
	 *
	 * @return array The conditionals.
	 */
	public static function get_conditionals() {
		return [
			Schema_Blocks_Conditional::class,
		];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_load_schema_templates', [ $this, 'add_premium_templates' ] );
		\add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Collects the Premium structured data blocks templates.
	 *
	 * @param array $templates The templates from Yoast SEO.
	 *
	 * @return array All the templates that should be loaded.
	 */
	public function add_premium_templates( $templates ) {
		$premium_schema_templates_path = \WPSEO_PREMIUM_PATH . 'src/schema-templates/';

		$premium_templates = \glob( $premium_schema_templates_path . '*.php' );

		return \array_merge( $templates, $premium_templates );
	}

	/**
	 * Enqueues the schema blocks css file.
	 */
	public function enqueue_assets() {
		\wp_enqueue_script( 'wp-seo-premium-schema-blocks' );
		$this->asset_manager->enqueue_style( 'premium-schema-blocks' );
	}
}
