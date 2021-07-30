<?php

namespace Yoast\WP\SEO\Premium\Integrations\Third_Party;

use WP_Post;
use WPSEO_Admin_Asset_Yoast_Components_L10n;
use WPSEO_Capability_Utils;
use WPSEO_Custom_Fields_Plugin;
use WPSEO_Language_Utils;
use WPSEO_Metabox;
use WPSEO_Metabox_Analysis_SEO;
use WPSEO_Options;
use WPSEO_Post_Type;
use WPSEO_Post_Watcher;
use WPSEO_Premium_Asset_JS_L10n;
use WPSEO_Premium_Assets;
use WPSEO_Premium_Prominent_Words_Support;
use WPSEO_Social_Previews;
use WPSEO_Utils;
use Yoast\WP\SEO\Conditionals\Third_Party\Elementor_Edit_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration;

/**
 * Elementor integration class for Yoast SEO Premium.
 */
class Elementor_Premium implements Integration_Interface {

	/**
	 * Holds the script handle.
	 *
	 * @var string
	 */
	const SCRIPT_HANDLE = 'elementor-premium';

	/**
	 * Represents the post.
	 *
	 * @var WP_Post|null
	 */
	protected $post;

	/**
	 * Represents the post watcher.
	 *
	 * @var WPSEO_Post_Watcher
	 */
	protected $post_watcher;

	/**
	 * The prominent words helper.
	 *
	 * @var Prominent_Words_Helper
	 */
	protected $prominent_words_helper;

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Elementor_Edit_Conditional::class ];
	}

	/**
	 * Constructs the class.
	 *
	 * @param Prominent_Words_Helper $prominent_words_helper The prominent words helper.
	 */
	public function __construct( Prominent_Words_Helper $prominent_words_helper ) {
		$this->prominent_words_helper = $prominent_words_helper;
		$this->post_watcher           = new WPSEO_Post_Watcher();
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue' ] );
		\add_action( 'post_updated', [ $this->post_watcher, 'detect_slug_change' ], 12, 3 );
	}

	/**
	 * Enqueues all the needed JS and CSS.
	 *
	 * @return void
	 */
	public function enqueue() {
		// Check if we should load.
		if ( ! $this->load_metabox() ) {
			return;
		}

		// Re-register assets as Elementor unregister everything.
		$asset_manager = new WPSEO_Premium_Assets();
		$asset_manager->register_assets();

		// Initialize Elementor (replaces premium-metabox).
		$this->enqueue_assets();

		/*
		 * Re-enqueue the integrations as `admin_enqueue_scripts` is undone.
		 * Note the register_hooks were not even called (because it doesn't work anyway).
		 */
		$social_previews = new WPSEO_Social_Previews();
		$social_previews->enqueue_assets();
		$custom_fields = new WPSEO_Custom_Fields_Plugin();
		$custom_fields->enqueue();
	}

	// Below is mostly copied from `premium-metabox.php`.

	/**
	 * Enqueues assets when relevant.
	 *
	 * @codeCoverageIgnore Method uses dependencies.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		\wp_enqueue_script( static::SCRIPT_HANDLE );
		\wp_enqueue_style( static::SCRIPT_HANDLE );

		$localization = new WPSEO_Admin_Asset_Yoast_Components_L10n();
		$localization->localize_script( static::SCRIPT_HANDLE );

		$premium_localization = new WPSEO_Premium_Asset_JS_L10n();
		$premium_localization->localize_script( static::SCRIPT_HANDLE );

		$this->send_data_to_assets();
	}

	/**
	 * Send data to assets by using wp_localize_script.
	 *
	 * @return void
	 */
	public function send_data_to_assets() {
		$analysis_seo = new WPSEO_Metabox_Analysis_SEO();

		$data = [
			'restApi'            => $this->get_rest_api_config(),
			'seoAnalysisEnabled' => $analysis_seo->is_enabled(),
			'licensedURL'        => WPSEO_Utils::get_home_url(),
			'settingsPageUrl'    => \admin_url( 'admin.php?page=wpseo_dashboard#top#features' ),
			'integrationsTabURL' => \admin_url( 'admin.php?page=wpseo_dashboard#top#integrations' ),

		];
		$data = \array_merge( $data, $this->get_post_metabox_config() );

		if ( current_user_can( 'edit_others_posts' ) ) {
			$data['workoutsUrl'] = admin_url( 'admin.php?page=wpseo_workouts' );
		}

		// Use an extra level in the array to preserve booleans. WordPress sanitizes scalar values in the first level of the array.
		\wp_localize_script( static::SCRIPT_HANDLE, 'wpseoPremiumMetaboxData', [ 'data' => $data ] );
	}

	/**
	 * Retrieves the metabox config for a post.
	 *
	 * @return array The config.
	 */
	protected function get_post_metabox_config() {
		$insights_enabled         = WPSEO_Options::get( 'enable_metabox_insights', false );
		$link_suggestions_enabled = WPSEO_Options::get( 'enable_link_suggestions', false );

		$prominent_words_support = new WPSEO_Premium_Prominent_Words_Support();
		if ( ! $prominent_words_support->is_post_type_supported( $this->get_metabox_post()->post_type ) ) {
			$insights_enabled = false;
		}

		$site_locale = \get_locale();
		$language    = WPSEO_Language_Utils::get_language( $site_locale );

		return [
			'insightsEnabled'          => ( $insights_enabled ) ? 'enabled' : 'disabled',
			'currentObjectId'          => $this->get_metabox_post()->ID,
			'currentObjectType'        => 'post',
			'linkSuggestionsEnabled'   => ( $link_suggestions_enabled ) ? 'enabled' : 'disabled',
			'linkSuggestionsAvailable' => $prominent_words_support->is_post_type_supported( $this->get_metabox_post()->post_type ),
			'linkSuggestionsUnindexed' => ! $this->is_prominent_words_indexing_completed() && WPSEO_Capability_Utils::current_user_can( 'wpseo_manage_options' ),
			'perIndexableLimit'        => $this->per_indexable_limit( $language ),
		];
	}

	/**
	 * Checks if the content endpoints are available.
	 *
	 * @return bool Returns true if the content endpoints are available
	 */
	public static function are_content_endpoints_available() {
		if ( \function_exists( 'rest_get_server' ) ) {
			$namespaces = \rest_get_server()->get_namespaces();
			return \in_array( 'wp/v2', $namespaces, true );
		}
		return false;
	}

	/**
	 * Retrieves the REST API configuration.
	 *
	 * @return array The configuration.
	 */
	protected function get_rest_api_config() {
		return [
			'available'                 => WPSEO_Utils::is_api_available(),
			'contentEndpointsAvailable' => self::are_content_endpoints_available(),
			'root'                      => \esc_url_raw( \rest_url() ),
			'nonce'                     => \wp_create_nonce( 'wp_rest' ),
		];
	}

	/**
	 * Returns the post for the current admin page.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return WP_Post|null The post for the current admin page.
	 */
	protected function get_metabox_post() {
		if ( $this->post !== null ) {
			return $this->post;
		}

		$post = \filter_input( \INPUT_GET, 'post' );
		if ( ! empty( $post ) ) {
			$post_id = (int) WPSEO_Utils::validate_int( $post );

			$this->post = \get_post( $post_id );

			return $this->post;
		}

		if ( isset( $GLOBALS['post'] ) ) {
			$this->post = $GLOBALS['post'];

			return $this->post;
		}

		return null;
	}

	/**
	 * Checks whether or not the metabox related scripts should be loaded.
	 *
	 * @return bool True when it should be loaded.
	 */
	protected function load_metabox() {
		// When the current page isn't a post related one.
		if ( WPSEO_Metabox::is_post_edit( $this->get_current_page() ) ) {
			return WPSEO_Post_Type::has_metabox_enabled( $this->get_current_post_type() );
		}

		// Make sure ajax integrations are loaded.
		return \wp_doing_ajax();
	}

	/**
	 * Retrieves the current post type.
	 *
	 * @codeCoverageIgnore It depends on external request input.
	 *
	 * @return string The post type.
	 */
	protected function get_current_post_type() {
		$post = \filter_input( \INPUT_GET, 'post', \FILTER_SANITIZE_STRING );

		if ( $post ) {
			return \get_post_type( \get_post( $post ) );
		}

		return \filter_input(
			\INPUT_GET,
			'post_type',
			\FILTER_SANITIZE_STRING,
			[
				'options' => [
					'default' => 'post',
				],
			]
		);
	}

	/**
	 * Retrieves the value of the pagenow variable.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string The value of pagenow.
	 */
	protected function get_current_page() {
		global $pagenow;

		return $pagenow;
	}

	/**
	 * Returns whether or not we need to index more posts for correct link suggestion functionality.
	 *
	 * @return bool Whether or not we need to index more posts.
	 */
	protected function is_prominent_words_indexing_completed() {
		$is_indexing_completed = $this->prominent_words_helper->is_indexing_completed();
		if ( $is_indexing_completed === null ) {
			$indexation_integration = \YoastSEOPremium()->classes->get( Indexing_Integration::class );
			$is_indexing_completed  = $indexation_integration->get_unindexed_count( 0 ) === 0;

			$this->prominent_words_helper->set_indexing_completed( $is_indexing_completed );
		}

		return $is_indexing_completed;
	}

	/**
	 * Returns the number of prominent words to store for content written in the given language.
	 *
	 * @param string $language The current language.
	 *
	 * @return int The number of words to store.
	 */
	protected function per_indexable_limit( $language ) {
		if ( \YoastSEO()->helpers->language->has_function_word_support( $language ) ) {
			return Indexing_Integration::PER_INDEXABLE_LIMIT;
		}

		return Indexing_Integration::PER_INDEXABLE_LIMIT_NO_FUNCTION_WORD_SUPPORT;
	}
}
