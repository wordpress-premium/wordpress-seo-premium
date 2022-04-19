<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

_deprecated_file( __FILE__, 'WPSEO Premium 14.5' );

/**
 * Registers the endpoint for the prominent words recalculation to WordPress.
 */
class WPSEO_Premium_Prominent_Words_Recalculation_Endpoint implements WPSEO_WordPress_Integration {

	/**
	 * The REST API namespace.
	 *
	 * @var string
	 */
	const REST_NAMESPACE = 'yoast/v1';

	/**
	 * The REST API endpoint.
	 *
	 * @var string
	 */
	const ENDPOINT_QUERY = 'complete_recalculation';

	/**
	 * The capability needed to retrieve the recalculation data.
	 *
	 * @var string
	 */
	const CAPABILITY_RETRIEVE = 'edit_posts';

	/**
	 * WPSEO_Premium_Prominent_Words_Recalculation_Endpoint constructor.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @param WPSEO_Premium_Prominent_Words_Recalculation_Service $service Unused. The service to handle the requests to the endpoint.
	 */
	public function __construct( WPSEO_Premium_Prominent_Words_Recalculation_Service $service ) {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Registers all hooks to WordPress.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 */
	public function register_hooks() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Register the REST endpoint to WordPress.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 */
	public function register() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Determines if the current user is allowed to use this endpoint.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @return bool
	 */
	public function can_retrieve_data() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );

		return current_user_can( self::CAPABILITY_RETRIEVE );
	}
}
