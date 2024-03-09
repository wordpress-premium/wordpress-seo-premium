<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Admin_Asset_Manager;
use WPSEO_Options;
use WPSEO_Shortlinker;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Capability_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional;
use Yoast\WP\SEO\Presenters\Admin\Notice_Presenter;

/**
 * Shows a notification telling the user that zapier integration will be removed.
 *
 * @deprecated 20.7
 * @codeCoverageIgnore
 */
class Zapier_Notification_Integration implements Integration_Interface {

	/**
	 * Holds the name of the user meta key.
	 *
	 * The value of this database field holds whether the user has dismissed this notice or not.
	 *
	 * @var string
	 */
	public const USER_META_DISMISSED = 'is_dismissed_zapier_notice';

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
	 * The admin asset manager.
	 *
	 * @var Zapier_Enabled_Conditional
	 */
	private $zapier_enable_conditional;

	/**
	 * {@inheritDoc}
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 */
	public static function get_conditionals() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		return [ Admin_Conditional::class ];
	}

	/**
	 * Zapier_Notification_Integration constructor.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param WPSEO_Admin_Asset_Manager  $admin_asset_manager       The admin asset manager.
	 * @param Capability_Helper          $capability_helper         The capability helper.
	 * @param Zapier_Enabled_Conditional $zapier_enable_conditional The capability helper.
	 */
	public function __construct(
		WPSEO_Admin_Asset_Manager $admin_asset_manager,
		Capability_Helper $capability_helper,
		Zapier_Enabled_Conditional $zapier_enable_conditional
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		$this->admin_asset_manager       = $admin_asset_manager;
		$this->capability_helper         = $capability_helper;
		$this->zapier_enable_conditional = $zapier_enable_conditional;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 */
	public function register_hooks() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		\add_action( 'admin_notices', [ $this, 'zapier_notice' ] );
		\add_action( 'wp_ajax_dismiss_zapier_notice', [ $this, 'dismiss_zapier_notice' ] );
	}

	/**
	 * Shows a notice if zapier is enabled and it's not being dismissed before.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function zapier_notice() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! $this->capability_helper->current_user_can( 'wpseo_manage_options' ) ) {
			return;
		}

		if ( $this->is_notice_dismissed() ) {
			return;
		}

		$is_zapier_connected = WPSEO_Options::get( 'zapier_subscription', [] );

		if ( $is_zapier_connected ) {
			$this->admin_asset_manager->enqueue_style( 'monorepo' );

			/* translators: %1$s for Yoast SEO */
			$title   = \sprintf( \__( 'Zapier integration will be removed from %1$s', 'wordpress-seo-premium' ), 'Yoast SEO' );
			$content = \sprintf(
				/* translators: %1$s and %2$s expands to the link to https://yoast.com/features/zapier, %3$s for Yoast SEO, %4$s for support email.  */
				\esc_html__( 'The %1$sZapier integration%2$s (on the Integrations page) will be removed from %3$s in 20.7 (release date May 9th). If you have any questions, please reach out to %4$s.', 'wordpress-seo-premium' ),
				'<a href="' . WPSEO_Shortlinker::get( 'http://yoa.st/zapier-removal-notification' ) . '" target="_blank">',
				'</a>',
				'Yoast SEO',
				'support@yoast.com'
			);

			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- Output of the title escaped in the Notice_Presenter.
			echo new Notice_Presenter(
				$title,
				$content,
				null,
				null,
				true,
				'yoast-zapier-notice'
			);
			// phpcs:enable

			// Enable permanently dismissing the notice.
			echo '<script>
                jQuery( document ).ready( function() {
                    jQuery( "body" ).on( "click", "#yoast-zapier-notice .notice-dismiss", function() {
                        const data = { "action": "dismiss_zapier_notice", "nonce": "' . \esc_attr( \wp_create_nonce( 'dismiss_zapier_notice' ) ) . '" };
						jQuery.post( ajaxurl, data, function( response ) {
							jQuery( this ).parent( "#yoast-zapier-notice" ).hide();
						});
                    } );
                } );
            </script>';
		}
	}

	/**
	 * Was the notice dismissed by the user.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @return bool
	 */
	protected function is_notice_dismissed() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		return \get_user_meta( \get_current_user_id(), self::USER_META_DISMISSED, true ) === '1';
	}

	/**
	 * Dismisses the notice.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @return bool
	 */
	public function dismiss_zapier_notice() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! \check_ajax_referer( 'dismiss_zapier_notice', 'nonce', false ) || ! $this->capability_helper->current_user_can( 'wpseo_manage_options' ) ) {
			return;
		}
		\update_user_meta( \get_current_user_id(), self::USER_META_DISMISSED, true );
		return WPSEO_Options::set( 'is_dismissed_zapier_notice', true );
	}
}
