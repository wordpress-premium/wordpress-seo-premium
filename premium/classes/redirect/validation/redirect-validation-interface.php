<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Validate interface for the validation classes.
 */
interface WPSEO_Redirect_Validation {

	/**
	 * Validates the redirect.
	 *
	 * @param WPSEO_Redirect $redirect     The redirect to validate.
	 * @param WPSEO_Redirect $old_redirect The old redirect to compare.
	 * @param array          $redirects    Array with redirect to validate against.
	 *
	 * @return bool
	 */
	public function run( WPSEO_Redirect $redirect, WPSEO_Redirect $old_redirect = null, array $redirects = null );

	/**
	 * Returns the validation error.
	 *
	 * @return WPSEO_Validation_Result|null
	 */
	public function get_error();
}
