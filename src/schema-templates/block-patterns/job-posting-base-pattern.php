<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
// phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A minimal job posting, containing required blocks only.
 */
abstract class Job_Posting_Base_Pattern extends Block_Pattern {

	/**
	 * Includes this Job Posting block pattern in the Yoast Job Posting block pattern category.
	 *
	 * @return array The categories under which this block pattern should be shown.
	 */
	public function get_categories() {
				return [ Block_Pattern_Categories::YOAST_JOB_POSTING ];
	}

	/**
	 * Gets the keywords of this block pattern.
	 *
	 * @return array The keywords that help users discover the pattern while searching.
	 */
	public function get_keywords() {
				return [ Block_Pattern_Keywords::YOAST_JOB_POSTING ];
	}
}
