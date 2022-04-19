<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Presenters
 */

/**
 * Presenter for the quick edit
 */
class WPSEO_Redirect_Quick_Edit_Presenter implements WPSEO_Redirect_Presenter {

	/**
	 * Displays the table
	 *
	 * @param array $display_data Data to display on the table.
	 *
	 * @return void
	 */
	public function display( array $display_data = [] ) {
		require WPSEO_PREMIUM_PATH . 'classes/redirect/views/redirects-quick-edit.php';
	}
}
