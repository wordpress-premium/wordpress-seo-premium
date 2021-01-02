<?php

namespace Yoast\WP\SEO\Actions\Prominent_Words;

use Exception;
use WPSEO_Premium_Prominent_Words_Versioning;
use Yoast\WP\SEO\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Models\Prominent_Words;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use Yoast\WP\SEO\Repositories\Prominent_Words_Repository;

/**
 * Action for linking a list of prominent words to an indexable.
 *
 * @see \Yoast\WP\SEO\Routes\Prominent_Words_Route;
 *
 * @package Yoast\WP\SEO\Actions
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
	 * Links a list of prominent words to an indexable.
	 *
	 * Deletes the prominent words that have been stored previously, but are not in the new list of prominent words.
	 *
	 * @param array $data The data to process.
	 */
	public function save( $data ) {
		if ( $data ) {
			foreach ( $data as $row ) {
				$prominent_words = ( isset( $row['prominent_words'] ) ? $row['prominent_words'] : [] );

				$this->link( $row['object_type'], $row['object_id'], $prominent_words );
			}
		}
	}

	/**
	 * Links a list of prominent words to an indexable.
	 *
	 * @param string $object_type The object type of the indexable (e.g. `post` or `term`).
	 * @param int    $object_id   The object id of the indexable.
	 * @param array  $words       The words to link, as a `'stem' => weight` map.
	 */
	public function link( $object_type, $object_id, $words ) {
		$indexable = $this->indexable_repository->find_by_id_and_type( $object_id, $object_type );

		$indexable->prominent_words_version = WPSEO_Premium_Prominent_Words_Versioning::get_version_number();

		/*
		 * It is correct to save here, because find_by_id_and_type will auto create an indexable object
		 * with the correct data. So we are not saving an incomplete indexable.
		 */
		$indexable->save();

		$old_words = $this->prominent_words_repository->find_by_indexable_id( $indexable->id );

		foreach ( $old_words as $old_word ) {
			// Remove when old word isn't found.
			if ( ! \array_key_exists( $old_word->stem, $words ) ) {
				$old_word->delete();

				continue;
			}

			$this->update_weight_if_changed( $old_word, $words[ $old_word->stem ] );
			unset( $words[ $old_word->stem ] );
		}

		// Create all new words that are not yet in the database.
		$this->create_words( $indexable->id, $words );
	}

	/**
	 * Updates the weight of the given prominent word.
	 * (Does not update when the weights are the same).
	 *
	 * @param Prominent_Words $word       The prominent word of which to update the weight.
	 * @param float           $new_weight The new weight.
	 */
	protected function update_weight_if_changed( $word, $new_weight ) {
		if ( $word->weight !== $new_weight ) {
			$word->weight = $new_weight;
			$word->save();
		}
	}

	/**
	 * Creates the given words in the database and links them to the indexable with the given id.
	 *
	 * @param int   $indexable_id The ID of the indexable.
	 * @param array $words        The words to create, as a `'stem'` => weight` map.
	 */
	protected function create_words( $indexable_id, $words ) {
		foreach ( $words as $stem => $weight ) {
			$new_word = $this->prominent_words_repository->query()->create(
				[
					'indexable_id' => $indexable_id,
					'stem'         => $stem,
					'weight'       => $weight,
				]
			);

			try {
				$new_word->save();
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch -- There is nothing to do.
			} catch ( Exception $exception ) {
				// Do nothing.
			}
		}
	}
}
