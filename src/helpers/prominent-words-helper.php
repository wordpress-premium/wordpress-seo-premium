<?php

namespace Yoast\WP\SEO\Helpers;

/**
 * Class Prominent_Words_Helper.
 *
 * @package Yoast\WP\SEO\Helpers
 */
class Prominent_Words_Helper {

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

	/**
	 * Prominent_Words_Helper constructor.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		$this->options_helper = $options_helper;
	}

	/**
	 * Computes the tf-idf (term frequency - inverse document frequency) score of a prominent word in a document.
	 * The document frequency should be 1 or higher, if it is not, it is assumed to be 1.
	 *
	 * @param int $term_frequency How many times the word occurs in the document.
	 * @param int $doc_frequency  In how many documents this word occurs.
	 *
	 * @return float The tf-idf score of a prominent word.
	 */
	public function compute_tf_idf_score( $term_frequency, $doc_frequency ) {
		// Set doc frequency to a minimum of 1, to avoid division by 0.
		$doc_frequency = \max( 1, $doc_frequency );

		return ( $term_frequency * ( 1 / $doc_frequency ) );
	}

	/**
	 * Computes the vector length for the given prominent words, applying Pythagoras's Theorem on the weights.
	 *
	 * @param array $prominent_words The prominent words, as an array mapping stems to `weight` and `df` (document frequency).
	 *
	 * @return float Vector length for the prominent words.
	 */
	public function compute_vector_length( $prominent_words ) {
		$sum_of_squares = 0;

		foreach ( $prominent_words as $stem => $word ) {
			$doc_frequency = 1;
			if ( \array_key_exists( 'df', $word ) ) {
				$doc_frequency = $word['df'];
			}

			$tf_idf          = $this->compute_tf_idf_score( $word['weight'], $doc_frequency );
			$sum_of_squares += ( $tf_idf ** 2 );
		}

		return \sqrt( $sum_of_squares );
	}

	/**
	 * Completes the prominent words indexing.
	 */
	public function complete_indexing() {
		$this->set_indexing_completed( true );
		\set_transient( 'total_unindexed_prominent_words', '0' );
	}

	/**
	 * Sets the prominent_words_indexing_completed option.
	 *
	 * @param bool $indexing_completed Whether or not the prominent words indexing has completed.
	 */
	public function set_indexing_completed( $indexing_completed ) {
		$this->options_helper->set( 'prominent_words_indexing_completed', $indexing_completed );
	}

	/**
	 * Gets a boolean that indicates whether the prominent words indexing has completed.
	 *
	 * @return bool Whether the prominent words indexing has completed.
	 */
	public function is_indexing_completed() {
		return $this->options_helper->get( 'prominent_words_indexing_completed' );
	}
}
