<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Represents a premium Google Search Console modal.
 *
 * @deprecated 12.5
 *
 * @codeCoverageIgnore
 */
class WPSEO_Premium_GSC_Modal {

	const EXISTING_REDIRECT_HEIGHT = 160;
	const CREATE_REDIRECT_HEIGHT   = 380;

	/**
	 * Constructor, sets the redirect manager instance.
	 *
	 * @deprecated 12.5
	 *
	 * @codeCoverageIgnore
	 */
	public function __construct() {
		_deprecated_function( __METHOD__, 'WPSEO 12.5' );
	}

	/**
	 * Returns a GSC modal for the given URL.
	 *
	 * @deprecated 12.5
	 *
	 * @codeCoverageIgnore
	 *
	 * @param string $url The URL to get the modal for.
	 *
	 * @return null
	 */
	public function show( $url ) {
		_deprecated_function( __METHOD__, 'WPSEO 12.5' );

		return null;
	}
}
