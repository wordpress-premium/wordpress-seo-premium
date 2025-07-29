<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Addon_Manager;
use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Conditionals\Admin\Post_Conditional;
use Yoast\WP\SEO\Helpers\Current_Page_Helper;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Introductions\Infrastructure\Introductions_Seen_Repository;
use Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper;
use Yoast\WP\SEO\Premium\Introductions\Application\Ai_Fix_Assessments_Introduction;

/**
 * Ai_Optimize_Integration class.
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Ai_Optimize_Integration implements Integration_Interface {

	/**
	 * Represents the admin asset manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	private $asset_manager;

	/**
	 * Represents the add-on manager.
	 *
	 * @var WPSEO_Addon_Manager
	 */
	private $addon_manager;

	/**
	 * Represents the AI generator helper.
	 *
	 * @var AI_Generator_Helper
	 */
	private $ai_generator_helper;

	/**
	 * Represents the options manager.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * Represents the user helper.
	 *
	 * @var User_Helper
	 */
	private $user_helper;

	/**
	 * Represents the introductions seen repository.
	 *
	 * @var Introductions_Seen_Repository
	 */
	private $introductions_seen_repository;

	/**
	 * Represents the Current_Page_Helper.
	 *
	 * @var Current_Page_Helper $current_page_helper The Current_Page_Helper.
	 */
	private $current_page_helper;

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array<string>
	 */
	public static function get_conditionals(): array {
		return [ Post_Conditional::class ];
	}

	/**
	 * Constructs the class.
	 *
	 * @param WPSEO_Admin_Asset_Manager     $asset_manager                 The admin asset manager.
	 * @param WPSEO_Addon_Manager           $addon_manager                 The addon manager.
	 * @param AI_Generator_Helper           $ai_generator_helper           The AI generator helper.
	 * @param Options_Helper                $options_helper                The options helper.
	 * @param User_Helper                   $user_helper                   The user helper.
	 * @param Introductions_Seen_Repository $introductions_seen_repository The introductions seen repository.
	 * @param Current_Page_Helper           $current_page_helper           The Current_Page_Helper.
	 */
	public function __construct(
		WPSEO_Admin_Asset_Manager $asset_manager,
		WPSEO_Addon_Manager $addon_manager,
		AI_Generator_Helper $ai_generator_helper,
		Options_Helper $options_helper,
		User_Helper $user_helper,
		Introductions_Seen_Repository $introductions_seen_repository,
		Current_Page_Helper $current_page_helper
	) {
		$this->asset_manager                 = $asset_manager;
		$this->addon_manager                 = $addon_manager;
		$this->ai_generator_helper           = $ai_generator_helper;
		$this->options_helper                = $options_helper;
		$this->user_helper                   = $user_helper;
		$this->introductions_seen_repository = $introductions_seen_repository;
		$this->current_page_helper           = $current_page_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( ! $this->options_helper->get( 'enable_ai_generator', false ) ) {
			return;
		}

		// Add the assets to the editor, for the default and the classic editor.
		\add_action( 'enqueue_block_assets', [ $this, 'enqueue_assets' ] );
		\add_filter( 'mce_css', [ $this, 'enqueue_css_mce' ] );

		// Add the assets to the admin as a whole.
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );

		\add_action( 'admin_head', [ $this, 'render_react_container' ] );
	}

	/**
	 * Returns `true` when the page is the Elementor editor.
	 *
	 * @return bool `true` when the page is the Elementor editor.
	 */
	private function is_elementor_editor() {
		if ( $this->current_page_helper->get_current_admin_page() !== 'post.php' ) {
			return false;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['action'] ) && \is_string( $_GET['action'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are not processing form information, We are only strictly comparing.
			if ( \wp_unslash( $_GET['action'] ) === 'elementor' ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Renders the React container.
	 *
	 * @return void
	 */
	public function render_react_container(): void {
		if ( $this->is_elementor_editor() ) {
			return;
		}

		echo '<div id="yoast-seo-premium-ai-optimize"></div>';
	}

	/**
	 * Gets the subscription status for Yoast SEO Premium and Yoast WooCommerce SEO.
	 *
	 * @return array<string, bool>
	 */
	public function get_product_subscriptions() {
		return [
			'premiumSubscription'     => $this->addon_manager->has_valid_subscription( WPSEO_Addon_Manager::PREMIUM_SLUG ),
			'wooCommerceSubscription' => $this->addon_manager->has_valid_subscription( WPSEO_Addon_Manager::WOOCOMMERCE_SLUG ),
		];
	}

	/**
	 * Enqueues the required assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		$user_id = $this->user_helper->get_current_user_id();

		\wp_enqueue_script( 'wp-seo-premium-ai-optimize' );
		\wp_localize_script(
			'wp-seo-premium-ai-optimize',
			'wpseoPremiumAiOptimize',
			[
				'adminUrl'             => \admin_url( 'admin.php' ),
				'hasConsent'           => $this->user_helper->get_meta( $user_id, '_yoast_wpseo_ai_consent', true ),
				'productSubscriptions' => $this->get_product_subscriptions(),
				'hasSeenIntroduction'  => $this->introductions_seen_repository->is_introduction_seen( $user_id, Ai_Fix_Assessments_Introduction::ID ),
				'pluginUrl'            => \plugins_url( '', \WPSEO_PREMIUM_FILE ),
				'requestTimeout'       => $this->ai_generator_helper->get_request_timeout(),
			]
		);
		$this->asset_manager->enqueue_style( 'premium-ai-fix-assessments' );
	}

	/**
	 * Adds the AI Optimize CSS file to the list of CSS files to be loaded inside the classic editor.
	 *
	 * @param string $css_files The CSS files that WordPress currently inside the classic editor.
	 * @return string The CSS files, including our AI Optimize CSS file.
	 */
	public function enqueue_css_mce( $css_files ) {
		$ai_css = \wp_styles()->registered['yoast-seo-premium-ai-fix-assessments'];
		$url    = $ai_css->src;

		if ( $css_files === '' ) {
			$css_files = $url;
		}
		else {
			$css_files .= ',' . $url;
		}

		return $css_files;
	}
}
