<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Premium_Asset_JS_L10n;
use WPSEO_Shortlinker;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
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
	 * @param Indexable_Repository   $indexable_repository   The indexables repository.
	 * @param WPSEO_Shortlinker      $shortlinker            The shortlinker.
	 * @param Options_Helper         $options_helper         The options helper.
	 * @param Prominent_Words_Helper $prominent_words_helper The prominent words helper.
	 * @param Post_Type_Helper       $post_type_helper       The post type helper.
	 */
	public function __construct(
		Indexable_Repository $indexable_repository,
		WPSEO_Shortlinker $shortlinker,
		Options_Helper $options_helper,
		Prominent_Words_Helper $prominent_words_helper,
		Post_Type_Helper $post_type_helper
	) {
		$this->indexable_repository   = $indexable_repository;
		$this->shortlinker            = $shortlinker;
		$this->options_helper         = $options_helper;
		$this->prominent_words_helper = $prominent_words_helper;
		$this->post_type_helper       = $post_type_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueue the workouts app.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Date is not processed or saved.
		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'wpseo_workouts' ) {
			return;
		}

		$workouts_option = $this->options_helper->get( 'workouts' );

		$indexable_ids_in_workouts = [ 0 ];
		if ( isset( $workouts_option['orphaned']['indexablesByStep'] )
			&& \is_array( $workouts_option['orphaned']['indexablesByStep'] )
			&& isset( $workouts_option['cornerstone']['indexablesByStep'] )
			&& \is_array( $workouts_option['cornerstone']['indexablesByStep'] )
		) {
			foreach ( [ 'orphaned', 'cornerstone' ] as $workout ) {
				foreach ( $workouts_option[ $workout ]['indexablesByStep'] as $step => $indexables ) {
					if ( $step === 'removed' ) {
						continue;
					}
					foreach ( $indexables as $indexable_id ) {
						$indexable_ids_in_workouts[] = $indexable_id;
					}
				}
			}
		}

		$orphaned = $this->get_orphaned( $indexable_ids_in_workouts );

		$premium_localization = new WPSEO_Premium_Asset_JS_L10n();
		$premium_localization->localize_script( 'yoast-seo-premium-workouts' );
		\wp_enqueue_script( 'yoast-seo-premium-workouts' );
		\wp_localize_script(
			'yoast-seo-premium-workouts',
			'wpseoPremiumWorkoutsData',
			[
				'cornerstoneGuide'          => $this->shortlinker->build_shortlink( 'https://yoa.st/4el' ),
				'orphanedGuide'             => $this->shortlinker->build_shortlink( 'https://yoa.st/4fa' ),
				'orphanedUpdateContent'     => $this->shortlinker->build_shortlink( 'https://yoa.st/4h9' ),
				'cornerstoneOn'             => $this->options_helper->get( 'enable_cornerstone_content' ),
				'seoDataOptimizationNeeded' => ! $this->prominent_words_helper->is_indexing_completed(),
				'orphaned'                  => $orphaned,
			]
		);
	}

	/**
	 * Retrieves the public indexable sub types.
	 *
	 * @return array The sub types.
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

	/**
	 * Gets the orphaned indexables.
	 *
	 * @param array $indexable_ids_in_orphaned_workout The orphaned indexable ids.
	 * @param int   $limit                             The limit.
	 *
	 * @return array The orphaned indexables.
	 */
	protected function get_orphaned( array $indexable_ids_in_orphaned_workout, $limit = 10 ) {
		$orphaned = $this->indexable_repository->query()
			->where_raw( '( incoming_link_count is NULL OR incoming_link_count < 3 )' )
			->where_raw( '( post_status = \'publish\' OR post_status IS NULL )' )
			->where_raw( '( is_robots_noindex = FALSE OR is_robots_noindex IS NULL )' )
			->where_raw( 'NOT ( object_sub_type = \'page\' AND permalink = %s )', [ \home_url( '/' ) ] )
			->where_in( 'object_sub_type', $this->get_public_sub_types() )
			->where_in( 'object_type', [ 'post' ] )
			->where_not_in( 'id', $indexable_ids_in_orphaned_workout )
			->order_by_asc( 'created_at' )
			->limit( $limit )
			->find_many();
		$orphaned = \array_map( [ $this->indexable_repository, 'ensure_permalink' ], $orphaned );
		return $orphaned;
	}
}
