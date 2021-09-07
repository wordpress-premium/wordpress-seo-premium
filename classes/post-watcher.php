<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class WPSEO_Post_Watcher.
 */
class WPSEO_Post_Watcher extends WPSEO_Watcher implements WPSEO_WordPress_Integration {

	/**
	 * Type of watcher, will be used for the filters.
	 *
	 * @var string
	 */
	protected $watch_type = 'post';

	/**
	 * Registers the hooks.
	 *
	 * @codeCoverageIgnore Method used WordPress functions.
	 *
	 * @return void
	 */
	public function register_hooks() {
		global $pagenow;

		add_action( 'admin_enqueue_scripts', [ $this, 'page_scripts' ] );

		// Only set the hooks for the page where they are needed.
		if ( ! $this->is_rest_request() && ! $this->post_redirect_can_be_made( $pagenow ) ) {
			return;
		}

		// Detect a post slug change.
		add_action( 'post_updated', [ $this, 'detect_slug_change' ], 12, 3 );

		// Detect a post trash.
		add_action( 'wp_trash_post', [ $this, 'detect_post_trash' ] );

		// Detect a post untrash.
		add_action( 'untrashed_post', [ $this, 'detect_post_untrash' ] );

		// Detect a post delete.
		add_action( 'before_delete_post', [ $this, 'detect_post_delete' ] );
	}

	/**
	 * Registers the page scripts.
	 *
	 * @codeCoverageIgnore Method used WordPress functions.
	 *
	 * @param string $current_page The page that is opened at the moment.
	 *
	 * @return void
	 */
	public function page_scripts( $current_page ) {
		// Register the scripts.
		parent::page_scripts( $current_page );

		/**
		 * If in Gutenberg, always load these scripts.
		 */
		if ( WPSEO_Metabox::is_post_edit( $current_page ) && wp_script_is( 'wp-editor', 'enqueued' ) ) {
			wp_enqueue_script( 'wp-seo-premium-redirect-notifications' );
			wp_enqueue_script( 'wp-seo-premium-redirect-notifications-gutenberg' );
			return;
		}

		if ( ! $this->post_redirect_can_be_made( $current_page ) ) {
			return;
		}

		if ( WPSEO_Metabox::is_post_overview( $current_page ) ) {
			wp_enqueue_script( 'wp-seo-premium-quickedit-notification' );
		}

		if ( WPSEO_Metabox::is_post_edit( $current_page ) ) {
			wp_enqueue_script( 'wp-seo-premium-redirect-notifications' );
		}
	}

	/**
	 * Detect if the slug changed, hooked into 'post_updated'.
	 *
	 * @param int     $post_id     The ID of the post.
	 * @param WP_Post $post        The post with the new values.
	 * @param WP_Post $post_before The post with the previous values.
	 *
	 * @return bool
	 */
	public function detect_slug_change( $post_id, $post, $post_before ) {
		// Bail if this is a multisite installation and the site has been switched.
		if ( is_multisite() && ms_is_switched() ) {
			return false;
		}

		if ( ! $this->is_redirect_relevant( $post, $post_before ) ) {
			return false;
		}

		$this->remove_colliding_redirect( $post, $post_before );

		/**
		 * Filter: 'Yoast\WP\SEO\post_redirect_slug_change' - Check if a redirect should be created
		 * on post slug change.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 12.9.0
		 *
		 * @api bool    Determines if a redirect should be created for this post slug change.
		 * @api int     The ID of the post.
		 * @api WP_Post The current post object.
		 * @api WP_Post The previous post object.
		 */
		$create_redirect = apply_filters( 'Yoast\WP\SEO\post_redirect_slug_change', false, $post_id, $post, $post_before );

		if ( $create_redirect === true ) {
			return true;
		}

		$old_url = $this->get_target_url( $post_before );
		if ( ! $old_url ) {
			return false;
		}

		// If the post URL wasn't public before, or isn't public now, don't even check if we have to redirect.
		if ( ! $this->check_public_post_status( $post_before->ID ) || ! $this->check_public_post_status( $post->ID ) ) {
			return false;
		}

		// Get the new URL.
		$new_url = $this->get_target_url( $post_id );

		// Maybe we can undo the created redirect.
		$created_redirect = $this->notify_undo_slug_redirect( $old_url, $new_url, $post_id, 'post' );

		if ( $created_redirect ) {
			$redirect_info = [
				'origin' => $created_redirect->get_origin(),
				'target' => $created_redirect->get_target(),
				'type'   => $created_redirect->get_type(),
				'format' => $created_redirect->get_format(),
			];
			update_post_meta( $post_id, '_yoast_post_redirect_info', $redirect_info );
		}
	}

	/**
	 * Removes a colliding redirect if it is found.
	 *
	 * @param WP_Post $post        The post with the new values.
	 * @param WP_Post $post_before The post with the previous values.
	 *
	 * @return void
	 */
	protected function remove_colliding_redirect( $post, $post_before ) {
		$redirect = $this->get_redirect_manager()->get_redirect( $this->get_target_url( $post ) );
		if ( $redirect === false ) {
			return;
		}

		if ( $redirect->get_target() !== trim( $this->get_target_url( $post_before ), '/' ) ) {
			return;
		}

		$this->get_redirect_manager()->delete_redirects( [ $redirect ] );
	}

	/**
	 * Determines if redirect is relevant for the provided post.
	 *
	 * @param WP_Post $post        The post with the new values.
	 * @param WP_Post $post_before The post with the previous values.
	 *
	 * @return bool True if a redirect might be relevant.
	 */
	protected function is_redirect_relevant( $post, $post_before ) {
		// Check if the post type is enabled for redirects.
		$post_type = get_post_type( $post );

		/**
		 * Filter: 'Yoast\WP\SEO\redirect_post_type' - Check if a redirect should be created
		 * on post slug change for specified post type.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 12.9.0
		 *
		 * @api bool   Determines if a redirect should be created for this post type.
		 * @api string The post type that is being checked for.
		 */
		$post_type_accessible = apply_filters( 'Yoast\WP\SEO\redirect_post_type', WPSEO_Post_Type::is_post_type_accessible( $post_type ), $post_type );

		if ( ! $post_type_accessible ) {
			return false;
		}

		// If post is a revision do not create redirect.
		if ( wp_is_post_revision( $post_before ) !== false && wp_is_post_revision( $post ) !== false ) {
			return false;
		}

		// There is no slug change.
		if ( $this->get_target_url( $post ) === $this->get_target_url( $post_before ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Checks whether the given post is public or not.
	 *
	 * @param int $post_id The current post ID.
	 *
	 * @return bool
	 */
	private function check_public_post_status( $post_id ) {
		$public_post_statuses = [
			'publish',
			'static',
			'private',
		];

		/**
		 * Filter: 'Yoast\WP\SEO\public_post_statuses' - Allow changing the statuses that are expected
		 * to have caused a URL to be public.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 12.9.0
		 *
		 * @api array $published_post_statuses The statuses that'll be treated as published.
		 * @param object $post The post object we're doing the published check for.
		 */
		$public_post_statuses = apply_filters( 'Yoast\WP\SEO\public_post_statuses', $public_post_statuses, $post_id );

		return ( in_array( get_post_status( $post_id ), $public_post_statuses, true ) );
	}

	/**
	 * Offer to create a redirect from the post that is about to get trashed.
	 *
	 * @param int $post_id The current post ID.
	 */
	public function detect_post_trash( $post_id ) {

		$url = $this->check_if_redirect_needed( $post_id );
		if ( ! empty( $url ) ) {

			$id = 'wpseo_redirect_' . md5( $url );

			// Format the message.
			$message = sprintf(
				/* translators: %1$s: Yoast SEO Premium, %2$s: List with actions, %3$s: <a href=''>, %4$s: </a>, %5$s: Slug to post */
				__( '%1$s detected that you moved a post (%5$s) to the trash. You can either: %2$s Don\'t know what to do? %3$sRead this post%4$s.', 'wordpress-seo-premium' ),
				'Yoast SEO Premium',
				$this->get_delete_action_list( $url, $id ),
				'<a target="_blank" href="' . WPSEO_Shortlinker::get( 'https://yoa.st/2jd' ) . '">',
				'</a>',
				'<code>' . $url . '</code>'
			);

			$this->create_notification( $message, 'trash' );
		}
	}

	/**
	 * Offer to create a redirect from the post that is about to get  restored from the trash.
	 *
	 * @param int $post_id The current post ID.
	 */
	public function detect_post_untrash( $post_id ) {
		$redirect = $this->check_if_redirect_needed( $post_id, true );

		if ( $redirect ) {

			$id = 'wpseo_undo_redirect_' . md5( $redirect->get_origin() );

			// Format the message.
			$message = sprintf(
				/* translators: %1$s: Yoast SEO Premium, %2$s: <a href='{undo_redirect_url}'>, %3$s: </a>, %4$s: Slug to post */
				__( '%1$s detected that you restored a post (%4$s) from the trash, for which a redirect was created. %2$sClick here to remove the redirect%3$s', 'wordpress-seo-premium' ),
				'Yoast SEO Premium',
				'<button type="button" class="button" onclick=\'' . $this->javascript_undo_redirect( $redirect, $id ) . '\'>',
				'</button>',
				'<code>' . $redirect->get_origin() . '</code>'
			);

			$this->create_notification( $message, 'untrash' );
		}
	}

	/**
	 * Offer to create a redirect from the post that is about to get deleted.
	 *
	 * @param int $post_id The current post ID.
	 */
	public function detect_post_delete( $post_id ) {

		// We don't want to redirect menu items.
		if ( is_nav_menu_item( $post_id ) ) {
			return;
		}


		// When the post comes from the trash or if the post is a revision then skip further execution.
		if ( get_post_status( $post_id ) === 'trash' || wp_is_post_revision( $post_id ) ) {
			return;
		}

		// Is a redirect needed.
		$url = $this->check_if_redirect_needed( $post_id );
		if ( ! empty( $url ) ) {
			$this->set_delete_notification( $url );
		}
	}

	/**
	 * Look up if URL does exists in the current redirects.
	 *
	 * @param string $url URL to search for.
	 *
	 * @return bool
	 */
	protected function get_redirect( $url ) {
		return $this->get_redirect_manager()->get_redirect( $url );
	}

	/**
	 * This method checks if a redirect is needed.
	 *
	 * This method will check if URL as redirect already exists.
	 *
	 * @param int  $post_id      The current post ID.
	 * @param bool $should_exist Boolean to determine if the URL should be exist as a redirect.
	 *
	 * @return WPSEO_Redirect|string|bool
	 */
	protected function check_if_redirect_needed( $post_id, $should_exist = false ) {
		// If the post type is not public, don't redirect.
		$post_type = get_post_type_object( get_post_type( $post_id ) );

		if ( ! $post_type ) {
			return false;
		}

		if ( ! in_array( $post_type->name, $this->get_included_automatic_redirection_post_types(), true ) ) {
			return false;
		}

		// The post types should be a public one.
		if ( $this->check_public_post_status( $post_id ) ) {
			// Get the right URL.
			$url = $this->get_target_url( $post_id );

			// If $url is not a single /, there may be the option to create a redirect.
			if ( $url !== '/' ) {
				// Message should only be shown if there isn't already a redirect.
				$redirect = $this->get_redirect( $url );

				if ( is_a( $redirect, 'WPSEO_Redirect' ) && $should_exist ) {
					return $redirect;
				}
				if ( ! is_a( $redirect, 'WPSEO_Redirect' ) && ! $should_exist ) {
					return $url;
				}
			}
		}
		return false;
	}

	/**
	 * Retrieves the post types to create automatic redirects for.
	 *
	 * @return array Post types to include to create automatic redirects for.
	 */
	protected function get_included_automatic_redirection_post_types() {
		$post_types = WPSEO_Post_Type::get_accessible_post_types();

		/**
		 * Filter: 'Yoast\WP\SEO\automatic_redirection_post_types' - Post types to create
		 * automatic redirects for.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 12.9.0
		 *
		 * @api array $included_post_types Array with the post type names to include to automatic redirection.
		 */
		$included_post_types = apply_filters( 'Yoast\WP\SEO\automatic_redirection_post_types', $post_types );

		if ( ! is_array( $included_post_types ) ) {
			$included_post_types = [];
		}

		return $included_post_types;
	}

	/**
	 * Retrieves the path of the URL for the supplied post.
	 *
	 * @param int|WP_Post $post The current post ID.
	 *
	 * @return string The URL for the supplied post.
	 */
	protected function get_target_url( $post ) {
		// Use the correct URL path.
		$url = wp_parse_url( get_permalink( $post ) );
		if ( is_array( $url ) && isset( $url['path'] ) ) {
			return $url['path'];
		}

		return '';
	}

	/**
	 * Get the old URL.
	 *
	 * @param object $post        The post object with the new values.
	 * @param object $post_before The post object with the old values.
	 *
	 * @return bool|string
	 */
	protected function get_old_url( $post, $post_before ) {
		$wpseo_old_post_url = $this->get_post_old_post_url();

		if ( ! empty( $wpseo_old_post_url ) ) {
			return $wpseo_old_post_url;
		}

		// Check if request is inline action and new slug is not old slug, if so set wpseo_post_old_url.
		$action = $this->get_post_action();

		$url_before = $this->get_target_url( $post_before );
		if ( ! empty( $action ) && $action === 'inline-save' && $this->get_target_url( $post ) !== $url_before ) {
			return $url_before;
		}

		return false;
	}

	/**
	 * Determines whether we're dealing with a REST request or not.
	 *
	 * @return bool Whether or not the current request is a REST request.
	 */
	private function is_rest_request() {
		return defined( 'REST_REQUEST' ) && REST_REQUEST === true;
	}

	/**
	 * Returns the undo message for the post.
	 *
	 * @return string
	 */
	protected function get_undo_slug_notification() {
		/* translators: %1$s: Yoast SEO Premium, %2$s and %3$s expand to a link to the admin page. */
		return __(
			'%1$s created a %2$sredirect%3$s from the old post URL to the new post URL.',
			'wordpress-seo-premium'
		);
	}

	/**
	 * Returns the delete message for the post.
	 *
	 * @return string
	 */
	protected function get_delete_notification() {
		/* translators: %1$s: Yoast SEO Premium, %2$s: List with actions, %3$s: <a href='{post_with_explaination.}'>, %4$s: </a>, %5%s: The removed url.  */
		return __(
			'%1$s detected that you deleted a post (%5$s). You can either: %2$s Don\'t know what to do? %3$sRead this post %4$s.',
			'wordpress-seo-premium'
		);
	}

	/**
	 * Is the current page valid to make a redirect from.
	 *
	 * @param string $current_page The currently opened page.
	 *
	 * @return bool True when a redirect can be made on this page.
	 */
	protected function post_redirect_can_be_made( $current_page ) {
		return $this->is_post_page( $current_page ) || $this->is_action_inline_save() || $this->is_nested_pages( $current_page );
	}

	/**
	 * Is the current page related to a post (edit/overview).
	 *
	 * @param string $current_page The current opened page.
	 *
	 * @return bool True when page is a post edit/overview page.
	 */
	protected function is_post_page( $current_page ) {
		return ( in_array( $current_page, [ 'edit.php', 'post.php' ], true ) );
	}

	/**
	 * Is the page in an AJAX-request and is the action "inline save".
	 *
	 * @return bool True when in an AJAX-request and the action is inline-save.
	 */
	protected function is_action_inline_save() {
		return ( wp_doing_ajax() && $this->get_post_action() === 'inline-save' );
	}

	/**
	 * Checks if current page is loaded by nested pages.
	 *
	 * @param string $current_page The current page.
	 *
	 * @return bool True when the current page is nested pages.
	 */
	protected function is_nested_pages( $current_page ) {
		return ( $current_page === 'admin.php' && filter_input( INPUT_GET, 'page' ) === 'nestedpages' );
	}

	/**
	 * Retrieves wpseo_old_post_url field from the post.
	 *
	 * @return mixed.
	 */
	protected function get_post_old_post_url() {
		return filter_input( INPUT_POST, 'wpseo_old_post_url' );
	}

	/**
	 * Retrieves action field from the post.
	 *
	 * @return mixed.
	 */
	protected function get_post_action() {
		return filter_input( INPUT_POST, 'action' );
	}

	/**
	 * Display the undo redirect notification
	 *
	 * @param WPSEO_Redirect $redirect    The old URL to the post.
	 * @param int            $object_id   The post or term ID.
	 * @param string         $object_type The object type: post or term.
	 */
	protected function set_undo_slug_notification( WPSEO_Redirect $redirect, $object_id, $object_type ) {

		if ( ! $this->is_rest_request() && ! \wp_doing_ajax() ) {
			parent::set_undo_slug_notification( $redirect, $object_id, $object_type );

			return;
		}

		header( 'X-Yoast-Redirect-Created: 1; origin=' . $redirect->get_origin() . '; target=' . $redirect->get_target() . '; type=' . $redirect->get_type() . '; objectId=' . $object_id . '; objectType=' . $object_type );
	}
}
