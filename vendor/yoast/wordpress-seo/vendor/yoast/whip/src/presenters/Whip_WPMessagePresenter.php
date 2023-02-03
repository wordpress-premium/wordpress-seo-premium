<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * A message presenter to show a WordPress notice.
 */
class Whip_WPMessagePresenter implements Whip_MessagePresenter {

	/**
	 * The string to show to dismiss the message.
	 *
	 * @var string
	 */
	private $dismissMessage;

	/**
	 * The message to be displayed.
	 *
	 * @var Whip_Message
	 */
	private $message;

	/**
	 * Dismisser object.
	 *
	 * @var Whip_MessageDismisser
	 */
	private $dismisser;

	/**
	 * Whip_WPMessagePresenter constructor.
	 *
	 * @param Whip_Message          $message        The message to use in the presenter.
	 * @param Whip_MessageDismisser $dismisser      Dismisser object.
	 * @param string                $dismissMessage The copy to show to dismiss the message.
	 */
	public function __construct( Whip_Message $message, Whip_MessageDismisser $dismisser, $dismissMessage ) {
		$this->message        = $message;
		$this->dismisser      = $dismisser;
		$this->dismissMessage = $dismissMessage;
	}

	/**
	 * Registers hooks to WordPress.
	 *
	 * This is a separate function so you can control when the hooks are registered.
	 */
	public function registerHooks() {
		add_action( 'admin_notices', array( $this, 'renderMessage' ) );
	}

	/**
	 * Registers hooks to WordPress.
	 *
	 * @deprecated 1.2.0 Use the Whip_WPMessagePresenter::registerHooks() method instead.
	 * @codeCoverageIgnore
	 * @phpcs:disable Generic.NamingConventions.CamelCapsFunctionName
	 */
	public function register_hooks() {
		// phpcs:enable
		self::registerHooks();
	}

	/**
	 * Renders the messages present in the global to notices.
	 */
	public function renderMessage() {
		$dismissListener = new Whip_WPMessageDismissListener( $this->dismisser );
		$dismissListener->listen();

		if ( $this->dismisser->isDismissed() ) {
			return;
		}

		$dismissButton = sprintf(
			'<a href="%2$s">%1$s</a>',
			esc_html( $this->dismissMessage ),
			esc_url( $dismissListener->getDismissURL() )
		);

		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- output correctly escaped directly above and in the `kses()` method.
		printf(
			'<div class="error"><p>%1$s</p><p>%2$s</p></div>',
			$this->kses( $this->message->body() ),
			$dismissButton
		);
		// phpcs:enable
	}

	/**
	 * Removes content from the message that we don't want to show.
	 *
	 * @param string $message The message to clean.
	 *
	 * @return string The cleaned message.
	 */
	public function kses( $message ) {
		return wp_kses(
			$message,
			array(
				'a'      => array(
					'href'   => true,
					'target' => true,
				),
				'strong' => true,
				'p'      => true,
				'ul'     => true,
				'li'     => true,
			)
		);
	}
}
