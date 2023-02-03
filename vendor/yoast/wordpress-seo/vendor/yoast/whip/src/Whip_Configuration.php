<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Class Whip_Configuration.
 */
class Whip_Configuration {

	/**
	 * The configuration to use.
	 *
	 * @var array
	 */
	private $configuration;

	/**
	 * Whip_Configuration constructor.
	 *
	 * @param array $configuration The configuration to use.
	 *
	 * @throws Whip_InvalidType When the $configuration parameter is not of the expected type.
	 */
	public function __construct( $configuration = array() ) {
		if ( ! is_array( $configuration ) ) {
			throw new Whip_InvalidType( 'Configuration', $configuration, 'array' );
		}

		$this->configuration = $configuration;
	}

	/**
	 * Retrieves the configured version of a particular requirement.
	 *
	 * @param Whip_Requirement $requirement The requirement to check.
	 *
	 * @return string|int The version of the passed requirement that was detected as a string.
	 *                    If the requirement does not exist, this returns int -1.
	 */
	public function configuredVersion( Whip_Requirement $requirement ) {
		if ( ! $this->hasRequirementConfigured( $requirement ) ) {
			return -1;
		}

		return $this->configuration[ $requirement->component() ];
	}

	/**
	 * Determines whether the passed requirement is present in the configuration.
	 *
	 * @param Whip_Requirement $requirement The requirement to check.
	 *
	 * @return bool Whether or not the requirement is present in the configuration.
	 */
	public function hasRequirementConfigured( Whip_Requirement $requirement ) {
		return array_key_exists( $requirement->component(), $this->configuration );
	}
}
