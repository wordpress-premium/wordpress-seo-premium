<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Loaders
 */

/**
 * Base class for loading redirects from an external source and validating them.
 */
abstract class WPSEO_Redirect_Abstract_Loader implements WPSEO_Redirect_Loader {

	/**
	 * Validates if the given value is a http status code.
	 *
	 * @param string|int $status_code The status code to validate.
	 *
	 * @return bool Whether or not the status code is valid.
	 */
	protected function validate_status_code( $status_code ) {
		if ( is_string( $status_code ) ) {
			if ( ! preg_match( '/\A\d+\Z/', $status_code, $matches ) ) {
				return false;
			}
			$status_code = (int) $status_code;
		}

		$status_codes = new WPSEO_Redirect_Types();

		return $status_codes->has( $status_code );
	}

	/**
	 * Validates if the given value is a redirect format.
	 *
	 * @param string $format The format to validate.
	 *
	 * @return bool Whether or not the format is valid.
	 */
	protected function validate_format( $format ) {
		$redirect_formats = new WPSEO_Redirect_Formats();

		return $redirect_formats->has( $format );
	}
}
