<?php

namespace Yoast\WP\SEO\Premium\Integrations\Watchers;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Watcher for the wpseo option on Premium.
 *
 * Represents the option wpseo watcher for Premium.
 */
class Premium_Option_Wpseo_Watcher implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options;

	/**
	 * Watcher constructor.
	 *
	 * @param Options_Helper $options The options helper.
	 */
	public function __construct( Options_Helper $options ) {
		$this->options = $options;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'update_option_wpseo', [ $this, 'check_zapier_option_disabled' ], 10, 2 );
	}

	/**
	 * Checks if the Zapier integration is disabled; if so, deletes the data.
	 *
	 * @param array $old_value The old value of the option.
	 * @param array $new_value The new value of the option.
	 *
	 * @return bool Whether the Zapier data has been deleted or not.
	 */
	public function check_zapier_option_disabled( $old_value, $new_value ) {
		if ( \array_key_exists( 'zapier_integration_active', $new_value )
			&& $old_value['zapier_integration_active'] === true
			&& $new_value['zapier_integration_active'] === false ) {
			$this->options->set( 'zapier_subscription', [] );
			$this->options->set( 'zapier_api_key', '' );
			return true;
		}
		return false;
	}
}
