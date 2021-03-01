<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Validates the uniqueness of a redirect.
 */
class WPSEO_Redirect_Uniqueness_Validation extends WPSEO_Redirect_Abstract_Validation {

	/**
	 * Validates if the redirect already exists as a redirect.
	 *
	 * @param WPSEO_Redirect      $redirect     The redirect to validate.
	 * @param WPSEO_Redirect|null $old_redirect The old redirect to compare.
	 * @param array|null          $redirects    Array with redirect to validate against.
	 *
	 * @return bool
	 */
	public function run( WPSEO_Redirect $redirect, WPSEO_Redirect $old_redirect = null, array $redirects = null ) {

		// Remove uniqueness validation when old origin is the same as the current one.
		if ( is_a( $old_redirect, 'WPSEO_Redirect' ) && $redirect->get_origin() === $old_redirect->get_origin() ) {
			return true;
		}

		if ( array_key_exists( $redirect->get_origin(), $redirects ) ) {
			$this->set_error(
				new WPSEO_Validation_Error(
					__( 'The old URL already exists as a redirect.', 'wordpress-seo-premium' ),
					'origin'
				)
			);

			return false;
		}

		return true;
	}
}
