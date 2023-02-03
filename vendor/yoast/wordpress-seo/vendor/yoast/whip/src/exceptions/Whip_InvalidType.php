<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Class InvalidType.
 */
class Whip_InvalidType extends Exception {

	/**
	 * InvalidType constructor.
	 *
	 * @param string $property     Property name.
	 * @param string $value        Property value.
	 * @param string $expectedType Expected property type.
	 */
	public function __construct( $property, $value, $expectedType ) {
		parent::__construct( sprintf( '%s should be of type %s. Found %s.', $property, $expectedType, gettype( $value ) ) );
	}
}
