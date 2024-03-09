<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class WPSEO_Premium_Redirect_Export_Manager
 */
class WPSEO_Premium_Redirect_Export_Manager implements WPSEO_WordPress_Integration {

	/**
	 * Registers all hooks to WordPress.
	 *
	 * @return void
	 */
	public function register_hooks() {
		// Add export CSV block, the import and export settings are confusingly named only import.
		add_action( 'wpseo_import_tab_content', [ $this, 'add_redirect_export_block' ] );
		add_action( 'wpseo_import_tab_header', [ $this, 'redirects_export_header' ] );

		// Hijack the request in case of CSV download and return our generated CSV instead.
		add_action( 'admin_init', [ $this, 'redirects_csv_export' ] );
	}

	/**
	 * Outputs a tab header for the CSV export block.
	 *
	 * @return void
	 */
	public function redirects_export_header() {
		if ( current_user_can( 'export' ) ) {
			echo '<a class="nav-tab" id="export-redirects-tab" href="#top#export-redirects">'
				. esc_html__( 'Export redirects', 'wordpress-seo-premium' )
				. '</a>';
		}
	}

	/**
	 * Adding the export block for CSV. Makes it able to export redirects to CSV.
	 *
	 * @return void
	 */
	public function add_redirect_export_block() {
		// Display the forms.
		if ( current_user_can( 'export' ) ) {
			require WPSEO_PREMIUM_PATH . 'classes/views/export-redirects.php';
		}
	}

	/**
	 * Hijacks the request and returns a CSV file if we're on the right page with the right method and the right capabilities.
	 *
	 * @return void
	 */
	public function redirects_csv_export() {
		if ( $this->is_valid_csv_export_request() && current_user_can( 'export' ) ) {
			// Check if we have a valid nonce.
			check_admin_referer( 'wpseo-export' );

			// Clean any content that has been already outputted, for example by other plugins or faulty PHP files.
			if ( ob_get_contents() ) {
				ob_clean();
			}

			// Set CSV headers and content.
			$this->set_csv_headers();
			echo $this->get_csv_contents();

			// And exit so we don't start appending HTML to our CSV file.
			// NOTE: this makes this entire class untestable as it will exit all tests but WordPress seems to have no elegant way of handling this.
			exit();
		}
	}

	/**
	 * Are we on the wpseo_tools page in the import-export tool and have we received an export post request?
	 *
	 * @return bool
	 */
	protected function is_valid_csv_export_request() {
		// phpcs:disable WordPress.Security.NonceVerification -- Reason: Nonce is checked in export.
		// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: We are strictly comparing only or ignoring the value.
		return ( isset( $_GET['page'] ) && is_string( $_GET['page'] ) && wp_unslash( $_GET['page'] ) === 'wpseo_tools' )
			&& ( isset( $_GET['tool'] ) && is_string( $_GET['tool'] ) && wp_unslash( $_GET['tool'] ) === 'import-export' )
			&& ( isset( $_POST['export'] ) && ! empty( $_POST['export'] ) );
		// phpcs:enable
	}

	/**
	 * Sets the headers to trigger an CSV download in the browser.
	 *
	 * @return void
	 */
	protected function set_csv_headers() {
		header( 'Content-type: text/csv' );
		header( 'Content-Disposition: attachment; filename=wordpress-seo-redirects.csv' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );
	}

	/**
	 * Generates CSV from all redirects.
	 *
	 * @return string
	 */
	protected function get_csv_contents() {
		// Grab all our redirects.
		$redirect_manager = new WPSEO_Redirect_Manager();
		$redirects        = $redirect_manager->get_all_redirects();

		$csv_exporter = new WPSEO_Redirect_CSV_Exporter();
		return $csv_exporter->export( $redirects );
	}
}
