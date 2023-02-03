<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Class EmptyProperty.
 */
class Whip_EmptyProperty extends Exception {

	/**
	 * EmptyProperty constructor.
	 *
	 * @param string $property Property name.
	 */
	public function __construct( $property ) {
		parent::__construct( sprintf( '%s cannot be empty.', (string) $property ) );
	}
}
