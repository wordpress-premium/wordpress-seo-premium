<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Capability_Helper;
use Yoast\WP\SEO\Helpers\Current_Page_Helper;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Helpers\Version_Helper;
use Yoast\WP\SEO\Presenters\Admin\Notice_Presenter;

/**
 * Integration to display a notification urging to update Premium when a new version is available.
 */
class Update_Premium_Notification implements Integration_Interface {

	/**
	 * The options' helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * The version helper.
	 *
	 * @var Version_Helper
	 */
	private $version_helper;

	/**
	 * The capability helper.
	 *
	 * @var Capability_Helper
	 */
	private $capability_helper;

	/**
	 * The admin asset manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	private $admin_asset_manager;

	/**
	 * The Current_Page_Helper.
	 *
	 * @var Current_Page_Helper
	 */
	private $current_page_helper;

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Update_Premium_Notification constructor.
	 *
	 * @param Options_Helper            $options_helper      The options helper.
	 * @param Version_Helper            $version_helper      The version helper.
	 * @param Capability_Helper         $capability_helper   The capability helper.
	 * @param WPSEO_Admin_Asset_Manager $admin_asset_manager The admin asset manager.
	 * @param Current_Page_Helper       $current_page_helper The Current_Page_Helper.
	 */
	public function __construct(
		Options_Helper $options_helper,
		Version_Helper $version_helper,
		Capability_Helper $capability_helper,
		WPSEO_Admin_Asset_Manager $admin_asset_manager,
		Current_Page_Helper $current_page_helper
	) {
		$this->options_helper      = $options_helper;
		$this->version_helper      = $version_helper;
		$this->capability_helper   = $capability_helper;
		$this->admin_asset_manager = $admin_asset_manager;
		$this->current_page_helper = $current_page_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_action( 'admin_notices', [ $this, 'maybe_display_notification' ] );
		\add_action( 'wp_ajax_dismiss_update_premium_notification', [ $this, 'dismiss_update_premium_notification' ] );
	}

	/**
	 * Shows a notice if Free is newer than the minimum required version and Premium has an update available.
	 *
	 * @return void
	 */
	public function maybe_display_notification() {
		if ( $this->current_page_helper->get_current_admin_page() === 'update.php' ) {
			return;
		}

		if ( $this->notice_was_dismissed_on_current_premium_version() ) {
			return;
		}

		if ( ! $this->capability_helper->current_user_can( 'wpseo_manage_options' ) ) {
			return;
		}

		// Check whether Free is set to a version later than the minimum required and a Premium update is a available.
		if ( $this->version_helper->is_free_upgraded() && $this->version_helper->is_premium_update_available() ) {
			$this->admin_asset_manager->enqueue_style( 'monorepo' );

			$is_plugins_page = $this->current_page_helper->get_current_admin_page() === 'plugins.php';
			$content         = \sprintf(
				/* translators: 1: Yoast SEO Premium, 2 and 3: opening and closing anchor tag. */
				\esc_html__( 'Please %2$supdate %1$s to the latest version%3$s to ensure you can fully use all Premium settings and features.', 'wordpress-seo-premium' ),
				'Yoast SEO Premium',
				( $is_plugins_page ) ? '' : '<a href="' . \esc_url( \self_admin_url( 'plugins.php' ) ) . '">',
				( $is_plugins_page ) ? '' : '</a>'
			);
			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- Output of the title escaped in the Notice_Presenter.
			echo new Notice_Presenter(
				/* translators: 1: Yoast SEO Premium */
				\sprintf( \__( 'Update to the latest version of %1$s!', 'wordpress-seo-premium' ), 'Yoast SEO Premium' ),
				$content,
				null,
				null,
				true,
				'yoast-update-premium-notification'
			);
			// phpcs:enable

			// Enable permanently dismissing the notice.
			echo "<script>
                function dismiss_update_premium_notification(){
                    var data = {
                    'action': 'dismiss_update_premium_notification',
                    };

                    jQuery.post( ajaxurl, data, function( response ) {
                        jQuery( '#yoast-update-premium-notification' ).hide();
                    });
                }

                jQuery( document ).ready( function() {
                    jQuery( 'body' ).on( 'click', '#yoast-update-premium-notification .notice-dismiss', function() {
                        dismiss_update_premium_notification();
                    } );
                } );
            </script>";
		}
	}

	/**
	 * Dismisses the old premium notice.
	 *
	 * @return bool
	 */
	public function dismiss_update_premium_notification() {
		return $this->options_helper->set( 'dismiss_update_premium_notification', \WPSEO_PREMIUM_VERSION );
	}

	/**
	 * Returns whether the notification was dismissed in the current Premium version.
	 *
	 * @return bool Whether the notification was dismissed in the current Premium version.
	 */
	protected function notice_was_dismissed_on_current_premium_version() {
		$dismissed_notification_version = $this->options_helper->get( 'dismiss_update_premium_notification', '' );
		if ( ! empty( $dismissed_notification_version ) ) {
			return \version_compare( $dismissed_notification_version, \WPSEO_PREMIUM_VERSION, '>=' );
		}

		return false;
	}
}
