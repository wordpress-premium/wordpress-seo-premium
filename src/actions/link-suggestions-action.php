<?php

namespace Yoast\WP\SEO\Premium\Actions;

use WP_Query;
use WPSEO_Premium_Prominent_Words_Support;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use Yoast\WP\SEO\Repositories\SEO_Links_Repository;

/**
 * Handles the actual requests to the prominent words endpoints.
 */
class Link_Suggestions_Action {

	/**
	 * The amount of indexables to retrieve in one go
	 * when generating internal linking suggestions.
	 */
	const BATCH_SIZE = 1000;

	/**
	 * The repository to retrieve prominent words from.
	 *
	 * @var Prominent_Words_Repository
	 */
	protected $prominent_words_repository;

	/**
	 * The repository to retrieve indexables from.
	 *
	 * @var Indexable_Repository
	 */
	protected $indexable_repository;

	/**
	 * The repository to retrieve links from.
	 *
	 * @var SEO_Links_Repository
	 */
	protected $links_repository;

	/**
	 * Contains helper functions for calculating with and comparing prominent words.
	 *
	 * @var Prominent_Words_Helper
	 */
	protected $prominent_words_helper;

	/**
	 * Represents the prominent words support class.
	 *
	 * @var WPSEO_Premium_Prominent_Words_Support
	 */
	protected $prominent_words_support;

	/**
	 * Link_Suggestions_Service constructor.
	 *
	 * @param Prominent_Words_Repository            $prominent_words_repository The repository to retrieve prominent words from.
	 * @param Indexable_Repository                  $indexable_repository       The repository to retrieve indexables from.
	 * @param Prominent_Words_Helper                $prominent_words_helper     Class with helper methods for prominent words.
	 * @param WPSEO_Premium_Prominent_Words_Support $prominent_words_support    The prominent words support class.
	 * @param SEO_Links_Repository                  $links_repository           The repository to retrieve links from.
	 */
	public function __construct(
		Prominent_Words_Repository $prominent_words_repository,
		Indexable_Repository $indexable_repository,
		Prominent_Words_Helper $prominent_words_helper,
		WPSEO_Premium_Prominent_Words_Support $prominent_words_support,
		SEO_Links_Repository $links_repository
	) {
		$this->prominent_words_repository = $prominent_words_repository;
		$this->indexable_repository       = $indexable_repository;
		$this->prominent_words_helper     = $prominent_words_helper;
		$this->prominent_words_support    = $prominent_words_support;
		$this->links_repository           = $links_repository;
	}

	/**
	 * Suggests a list of links, based on the given array of prominent words.
	 *
	 * @param array  $words_from_request     The prominent words as an array mapping words to weights.
	 * @param int    $limit                  The maximum number of link suggestions to retrieve.
	 * @param int    $object_id              The object id for the current indexable.
	 * @param string $object_type            The object type for the current indexable.
	 * @param bool   $include_existing_links Optional. Whether or not to include existing links, defaults to true.
	 * @param array  $post_type              Optional. The list of post types where suggestions may come from.
	 * @param bool   $only_include_public    Optional. Only include public indexables, defaults to false.
	 *
	 * @return array Links for the post that are suggested.
	 */
	public function get_suggestions( $words_from_request, $limit, $object_id, $object_type, $include_existing_links = true, $post_type = [], $only_include_public = false ) {
		$current_indexable_id = null;
		$current_indexable    = $this->indexable_repository->find_by_id_and_type( $object_id, $object_type );
		if ( $current_indexable ) {
			$current_indexable_id = $current_indexable->id;
		}

		/*
		 * Gets best suggestions (returns a sorted array [$indexable_id => score]).
		 * The indexables are processed in batches of 1000 indexables each.
		 */
		$suggestions_scores = $this->retrieve_suggested_indexable_ids( $words_from_request, $limit, self::BATCH_SIZE, $current_indexable_id, $include_existing_links, $post_type, $only_include_public );

		$indexable_ids = \array_keys( $suggestions_scores );

		// Return the empty list if no suggestions have been found.
		if ( empty( $indexable_ids ) ) {
			return [];
		}

		// Retrieve indexables for suggestions.
		$suggestions_indexables = $this->indexable_repository->query()->where_id_in( $indexable_ids )->find_many();

		/**
		 * Filter 'wpseo_link_suggestions_indexables' - Allow filtering link suggestions indexable objects.
		 *
		 * @api array An array of suggestion indexables that can be filtered.
		 *
		 * @param int    $object_id   The object id for the current indexable.
		 * @param string $object_type The object type for the current indexable.
		 */
		$suggestions_indexables = \apply_filters( 'wpseo_link_suggestions_indexables', $suggestions_indexables, $object_id, $object_type );

		// Create suggestions objects.
		return $this->create_suggestions( $suggestions_indexables, $suggestions_scores );
	}

	/**
	 * Suggests a list of links, based on the given array of prominent words.
	 *
	 * @param int  $id                     The object id for the current indexable.
	 * @param int  $limit                  The maximum number of link suggestions to retrieve.
	 * @param bool $include_existing_links Optional. Whether or not to include existing links, defaults to true.
	 *
	 * @return array Links for the post that are suggested.
	 */
	public function get_indexable_suggestions_for_indexable( $id, $limit, $include_existing_links = true ) {
		$weighted_words  = [];
		$prominent_words = $this->prominent_words_repository->query()
			->where( 'indexable_id', $id )
			->find_array();
		foreach ( $prominent_words as $prominent_word ) {
			$weighted_words[ $prominent_word['stem'] ] = $prominent_word['weight'];
		}

		/*
		 * Gets best suggestions (returns a sorted array [$indexable_id => score]).
		 * The indexables are processed in batches of 1000 indexables each.
		 */
		$suggestions_scores = $this->retrieve_suggested_indexable_ids( $weighted_words, $limit, self::BATCH_SIZE, $id, $include_existing_links );

		$indexable_ids = \array_keys( $suggestions_scores );

		// Return the empty list if no suggestions have been found.
		if ( empty( $indexable_ids ) ) {
			return [];
		}

		// Retrieve indexables for suggestions.
		return $this->indexable_repository->query()->where_id_in( $indexable_ids )->find_array();
	}

	/**
	 * Retrieves the titles of the posts with the given IDs.
	 *
	 * @param array $post_ids The IDs of the posts to retrieve the titles of.
	 *
	 * @return array An array mapping post ID to title.
	 */
	protected function retrieve_posts( $post_ids ) {
		$query = new WP_Query(
			[
				'post_type'      => $this->prominent_words_support->get_supported_post_types(),
				'post__in'       => $post_ids,
				'posts_per_page' => \count( $post_ids ),
			]
		);
		$posts = $query->get_posts();

		$post_data = [];

		foreach ( $posts as $post ) {
			$post_data[ $post->ID ] = [
				'title' => $post->post_title,
			];
		}

		return $post_data;
	}

	/**
	 * Retrieves the names of the terms with the given IDs.
	 *
	 * @param Indexable[] $indexables The indexables to retrieve titles for.
	 *
	 * @return array An array mapping term ID to title.
	 */
	protected function retrieve_terms( $indexables ) {
		$data = [];
		foreach ( $indexables as $indexable ) {
			if ( $indexable->object_type !== 'term' ) {
				continue;
			}

			$term = \get_term_by( 'term_id', $indexable->object_id, $indexable->object_sub_type );

			$data[ $indexable->object_id ] = [
				'title' => $term->name,
			];
		}

		return $data;
	}

	/**
	 * Retrieves the titles of the given array of indexables.
	 *
	 * @param Indexable[] $indexables An array of indexables for which to retrieve the titles.
	 *
	 * @return array A two-dimensional array mapping object type and object id to title.
	 */
	protected function retrieve_object_titles( $indexables ) {
		$object_ids = [];

		foreach ( $indexables as $indexable ) {
			if ( \array_key_exists( $indexable->object_type, $object_ids ) ) {
				$object_ids[ $indexable->object_type ][] = $indexable->object_id;
			}
			else {
				$object_ids[ $indexable->object_type ] = [ $indexable->object_id ];
			}
		}

		$objects = [
			'post' => [],
			'term' => [],
		];

		// At the moment we only support internal linking for posts, so we only need the post titles.
		if ( \array_key_exists( 'post', $object_ids ) ) {
			$objects['post'] = $this->retrieve_posts( $object_ids['post'] );
		}

		if ( \array_key_exists( 'term', $object_ids ) ) {
			$objects['term'] = $this->retrieve_terms( $indexables );
		}

		return $objects;
	}

	/**
	 * Computes, for a given indexable, its raw matching score on the request words to match.
	 * In general, higher scores mean better matches.
	 *
	 * @param array $request_data   The words to match, as an array containing stems, weights and dfs.
	 * @param array $candidate_data The words to match against, as an array of `Prominent_Words` objects.
	 *
	 * @return float A raw score of the indexable.
	 */
	protected function compute_raw_score( $request_data, $candidate_data ) {
		$raw_score = 0;

		foreach ( $candidate_data as $stem => $candidate_word_data ) {
			if ( ! \array_key_exists( $stem, $request_data ) ) {
				continue;
			}

			$word_from_request_weight = $request_data[ $stem ]['weight'];
			$word_from_request_df     = $request_data[ $stem ]['df'];
			$candidate_weight         = $candidate_word_data['weight'];
			$candidate_df             = $candidate_word_data['df'];

			$tf_idf_word_from_request  = $this->prominent_words_helper->compute_tf_idf_score( $word_from_request_weight, $word_from_request_df );
			$tf_idf_word_from_database = $this->prominent_words_helper->compute_tf_idf_score( $candidate_weight, $candidate_df );

			// Score on this word is the product of the tf-idf scores.
			$raw_score += ( $tf_idf_word_from_request * $tf_idf_word_from_database );
		}

		return $raw_score;
	}

	/**
	 * Combines weight data of the request words to their document frequencies. This is needed to calculate
	 * vector length of the request data.
	 *
	 * @param array $request_words An array mapping words to weights.
	 *
	 * @return array An array mapping stems, weights and dfs.
	 */
	protected function compose_request_data( $request_words ) {
		$request_doc_frequencies = $this->prominent_words_repository->count_document_frequencies( \array_keys( $request_words ) );
		$combined_request_data   = [];
		foreach ( $request_words as $stem => $weight ) {
			if ( ! isset( $request_doc_frequencies[ $stem ] ) ) {
				continue;
			}

			$combined_request_data[ $stem ] = [
				'weight' => (int) $weight,
				'df'     => $request_doc_frequencies[ $stem ],
			];
		}

		return $combined_request_data;
	}

	/**
	 * Transforms the array of prominent words into an array of objects mapping indexable_id to an array
	 * of prominent words associated with this indexable_id, with each prominent word's stem as a key.
	 *
	 * @param array $words The array of prominent words, with indexable_id as one of the keys.
	 *
	 * @return array An array mapping indexable IDs to their prominent words.
	 */
	protected function group_words_by_indexable_id( $words ) {
		$candidates_words_by_indexable_ids = [];
		foreach ( $words as $word ) {
			$indexable_id = $word->indexable_id;

			$candidates_words_by_indexable_ids[ $indexable_id ][ $word->stem ] = [
				'weight' => (int) $word->weight,
				'df'     => (int) $word->df,
			];
		}

		return $candidates_words_by_indexable_ids;
	}

	/**
	 * Calculates a matching score for one candidate indexable.
	 *
	 * @param array $request_data          An array matching stems from request to their weights and dfs.
	 * @param float $request_vector_length The vector length of the request words.
	 * @param array $candidate_data        An array matching stems from the candidate to their weights and dfs.
	 *
	 * @return float A matching score for an indexable.
	 */
	protected function calculate_score_for_indexable( $request_data, $request_vector_length, $candidate_data ) {
		$raw_score               = $this->compute_raw_score( $request_data, $candidate_data );
		$candidate_vector_length = $this->prominent_words_helper->compute_vector_length( $candidate_data );
		return $this->normalize_score( $raw_score, $candidate_vector_length, $request_vector_length );
	}

	/**
	 * In the prominent words repository, find a $batch_size of all ProminentWord-IndexableID pairs where
	 * prominent words match the set of stems we are interested in.
	 * Request prominent words for indexables in the batch (including the iDF of all words) to calculate
	 * their vector length later.
	 *
	 * @param array $stems               The stems in the request.
	 * @param int   $batch_size          How many indexables to request in one query.
	 * @param int   $page                The start of the current batch (in pages).
	 * @param int[] $excluded_ids        The indexable IDs to exclude.
	 * @param array $post_type           The post types that will be searched.
	 * @param bool  $only_include_public If only public indexables are included.
	 *
	 * @return array An array of ProminentWords objects, containing their stem, weight, indexable id,
	 *               and document frequency.
	 */
	protected function get_candidate_words( $stems, $batch_size, $page, $excluded_ids = [], $post_type = [], $only_include_public = false ) {

		return $this->prominent_words_repository->find_by_list_of_ids(
			$this->prominent_words_repository->find_ids_by_stems( $stems, $batch_size, $page, $excluded_ids, $post_type, $only_include_public )
		);
	}

	/**
	 * For each candidate indexable, computes their matching score related to the request set of prominent words.
	 * The candidate indexables are analyzed in batches.
	 * After having computed scores for a batch the function saves the best candidates until now.
	 *
	 * @param array    $request_words          The words to match, as an array mapping words to weights.
	 * @param int      $limit                  The max number of suggestions that should be returned by the function.
	 * @param int      $batch_size             The number of indexables that should be analyzed in every batch.
	 * @param int|null $current_indexable_id   The id for the current indexable.
	 * @param bool     $include_existing_links Optional. Whether or not to include existing links, defaults to true.
	 * @param array    $post_type              Optional. The list of post types where suggestions may come from.
	 * @param bool     $only_include_public    Optional. Only include public indexables, defaults to false.
	 *
	 * @return array An array mapping indexable IDs to scores. Higher scores mean better matches.
	 */
	protected function retrieve_suggested_indexable_ids( $request_words, $limit, $batch_size, $current_indexable_id, $include_existing_links = true, $post_type = [], $only_include_public = false ) {
		// Combine stems, weights and DFs from request.
		$request_data = $this->compose_request_data( $request_words );

		// Calculate vector length of the request set (needed for score normalization later).
		$request_vector_length = $this->prominent_words_helper->compute_vector_length( $request_data );

		// Get all links the post already links to, those shouldn't be suggested.
		$excluded_indexable_ids = [ $current_indexable_id ];
		if ( ! $include_existing_links && $current_indexable_id ) {
			$links                  = $this->links_repository->query()
				->distinct()
				->select( 'indexable_id' )
				->where( 'target_indexable_id', $current_indexable_id )
				->find_many();
			$excluded_indexable_ids = \array_merge( $excluded_indexable_ids, \wp_list_pluck( $links, 'indexable_id' ) );
		}
		$excluded_indexable_ids = \array_filter( $excluded_indexable_ids );

		$request_stems = \array_keys( $request_data );
		$scores        = [];
		$page          = 1;

		do {
			// Retrieve the words of all indexables in this batch that share prominent word stems with request.
			$candidates_words = $this->get_candidate_words( $request_stems, $batch_size, $page, $excluded_indexable_ids, $post_type, $only_include_public );

			// Transform the prominent words table so that it is indexed by indexable_ids.
			$candidates_words_by_indexable_ids = $this->group_words_by_indexable_id( $candidates_words );

			$batch_scores_size = 0;

			foreach ( $candidates_words_by_indexable_ids as $id => $candidate_data ) {
				$scores[ $id ] = $this->calculate_score_for_indexable( $request_data, $request_vector_length, $candidate_data );
				++$batch_scores_size;
			}

			// Sort the list of scores and keep only the top $limit of the scores.
			$scores = $this->get_top_suggestions( $scores, $limit );

			++$page;
		} while ( $batch_scores_size === $batch_size );

		return $scores;
	}

	/**
	 * Normalizes the raw score based on the length of the prominent word vectors.
	 *
	 * @param float $raw_score               The raw (non-normalized) score.
	 * @param float $vector_length_candidate The vector lengths of the candidate indexable.
	 * @param float $vector_length_request   The vector length of the words from the request.
	 *
	 * @return int|float The score, normalized on vector lengths.
	 */
	protected function normalize_score( $raw_score, $vector_length_candidate, $vector_length_request ) {
		$normalizing_factor = ( $vector_length_request * $vector_length_candidate );

		if ( $normalizing_factor === 0.0 ) {
			// We can't divide by 0, so set the score to 0 instead.
			return 0;
		}

		return ( $raw_score / $normalizing_factor );
	}

	/**
	 * Sorts the indexable ids based on the score and returns the top N indexable ids based on a specified limit.
	 * (Returns all indexable ids if there are less indexable ids than specified by the limit.)
	 *
	 * @param array $scores The array matching indexable ids to their scores.
	 * @param int   $limit  The maximum number of indexables that should be returned.
	 *
	 * @return array The top N indexable ids, sorted from highest to lowest score.
	 */
	protected function get_top_suggestions( $scores, $limit ) {
		// Sort the indexables by descending score.
		\uasort(
			$scores,
			static function ( $score_1, $score_2 ) {
				if ( $score_1 === $score_2 ) {
					return 0;
				}

				return ( ( $score_1 < $score_2 ) ? 1 : -1 );
			}
		);

		// Take the top $limit suggestions, while preserving their ids specified in the keys of the array elements.
		return \array_slice( $scores, 0, $limit, true );
	}

	/**
	 * Gets the singular label of the given combination of object type and sub type.
	 *
	 * @param string $object_type     An object type. For example 'post' or 'term'.
	 * @param string $object_sub_type An object sub type. For example 'page' or 'category'.
	 *
	 * @return string The singular label of the given combination of object type and sub type,
	 *                or the empty string if the singular label does not exist.
	 */
	protected function get_sub_type_singular_label( $object_type, $object_sub_type ) {
		switch ( $object_type ) {
			case 'post':
				$post_type = \get_post_type_object( $object_sub_type );
				if ( $post_type ) {
					return $post_type->labels->singular_name;
				}
				break;
			case 'term':
				$taxonomy = \get_taxonomy( $object_sub_type );
				if ( $taxonomy ) {
					return $taxonomy->labels->singular_name;
				}
				break;
		}

		return '';
	}

	/**
	 * Creates link suggestion data based on the indexables that should be suggested and the scores for these
	 * indexables.
	 *
	 * @param Indexable[] $indexables The indexables for which to create linking suggestions.
	 * @param array       $scores     The scores for the linking suggestions.
	 *
	 * @return array The internal linking suggestions.
	 */
	protected function create_suggestions( $indexables, $scores ) {
		$objects          = $this->retrieve_object_titles( $indexables );
		$link_suggestions = [];

		foreach ( $indexables as $indexable ) {
			if ( ! \array_key_exists( $indexable->object_type, $objects ) ) {
				continue;
			}

			// Object tied to this indexable. E.g. post, page, term.
			if ( ! \array_key_exists( $indexable->object_id, $objects[ $indexable->object_type ] ) ) {
				continue;
			}

			$link_suggestions[] = [
				'object_type'   => $indexable->object_type,
				'id'            => (int) ( $indexable->object_id ),
				'title'         => $objects[ $indexable->object_type ][ $indexable->object_id ]['title'],
				'link'          => $indexable->permalink,
				'isCornerstone' => (bool) $indexable->is_cornerstone,
				'labels'        => $this->get_labels( $indexable ),
				'score'         => \round( (float) ( $scores[ $indexable->id ] ), 2 ),
			];
		}

		/*
		 * Because the request to the indexables table messes up with the ordering of the suggestions,
		 * we have to sort again.
		 */
		$this->sort_suggestions_by_field( $link_suggestions, 'score' );

		$cornerstone_suggestions     = $this->filter_suggestions( $link_suggestions, true );
		$non_cornerstone_suggestions = $this->filter_suggestions( $link_suggestions, false );

		return \array_merge_recursive( [], $cornerstone_suggestions, $non_cornerstone_suggestions );
	}

	/**
	 * Retrieves the labels for the link suggestion.
	 *
	 * @param Indexable $indexable The indexable to determine the labels for.
	 *
	 * @return array The labels.
	 */
	protected function get_labels( Indexable $indexable ) {
		$labels = [];
		if ( $indexable->is_cornerstone ) {
			$labels[] = 'cornerstone';
		}

		$labels[] = $this->get_sub_type_singular_label( $indexable->object_type, $indexable->object_sub_type );

		return $labels;
	}

	/**
	 * Sorts the given link suggestion by field.
	 *
	 * @param array  $link_suggestions The link suggestions to sort.
	 * @param string $field            The field to sort suggestions by.
	 */
	protected function sort_suggestions_by_field( array &$link_suggestions, $field ) {
		\usort(
			$link_suggestions,
			static function ( $suggestion_1, $suggestion_2 ) use ( $field ) {
				if ( $suggestion_1[ $field ] === $suggestion_2[ $field ] ) {
					return 0;
				}

				return ( ( $suggestion_1[ $field ] < $suggestion_2[ $field ] ) ? 1 : -1 );
			}
		);
	}

	/**
	 * Filters the suggestions by cornerstone status.
	 *
	 * @param array $link_suggestions The suggestions to filter.
	 * @param bool  $cornerstone      Whether or not to include the cornerstone suggestions.
	 *
	 * @return array The filtered suggestions.
	 */
	protected function filter_suggestions( $link_suggestions, $cornerstone ) {
		return \array_filter(
			$link_suggestions,
			static function ( $suggestion ) use ( $cornerstone ) {
				return (bool) $suggestion['isCornerstone'] === $cornerstone;
			}
		);
	}
}
