<?php
/**
 * @package Yoast\WP\HelpScout
 */

if ( ! function_exists( 'yoast_get_helpscout_beacon' ) ) {
	/**
	 * Retrieve the instance of the beacon
	 *
	 * @param string $page The current admin page.
	 * @param string $type Which type of popup we want to show.
	 *
	 * @return Yoast_HelpScout_Beacon
	 */
	function yoast_get_helpscout_beacon( $page, $type = Yoast_HelpScout_Beacon::BEACON_TYPE_SEARCH ) {
		static $beacon;

		if ( ! isset( $beacon ) ) {
			$beacon = new Yoast_HelpScout_Beacon( $page, array(), $type );
		}

		return $beacon;
	}
}
