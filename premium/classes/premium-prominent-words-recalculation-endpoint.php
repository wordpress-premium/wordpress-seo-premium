<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

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
	 * Instance of the WPSEO_Premium_Prominent_Words_Recalculation_Service class.
	 *
	 * @var WPSEO_Premium_Prominent_Words_Recalculation_Service
	 */
	protected $service;

	/**
	 * WPSEO_Premium_Prominent_Words_Recalculation_Endpoint constructor.
	 *
	 * @param WPSEO_Premium_Prominent_Words_Recalculation_Service $service The service to handle the requests to the endpoint.
	 */
	public function __construct( WPSEO_Premium_Prominent_Words_Recalculation_Service $service ) {
		$this->service = $service;
	}

	/**
	 * Registers all hooks to WordPress.
	 */
	public function register_hooks() {
		add_action( 'rest_api_init', array( $this, 'register' ) );
	}

	/**
	 * Register the REST endpoint to WordPress.
	 */
	public function register() {
		$route_args = array(
			'methods'             => 'GET',
			'callback'            => array(
				$this->service,
				'remove_notification',
			),
			'permission_callback' => array(
				$this,
				'can_retrieve_data',
			),
		);
		register_rest_route( self::REST_NAMESPACE, self::ENDPOINT_QUERY, $route_args );
	}

	/**
	 * Determines if the current user is allowed to use this endpoint.
	 *
	 * @return bool
	 */
	public function can_retrieve_data() {
		return current_user_can( self::CAPABILITY_RETRIEVE );
	}
}
