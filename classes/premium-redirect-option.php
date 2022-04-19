<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Represents the premium redirect option
 */
class WPSEO_Premium_Redirect_Option extends WPSEO_Option {

	/**
	 * Option name.
	 *
	 * @var string
	 */
	public $option_name = 'wpseo_redirect';

	/**
	 * Array of defaults for the option.
	 *
	 * {@internal Shouldn't be requested directly, use $this->get_defaults();}}
	 *
	 * @var array
	 */
	protected $defaults = [
		// Form fields.
		'disable_php_redirect' => 'off',
		'separate_file'        => 'off',
	];

	/**
	 * Registers the option to the WPSEO Options framework.
	 */
	public static function register_option() {
		WPSEO_Options::register_option( static::get_instance() );
	}

	/**
	 * Get the singleton instance of this class.
	 *
	 * @return static Returns instance of itself.
	 */
	public static function get_instance() {
		if ( ! ( static::$instance instanceof static ) ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * All concrete classes must contain a validate_option() method which validates all
	 * values within the option.
	 *
	 * @param array $dirty New value for the option.
	 * @param array $clean Clean value for the option, normally the defaults.
	 * @param array $old   Old value of the option.
	 *
	 * @return array The clean option with the saved value.
	 */
	protected function validate_option( $dirty, $clean, $old ) {

		foreach ( $clean as $key => $value ) {
			switch ( $key ) {
				case 'disable_php_redirect':
				case 'separate_file':
					if ( isset( $dirty[ $key ] ) && in_array( $dirty[ $key ], [ 'on', 'off' ], true ) ) {
						$clean[ $key ] = $dirty[ $key ];
					}
					break;
			}
		}

		return $clean;
	}
}
