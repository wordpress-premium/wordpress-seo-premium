<?php

namespace Yoast\WP\SEO\Integrations\Watchers;

use Yoast\WP\SEO\Conditionals\Zapier_Enabled_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Watcher for resetting the Zapier API key.
 *
 * Represents the Zapier API key reset watcher for Premium.
 */
class Zapier_APIKey_Reset_Watcher implements Integration_Interface {

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
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Zapier_Enabled_Conditional::class ];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'admin_init', [ $this, 'zapier_api_key_reset' ], 10 );
	}

	/**
	 * Checks if the Zapier API key must be reset; if so, deletes the data.
	 *
	 * @return bool Whether the Zapier data has been deleted or not.
	 */
	public function zapier_api_key_reset() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- The nonce is already validated.
		if ( isset( $_POST['zapier_api_key_reset'] ) && $_POST['zapier_api_key_reset'] === '1' ) {
			$this->options->set( 'zapier_api_key', '' );
			$this->options->set( 'zapier_subscription', [] );

			return true;
		}

		return false;
	}
}
