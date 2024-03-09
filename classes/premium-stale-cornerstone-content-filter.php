<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Admin
 */

/**
 * Registers the filter for filtering stale cornerstone content.
 */
class WPSEO_Premium_Stale_Cornerstone_Content_Filter extends WPSEO_Abstract_Post_Filter {

	/**
	 * Returns the query value this filter uses.
	 *
	 * @return string The query value this filter uses.
	 */
	public function get_query_val() {
		return 'stale-cornerstone-content';
	}

	/**
	 * Modifies the query based on the seo_filter variable in $_GET.
	 *
	 * @param string $where The where statement.
	 *
	 * @return string The modified query.
	 */
	public function filter_posts( $where ) {
		if ( ! $this->is_filter_active() ) {
			return $where;
		}

		global $wpdb;

		$where .= sprintf(
			' AND ' . $wpdb->posts . '.ID IN( SELECT post_id FROM ' . $wpdb->postmeta . ' WHERE meta_key = "%s" AND meta_value = "1" ) AND ' . $wpdb->posts . '.post_modified < "%s" ',
			WPSEO_Meta::$meta_prefix . 'is_cornerstone',
			$this->date_threshold()
		);

		return $where;
	}

	/**
	 * Returns the label for this filter.
	 *
	 * @return string The label for this filter.
	 */
	protected function get_label() {
		return __( 'Stale cornerstone content', 'wordpress-seo-premium' );
	}

	/**
	 * Returns a text explaining this filter.
	 *
	 * @return string|null The explanation for this filter.
	 */
	protected function get_explanation() {
		$post_type_object = get_post_type_object( $this->get_current_post_type() );

		if ( $post_type_object === null ) {
			return null;
		}

		return sprintf(
			/* translators: %1$s expands to dynamic post type label, %2$s expands anchor to blog post about cornerstone content, %3$s expands to </a> */
			__( 'Stale cornerstone content refers to cornerstone content that hasn’t been updated in the last 6 months. Make sure to keep these %1$s up-to-date. %2$sLearn more about cornerstone content%3$s.', 'wordpress-seo-premium' ),
			strtolower( $post_type_object->labels->name ),
			'<a href="' . WPSEO_Shortlinker::get( 'https://yoa.st/1i9' ) . '" target="_blank">',
			'</a>'
		);
	}

	/**
	 * Returns the total amount of stale cornerstone content.
	 *
	 * @return int The total amount of stale cornerstone content.
	 */
	protected function get_post_total() {
		global $wpdb;

		$post_type = $this->get_current_post_type();
		$cache_key = 'stale_cornerstone_count_' . $post_type;
		$count     = wp_cache_get( $cache_key, 'stale_cornerstone_counts' );

		if ( $count === false ) {
			$count = (int) $wpdb->get_var(
				$wpdb->prepare(
					'
					SELECT COUNT( 1 )
					FROM ' . $wpdb->postmeta . '
					WHERE post_id IN( SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = %s && post_modified < %s ) &&
					meta_value = "1" AND meta_key = %s
					',
					$post_type,
					$this->date_threshold(),
					WPSEO_Meta::$meta_prefix . 'is_cornerstone'
				)
			);
			wp_cache_set( $cache_key, $count, 'stale_cornerstone_counts', DAY_IN_SECONDS );
		}

		return $count;
	}

	/**
	 * Returns the post types to which this filter should be added.
	 *
	 * @return array<string> The post types to which this filter should be added.
	 */
	protected function get_post_types() {
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Using YoastSEO hook.
		$post_types = apply_filters( 'wpseo_cornerstone_post_types', parent::get_post_types() );
		if ( ! is_array( $post_types ) ) {
			return [];
		}

		return $post_types;
	}

	/**
	 * Returns the date 6 months ago.
	 *
	 * @return string The formatted date.
	 */
	protected function date_threshold() {
		return gmdate( 'Y-m-d', strtotime( '-6months' ) );
	}
}
