<?php

namespace Yoast\WP\SEO\Premium\Conditionals;

use Yoast\WP\SEO\Conditionals\Conditional;
use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper;

/**
 * Conditional that is only met when the Zapier integration is enabled.
 *
 * @deprecated 20.7
 * @codeCoverageIgnore
 */
class Zapier_Enabled_Conditional implements Conditional {

	/**
	 * The Zapier helper.
	 *
	 * @var Zapier_Helper
	 */
	private $zapier;

	/**
	 * Zapier_Enabled_Conditional constructor.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param Zapier_Helper $zapier The Zapier helper.
	 */
	public function __construct( Zapier_Helper $zapier ) {
		\_deprecated_function( __METHOD__, 'WPSEO Premium 20.7' );

		$this->zapier = $zapier;
	}

	/**
	 * Returns whether or not this conditional is met.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @return bool Whether or not the conditional is met.
	 */
	public function is_met() {
		\_deprecated_function( __METHOD__, 'WPSEO Premium 20.7' );

		return $this->zapier->is_enabled();
	}
}
