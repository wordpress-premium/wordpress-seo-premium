<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Registers the endpoint for the redirects to WordPress.
 */
class WPSEO_Premium_Redirect_EndPoint implements WPSEO_WordPress_Integration {

	const REST_NAMESPACE = 'yoast/v1';
	const ENDPOINT_QUERY = 'redirects';
	const ENDPOINT_UNDO  = 'redirects/delete';

	const CAPABILITY_STORE = 'wpseo_manage_redirects';

	/**
	 * Instance of the WPSEO_Premium_Redirect_Service class.
	 *
	 * @var WPSEO_Premium_Redirect_Service
	 */
	protected $service;

	/**
	 * Sets the service to handle the request.
	 *
	 * @param WPSEO_Premium_Redirect_Service $service The service to handle the requests to the endpoint.
	 */
	public function __construct( WPSEO_Premium_Redirect_Service $service ) {
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
		$args = [
			'origin' => [
				'required'    => true,
				'type'        => 'string',
				'description' => 'The origin to redirect',
			],
			'target' => [
				'required'    => false,
				'type'        => 'string',
				'description' => 'The redirect target',
			],
			'type' => [
				'required'    => true,
				'type'        => 'integer',
				'description' => 'The redirect type',
			],
		];

		register_rest_route(
			self::REST_NAMESPACE,
			self::ENDPOINT_QUERY,
			[
				'methods'             => 'POST',
				'args'                => $args,
				'callback'            => [
					$this->service,
					'save',
				],
				'permission_callback' => [
					$this,
					'can_save_data',
				],
			]
		);

		register_rest_route(
			self::REST_NAMESPACE,
			self::ENDPOINT_UNDO,
			[
				'methods'             => 'POST',
				'args'                => array_merge(
					$args,
					[
						'type' => [
							'required'    => false,
							'type'        => 'string',
							'description' => 'The redirect format',
						],
					]
				),
				'callback'            => [
					$this->service,
					'delete',
				],
				'permission_callback' => [
					$this,
					'can_save_data',
				],
			]
		);
	}

	/**
	 * Determines if the current user is allowed to use this endpoint.
	 *
	 * @return bool True user is allowed to use this endpoint.
	 */
	public function can_save_data() {
		return current_user_can( self::CAPABILITY_STORE );
	}
}
