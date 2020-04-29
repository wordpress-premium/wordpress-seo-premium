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
	 *
	 * @var array An array with meta key names and settings.
	 */
	public $meta_keys = [
		'focuskw' => [
			'name'                => 'focus_keyphrase',
			'should_decode'       => false,
			'should_replace_vars' => false,
		],
		'metadesc' => [
			'name'                => 'meta_description',
			'should_decode'       => false,
			'should_replace_vars' => true,
		],
		'focuskeywords' => [
			'name'                => 'related_keyphrases',
			'should_decode'       => true,
			'should_replace_vars' => false,
		],
		'keywordsynonyms' => [
			'name'                => 'keyphrase_synonyms',
			'should_decode'       => true,
			'should_replace_vars' => false,
		],
		'title' => [
			'name'                => 'meta_title',
			'should_decode'       => false,
			'should_replace_vars' => true,
		],
	];

	/**
	 * A private instance of the WPSEO_Replace_Vars.
	 *
	 * @var WPSEO_Replace_Vars An instance of WPSEO_Replace_Vars.
	 */
	private $replacer;

	/**
	 * A private instance of the WPSEO_Premium_Prominent_Words_Unindexed_Post_Query.
	 *
	 * @var WPSEO_Premium_Prominent_Words_Unindexed_Post_Query An instance of the WPSEO_Premium_Prominent_Words_Unindexed_Post_Query.
	 */
	private $prominent_words_query;

	/**
	 * A private instance of the WPSEO_Premium_Prominent_Words_Support.
	 *
	 * @var WPSEO_Premium_Prominent_Words_Support An instance of the WPSEO_Premium_Prominent_Words_Support
	 */
	private $prominent_words_support;

	/**
	 * WPSEO_Premium_Post_Data_Service constructor.
	 *
	 * @param WPSEO_Replace_Vars                                 $replacer                An instance of WPSEO_Replace_Vars.
	 * @param WPSEO_Premium_Prominent_Words_Unindexed_Post_Query $prominent_words_query   An instance of WPSEO_Premium_Prominent_Words_Unindexed_Post_Query.
	 * @param WPSEO_Premium_Prominent_Words_Support              $prominent_words_support An instance of WPSEO_Premium_Prominent_Words_Support.
	 */
	public function __construct(
		WPSEO_Replace_Vars $replacer,
		WPSEO_Premium_Prominent_Words_Unindexed_Post_Query $prominent_words_query,
		WPSEO_Premium_Prominent_Words_Support $prominent_words_support
	) {
		$this->replacer                = $replacer;
		$this->prominent_words_query   = $prominent_words_query;
		$this->prominent_words_support = $prominent_words_support;
	}

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
		$post_type = $this->prominent_words_support->get_supported_post_types();

		// Set the post ids that are yet to be indexed.
		$post_ids = $this->prominent_words_query->get_unindexed_post_ids( $post_type, $limit );

		// If no posts have been left unindexed, return the empty array.
		if ( ! $post_ids ) {
			return new WP_REST_Response( [] );
		}

		// Retrieve and set the relevant posts.
		$posts = $this->retrieve_posts( $post_ids, $post_type );

		// Retrieve the posts and their meta data from the database (and processes shortcodes).
		// Return the enriched posts.
		return new WP_REST_Response( $this->retrieve_post_data( $posts ) );
	}

	/**
	 * Gets the meta_keys set in this class.
	 *
	 * @return array The meta keys.
	 */
	public function get_meta_keys() {
		return $this->meta_keys;
	}

	/**
	 * Gets the unindexed posts.
	 *
	 * @param array $post_ids   A list of ids from unindexed posts.
	 * @param array $post_types The post types to include.
	 *
	 * @return int[]|WP_Post[] An array of posts that match the requirements.
	 */
	public function retrieve_posts( $post_ids, $post_types ) {
		// Retrieve post content of all the posts based on their IDs.
		return get_posts(
			[
				'include'     => $post_ids,
				'post_type'   => $post_types,
				'post_status' => $this->prominent_words_query->get_supported_post_statuses(),
			]
		);
	}

	/**
	 * Retrieves post content and Yoast metadata (focus keyphrase, meta description etc.) from the database and
	 * groups these attributes per post.
	 *
	 * @param array $posts The posts to retrieve data for.
	 *
	 * @return array An indexed array of SQL query results, where each item corresponds to a post.
	 * Every item is an associative array containing the fields 'post_id', 'post_content' and 'meta',
	 * where the latter is a collection of 'key'-'value' pairs.
	 */
	protected function retrieve_post_data( $posts ) {
		$results = [];

		// Now retrieve meta data per post and per meta key.
		foreach ( $posts as $post ) {
			$results[] = $this->build_post_data( $post );
		}

		return $results;
	}

	/**
	 * Wraps a static method WPSEO_Meta::get_value to be able to access it in tests.
	 *
	 * @codeCoverageIgnore This will always be mocked in unit tests.
	 *
	 * @param string $meta_key The name of the meta key that needs to be extracted.
	 * @param int    $post_id  The ID of the post to extract meta key for.
	 *
	 * @return string The value of the meta key for the given post_id
	 */
	protected function get_meta_value_wrapper( $meta_key, $post_id ) {
		return WPSEO_Meta::get_value( $meta_key, $post_id );
	}

	/**
	 * Wraps a static method WPSEO_Options::get to be able to access it in tests.
	 * The original function retrieves a single field from any option for the SEO plugin.
	 *
	 * @codeCoverageIgnore This will always be mocked in unit tests.
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
	 * Otherwise use the absolute default title '%%title%% %%sep%% %%sitename%%'.
	 *
	 * @param string $post_type The content type to use default for.
	 *
	 * @return string The post-specific or a default title.
	 */
	private function apply_default_title( $post_type ) {
		// Try to obtain user-specified defaults for the given content type (post, page, etc.).
		$user_default_title = $this->get_options_wrapper( 'title-' . $post_type, '' );
		if ( ! empty( $user_default_title ) ) {
			return $user_default_title;
		}

		// Return the absolute default value, which is currently set to '%%title%% %%sep%% %%sitename%%'.
		return '%%title%% %%sep%% %%sitename%%';
	}

	/**
	 * Replaces any replace variables (e.g. `%%sitename%% or `%%title%%`) in the given string with their corresponding values.
	 * Replace variables in the form `%%replacevar%%` that could not be replaced are removed from the string.
	 *
	 * @param string  $string The string to replace the variables in.
	 * @param WP_Post $post   The post to be used as context when replacing the replace vars (e.g. to get the post's title from).
	 *
	 * @return string The given string, with the replace variables replaced.
	 */
	public function process_replacevars( $string, $post ) {
		$replaced = $this->replacer->replace( $string, $post->to_array() );

		/*
		 * Remove non-replaced variables in the form ` %%something%% `.
		 * Note that only replacement variables that are surrounded by a space on either side are captured,
		 * and that the replacement is a single space.
		 */
		return preg_replace( '`(\s%%[^\s%]+%%\s)+`iu', ' ', $replaced );
	}

	/**
	 * Returns the content from a post, in which shortcodes have been replaced.
	 *
	 * @param WP_Post $post_with_shortcodes An WP post.
	 *
	 * @return string The content of the post with all shortcodes in the post content processed.
	 */
	public function process_shortcodes( $post_with_shortcodes ) {
		global $post;

		/*
		 * Set the global $post to be the post in this iteration.
		 * This is required for post-specific shortcodes that reference the global post.
		 */

		// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- To setup the post we need to do this explicitly.
		$post = $post_with_shortcodes;
		// Set up WordPress data for this post, outside of "the_loop".
		setup_postdata( $post );
		$content = do_shortcode( $post->post_content );
		wp_reset_postdata();

		return $content;
	}

	/**
	 * Builds the data for a post.
	 *
	 * @param WP_Post $post A WordPress post.
	 *
	 * @return array The enriched post.
	 */
	protected function build_post_data( $post ) {
		$meta_data = [];

		foreach ( $this->get_meta_keys() as $meta_key => $meta_info ) {
			$meta_data_for_key = $this->get_meta_value_wrapper( $meta_key, $post->ID );
			$post_type         = $post->post_type;

			/*
			 * If there is no meta_data for the current key, check for default settings
			 *
			 * For title we need to check if there is a modified SEO-title available and save it.
			 * If the SEO title was not modified, we check if the user specified a default SEO title for this content type.
			 * Otherwise we use the default title '%%title%% %%sep%% %%sitename%%'.
			 *
			 * If the meta description was not modified, we check if the user specified a default meta description for this content type.
			 */
			if ( $meta_data_for_key === '' ) {
				switch ( $meta_key ) {
					case 'title':
						$meta_data_for_key = $this->apply_default_title( $post_type );
						break;
					case 'metadesc':
						$meta_data_for_key = $this->get_options_wrapper( 'metadesc-' . $post_type, '' );
						break;
				}
			}

			// Get the name we use as a human readable meta_data label in the results.
			$meta_key_name = $meta_info['name'];
			// Apply json decoder to meta keys that are arrays (e.g., related keywords).
			if ( $meta_info['should_decode'] ) {
				$meta_data[ $meta_key_name ] = json_decode( $meta_data_for_key );
			}
			else {
				$meta_data[ $meta_key_name ] = $meta_data_for_key;
				if ( $meta_info['should_replace_vars'] ) {
					$meta_data[ $meta_key_name ] = $this->process_replacevars( $meta_data_for_key, $post );
				}
			}
		}

		return [
			'ID'           => $post->ID,
			'post_content' => $this->process_shortcodes( $post ),
			'meta'         => $meta_data,
		];
	}
}
