<?php // phpcs:ignore Yoast.Files.FileName.InvalidClassFileName
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium|Classes
 */

use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration;

/**
 * The metabox for premium.
 */
class WPSEO_Premium_Metabox implements WPSEO_WordPress_Integration {

	/**
	 * Instance of the WPSEO_Metabox_Link_Suggestions class.
	 *
	 * @var WPSEO_Metabox_Link_Suggestions
	 */
	protected $link_suggestions;

	/**
	 * The prominent words helper.
	 *
	 * @var Prominent_Words_Helper
	 */
	protected $prominent_words_helper;

	/**
	 * Creates the meta box class.
	 *
	 * @param Prominent_Words_Helper              $prominent_words_helper The prominent words helper.
	 * @param WPSEO_Metabox_Link_Suggestions|null $link_suggestions       The link suggestions meta box.
	 */
	public function __construct(
		Prominent_Words_Helper $prominent_words_helper,
		WPSEO_Metabox_Link_Suggestions $link_suggestions = null
	) {
		if ( $link_suggestions === null ) {
			$link_suggestions = new WPSEO_Metabox_Link_Suggestions();
		}

		$this->prominent_words_helper = $prominent_words_helper;
		$this->link_suggestions       = $link_suggestions;
	}

	/**
	 * Registers relevant hooks to WordPress.
	 *
	 * @codeCoverageIgnore Method uses dependencies.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		add_action( 'admin_init', [ $this, 'initialize' ] );

		$this->link_suggestions->register_hooks();
	}

	/**
	 * Checks if the content endpoints are available.
	 *
	 * @return bool Returns true if the content endpoints are available
	 */
	public static function are_content_endpoints_available() {
		if ( function_exists( 'rest_get_server' ) ) {
			$namespaces = rest_get_server()->get_namespaces();
			return in_array( 'wp/v2', $namespaces, true );
		}
		return false;
	}

	/**
	 * Initializes the metabox by loading the register_hooks for the dependencies.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( ! $this->load_metabox( $this->get_current_page() ) ) {
			return;
		}

		foreach ( $this->get_metabox_integrations() as $integration ) {
			$integration->register_hooks();
		}
	}

	/**
	 * Enqueues assets when relevant.
	 *
	 * @codeCoverageIgnore Method uses dependencies.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		if ( ! $this->load_metabox( $this->get_current_page() ) ) {
			return;
		}

		wp_enqueue_script( WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox' );
		wp_enqueue_style( WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox' );

		$localization = new WPSEO_Admin_Asset_Yoast_Components_L10n();
		$localization->localize_script( WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox' );

		$premium_localization = new WPSEO_Premium_Asset_JS_L10n();
		$premium_localization->localize_script( WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox' );

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
			'settingsPageUrl'    => admin_url( 'admin.php?page=wpseo_dashboard#top#features' ),
			'integrationsTabURL' => admin_url( 'admin.php?page=wpseo_dashboard#top#integrations' ),
		];

		if ( WPSEO_Metabox::is_post_edit( $this->get_current_page() ) ) {
			$data = array_merge( $data, $this->get_post_metabox_config() );
		}
		elseif ( WPSEO_Taxonomy::is_term_edit( $this->get_current_page() ) ) {
			$data = array_merge( $data, $this->get_term_metabox_config() );
		}

		if ( current_user_can( 'edit_others_posts' ) ) {
			$data['workoutsUrl'] = admin_url( 'admin.php?page=wpseo_workouts' );
		}

		// Use an extra level in the array to preserve booleans. WordPress sanitizes scalar values in the first level of the array.
		wp_localize_script( 'yoast-seo-premium-metabox', 'wpseoPremiumMetaboxData', [ 'data' => $data ] );
	}

	/**
	 * Retrieves the metabox config for a post.
	 *
	 * @return array The config.
	 */
	protected function get_post_metabox_config() {
		$insights_enabled         = WPSEO_Options::get( 'enable_metabox_insights', false );
		$link_suggestions_enabled = WPSEO_Options::get( 'enable_link_suggestions', false );

		$post = $this->get_post();

		$prominent_words_support = new WPSEO_Premium_Prominent_Words_Support();
		if ( ! $prominent_words_support->is_post_type_supported( $post->post_type ) ) {
			$insights_enabled = false;
		}

		$site_locale = \get_locale();
		$language    = WPSEO_Language_Utils::get_language( $site_locale );

		return [
			'insightsEnabled'             => ( $insights_enabled ) ? 'enabled' : 'disabled',
			'currentObjectId'             => $this->get_post_ID(),
			'currentObjectType'           => 'post',
			'linkSuggestionsEnabled'      => ( $link_suggestions_enabled ) ? 'enabled' : 'disabled',
			'linkSuggestionsAvailable'    => $prominent_words_support->is_post_type_supported( $post->post_type ),
			'linkSuggestionsUnindexed'    => ! $this->is_prominent_words_indexing_completed() && WPSEO_Capability_Utils::current_user_can( 'wpseo_manage_options' ),
			'perIndexableLimit'           => $this->per_indexable_limit( $language ),
		];
	}

	/**
	 * Retrieves the metabox config for a term.
	 *
	 * @return array The config.
	 */
	protected function get_term_metabox_config() {
		$term = null;
		if ( isset( $GLOBALS['tag_ID'], $GLOBALS['taxonomy'] ) ) {
			$term = get_term( $GLOBALS['tag_ID'], $GLOBALS['taxonomy'] );
		}

		if ( $term === null || is_wp_error( $term ) ) {
			return [
				'insightsEnabled'          => 'disabled',
				'linkSuggestionsEnabled'   => 'disabled',
				'linkSuggestionsAvailable' => false,
				'linkSuggestionsUnindexed' => false,
			];
		}

		$link_suggestions_enabled = WPSEO_Options::get( 'enable_link_suggestions', false );
		$insights_enabled         = WPSEO_Options::get( 'enable_metabox_insights', false );

		$prominent_words_support = new WPSEO_Premium_Prominent_Words_Support();
		if ( ! $prominent_words_support->is_taxonomy_supported( $term->taxonomy ) ) {
			$insights_enabled = false;
		}

		$site_locale = \get_locale();
		$language    = WPSEO_Language_Utils::get_language( $site_locale );

		return [
			'insightsEnabled'             => ( $insights_enabled ) ? 'enabled' : 'disabled',
			'currentObjectId'             => $term->term_id,
			'currentObjectType'           => 'term',
			'linkSuggestionsEnabled'      => ( $link_suggestions_enabled ) ? 'enabled' : 'disabled',
			'linkSuggestionsAvailable'    => $prominent_words_support->is_taxonomy_supported( $term->taxonomy ),
			'linkSuggestionsUnindexed'    => ! $this->is_prominent_words_indexing_completed() && WPSEO_Capability_Utils::current_user_can( 'wpseo_manage_options' ),
			'perIndexableLimit'           => $this->per_indexable_limit( $language ),
		];
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
			'root'                      => esc_url_raw( rest_url() ),
			'nonce'                     => wp_create_nonce( 'wp_rest' ),
		];
	}

	/**
	 * Returns the post for the current admin page.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return WP_Post The post for the current admin page.
	 */
	protected function get_post() {
		return get_post( $this->get_post_ID() );
	}

	/**
	 * Retrieves the post ID from the globals.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return int The post ID.
	 */
	protected function get_post_ID() {
		if ( ! isset( $GLOBALS['post_ID'] ) ) {
			return 0;
		}

		return $GLOBALS['post_ID'];
	}

	/**
	 * Retrieves the metabox specific integrations.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return WPSEO_WordPress_Integration[] The metabox integrations.
	 */
	protected function get_metabox_integrations() {
		return [
			'social-previews'       => new WPSEO_Social_Previews(),

			// Add custom fields plugin to post and page edit pages.
			'premium-custom-fields' => new WPSEO_Custom_Fields_Plugin(),
		];
	}

	/**
	 * Checks whether or not the metabox related scripts should be loaded.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param string $current_page The page we are on.
	 *
	 * @return bool True when it should be loaded.
	 */
	protected function load_metabox( $current_page ) {
		// When the current page is a term related one.
		if ( WPSEO_Taxonomy::is_term_edit( $current_page ) || WPSEO_Taxonomy::is_term_overview( $current_page ) ) {
			return WPSEO_Options::get( 'display-metabox-tax-' . $this->get_current_taxonomy() );
		}

		// When the current page isn't a post related one.
		if ( WPSEO_Metabox::is_post_edit( $current_page ) || WPSEO_Metabox::is_post_overview( $current_page ) ) {
			return WPSEO_Post_Type::has_metabox_enabled( $this->get_current_post_type() );
		}

		// Make sure ajax integrations are loaded.
		return wp_doing_ajax();
	}

	/**
	 * Retrieves the current post type.
	 *
	 * @codeCoverageIgnore It depends on external request input.
	 *
	 * @return string The post type.
	 */
	protected function get_current_post_type() {
		$post = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_STRING );

		if ( $post ) {
			return get_post_type( get_post( $post ) );
		}

		return filter_input(
			INPUT_GET,
			'post_type',
			FILTER_SANITIZE_STRING,
			[
				'options' => [
					'default' => 'post',
				],
			]
		);
	}

	/**
	 * Retrieves the current taxonomy.
	 *
	 * @codeCoverageIgnore This function depends on external request input.
	 *
	 * @return string The taxonomy.
	 */
	protected function get_current_taxonomy() {
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash -- doing a strict in_array check should be sufficient.
		if ( ! isset( $_SERVER['REQUEST_METHOD'] ) || ! in_array( $_SERVER['REQUEST_METHOD'], [ 'GET', 'POST' ], true ) ) {
			return '';
		}

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			return (string) filter_input(
				INPUT_POST,
				'taxonomy',
				FILTER_SANITIZE_STRING
			);
		}

		return (string) filter_input(
			INPUT_GET,
			'taxonomy',
			FILTER_SANITIZE_STRING
		);
	}

	/**
	 * Retrieves the value of the pagenow variable.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string The value of pagenow.
	 */
	private function get_current_page() {
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
			$indexation_integration = YoastSEOPremium()->classes->get( Indexing_Integration::class );
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
		if ( YoastSEO()->helpers->language->has_function_word_support( $language ) ) {
			return Indexing_Integration::PER_INDEXABLE_LIMIT;
		}

		return Indexing_Integration::PER_INDEXABLE_LIMIT_NO_FUNCTION_WORD_SUPPORT;
	}
}
