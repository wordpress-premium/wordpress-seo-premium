<?php

namespace Yoast\WP\SEO\Premium\Initializers;

use Automattic\WooCommerce\Utilities\FeaturesUtil;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Initializers\Initializer_Interface;

/**
 * Declares compatibility with the WooCommerce HPOS feature.
 */
class Woocommerce implements Initializer_Interface {

	use No_Conditionals;

	/**
	 * Hooks into WooCommerce.
	 */
	public function initialize() {
			\add_action( 'before_woocommerce_init', [ $this, 'declare_custom_order_tables_compatibility' ] );
	}

	/**
	 * Declares compatibility with the WooCommerce HPOS feature.
	 */
	public function declare_custom_order_tables_compatibility() {
		if ( \class_exists( FeaturesUtil::class ) ) {
			FeaturesUtil::declare_compatibility( 'custom_order_tables', \WPSEO_PREMIUM_FILE, true );
		}
	}
}
