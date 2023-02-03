<?php

namespace Yoast\WP\SEO\Premium\Integrations\Front_End;

use Yoast\WP\SEO\Conditionals\Robots_Txt_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Robots_Txt_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Handles adding the rules to `robots.txt`.
 */
class Robots_Txt_Integration implements Integration_Interface {

	/**
	 * Holds the options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

	/**
	 * Sets the helpers.
	 *
	 * @param Options_Helper $options_helper Options helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		$this->options_helper = $options_helper;
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Robots_Txt_Conditional::class ];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( $this->options_helper->get( 'deny_search_crawling' ) && ! \is_multisite() ) {
			\add_action( 'Yoast\WP\SEO\register_robots_rules', [ $this, 'add_disallow_search_to_robots' ], 10, 1 );
		}
		if ( $this->options_helper->get( 'deny_wp_json_crawling' ) && ! \is_multisite() ) {
			\add_action( 'Yoast\WP\SEO\register_robots_rules', [ $this, 'add_disallow_wp_json_to_robots' ], 10, 1 );
		}
	}

	/**
	 * Add a disallow rule for search to robots.txt.
	 *
	 * @param Robots_Txt_Helper $robots_txt_helper The robots txt helper.
	 *
	 * @return void
	 */
	public function add_disallow_search_to_robots( Robots_Txt_Helper $robots_txt_helper ) {
		$robots_txt_helper->add_disallow( '*', '/?s=' );
		$robots_txt_helper->add_disallow( '*', '/search/' );
	}

	/**
	 * Add a disallow rule for /wp-json/ to robots.txt.
	 *
	 * @param Robots_Txt_Helper $robots_txt_helper The robots txt helper.
	 *
	 * @return void
	 */
	public function add_disallow_wp_json_to_robots( Robots_Txt_Helper $robots_txt_helper ) {
		$robots_txt_helper->add_disallow( '*', '/wp-json/' );
		$robots_txt_helper->add_disallow( '*', '/?rest_route=' );
	}
}
