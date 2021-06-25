<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A minimal job posting, containing required blocks only.
 */
class Job_Posting_Minimal extends Job_Posting_Base_Pattern {

	/**
	 * Gets the name of this block pattern.
	 *
	 * @return string The name of this block pattern.
	 */
	public function get_name() {
		return 'yoast/job-posting/minimal';
	}

	/**
	 * Gets the title of this block pattern.
	 *
	 * @return string The title of this block pattern.
	 */
	public function get_title() {
		return 'Job Posting (minimal)';
	}

	/**
	 * Gets the contents of this block pattern.
	 *
	 * @return string The contents of this block pattern.
	 */
	public function get_content() {
		return '<!-- wp:yoast/job-description {"yoast-schema":null} -->
<div class="yoast-inner-container"><p data-id="description"></p></div>
<!-- /wp:yoast/job-description -->

<!-- wp:yoast/job-location -->
<div class="yoast-inner-container"></div>
<!-- /wp:yoast/job-location -->';
	}
}
