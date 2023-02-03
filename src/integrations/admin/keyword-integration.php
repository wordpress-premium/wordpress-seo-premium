<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WP_Query;
use WPSEO_Meta;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Keyword_Integration class
 */
class Keyword_Integration implements Integration_Interface {

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_posts_for_focus_keyword', [ $this, 'add_posts_for_focus_keyword' ], 10, 3 );
		\add_filter( 'wpseo_posts_for_related_keywords', [ $this, 'add_posts_for_related_keywords' ], 10, 2 );
	}

	/**
	 * Enhances the array of posts that share their focus keywords with the post's related keywords by adding posts' ids with the same related keywords.
	 *
	 * @param array $usage   The array of posts' ids that share their focus keywords with the post.
	 * @param int   $post_id The id of the post we're finding the usage of related keywords for.
	 *
	 * @return array The filtered array of posts' ids.
	 */
	public function add_posts_for_related_keywords( $usage, $post_id ) {
		$additional_keywords = \json_decode( WPSEO_Meta::get_value( 'focuskeywords', $post_id ), true );

		if ( empty( $additional_keywords ) ) {
			return $usage;
		}

		foreach ( $additional_keywords as $additional_keyword ) {
			$keyword = $additional_keyword['keyword'];

			$usage[ $keyword ] = WPSEO_Meta::keyword_usage( $keyword, $post_id );
		}

		return $usage;
	}

	/**
	 * Enhances the array of posts that share their focus keywords with the post's focus keywords by adding posts' ids with the same related keywords.
	 *
	 * @param array  $post_ids The array of posts' ids that share their related keywords with the post.
	 * @param string $keyword  The keyword to search for.
	 * @param int    $post_id  The id of the post the keyword is associated to.
	 *
	 * @return array The filtered array of posts' ids.
	 */
	public function add_posts_for_focus_keyword( $post_ids, $keyword, $post_id ) {
		$query = [
			'meta_query'     => [
				[
					'key'     => '_yoast_wpseo_focuskeywords',
					'value'   => \sprintf( '"keyword":"%s"', $keyword ),
					'compare' => 'LIKE',
				],
			],
			'post__not_in'   => [ $post_id ],
			'fields'         => 'ids',
			'post_type'      => 'any',

			/*
			 * We only need to return zero, one or two results:
			 * - Zero: keyword hasn't been used before
			 * - One: Keyword has been used once before
			 * - Two or more: Keyword has been used twice or more before
			 */
			'posts_per_page' => 2,
		];
		$get_posts = new WP_Query( $query );
		return \array_merge( $post_ids, $get_posts->posts );
	}
}
