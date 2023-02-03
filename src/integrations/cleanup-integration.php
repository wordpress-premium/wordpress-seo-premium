<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use wpdb;
use Yoast\WP\Lib\Model;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Adds cleanup hooks.
 */
class Cleanup_Integration implements Integration_Interface {

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array The array of conditionals.
	 */
	public static function get_conditionals() {
		return [];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_cleanup_tasks', [ $this, 'add_cleanup_tasks' ] );
	}

	/**
	 * Adds cleanup tasks for the cleanup integration.
	 *
	 * @param array $tasks Array of tasks to be added.
	 *
	 * @return array An associative array of tasks to be added to the cleanup integration.
	 */
	public function add_cleanup_tasks( $tasks ) {
		return \array_merge(
			$tasks,
			[
				'clean_orphaned_indexables_prominent_words' => function( $limit ) {
					return $this->cleanup_orphaned_from_table( 'Prominent_Words', 'indexable_id', $limit );
				},
				'clean_old_prominent_word_entries' => function( $limit ) {
					return $this->cleanup_old_prominent_words( $limit );
				},
				'clean_old_prominent_word_version_numbers' => function( $limit ) {
					return $this->cleanup_old_prominent_word_version_numbers( $limit );
				},
			]
		);
	}

	/**
	 * Cleans orphaned rows from a yoast table.
	 *
	 * @param string $table  The table to cleanup.
	 * @param string $column The table column the cleanup will rely on.
	 * @param int    $limit  The limit we'll apply to the queries.
	 *
	 * @return int The number of deleted rows.
	 */
	public function cleanup_orphaned_from_table( $table, $column, $limit ) {
		global $wpdb;

		$table           = Model::get_table_name( $table );
		$indexable_table = Model::get_table_name( 'Indexable' );

		// Warning: If this query is changed, make sure to update the query in cleanup_orphaned_from_table in Free as well.
		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Reason: There is no unescaped user input.
		$query = $wpdb->prepare(
			"
			SELECT table_to_clean.{$column}
			FROM {$table} table_to_clean
			LEFT JOIN {$indexable_table} AS indexable_table
			ON table_to_clean.{$column} = indexable_table.id
			WHERE indexable_table.id IS NULL
			AND table_to_clean.{$column} IS NOT NULL
			LIMIT %d",
			$limit
		);
		// phpcs:enable

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- Reason: Already prepared.
		$orphans = $wpdb->get_col( $query );

		if ( empty( $orphans ) ) {
			return 0;
		}
		// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- Reason: Already prepared.
		return \intval( $wpdb->query( "DELETE FROM $table WHERE {$column} IN( " . \implode( ',', $orphans ) . ' ) ' ) );
	}

	/**
	 * Cleans up old style prominent words from the database.
	 *
	 * @param int $limit The maximum amount of old prominent words to clean up in one go. Defaults to 1000.
	 *
	 * @return int The number of deleted rows.
	 */
	public function cleanup_old_prominent_words( $limit = 1000 ) {
		global $wpdb;

		$taxonomy_ids = $this->retrieve_prominent_word_taxonomies( $wpdb, $limit );

		if ( \count( $taxonomy_ids ) === 0 ) {
			return 0;
		}

		$nr_of_deleted_rows = $this->delete_prominent_word_taxonomies_and_terms( $wpdb, $taxonomy_ids );

		if ( $nr_of_deleted_rows === false ) {
			// Failed query.
			return 0;
		}

		return $nr_of_deleted_rows;
	}

	// phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

	/**
	 * Retrieve a list of prominent word taxonomy IDs.
	 *
	 * @param wpdb $wpdb  The WordPress database object.
	 * @param int  $limit The maximum amount of prominent word taxonomies to retrieve.
	 *
	 * @return string[] A list of prominent word taxonomy IDs (of size 'limit').
	 */
	protected function retrieve_prominent_word_taxonomies( $wpdb, $limit ) {
		return $wpdb->get_col(
			$wpdb->prepare(
				"SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = %s LIMIT %d",
				[ 'yst_prominent_words', $limit ]
			)
		);
	}

	/**
	 * Deletes the given list of taxonomies and their terms.
	 *
	 * @param wpdb     $wpdb         The WordPress database object.
	 * @param string[] $taxonomy_ids The IDs of the taxonomies to remove and their corresponding terms.
	 *
	 * @return bool|int `false` if the query failed, the amount of rows deleted otherwise.
	 */
	protected function delete_prominent_word_taxonomies_and_terms( $wpdb, $taxonomy_ids ) {
		return $wpdb->query(
			$wpdb->prepare(
				"DELETE t, tr, tt FROM {$wpdb->term_taxonomy} tt
				LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id 
				LEFT JOIN {$wpdb->term_relationships} tr ON tt.term_taxonomy_id = tr.term_taxonomy_id 
				WHERE tt.term_taxonomy_id IN ( " . \implode( ', ', \array_fill( 0, \count( $taxonomy_ids ), '%s' ) ) . ' )',
				$taxonomy_ids
			)
		);
	}

	/**
	 * Cleans up the old prominent word versions from the postmeta table in the database.
	 *
	 * @param int $limit The maximum number of prominent word version numbers to clean in one go.
	 *
	 * @return bool|int The number of cleaned up prominent word version numbers, or `false` if the query failed.
	 */
	protected function cleanup_old_prominent_word_version_numbers( $limit ) {
		global $wpdb;

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Reason: There is no unescaped user input.
		$query = $wpdb->prepare(
			"DELETE FROM {$wpdb->postmeta} WHERE meta_key = %s LIMIT %d",
			[ '_yst_prominent_words_version', $limit ]
		);
		// phpcs:enable

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- Reason: Already prepared.
		return $wpdb->query( $query );
	}

	// phpcs:enable
}
