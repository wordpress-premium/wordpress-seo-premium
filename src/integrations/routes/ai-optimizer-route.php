<?php

namespace Yoast\WP\SEO\Premium\Integrations\Routes;

use RuntimeException;
use WP_REST_Request;
use WP_REST_Response;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Main;
use Yoast\WP\SEO\Premium\Actions\AI_Optimizer_Action;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Payment_Required_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Remote_Request_Exception;
use Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper;
use Yoast\WP\SEO\Routes\Route_Interface;

/**
 * Registers the route for the AI_Optimizer integration.
 */
class AI_Optimizer_Route implements Route_Interface {

	use No_Conditionals;

	/**
	 * The AI_Optimizer route prefix.
	 *
	 * @var string
	 */
	public const ROUTE_PREFIX = 'ai';

	/**
	 * The optimize route constant.
	 *
	 * @var string
	 */
	public const AI_OPTIMIZE_ROUTE = self::ROUTE_PREFIX . '/optimize';

	/**
	 * Instance of the AI_Optimizer_Action.
	 *
	 * @var AI_Optimizer_Action
	 */
	protected $ai_optimizer_action;

	/**
	 * Instance of the AI_Generator_Helper.
	 *
	 * @var AI_Generator_Helper
	 */
	protected $ai_generator_helper;

	/**
	 * AI_Generator_Route constructor.
	 *
	 * @param AI_Optimizer_Action $ai_optimizer_action The action to handle the requests to the endpoint.
	 * @param AI_Generator_Helper $ai_generator_helper The AI_Generator helper.
	 */
	public function __construct( AI_Optimizer_Action $ai_optimizer_action, AI_Generator_Helper $ai_generator_helper ) {
		$this->ai_optimizer_action = $ai_optimizer_action;
		$this->ai_generator_helper = $ai_generator_helper;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		// Avoid registering the routes if the feature is not enabled.
		if ( ! $this->ai_generator_helper->is_ai_generator_enabled() ) {
			return;
		}

		\register_rest_route(
			Main::API_V1_NAMESPACE,
			self::AI_OPTIMIZE_ROUTE,
			[
				'methods'             => 'POST',
				'args'                => [
					'assessment'      => [
						'required'    => true,
						'type'        => 'string',
						'enum'        => [
							'seo-keyphrase-introduction',
							'seo-keyphrase-density',
							'seo-keyphrase-distribution',
							'seo-keyphrase-subheadings',
							'read-sentence-length',
							'read-paragraph-length',
						],
						'description' => 'The assessment.',
					],
					'language'        => [
						'required'    => true,
						'type'        => 'string',
						'description' => 'The language the post is written in.',
					],
					'prompt_content'  => [
						'required'    => true,
						'type'        => 'string',
						'description' => 'The content needed by the prompt to ask for suggestions.',
					],
					'focus_keyphrase' => [
						'required'    => false,
						'type'        => 'string',
						'description' => 'The focus keyphrase associated to the post.',
					],
					'synonyms' => [
						'required'    => false,
						'type'        => 'string',
						'description' => 'The synonyms for the focus keyphrase.',
					],
				],
				'callback'            => [ $this, 'optimize' ],
				'permission_callback' => [ $this, 'check_permissions' ],
			]
		);
	}

	/**
	 * Runs the callback to improve assessment results through AI.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response of the assess action.
	 */
	public function optimize( WP_REST_Request $request ) {
		try {
			$user = \wp_get_current_user();
			$data = $this->ai_optimizer_action->optimize( $user, $request['assessment'], $request['language'], $request['prompt_content'], $request['focus_keyphrase'], $request['synonyms'] );
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
			return new WP_REST_Response( 'Failed to retrieve text improvements.', 500 );
		}

		return new WP_REST_Response( $data );
	}

	/**
	 * Checks:
	 * - if the user is logged
	 * - if the user can edit posts
	 *
	 * @return bool Whether the user is logged in and can edit posts.
	 */
	public function check_permissions() {
		$user = \wp_get_current_user();
		if ( $user === null || $user->ID < 1 ) {
			return false;
		}

		return \user_can( $user, 'edit_posts' );
	}
}
