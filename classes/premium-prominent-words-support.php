<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Represents the functionality for the prominent words support.
 */
class WPSEO_Premium_Prominent_Words_Support {

	/**
	 * Returns an array with the supported post types.
	 *
	 * @return array The supported post types.
	 */
	public function get_supported_post_types() {
		/**
		 * Filter: 'Yoast\WP\SEO\prominent_words_post_types' - Allows changes for the accessible post types.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 12.9.0
		 *
		 * @api array The accessible post types.
		 */
		$prominent_words_post_types = apply_filters(
			'Yoast\WP\SEO\prominent_words_post_types',
			WPSEO_Post_Type::get_accessible_post_types()
		);

		if ( ! is_array( $prominent_words_post_types ) || empty( $prominent_words_post_types ) ) {
			$prominent_words_post_types = [];
		}

		$prominent_words_post_types = WPSEO_Post_Type::filter_attachment_post_type( $prominent_words_post_types );
		$prominent_words_post_types = array_filter( $prominent_words_post_types, [ 'WPSEO_Post_Type', 'has_metabox_enabled' ] );

		/*
		 * The above combination of functions results in array looking like this:
		 * [
		 *   `post` => `post`
		 *   `page` => `page`
		 * ]
		 *
		 * This can result in problems downstream when trying to array_merge this twice.
		 * array_values prevents this issue by ensuring numeric keys.
		 */
		$prominent_words_post_types = array_values( $prominent_words_post_types );

		return $prominent_words_post_types;
	}

	/**
	 * Checks if the post type is supported.
	 *
	 * @param string $post_type The post type to look up.
	 *
	 * @return bool True when post type is supported.
	 */
	public function is_post_type_supported( $post_type ) {
		return in_array( $post_type, $this->get_supported_post_types(), true );
	}

	/**
	 * Retrieves a list of taxonomies that are public, viewable and have the metabox enabled.
	 *
	 * @return array The supported taxonomies.
	 */
	public function get_supported_taxonomies() {
		$taxonomies = get_taxonomies( [ 'public' => true ] );
		$taxonomies = array_filter( $taxonomies, 'is_taxonomy_viewable' );

		/**
		 * Filter: 'Yoast\WP\SEO\prominent_words_taxonomies' - Allows to filter from which taxonomies terms are eligible for generating prominent words.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 14.7.0
		 *
		 * @api array The accessible taxonomies.
		 */
		$prominent_words_taxonomies = apply_filters(
			'Yoast\WP\SEO\prominent_words_taxonomies',
			$taxonomies
		);

		if ( ! is_array( $prominent_words_taxonomies ) || empty( $prominent_words_taxonomies ) ) {
			return [];
		}

		$prominent_words_taxonomies = array_filter(
			$prominent_words_taxonomies,
			static function( $taxonomy ) {
				return (bool) WPSEO_Options::get( 'display-metabox-tax-' . $taxonomy, true );
			}
		);

		return array_values( $prominent_words_taxonomies );
	}

	/**
	 * Checks if the taxonomy is supported.
	 *
	 * @param string $taxonomy The taxonomy to look up.
	 *
	 * @return bool True when taxonomy is supported.
	 */
	public function is_taxonomy_supported( $taxonomy ) {
		return in_array( $taxonomy, $this->get_supported_taxonomies(), true );
	}
}
