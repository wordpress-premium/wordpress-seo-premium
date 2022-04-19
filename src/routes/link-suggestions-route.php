<?php

namespace Yoast\WP\SEO\Premium\Routes;

use WP_REST_Request;
use WP_REST_Response;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Main;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action;
use Yoast\WP\SEO\Routes\Route_Interface;

/**
 * Registers the route for the link suggestions retrieval.
 */
class Link_Suggestions_Route implements Route_Interface {

	use No_Conditionals;

	/**
	 * Represents the endpoint.
	 *
	 * @var string
	 */
	const ENDPOINT_QUERY = 'link_suggestions';

	/**
	 * Instance of the Link_Suggestions_Action.
	 *
	 * @var Link_Suggestions_Action
	 */
	protected $link_suggestions_action;

	/**
	 * Link_Suggestions_Route constructor.
	 *
	 * @param Link_Suggestions_Action $link_suggestions_action The action to handle the requests to the endpoint.
	 */
	public function __construct( Link_Suggestions_Action $link_suggestions_action ) {
		$this->link_suggestions_action = $link_suggestions_action;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		$route_args = [
			'methods'             => 'GET',
			'args'                => [
				'prominent_words' => [
					'required'    => true,
					'type'        => 'object',
					'description' => 'Stems of prominent words and their term frequencies we want link suggestions based on',
				],
				'object_id' => [
					'required'    => true,
					'type'        => 'integer',
					'description' => 'The object id of the current indexable.',
				],
				'object_type' => [
					'required'    => true,
					'type'        => 'string',
					'description' => 'The object type of the current indexable.',
				],
				'limit' => [
					'required'    => false,
					'default'     => 5,
					'type'        => 'integer',
					'description' => 'The maximum number of link suggestions to retrieve',
				],
			],
			'callback'            => [ $this, 'run_get_suggestions_action' ],
			'permission_callback' => [ $this, 'can_retrieve_data' ],
		];
		\register_rest_route( Main::API_V1_NAMESPACE, self::ENDPOINT_QUERY, $route_args );
	}

	/**
	 * Runs the get suggestions action..
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response for the query of link suggestions.
	 */
	public function run_get_suggestions_action( WP_REST_Request $request ) {
		$prominent_words = $request->get_param( 'prominent_words' );
		$limit           = $request->get_param( 'limit' );
		$object_id       = $request->get_param( 'object_id' );
		$object_type     = $request->get_param( 'object_type' );

		return new WP_REST_Response(
			$this->link_suggestions_action->get_suggestions(
				$prominent_words,
				$limit,
				$object_id,
				$object_type
			)
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
}
