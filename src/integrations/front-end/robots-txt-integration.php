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
	 * Instantiates the `robots.txt` integration.
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
		if ( \is_multisite() ) {
			return;
		}

		if ( $this->options_helper->get( 'deny_ccbot_crawling' ) ) {
			\add_action( 'Yoast\WP\SEO\register_robots_rules', [ $this, 'add_disallow_ccbot' ], 10, 1 );
		}
		if ( $this->options_helper->get( 'deny_google_extended_crawling' ) ) {
			\add_action( 'Yoast\WP\SEO\register_robots_rules', [ $this, 'add_disallow_google_extended_bot' ], 10, 1 );
		}
		if ( $this->options_helper->get( 'deny_gptbot_crawling' ) ) {
			\add_action( 'Yoast\WP\SEO\register_robots_rules', [ $this, 'add_disallow_gptbot' ], 10, 1 );
		}
	}

	/**
	 * Add a disallow rule for Common Crawl CCBot agents to `robots.txt`.
	 *
	 * @param Robots_Txt_Helper $robots_txt_helper The Robots_Txt_Helper.
	 *
	 * @return void
	 */
	public function add_disallow_ccbot( Robots_Txt_Helper $robots_txt_helper ) {
		$robots_txt_helper->add_disallow( 'CCBot', '/' );
	}

	/**
	 * Add a disallow rule for Google-Extended agents to `robots.txt`.
	 *
	 * @param Robots_Txt_Helper $robots_txt_helper The Robots_Txt_Helper.
	 *
	 * @return void
	 */
	public function add_disallow_google_extended_bot( Robots_Txt_Helper $robots_txt_helper ) {
		$robots_txt_helper->add_disallow( 'Google-Extended', '/' );
	}

	/**
	 * Add a disallow rule for OpenAI GPTBot agents to `robots.txt`.
	 *
	 * @param Robots_Txt_Helper $robots_txt_helper The Robots_Txt_Helper.
	 *
	 * @return void
	 */
	public function add_disallow_gptbot( Robots_Txt_Helper $robots_txt_helper ) {
		$robots_txt_helper->add_disallow( 'GPTBot', '/' );
	}
}
