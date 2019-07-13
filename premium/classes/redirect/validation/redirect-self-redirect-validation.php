<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Validator for validating that the redirect doesn't point to itself.
 */
class WPSEO_Redirect_Self_Redirect_Validation extends WPSEO_Redirect_Abstract_Validation {

	/**
	 * Validate the redirect to check if it doesn't point to itself.
	 *
	 * @param WPSEO_Redirect $redirect     The redirect to validate.
	 * @param WPSEO_Redirect $old_redirect The old redirect to compare.
	 * @param array          $redirects    Array with redirect to validate against.
	 *
	 * @return bool
	 */
	public function run( WPSEO_Redirect $redirect, WPSEO_Redirect $old_redirect = null, array $redirects = null ) {

		if ( $redirect->get_origin() === $redirect->get_target() ) {
			$error = __( 'You are attempting to redirect to the same URL as the origin. Please choose a different URL to redirect to.', 'wordpress-seo-premium' );
			$this->set_error( new WPSEO_Validation_Error( $error, 'origin' ) );

			return false;
		}

		return true;
	}
}
