<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

use Yoast\WP\SEO\Premium\Initializers\Redirect_Handler;

/**
 * WPSEO_Redirect_Handler class
 *
 * @deprecated 16.0
 */
class WPSEO_Redirect_Handler extends Redirect_Handler {

	/**
	 * Constructor to throw deprecation notice.
	 *
	 * @deprecated 16.0
	 * @codeCoverageIgnore
	 */
	public function __construct() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 16.0', esc_html( Redirect_Handler::class ) );
	}

	/**
	 * Loads the redirect handler.
	 *
	 * @deprecated 16.0
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function load() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 16.0', esc_html( Redirect_Handler::class . '::initialize' ) );
		$this->initialize();
	}
}
