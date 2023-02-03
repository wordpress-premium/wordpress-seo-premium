<?php

namespace Yoast\WP\SEO\Premium\Integrations\Third_Party;

use WPSEO_Admin_Asset_Manager;
use WPSEO_Admin_Utils;
use Yoast\WP\SEO\Conditionals\Yoast_Admin_And_Dashboard_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Presenters\Admin\Alert_Presenter;
use Yoast_Feature_Toggle;

/**
 * Zapier integration class for managing the toggle and the connection setup.
 */
class Zapier implements Integration_Interface {

	/**
	 * The Zapier dashboard URL.
	 *
	 * @var string
	 */
	const ZAPIER_DASHBOARD_URL = 'https://zapier.com/app/zaps';

	/**
	 * Represents the admin asset manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	protected $asset_manager;

	/**
	 * The Zapier helper.
	 *
	 * @var Zapier_Helper
	 */
	protected $zapier_helper;

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Yoast_Admin_And_Dashboard_Conditional::class ];
	}

	/**
	 * Zapier constructor.
	 *
	 * @param WPSEO_Admin_Asset_Manager $asset_manager The admin asset manager.
	 * @param Zapier_Helper             $zapier_helper The Zapier helper.
	 */
	public function __construct( WPSEO_Admin_Asset_Manager $asset_manager, Zapier_Helper $zapier_helper ) {
		$this->asset_manager = $asset_manager;
		$this->zapier_helper = $zapier_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		// Add the Zapier toggle to the Integrations tab in the admin.
		\add_action( 'Yoast\WP\SEO\admin_integration_after', [ $this, 'toggle_after' ] );
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		\add_filter( 'wpseo_premium_integrations_page_data', [ $this, 'enhance_integrations_page_data' ] );
	}

	/**
	 * Enqueues the required assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Date is not processed or saved.
		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'wpseo_integrations' ) {
			return;
		}

		$this->asset_manager->enqueue_style( 'monorepo' );
	}

	/**
	 * Returns additional content to be displayed after the Zapier toggle.
	 *
	 * @param Yoast_Feature_Toggle $integration The integration feature we've shown the toggle for.
	 *
	 * @return void
	 */
	public function toggle_after( $integration ) {
		if ( $integration->setting !== 'zapier_integration_active' ) {
			return;
		}
		if ( $this->zapier_helper->is_connected() ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is already escaped in function.
			echo $this->get_connected_content();
			return;
		}

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is already escaped in function.
		echo $this->get_not_connected_content();
	}

	/**
	 * Returns additional content to be displayed when Zapier is connected.
	 *
	 * @return string The additional content.
	 */
	private function get_connected_content() {
		$alert = new Alert_Presenter(
			\sprintf(
				/* translators: 1: Yoast SEO, 2: Zapier. */
				\esc_html__( '%1$s is successfully connected to %2$s!', 'wordpress-seo-premium' ),
				'Yoast SEO',
				'Zapier'
			),
			'success'
		);

		$output  = '<div id="zapier-connection">';
		$output .= $alert->present();
		$output .= '<p><a href="' . self::ZAPIER_DASHBOARD_URL . '" class="yoast-button yoast-button--primary" type="button" target="_blank">' . \sprintf(
			/* translators: %s: Zapier. */
			\esc_html__( 'Go to your %s Dashboard', 'wordpress-seo-premium' ),
			'Zapier'
		) . WPSEO_Admin_Utils::get_new_tab_message() . '</a></p>';
		$output .= '<p>' . \sprintf(
			/* translators: 1: Zapier, 2: The Zapier API Key. */
			\esc_html__( '%1$s uses this API Key: %2$s', 'wordpress-seo-premium' ),
			'Zapier',
			'<strong>' . $this->zapier_helper->get_or_generate_zapier_api_key() . '</strong>'
		) . '</p>';
		$output .= '<p><button name="zapier_api_key_reset" value="1" type="submit" class="yoast-button yoast-button--secondary">' . \esc_html__( 'Reset API Key', 'wordpress-seo-premium' ) . '</button></p>';
		$output .= '</div>';

		return $output;
	}

	/**
	 * Returns additional content to be displayed when Zapier is not connected.
	 *
	 * @return string The additional content.
	 */
	private function get_not_connected_content() {
		$content = \sprintf(
			/* translators: 1: Yoast SEO, 2: Zapier, 3: Emphasis open tag, 4: Emphasis close tag. */
			\esc_html__( '%1$s is not connected to %2$s. To set up a connection, make sure you click %3$sSave changes%4$s first, then copy the given API key below and use it to %3$screate%4$s and %3$sturn on%4$s a Zap within your %2$s account.', 'wordpress-seo-premium' ),
			'Yoast SEO',
			'Zapier',
			'<em>',
			'</em>'
		);

		$content .= '<br/><br/>';
		$content .= ' ' . \sprintf(
			/* translators: 1: Yoast SEO. */
			\esc_html__( 'Please note that you can only create 1 Zap with a trigger event from %1$s. Within this Zap you can choose one or more actions.', 'wordpress-seo-premium' ),
			'Yoast SEO'
		);

		$alert = new Alert_Presenter(
			$content,
			'info'
		);

		$output  = '<div id="zapier-connection">';
		$output .= $alert->present();
		$output .= '<div class="yoast-field-group">';
		$output .= '<div class="yoast-field-group__title yoast-field-group__title--light">';
		$output .= '<label for="zapier-api-key">' . \sprintf(
			/* translators: %s: Zapier. */
			\esc_html__( '%s will ask for an API key. Use this one:', 'wordpress-seo-premium' ),
			'Zapier'
		) . '</label>';
		$output .= '</div>';
		$output .= '<div class="yoast-field-group__inline">';
		$output .= '<input class="yoast-field-group__inputfield" readonly type="text" id="zapier-api-key" name="wpseo[zapier_api_key]" value="' . $this->zapier_helper->get_or_generate_zapier_api_key() . '">';
		$output .= '<button type="button" class="yoast-button yoast-button--secondary" id="copy-zapier-api-key" data-clipboard-target="#zapier-api-key">' . \esc_html__( 'Copy to clipboard', 'wordpress-seo-premium' ) . '</button><br />';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<p><a href="' . self::ZAPIER_DASHBOARD_URL . '" class="yoast-button yoast-button--primary" type="button" target="_blank">' . \sprintf(
			/* translators: %s: Zapier. */
			\esc_html__( 'Create a Zap in %s', 'wordpress-seo-premium' ),
			'Zapier'
		) . WPSEO_Admin_Utils::get_new_tab_message() . '</a></p>';
		$output .= '</div>';

		return $output;
	}

	/**
	 * Enhances the array for the integrations page script with additional data.
	 *
	 * @param array $data The array to add data to.
	 *
	 * @return array The enhances data.
	 */
	public function enhance_integrations_page_data( $data ) {
		if ( ! \is_array( $data ) ) {
			$data = [ $data ];
		}

		$data['zapierKey']         = $this->zapier_helper->get_or_generate_zapier_api_key();
		$data['zapierUrl']         = self::ZAPIER_DASHBOARD_URL;
		$data['zapierIsConnected'] = $this->zapier_helper->is_connected();

		return $data;
	}
}
