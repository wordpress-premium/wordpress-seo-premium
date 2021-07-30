<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Admin_Asset_Manager;
use WPSEO_Premium_Asset_JS_L10n;
use WPSEO_Shortlinker;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * WorkoutsIntegration class
 */
class Workouts_Integration implements Integration_Interface {

	/**
	 * The indexable repository.
	 *
	 * @var Indexable_Repository The indexable repository.
	 */
	private $indexable_repository;

	/**
	 * The link suggestions action.
	 *
	 * @var Link_Suggestions_Action The action.
	 */
	private $link_suggestions_action;

	/**
	 * The admin asset manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	private $admin_asset_manager;

	/**
	 * The shortlinker.
	 *
	 * @var WPSEO_Shortlinker
	 */
	private $shortlinker;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * The prominent words helper.
	 *
	 * @var Prominent_Words_Helper
	 */
	private $prominent_words_helper;

	/**
	 * The post type helper.
	 *
	 * @var Post_Type_Helper
	 */
	private $post_type_helper;

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Workouts_Integration constructor.
	 *
	 * @param Indexable_Repository      $indexable_repository       The indexables repository.
	 * @param Link_Suggestions_Action   $link_suggestions_action    The link suggestions action.
	 * @param WPSEO_Admin_Asset_Manager $admin_asset_manager        The admin asset manager.
	 * @param WPSEO_Shortlinker         $shortlinker                The shortlinker.
	 * @param Options_Helper            $options_helper             The options helper.
	 * @param Prominent_Words_Helper    $prominent_words_helper     The prominent words helper.
	 */
	public function __construct(
		Indexable_Repository $indexable_repository,
		Link_Suggestions_Action $link_suggestions_action,
		WPSEO_Admin_Asset_Manager $admin_asset_manager,
		WPSEO_Shortlinker $shortlinker,
		Options_Helper $options_helper,
		Prominent_Words_Helper $prominent_words_helper,
		Post_Type_Helper $post_type_helper
	) {
		$this->indexable_repository    = $indexable_repository;
		$this->link_suggestions_action = $link_suggestions_action;
		$this->admin_asset_manager     = $admin_asset_manager;
		$this->shortlinker             = $shortlinker;
		$this->options_helper          = $options_helper;
		$this->prominent_words_helper  = $prominent_words_helper;
		$this->post_type_helper        = $post_type_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		add_filter( 'wpseo_submenu_pages', [ $this, 'add_submenu_page' ], 8 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Adds the workouts submenu page.
	 *
	 * @param array $submenu_pages The Yoast SEO submenu pages.
	 *
	 * @return array the filtered submenu pages.
	 */
	public function add_submenu_page( $submenu_pages ) {
		// this inserts the workouts menu page at the correct place in the array without overriding that position.
		$submenu_pages[] = [
			'wpseo_dashboard',
			'',
			\__( 'Workouts', 'wordpress-seo-premium' ) . ' <span class="yoast-badge yoast-premium-badge"></span>',
			'edit_others_posts',
			'wpseo_workouts',
			[ $this, 'render_target' ],
		];

		return $submenu_pages;
	}

	/**
	 * Enqueue the workouts app.
	 */
	public function enqueue_assets() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Date is not processed or saved.
		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'wpseo_workouts' ) {
			return;
		}

		$this->admin_asset_manager->enqueue_style( 'monorepo' );
		$cornerstone_guide = $this->shortlinker->build_shortlink( 'https://yoa.st/4el' );
		$object_sub_types  = \array_values(
			\array_merge(
				$this->post_type_helper->get_public_post_types(),
				\get_taxonomies( [ 'public' => true ] )
			)
		);

		$cornerstones = $this->indexable_repository->query()
			->where_raw( 'is_cornerstone=1 AND ( post_status NOT IN ( \'draft\', \'auto-draft\', \'trash\' ) OR post_status IS NULL )' )
			->where_in( 'object_type', [ 'term', 'post' ] )
			->where_in( 'object_sub_type', $object_sub_types )
			->order_by_desc( 'incoming_link_count' )
			->find_many();
		$cornerstones = \array_map( [ $this->indexable_repository, 'ensure_permalink' ], $cornerstones );

		$improvables = array_slice( $cornerstones, -3, 3, true );
		$improvables = array_map(
			function( Indexable $improvable ) {
				$improvable                = $improvable->as_array();
				$improvable['suggestions'] = $this->link_suggestions_action->get_indexable_suggestions_for_indexable(
					$improvable['id'],
					5
				);
				foreach ( $improvable['suggestions'] as $index => $suggestion ) {
					$improvable['suggestions'][ $index ]['edit_link'] = ( $suggestion['object_type'] === 'post' ) ? \get_edit_post_link( $suggestion['object_id'] ) : \get_edit_term_link( $suggestion['object_id'] );
				}
				return $improvable;
			},
			$improvables
		);

		$most_linked = $this->indexable_repository->query()
			->where_gt( 'incoming_link_count', 0 )
			->where_not_null( 'incoming_link_count' )
			->where_raw( '(post_status NOT IN ( \'draft\', \'auto-draft\', \'trash\' ) OR post_status IS NULL)' )
			->where_raw( '(object_sub_type NOT IN ( \'attachment\' ) OR post_status IS NULL)' )
			->where_in( 'object_type', [ 'term', 'post' ] )
			->where_in( 'object_sub_type', $object_sub_types )
			->order_by_desc( 'incoming_link_count' )
			->limit( 20 )
			->find_many();
		$most_linked = \array_map( [ $this->indexable_repository, 'ensure_permalink' ], $most_linked );

		$premium_localization = new WPSEO_Premium_Asset_JS_L10n();
		$premium_localization->localize_script( 'yoast-seo-premium-workouts' );

		\wp_enqueue_style( 'yoast-seo-workouts' );
		\wp_enqueue_script( 'yoast-seo-premium-workouts' );
		\wp_localize_script(
			'yoast-seo-premium-workouts',
			'wpseoWorkoutsData',
			[
				'cornerstones'              => \array_map( [ $this, 'map_subtypes_to_singular_name' ], $cornerstones ),
				'improvables'               => \array_values( $improvables ),
				'mostLinked'                => \array_map( [ $this, 'map_subtypes_to_singular_name' ], $most_linked ),
				'cornerstoneGuide'          => $cornerstone_guide,
				'workouts'                  => $this->options_helper->get( 'workouts' ),
				'cornerstoneOn'             => $this->options_helper->get( 'enable_cornerstone_content' ),
				'seoDataOptimizationNeeded' => ! $this->prominent_words_helper->is_indexing_completed(),
			]
		);
	}

	/**
	 * Maps an array of indexables and replaces the object_sub_type with the singular name of that type.
	 *
	 * @param Indexable $indexable An Indexable in array format.
	 * @return array The new array.
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
	 * Renders the target for the React to mount to.
	 */
	public function render_target() {
		echo '<div id="wpseo-workouts-container"></div>';
	}
}
