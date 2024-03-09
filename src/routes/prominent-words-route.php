<?php

namespace Yoast\WP\SEO\Premium\Routes;

use Exception;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use Yoast\WP\SEO\Actions\Indexing\Indexation_Action_Interface;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Config\Indexing_Reasons;
use Yoast\WP\SEO\Helpers\Indexing_Helper;
use Yoast\WP\SEO\Main;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action;
use Yoast\WP\SEO\Routes\Abstract_Indexation_Route;

/**
 * Class Prominent_Words_Route.
 */
class Prominent_Words_Route extends Abstract_Indexation_Route {

	use No_Conditionals;

	/**
	 * Feature namespace for the REST endpoint.
	 *
	 * @var string
	 */
	public const FEATURE_NAMESPACE = 'prominent_words';

	/**
	 * The get content route constant.
	 *
	 * @var string
	 */
	public const GET_CONTENT_ROUTE = self::FEATURE_NAMESPACE . '/get_content';

	/**
	 * The full content route constant.
	 *
	 * @var string
	 */
	public const FULL_GET_CONTENT_ROUTE = Main::API_V1_NAMESPACE . '/' . self::GET_CONTENT_ROUTE;

	/**
	 * The route for saving the prominent words.
	 *
	 * @var string
	 */
	public const SAVE_ROUTE = self::FEATURE_NAMESPACE . '/save';

	/**
	 * The full namespaced route for saving the prominent words.
	 *
	 * @var string
	 */
	public const FULL_SAVE_ROUTE = Main::API_V1_NAMESPACE . '/' . self::SAVE_ROUTE;

	/**
	 * The posts data route constant.
	 *
	 * @var string
	 */
	public const COMPLETE_ROUTE = self::FEATURE_NAMESPACE . '/complete';

	/**
	 * The full post data route constant.
	 *
	 * @var string
	 */
	public const FULL_COMPLETE_ROUTE = Main::API_V1_NAMESPACE . '/' . self::COMPLETE_ROUTE;

	/**
	 * Represents that action that retrieves the content to index.
	 *
	 * @var Content_Action
	 */
	protected $content_action;

	/**
	 * The action to complete the prominent words indexing.
	 *
	 * @var Complete_Action
	 */
	protected $complete_action;

	/**
	 * The action for saving prominent words to an indexable.
	 *
	 * @var Save_Action
	 */
	protected $save_action;

	/**
	 * The indexing helper.
	 *
	 * @var Indexing_Helper
	 */
	protected $indexing_helper;

	/**
	 * Prominent_Words_Route constructor.
	 *
	 * @param Content_Action  $content_action  The content action.
	 * @param Save_Action     $save_action     The save action.
	 * @param Complete_Action $complete_action The complete action.
	 * @param Indexing_Helper $indexing_helper The indexing helper.
	 */
	public function __construct(
		Content_Action $content_action,
		Save_Action $save_action,
		Complete_Action $complete_action,
		Indexing_Helper $indexing_helper
	) {
		$this->content_action  = $content_action;
		$this->save_action     = $save_action;
		$this->complete_action = $complete_action;
		$this->indexing_helper = $indexing_helper;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		\register_rest_route(
			Main::API_V1_NAMESPACE,
			self::GET_CONTENT_ROUTE,
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'run_content_action' ],
				'permission_callback' => [ $this, 'can_retrieve_data' ],
			]
		);

		\register_rest_route(
			Main::API_V1_NAMESPACE,
			self::COMPLETE_ROUTE,
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'run_complete_action' ],
				'permission_callback' => [ $this, 'can_retrieve_data' ],
			]
		);

		$route_args = [
			'methods'             => 'POST',
			'args'                => [
				'data' => [
					'type'     => 'array',
					'required' => false,
					'items'    => [
						'type'       => 'object',
						'properties' => [
							'object_id'       => [
								'type'     => 'number',
								'required' => true,
							],
							'prominent_words' => [
								'type'     => 'object',
								'required' => false,
							],
						],
					],
				],
			],
			'callback'            => [ $this, 'run_save_action' ],
			'permission_callback' => [ $this, 'can_retrieve_data' ],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::SAVE_ROUTE, $route_args );
	}

	/**
	 * Retrieves the content that needs to be analyzed for prominent words.
	 *
	 * @return WP_REST_Response Response with the content that needs to be analyzed for prominent words.
	 */
	public function run_content_action() {
		return $this->run_indexation_action( $this->content_action, self::FULL_GET_CONTENT_ROUTE );
	}

	/**
	 * Marks the indexing of prominent words as completed.
	 *
	 * @return WP_REST_Response Response with empty data.
	 */
	public function run_complete_action() {
		$this->complete_action->complete();

		return $this->respond_with( [], false );
	}

	/**
	 * Saves the prominent words for the indexables.
	 *
	 * The request should have the parameters:
	 *  - **data**:              The data array containing:
	 *    - **object_id**:       The ID of the object (post-id, term-id, etc.).
	 *    - **prominent_words**: The map of `'stem' => weight` key-value pairs,
	 *                           e.g. the stems of the prominent words and their weights.
	 *                           Leave this out when the indexable has no prominent words.
	 *
	 * @param WP_REST_Request $request The request to handle.
	 *
	 * @return WP_REST_Response The response to give.
	 */
	public function run_save_action( WP_REST_Request $request ) {
		$this->save_action->save( $request->get_param( 'data' ) );

		return new WP_REST_Response(
			[ 'message' => 'The words have been successfully saved for the given indexables.' ]
		);
	}

	/**
	 * Determines if the current user is allowed to use this endpoint.
	 *
	 * @return bool
	 */
	public function can_retrieve_data() {
		return \current_user_can( 'edit_posts' );
	}

	/**
	 * Runs an indexing action and returns the response.
	 *
	 * @param Indexation_Action_Interface $indexation_action The indexing action.
	 * @param string                      $url               The url of the indexing route.
	 *
	 * @return WP_REST_Response|WP_Error The response, or an error when running the indexing action failed.
	 */
	protected function run_indexation_action( Indexation_Action_Interface $indexation_action, $url ) {
		try {
			return parent::run_indexation_action( $indexation_action, $url );
		} catch ( Exception $exception ) {
			$this->indexing_helper->set_reason( Indexing_Reasons::REASON_INDEXING_FAILED );

			return new WP_Error( 'wpseo_error_indexing', $exception->getMessage() );
		}
	}
}
