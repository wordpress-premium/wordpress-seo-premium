<?php

namespace Yoast\WP\SEO\Premium\Routes;

use WP_REST_Request;
use WP_REST_Response;
use Yoast\WP\SEO\Main;
use Yoast\WP\SEO\Premium\Actions\Zapier_Action;
use Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional;
use Yoast\WP\SEO\Routes\Route_Interface;

/**
 * Registers the route for the Zapier integration.
 */
class Zapier_Route implements Route_Interface {

	/**
	 * The Zapier route prefix.
	 *
	 * @var string
	 */
	const ROUTE_PREFIX = 'zapier';

	/**
	 * The subscribe route constant.
	 *
	 * @var string
	 */
	const SUBSCRIBE_ROUTE = self::ROUTE_PREFIX . '/subscribe';

	/**
	 * The unsubscribe route constant.
	 *
	 * @var string
	 */
	const UNSUBSCRIBE_ROUTE = self::ROUTE_PREFIX . '/unsubscribe';

	/**
	 * The check route constant.
	 *
	 * @var string
	 */
	const CHECK_API_KEY_ROUTE = self::ROUTE_PREFIX . '/check';

	/**
	 * The perform list route constant.
	 *
	 * @var string
	 */
	const PERFORM_LIST = self::ROUTE_PREFIX . '/list';

	/**
	 * Instance of the Zapier_Action.
	 *
	 * @var Zapier_Action
	 */
	protected $zapier_action;

	/**
	 * Zapier_Route constructor.
	 *
	 * @param Zapier_Action $zapier_action The action to handle the requests to the endpoint.
	 */
	public function __construct( Zapier_Action $zapier_action ) {
		$this->zapier_action = $zapier_action;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		$subscribe_route_args = [
			'methods'             => 'POST',
			'args'                => [
				'url' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The callback URL to use.',
				],
				'api_key' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The API key to validate.',
				],
			],
			'callback'            => [ $this, 'subscribe' ],
			'permission_callback' => '__return_true',
		];
		\register_rest_route( Main::API_V1_NAMESPACE, self::SUBSCRIBE_ROUTE, $subscribe_route_args );

		$unsubscribe_route_args = [
			'methods'             => 'DELETE',
			'args'                => [
				'id' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The ID of the subscription to unsubscribe.',
				],
			],
			'callback'            => [ $this, 'unsubscribe' ],
			'permission_callback' => '__return_true',
		];
		\register_rest_route( Main::API_V1_NAMESPACE, self::UNSUBSCRIBE_ROUTE, $unsubscribe_route_args );

		$check_api_key_route_args = [
			'methods'             => 'POST',
			'args'                => [
				'api_key' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The API key to validate.',
				],
			],
			'callback'            => [ $this, 'check_api_key' ],
			'permission_callback' => '__return_true',
		];
		\register_rest_route( Main::API_V1_NAMESPACE, self::CHECK_API_KEY_ROUTE, $check_api_key_route_args );

		$perform_list_route_args = [
			'methods'             => 'GET',
			'args'                => [
				'api_key' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The API key to validate.',
				],
			],
			'callback'            => [ $this, 'perform_list' ],
			'permission_callback' => '__return_true',
		];
		\register_rest_route( Main::API_V1_NAMESPACE, self::PERFORM_LIST, $perform_list_route_args );
	}

	/**
	 * Runs the subscribe action.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the subscribe action.
	 */
	public function subscribe( WP_REST_Request $request ) {
		$subscription = $this->zapier_action->subscribe( $request['url'], $request['api_key'] );
		$response     = $subscription->data;

		if ( empty( $response ) && \property_exists( $subscription, 'message' ) ) {
			$response = $subscription->message;
		}

		return new WP_REST_Response( $response, $subscription->status );
	}

	/**
	 * Runs the unsubscribe action.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the unsubscribe action.
	 */
	public function unsubscribe( WP_REST_Request $request ) {
		$subscription = $this->zapier_action->unsubscribe( $request['id'] );

		return new WP_REST_Response( $subscription->message, $subscription->status );
	}

	/**
	 * Runs the check_api_key action.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the check_api_key action.
	 */
	public function check_api_key( WP_REST_Request $request ) {
		$check = $this->zapier_action->check_api_key( $request['api_key'] );

		return new WP_REST_Response( $check->message, $check->status );
	}

	/**
	 * Runs the check_api_key action.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the check_api_key action.
	 */
	public function perform_list( WP_REST_Request $request ) {
		$response = $this->zapier_action->perform_list( $request['api_key'] );

		return new WP_REST_Response( $response->data, $response->status );
	}

	/**
	 * Returns the conditionals based in which these routes should be active.
	 *
	 * @return array The list of conditionals.
	 */
	public static function get_conditionals() {
		return [ Zapier_Enabled_Conditional::class ];
	}
}
