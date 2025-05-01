<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use Yoast\WP\SEO\Conditionals\Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Plugins_Page_Conditional;

/**
 * Update_Plugins_Integration class
 */
class Update_Plugins_Integration implements Integration_Interface {

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * In this case: when on the plugins page.
	 *
	 * @return array<Conditional>
	 */
	public static function get_conditionals() {
		return [
			Plugins_Page_Conditional::class,
		];
	}

	/**
	 * Registers hooks.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueues scripts.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		\wp_enqueue_script( 'wp-seo-premium-update-plugins' );
	}
}
