<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use Yoast\WP\SEO\Conditionals\Front_End_Conditional;
use Yoast\WP\SEO\Helpers\Indexable_Helper;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Integration to add Publishing Principles to the Schema.
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Publishing_Principles_Schema_Integration implements Integration_Interface {

	/**
	 * Constant holding the mapping between database option and actual schema name.
	 */
	public const PRINCIPLES_MAPPING = [
		[ 'publishing_principles_id', 'publishingPrinciples' ],
		[ 'ownership_funding_info_id', 'ownershipFundingInfo' ],
		[ 'actionable_feedback_policy_id', 'actionableFeedbackPolicy' ],
		[ 'corrections_policy_id', 'correctionsPolicy' ],
		[ 'ethics_policy_id', 'ethicsPolicy' ],
		[ 'diversity_policy_id', 'diversityPolicy' ],
		[ 'diversity_staffing_report_id', 'diversityStaffingReport' ],
	];

	/**
	 * The indexable helper.
	 *
	 * @var Indexable_Helper
	 */
	private $indexable_helper;

	/**
	 * The post type helper.
	 *
	 * @var Post_Type_Helper
	 */
	private $post_type_helper;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * The indexable repository.
	 *
	 * @var Indexable_Repository
	 */
	private $indexable_repository;

	/**
	 * Returns the conditionals based on which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Front_End_Conditional::class ];
	}

	/**
	 * Publishing_Principles_Schema_Integration constructor.
	 *
	 * @param Options_Helper       $options_helper       The options helper.
	 * @param Indexable_Repository $indexable_repository The indexables repository.
	 * @param Indexable_Helper     $indexable_helper     The indexables helper.
	 * @param Post_Type_Helper     $post_type_helper     The post type helper.
	 */
	public function __construct(
		Options_Helper $options_helper,
		Indexable_Repository $indexable_repository,
		Indexable_Helper $indexable_helper,
		Post_Type_Helper $post_type_helper
	) {
		$this->options_helper       = $options_helper;
		$this->indexable_repository = $indexable_repository;
		$this->indexable_helper     = $indexable_helper;
		$this->post_type_helper     = $post_type_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_schema_organization', [ $this, 'filter_organization_schema' ] );
	}

	/**
	 * Make sure the Organization policies are added to the schema output.
	 *
	 * @param array $data The organization schema.
	 *
	 * @return array
	 */
	public function filter_organization_schema( $data ) {
		$policy_indexables = $this->get_indexables_for_publishing_principle_pages(
			self::PRINCIPLES_MAPPING
		);

		foreach ( $policy_indexables as $policy_data ) {
			$data = $this->add_schema_piece( $data, $policy_data );
		}

		return $data;
	}

	/**
	 * Adds the data to the schema array.
	 *
	 * @param array $schema_graph The current schema graph.
	 * @param array $policy_data  The data present for a policy.
	 *
	 * @return array The new schema graph.
	 */
	private function add_schema_piece( $schema_graph, $policy_data ): array {
		if ( ! \is_null( $policy_data['permalink'] ) ) {
			$schema_graph[ $policy_data['schema'] ] = $policy_data['permalink'];
		}

		return $schema_graph;
	}

	/**
	 * Finds the indexables for all the given principles if they are set.
	 *
	 * @param array $principles_data The data for all the principles.
	 *
	 * @return array
	 */
	private function get_indexables_for_publishing_principle_pages( $principles_data ): array {
		$principle_ids = [];
		$policies      = [];
		$ids           = [];
		foreach ( $principles_data as $principle ) {
			$option_value = $this->options_helper->get( $principle[0], false );
			if ( $option_value ) {
				$principle_ids[ $principle[0] ] = [
					'value'  => $option_value,
					'schema' => $principle[1],
				];
				$ids[]                          = $option_value;
			}
		}

		if ( \count( $ids ) === 0 ) {
			// Early return to not run an empty query.
			return [];
		}

		if ( $this->indexable_helper->should_index_indexables() && $this->post_type_helper->is_of_indexable_post_type( 'page' ) ) {
			$indexables = $this->indexable_repository->find_by_multiple_ids_and_type( \array_unique( $ids ), 'post' );

			foreach ( $principle_ids as $key => $principle_id ) {
				foreach ( $indexables as $indexable ) {
					if ( $indexable && $principle_id['value'] === $indexable->object_id ) {
						if ( $indexable->post_status === 'publish' && $indexable->is_protected === false ) {
							$policies[ $key ] = [
								'permalink' => $indexable->permalink,
								'schema'    => $principle_id['schema'],
							];
						}
						break;
					}
				}
			}

			return $policies;
		}

		foreach ( $principle_ids as $key => $principle_id ) {
			foreach ( $ids as $post_id ) {
				$post = \get_post( (int) $post_id );
				if ( \is_object( $post ) ) {
					if ( (int) $principle_id['value'] === (int) $post_id && \get_post_status( $post_id ) === 'publish' && $post->post_password === '' ) {
						$policies[ $key ] = [
							'permalink' => \get_permalink( $post_id ),
							'schema'    => $principle_id['schema'],
						];
						break;
					}
				}
			}
		}

		return $policies;
	}
}
