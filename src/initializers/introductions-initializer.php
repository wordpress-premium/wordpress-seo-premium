<?php

namespace Yoast\WP\SEO\Premium\Initializers;

use Yoast\WP\SEO\Helpers\Current_Page_Helper;
use Yoast\WP\SEO\Initializers\Initializer_Interface;
use Yoast\WP\SEO\Introductions\Application\Current_Page_Trait;
use Yoast\WP\SEO\Introductions\Domain\Introduction_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Yoast_Admin_Or_Introductions_Route_Conditional;

/**
 * Initializes Premium introductions.
 */
class Introductions_Initializer implements Initializer_Interface {

	use Current_Page_Trait;

	public const SCRIPT_HANDLE = 'wp-seo-premium-introductions';

	/**
	 * Holds the current page helper.
	 *
	 * @var Current_Page_Helper
	 */
	private $current_page_helper;

	/**
	 * Holds the introductions.
	 *
	 * @var Introduction_Interface
	 */
	private $introductions;

	/**
	 * Constructs the new features integration.
	 *
	 * @param Current_Page_Helper    $current_page_helper The current page helper.
	 * @param Introduction_Interface ...$introductions    The introductions.
	 */
	public function __construct( Current_Page_Helper $current_page_helper, Introduction_Interface ...$introductions ) {
		$this->current_page_helper = $current_page_helper;
		$this->introductions       = $introductions;
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * In this case: when on an admin page.
	 *
	 * @return array<string>
	 */
	public static function get_conditionals() {
		return [ Yoast_Admin_Or_Introductions_Route_Conditional::class ];
	}

	/**
	 * Registers the action to enqueue the needed script(s).
	 *
	 * @return void
	 */
	public function initialize() {
		if ( $this->is_on_installation_page() ) {
			return;
		}

		\add_filter( 'wpseo_introductions', [ $this, 'add_introductions' ] );
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Adds the Premium introductions.
	 *
	 * @param Introduction_Interface[] $introductions The introductions.
	 *
	 * @return array The merged introductions.
	 */
	public function add_introductions( $introductions ) {
		// Safety check and bail.
		if ( ! \is_array( $introductions ) ) {
			return $introductions;
		}

		return \array_merge( $introductions, $this->introductions );
	}

	/**
	 * Enqueue the workouts app.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		\wp_enqueue_script( self::SCRIPT_HANDLE );
		\wp_localize_script(
			self::SCRIPT_HANDLE,
			'wpseoPremiumIntroductions',
			[
				'pluginUrl' => \plugins_url( '', \WPSEO_PREMIUM_FILE ),
			]
		);
	}
}
