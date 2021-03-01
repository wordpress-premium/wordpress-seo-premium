<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Registers the premium WordPress implementation of Google Search Console.
 *
 * @deprecated 12.5
 *
 * @codeCoverageIgnore
 */
class WPSEO_Premium_GSC implements WPSEO_WordPress_Integration {

	/**
	 * Registers all hooks to WordPress
	 *
	 * @deprecated 12.5
	 *
	 * @codeCoverageIgnore
	 */
	public function register_hooks() {
		_deprecated_function( __METHOD__, 'WPSEO 12.5' );
	}

	/**
	 * Enqueues site wide analysis script
	 *
	 * @deprecated 12.5
	 *
	 * @codeCoverageIgnore
	 */
	public function enqueue() {
		_deprecated_function( __METHOD__, 'WPSEO 12.5' );
	}
}
