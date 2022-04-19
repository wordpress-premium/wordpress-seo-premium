<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * This exporter class will import.
 */
class WPSEO_Redirect_Importer {

	/**
	 * Instance of the redirect option.
	 *
	 * @var WPSEO_Redirect_Option
	 */
	protected $redirect_option;

	/**
	 * Total amount of successfully imported redirects
	 *
	 * @var int
	 */
	protected $total_imported = 0;

	/**
	 * WPSEO_Redirect_Importer constructor.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param WPSEO_Redirect_Option|null $redirect_option The redirect option.
	 */
	public function __construct( $redirect_option = null ) {
		if ( ! $redirect_option ) {
			$redirect_option = new WPSEO_Redirect_Option();
		}

		$this->redirect_option = $redirect_option;
	}

	/**
	 * Imports the redirects and retrieves the import statistics.
	 *
	 * @param WPSEO_Redirect[] $redirects The redirects to import.
	 *
	 * @return int[] The import statistics.
	 */
	public function import( array $redirects ) {
		array_walk( $redirects, [ $this, 'add_redirect' ] );

		if ( $this->total_imported > 0 ) {
			$this->save_import();
		}

		return [
			'total_redirects' => count( $redirects ),
			'total_imported'  => $this->total_imported,
		];
	}

	/**
	 * Saves the redirects to the database and exports them to the necessary configuration file.
	 *
	 * @codeCoverageIgnore Because it contains dependencies
	 *
	 * @return void
	 */
	protected function save_import() {
		$this->redirect_option->save();

		// Export the redirects to .htaccess, Apache or NGinx configuration files depending on plugin settings.
		$redirect_manager = new WPSEO_Redirect_Manager();
		$redirect_manager->export_redirects();
	}

	/**
	 * Adds a redirect to the option.
	 *
	 * @param WPSEO_Redirect $redirect The redirect to add.
	 *
	 * @return void
	 */
	protected function add_redirect( $redirect ) {
		if ( ! $this->redirect_option->add( $redirect ) ) {
			return;
		}

		++$this->total_imported;
	}
}
