<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Presenters
 */

/**
 * Class WPSEO_Redirect_Tab_Presenter.
 */
abstract class WPSEO_Redirect_Tab_Presenter implements WPSEO_Redirect_Presenter {

	/**
	 * The view to be rendered in the tab.
	 *
	 * @var string
	 */
	protected $view;

	/**
	 * Constructor.
	 *
	 * Sets the view.
	 *
	 * @param string $view The view to display.
	 */
	public function __construct( $view ) {
		$this->view = $view;
	}

	/**
	 * Displaying the table URL or regex. Depends on the current active tab.
	 *
	 * @param array $display Contextual display data.
	 *
	 * @return void
	 */
	public function display( array $display = array() ) {
		extract( $this->get_view_vars( $display ) );

		include WPSEO_PREMIUM_PATH . 'classes/redirect/views/redirects-tab-' . $this->view . '.php';
	}

	/**
	 * The method to get the variables for the view. This method should return an array, because this will be extracted.
	 *
	 * @param array $passed_vars Optional. View data manually passed. Default empty array.
	 *
	 * @return array Contextual variables to pass to the view.
	 */
	abstract protected function get_view_vars( array $passed_vars = array() );
}
