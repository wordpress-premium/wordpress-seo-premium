<?php

namespace Yoast\WP\SEO\Premium\Helpers;

/**
 * Class Current_Page_Helper.
 */
class Current_Page_Helper {

	/**
	 * Determine whether the current page is the homepage and shows posts.
	 *
	 * @return bool
	 */
	public function is_home_posts_page() {
		return ( \is_home() && \get_option( 'show_on_front' ) !== 'page' );
	}

	/**
	 * Determine whether the current page is a static homepage.
	 *
	 * @return bool
	 */
	public function is_home_static_page() {
		return ( \is_front_page() && \get_option( 'show_on_front' ) === 'page' && \is_page( \get_option( 'page_on_front' ) ) );
	}

	/**
	 * Determine whether this is the posts page, regardless of whether it's the frontpage or not.
	 *
	 * @return bool
	 */
	public function is_posts_page() {
		return ( \is_home() && ! \is_front_page() );
	}

	/**
	 * Retrieves the current post id.
	 * Returns 0 if no post id is found.
	 *
	 * @return int The post id.
	 */
	public function get_current_post_id() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are not processing form information, We are casting to an integer.
		if ( isset( $_GET['post'] ) && \is_string( $_GET['post'] ) && (int) \wp_unslash( $_GET['post'] ) > 0 ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are not processing form information, We are casting to an integer, also this is a helper function.
			return (int) \wp_unslash( $_GET['post'] );
		}
		return 0;
	}

	/**
	 * Retrieves the current post type.
	 *
	 * @return string The post type.
	 */
	public function get_current_post_type() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['post_type'] ) && \is_string( $_GET['post_type'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
			return \sanitize_text_field( \wp_unslash( $_GET['post_type'] ) );
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason: should be done outside the helper function.
		if ( isset( $_POST['post_type'] ) && \is_string( $_POST['post_type'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason: should be done outside the helper function.
			return \sanitize_text_field( \wp_unslash( $_POST['post_type'] ) );
		}

		$post_id = $this->get_current_post_id();

		if ( $post_id ) {
			return \get_post_type( $post_id );
		}

		return 'post';
	}

	/**
	 * Retrieves the current taxonomy.
	 *
	 * @return string The taxonomy.
	 */
	public function get_current_taxonomy() {
		if ( ! isset( $_SERVER['REQUEST_METHOD'] ) || ! \in_array( $_SERVER['REQUEST_METHOD'], [ 'GET', 'POST' ], true ) ) {
			return '';
		}

		// phpcs:ignore WordPress.Security.NonceVerification -- Reason: We are not processing form information.
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason: should be done outside the helper function.
			if ( isset( $_POST['taxonomy'] ) && \is_string( $_POST['taxonomy'] ) ) {
				// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason: should be done outside the helper function.
				return \sanitize_text_field( \wp_unslash( $_POST['taxonomy'] ) );
			}
			return '';
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['taxonomy'] ) && \is_string( $_GET['taxonomy'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
			return \sanitize_text_field( \wp_unslash( $_GET['taxonomy'] ) );
		}

		return '';
	}
}
