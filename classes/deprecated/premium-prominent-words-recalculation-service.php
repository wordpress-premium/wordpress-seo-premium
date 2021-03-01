<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

_deprecated_file( __FILE__, 'WPSEO Premium 14.5' );

/**
 * Represents the service for the recalculation.
 */
class WPSEO_Premium_Prominent_Words_Recalculation_Service {

	/**
	 * Removes the recalculation notification.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @param WP_REST_Request $request The current request. Unused.
	 *
	 * @return WP_REST_Response The response to give.
	 */
	public function remove_notification( WP_REST_Request $request ) {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );

		return new WP_REST_Response( '1' );
	}
}
