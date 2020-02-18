<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Registers the endpoint for the prominent words to WordPress.
 */
class WPSEO_Premium_Link_Suggestions_Endpoint implements WPSEO_WordPress_Integration {

	const REST_NAMESPACE = 'yoast/v1';
	const ENDPOINT_QUERY = 'link_suggestions';

	const CAPABILITY_RETRIEVE = 'edit_posts';

	/**
	 * Instance of the WPSEO_Premium_Link_Suggestions_Service.
	 *
	 * @var WPSEO_Premium_Link_Suggestions_Service
	 */
	protected $service;

	/**
	 * WPSEO_Premium_Prominent_Words_Endpoint constructor.
	 *
	 * @param WPSEO_Premium_Link_Suggestions_Service $service The service to handle the requests to the endpoint.
	 */
	public function __construct( WPSEO_Premium_Link_Suggestions_Service $service ) {
		$this->service = $service;
	}

	/**
	 * Registers all hooks to WordPress.
	 */
	public function register_hooks() {
		add_action( 'rest_api_init', [ $this, 'register' ] );
	}

	/**
	 * Register the REST endpoint to WordPress.
	 */
	public function register() {
		$route_args = [
			'methods'             => 'GET',
			'args'                => [
				'prominent_words' => [
					'required'    => true,
					'type'        => 'array',
					'description' => 'IDs of the prominent words we want link suggestions based on',
					'items'       => [
						'type' => 'int',
					],
				],
			],
			'callback'            => [
				$this->service,
				'query',
			],
			'permission_callback' => [
				$this,
				'can_retrieve_data',
			],
		];
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
