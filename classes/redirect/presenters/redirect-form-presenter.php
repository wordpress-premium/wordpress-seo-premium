<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Presenters
 */

/**
 * The presenter for the form, this form will be used for adding and updating the redirects.
 */
class WPSEO_Redirect_Form_Presenter implements WPSEO_Redirect_Presenter {

	/**
	 * Variables to be passed to the form view.
	 *
	 * @var array
	 */
	private $view_vars;

	/**
	 * Setting up the view_vars.
	 *
	 * @param array $view_vars The variables to pass into the view.
	 */
	public function __construct( array $view_vars ) {
		$this->view_vars = $view_vars;

		$this->view_vars['redirect_types'] = $this->get_redirect_types();
	}

	/**
	 * Display the form.
	 *
	 * @param array $display Additional display variables.
	 *
	 * @return void
	 */
	public function display( array $display = [] ) {
		$display_vars = $this->view_vars;
		if ( ! empty( $display ) ) {
			$display_vars = array_merge_recursive( $display_vars, $display );
		}

		require WPSEO_PREMIUM_PATH . 'classes/redirect/views/redirects-form.php';
	}

	/**
	 * Getting array with the available redirect types.
	 *
	 * @return array Array with the redirect types.
	 */
	private function get_redirect_types() {
		$types = new WPSEO_Redirect_Types();

		return $types->get();
	}
}
