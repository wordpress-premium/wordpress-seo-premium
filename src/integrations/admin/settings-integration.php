<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Conditionals\Settings_Conditional;
use Yoast\WP\SEO\Helpers\Current_Page_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Class Settings_Integration.
 */
class Settings_Integration implements Integration_Interface {

	/**
	 * Holds the WPSEO_Admin_Asset_Manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	protected $asset_manager;

	/**
	 * Holds the Current_Page_Helper.
	 *
	 * @var Current_Page_Helper
	 */
	protected $current_page_helper;

	/**
	 * Constructs Settings_Integration.
	 *
	 * @param WPSEO_Admin_Asset_Manager $asset_manager       The WPSEO_Admin_Asset_Manager.
	 * @param Current_Page_Helper       $current_page_helper The Current_Page_Helper.
	 */
	public function __construct( WPSEO_Admin_Asset_Manager $asset_manager, Current_Page_Helper $current_page_helper ) {
		$this->asset_manager       = $asset_manager;
		$this->current_page_helper = $current_page_helper;
	}

	/**
	 * Returns the conditionals based on which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Settings_Conditional::class ];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		// Are we on the settings page?
		if ( $this->current_page_helper->get_current_yoast_seo_page() === 'wpseo_page_settings' ) {
			\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		}
	}

	/**
	 * Enqueues the assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		$this->asset_manager->enqueue_style( 'premium-settings' );
	}
}
