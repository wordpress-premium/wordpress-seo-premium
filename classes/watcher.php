<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class WPSEO_Watcher
 */
abstract class WPSEO_Watcher {

	/**
	 * The type to watch for.
	 *
	 * @var string
	 */
	protected $watch_type;

	/**
	 * Returns the undo notification text for the given watcher
	 *
	 * @return string
	 */
	abstract protected function get_undo_slug_notification();

	/**
	 * Returns the undo notification text for the given watcher
	 *
	 * @return string
	 */
	abstract protected function get_delete_notification();

	/**
	 * Registers the page scripts.
	 *
	 * @codeCoverageIgnore Method uses WordPress functions.
	 *
	 * @param string $current_page The page that is opened at the moment.
	 *
	 * @return void
	 */
	public function page_scripts( $current_page ) {
		wp_localize_script( 'wp-seo-premium-redirect-notifications', 'wpseoPremiumStrings', WPSEO_Premium_Javascript_Strings::strings() );
		wp_localize_script( 'wp-seo-premium-quickedit-notification', 'wpseoPremiumStrings', WPSEO_Premium_Javascript_Strings::strings() );
	}

	/**
	 * This method checks if it's desirable to create a redirect
	 *
	 * @param string $old_url The old URL.
	 * @param string $new_url The entered new URL.
	 *
	 * @return bool
	 */
	protected function should_create_redirect( $old_url, $new_url ) {

		// Get the site URL.
		$site = wp_parse_url( get_site_url() );

		if ( $old_url !== $new_url && $old_url !== '/' && ( ! isset( $site['path'] ) || ( isset( $site['path'] ) && $old_url !== $site['path'] . '/' ) ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Creates notification with given $message
	 *
	 * This method will also apply filter for $notification_type to determine if notification has to be shown
	 *
	 * @param string      $message           The message that will be added to the notification.
	 * @param string      $notification_type The type of the notification.
	 * @param string|null $id                ID that will be given to the notice.
	 */
	protected function create_notification( $message, $notification_type, $id = null ) {
		$show_notification = true;

		/**
		 * Filter: 'Yoast\WP\SEO\enable_notification_{$watch_type}_{$notification_type}' - Filter whether or
		 * not the notification for a given watch type and notification type should be shown.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 16.5
		 *
		 * @see https://developer.yoast.com/customization/yoast-seo-premium/disabling-automatic-redirects-notifications
		 *
		 * @api bool $show_notification Defaults to true.
		 */
		$show_notification = apply_filters(
			'Yoast\WP\SEO\enable_notification_' . $this->watch_type . '_' . $notification_type,
			$show_notification
		);

		if ( $show_notification ) {
			// Add the message to the notifications center.
			$arguments = [ 'type' => 'updated' ];
			if ( ! empty( $id ) ) {
				$arguments['id'] = $id;
			}

			Yoast_Notification_Center::get()->add_notification( new Yoast_Notification( $message, $arguments ) );
		}
	}

	/**
	 * Display the delete notification.
	 *
	 * @param string $url The redirect that will be deleted.
	 */
	protected function set_delete_notification( $url ) {
		$id = 'wpseo_delete_redirect_' . md5( $url );

		// Format the message.
		$message = sprintf(
			$this->get_delete_notification(),
			'Yoast SEO Premium',
			$this->get_delete_action_list( $url, $id ),
			'<a target="_blank" href="' . WPSEO_Shortlinker::get( 'https://yoa.st/2jd' ) . '">',
			'</a>',
			'<code>' . esc_url( trim( $url ) ) . '</code>'
		);

		$this->create_notification( $message, 'delete' );
	}

	/**
	 * Returns the string to the javascript method from where the added redirect can be undone
	 *
	 * @param int    $object_id   The post or term ID.
	 * @param string $object_type The object type: post or term.
	 *
	 * @return string
	 */
	protected function javascript_undo_redirect( $object_id, $object_type ) {
		return sprintf(
			'wpseoUndoRedirectByObjectId( "%1$s", "%2$s", this );return false;',
			esc_js( $object_id ),
			esc_js( $object_type )
		);
	}

	/**
	 * Opens the redirect manager and create the redirect
	 *
	 * @param string $old_url     The URL that will be redirected.
	 * @param string $new_url     The URL where the old_url redirects to.
	 * @param int    $header_code The redirect type.
	 *
	 * @return WPSEO_Redirect
	 */
	protected function create_redirect( $old_url, $new_url, $header_code = 301 ) {
		// The URL redirect manager.
		$redirect = new WPSEO_Redirect( $old_url, $new_url, $header_code );

		// Create the redirect.
		$this->get_redirect_manager()->create_redirect( $redirect );

		return $redirect;
	}

	/**
	 * Returns the string to the javascript method from where a new redirect can be added
	 *
	 * @param string $url  The URL that can be redirected.
	 * @param string $id   ID of the notice that is displayed.
	 * @param int    $type The redirect type. Default is 301.
	 *
	 * @return string
	 */
	protected function javascript_create_redirect( $url, $id, $type = WPSEO_Redirect_Types::PERMANENT ) {
		return sprintf(
			'wpseoCreateRedirect( "%1$s", "%2$s", "%3$s", this );',
			esc_js( $url ),
			$type,
			wp_create_nonce( 'wpseo-redirects-ajax-security' )
		);
	}

	/**
	 * Return the URL to the admin page where the just added redirect can be found
	 *
	 * @param string $old_url String that filters the wpseo_redirect table to the just added redirect.
	 *
	 * @return string
	 */
	protected function admin_redirect_url( $old_url ) {
		return admin_url( 'admin.php?page=wpseo_redirects&s=' . urlencode( $old_url ) );
	}

	/**
	 * There might be the possibility to undo the redirect, if it is so, we have to notify the user.
	 *
	 * @param string $old_url     The origin URL.
	 * @param string $new_url     The target URL.
	 * @param int    $object_id   The post or term ID.
	 * @param string $object_type The object type: post or term.
	 *
	 * @return WPSEO_Redirect|null The created redirect.
	 */
	protected function notify_undo_slug_redirect( $old_url, $new_url, $object_id, $object_type ) {
		// Check if we should create a redirect.
		if ( $this->should_create_redirect( $old_url, $new_url ) ) {
			$redirect = $this->create_redirect( $old_url, $new_url );

			$this->set_undo_slug_notification( $redirect, $object_id, $object_type );

			return $redirect;
		}
	}

	/**
	 * Display the undo notification
	 *
	 * @param WPSEO_Redirect $redirect    The old URL to the post.
	 * @param int            $object_id   The post or term ID.
	 * @param string         $object_type The object type: post or term.
	 */
	protected function set_undo_slug_notification( WPSEO_Redirect $redirect, $object_id, $object_type ) {
		$old_url = $this->format_redirect_url( $redirect->get_origin() );
		$new_url = $this->format_redirect_url( $redirect->get_target() );

		// Format the message.
		$message = sprintf(
			$this->get_undo_slug_notification(),
			'Yoast SEO Premium',
			'<a target="_blank" href="' . $this->admin_redirect_url( $redirect->get_origin() ) . '">',
			'</a>'
		);

		$message .= '<br>';
		$message .= esc_html__( 'Old URL:', 'wordpress-seo-premium' ) . ' ' . $this->create_hyperlink_from_url( $old_url );
		$message .= '<br>';
		$message .= esc_html__( 'New URL:', 'wordpress-seo-premium' ) . ' ' . $this->create_hyperlink_from_url( $new_url );
		$message .= '<br><br>';

		$message .= sprintf(
			'<button type="button" class="button-primary" onclick="wpseoRemoveNotification( this );">%s</button>',
			esc_html__( 'Ok', 'wordpress-seo-premium' )
		);

		$message .= sprintf(
			'<span id="delete-link"><a class="delete" href="" onclick=\'%1$s\'>%2$s</a></span>',
			$this->javascript_undo_redirect( $object_id, $object_type ),
			esc_html__( 'Undo', 'wordpress-seo-premium' )
		);

		// Only set notification when the slug change was not saved through quick edit.
		$this->create_notification( $message, 'slug_change' );
	}

	/**
	 * Returns a list with the actions that the user can do on deleting a post/term
	 *
	 * @param string $url The URL that will be redirected.
	 * @param string $id  The ID of the element.
	 *
	 * @return string
	 */
	protected function get_delete_action_list( $url, $id ) {
		return sprintf(
			'<ul>%1$s %2$s</ul>',
			'<li><button type="button" class="button" onclick=\'' . $this->javascript_create_redirect( $url, $id, WPSEO_Redirect_Types::PERMANENT ) . '\'>' . __( 'Redirect it to another URL', 'wordpress-seo-premium' ) . '</button></li>',
			'<li><button type="button" class="button" onclick=\'' . $this->javascript_create_redirect( $url, $id, WPSEO_Redirect_Types::DELETED ) . '\'>' . __( 'Make it serve a 410 Content Deleted header', 'wordpress-seo-premium' ) . '</button></li>'
		);
	}

	/**
	 * Returns the passed url in hyperlink form. Both the target and the text of the hyperlink is the passed url.
	 *
	 * @param string $url The url in string form to convert to a hyperlink.
	 *
	 * @return string
	 */
	protected function create_hyperlink_from_url( $url ) {
		return '<a target="_blank" href=' . esc_url( $url ) . '>' . esc_html( $url ) . '</a>';
	}

	/**
	 * Formats the redirect url.
	 *
	 * @param string $url The url to format.
	 *
	 * @return string
	 */
	protected function format_redirect_url( $url ) {
		$redirect_url_format = new WPSEO_Redirect_Url_Formatter( $url );

		return home_url( $redirect_url_format->format_without_subdirectory( get_home_url() ) );
	}

	/**
	 * Retrieves an instance of the redirect manager.
	 *
	 * @return WPSEO_Redirect_Manager The redirect manager.
	 */
	protected function get_redirect_manager() {
		static $redirect_manager;

		if ( $redirect_manager === null ) {
			$redirect_manager = new WPSEO_Redirect_Manager();
		}

		return $redirect_manager;
	}
}
