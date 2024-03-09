<?php

namespace Yoast\WP\SEO\Premium\Actions\Prominent_Words;

use Exception;
use WPSEO_Premium_Prominent_Words_Versioning;
use Yoast\WP\SEO\Models\Prominent_Words;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Action for updating the prominent words in the prominent words table,
 * and linking them to an indexable.
 *
 * @see \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route;
 */
class Save_Action {

	/**
	 * The repository to retrieve and save prominent words with.
	 *
	 * @var Prominent_Words_Repository
	 */
	protected $prominent_words_repository;

	/**
	 * The repository to retrieve and save indexables with.
	 *
	 * @var Indexable_Repository
	 */
	protected $indexable_repository;

	/**
	 * Contains helper function for prominent words.
	 * For e.g. computing vector lengths and tf-idf scores.
	 *
	 * @var Prominent_Words_Helper
	 */
	protected $prominent_words_helper;

	/**
	 * Prominent_Words_Link_Service constructor.
	 *
	 * @param Prominent_Words_Repository $prominent_words_repository The repository to create, read, update and delete
	 *                                                               prominent words from.
	 * @param Indexable_Repository       $indexable_repository       The repository to read, update and delete
	 *                                                               indexables from.
	 * @param Prominent_Words_Helper     $prominent_words_helper     The prominent words helper.
	 */
	public function __construct(
		Prominent_Words_Repository $prominent_words_repository,
		Indexable_Repository $indexable_repository,
		Prominent_Words_Helper $prominent_words_helper
	) {
		$this->prominent_words_repository = $prominent_words_repository;
		$this->indexable_repository       = $indexable_repository;
		$this->prominent_words_helper     = $prominent_words_helper;
	}

	/**
	 * Passes to-be-linked prominent words to the link function, together with the object type and object id of the
	 * indexable to which they will need to be linked.
	 *
	 * @param array $data The data to process. This is an array consisting of associative arrays (1 per indexable) with the keys
	 *                    'object_id', 'object_type' and 'prominent_words' (an array with 'stem' => 'weight' mappings).
	 *
	 * @return void
	 */
	public function save( $data ) {
		if ( $data ) {
			foreach ( $data as $row ) {
				$prominent_words = ( $row['prominent_words'] ?? [] );

				$this->link( $row['object_type'], $row['object_id'], $prominent_words );
			}
		}
	}

	/**
	 * Inserts, updates and removes prominent words that are now, or are no longer, associated with an indexable.
	 *
	 * @param string $object_type The object type of the indexable (e.g. `post` or `term`).
	 * @param int    $object_id   The object id of the indexable.
	 * @param array  $words       The words to link, as a `'stem' => weight` map.
	 *
	 * @return void
	 */
	public function link( $object_type, $object_id, $words ) {
		$indexable = $this->indexable_repository->find_by_id_and_type( $object_id, $object_type );

		if ( $indexable ) {
			// Set the prominent words version number on the indexable.
			$indexable->prominent_words_version = WPSEO_Premium_Prominent_Words_Versioning::get_version_number();

			/*
			 * It is correct to save here, because if the indexable didn't exist yet,
			 * find_by_id_and_type (in the above 'save' function) will have auto-created an indexable object
			 * with the correct data. So we are not saving an incomplete indexable.
			 */
			$indexable->save();

			// Find the prominent words that were already associated with this indexable.
			$old_words = $this->prominent_words_repository->find_by_indexable_id( $indexable->id );

			// Handle these words.
			$words = $this->handle_old_words( $indexable->id, $old_words, $words );

			// Create database entries for all new words that are not yet in the database.
			$this->create_words( $indexable->id, $words );
		}
	}

	/**
	 * Deletes outdated prominent words from the database, and otherwise considers
	 * whether the old words need to have their weights updated.
	 *
	 * @param int               $indexable_id The id of the indexable which needs to have its
	 *                                        old words updated.
	 * @param Prominent_Words[] $old_words    An array with prominent words that were already
	 *                                        present in the database for a given indexable.
	 * @param array             $words        The new prominent words for a given indexable.
	 *
	 * @return array The words that need to be created.
	 */
	protected function handle_old_words( $indexable_id, $old_words, $words ) {
		// Return early if the indexable didn't already have any prominent words associated with it.
		if ( empty( $old_words ) ) {
			return $words;
		}

		$outdated_stems = [];

		foreach ( $old_words as $old_word ) {
			// If an old prominent word is no longer associated with an indexable,
			// add it to the array with outdated stems, so that at a later step
			// it can be deleted from the database.
			if ( ! \array_key_exists( $old_word->stem, $words ) ) {
				$outdated_stems[] = $old_word->stem;

				continue;
			}

			// If the old word should still be associated with the indexable,
			// update its weight if that has changed.
			$this->update_weight_if_changed( $old_word, $words[ $old_word->stem ] );

			// Remove the key from the array with the new prominent words.
			unset( $words[ $old_word->stem ] );
		}

		// Delete all the outdated prominent words in one query.
		try {
			$this->prominent_words_repository->delete_by_indexable_id_and_stems( $indexable_id, $outdated_stems );
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch -- There is nothing to do.
		} catch ( Exception $exception ) {
			// Do nothing.
		}

		return $words;
	}

	/**
	 * Updates the weight of the given prominent word, if the weight has changed significantly.
	 *
	 * @param Prominent_Words $word       The prominent word of which to update the weight.
	 * @param float           $new_weight The new weight.
	 *
	 * @return void
	 */
	protected function update_weight_if_changed( $word, $new_weight ) {
		if ( \abs( $word->weight - $new_weight ) > 0.1 ) {
			$word->weight = $new_weight;
			$word->save();
		}
	}

	/**
	 * Creates the given words in the database and links them to the indexable with the given id.
	 *
	 * @param int   $indexable_id The ID of the indexable.
	 * @param array $words        The prominent words to create, as a `'stem'` => weight` map.
	 *
	 * @return void
	 */
	protected function create_words( $indexable_id, $words ) {
		// Return early if there are no new words to add to the database.
		if ( empty( $words ) ) {
			return;
		}

		$new_models = [];

		foreach ( $words as $stem => $weight ) {
			$new_model    = $this->prominent_words_repository->query()->create(
				[
					'indexable_id' => $indexable_id,
					'stem'         => $stem,
					'weight'       => $weight,
				]
			);
			$new_models[] = $new_model;
		}

		try {
			$this->prominent_words_repository->query()->insert_many( $new_models );
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch -- There is nothing to do.
		} catch ( Exception $exception ) {
			// Do nothing.
		}
	}
}
