<?php

namespace Yoast\WP\SEO\Premium\Integrations\Routes;

use WPSEO_Admin_Asset_Manager;
use WPSEO_Shortlinker;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Workouts_Routes_Integration class
 */
class Workouts_Routes_Integration implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Allowed cornerstone steps.
	 *
	 * @var array<string>
	 */
	public const ALLOWED_CORNERSTONE_STEPS = [
		'chooseCornerstones',
		'checkLinks',
		'addLinks',
		'improved',
		'skipped',
	];

	/**
	 * Allowed orphaned steps.
	 *
	 * @var array<string>
	 */
	public const ALLOWED_ORPHANED_STEPS = [
		'improveRemove',
		'update',
		'addLinks',
		'removed',
		'noindexed',
		'improved',
		'skipped',
	];

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
	 * Workouts_Integration constructor.
	 *
	 * @param Indexable_Repository      $indexable_repository    The indexables repository.
	 * @param Link_Suggestions_Action   $link_suggestions_action The link suggestions action.
	 * @param WPSEO_Admin_Asset_Manager $admin_asset_manager     The admin asset manager.
	 * @param WPSEO_Shortlinker         $shortlinker             The shortlinker.
	 * @param Options_Helper            $options_helper          The options helper.
	 * @param Prominent_Words_Helper    $prominent_words_helper  The prominent words helper.
	 * @param Post_Type_Helper          $post_type_helper        The post type helper.
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
		\add_filter( 'Yoast\WP\SEO\workouts_route_args', [ $this, 'add_args_to_set_workouts_route' ] );
		\add_filter( 'Yoast\WP\SEO\workouts_route_save', [ $this, 'save_workouts_data' ], 10, 2 );
		\add_filter( 'Yoast\WP\SEO\workouts_options', [ $this, 'get_options' ] );
	}

	/**
	 * Adds arguments to `set_workouts` route registration.
	 *
	 * @param array $args_array The existing array of arguments.
	 *
	 * @return array
	 */
	public function add_args_to_set_workouts_route( $args_array ) {
		$premium_args_array = [
			'cornerstone' => [
				'validate_callback' => [ $this, 'cornerstone_is_allowed' ],
				'required'          => true,
			],
			'orphaned' => [
				'validate_callback' => [ $this, 'orphaned_is_allowed' ],
				'required'          => true,
			],
		];

		return \array_merge( $args_array, $premium_args_array );
	}

	/**
	 * Validates the cornerstone attribute.
	 *
	 * @param array $workout The cornerstone workout.
	 * @return bool If the payload is valid or not.
	 */
	public function cornerstone_is_allowed( $workout ) {
		return $this->is_allowed( $workout, self::ALLOWED_CORNERSTONE_STEPS );
	}

	/**
	 * Validates the orphaned attribute.
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
		// Only 3 properties are allowed, the below validated finishedSteps property.
		if ( \count( $workout ) !== 3 ) {
			return false;
		}

		if ( isset( $workout['finishedSteps'] ) && \is_array( $workout['finishedSteps'] ) ) {
			foreach ( $workout['finishedSteps'] as $step ) {
				if ( ! \in_array( $step, $allowed_steps, true ) ) {
					return false;
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * Saves the Premium workouts data to the database.
	 *
	 * @param mixed|null $result        The result of the previous save operations.
	 * @param array      $workouts_data The complete workouts data.
	 *
	 * @return mixed|null
	 */
	public function save_workouts_data( $result, $workouts_data ) {
		$premium_workouts_data                = [];
		$premium_workouts_data['cornerstone'] = $workouts_data['cornerstone'];
		$premium_workouts_data['orphaned']    = $workouts_data['orphaned'];

		foreach ( $premium_workouts_data as $workout => $data ) {
			if ( isset( $data['indexablesByStep'] ) && \is_array( $data['indexablesByStep'] ) ) {
				foreach ( $data['indexablesByStep'] as $step => $indexables ) {
					if ( $step === 'removed' ) {
						continue;
					}
					$premium_workouts_data[ $workout ]['indexablesByStep'][ $step ] = \wp_list_pluck( $indexables, 'id' );
				}
			}
		}

		return $this->options_helper->set( 'workouts', $premium_workouts_data );
	}

	/**
	 * Retrieves the Premium workouts options from the database and adds it to the global array of workouts options.
	 *
	 * @param array $workouts_option The previous content of the workouts options.
	 *
	 * @return array The workouts options updated with the addition of the Premium workouts data.
	 */
	public function get_options( $workouts_option ) {
		$premium_option = $this->options_helper->get( 'workouts' );

		if ( ! ( isset( $premium_option['orphaned']['indexablesByStep'] )
				&& \is_array( $premium_option['orphaned']['indexablesByStep'] )
				&& isset( $premium_option['cornerstone']['indexablesByStep'] )
				&& \is_array( $premium_option['cornerstone']['indexablesByStep'] ) )
		) {
			return \array_merge( $workouts_option, $premium_option );
		}

		// Get all indexable ids from all workouts and all steps.
		$indexable_ids_in_workouts = [ 0 ];
		foreach ( [ 'orphaned', 'cornerstone' ] as $workout ) {
			foreach ( $premium_option[ $workout ]['indexablesByStep'] as $step => $indexables ) {
				if ( $step === 'removed' ) {
					continue;
				}
				foreach ( $indexables as $indexable_id ) {
					$indexable_ids_in_workouts[] = $indexable_id;
				}
			}
		}

		// Get all indexables corresponding to the indexable ids.
		$indexables_in_workouts = $this->indexable_repository->find_by_ids( $indexable_ids_in_workouts );

		// Extend the workouts option with the indexables data.
		foreach ( [ 'orphaned', 'cornerstone' ] as $workout ) {
			// Don't add indexables for steps that are not allowed.
			$premium_option[ $workout ]['finishedSteps'] = \array_values(
				\array_intersect(
					$premium_option[ $workout ]['finishedSteps'],
					[
						'orphaned'    => self::ALLOWED_ORPHANED_STEPS,
						'cornerstone' => self::ALLOWED_CORNERSTONE_STEPS,
					][ $workout ]
				)
			);

			// Don't add indexables that are not published or are no-indexed.
			foreach ( $premium_option[ $workout ]['indexablesByStep'] as $step => $indexables ) {
				if ( $step === 'removed' ) {
					continue;
				}
				$premium_option[ $workout ]['indexablesByStep'][ $step ] = \array_values(
					\array_filter(
						\array_map(
							static function ( $indexable_id ) use ( $indexables_in_workouts ) {
								foreach ( $indexables_in_workouts as $updated_indexable ) {
									if ( \is_array( $indexable_id ) ) {
										$indexable_id = $indexable_id['id'];
									}
									if ( (int) $indexable_id === $updated_indexable->id ) {
										if ( $updated_indexable->post_status !== 'publish' && $updated_indexable->post_status !== null ) {
											return false;
										}
										if ( $updated_indexable->is_robots_noindex ) {
											return false;
										}
										return $updated_indexable;
									}
								}
								return false;
							},
							$indexables
						)
					)
				);
			}
		}

		return \array_merge( $workouts_option, $premium_option );
	}
}
