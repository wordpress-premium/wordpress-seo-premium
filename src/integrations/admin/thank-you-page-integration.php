<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Thank_You_Page_Integration class
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Thank_You_Page_Integration implements Integration_Interface {
	// phpcs:enable

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Thank_You_Page_Integration constructor.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		$this->options_helper = $options_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_filter( 'admin_menu', [ $this, 'add_submenu_page' ], 9 );
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		\add_action( 'admin_init', [ $this, 'maybe_redirect' ] );
	}

	/**
	 * Redirects to the installation success page if an installation has just occured.
	 *
	 * @return void
	 */
	public function maybe_redirect() {
		if ( ! $this->options_helper->get( 'should_redirect_after_install' ) ) {
			return;
		}
		$this->options_helper->set( 'should_redirect_after_install', false );

		if ( ! empty( $this->options_helper->get( 'activation_redirect_timestamp' ) ) ) {
			return;
		}
		$this->options_helper->set( 'activation_redirect_timestamp', time() );

		\wp_safe_redirect( \admin_url( 'admin.php?page=wpseo_installation_successful' ), 302, 'Yoast SEO Premium' );
		exit;
	}

	/**
	 * Adds the workouts submenu page.
	 *
	 * @param array $submenu_pages The Yoast SEO submenu pages.
	 *
	 * @return array the filtered submenu pages.
	 */
	public function add_submenu_page( $submenu_pages ) {
		\add_submenu_page(
			null,
			\__( 'Installation Successful', 'wordpress-seo-premium' ),
			null,
			'manage_options',
			'wpseo_installation_successful',
			[ $this, 'render_page' ]
		);

		return $submenu_pages;
	}

	/**
	 * Enqueue assets on the Thank you page.
	 */
	public function enqueue_assets() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Date is not processed or saved.
		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'wpseo_installation_successful' ) {
			return;
		}

		$asset_manager = new \WPSEO_Admin_Asset_Manager();
		$asset_manager->enqueue_style( 'monorepo' );
		\wp_enqueue_style( 'yoast-seo-premium-thank-you' );
	}

	/**
	 * Renders the thank you page.
	 */
	public function render_page() {
		require WPSEO_PREMIUM_PATH . 'classes/views/thank-you.php';
	}
}
