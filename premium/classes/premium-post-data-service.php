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

		$replacer = new WPSEO_Replace_Vars();

		$meta_keys = array_keys( $this->get_meta_to_retrieve() );
		// Retrieve the posts and their meta data from the database.
		$posts = $this->retrieve_post_data( $post_ids, $meta_keys, $replacer );
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
			'focuskw' =>
				array(
					'name'                  => 'focus_keyphrase',
					'should_decode'         => false,
					'should_replace_vars'   => false,
				),
			'metadesc' =>
				array(
					'name'                  => 'meta_description',
					'should_decode'         => false,
					'should_replace_vars'   => true,
				),
			'focuskeywords' =>
				array(
					'name'                  => 'related_keyphrases',
					'should_decode'         => true,
					'should_replace_vars'   => false,
				),
			'keywordsynonyms' =>
				array(
					'name'                  => 'keyphrase_synonyms',
					'should_decode'         => true,
					'should_replace_vars'   => false,
				),
			'title' =>
				array(
					'name'                  => 'meta_title',
					'should_decode'         => false,
					'should_replace_vars'   => true,
				),
		);
	}

	/**
	 * Wraps a static method WPSEO_Meta::get_value to be able to access it in tests.
	 *
	 * @param string $meta_key The name of the meta key that needs to be extracted.
	 * @param int    $post_id  The ID of the post to extract meta key for.
	 * @return string The value of the meta key for the given post_id
	 */
	protected function get_meta_value_wrapper( $meta_key, $post_id ) {
		return WPSEO_Meta::get_value( $meta_key, $post_id );
	}

	/**
	 * Wraps a static method WPSEO_Options::get to be able to access it in tests.
	 * The original function retrieves a single field from any option for the SEO plugin.
	 *
	 * @param string $key     The key it should return.
	 * @param mixed  $default The default value that should be returned if the key isn't set.
	 *
	 * @return mixed|null Returns value if found, $default if not.
	 */
	protected function get_options_wrapper( $key, $default ) {
		return WPSEO_Options::get( $key, $default );
	}

	/**
	 * Check if there is a modified SEO-title available to save.
	 * If the SEO title was not modified, check if the user specified a default SEO title for this content type.
	 * Otherwise use the absolute default title '%%title%% %%sep%% %%sitename%%' (WPSEO_Frontend::$default_title).
	 *
	 * @param string $modified_title The value extracted from the post-specific meta data.
	 * @param string $post_type      The content type to use default for.
	 *
	 * @return string The post-specific or a default title.
	 */
	private function check_for_default_title( $modified_title, $post_type ) {
		// Immediately return the input value if there's a post-specific SEO title.
		if ( $modified_title !== '' ) {
			return $modified_title;
		}

		// Try to obtain user-specified defaults for the given content type (post, page, etc.).
		$user_default_title = $this->get_options_wrapper( 'title-' . $post_type, '' );
		if ( $user_default_title != '' ) {
			return $user_default_title;
		}

		// Return the absolute default value, which is currently set to '%%title%% %%sep%% %%sitename%%'.
		return WPSEO_Frontend::$default_title;
	}

	/**
	 * Check if there is a modified meta description available to save.
	 * If the meta description was not modified, check if the user specified a default meta description for this content type.
	 *
	 * @param string $modified_description The value extracted from the post-specific meta data.
	 * @param string $post_type            The content type to use default for.
	 *
	 * @return string The post-specific or a default meta description.
	 */
	private function check_for_default_metadescription( $modified_description, $post_type ) {
		// Immediately return the input value if there's post-specific metadescription.
		if ( $modified_description !== '' ) {
			return $modified_description;
		}

		// Try to obtain user-specified defaults for the given content type (post, page, etc.).
		return $this->get_options_wrapper( 'metadesc-' . $post_type, '' );
	}

	/**
	 * Retrieves post content and Yoast metadata (focus keyphrase, meta description etc.) from the database and
	 * groups these attributes per post.
	 *
	 * @param array              $post_ids    A list of IDs of the posts to retrieve the data for.
	 * @param array              $meta_keys   The meta keys to retrieve data for, as stored in the `post_meta` column.
	 * @param WPSEO_Replace_Vars $replacer    This will replace the replace variables (`%%sitename%%`, etc.) with their respective values.
	 *
	 * @return array An indexed array of SQL query results, where each item corresponds to a post.
	 * Every item is an associative array containing the fields 'post_id', 'post_content' and 'meta',
	 * where the latter is a collection of 'key'-'value' pairs.
	 */
	protected function retrieve_post_data( $post_ids, $meta_keys, $replacer ) {
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
				$post_type         = $post->post_type;

				/*
				 * For title we need to check if there is a modified SEO-title available and save it.
				 * If the SEO title was not modified, we check if the user specified a default SEO title for this content type.
				 * Otherwise we use a default title '%%title%% %%sep%% %%sitename%%' (WPSEO_Frontend::$default_title).
				 */
				if ( $meta_key === 'title' ) {
					$meta_data_for_key = $this->check_for_default_title( $meta_data_for_key, $post_type );
				}

				/*
				 * For meta description we need to check if there is a modified meta description available and save it.
				 * If the meta description was not modified, we check if the user specified a default meta description for this content type.
				 */
				if ( $meta_key === 'metadesc' && $meta_data_for_key === '' ) {
					$meta_data_for_key = $this->check_for_default_metadescription( $meta_data_for_key, $post_type );
				}

				$meta_key_name = $meta_info[ $meta_key ]['name'];

				// Apply json decoder to meta keys that are arrays (e.g., related keywords).
				if ( $meta_info[ $meta_key ]['should_decode'] ) {
					$meta_data[ $meta_key_name ] = json_decode( $meta_data_for_key );
				}
				else {
					$meta_data[ $meta_key_name ] = $meta_data_for_key;

					if ( $meta_info[ $meta_key ]['should_replace_vars'] ) {
						$meta_data[ $meta_key_name ] = $this->process_replacevars( $meta_data_for_key, $post, $replacer );
					}
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
	 * Replaces any replace variables (e.g. `%%sitename%% or `%%title%%`) in the given string with their corresponding values.
	 * Replace variables in the form `%%replacevar%%` that could not be replaced are removed from the string.
	 *
	 * @param string             $string   The string to replace the variables in.
	 * @param WP_Post            $post     The post to be used as context when replacing the replace vars (e.g. to get the post's title from).
	 * @param WPSEO_Replace_Vars $replacer The replacer to use to replace the variables with.
	 *
	 * @return string The given string, with the replace variables replaced.
	 */
	public function process_replacevars( $string, $post, $replacer ) {
		$replaced = $replacer->replace( $string, $post->to_array(), $replacer );
		// Remove non-replaced variables in the form `%%something%%`.
		$replaced = preg_replace( '`(%%[^\s%]+%%)+`iu', '', $replaced );
		return $replaced;
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
