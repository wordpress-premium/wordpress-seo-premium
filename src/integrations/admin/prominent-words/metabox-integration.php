<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action;

/**
 * Adds a hidden field to the metabox for storing the calculated words and also
 * handles the value of it after posting.
 */
class Metabox_Integration implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Represents the prominent words save action.
	 *
	 * @var Save_Action
	 */
	protected $save_action;

	/**
	 * Prominent_Words_Metabox constructor.
	 *
	 * @param Save_Action $save_action The prominent words save action.
	 */
	public function __construct( Save_Action $save_action ) {
		$this->save_action = $save_action;
	}

	/**
	 * Implements the register_hooks function of the Integration interface.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_metabox_entries_general', [ $this, 'add_words_for_linking_hidden_field' ] );
		\add_filter( 'update_post_metadata', [ $this, 'save_prominent_words_for_post' ], 10, 4 );

		\add_filter( 'wpseo_taxonomy_content_fields', [ $this, 'add_words_for_linking_hidden_field' ] );
		\add_action( 'edit_term', [ $this, 'save_prominent_words_for_term' ] );
	}

	/**
	 * Adds a hidden field for the prominent words to the metabox.
	 *
	 * @param array $field_defs The definitions for the input fields.
	 *
	 * @return array The definitions for the input fields.
	 */
	public function add_words_for_linking_hidden_field( $field_defs ) {
		if ( \is_array( $field_defs ) ) {
			$field_defs['words_for_linking'] = [
				'type'    => 'hidden',
				'title'   => 'words_for_linking',
				'label'   => '',
				'options' => '',
			];
		}

		return $field_defs;
	}

	/**
	 * Saves the value of the _yoast_wpseo_words_for_linking hidden field to the prominent_words table, not postmeta.
	 * Added to the 'update_post_metadata' filter.
	 *
	 * @param false|null $check      Whether to allow updating metadata for the given type.
	 * @param int        $object_id  The post id.
	 * @param string     $meta_key   The key of the metadata.
	 * @param mixed      $meta_value The value of the metadata.
	 *
	 * @return false|null Non-null value if meta data should not be updated.
	 *                    Null if the metadata should be updated as normal.
	 */
	public function save_prominent_words_for_post( $check, $object_id, $meta_key, $meta_value ) {
		if ( $meta_key !== '_yoast_wpseo_words_for_linking' ) {
			return $check;
		}

		// If the save was triggered with an empty meta value, don't update the prominent words.
		if ( empty( $meta_value ) ) {
			return false;
		}

		// 1. Decode from stringified JSON.
		$words_for_linking = \json_decode( $meta_value, true );
		// 2. Save prominent words using the existing functionality.
		$this->save_action->link( 'post', $object_id, $words_for_linking );

		// 3. Return non-null value so we don't save prominent words to the `post_meta` table.
		return false;
	}

	/**
	 * Saves the prominent words for a term.
	 *
	 * @param int $term_id The term id to save the words for.
	 *
	 * @return void
	 */
	public function save_prominent_words_for_term( $term_id ) {
		// phpcs:disable WordPress.Security.NonceVerification.Missing -- The nonce is already validated.
		if ( ! isset( $_POST['wpseo_words_for_linking'] ) ) {
			return;
		}

		$words_for_linking = [];
		if ( ! empty( $_POST['wpseo_words_for_linking'] ) ) {
			$prominent_words = \sanitize_text_field( \wp_unslash( $_POST['wpseo_words_for_linking'] ) );
			// phpcs:enable
			$words_for_linking = \json_decode( $prominent_words, true );
		}

		$this->save_action->link( 'term', $term_id, $words_for_linking );
	}
}
