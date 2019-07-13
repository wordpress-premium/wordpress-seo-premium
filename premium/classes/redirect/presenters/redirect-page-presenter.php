<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Presenters
 */

/**
 * Class WPSEO_Redirect_Page_Presenter
 */
class WPSEO_Redirect_Page_Presenter implements WPSEO_Redirect_Presenter {

	/**
	 * Displays the redirect page.
	 *
	 * @param array $display Contextual display data.
	 *
	 * @return void
	 */
	public function display( array $display = array() ) {
		$current_tab   = ! empty( $display['current_tab'] ) ? $display['current_tab'] : '';
		$tab_presenter = $this->get_tab_presenter( $current_tab );
		$redirect_tabs = $this->navigation_tabs( $current_tab );

		include WPSEO_PREMIUM_PATH . 'classes/redirect/views/redirects.php';
	}

	/**
	 * Returns a tab presenter.
	 *
	 * @param string $tab_to_display The tab that will be shown.
	 *
	 * @return WPSEO_Redirect_Tab_Presenter|null Tab presenter instance, or null if invalid tab given.
	 */
	private function get_tab_presenter( $tab_to_display ) {
		$tab_presenter = null;
		switch ( $tab_to_display ) {
			case WPSEO_Redirect_Formats::PLAIN:
			case WPSEO_Redirect_Formats::REGEX:
				$tab_presenter = new WPSEO_Redirect_Table_Presenter( $tab_to_display );
				break;
			case 'settings':
				if ( current_user_can( 'wpseo_manage_options' ) ) {
					$tab_presenter = new WPSEO_Redirect_Settings_Presenter( $tab_to_display );
				}
				break;
		}

		return $tab_presenter;
	}

	/**
	 * Returning the anchors html for the tabs
	 *
	 * @param string $current_tab The tab that will be active.
	 *
	 * @return array {
	 *     Associative array of navigation tabs data.
	 *
	 *     @type array  $tabs        Array of $tab_slug => $tab_label pairs.
	 *     @type string $current_tab The currently active tab slug.
	 *     @type string $page_url    Base URL of the current page, to append the tab slug to.
	 * }
	 */
	private function navigation_tabs( $current_tab ) {
		$tabs = $this->get_redirect_formats();

		if ( current_user_can( 'wpseo_manage_options' ) ) {
			$tabs['settings'] = __( 'Settings', 'wordpress-seo-premium' );
		}

		return array(
			'tabs'        => $tabs,
			'current_tab' => $current_tab,
			'page_url'    => admin_url( 'admin.php?page=wpseo_redirects&tab=' ),
		);
	}

	/**
	 * Gets the available redirect formats.
	 *
	 * @return array Redirect formats as $slug => $label pairs.
	 */
	protected function get_redirect_formats() {
		$redirect_formats = new WPSEO_Redirect_Formats();

		return $redirect_formats->get();
	}
}
