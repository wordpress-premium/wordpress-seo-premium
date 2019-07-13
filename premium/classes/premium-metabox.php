<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium|Classes
 */

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
	 * Creates the meta box class.
	 *
	 * @param WPSEO_Metabox_Link_Suggestions|null $link_suggestions The link suggestions meta box.
	 */
	public function __construct( WPSEO_Metabox_Link_Suggestions $link_suggestions = null ) {
		if ( $link_suggestions === null ) {
			$link_suggestions = new WPSEO_Metabox_Link_Suggestions();
		}

		$this->link_suggestions = $link_suggestions;
	}

	/**
	 * Registers relevant hooks to WordPress.
	 *
	 * @codeCoverageIgnore Method uses dependencies.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'admin_init', array( $this, 'initialize' ) );

		$this->link_suggestions->register_hooks();
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

		$data = array(
			'restApi'            => $this->get_rest_api_config(),
			'seoAnalysisEnabled' => $analysis_seo->is_enabled(),
			'licensedURL'        => WPSEO_Utils::get_home_url(),
		);

		if ( WPSEO_Metabox::is_post_edit( $this->get_current_page() ) ) {
			$data = array_merge( $data, $this->get_post_metabox_config() );
		}
		elseif ( WPSEO_Taxonomy::is_term_edit( $this->get_current_page() ) ) {
			$data = array_merge( $data, $this->get_term_metabox_config() );
		}

		// Use an extra level in the array to preserve booleans. WordPress sanitizes scalar values in the first level of the array.
		wp_localize_script( WPSEO_Admin_Asset_Manager::PREFIX . 'premium-metabox', 'wpseoPremiumMetaboxData', array( 'data' => $data ) );
	}

	/**
	 * Retrieves the metabox config for a post.
	 *
	 * @return array The config.
	 */
	protected function get_post_metabox_config() {
		$insights_enabled         = WPSEO_Options::get( 'enable_metabox_insights', false );
		$link_suggestions_enabled = WPSEO_Options::get( 'enable_link_suggestions', false );

		$language_support = new WPSEO_Premium_Prominent_Words_Language_Support();

		if ( ! $language_support->is_language_supported( WPSEO_Language_Utils::get_language( get_locale() ) ) ) {
			$insights_enabled         = false;
			$link_suggestions_enabled = false;
		}

		$post = $this->get_post();

		$post_type_support = new WPSEO_Premium_Prominent_Words_Support();
		if ( ! $post_type_support->is_post_type_supported( get_post_type( $post ) ) ) {
			$insights_enabled = false;
		}

		return array(
			'insightsEnabled'          => ( $insights_enabled ) ? 'enabled' : 'disabled',
			'postID'                   => $this->get_post_ID(),
			'linkSuggestionsEnabled'   => ( $link_suggestions_enabled ) ? 'enabled' : 'disabled',
			'linkSuggestionsAvailable' => $this->link_suggestions->is_available( $post->post_type ),
			'linkSuggestionsUnindexed' => $this->link_suggestions->is_site_unindexed() && WPSEO_Capability_Utils::current_user_can( 'wpseo_manage_options' ),
			'linkSuggestions'          => $this->link_suggestions->get_js_data(),
		);
	}

	/**
	 * Retrieves the metabox config for a term.
	 *
	 * @return array The config.
	 */
	protected function get_term_metabox_config() {
		return array(
			'insightsEnabled'          => 'disabled',
			'linkSuggestionsEnabled'   => 'disabled',
			'linkSuggestionsAvailable' => false,
			'linkSuggestionsUnindexed' => false,
			'linkSuggestions'          => false,
		);
	}

	/**
	 * Retrieves the REST API configuration.
	 *
	 * @return array The configuration.
	 */
	protected function get_rest_api_config() {
		return array(
			'available'                 => WPSEO_Utils::is_api_available(),
			'contentEndpointsAvailable' => WPSEO_Utils::are_content_endpoints_available(),
			'root'                      => esc_url_raw( rest_url() ),
			'nonce'                     => wp_create_nonce( 'wp_rest' ),
		);
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
		return array(
			'social-previews'       => new WPSEO_Social_Previews(),

			// Add custom fields plugin to post and page edit pages.
			'premium-custom-fields' => new WPSEO_Custom_Fields_Plugin(),
		);
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
			array(
				'options' => array(
					'default' => 'post',
				),
			)
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
		if ( ! isset( $_SERVER['REQUEST_METHOD'] ) || ! in_array( $_SERVER['REQUEST_METHOD'], array( 'GET', 'POST' ), true ) ) {
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
	 * Registers assets to WordPress.
	 *
	 * @deprecated 9.4
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_assets() {
		_deprecated_function( 'WPSEO_Premium_Metabox::register_assets', '9.4' );
	}
}
