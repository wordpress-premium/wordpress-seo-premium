<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class WPSEO_Premium_Import_Manager
 */
class WPSEO_Premium_Import_Manager implements WPSEO_WordPress_Integration {

	/**
	 * Holds the import object.
	 *
	 * @var stdClass
	 */
	protected $import;

	/**
	 * Registers the hooks.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		// Handle premium imports.
		add_filter( 'wpseo_handle_import', [ $this, 'do_premium_imports' ] );

		// Add htaccess import block.
		add_action( 'wpseo_import_tab_content', [ $this, 'add_redirect_import_block' ] );
		add_action( 'wpseo_import_tab_header', [ $this, 'redirects_import_header' ] );
	}

	/**
	 * Imports redirects from specified file or location.
	 *
	 * @param stdClass|bool $import The import object.
	 *
	 * @return stdClass The import status object.
	 */
	public function do_premium_imports( $import ) {
		if ( ! $import ) {
			$import = (object) [
				'msg'     => '',
				'success' => false,
				'status'  => null,
			];
		}

		$this->import = $import;
		$this->htaccess_import();
		$this->do_plugin_imports();
		$this->do_csv_imports();

		return $this->import;
	}

	/**
	 * Outputs a tab header for the htaccess import block.
	 *
	 * @return void
	 */
	public function redirects_import_header() {
		/* translators: %s: '.htaccess' file name */
		echo '<a class="nav-tab" id="import-htaccess-tab" href="#top#import-htaccess">' . esc_html__( 'Import redirects', 'wordpress-seo-premium' ) . '</a>';
	}

	/**
	 * Adding the import block for redirects.
	 *
	 * @return void
	 */
	public function add_redirect_import_block() {
		$import = $this->import;

		// Display the forms.
		require WPSEO_PREMIUM_PATH . 'classes/views/import-redirects.php';
	}

	/**
	 * Do .htaccess file import.
	 *
	 * @return void
	 */
	protected function htaccess_import() {
		$htaccess = $this->get_posted_htaccess();

		if ( ! $htaccess || $htaccess === '' ) {
			return;
		}

		try {
			$loader = new WPSEO_Redirect_HTAccess_Loader( $htaccess );
			$result = $this->import_redirects_from_loader( $loader );

			$this->set_import_success( $result );
		}
		catch ( WPSEO_Redirect_Import_Exception $e ) {
			$this->set_import_message( $e->getMessage() );
		}
	}

	/**
	 * Handles plugin imports.
	 *
	 * @return void
	 */
	protected function do_plugin_imports() {
		$import_plugin = $this->get_posted_import_plugin();

		if ( ! $import_plugin ) {
			return;
		}

		try {
			$loader = $this->get_plugin_loader( $import_plugin );
			$result = $this->import_redirects_from_loader( $loader );

			$this->set_import_success( $result );
		}
		catch ( WPSEO_Redirect_Import_Exception $e ) {
			$this->set_import_message( $e->getMessage() );
		}
	}

	/**
	 * Processes a CSV import.
	 *
	 * @return void
	 */
	protected function do_csv_imports() {
		$redirects_csv_file = $this->get_posted_csv_file();

		if ( ! $redirects_csv_file ) {
			return;
		}

		try {
			$this->validate_uploaded_csv_file( $redirects_csv_file );

			// Load the redirects from the uploaded file.
			$loader = new WPSEO_Redirect_CSV_Loader( $redirects_csv_file['tmp_name'] );
			$result = $this->import_redirects_from_loader( $loader );

			$this->set_import_success( $result );
		}
		catch ( WPSEO_Redirect_Import_Exception $e ) {
			$this->set_import_message( $e->getMessage() );
		}
	}

	/**
	 * Sets the import message.
	 *
	 * @param string $import_message The message.
	 *
	 * @return void
	 */
	protected function set_import_message( $import_message ) {
		$this->import->msg .= $import_message;
	}

	/**
	 * Sets the import success state to true.
	 *
	 * @param array $result The import result.
	 *
	 * @return void.
	 */
	protected function set_import_success( array $result ) {
		$this->import->success = true;

		$this->set_import_message(
			$this->get_success_message( $result['total_imported'], $result['total_redirects'] )
		);
	}

	/**
	 * Retrieves the success message when import has been successful.
	 *
	 * @param int $total_imported  The number of imported redirects.
	 * @param int $total_redirects The total amount of redirects.
	 *
	 * @return string The generated message.
	 */
	protected function get_success_message( $total_imported, $total_redirects ) {
		if ( $total_imported === $total_redirects ) {
			return sprintf(
				/* translators: 1: link to redirects overview, 2: closing link tag */
				__( 'All redirects have been imported successfully. Go to the %1$sredirects overview%2$s to see the imported redirects.', 'wordpress-seo-premium' ),
				'<a href="' . esc_url( admin_url( 'admin.php?page=wpseo_redirects' ) ) . '">',
				'</a>'
			);
		}

		if ( $total_imported === 0 ) {
			return sprintf(
				/* translators: 1: link to redirects overview, 2: closing link tag */
				__( 'No redirects have been imported. Probably they already exist as a redirect. Go to the %1$sredirects overview%2$s to see the existing redirects.', 'wordpress-seo-premium' ),
				'<a href="' . esc_url( admin_url( 'admin.php?page=wpseo_redirects' ) ) . '">',
				'</a>'
			);
		}

		return sprintf(
			/* translators: 1: amount of imported redirects, 2: total amount of redirects, 3: link to redirects overview, 4: closing link tag */
			_n(
				'Imported %1$s/%2$s redirects successfully. Go to the %3$sredirects overview%4$s to see the imported redirect.',
				'Imported %1$s/%2$s redirects successfully. Go to the %3$sredirects overview%4$s to see the imported redirects.',
				$total_imported,
				'wordpress-seo-premium'
			),
			$total_imported,
			$total_redirects,
			'<a href="' . esc_url( admin_url( 'admin.php?page=wpseo_redirects' ) ) . '">',
			'</a>'
		);
	}

	/**
	 * Returns a loader for the given plugin.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param string $plugin_name The plugin we want to load redirects from.
	 *
	 * @return bool|WPSEO_Redirect_Abstract_Loader The redirect loader.
	 *
	 * @throws WPSEO_Redirect_Import_Exception When the plugin is not installed or activated.
	 */
	protected function get_plugin_loader( $plugin_name ) {
		global $wpdb;

		switch ( $plugin_name ) {
			case 'redirection':
				// Only do import if Redirections is active.
				if ( ! defined( 'REDIRECTION_VERSION' ) ) {
					throw new WPSEO_Redirect_Import_Exception(
						__( 'Redirect import failed: the Redirection plugin is not installed or activated.', 'wordpress-seo-premium' )
					);
				}
				return new WPSEO_Redirect_Redirection_Loader( $wpdb );
			case 'safe_redirect_manager':
				return new WPSEO_Redirect_Safe_Redirect_Loader();
			case 'simple-301-redirects':
				return new WPSEO_Redirect_Simple_301_Redirect_Loader();
			default:
				throw new WPSEO_Redirect_Import_Exception(
					__( 'Redirect import failed: the selected redirect plugin is not installed or activated.', 'wordpress-seo-premium' )
				);
		}
	}

	/**
	 * Validates an uploaded CSV file.
	 *
	 * @param array $csv_file The file to upload, from the $_FILES object.
	 *
	 * @return void
	 *
	 * @throws WPSEO_Redirect_Import_Exception When the given file is invalid.
	 */
	protected function validate_uploaded_csv_file( $csv_file ) {

		// If no file is selected.
		if ( array_key_exists( 'name', $csv_file ) && $csv_file['name'] === '' ) {
			$error_message = __( 'CSV import failed: No file selected.', 'wordpress-seo-premium' );
			throw new WPSEO_Redirect_Import_Exception( $error_message );
		}

		// If the file upload failed for any other reason.
		if ( array_key_exists( 'error', $csv_file ) && $csv_file['error'] !== UPLOAD_ERR_OK ) {
			$error_message = __( 'CSV import failed: the provided file could not be parsed using a CSV parser.', 'wordpress-seo-premium' );
			throw new WPSEO_Redirect_Import_Exception( $error_message );
		}

		// If somehow the file is larger than it should be.
		if ( $csv_file['size'] > wp_max_upload_size() ) {
			$max_size_formatted = size_format( wp_max_upload_size() );
			/* translators: 1: The maximum file size */
			$error_message = sprintf( __( 'CSV import failed: the provided file is larger than %1$s.', 'wordpress-seo-premium' ), $max_size_formatted );
			throw new WPSEO_Redirect_Import_Exception( $error_message );
		}

		// If it's not a CSV file (send the csv mimetype along for multisite installations).
		$filetype = wp_check_filetype( $csv_file['name'], [ 'csv' => 'text/csv' ] );
		if ( strtolower( $filetype['ext'] ) !== 'csv' ) {
			$error_message = __( 'CSV import failed: the provided file is not a CSV file.', 'wordpress-seo-premium' );
			throw new WPSEO_Redirect_Import_Exception( $error_message );
		}
	}

	/**
	 * Imports all redirects from the loader.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param WPSEO_Redirect_Loader $loader The loader to import redirects from.
	 *
	 * @return array The result of the import.
	 *
	 * @throws WPSEO_Redirect_Import_Exception When there is no loader given or when there are no redirects.
	 */
	protected function import_redirects_from_loader( WPSEO_Redirect_Loader $loader ) {
		if ( ! $loader ) {
			throw new WPSEO_Redirect_Import_Exception(
				__( 'Redirect import failed: we can\'t recognize this type of import.', 'wordpress-seo-premium' )
			);
		}

		$redirects = $loader->load();

		if ( count( $redirects ) === 0 ) {
			throw new WPSEO_Redirect_Import_Exception(
				__( 'Redirect import failed: no redirects found.', 'wordpress-seo-premium' )
			);
		}

		$importer = new WPSEO_Redirect_Importer();
		return $importer->import( $redirects );
	}

	/**
	 * Retrieves the posted htaccess.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string The posted htaccess.
	 */
	protected function get_posted_htaccess() {
		return stripcslashes( filter_input( INPUT_POST, 'htaccess' ) );
	}

	/**
	 * Retrieves the posted import plugin.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string|null The posted import plugin.
	 */
	protected function get_posted_import_plugin() {
		$wpseo_post = filter_input( INPUT_POST, 'wpseo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );

		if ( ! isset( $wpseo_post['import_plugin'] ) ) {
			return null;
		}

		return $wpseo_post['import_plugin'];
	}

	/**
	 * Retrieves the posted CSV file.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return array|null The posted CSV file.
	 */
	protected function get_posted_csv_file() {
		if ( ! isset( $_FILES['redirects_csv_file'] ) ) {
			return null;
		}

		return $_FILES['redirects_csv_file'];
	}
}
