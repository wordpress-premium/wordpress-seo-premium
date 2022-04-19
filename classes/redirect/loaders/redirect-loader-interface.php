<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Loaders
 */

/**
 * Represents a redirect loader for external sources.
 */
interface WPSEO_Redirect_Loader {

	/**
	 * Loads the redirects from an external source and validates them.
	 *
	 * @return WPSEO_Redirect[] The loaded redirects.
	 */
	public function load();
}
