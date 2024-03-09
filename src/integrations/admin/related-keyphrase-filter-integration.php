<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Meta;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Take related keyphrases into account when filtering posts on keyphrase.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Related_Keyphrase_Filter_Integration implements Integration_Interface {

	/**
	 * The conditionals that should be met for this integration to be active.
	 *
	 * @return string[] A list of fully qualified class names of the `Conditional`s that should be met.
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Register the WordPress hooks needed for this integration to work.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_change_keyphrase_filter_in_request', [ $this, 'add_related_keyphrase_filter' ], 10, 2 );
	}

	/**
	 * Adapts the keyphrase filter to also take related keyphrases into account.
	 *
	 * @param array  $keyphrase_filter The current keyphrase filter.
	 * @param string $keyphrase        The keyphrase.
	 *
	 * @return array The new keyphrase filter,
	 */
	public function add_related_keyphrase_filter( $keyphrase_filter, $keyphrase ) {
		return [
			'relation' => 'OR',
			$keyphrase_filter,
			$this->get_related_keyphrase_filter( $keyphrase ),
		];
	}

	/**
	 * Returns the filter to use within the WP Meta Query to filter
	 * on related keyphrase.
	 *
	 * @param string $focus_keyphrase The focus keyphrase to filter on.
	 *
	 * @return array The filter.
	 */
	private function get_related_keyphrase_filter( $focus_keyphrase ) {
		return [
			'post_type' => \get_query_var( 'post_type', 'post' ),
			'key'       => WPSEO_Meta::$meta_prefix . 'focuskeywords',
			'value'     => '"keyword":"' . \sanitize_text_field( $focus_keyphrase ) . '"',
			'compare'   => 'LIKE',
		];
	}
}
