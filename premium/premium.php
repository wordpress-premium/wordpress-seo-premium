<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

if ( ! defined( 'WPSEO_VERSION' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

if ( ! defined( 'WPSEO_PREMIUM_PATH' ) ) {
	define( 'WPSEO_PREMIUM_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPSEO_PREMIUM_FILE' ) ) {
	define( 'WPSEO_PREMIUM_FILE', __FILE__ );
}

/**
 * Class WPSEO_Premium
 */
class WPSEO_Premium {

	/**
	 * Option that stores the current version.
	 *
	 * @var string
	 */
	const OPTION_CURRENT_VERSION = 'wpseo_current_version';

	/**
	 * Human readable version of the current version.
	 *
	 * @var string
	 */
	const PLUGIN_VERSION_NAME = '11.7';

	/**
	 * Machine readable version for determining whether an upgrade is needed.
	 *
	 * @var string
	 */
	const PLUGIN_VERSION_CODE = '16';

	/**
	 * Instance of the WPSEO_Redirect_Page class.
	 *
	 * @var WPSEO_Redirect_Page
	 */
	private $redirects;

	/**
	 * List of registered classes implementing the WPSEO_WordPress_Integration interface.
	 *
	 * @var WPSEO_WordPress_Integration[]
	 */
	private $integrations = array();

	/**
	 * Function that will be executed when plugin is activated.
	 */
	public static function install() {

		// Load the Redirect File Manager.
		require_once WPSEO_PREMIUM_PATH . 'classes/redirect/redirect-file-util.php';

		// Create the upload directory.
		WPSEO_Redirect_File_Util::create_upload_dir();

		// Make sure the notice will be given at install.
		require_once WPSEO_PREMIUM_PATH . 'classes/premium-prominent-words-recalculation-notifier.php';
		$recalculation_notifier = new WPSEO_Premium_Prominent_Words_Recalculation_Notifier();
		$recalculation_notifier->manage_notification();
	}

	/**
	 * Creates instance of license manager if needed and returns the instance of it.
	 *
	 * @codeCoverageIgnore
	 *
	 * @deprecated 10.1
	 */
	public static function get_license_manager() {
		_deprecated_function( __FUNCTION__, '10.1' );
	}

	/**
	 * WPSEO_Premium Constructor
	 */
	public function __construct() {
		$link_suggestions_service        = new WPSEO_Premium_Link_Suggestions_Service();
		$prominent_words_unindexed_query = new WPSEO_Premium_Prominent_Words_Unindexed_Post_Query();
		$prominent_words_support         = new WPSEO_Premium_Prominent_Words_Support();

		$this->integrations = array(
			'premium-metabox'                        => new WPSEO_Premium_Metabox(),
			'premium-assets'                         => new WPSEO_Premium_Assets(),
			'prominent-words-registration'           => new WPSEO_Premium_Prominent_Words_Registration(),
			'prominent-words-endpoint'               => new WPSEO_Premium_Prominent_Words_Endpoint( new WPSEO_Premium_Prominent_Words_Service() ),
			'prominent-words-recalculation'          => new WPSEO_Premium_Prominent_Words_Recalculation( $prominent_words_unindexed_query, $prominent_words_support ),
			'prominent-words-recalculation-link'     => new WPSEO_Premium_Prominent_Words_Link_Endpoint( new WPSEO_Premium_Prominent_Words_Link_Service() ),
			'prominent-words-recalculation-notifier' => new WPSEO_Premium_Prominent_Words_Recalculation_Notifier(),
			'prominent-words-recalculation-endpoint' => new WPSEO_Premium_Prominent_Words_Recalculation_Endpoint( new WPSEO_Premium_Prominent_Words_Recalculation_Service() ),
			'prominent-words-version'                => new WPSEO_Premium_Prominent_Words_Versioning(),
			'link-suggestions'                       => new WPSEO_Metabox_Link_Suggestions(),
			'link-suggestions-endpoint'              => new WPSEO_Premium_Link_Suggestions_Endpoint( $link_suggestions_service ),
			'premium-search-console'                 => new WPSEO_Premium_GSC(),
			'redirects-endpoint'                     => new WPSEO_Premium_Redirect_EndPoint( new WPSEO_Premium_Redirect_Service() ),
			'redirect-export-manager'                => new WPSEO_Premium_Redirect_Export_Manager(),
			'keyword-export-manager'                 => new WPSEO_Premium_Keyword_Export_Manager(),
			'orphaned-post-filter'                   => new WPSEO_Premium_Orphaned_Post_Filter(),
			// Joost de Valk, April 6th 2019.
			// Disabling this until we've found a better way to display this data that doesn't become annoying when you have a lot of post types.
			// 'orphaned-post-notifier'              => new WPSEO_Premium_Orphaned_Post_Notifier( array( 'post', 'page' ), Yoast_Notification_Center::get() ), // Commented out.
			'request-free-translations'              => new WPSEO_Premium_Free_Translations(),
			'expose-javascript-shortlinks'           => new WPSEO_Premium_Expose_Shortlinks(),
			'multi-keyword'                          => new WPSEO_Multi_Keyword(),
			'post-data'                              => new WPSEO_Premium_Post_Data_Endpoint( new WPSEO_Premium_Post_Data_Service() ),
		);

		if ( WPSEO_Options::get( 'enable_cornerstone_content' ) ) {
			$this->integrations['stale-cornerstone-content-filter'] = new WPSEO_Premium_Stale_Cornerstone_Content_Filter();
		}

		$this->setup();
	}

	/**
	 * Adds a feature toggle to the given feature_toggles.
	 *
	 * @param array $feature_toggles The feature toggles to extend.
	 *
	 * @return array
	 */
	public function add_feature_toggles( array $feature_toggles ) {
		$language = WPSEO_Language_Utils::get_language( get_locale() );

		$language_support = new WPSEO_Premium_Prominent_Words_Language_Support();

		if ( $language_support->is_language_supported( $language ) ) {
			$feature_toggles[] = (object) array(
				'name'            => __( 'Insights', 'wordpress-seo-premium' ),
				'setting'         => 'enable_metabox_insights',
				'label'           => __( 'The Insights section in our metabox shows you useful data about your content, like what words you use most often.', 'wordpress-seo-premium' ),
				'read_more_label' => __( 'Read more about how the insights can help you improve your content.', 'wordpress-seo-premium' ),
				'read_more_url'   => 'https://yoa.st/2ai',
				'order'           => 41,
			);
			$feature_toggles[] = (object) array(
				'name'            => __( 'Link suggestions', 'wordpress-seo-premium' ),
				'setting'         => 'enable_link_suggestions',
				'label'           => __( 'The link suggestions metabox contains a list of posts on your blog with similar content that might be interesting to link to.', 'wordpress-seo-premium' ),
				'read_more_label' => __( 'Read more about how internal linking can improve your site structure.', 'wordpress-seo-premium' ),
				'read_more_url'   => 'https://yoa.st/17g',
				'order'           => 42,
			);
		}

		return $feature_toggles;
	}

	/**
	 * Sets up the Yoast SEO premium plugin.
	 *
	 * @return void
	 */
	private function setup() {
		$this->load_textdomain();

		$this->redirect_setup();

		if ( is_admin() ) {
			// Make sure priority is below registration of other implementations of the beacon in News, Video, etc.
			add_action( 'admin_init', array( $this, 'init_helpscout_support' ), 1 );
			add_filter( 'wpseo_feature_toggles', array( $this, 'add_feature_toggles' ) );

			// Only register the yoast i18n when the page is a Yoast SEO page.
			if ( $this->is_yoast_seo_premium_page( filter_input( INPUT_GET, 'page' ) ) ) {
				$this->register_i18n_promo_class();
			}

			add_action( 'admin_init', array( $this, 'initialize_tracking' ), 1 );

			// Disable Yoast SEO.
			add_action( 'admin_init', array( $this, 'disable_wordpress_seo' ), 1 );

			// Add Sub Menu page and add redirect page to admin page array.
			// This should be possible in one method in the future, see #535.
			add_filter( 'wpseo_submenu_pages', array( $this, 'add_submenu_pages' ), 9 );

			// Add input fields to page meta post types.
			add_action( 'wpseo_admin_page_meta_post_types', array( $this, 'admin_page_meta_post_types_checkboxes' ), 10, 2 );

			// Add page analysis fields to variable array key patterns.
			add_filter( 'wpseo_option_titles_variable_array_key_patterns', array( $this, 'add_variable_array_key_pattern' ) );

			// Settings.
			add_action( 'admin_init', array( $this, 'register_settings' ) );

			// Add Premium imports.
			$this->integrations[] = new WPSEO_Premium_Import_Manager();
		}

		// Only activate post and term watcher if permalink structure is enabled.
		if ( get_option( 'permalink_structure' ) ) {
			add_action( 'admin_init', array( $this, 'init_watchers' ) );
			add_action( 'rest_api_init', array( $this, 'init_watchers' ) );
		}

		if ( ! is_admin() ) {
			// Add 404 redirect link to WordPress toolbar.
			add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 96 );

			add_filter( 'redirect_canonical', array( $this, 'redirect_canonical_fix' ), 1, 2 );
		}

		add_action( 'wpseo_premium_indicator_classes', array( $this, 'change_premium_indicator' ) );
		add_action( 'wpseo_premium_indicator_text', array( $this, 'change_premium_indicator_text' ) );

		// Only initialize the AJAX for all tabs except settings.
		$facebook_name = new WPSEO_Facebook_Profile();
		$facebook_name->set_hooks();

		foreach ( $this->integrations as $integration ) {
			$integration->register_hooks();
		}
	}

	/**
	 * Checks if the page is a premium page.
	 *
	 * @param string $page The page to check.
	 *
	 * @return bool
	 */
	private function is_yoast_seo_premium_page( $page ) {
		$premium_pages = array( 'wpseo_redirects' );

		return in_array( $page, $premium_pages, true );
	}

	/**
	 * Registers the promotion class for our GlotPress instance.
	 *
	 * @link https://github.com/Yoast/i18n-module
	 */
	private function register_i18n_promo_class() {
		new Yoast_I18n_v3(
			array(
				'textdomain'     => 'wordpress-seo-premium',
				'project_slug'   => 'wordpress-seo-premium',
				'plugin_name'    => 'Yoast SEO premium',
				'hook'           => 'wpseo_admin_promo_footer',
				'glotpress_url'  => 'http://translate.yoast.com/gp/',
				'glotpress_name' => 'Yoast Translate',
				'glotpress_logo' => 'https://translate.yoast.com/gp-templates/images/Yoast_Translate.svg',
				'register_url'   => 'https://yoa.st/translate',
			)
		);
	}

	/**
	 * Sets the autoloader for the redirects and instantiates the redirect page object.
	 *
	 * @return void
	 */
	private function redirect_setup() {
		$this->redirects = new WPSEO_Redirect_Page();

		// Adds integration that filters redirected entries from the sitemap.
		$this->integrations['redirect-sitemap-filter'] = new WPSEO_Redirect_Sitemap_Filter( home_url() );
	}

	/**
	 * Initialize the watchers for the posts and the terms
	 */
	public function init_watchers() {
		// The Post Watcher.
		$post_watcher = new WPSEO_Post_Watcher();
		$post_watcher->register_hooks();

		// The Term Watcher.
		$term_watcher = new WPSEO_Term_Watcher();
		$term_watcher->register_hooks();
	}

	/**
	 * Hooks into the `redirect_canonical` filter to catch ongoing redirects and move them to the correct spot
	 *
	 * @param string $redirect_url  The target url where the requested URL will be redirected to.
	 * @param string $requested_url The current requested URL.
	 *
	 * @return string
	 */
	public function redirect_canonical_fix( $redirect_url, $requested_url ) {
		$redirects = new WPSEO_Redirect_Option( false );
		$path      = wp_parse_url( $requested_url, PHP_URL_PATH );
		$redirect  = $redirects->get( $path );
		if ( $redirect === false ) {
			return $redirect_url;
		}

		$redirect_url = $redirect->get_origin();
		if ( '/' === substr( $redirect_url, 0, 1 ) ) {
			$redirect_url = home_url( $redirect_url );
		}

		wp_redirect( $redirect_url, $redirect->get_type(), 'Yoast SEO Premium' );
		exit;
	}

	/**
	 * Disable Yoast SEO
	 */
	public function disable_wordpress_seo() {
		if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
			deactivate_plugins( 'wordpress-seo/wp-seo.php' );
		}
	}

	/**
	 * Add 'Create Redirect' option to admin bar menu on 404 pages
	 */
	public function admin_bar_menu() {
		// Prevent function from running if the page is not a 404 page or the user has not the right capabilities to create redirects.
		if ( ! is_404() || ! WPSEO_Capability_Utils::current_user_can( 'wpseo_manage_options' ) ) {
			return;
		}

		global $wp, $wp_admin_bar;

		$parsed_url = wp_parse_url( home_url( $wp->request ) );

		if ( ! is_array( $parsed_url ) || empty( $parsed_url['path'] ) ) {
			return;
		}

		$old_url = WPSEO_Redirect_Util::strip_base_url_path_from_url( home_url(), $parsed_url['path'] );

		if ( isset( $parsed_url['query'] ) && $parsed_url['query'] !== '' ) {
			$old_url .= '?' . $parsed_url['query'];
		}

		$old_url = rawurlencode( $old_url );

		$node = array(
			'id'    => 'wpseo-premium-create-redirect',
			'title' => __( 'Create Redirect', 'wordpress-seo-premium' ),
			'href'  => admin_url( 'admin.php?page=wpseo_redirects&old_url=' . $old_url ),
		);
		$wp_admin_bar->add_menu( $node );
	}

	/**
	 * Add page analysis to array with variable array key patterns
	 *
	 * @param array $patterns Array with patterns for page analysis.
	 *
	 * @return array
	 */
	public function add_variable_array_key_pattern( $patterns ) {
		if ( true !== in_array( 'page-analyse-extra-', $patterns, true ) ) {
			$patterns[] = 'page-analyse-extra-';
		}

		return $patterns;
	}

	/**
	 * This hook will add an input-field for specifying custom fields for page analysis.
	 *
	 * The values will be comma-separated and will target the belonging field in the post_meta. Page analysis will
	 * use the content of it by sticking it to the post_content.
	 *
	 * @param array  $wpseo_admin_pages Unused. Array with admin pages.
	 * @param string $name              The name for the text input field.
	 */
	public function admin_page_meta_post_types_checkboxes( $wpseo_admin_pages, $name ) {
		Yoast_Form::get_instance()->textinput( 'page-analyse-extra-' . $name, __( 'Add custom fields to page analysis', 'wordpress-seo-premium' ) );
	}

	/**
	 * Function adds the premium pages to the Yoast SEO menu
	 *
	 * @param array $submenu_pages Array with the configuration for the submenu pages.
	 *
	 * @return array
	 */
	public function add_submenu_pages( $submenu_pages ) {
		/**
		 * Filter: 'wpseo_premium_manage_redirects_role' - Change the minimum rule to access and change the site redirects
		 *
		 * @api string wpseo_manage_redirects
		 */
		$submenu_pages[] = array(
			'wpseo_dashboard',
			'',
			__( 'Redirects', 'wordpress-seo-premium' ),
			'wpseo_manage_redirects',
			'wpseo_redirects',
			array( $this->redirects, 'display' ),
		);

		return $submenu_pages;
	}

	/**
	 * Change premium indicator to green when premium is enabled
	 *
	 * @param string[] $classes The current classes for the indicator.
	 * @returns string[] The new classes for the indicator.
	 */
	public function change_premium_indicator( $classes ) {
		$class_no = array_search( 'wpseo-premium-indicator--no', $classes, true );

		if ( false !== $class_no ) {
			unset( $classes[ $class_no ] );

			$classes[] = 'wpseo-premium-indicator--yes';
		}

		return $classes;
	}

	/**
	 * Replaces the screen reader text for the premium indicator.
	 *
	 * @param string $text The original text.
	 * @return string The new text.
	 */
	public function change_premium_indicator_text( $text ) {
		return __( 'Enabled', 'wordpress-seo-premium' );
	}

	/**
	 * Register the premium settings
	 */
	public function register_settings() {
		register_setting( 'yoast_wpseo_redirect_options', 'wpseo_redirect' );
	}

	/**
	 * Output admin css in admin head
	 */
	public function admin_css() {
		echo "<style type='text/css'>#wpseo_content_top{ padding-left: 0; margin-left: 0; }</style>";
	}

	/**
	 * Load textdomain
	 */
	private function load_textdomain() {
		load_plugin_textdomain( 'wordpress-seo-premium', false, dirname( plugin_basename( WPSEO_FILE ) ) . '/premium/languages/' );
	}

	/**
	 * Initializes the helpscout support modal for wpseo settings pages
	 */
	public function init_helpscout_support() {
		$page      = filter_input( INPUT_GET, 'page' );
		$query_var = '';
		if ( isset( $page ) && $page !== false ) {
			$query_var = $page;
		}

		$is_beacon_page = in_array( strtolower( $query_var ), $this->get_beacon_pages(), true );

		// Only add the helpscout beacon on Yoast SEO pages.
		if ( WPSEO_Metabox::is_post_edit( $GLOBALS['pagenow'] ) || $is_beacon_page ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_contact_support' ) );

			$beacon = yoast_get_helpscout_beacon( $query_var, 'no_search' );
			$beacon->add_setting( new WPSEO_Premium_Beacon_Setting() );
			$beacon->register_hooks();
		}
	}

	/**
	 * Get the pages the Premium beacon should be displayed on
	 *
	 * @return array
	 */
	private function get_beacon_pages() {
		return array(
			'wpseo_dashboard',
			'wpseo_titles',
			'wpseo_social',
			'wpseo_xml',
			'wpseo_advanced',
			'wpseo_tools',
			'wpseo_search_console',
			'wpseo_licenses',
		);
	}

	/**
	 * Add the Yoast contact support assets
	 */
	public function enqueue_contact_support() {
		wp_enqueue_script( 'yoast-contact-support' );
	}

	/**
	 * Initializes the tracking class, for sending data.
	 *
	 * @return void
	 */
	public function initialize_tracking() {
		global $pagenow;

		/**
		 * Filter: 'wpseo_disable_tracking' - Disables the data tracking of Yoast SEO Premium.
		 *
		 * @api string $is_disabled The disabled state. Default is false.
		 */
		if ( apply_filters( 'wpseo_disable_tracking', false ) === true ) {
			return;
		}

		// Because we don't want to possibly block plugin actions with our routines.
		if ( in_array( $pagenow, array( 'plugins.php', 'plugin-install.php', 'plugin-editor.php' ), true ) ) {
			return;
		}

		// $tracker = new WPSEO_Tracking( 'https://search-yoast-poc-gdaxpa7udbwtvpgxqaufa3dejm.eu-central-1.es.amazonaws.com/yoast/tracking', ( WEEK_IN_SECONDS * 2 ) );
		// $tracker->send();
	}

	/**
	 * Adds multi keyword functionality if we are on the correct pages.
	 *
	 * @deprecated 8.4
	 * @codeCoverageIgnore
	 */
	public function enqueue_multi_keyword() {
		_deprecated_function( 'WPSEO_Premium::enqueue_multi_keyword', '8.4' );
	}

	/**
	 * Loads the autoloader
	 *
	 * @deprecated 9.4
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public static function autoloader() {
		_deprecated_function( __METHOD__, '9.4' );
	}

	/**
	 * Adds multi keyword functionality if we are on the correct pages
	 *
	 * @deprecated 9.4
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function enqueue_social_previews() {
		_deprecated_function( 'WPSEO_Premium::enqueue_social_previews', '9.4' );
	}
}
