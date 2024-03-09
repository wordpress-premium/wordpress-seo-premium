<?php

namespace Yoast\WP\SEO\Premium\Routes;

use WP_REST_Request;
use WP_REST_Response;
use WPSEO_Meta;
use WPSEO_Redirect;
use WPSEO_Redirect_Manager;
use WPSEO_Taxonomy_Meta;
use Yoast\WP\SEO\Builders\Indexable_Term_Builder;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Main;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use Yoast\WP\SEO\Routes\Route_Interface;
use Yoast\WP\SEO\Routes\Workouts_Route as Base_Workouts_Route;

/**
 * Workouts_Route class.
 */
class Workouts_Route implements Route_Interface {

	use No_Conditionals;

	/**
	 * Represents a noindex route.
	 *
	 * @var string
	 */
	public const NOINDEX_ROUTE = '/noindex';

	/**
	 * Represents a remove and redirect route.
	 *
	 * @var string
	 */
	public const REMOVE_REDIRECT_ROUTE = '/remove_redirect';

	/**
	 * Represents a link suggestions route.
	 *
	 * @var string
	 */
	public const LINK_SUGGESTIONS_ROUTE = '/link_suggestions';

	/**
	 * Represents a cornerstones route.
	 *
	 * @var string
	 */
	public const CORNERSTONE_DATA_ROUTE = '/cornerstone_data';

	/**
	 * Represents an enable cornerstone route.
	 *
	 * @var string
	 */
	public const ENABLE_CORNERSTONE = '/enable_cornerstone';

	/**
	 * Represents a most linked route.
	 *
	 * @var string
	 */
	public const MOST_LINKED_ROUTE = '/most_linked';

	/**
	 * Represents a last_updated route.
	 *
	 * @var string
	 */
	public const LAST_UPDATED_ROUTE = '/last_updated';

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
	 * The post type helper.
	 *
	 * @var Post_Type_Helper
	 */
	private $post_type_helper;

	/**
	 * Workouts_Route constructor.
	 *
	 * @param Indexable_Repository    $indexable_repository    The indexable repository.
	 * @param Link_Suggestions_Action $link_suggestions_action The link suggestions action.
	 * @param Indexable_Term_Builder  $indexable_term_builder  The indexable term builder.
	 * @param Post_Type_Helper        $post_type_helper        The post type helper.
	 */
	public function __construct(
		Indexable_Repository $indexable_repository,
		Link_Suggestions_Action $link_suggestions_action,
		Indexable_Term_Builder $indexable_term_builder,
		Post_Type_Helper $post_type_helper
	) {
		$this->indexable_repository    = $indexable_repository;
		$this->link_suggestions_action = $link_suggestions_action;
		$this->indexable_term_builder  = $indexable_term_builder;
		$this->post_type_helper        = $post_type_helper;
	}

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		$edit_others_posts = static function () {
			return \current_user_can( 'edit_others_posts' );
		};

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

		\register_rest_route( Main::API_V1_NAMESPACE, Base_Workouts_Route::WORKOUTS_ROUTE . self::NOINDEX_ROUTE, $noindex_route );

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

		\register_rest_route( Main::API_V1_NAMESPACE, Base_Workouts_Route::WORKOUTS_ROUTE . self::REMOVE_REDIRECT_ROUTE, $remove_redirect_route );

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

		\register_rest_route( Main::API_V1_NAMESPACE, Base_Workouts_Route::WORKOUTS_ROUTE . self::LINK_SUGGESTIONS_ROUTE, $suggestions_route );

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

		\register_rest_route( Main::API_V1_NAMESPACE, Base_Workouts_Route::WORKOUTS_ROUTE . self::LAST_UPDATED_ROUTE, $last_updated_route );

		$cornerstone_data_route = [
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_cornerstone_data' ],
				'permission_callback' => $edit_others_posts,
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, Base_Workouts_Route::WORKOUTS_ROUTE . self::CORNERSTONE_DATA_ROUTE, $cornerstone_data_route );

		$enable_cornerstone_route = [
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'enable_cornerstone' ],
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
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, Base_Workouts_Route::WORKOUTS_ROUTE . self::ENABLE_CORNERSTONE, $enable_cornerstone_route );
	}

	/**
	 * Sets noindex on an indexable.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response the configuration of the workouts.
	 */
	public function noindex( $request ) {
		if ( $request['object_type'] === 'post' ) {
			WPSEO_Meta::set_value( 'meta-robots-noindex', 1, $request['object_id'] );
		}
		elseif ( $request['object_type'] === 'term' ) {
			WPSEO_Taxonomy_Meta::set_value( $request['object_id'], $request['object_sub_type'], 'noindex', 'noindex' );
			// Rebuild the indexable as WPSEO_Taxonomy_Meta does not trigger any actions on which term indexables are rebuild.
			$indexable = $this->indexable_term_builder->build( $request['object_id'], $this->indexable_repository->find_by_id_and_type( $request['object_id'], $request['object_type'] ) );
			if ( \is_a( $indexable, Indexable::class ) ) {
				$indexable->save();
			}
			else {
				return new WP_REST_Response(
					[ 'json' => false ]
				);
			}
		}

		return new WP_REST_Response(
			[ 'json' => true ]
		);
	}

	/**
	 * Enables cornerstone on an indexable.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response the configuration of the workouts.
	 */
	public function enable_cornerstone( $request ) {
		if ( $request['object_type'] === 'post' ) {
			WPSEO_Meta::set_value( 'is_cornerstone', 1, $request['object_id'] );
		}
		elseif ( $request['object_type'] === 'term' ) {
			$term = \get_term( $request['object_id'] );
			WPSEO_Taxonomy_Meta::set_value( $request['object_id'], $term->taxonomy, 'is_cornerstone', '1' );
			// Rebuild the indexable as WPSEO_Taxonomy_Meta does not trigger any actions on which term indexables are rebuild.
			$indexable = $this->indexable_term_builder->build( $request['object_id'], $this->indexable_repository->find_by_id_and_type( $request['object_id'], $request['object_type'] ) );
			if ( \is_a( $indexable, Indexable::class ) ) {
				$indexable->save();
			}
			else {
				return new WP_REST_Response(
					[ 'json' => false ]
				);
			}
		}

		return new WP_REST_Response(
			[ 'json' => true ]
		);
	}

	/**
	 * Removes an indexable and redirects it.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response the configuration of the workouts.
	 */
	public function remove_redirect( $request ) {
		if ( $request['object_type'] === 'post' ) {
			\add_filter( 'Yoast\WP\SEO\enable_notification_post_trash', '__return_false' );
			\wp_trash_post( $request['object_id'] );
			\remove_filter( 'Yoast\WP\SEO\enable_notification_post_trash', '__return_false' );
		}
		elseif ( $request['object_type'] === 'term' ) {
			\add_filter( 'Yoast\WP\SEO\enable_notification_term_delete', '__return_false' );
			\wp_delete_term( $request['object_id'], $request['object_sub_type'] );
			\remove_filter( 'Yoast\WP\SEO\enable_notification_term_delete', '__return_false' );
		}
		else {
			return new WP_REST_Response(
				[ 'json' => false ]
			);
		}

		$redirect         = new WPSEO_Redirect(
			$request['permalink'],
			$request['redirect_url'],
			'301',
			'plain'
		);
		$redirect_manager = new WPSEO_Redirect_Manager( 'plain' );
		$redirect_manager->create_redirect( $redirect );
		return new WP_REST_Response(
			[ 'json' => true ]
		);
	}

	/**
	 * Sets noindex on an indexable.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response the configuration of the workouts.
	 */
	public function get_link_suggestions( $request ) {
		$suggestions = $this->link_suggestions_action->get_indexable_suggestions_for_indexable(
			$request['indexableId'],
			5,
			false
		);

		foreach ( $suggestions as $index => $suggestion ) {
			$suggestions[ $index ]['edit_link'] = ( $suggestion['object_type'] === 'post' ) ? \get_edit_post_link( $suggestion['object_id'] ) : \get_edit_term_link( $suggestion['object_id'] );
		}

		return new WP_REST_Response(
			[ 'json' => $suggestions ]
		);
	}

	/**
	 * Gets the cornerstone indexables
	 *
	 * @return WP_REST_Response the configuration of the workouts.
	 */
	public function get_cornerstone_data() {
		$cornerstones = $this->indexable_repository->query()
			->where_raw( '( post_status= \'publish\' OR post_status IS NULL ) AND is_cornerstone = 1' )
			->where_in( 'object_type', [ 'term', 'post' ] )
			->where_in( 'object_sub_type', $this->get_public_sub_types() )
			->order_by_asc( 'breadcrumb_title' )
			->find_many();

		$cornerstones = \array_map( [ $this->indexable_repository, 'ensure_permalink' ], $cornerstones );
		$cornerstones = \array_map( [ $this, 'map_subtypes_to_singular_name' ], $cornerstones );

		$most_linked = $this->indexable_repository->query()
			->where_gt( 'incoming_link_count', 0 )
			->where_not_null( 'incoming_link_count' )
			->where_raw( '( post_status = \'publish\' OR post_status IS NULL )' )
			->where_in( 'object_sub_type', $this->get_public_sub_types() )
			->where_in( 'object_type', [ 'term', 'post' ] )
			->where_raw( '( is_robots_noindex = 0 OR is_robots_noindex IS NULL )' )
			->order_by_desc( 'incoming_link_count' )
			->limit( 20 )
			->find_many();
		$most_linked = \array_map( [ $this->indexable_repository, 'ensure_permalink' ], $most_linked );
		$most_linked = \array_map( [ $this, 'map_subtypes_to_singular_name' ], $most_linked );

		return new WP_REST_Response(
			[
				'json' => [
					'cornerstones' => $cornerstones,
					'mostLinked'   => $most_linked,
				],
			]
		);
	}

	/**
	 * Gets the last updated for a particular post Id.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response the configuration of the workouts.
	 */
	public function get_last_updated( $request ) {
		$post = \get_post( $request['postId'] );

		return new WP_REST_Response(
			[ 'json' => $post->post_modified ]
		);
	}

	/**
	 * Maps an array of indexables and replaces the object_sub_type with the singular name of that type.
	 *
	 * @param Indexable $indexable An Indexable.
	 *
	 * @return Indexable The new Indexable with the edited object_sub_type.
	 */
	public function map_subtypes_to_singular_name( Indexable $indexable ) {
		if ( $indexable->object_type === 'post' ) {
			$post_type_labels           = \get_post_type_labels( \get_post_type_object( \get_post_type( $indexable->object_id ) ) );
			$indexable->object_sub_type = $post_type_labels->singular_name;
		}
		else {
			$taxonomy_labels            = \get_taxonomy_labels( \get_taxonomy( $indexable->object_sub_type ) );
			$indexable->object_sub_type = $taxonomy_labels->singular_name;
		}
		return $indexable;
	}

	/**
	 * Get public sub types.
	 *
	 * @return array The subtypes.
	 */
	protected function get_public_sub_types() {
		$object_sub_types = \array_values(
			\array_merge(
				$this->post_type_helper->get_public_post_types(),
				\get_taxonomies( [ 'public' => true ] )
			)
		);

		$excluded_post_types = \apply_filters( 'wpseo_indexable_excluded_post_types', [ 'attachment' ] );
		$object_sub_types    = \array_diff( $object_sub_types, $excluded_post_types );
		return $object_sub_types;
	}
}
