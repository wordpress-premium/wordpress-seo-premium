<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use WPSEO_Upgrade_Manager;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Class Upgrade_Integration.
 */
class Upgrade_Integration implements Integration_Interface {

	/**
	 * Returns the conditionals based on which this loadable should be active.
	 *
	 * @return array The conditionals.
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'init', [ $this, 'run_upgrade' ], 11 );
	}

	/**
	 * Run the upgrade for Yoast SEO Premium.
	 */
	public function run_upgrade() {
		$upgrade_manager = new WPSEO_Upgrade_Manager();
		$upgrade_manager->run_upgrade( \WPSEO_PREMIUM_VERSION );
	}
}
