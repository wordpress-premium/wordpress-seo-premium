<?php

namespace Yoast\WP\SEO\Premium\Initializers;

use WPSEO_Capability_Manager_Factory;
use WPSEO_Premium;
use WPSEO_Premium_Register_Capabilities;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Initializers\Initializer_Interface;

/**
 * Class Plugin.
 */
class Plugin implements Initializer_Interface {

	use No_Conditionals;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

	/**
	 * Plugin constructor.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		$this->options_helper = $options_helper;
	}

	/**
	 * Loads the redirect handler.
	 *
	 * @return void
	 */
	public function initialize() {
		\add_action( 'plugins_loaded', [ $this, 'load' ], 15 );

		$wpseo_premium_capabilities = new WPSEO_Premium_Register_Capabilities();
		$wpseo_premium_capabilities->register_hooks();

		\register_deactivation_hook( \WPSEO_PREMIUM_FILE, [ $this, 'wpseo_premium_deactivate' ] );
	}

	/**
	 * The premium setup
	 */
	public function load() {
		new WPSEO_Premium();
	}

	/**
	 * Cleans up Premium on deactivation.
	 *
	 * @return void
	 */
	public function wpseo_premium_deactivate() {
		\do_action( 'wpseo_register_capabilities_premium' );
		WPSEO_Capability_Manager_Factory::get( 'premium' )->remove();

		$this->options_helper->set( 'tracking', false );
	}
}
