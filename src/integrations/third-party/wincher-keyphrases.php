<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded

namespace Yoast\WP\SEO\Integrations\Third_Party;

use WPSEO_Meta;
use Yoast\WP\SEO\Conditionals\Wincher_Enabled_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Enhances the Wincher keyphrases arrays.
 */
class Wincher_Keyphrases implements Integration_Interface {

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Wincher_Enabled_Conditional::class ];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_wincher_keyphrases_from_post', [ $this, 'add_additional_keyphrases_from_post' ], 10, 2 );
		\add_filter( 'wpseo_wincher_all_keyphrases', [ $this, 'add_all_additional_keyphrases' ] );
	}

	/**
	 * Enhances the keyphrases collected from a post with the additional ones.
	 *
	 * @param array $keyphrases The keyphrases array.
	 * @param int   $post_id    The ID of the post.
	 *
	 * @return array The enhanced array.
	 */
	public function add_additional_keyphrases_from_post( $keyphrases, $post_id ) {
		$additional_keywords = \json_decode( WPSEO_Meta::get_value( 'focuskeywords', $post_id ), true );

		return \array_merge( $keyphrases, $additional_keywords );
	}

	/**
	 * Enhances the keyphrases collected from all the posts with the additional ones.
	 *
	 * @param array $keyphrases The keyphrases array.
	 *
	 * @return array The enhanced array.
	 */
	public function add_all_additional_keyphrases( $keyphrases ) {
		global $wpdb;
		$meta_key = WPSEO_Meta::$meta_prefix . 'focuskeywords';

		// phpcs:disable WordPress.DB.PreparedSQLPlaceholders.UnsupportedPlaceholder,WordPress.DB.PreparedSQLPlaceholders.ReplacementsWrongNumber,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching
		$results = $wpdb->get_results(
			$wpdb->prepare(
				"
				SELECT meta_value
				FROM %i pm
				JOIN %i p ON p.id = pm.post_id
				WHERE %i = %s AND %i != 'trash'
			",
				$wpdb->postmeta,
				$wpdb->posts,
				'meta_key',
				$meta_key,
				'post_status'
			)
		);

		if ( $results ) {
			foreach ( $results as $row ) {
				$additional_keywords = \json_decode( $row->meta_value, true );
				if ( $additional_keywords !== null ) {
					$additional_keywords = \array_column( $additional_keywords, 'keyword' );
					$keyphrases          = \array_merge( $keyphrases, $additional_keywords );
				}
			}
		}

		return $keyphrases;
	}
}
