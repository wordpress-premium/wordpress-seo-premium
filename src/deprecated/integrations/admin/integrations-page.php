<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Integrations_Page class
 *
 * @deprecated 20.7
 * @codeCoverageIgnore
 */
class Integrations_Page implements Integration_Interface {

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * {@inheritDoc}
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 */
	public static function get_conditionals() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		return [ Admin_Conditional::class ];
	}

	/**
	 * Workouts_Integration constructor.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		$this->options_helper = $options_helper;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 */
	public function register_hooks() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );
	}

	/**
	 * Enqueue the workouts app.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );
	}
}
