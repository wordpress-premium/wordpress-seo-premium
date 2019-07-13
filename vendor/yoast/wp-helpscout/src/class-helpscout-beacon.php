<?php
/**
 * @package Yoast\WPHelpScout
 */

/**
 * This class adds the helpscout beacon by hooking on admin_footer.
 */
class Yoast_HelpScout_Beacon {

	const YST_SEO_SUPPORT_IDENTIFY = 'yst_seo_support_identify';
	const BEACON_TYPE_NO_SEARCH = 'no_search';
	const BEACON_TYPE_SEARCH = 'search';

	/**
	 * @var string The current opened page without the prefix.
	 */
	private $current_page = '';

	/**
	 * @var Yoast_HelpScout_Beacon_Identifier
	 */
	protected $identifier;

	/**
	 * @var Yoast_HelpScout_Beacon_Setting[]
	 */
	protected $settings;

	/** @var string The type of beacon (BEACON_TYPE_NO_SEARCH | BEACON_TYPE_SEARCH) */
	protected $type;

	/**
	 * Setting the hook to load the beacon
	 *
	 * @param string                           $current_page The current opened page without the prefix.
	 * @param Yoast_HelpScout_Beacon_Setting[] $settings     Suggestions for the admin pages.
	 * @param string                           $type         The type of beacon to create. (BEACON_TYPE_NO_SEARCH | BEACON_TYPE_SEARCH)
	 */
	public function __construct( $current_page, array $settings, $type = self::BEACON_TYPE_SEARCH ) {
		$this->current_page = $current_page;
		$this->settings     = $settings;
		$this->type         = $type;
	}

	/**
	 * Registers WordPress hooks
	 */
	public function register_hooks() {
		add_action( 'admin_footer', array( $this, 'output_beacon_js' ) );
	}

	/**
	 * @param Yoast_HelpScout_Beacon_Setting $setting Setting to add to the helpscout beacon.
	 */
	public function add_setting( Yoast_HelpScout_Beacon_Setting $setting ) {
		$this->settings[] = $setting;
	}

	/**
	 * Outputs a small piece of javascript for the beacon
	 */
	public function output_beacon_js() {
		/** @noinspection PhpUnusedLocalVariableInspection */
		$data = wp_json_encode( $this->localize_beacon() );

		echo '<script type="text/javascript">';
		require dirname( __FILE__ ) . '/yoast-seo-helpscout-beacon.js.php';
		echo '</script>';
	}

	/**
	 * Loads the beacon translations
	 *
	 * @return array
	 */
	private function localize_beacon() {
		return array(
			'config'   => $this->get_config( $this->current_page ),
			'identify' => $this->get_identify(),
			'suggest'  => $this->get_suggest( $this->current_page ),
			'type'     => $this->get_type(),
		);
	}

	/**
	 * Parsing the text for the beacon instructions, this is what the user sees when he is using the beacon
	 *
	 * @return string
	 */
	private function get_instructions() {
		$return  = __( "Please explain what you're trying to find or do. If something isn't working, please explain what you expect to happen. If you can make a screenshot, please attach it.", 'wordpress-seo-premium' );
		$return .= ' ';
		$return .= __( 'Note: submitting this form also sends us debug info about your server.', 'wordpress-seo-premium' );

		return $return;
	}

	/**
	 * Translates the values for the beacon. The array keys are the names of the translateble strings in the beacon.
	 *
	 * @return array
	 */
	private function get_translations() {
		return array(
			'searchLabel'               => __( 'What can we help you with?', 'wordpress-seo-premium' ),
			'searchErrorLabel'          => __( 'Your search timed out. Please double-check your internet connection and try again.', 'wordpress-seo-premium' ),
			'noResultsLabel'            => __( 'No results found for', 'wordpress-seo-premium' ),
			'contactLabel'              => __( 'Send a Message', 'wordpress-seo-premium' ),
			'attachFileLabel'           => __( 'Attach a file', 'wordpress-seo-premium' ),
			'attachFileError'           => __( 'The maximum file size is 10 MB', 'wordpress-seo-premium' ),
			'nameLabel'                 => __( 'Your Name', 'wordpress-seo-premium' ),
			'nameError'                 => __( 'Please enter your name', 'wordpress-seo-premium' ),
			'emailLabel'                => __( 'Email address', 'wordpress-seo-premium' ),
			'emailError'                => __( 'Please enter a valid email address', 'wordpress-seo-premium' ),
			'topicLabel'                => __( 'Select a topic', 'wordpress-seo-premium' ),
			'topicError'                => __( 'Please select a topic from the list', 'wordpress-seo-premium' ),
			'subjectLabel'              => __( 'Subject', 'wordpress-seo-premium' ),
			'subjectError'              => __( 'Please enter a subject', 'wordpress-seo-premium' ),
			'messageLabel'              => __( 'How can we help you?', 'wordpress-seo-premium' ),
			'messageError'              => __( 'Please enter a message', 'wordpress-seo-premium' ),
			'sendLabel'                 => __( 'Send', 'wordpress-seo-premium' ),
			'contactSuccessLabel'       => __( 'Message sent, thank you!', 'wordpress-seo-premium' ),
			'contactSuccessDescription' => __( 'Someone from Team Yoast will get back to you soon, normally within a couple of hours.', 'wordpress-seo-premium' ),
		);
	}

	/**
	 * @param Yoast_Product[] $products The products to build the cache key for.
	 *
	 * @return string
	 */
	private function get_cache_key( array $products ) {
		$products_string = '';

		foreach ( $products as $product ) {
			$products_string .= $product->get_item_name();
		}

		return md5( self::YST_SEO_SUPPORT_IDENTIFY . $products_string );
	}

	/**
	 * Retrieve data to populate the beacon email form
	 *
	 * @return array
	 */
	private function get_identify() {
		$products = $this->get_products( $this->current_page );
		$cache_key = $this->get_cache_key( $products );

		$identify_data = get_transient( $cache_key );
		if ( ! $identify_data ) {
			$identifier = new Yoast_HelpScout_Beacon_Identifier( $this->get_products( $this->current_page ) );
			$identify_data = $identifier->get_data();

			if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
				set_transient( $cache_key, $identify_data, DAY_IN_SECONDS );
			}
		}

		return $identify_data;
	}

	/**
	 * Returns the suggestions for a certain page, or an empty array if there are no suggestions
	 *
	 * @param string $page The admin page the user is on.
	 *
	 * @return array
	 */
	private function get_suggest( $page ) {
		$suggestions = array();

		foreach ( $this->settings as $setting ) {
			$suggestions = array_merge( $suggestions, $setting->get_suggestions( $page ) );
		}

		return $suggestions;
	}

	/**
	 * Returns the products for a certain page, or an empty array if there are no products.
	 *
	 * @param string $page The admin page the user is on.
	 *
	 * @return array
	 */
	private function get_products( $page ) {
		$products = array();

		foreach ( $this->settings as $setting ) {
			$products = array_merge( $products, $setting->get_products( $page ) );
		}

		return $products;
	}

	/**
	 * Returns the type of the beacon.
	 *
	 * @return string
	 */
	private function get_type() {
		return $this->type;
	}

	/**
	 * Returns the configuration for a certain page
	 *
	 * @param string $page The admin page the user is on.
	 *
	 * @return array
	 */
	private function get_config( $page ) {
		// Defaults.
		$config = array(
			'instructions' => $this->get_instructions(),
			'icon'         => 'question',
			'color'        => '#A4286A',
			'poweredBy'    => false,
			'translation'  => $this->get_translations(),
			'showSubject'  => true,
			'zIndex'       => 1000001,
		);

		foreach ( $this->settings as $setting ) {
			if ( method_exists( $setting, 'get_config' ) ) {
				$config = array_merge( $config, $setting->get_config( $page ) );
			}
		}

		return $config;
	}
}
