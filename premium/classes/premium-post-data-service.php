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

	const YOAST_META_PREFIX = '_yoast_wpseo_';

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
		$post_data = $this->retrieve_post_data( $post_ids, $meta_keys );
		$posts     = $this->group_results_on_post_id( $post_data, $this->get_meta_to_retrieve() );
		$posts     = $this->process_shortcodes( $posts );

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
	private function get_meta_to_retrieve() {
		return array(
			self::YOAST_META_PREFIX . 'focuskw'         =>
				array(
					'name'          => 'focus_keyphrase',
					'should_decode' => false,
				),
			self::YOAST_META_PREFIX . 'metadesc'        =>
				array(
					'name'          => 'meta_description',
					'should_decode' => false,
				),
			self::YOAST_META_PREFIX . 'focuskeywords'   =>
				array(
					'name'          => 'related_keyphrases',
					'should_decode' => true,
				),
			self::YOAST_META_PREFIX . 'keywordsynonyms' =>
				array(
					'name'          => 'keyphrase_synonyms',
					'should_decode' => true,
				),
			self::YOAST_META_PREFIX . 'title'           =>
				array(
					'name'          => 'meta_title',
					'should_decode' => false,
				),
			'_yst_prominent_words_version'           =>
				array(
					'name'          => 'index_version',
					'should_decode' => false,
				),
		);
	}

	/**
	 * Retrieves a list of associative arrays containing the content and given metadata of a post.
	 *
	 * @param array $post_ids  A list of IDs of the posts to retrieve the data for.
	 * @param array $meta_keys The meta keys to retrieve data for, as stored in the `post_meta` column.
	 *
	 * @return array An indexed array of SQL query results, each item containing a 'post_id', 'meta_key', 'meta_value' and 'contents' field.
	 */
	private function retrieve_post_data( $post_ids, $meta_keys ) {
		global $wpdb;

		// If no post IDs are present, return the empty array of results to avoid errors executing the query.
		if ( ! $post_ids ) {
			return array();
		}

		// Generate the placeholder strings for the wpdb prepare function (e.g. '%s, %s, %s' when there are three meta keys).
		$meta_keys_placeholders = $this->generate_wpdb_prepare_placeholder( $meta_keys, '%s' );
		$post_ids_placeholders  = $this->generate_wpdb_prepare_placeholder( $post_ids, '%d' );

		// Retrieve the contents and Yoast metadata (focus keyphrase, meta description etc.) from the database.
		return $wpdb->get_results(
			$wpdb->prepare(
				'SELECT post_id, meta_key, meta_value, post_content FROM ' . $wpdb->postmeta .
				' RIGHT JOIN ' . $wpdb->posts . ' ON post_id = ID ' .
				// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Placeholders exist, are generated above.
				' WHERE meta_key IN (' . $meta_keys_placeholders . ') AND post_id IN (' . $post_ids_placeholders . ')' .
				' ORDER BY ID ',
				array_merge( $meta_keys, $post_ids )
			)
		);
	}

	/**
	 * Groups the results on post ID.
	 * Decodes the meta values when they are stored as stringified JSON and gives them new names depending on the given `$meta_map`.
	 *
	 * E.g.
	 * ```
	 * array(
	 *      array( "post_id" => 12, "meta_key" => "_yoast_wpseo_focuskw", "meta_value" => "cats", "post_content" => "abc" ),
	 *      array( "post_id" => 12, "meta_key" => "_yoast_wpseo_meta_description", "meta_value" => "many cats", "post_content" => "abc" ),
	 *      array( "post_id" => 14, "meta_key" => "_yoast_wpseo_focuskw", "meta_value" => "dogs", "post_content" => "xyz" )
	 * );
	 * ```
	 * becomes:
	 * ```
	 * array(
	 *      array( 'ID' => 12, 'content' => 'abc', 'meta' => array( 'focus_keyphrase' => 'cats', 'meta_description' => 'many cats' ) ),
	 *      array( 'ID' => 14, 'content' => 'xyz', 'meta' => array( 'focus_keyphrase' => 'dogs') )
	 * );
	 * ```
	 *
	 * @param array $results  The results of a query on the WordPress post and post meta table.
	 * @param array $meta_map An associative array mapping meta keys to:
	 *                        1. 'name': the parameter name in the final list of objects,
	 *                        2. 'should_decode': whether the meta value has been JSON-stringified and should be decoded first.
	 *
	 * @return array An array of objects, where each object has an `ID`, `meta` and `content` attribute.
	 */
	private function group_results_on_post_id( $results, $meta_map ) {
		if ( $results === array() ) {
			// results are empty, we do not need to do any processing.
			return array();
		}

		$posts        = array();
		$current_post = array();

		foreach ( $results as $result_row ) {
			// The data in this row.
			$post_content = $result_row->post_content;
			$meta_key     = $result_row->meta_key;
			$meta_value   = $result_row->meta_value;
			$post_id      = $result_row->post_id;

			/*
			 * The human readable name of this meta key,
			 * plus whether the meta value is JSON-stringified and should be decoded first.
			 */
			$meta_name     = $meta_map[ $meta_key ]['name'];
			$should_decode = $meta_map[ $meta_key ]['should_decode'];

			if ( $current_post['ID'] == $post_id ) {
				// Decode when necessary.
				$meta_value = ( $should_decode ) ? json_decode( $meta_value ) : $meta_value;

				$current_post['meta'][ $meta_name ] = $meta_value;
			}
			else {
				// The current post is empty if we have just started populating the post list.
				if ( $current_post !== array() ) {
					// Current post has been populated with all meta values, add it to the list of posts.
					$posts[] = $current_post;
				}
				// Start with populating a new post.
				$current_post = array( 'ID' => $post_id );
				// Decode when necessary.
				$meta_value = ( $should_decode ) ? json_decode( $meta_value ) : $meta_value;

				$current_post['meta'][ $meta_name ] = $meta_value;
				$current_post['post_content']       = $post_content;
			}
		}

		// Always add the current open post to the post list.
		$posts[] = $current_post;

		return $posts;
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
	private function get_post_types() {
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
