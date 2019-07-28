<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Retrieves the post data and Yoast SEO metadata (meta-description, SEO title, keywords and synonyms)
 * from the database.
 */
class WPSEO_Premium_Post_Data_Service {

	/**
	 * Retrieves a post and its Yoast metadata.
	 *
	 * Included metadata:
	 *  - focus keyphrase
	 *  - meta description
	 *  - SEO title
	 *  - related keyphrases,
	 *  - keyphrase synonyms
	 *
	 * @param WP_REST_Request $request Data from the query request.
	 *
	 * @return WP_REST_Response A list of posts, with, in each post, a meta field containing meta data for that post. Or, if there are no post ids, an empty array.
	 */
	public function query( WP_REST_Request $request ) {
		$limit     = $request->get_param( 'per_page' );
		$post_type = $this->get_post_types();

		$prominent_words = new WPSEO_Premium_Prominent_Words_Unindexed_Post_Query();
		$post_ids        = $prominent_words->get_unindexed_post_ids( $post_type, $limit );

		// No posts have been left unindexed, return the empty array.
		if ( ! $post_ids ) {
			return new WP_REST_Response( array() );
		}

		// Make sure that the post IDs are integers (instead of strings) and unique.
		$post_ids = wp_parse_id_list( $post_ids );

		$meta_keys = array_keys( $this->get_meta_to_retrieve() );
		// Retrieve the posts and their meta data from the database.
		$posts = $this->retrieve_post_data( $post_ids, $meta_keys );
		$posts = $this->process_shortcodes( $posts );

		// Return the enriched posts.
		return new WP_REST_Response( $posts );
	}

	/**
	 * The Yoast meta data to retrieve from each post.
	 *
	 * Includes:
	 *  - focus keyphrase
	 *  - meta description
	 *  - SEO title
	 *  - related keyphrases,
	 *  - keyphrase synonyms
	 *
	 * Contains for each DB column name the human readable name and whether it should
	 * be decoded from a string to JSON.
	 */
	protected function get_meta_to_retrieve() {
		return array(
			'focuskw'                       =>
				array(
					'name'                  => 'focus_keyphrase',
					'should_decode'         => false,
				),
			'metadesc'                      =>
				array(
					'name'                  => 'meta_description',
					'should_decode'         => false,
				),
			'focuskeywords'                 =>
				array(
					'name'                  => 'related_keyphrases',
					'should_decode'         => true,
				),
			'keywordsynonyms'               =>
				array(
					'name'                  => 'keyphrase_synonyms',
					'should_decode'         => true,
				),
			'title'                         =>
				array(
					'name'                  => 'meta_title',
					'should_decode'         => false,
				),
		);
	}

	/**
	 * Wraps a static method WPSEO_Meta: get_value to be able to access it in tests.
	 *
	 * @param string $meta_key The name of the meta key that needs to be extracted.
	 * @param int    $post_id  The ID of the post to extract meta key for.
	 * @return string The value of the meta key for the given post_id
	 */
	protected function get_meta_value_wrapper( $meta_key, $post_id ) {
		return WPSEO_Meta::get_value( $meta_key, $post_id );
	}

	/**
	 * Retrieves post content and Yoast metadata (focus keyphrase, meta description etc.) from the database and
	 * groups these attributes per post.
	 *
	 * @param array $post_ids  A list of IDs of the posts to retrieve the data for.
	 * @param array $meta_keys The meta keys to retrieve data for, as stored in the `post_meta` column.
	 *
	 * @return array An indexed array of SQL query results, where each item corresponds to a post.
	 * Every item is an associative array containing the fields 'post_id', 'post_content' and 'meta',
	 * where the latter is a collection of 'key'-'value' pairs.
	 */
	protected function retrieve_post_data( $post_ids, $meta_keys ) {
		// If no post IDs are present, return the empty array of results to avoid errors executing the query.
		if ( ! $post_ids ) {
			return array();
		}

		$meta_info = $this->get_meta_to_retrieve();

		$results = array();

		// First retrieve post content of all the posts based on their IDs.
		$posts = get_posts(
			array(
				'include'     => $post_ids,
				'post_type'   => $this->get_post_types(),
				'post_status' => WPSEO_Premium_Prominent_Words_Unindexed_Post_Query::get_supported_post_statuses(),
			)
		);

		// Now retrieve meta data per post and per meta key.
		foreach ( $posts as $post ) {
			$post_id = $post->ID;

			$meta_data = array();
			foreach ( $meta_keys as $meta_key ) {
				$meta_data_for_key = $this->get_meta_value_wrapper( $meta_key, $post_id );

				$meta_key_name = $meta_info[ $meta_key ]['name'];

				// Apply json decoder to meta keys that are arrays (e.g., related keywords).
				if ( $meta_info[ $meta_key ]['should_decode'] ) {
					$meta_data[ $meta_key_name ] = json_decode( $meta_data_for_key );
				}
				else {
					$meta_data[ $meta_key_name ] = $meta_data_for_key;
				}
			}

			$results[] = array(
				'ID'           => $post_id,
				'post_content' => $post->post_content,
				'meta'         => $meta_data,
			);
		}

		return $results;
	}

	/**
	 * Returns an array of posts in which all shortcodes in the content of each respective post have
	 * been processed.
	 *
	 * @param array $posts An array of post objects.
	 *
	 * @return array An array of posts objects where all shortcodes in the post content have been processed.
	 */
	public function process_shortcodes( $posts ) {
		$posts_modified = $posts;

		foreach ( $posts_modified as &$post ) {
			if ( array_key_exists( 'post_content', $post ) ) {
				$post['post_content'] = do_shortcode( $post['post_content'] );
			}
		}

		return $posts_modified;
	}

	/**
	 * Returns a list of supported post types.
	 *
	 * @return array The supported post types.
	 */
	protected function get_post_types() {
		$prominent_words_support = new WPSEO_Premium_Prominent_Words_Support();

		return $prominent_words_support->get_supported_post_types();
	}

	/**
	 * Generates a placeholder string for the given SQL query variables for use in wpdb::prepare.
	 *
	 * **Example**:
	 * ```
	 * $placeholder_string = generate_wpdb_prepare_placeholder( array( 2, 4, 6 ), '%d' ) // $placeholder_string = '%d, %d, %d'
	 * ```
	 *
	 * @param array  $query_variables The SQL query variables to generate the placeholder string for.
	 * @param string $placeholder     The placeholder type to use, '%d' for integers, '%s' for strings.
	 *
	 * @return string The generated placeholder string.
	 */
	private function generate_wpdb_prepare_placeholder( $query_variables, $placeholder ) {
		return implode( ', ', array_fill( 0, count( $query_variables ), $placeholder ) );
	}
}
