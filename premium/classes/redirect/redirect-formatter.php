<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class for formatting redirects.
 */
class WPSEO_Redirect_Formatter {

	/**
	 * Formats a redirect into a executable redirect.
	 *
	 * @param WPSEO_Redirect $redirect The original redirect.
	 *
	 * @return WPSEO_Executable_Redirect The executable redirect.
	 */
	public function format( WPSEO_Redirect $redirect ) {
		return new WPSEO_Executable_Redirect(
			$redirect->get_origin(),
			$redirect->get_target(),
			$redirect->get_type(),
			$redirect->get_format()
		);
	}
}
