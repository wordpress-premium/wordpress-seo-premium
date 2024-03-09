<?php

namespace Yoast\WP\SEO\Premium\Integrations\Watchers;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository;

/**
 * Watcher for changes that need to trigger actions related to prominent words.
 */
class Prominent_Words_Watcher implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The repository of the prominent words.
	 *
	 * @var Prominent_Words_Repository
	 */
	private $prominent_words_repository;

	/**
	 * The Prominent_Words_Watcher constructor
	 *
	 * @param Prominent_Words_Repository $prominent_words_repository The prominent words repository.
	 */
	public function __construct( Prominent_Words_Repository $prominent_words_repository ) {
		$this->prominent_words_repository = $prominent_words_repository;
	}

	/**
	 * Registers the action that triggers when an indexable is deleted.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'wpseo_indexable_deleted', [ $this, 'remove_prominent_words_for_indexable' ] );
	}

	/**
	 * Removes all prominent words for indexables if they are present.
	 *
	 * @param Indexable $indexable The indexable that got deleted.
	 *
	 * @return void
	 */
	public function remove_prominent_words_for_indexable( $indexable ) {

		$prominent_words = $this->prominent_words_repository->find_by_indexable_id( $indexable->id );

		if ( \count( $prominent_words ) > 0 ) {
			$this->prominent_words_repository->delete_by_indexable_id( $indexable->id );
		}
	}
}
