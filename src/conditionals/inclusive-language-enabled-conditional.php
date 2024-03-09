<?php

namespace Yoast\WP\SEO\Premium\Conditionals;

use WPSEO_Metabox_Analysis_Inclusive_Language;
use Yoast\WP\SEO\Conditionals\Conditional;

/**
 * Inclusive_Language_Enabled_Conditional class.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Inclusive_Language_Enabled_Conditional implements Conditional {

	/**
	 * Returns `true` when the inclusive language analysis is enabled.
	 *
	 * @return bool `true` when the inclusive language analysis is enabled.
	 */
	public function is_met() {
		$analysis_inclusive_language = new WPSEO_Metabox_Analysis_Inclusive_Language();
		return $analysis_inclusive_language->is_enabled();
	}
}
