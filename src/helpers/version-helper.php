<?php

namespace Yoast\WP\SEO\Premium\Helpers;

use Yoast\WP\SEO\Premium\Addon_Installer;

/**
 * Helper class to check the status of the Free and Premium versions.
 */
class Version_Helper {

	/**
	 * Checks whether Free is active and set to a version later than the minimum required.
	 *
	 * @return bool
	 */
	public function is_free_upgraded() {
		return ( \defined( 'WPSEO_VERSION' ) && \version_compare( \WPSEO_VERSION, Addon_Installer::MINIMUM_YOAST_SEO_VERSION . '-RC0', '>' ) );
	}

	/**
	 * Checks whether a new update is available for Premium.
	 *
	 * @return bool
	 */
	public function is_premium_update_available() {
		$plugin_updates = \get_plugin_updates();
		return isset( $plugin_updates[ \WPSEO_PREMIUM_BASENAME ] );
	}
}
