<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Class Whip_HostMessage.
 */
class Whip_HostMessage implements Whip_Message {

	/**
	 * Text domain to use for translations.
	 *
	 * @var string
	 */
	private $textdomain;

	/**
	 * The environment key to use to retrieve the message from.
	 *
	 * @var string
	 */
	private $messageKey;

	/**
	 * Whip_Message constructor.
	 *
	 * @param string $messageKey The environment key to use to retrieve the message from.
	 * @param string $textdomain The text domain to use for translations.
	 */
	public function __construct( $messageKey, $textdomain ) {
		$this->textdomain = $textdomain;
		$this->messageKey = $messageKey;
	}

	/**
	 * Retrieves the message body.
	 *
	 * @return string The message body.
	 */
	public function body() {
		$message = array();

		$message[] = Whip_MessageFormatter::strong( $this->title() ) . '<br />';
		$message[] = Whip_MessageFormatter::paragraph( Whip_Host::message( $this->messageKey ) );

		return implode( "\n", $message );
	}

	/**
	 * Renders the message title.
	 *
	 * @return string The message title.
	 */
	public function title() {
		/* translators: 1: name. */
		return sprintf( __( 'A message from %1$s', $this->textdomain ), Whip_Host::name() );
	}
}
