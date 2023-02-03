<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper;

/**
 * Integrations_Page class
 */
class Integrations_Page implements Integration_Interface {

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * The Zapier helper.
	 *
	 * @var Zapier_Helper
	 */
	private $zapier_helper;

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Workouts_Integration constructor.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 * @param Zapier_Helper  $zapier_helper  The Zapier helper.
	 */
	public function __construct( Options_Helper $options_helper, Zapier_Helper $zapier_helper ) {
		$this->options_helper = $options_helper;
		$this->zapier_helper  = $zapier_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ], 120 );
	}

	/**
	 * Enqueue the workouts app.
	 */
	public function enqueue_assets() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Date is not processed or saved.
		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'wpseo_integrations' ) {
			return;
		}

		\wp_enqueue_script( 'yoast-seo-premium-integrations-page' );

		$localization_data = \apply_filters( 'wpseo_premium_integrations_page_data', [] );

		\wp_localize_script(
			'yoast-seo-premium-integrations-page',
			'wpseoPremiumIntegrationsData',
			$localization_data
		);
	}
}
