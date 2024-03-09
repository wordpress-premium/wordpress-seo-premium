<?php

namespace Yoast\WP\SEO\Premium\Conditionals;

use Yoast\WP\SEO\Conditionals\Conditional;

/**
 * Conditional that is only met when on a term overview page or during an ajax request.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Term_Overview_Or_Ajax_Conditional implements Conditional {

	/**
	 * Returns whether or not this conditional is met.
	 *
	 * @return bool Whether or not the conditional is met.
	 */
	public function is_met() {
		global $pagenow;
		return $pagenow === 'edit-tags.php' || \wp_doing_ajax();
	}
}
