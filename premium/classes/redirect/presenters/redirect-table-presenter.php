<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Presenters
 */

/**
 * Class WPSEO_Redirect_Table_Presenter.
 */
class WPSEO_Redirect_Table_Presenter extends WPSEO_Redirect_Tab_Presenter {

	/**
	 * Gets the variables for the view.
	 *
	 * @param array $passed_vars Optional. View data manually passed. Default empty array.
	 *
	 * @return array Contextual variables to pass to the view.
	 */
	protected function get_view_vars( array $passed_vars = array() ) {
		$redirect_manager = new WPSEO_Redirect_Manager( $this->view );

		return array_merge(
			$passed_vars,
			array(
				'redirect_table'   => new WPSEO_Redirect_Table(
					$this->view,
					$this->get_first_column_value(),
					$redirect_manager->get_redirects()
				),
				'origin_from_url'  => $this->get_old_url(),
				'quick_edit_table' => new WPSEO_Redirect_Quick_Edit_Presenter(),
				'form_presenter'   => new WPSEO_Redirect_Form_Presenter(
					array(
						'origin_label_value' => $this->get_first_column_value(),
					)
				),
			)
		);
	}

	/**
	 * Get the old URL from the URL.
	 *
	 * @return string The old URL.
	 */
	private function get_old_url() {
		// Check if there's an old URL set.
		$old_url = filter_input( INPUT_GET, 'old_url', FILTER_DEFAULT, array( 'default' => '' ) );

		if ( $old_url !== '' ) {
			return esc_attr( rawurldecode( $old_url ) );
		}

		return $old_url;
	}

	/**
	 * Return the value of the first column based on the table type.
	 *
	 * @return string The value of the first column.
	 */
	private function get_first_column_value() {
		if ( $this->view === 'regex' ) {
			return __( 'Regular Expression', 'wordpress-seo-premium' );
		}

		return __( 'Old URL', 'wordpress-seo-premium' );
	}
}
