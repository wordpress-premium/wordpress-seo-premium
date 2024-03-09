<?php

namespace Yoast\WP\SEO\Premium\Initializers;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Initializers\Initializer_Interface;

/**
 * Index_Now_Key class
 */
class Index_Now_Key implements Initializer_Interface {

	use No_Conditionals;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * Holds the IndexNow key.
	 *
	 * @var string
	 */
	private $key;

	/**
	 * Index_Now_Key initializer constructor.
	 *
	 * @param Options_Helper $options_helper The option helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		$this->options_helper = $options_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function initialize() {
		\add_action( 'init', [ $this, 'add_rewrite_rule' ], 1 );
		\add_action( 'plugins_loaded', [ $this, 'load' ], 15 );
	}

	/**
	 * Loads the integration.
	 *
	 * @return void
	 */
	public function load() {
		if ( $this->options_helper->get( 'enable_index_now' ) === false ) {
			return;
		}

		$this->key = $this->options_helper->get( 'index_now_key' );
		if ( $this->key === '' ) {
			$this->generate_key();
		}
		\add_action( 'wp', [ $this, 'output_key' ], 0 );
	}

	/**
	 * Adds the rewrite rule for the IndexNow key txt file.
	 *
	 * @return void
	 */
	public function add_rewrite_rule() {
		if ( $this->options_helper->get( 'enable_index_now' ) !== true ) {
			return;
		}
		global $wp;

		$wp->add_query_var( 'yoast_index_now_key' );
		\add_rewrite_rule( '^yoast-index-now-([a-zA-Z0-9-]+)\.txt$', 'index.php?yoast_index_now_key=$matches[1]', 'top' );
	}

	/**
	 * Outputs the key when it matches the key in the database.
	 *
	 * @return void
	 */
	public function output_key() {
		$key_in_url = \get_query_var( 'yoast_index_now_key' );
		if ( empty( $key_in_url ) ) {
			return;
		}

		if ( $key_in_url === $this->key ) {
			// Remove all headers.
			\header_remove();
			// Only send plain text header.
			\header( 'Content-Type: text/plain;charset=UTF-8' );
			echo \esc_html( $this->key );
			die;
		}

		// Trying keys? Good luck.
		global $wp_query;
		$wp_query->set_404();
	}

	/**
	 * Generates an IndexNow key.
	 *
	 * Adapted from wp_generate_password to include dash (-) and not be filtered.
	 *
	 * @return void
	 */
	private function generate_key() {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-';

		for ( $i = 0; $i < 100; $i++ ) {
			$this->key .= \substr( $chars, \wp_rand( 0, ( \strlen( $chars ) - 1 ) ), 1 );
		}
		$this->options_helper->set( 'index_now_key', $this->key );
	}
}
