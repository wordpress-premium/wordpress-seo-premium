<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Presenters
 */

/**
 * Represents a presenter for a redirects UI component.
 */
interface WPSEO_Redirect_Presenter {

	/**
	 * Displaying the table URL or regex. Depends on the current active tab.
	 *
	 * @param array $display Contextual display data.
	 *
	 * @return void
	 */
	public function display( array $display = [] );
}
