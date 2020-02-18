<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Admin\Notifiers
 */

/**
 * Represents the logic for showing the recalibration beta notice.
 *
 * @deprecated 10.0
 */
class WPSEO_Premium_Stale_Cornerstone_Content_Notification implements WPSEO_WordPress_Integration {

	/**
	 * The name of the notifier.
	 *
	 * @var string
	 */
	protected $notification_identifier = 'stale-content-notification';

	/**
	 * Class constructor.
	 *
	 * @deprecated 10.0
	 *
	 * @codeCoverageIgnore
	 */
	public function __construct() {
		_deprecated_constructor( 'WPSEO_Premium_Stale_Cornerstone_Content_Notification', '10.0' );
	}

	/**
	 * Registers all hooks to WordPress
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'admin_init', [ $this, 'handle_notice' ], 15 );
	}

	/**
	 * Shows the notification when applicable.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void.
	 */
	public function handle_notice() {
		if ( $this->show_notice( WPSEO_Options::get( 'enable_cornerstone_content' ) ) ) {
			$this->get_notification_center()->add_notification(
				$this->get_notification()
			);

			return;
		}

		$this->get_notification_center()->remove_notification_by_id( 'wpseo-' . $this->notification_identifier );
	}

	/**
	 * Returns the notification.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return Yoast_Notification The notification for the notification center.
	 */
	protected function get_notification() {
		$message  = $this->get_notification_message( WPSEO_Post_Type::get_accessible_post_types() );
		$message .= ' ';
		$message .= sprintf(
			/* translators: 1: Opening link tag to an article about stale content, 2: closing tag */
			esc_html__(
				'Read more about %1$swhy you should always keep your cornerstone content up-to-date%2$s.',
				'wordpress-seo-premium'
			),
			'<a href="' . WPSEO_Shortlinker::get( 'https://yoa.st/stale-content-filter' ) . '" target="_blank">',
			'</a>'
		);

		$notification_options = [
			'type'         => Yoast_Notification::WARNING,
			'id'           => 'wpseo-' . $this->notification_identifier,
			'priority'     => 1.0,
			'capabilities' => 'wpseo_manage_options',
		];

		return new Yoast_Notification( $message, $notification_options );
	}

	/**
	 * Generates the notification message based on the available post type.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param array $post_types The accessible post types.
	 *
	 * @return string The notification message.
	 */
	protected function get_notification_message( array $post_types ) {
		if ( array_key_exists( 'post', $post_types ) ) {
			return sprintf(
				/* translators: 1: Opening link tag to the post overview, 2: closing tag */
				esc_html__(
					'In this beta, we introduce a stale cornerstone content filter. You can find it %1$son the post overview%2$s. This functionality is also available for other content types.',
					'wordpress-seo-premium'
				),
				'<a href="' . admin_url( 'edit.php' ) . '">',
				'</a>'
			);
		}

		if ( array_key_exists( 'page', $post_types ) ) {
			return sprintf(
				/* translators: 1: Opening link tag to the page overview, 2: closing tag */
				esc_html__(
					'In this beta, we introduce a stale cornerstone content filter. You can find it %1$son the page overview%2$s. This functionality is also available for other content types.',
					'wordpress-seo-premium'
				),
				'<a href="' . admin_url( 'edit.php?post_type=page' ) . '">',
				'</a>'
			);
		}

		return esc_html__(
			'In this beta, we introduce a stale cornerstone content filter. You can find it on content type overviews.',
			'wordpress-seo-premium'
		);
	}

	/**
	 * Determines if the notice should be shown.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param bool $is_cornerstone_content_enabled Is the cornerstone content enabled.
	 *
	 * @return bool True when a notice should be shown.
	 */
	protected function show_notice( $is_cornerstone_content_enabled ) {
		return $is_cornerstone_content_enabled;
	}

	/**
	 * Retrieves an instance of the notification center.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return Yoast_Notification_Center Instance of the notification center.
	 */
	protected function get_notification_center() {
		return Yoast_Notification_Center::get();
	}
}
