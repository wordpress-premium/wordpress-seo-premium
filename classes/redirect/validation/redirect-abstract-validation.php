<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Base class for validating redirects
 */
abstract class WPSEO_Redirect_Abstract_Validation implements WPSEO_Redirect_Validation {

	/**
	 * The validation error.
	 *
	 * @var WPSEO_Validation_Result
	 */
	private $error = null;

	/**
	 * Returns the validation error.
	 *
	 * @return WPSEO_Validation_Result|null
	 */
	public function get_error() {
		return $this->error;
	}

	/**
	 * Sets the validation error.
	 *
	 * @param WPSEO_Validation_Result $error Validation error or warning.
	 *
	 * @return void
	 */
	protected function set_error( WPSEO_Validation_Result $error ) {
		$this->error = $error;
	}
}
