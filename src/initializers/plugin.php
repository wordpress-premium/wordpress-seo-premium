<?php

namespace Yoast\WP\SEO\Premium\Initializers;

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
		// This should happen in initializer as long as options are initialized on plugins loaded in Yoast SEO.
		\add_filter( 'wpseo_defaults', [ $this, 'add_option_defaults' ], 10, 2 );

		$wpseo_premium_capabilities = new WPSEO_Premium_Register_Capabilities();
		$wpseo_premium_capabilities->register_hooks();

		\register_deactivation_hook( \WPSEO_PREMIUM_FILE, [ $this, 'disable_tracking' ] );
	}

	/**
	 * The premium setup
	 */
	public function load() {
		new WPSEO_Premium();
	}

	/**
	 * Filters the defaults for the `wpseo` option.
	 *
	 * @param array  $wpseo_defaults The defaults for the option.
	 * @param string $option_name    The name of the option.
	 *
	 * @return array
	 */
	public function add_option_defaults( $wpseo_defaults, $option_name ) {
		if ( $option_name !== 'wpseo' || ! \is_array( $wpseo_defaults ) ) {
			return $wpseo_defaults;
		}

		$premium_defaults = [
			'enable_metabox_insights' => true,
			'enable_link_suggestions' => true,
		];

		return \array_merge( $wpseo_defaults, $premium_defaults );
	}

	/**
	 * Disables tracking.
	 *
	 * @return void
	 */
	public function disable_tracking() {
		$this->options_helper->set( 'tracking', false );
	}
}
