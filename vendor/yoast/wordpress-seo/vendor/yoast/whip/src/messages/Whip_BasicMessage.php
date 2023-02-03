<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Class Whip_Message.
 */
class Whip_BasicMessage implements Whip_Message {

	/**
	 * Message body.
	 *
	 * @var string
	 */
	private $body;

	/**
	 * Whip_Message constructor.
	 *
	 * @param string $body Message body.
	 */
	public function __construct( $body ) {
		$this->validateParameters( $body );

		$this->body = $body;
	}

	/**
	 * Retrieves the message body.
	 *
	 * @return string Message.
	 */
	public function body() {
		return $this->body;
	}

	/**
	 * Validates the parameters passed to the constructor of this class.
	 *
	 * @param string $body Message body.
	 *
	 * @throws Whip_EmptyProperty When the $body parameter is empty.
	 * @throws Whip_InvalidType   When the $body parameter is not of the expected type.
	 */
	private function validateParameters( $body ) {
		if ( empty( $body ) ) {
			throw new Whip_EmptyProperty( 'Message body' );
		}

		if ( ! is_string( $body ) ) {
			throw new Whip_InvalidType( 'Message body', $body, 'string' );
		}
	}
}
