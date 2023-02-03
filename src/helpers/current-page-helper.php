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
	 * Retrieves the current post type.
	 *
	 * @codeCoverageIgnore It depends on external request input.
	 *
	 * @return string The post type.
	 */
	public function get_current_post_type() {
		// phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
		$post = \filter_input( \INPUT_GET, 'post', @\FILTER_SANITIZE_STRING );

		if ( $post ) {
			return \get_post_type( \get_post( $post ) );
		}

		return \filter_input(
			\INPUT_GET,
			'post_type',
			@\FILTER_SANITIZE_STRING, // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
			[
				'options' => [
					'default' => 'post',
				],
			]
		);
	}

	/**
	 * Retrieves the current taxonomy.
	 *
	 * @codeCoverageIgnore This function depends on external request input.
	 *
	 * @return string The taxonomy.
	 */
	public function get_current_taxonomy() {
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash -- doing a strict in_array check should be sufficient.
		if ( ! isset( $_SERVER['REQUEST_METHOD'] ) || ! \in_array( $_SERVER['REQUEST_METHOD'], [ 'GET', 'POST' ], true ) ) {
			return '';
		}

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			return (string) \filter_input(
				\INPUT_POST,
				'taxonomy',
				@\FILTER_SANITIZE_STRING // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
			);
		}

		return (string) \filter_input(
			\INPUT_GET,
			'taxonomy',
			@\FILTER_SANITIZE_STRING // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
		);
	}
}
