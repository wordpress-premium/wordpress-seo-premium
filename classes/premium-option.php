<?php // phpcs:ignore Yoast.Files.FileName.InvalidClassFileName
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Represents the premium option.
 */
class WPSEO_Premium_Option extends WPSEO_Option {

	/**
	 * Option name.
	 *
	 * @var string
	 */
	public $option_name = 'wpseo_premium';

	/**
	 * Array of defaults for the option.
	 *
	 * {@internal Shouldn't be requested directly, use $this->get_defaults();}}
	 *
	 * @var array
	 */
	protected $defaults = [
		// Form fields.
		'prominent_words_indexing_completed' => null,
		'workouts'                           => [ 'cornerstone' => [ 'finishedSteps' => [] ] ],
		'should_redirect_after_install'      => false,
		'activation_redirect_timestamp'      => 0,
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
	 * @return array The clean option value.
	 */
	protected function validate_option( $dirty, $clean, $old ) {
		foreach ( $clean as $key => $value ) {
			switch ( $key ) {
				case 'prominent_words_indexing_completed':
					if ( isset( $dirty[ $key ] ) && $dirty[ $key ] !== null ) {
						$clean[ $key ] = WPSEO_Utils::validate_bool( $dirty[ $key ] );
					}

					break;
				case 'workouts':
					if ( isset( $dirty[ $key ] ) && is_array( $dirty[ $key ] ) ) {
						$clean[ $key ] = $dirty[ $key ];
					}
					break;
				case 'should_redirect_after_install':
					if ( isset( $dirty[ $key ] ) && is_bool( $dirty[ $key ] ) ) {
						$clean[ $key ] = $dirty[ $key ];
					}
					break;
				case 'activation_redirect_timestamp':
					if ( isset( $dirty[ $key ] ) && is_int( $dirty[ $key ] ) ) {
						$clean[ $key ] = $dirty[ $key ];
					}
					break;
			}
		}

		return $clean;
	}
}
