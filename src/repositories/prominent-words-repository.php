<?php

namespace Yoast\WP\SEO\Repositories;

use Yoast\WP\Lib\Model;
use Yoast\WP\Lib\ORM;

/**
 * Class Prominent_Words_Repository
 *
 * @package Yoast\WP\SEO\ORM\Repositories
 */
class Prominent_Words_Repository {

	/**
	 * Starts a query for this repository.
	 *
	 * @return ORM
	 */
	public function query() {
		return Model::of_type( 'Prominent_Words' );
	}

	/**
	 * Finds the prominent words for a given post (indexable).
	 *
	 * @param int $indexable_id The indexable ID.
	 *
	 * @return array The list of prominent words items found by the idexable id.
	 */
	public function find_by_indexable_id( $indexable_id ) {
		return $this->query()->where( 'indexable_id', $indexable_id )->find_many();
	}

	/**
	 * Finds the prominent words based on a list of indexable ids.
	 * The method also computes the document frequency of each word and adds it as a separate property on the objects.
	 *
	 * @param array<int> $ids The ids of indexables to get prominent words for.
	 *
	 * @return array The list of prominent words items found by indexable ids.
	 */
	public function find_by_list_of_ids( $ids ) {
		if ( empty( $ids ) ) {
			return [];
		}

		// Get the name of the prominent words table (can be different for example in case of a multisite setup).
		$table = Model::get_table_name( 'prominent_words' );

		$query = '( SELECT COUNT(*) FROM ' . $table . ' WHERE ' . $table . '.stem = prominent_words_table.stem )';

		return $this->query()
				->table_alias( 'prominent_words_table' )
				->select( '*' )
				->select_expr( $query, 'df' )
				->where_in( 'indexable_id', $ids )
				->find_many();
	}

	/**
	 * Finds all indexable ids which have prominent words with stems from the list.
	 *
	 * @param array $stems The stems of prominent words to search for.
	 * @param int   $limit The number of indexable ids to return in 1 call.
	 * @param int   $page  From which page (batch) to begin.
	 *
	 * @return array The list of indexable ids.
	 */
	public function find_ids_by_stems( $stems, $limit, $page ) {
		if ( empty( $stems ) ) {
			return [];
		}

		$offset                           = ( ( $page - 1 ) * $limit );
		$indexable_ids_in_prominent_words = $this->query()
			->distinct()
			->select( 'indexable_id' )
			->where_in( 'stem', $stems )
			->limit( $limit )
			->offset( $offset )
			->find_many();

		return \array_map(
			static function( $obj ) {
				return $obj->indexable_id;
			},
			$indexable_ids_in_prominent_words
		);
	}

	/**
	 * Counts the number of documents in which each of the given stems occurs.
	 *
	 * @param array<string> $stems The stems of the words for which to find the document frequencies.
	 *
	 * @return array The list of stems and their respective document frequencies. Each entry has a 'stem' and a 'document_frequency' parameter.
	 */
	public function count_document_frequencies( $stems ) {
		if ( empty( $stems ) ) {
			return [];
		}

		/*
		 * Count in how many documents each stem occurs by querying the database.
		 * Returns "Prominent_Words" with two properties: 'stem' and 'document_frequency'.
		 */
		$raw_doc_frequencies = $this->query()
				->select( 'stem' )
				->select_expr( 'COUNT( stem )', 'document_frequency' )
				->where_in( 'stem', $stems )
				->group_by( 'stem' )
				->find_many();

		// We want to change the raw document frequencies into a map mapping stems to document frequency.
		$stems = \array_map(
			static function ( $item ) {
				return $item->stem;
			},
			$raw_doc_frequencies
		);

		$doc_frequencies = \array_fill_keys( $stems, 0 );
		foreach ( $raw_doc_frequencies as $raw_doc_frequency ) {
			$doc_frequencies[ $raw_doc_frequency->stem ] = (int) $raw_doc_frequency->document_frequency;
		}

		return $doc_frequencies;
	}
}
