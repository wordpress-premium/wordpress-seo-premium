<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use WPSEO_Upgrade_Manager;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Class Upgrade_Integration.
 */
class Upgrade_Integration implements Integration_Interface {

	use No_Conditionals;

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
