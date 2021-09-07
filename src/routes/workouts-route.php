<?php

namespace Yoast\WP\SEO\Premium\Routes;

use Yoast\WP\SEO\Builders\Indexable_Term_Builder;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use Yoast\WP\SEO\Routes\Route_Interface;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Main;

/**
 * Workouts_Route class.
 */
class Workouts_Route implements Route_Interface {

	use No_Conditionals;

	/**
	 * Represents workouts route.
	 *
	 * @var string
	 */
	const WORKOUTS_ROUTE = '/workouts';

	/**
	 * Represents a noindex route.
	 *
	 * @var string
	 */
	const NOINDEX_ROUTE = '/workouts/noindex';

	/**
	 * Represents a remove and redirect route.
	 *
	 * @var string
	 */
	const REMOVE_REDIRECT_ROUTE = '/workouts/remove_redirect';

	/**
	 * Represents a link suggestions route.
	 *
	 * @var string
	 */
	const LINK_SUGGESTIONS_ROUTE = '/workouts/link_suggestions';

	/**
	 * Represents a last_updated route.
	 *
	 * @var string
	 */
	const LAST_UPDATED_ROUTE = '/workouts/last_updated';

	/**
	 * Allowed cornerstone steps.
	 *
	 * @var array
	 */
	const ALLOWED_CORNERSTONE_STEPS = [
		'chooseCornerstones',
		'markCornerstones',
		'checkCornerstones',
		'checkLinks',
		'addLinks',
	];

	/**
	 * Allowed orphaned steps.
	 *
	 * @var array
	 */
	const ALLOWED_ORPHANED_STEPS = [
		'improveRemove',
		'update',
		'addLinks',
		'removed',
		'noindexed',
		'improved',
	];

	/**
	 * The indexable repository.
	 *
	 * @var Indexable_Repository
	 */
	private $indexable_repository;

	/**
	 * The link suggestions action.
	 *
	 * @var Link_Suggestions_Action
	 */
	private $link_suggestions_action;

	/**
	 * The link suggestions action.
	 *
	 * @var Indexable_Term_Builder
	 */
	private $indexable_term_builder;

	/**
	 * Workouts_Route constructor.
	 *
	 * @param Indexable_Repository    $indexable_repository    The indexable repository.
	 * @param Link_Suggestions_Action $link_suggestions_action The link suggestions action.
	 * @param Indexable_Term_Builder  $indexable_term_builder  The indexable term builder.
	 *
	 * @return void
	 */
	public function __construct(
		Indexable_Repository $indexable_repository,
		Link_Suggestions_Action $link_suggestions_action,
		Indexable_Term_Builder $indexable_term_builder
	) {
		$this->indexable_repository    = $indexable_repository;
		$this->link_suggestions_action = $link_suggestions_action;
		$this->indexable_term_builder  = $indexable_term_builder;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		$edit_others_posts = function() {
			return \current_user_can( 'edit_others_posts' );
		};

		$workouts_route = [
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_workouts' ],
				'permission_callback' => $edit_others_posts,
			],
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'set_workouts' ],
				'permission_callback' => $edit_others_posts,
				'args'                => [
					'cornerstone' => [
						'validate_callback' => [ $this, 'cornerstone_is_allowed' ],
						'required'          => true,
					],
					'orphaned' => [
						'validate_callback' => [ $this, 'orphaned_is_allowed' ],
						'required'          => true,
					],
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::WORKOUTS_ROUTE, $workouts_route );

		$noindex_route = [
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'noindex' ],
				'permission_callback' => $edit_others_posts,
				'args'                => [
					'object_id' => [
						'type'     => 'integer',
						'required' => true,
					],
					'object_type' => [
						'type'     => 'string',
						'required' => true,
					],
					'object_sub_type' => [
						'type'     => 'string',
						'required' => true,
					],
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::NOINDEX_ROUTE, $noindex_route );

		$remove_redirect_route = [
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'remove_redirect' ],
				'permission_callback' => $edit_others_posts,
				'args'                => [
					'object_id'       => [
						'type'     => 'integer',
						'required' => true,
					],
					'object_type'     => [
						'type'     => 'string',
						'required' => true,
					],
					'object_sub_type' => [
						'type'     => 'string',
						'required' => true,
					],
					'permalink' => [
						'type'     => 'string',
						'required' => true,
					],
					'redirect_url' => [
						'type'     => 'string',
						'required' => true,
					],
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::REMOVE_REDIRECT_ROUTE, $remove_redirect_route );

		$suggestions_route = [
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_link_suggestions' ],
				'permission_callback' => $edit_others_posts,
				'args'                => [
					'indexableId' => [
						'type'     => 'integer',
						'required' => true,
					],
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::LINK_SUGGESTIONS_ROUTE, $suggestions_route );

		$last_updated_route = [
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_last_updated' ],
				'permission_callback' => $edit_others_posts,
				'args'                => [
					'postId' => [
						'type'     => 'integer',
						'required' => true,
					],
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::LAST_UPDATED_ROUTE, $last_updated_route );
	}

	/**
	 * Returns the workouts as configured for the site.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function get_workouts() {
		return new \WP_REST_Response(
			[ 'json' => \YoastSEO()->helpers->options->get( 'workouts' ) ]
		);
	}

	/**
	 * Sets the workout configuration.
	 *
	 * @param \WP_Rest_Request $request The request object.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function set_workouts( $request ) {
		$value = [
			'cornerstone' => $request['cornerstone'],
			'orphaned'    => $request['orphaned'],
		];

		if ( isset( $value['orphaned']['indexablesByStep'] ) && \is_array( $value['orphaned']['indexablesByStep'] ) ) {
			foreach ( $value['orphaned']['indexablesByStep'] as $step => $indexables ) {
				if ( $step === 'removed' ) {
					continue;
				}
				$value['orphaned']['indexablesByStep'][ $step ] = \wp_list_pluck( $indexables, 'id' );
			}
		}

		return new \WP_REST_Response(
			[ 'json' => \YoastSEO()->helpers->options->set( 'workouts', $value ) ]
		);
	}

	/**
	 * Sets noindex on an indexable.
	 *
	 * @param \WP_Rest_Request $request The request object.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function noindex( $request ) {
		if ( $request['object_type'] === 'post' ) {
			\WPSEO_Meta::set_value( 'meta-robots-noindex', 1, $request['object_id'] );
		}
		elseif ( $request['object_type'] === 'term' ) {
			\WPSEO_Taxonomy_Meta::set_value( $request['object_id'], $request['object_sub_type'], 'noindex', 'noindex' );
			// Rebuild the indexable as WPSEO_Taxonomy_Meta does not trigger any actions on which term indexables are rebuild.
			$indexable = $this->indexable_term_builder->build( $request['object_id'], $this->indexable_repository->find_by_id_and_type( $request['object_id'], $request['object_type'] ) );
			if ( is_a( $indexable, Indexable::class ) ) {
				$indexable->save();
			}
			else {
				return new \WP_REST_Response(
					[ 'json' => false ]
				);
			}
		}

		return new \WP_REST_Response(
			[ 'json' => true ]
		);
	}

	/**
	 * Removes an indexable and redirects it.
	 *
	 * @param \WP_Rest_Request $request The request object.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function remove_redirect( $request ) {
		if ( $request['object_type'] === 'post' ) {
			\wp_trash_post( $request['object_id'] );
		}
		elseif ( $request['object_type'] === 'term' ) {
			\wp_delete_term( $request['object_id'], $request['object_sub_type'] );
		}
		else {
			return new \WP_REST_Response(
				[ 'json' => false ]
			);
		}

		$redirect         = new \WPSEO_Redirect(
			$request['permalink'],
			$request['redirect_url'],
			'301',
			'plain'
		);
		$redirect_manager = new \WPSEO_Redirect_Manager( 'plain' );
		$redirect_manager->create_redirect( $redirect );
		return new \WP_REST_Response(
			[ 'json' => true ]
		);
	}

	/**
	 * Sets noindex on an indexable.
	 *
	 * @param \WP_Rest_Request $request The request object.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function get_link_suggestions( $request ) {
		$suggestions = $this->link_suggestions_action->get_indexable_suggestions_for_indexable(
			$request['indexableId'],
			5
		);

		foreach ( $suggestions as $index => $suggestion ) {
			$suggestions[ $index ]['edit_link'] = ( $suggestion['object_type'] === 'post' ) ? \get_edit_post_link( $suggestion['object_id'] ) : \get_edit_term_link( $suggestion['object_id'] );
		}

		return new \WP_REST_Response(
			[ 'json' => $suggestions ]
		);
	}

	/**
	 * Gets the last updated for a particular post Id.
	 *
	 * @param \WP_Rest_Request $request The request object.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function get_last_updated( $request ) {
		$post = \get_post( $request['postId'] );

		return new \WP_REST_Response(
			[ 'json' => $post->post_modified ]
		);
	}

	/**
	 * Validates the cornerstone attribute
	 *
	 * @param array $workout The cornerstone workout.
	 * @return bool If the payload is valid or not.
	 */
	public function cornerstone_is_allowed( $workout ) {
		return $this->is_allowed( $workout, self::ALLOWED_CORNERSTONE_STEPS );
	}

	/**
	 * Validates the orphaned attribute
	 *
	 * @param array $workout The orphaned workout.
	 * @return bool If the payload is valid or not.
	 */
	public function orphaned_is_allowed( $workout ) {
		return $this->is_allowed( $workout, self::ALLOWED_ORPHANED_STEPS );
	}

	/**
	 * Validates a workout.
	 *
	 * @param array $workout       The workout.
	 * @param array $allowed_steps The allowed steps for this workout.
	 * @return bool If the payload is valid or not.
	 */
	public function is_allowed( $workout, $allowed_steps ) {
		// Only 2 properties are allowed, the below validated finishedSteps property.
		if ( \count( $workout ) !== 2 ) {
			return false;
		}

		if ( isset( $workout['finishedSteps'] ) && is_array( $workout['finishedSteps'] ) ) {
			foreach ( $workout['finishedSteps'] as $step ) {
				if ( ! in_array( $step, $allowed_steps, true ) ) {
					return false;
				}
			}
			return true;
		}
		return false;
	}
}
