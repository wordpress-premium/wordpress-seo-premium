<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Validates if the origin is a relative URL.
 */
class WPSEO_Redirect_Relative_Origin_Validation extends WPSEO_Redirect_Abstract_Validation {

	/**
	 * Validate the redirect to check if the origin URL is relative.
	 *
	 * @param WPSEO_Redirect      $redirect     The redirect to validate.
	 * @param WPSEO_Redirect|null $old_redirect The old redirect to compare.
	 * @param array|null          $redirects    Array with redirects to validate against.
	 *
	 * @return bool True if the redirect is valid, false otherwise.
	 */
	public function run( WPSEO_Redirect $redirect, WPSEO_Redirect $old_redirect = null, array $redirects = null ) {
		if ( WPSEO_Redirect_Util::is_relative_url( $redirect->get_origin() ) ) {
			return true;
		}

		$error = __( 'The old URL for your redirect is not relative. Only the new URL is allowed to be absolute. Make sure to provide a relative old URL.', 'wordpress-seo-premium' );
		$this->set_error( new WPSEO_Validation_Warning( $error, 'origin' ) );
		return false;
	}
}
