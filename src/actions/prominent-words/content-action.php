<?php

namespace Yoast\WP\SEO\Premium\Actions\Prominent_Words;

use WPSEO_Premium_Prominent_Words_Support;
use WPSEO_Premium_Prominent_Words_Versioning;
use Yoast\WP\Lib\ORM;
use Yoast\WP\SEO\Actions\Indexing\Indexation_Action_Interface;
use Yoast\WP\SEO\Context\Meta_Tags_Context;
use Yoast\WP\SEO\Helpers\Meta_Helper;
use Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Retrieves the indexable data and Yoast SEO metadata (meta-description, SEO title, keywords and synonyms)
 * from the database.
 */
class Content_Action implements Indexation_Action_Interface {

	public const TRANSIENT_CACHE_KEY = 'total_unindexed_prominent_words';

	/**
	 * An instance of the WPSEO_Premium_Prominent_Words_Support.
	 *
	 * @var WPSEO_Premium_Prominent_Words_Support An instance of the WPSEO_Premium_Prominent_Words_Support
	 */
	protected $prominent_words_support;

	/**
	 * Reference to the indexable repository to retrieve outdated indexables.
	 *
	 * @var Indexable_Repository
	 */
	protected $indexable_repository;

	/**
	 * The meta tags context memoizer.
	 *
	 * @var Meta_Tags_Context_Memoizer
	 */
	protected $memoizer;

	/**
	 * The meta value helper.
	 *
	 * @var Meta_Helper
	 */
	protected $meta;

	/**
	 * Holds the object sub types.
	 *
	 * @var array|null
	 */
	protected $object_sub_types;

	/**
	 * Content_Action constructor.
	 *
	 * @param WPSEO_Premium_Prominent_Words_Support $prominent_words_support An instance of
	 *                                                                       WPSEO_Premium_Prominent_Words_Support.
	 * @param Indexable_Repository                  $indexable_repository    An instance of Indexable_Repository.
	 * @param Meta_Tags_Context_Memoizer            $memoizer                The meta tags context memoizer.
	 * @param Meta_Helper                           $meta                    The meta value helper.
	 */
	public function __construct(
		WPSEO_Premium_Prominent_Words_Support $prominent_words_support,
		Indexable_Repository $indexable_repository,
		Meta_Tags_Context_Memoizer $memoizer,
		Meta_Helper $meta
	) {
		$this->prominent_words_support = $prominent_words_support;
		$this->indexable_repository    = $indexable_repository;
		$this->memoizer                = $memoizer;
		$this->meta                    = $meta;
	}

	/**
	 * Returns the number of indexables to be indexed for internal linking suggestions in one batch.
	 *
	 * @return int The number of indexables to be indexed in one batch.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_prominent_words_indexation_limit' - Allow filtering the amount of indexables indexed during each indexing pass.
		 *
		 * @param int $max The maximum number of indexables indexed.
		 */
		$limit = \apply_filters( 'wpseo_prominent_words_indexation_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
		}

		return $limit;
	}

	/**
	 * The total number of indexables without prominent words.
	 *
	 * @return int|false The total number of indexables without prominent words. False if the query fails.
	 */
	public function get_total_unindexed() {
		$object_sub_types = $this->get_object_sub_types();
		if ( empty( $object_sub_types ) ) {
			return 0;
		}

		// This prevents an expensive query.
		$total_unindexed = \get_transient( static::TRANSIENT_CACHE_KEY );
		if ( $total_unindexed !== false ) {
			return (int) $total_unindexed;
		}

		// Try a less expensive query first: check if the indexable table holds any indexables.
		// If not, no need to perform a query on the prominent words version and more.
		if ( ! $this->at_least_one_indexable() ) {
			return 0;
		}

		// Run the expensive query to find out the exact number and store it for later use.
		$total_unindexed = $this->query()->count();
		\set_transient( static::TRANSIENT_CACHE_KEY, $total_unindexed, \DAY_IN_SECONDS );

		return $total_unindexed;
	}

	/**
	 * The total number of indexables without prominent words.
	 *
	 * @param int $limit Limit the number of unindexed objects that are counted.
	 *
	 * @return int|false The total number of indexables without prominent words. False if the query fails.
	 */
	public function get_limited_unindexed_count( $limit ) {
		return $this->get_total_unindexed();
	}

	/**
	 * Retrieves a batch of indexables, to be indexed for internal linking suggestions.
	 *
	 * @return array The indexables data to use for generating prominent words.
	 */
	public function index() {
		$object_sub_types = $this->get_object_sub_types();
		if ( empty( $object_sub_types ) ) {
			return [];
		}

		$indexables = $this
			->query()
			->limit( $this->get_limit() )
			->find_many();

		if ( \count( $indexables ) > 0 ) {
			\delete_transient( static::TRANSIENT_CACHE_KEY );
		}

		// If no indexables have been left unindexed, return the empty array.
		if ( ! $indexables ) {
			return [];
		}

		return $this->format_data( $indexables );
	}

	/**
	 * Creates a query that can find indexables with outdated prominent words.
	 *
	 * @return ORM Returns an ORM instance that can be used to execute the query.
	 */
	protected function query() {
		$updated_version = WPSEO_Premium_Prominent_Words_Versioning::get_version_number();

		return $this->indexable_repository
			->query()
			->where_in( 'object_type', [ 'post', 'term' ] )
			->where_in( 'object_sub_type', $this->get_object_sub_types() )
			->where_raw( '(`prominent_words_version` IS NULL OR `prominent_words_version` != ' . $updated_version . ')' )
			->where_raw( '((`post_status` IS NULL AND `object_type` = \'term\') OR (`post_status` = \'publish\' AND `object_type` = \'post\'))' );
	}

	/**
	 * Creates a query that checks whether the indexable table holds at least one record.
	 *
	 * @return bool true if at the database contains at least one indexable.
	 */
	protected function at_least_one_indexable() {
		return $this->indexable_repository
			->query()
			->select( 'id' )
			->find_one() !== false;
	}

	/**
	 * Retrieves a list of subtypes to get indexables for.
	 *
	 * @return array The array with object subtypes.
	 */
	protected function get_object_sub_types() {
		if ( $this->object_sub_types === null ) {
			$this->object_sub_types = \array_merge(
				$this->prominent_words_support->get_supported_post_types(),
				$this->prominent_words_support->get_supported_taxonomies()
			);
		}

		return $this->object_sub_types;
	}

	/**
	 * Formats the data of the given array of indexables, so it can be used to generate prominent words.
	 *
	 * @param Indexable[] $indexables The indexables to gather data for.
	 *
	 * @return array The data.
	 */
	protected function format_data( $indexables ) {
		$data = [];
		foreach ( $indexables as $indexable ) {
			// Use the meta context, so we are sure that the data is the same as is output on the frontend.
			$context = $this->get_context( $indexable );

			if ( ! $context ) {
				continue;
			}

			$data[] = [
				'object_id'   => $indexable->object_id,
				'object_type' => $indexable->object_type,
				'content'     => $this->get_content( $context ),
				'meta'        => [
					'primary_focus_keyword' => $context->indexable->primary_focus_keyword,
					'title'                 => $context->title,
					'description'           => $context->description,
					'keyphrase_synonyms'    => $this->retrieve_keyphrase_synonyms( $context->indexable ),
				],
			];
		}

		return $data;
	}

	/**
	 * Gets the context for the current indexable.
	 *
	 * @param Indexable $indexable The indexable to get context for.
	 *
	 * @return Meta_Tags_Context|null The context object.
	 */
	protected function get_context( $indexable ) {
		if ( $indexable->object_type === 'post' ) {
			return $this->memoizer->get( $indexable, 'Post_Type' );
		}

		if ( $indexable->object_type === 'term' ) {
			return $this->memoizer->get( $indexable, 'Term_Archive' );
		}

		return null;
	}

	/**
	 * Retrieves the keyphrase synonyms for the indexable.
	 *
	 * @param Indexable $indexable The indexable to retrieve synonyms for.
	 *
	 * @return string[] The keyphrase synonyms.
	 */
	protected function retrieve_keyphrase_synonyms( $indexable ) {
		if ( $indexable->object_type === 'post' ) {
			return \json_decode( $this->meta->get_value( 'keywordsynonyms', $indexable->object_id ) );
		}

		if ( $indexable->object_type === 'term' ) {
			return \json_decode( $this->meta->get_term_value( $indexable->object_id, $indexable->object_sub_type, 'wpseo_keywordsynonyms' ) );
		}

		return [];
	}

	/**
	 * Determines the content to use.
	 *
	 * @param Meta_Tags_Context $context The meta tags context object.
	 *
	 * @return string The content associated with the given context.
	 */
	protected function get_content( Meta_Tags_Context $context ) {
		if ( $context->indexable->object_type === 'post' ) {
			global $post;

			/*
			 * Set the global $post to be the post in this iteration.
			 * This is required for post-specific shortcodes that reference the global post.
			 */

			// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- To setup the post we need to do this explicitly.
			$post = $context->post;

			// Set up WordPress data for this post, outside of "the_loop".
			\setup_postdata( $post );

			// Wraps in output buffering to prevent shortcodes that echo stuff instead of return from breaking things.
			\ob_start();
			$content = \do_shortcode( $post->post_content );
			\ob_end_clean();

			\wp_reset_postdata();

			return $content;
		}

		if ( $context->indexable->object_type === 'term' ) {
			$term = \get_term( $context->indexable->object_id, $context->indexable->object_sub_type );
			if ( $term === null || \is_wp_error( $term ) ) {
				return '';
			}

			// Wraps in output buffering to prevent shortcodes that echo stuff instead of return from breaking things.
			\ob_start();
			$description = \do_shortcode( $term->description );
			\ob_end_clean();

			return $description;
		}

		return '';
	}
}
