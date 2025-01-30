<?php

namespace Yoast\WP\SEO\Premium\Conditionals;

use Yoast\WP\SEO\Conditionals\Conditional;

/**
 * Conditional that is only met when post type is not 'shop_order'.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Not_Woo_Order_Conditional implements Conditional {

	/**
	 * Returns `false` when post type is 'shop_order'.
	 *
	 * @return bool `false` when post type is 'shop_order'.
	 */
	public function is_met() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['post_type'] ) && \is_string( $_GET['post_type'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are not processing form information, We are only strictly comparing.
			if ( \wp_unslash( $_GET['post_type'] ) === 'shop_order' ) {
				return false;
			}
		}

		return true;
	}
}
