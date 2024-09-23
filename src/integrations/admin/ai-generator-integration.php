<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Addon_Manager;
use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Introductions\Infrastructure\Introductions_Seen_Repository;
use Yoast\WP\SEO\Premium\Conditionals\Ai_Editor_Conditional;
use Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper;
use Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper;
use Yoast\WP\SEO\Premium\Introductions\Application\Ai_Fix_Assessments_Introduction;

/**
 * Ai_Generator_Integration class.
 */
class Ai_Generator_Integration implements Integration_Interface {

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
	 * Represents the current page helper.
	 *
	 * @var Current_Page_Helper
	 */
	private $current_page_helper;

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
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array<string>
	 */
	public static function get_conditionals() {
		return [ Ai_Editor_Conditional::class ];
	}

	/**
	 * Constructs the class.
	 *
	 * @param WPSEO_Admin_Asset_Manager     $asset_manager                 The admin asset manager.
	 * @param WPSEO_Addon_Manager           $addon_manager                 The addon manager.
	 * @param AI_Generator_Helper           $ai_generator_helper           The AI generator helper.
	 * @param Current_Page_Helper           $current_page_helper           The current page helper.
	 * @param Options_Helper                $options_helper                The options helper.
	 * @param User_Helper                   $user_helper                   The user helper.
	 * @param Introductions_Seen_Repository $introductions_seen_repository The introductions seen repository.
	 */
	public function __construct(
		WPSEO_Admin_Asset_Manager $asset_manager,
		WPSEO_Addon_Manager $addon_manager,
		AI_Generator_Helper $ai_generator_helper,
		Current_Page_Helper $current_page_helper,
		Options_Helper $options_helper,
		User_Helper $user_helper,
		Introductions_Seen_Repository $introductions_seen_repository
	) {
		$this->asset_manager                 = $asset_manager;
		$this->addon_manager                 = $addon_manager;
		$this->ai_generator_helper           = $ai_generator_helper;
		$this->current_page_helper           = $current_page_helper;
		$this->options_helper                = $options_helper;
		$this->user_helper                   = $user_helper;
		$this->introductions_seen_repository = $introductions_seen_repository;
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

		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		// Enqueue after Elementor_Premium integration, which re-registers the assets.
		\add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_assets' ], 11 );
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

		\wp_enqueue_script( 'wp-seo-premium-ai-generator' );
		\wp_localize_script(
			'wp-seo-premium-ai-generator',
			'wpseoPremiumAiGenerator',
			[
				'adminUrl'             => \admin_url( 'admin.php' ),
				'hasConsent'           => $this->user_helper->get_meta( $user_id, '_yoast_wpseo_ai_consent', true ),
				'productSubscriptions' => $this->get_product_subscriptions(),
				'hasSeenIntroduction'  => $this->introductions_seen_repository->is_introduction_seen( $user_id, Ai_Fix_Assessments_Introduction::ID ),
				'pluginUrl'            => \plugins_url( '', \WPSEO_PREMIUM_FILE ),
				'postType'             => $this->get_post_type(),
				'contentType'          => $this->get_content_type(),
				'requestTimeout'       => $this->ai_generator_helper->get_request_timeout(),
			]
		);
		$this->asset_manager->enqueue_style( 'premium-ai-generator' );
	}

	/**
	 * Returns the post type of the currently edited object.
	 * In case this object is a term, returns the taxonomy.
	 *
	 * @return string
	 */
	private function get_post_type() {
		// The order of checking is important here: terms have an empty post_type parameter in their GET request.
		$taxonomy = $this->current_page_helper->get_current_taxonomy();
		if ( $taxonomy !== '' ) {
			return $taxonomy;
		}

		$post_type = $this->current_page_helper->get_current_post_type();
		if ( $post_type ) {
			return $post_type;
		}

		return '';
	}

	/**
	 * Returns the content type (i.e., 'post' or 'term') of the currently edited object.
	 *
	 * @return string
	 */
	private function get_content_type() {
		$taxonomy = $this->current_page_helper->get_current_taxonomy();
		if ( $taxonomy !== '' ) {
			return 'term';
		}

		$post_type = $this->current_page_helper->get_current_post_type();
		if ( $post_type ) {
			return 'post';
		}

		return '';
	}
}
