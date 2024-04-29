<?php

namespace Yoast\WP\SEO\Premium\Integrations\Routes;

use RuntimeException;
use WP_REST_Request;
use WP_REST_Response;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Main;
use Yoast\WP\SEO\Premium\Actions\AI_Generator_Action;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Bad_Request_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Forbidden_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Internal_Server_Error_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Not_Found_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Payment_Required_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Remote_Request_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Request_Timeout_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Service_Unavailable_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Too_Many_Requests_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Unauthorized_Exception;
use Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper;
use Yoast\WP\SEO\Routes\Route_Interface;

/**
 * Registers the route for the AI_Generator integration.
 */
class AI_Generator_Route implements Route_Interface {

	use No_Conditionals;

	/**
	 * The AI_Generator route prefix.
	 *
	 * @var string
	 */
	public const ROUTE_PREFIX = 'ai_generator';

	/**
	 * The callback route constant (invoked by the API).
	 *
	 * @var string
	 */
	public const CALLBACK_ROUTE = self::ROUTE_PREFIX . '/callback';

	/**
	 * The refresh callback route constant (invoked by the API).
	 *
	 * @var string
	 */
	public const REFRESH_CALLBACK_ROUTE = self::ROUTE_PREFIX . '/refresh_callback';

	/**
	 * The get_suggestions route constant.
	 *
	 * @var string
	 */
	public const GET_SUGGESTIONS_ROUTE = self::ROUTE_PREFIX . '/get_suggestions';

	/**
	 * The get_suggestions route constant.
	 *
	 * @var string
	 */
	public const CONSENT_ROUTE = self::ROUTE_PREFIX . '/consent';

	/**
	 * The bust_subscription_cache route constant.
	 *
	 * @var string
	 */
	public const BUST_SUBSCRIPTION_CACHE_ROUTE = self::ROUTE_PREFIX . '/bust_subscription_cache';

	/**
	 * Instance of the AI_Generator_Action.
	 *
	 * @var AI_Generator_Action
	 */
	protected $ai_generator_action;

	/**
	 * Instance of the AI_Generator_Helper.
	 *
	 * @var AI_Generator_Helper
	 */
	protected $ai_generator_helper;

	/**
	 * AI_Generator_Route constructor.
	 *
	 * @param AI_Generator_Action $ai_generator_action The action to handle the requests to the endpoint.
	 * @param AI_Generator_Helper $ai_generator_helper The AI_Generator helper.
	 */
	public function __construct( AI_Generator_Action $ai_generator_action, AI_Generator_Helper $ai_generator_helper ) {
		$this->ai_generator_action = $ai_generator_action;
		$this->ai_generator_helper = $ai_generator_helper;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		\register_rest_route(
			Main::API_V1_NAMESPACE,
			self::CONSENT_ROUTE,
			[
				'methods'             => 'POST',
				'args'                => [
					'consent' => [
						'required'    => true,
						'type'        => 'boolean',
						'description' => 'Whether the consent to use AI-based services has been given by the user.',
					],
				],
				'callback'            => [ $this, 'consent' ],
				'permission_callback' => [ $this, 'check_permissions' ],
			]
		);

		// Avoid registering the other routes if the feature is not enabled.
		if ( ! $this->ai_generator_helper->is_ai_generator_enabled() ) {
			return;
		}

		$callback_route_args = [
			'methods'             => 'POST',
			'args'                => [
				'access_jwt'     => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The access JWT.',
				],
				'refresh_jwt'    => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The JWT to be used when the access JWT needs to be refreshed.',
				],
				'code_challenge' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The SHA266 of the verification code used to check the authenticity of a callback call.',
				],
				'user_id'        => [
					'required'    => true,
					'type'        => 'integer',
					'description' => 'The id of the user associated to the code verifier.',
				],
			],
			'callback'            => [ $this, 'callback' ],
			'permission_callback' => '__return_true',
		];
		\register_rest_route( Main::API_V1_NAMESPACE, self::CALLBACK_ROUTE, $callback_route_args );
		\register_rest_route( Main::API_V1_NAMESPACE, self::REFRESH_CALLBACK_ROUTE, $callback_route_args );

		\register_rest_route(
			Main::API_V1_NAMESPACE,
			self::GET_SUGGESTIONS_ROUTE,
			[
				'methods'             => 'POST',
				'args'                => [
					'type'            => [
						'required'    => true,
						'type'        => 'string',
						'enum'        => [
							'seo-title',
							'meta-description',
							'product-seo-title',
							'product-meta-description',
							'taxonomy-seo-title',
							'taxonomy-meta-description',
						],
						'description' => 'The type of suggestion requested.',
					],
					'prompt_content'  => [
						'required'    => true,
						'type'        => 'string',
						'description' => 'The content needed by the prompt to ask for suggestions.',
					],
					'focus_keyphrase' => [
						'required'    => true,
						'type'        => 'string',
						'description' => 'The focus keyphrase associated to the post.',
					],
					'language'        => [
						'required'    => true,
						'type'        => 'string',
						'description' => 'The language the post is written in.',
					],
					'platform'        => [
						'required'    => true,
						'type'        => 'string',
						'enum'        => [
							'Google',
							'Facebook',
							'Twitter',
						],
						'description' => 'The platform the post is intended for.',
					],
				],
				'callback'            => [ $this, 'get_suggestions' ],
				'permission_callback' => [ $this, 'check_permissions' ],
			]
		);

		\register_rest_route(
			Main::API_V1_NAMESPACE,
			self::BUST_SUBSCRIPTION_CACHE_ROUTE,
			[
				'methods'             => 'POST',
				'args'                => [],
				'callback'            => [ $this, 'bust_subscription_cache' ],
				'permission_callback' => [ $this, 'check_permissions' ],
			]
		);
	}

	/**
	 * Runs the callback to store connection credentials and the tokens locally.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the callback action.
	 */
	public function callback( WP_REST_Request $request ) {
		try {
			$code_verifier = $this->ai_generator_action->callback( $request['access_jwt'], $request['refresh_jwt'], $request['code_challenge'], $request['user_id'] );
		} catch ( Unauthorized_Exception $e ) {
			return new WP_REST_Response( 'Unauthorized.', 401 );
		}

		return new WP_REST_Response(
			[
				'message'       => 'Tokens successfully stored.',
				'code_verifier' => $code_verifier,
			]
		);
	}

	/**
	 * Runs the callback to get ai-generated suggestions.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the get_suggestions action.
	 */
	public function get_suggestions( WP_REST_Request $request ) {
		try {
			$user = \wp_get_current_user();
			$data = $this->ai_generator_action->get_suggestions( $user, $request['type'], $request['prompt_content'], $request['focus_keyphrase'], $request['language'], $request['platform'] );
		} catch ( Remote_Request_Exception $e ) {
			$message = [
				'message'         => $e->getMessage(),
				'errorIdentifier' => $e->get_error_identifier(),
			];
			if ( $e instanceof Payment_Required_Exception ) {
				$message['missingLicenses'] = $e->get_missing_licenses();
			}
			return new WP_REST_Response(
				$message,
				$e->getCode()
			);
		} catch ( RuntimeException $e ) {
			return new WP_REST_Response( 'Failed to get suggestions.', 500 );
		}

		return new WP_REST_Response( $data );
	}

	/**
	 * Runs the callback to store the consent given by the user to use AI-based services.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the callback action.
	 */
	public function consent( WP_REST_Request $request ) {
		$user_id = \get_current_user_id();
		$consent = \boolval( $request['consent'] );

		try {
			$this->ai_generator_action->consent( $user_id, $consent );
		} catch ( Bad_Request_Exception | Forbidden_Exception | Internal_Server_Error_Exception | Not_Found_Exception | Payment_Required_Exception | Request_Timeout_Exception | Service_Unavailable_Exception | Too_Many_Requests_Exception | RuntimeException $e ) {
			return new WP_REST_Response( ( $consent ) ? 'Failed to store consent.' : 'Failed to revoke consent.', 500 );
		}

		return new WP_REST_Response( ( $consent ) ? 'Consent successfully stored.' : 'Consent successfully revoked.' );
	}

	/**
	 * Runs the callback that busts the subscription cache.
	 *
	 * @return WP_REST_Response The response of the callback action.
	 */
	public function bust_subscription_cache() {
		$this->ai_generator_action->bust_subscription_cache();

		return new WP_REST_Response( 'Subscription cache successfully busted.' );
	}

	/**
	 * Checks:
	 * - if the user is logged
	 * - if the user can edit posts
	 *
	 * @return bool Whether the user is logged in, can edit posts and the feature is active.
	 */
	public function check_permissions() {
		$user = \wp_get_current_user();
		if ( $user === null || $user->ID < 1 ) {
			return false;
		}

		return \user_can( $user, 'edit_posts' );
	}
}
