<?php

namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A minimal job posting, containing required blocks only.
 *
 * @deprecated 20.5
 * @codeCoverageIgnore
 */
abstract class Job_Posting_Base_Pattern extends Block_Pattern {

	/**
	 * Includes this Job Posting block pattern in the Yoast Job Posting block pattern category.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return array The categories under which this block pattern should be shown.
	 */
	public function get_categories() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
		return [];
	}

	/**
	 * Gets the keywords of this block pattern.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return array The keywords that help users discover the pattern while searching.
	 */
	public function get_keywords() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
		return [];
	}
}
