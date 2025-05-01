<?php

namespace Yoast\WP\SEO\Premium\Conditionals;

use Yoast\WP\SEO\Conditionals\Conditional;

/**
 * Conditional that is only met when on the plugins page.
 */
class Plugins_Page_Conditional implements Conditional {

	/**
	 * Returns `true` when on the plugins page.
	 *
	 * @return bool `true` when on the plugins page.
	 */
	public function is_met() {
		global $pagenow;

		$target_pages = [
			'plugins.php',
		];

		return \in_array( $pagenow, $target_pages, true );
	}
}
