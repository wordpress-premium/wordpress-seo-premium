<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Represents the unindexed posts.
 */
class WPSEO_Premium_Prominent_Words_Unindexed_Post_Query {

	/**
	 * List containing unindexed posts totals per post type.
	 *
	 * @var array
	 */
	protected $totals = array();

	/**
	 * Returns the total amount of posts.
	 *
	 * @since 4.6.0
	 *
	 * @param int $limit The offset for the query.
	 *
	 * @return bool True when the limit has been exceeded.
	 */
	public function exceeds_limit( $limit ) {
		$unindexed_post_ids = $this->get_unindexed_post_ids( $this->get_post_types(), ( $limit + 1 ) );
		return count( $unindexed_post_ids ) > $limit;
	}

	/**
	 * Returns the total unindexed posts for given post type.
	 *
	 * @since 4.6.0
	 *
	 * @param string $post_type The posttype to fetch.
	 *
	 * @return int The total amount of unindexed posts.
	 */
	public function get_total( $post_type ) {
		if ( ! array_key_exists( $post_type, $this->totals ) ) {
			$totals = $this->get_totals( $this->get_post_types() );

			foreach ( $totals as $total_post_type => $total ) {
				$this->totals[ $total_post_type ] = $total;
			}
		}

		if ( ! array_key_exists( $post_type, $this->totals ) ) {
			$this->totals[ $post_type ] = 0;
		}

		return $this->totals[ $post_type ];
	}

	/**
	 * Returns the totals for each posttype by counting them.
	 *
	 * @since 4.6.0
	 *
	 * @param array $post_types The posttype to limit the resultset for.
	 *
	 * @return array Array with the totals for the requested posttypes.
	 */
	public function get_totals( $post_types ) {
		global $wpdb;

		if ( $post_types === array() ) {
			return $post_types;
		}

		$replacements = array(
			WPSEO_Premium_Prominent_Words_Versioning::POST_META_NAME,
			WPSEO_Premium_Prominent_Words_Versioning::determine_version_number(),
		);
		$replacements = array_merge( $replacements, $post_types );

		$results = $wpdb->get_results(
			$wpdb->prepare(
				'
				SELECT COUNT( ID ) as total, post_type
				FROM ' . $wpdb->posts . '
				WHERE ID NOT IN( SELECT post_id FROM ' . $wpdb->postmeta . ' WHERE meta_key = %s AND meta_value = %s )
					AND post_status IN( "future", "draft", "pending", "private", "publish" )
					AND post_type IN( ' . implode( ',', array_fill( 0, count( $post_types ), '%s' ) ) . ' )
				GROUP BY post_type
				',
				$replacements
			)
		);

		$totals = array();

		foreach ( $results as $result ) {
			$totals[ $this->determine_rest_endpoint_for_post_type( $result->post_type ) ] = (int) $result->total;
		}

		return $totals;
	}

	/**
	 * Determines the REST endpoint for the given post type.
	 *
	 * @param string $post_type The post type to determine the endpoint for.
	 *
	 * @return string The endpoint. Returns empty string if post type doesn't exist.
	 */
	protected function determine_rest_endpoint_for_post_type( $post_type ) {
		$post_type_object = get_post_type_object( $post_type );

		if ( is_null( $post_type_object ) ) {
			return '';
		}

		if ( isset( $post_type_object->rest_base ) && $post_type_object->rest_base !== false ) {
			return $post_type_object->rest_base;
		}

		return $post_type_object->name;
	}

	/**
	 * Returns the array with supported posttypes.
	 *
	 * @return array The supported posttypes.
	 */
	protected function get_post_types() {
		$prominent_words_support = new WPSEO_Premium_Prominent_Words_Support();

		return array_filter( $prominent_words_support->get_supported_post_types(), array( 'WPSEO_Post_Type', 'is_rest_enabled' ) );
	}

	/**
	 * Gets the Post IDs of un-indexed objects.
	 *
	 * @param array|string $post_types The post type(s) to fetch.
	 * @param int          $limit      Limit the number of results.
	 *
	 * @return int[] Post IDs found which are un-indexed.
	 */
	public function get_unindexed_post_ids( $post_types, $limit ) {
		global $wpdb;

		if ( is_string( $post_types ) ) {
			$post_types = (array) $post_types;
		}

		if ( $post_types === array() ) {
			return $post_types;
		}

		$replacements   = array(
			WPSEO_Premium_Prominent_Words_Versioning::POST_META_NAME,
			WPSEO_Premium_Prominent_Words_Versioning::determine_version_number(),
		);
		$replacements   = array_merge( $replacements, $post_types );
		$replacements[] = $limit;

		$results = $wpdb->get_results(
			$wpdb->prepare(
				'
				SELECT ID
				FROM ' . $wpdb->posts . '
				WHERE ID NOT IN( SELECT post_id FROM ' . $wpdb->postmeta . ' WHERE meta_key = %s AND meta_value = %s )
					AND post_status IN( "future", "draft", "pending", "private", "publish" )
					AND post_type IN( ' . implode( ',', array_fill( 0, count( $post_types ), '%s' ) ) . ' )
				LIMIT %d',
				$replacements
			),
			ARRAY_A
		);

		// Make sure we return a list of IDs.
		$results = wp_list_pluck( $results, 'ID' );

		return $results;
	}

	/**
	 * Returns the array with supported post statuses.
	 *
	 * @return array The supported post statuses.
	 */
	public static function get_supported_post_statuses() {
		return array( 'future', 'draft', 'pending', 'private', 'publish' );
	}
}
