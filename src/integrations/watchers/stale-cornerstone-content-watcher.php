<?php

namespace Yoast\WP\SEO\Premium\Integrations\Watchers;

use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Premium\Conditionals\Cornerstone_Enabled_Conditional;

/**
 * Watcher for cornerstone content becoming stale.
 */
class Stale_Cornerstone_Content_Watcher implements Integration_Interface {

	/**
	 * The conditionals to check.
	 *
	 * @return string[] The conditionals to check.
	 */
	public static function get_conditionals() {
		return [
			Cornerstone_Enabled_Conditional::class,
		];
	}

	/**
	 * Registers the actions that trigger when an indexable is deleted or saved.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'wpseo_indexable_deleted', [ $this, 'maybe_invalidate_cache_when_cornerstone_is_deleted' ] );
		\add_action( 'wpseo_save_indexable', [ $this, 'maybe_invalidate_cache' ], 10, 2 );
	}

	/**
	 * Invalidates the cache for the stale cornerstone content count.
	 *
	 * @param Indexable $indexable The indexable that got deleted.
	 *
	 * @return void
	 */
	public function maybe_invalidate_cache_when_cornerstone_is_deleted( $indexable ) {
		if ( $indexable->is_cornerstone === false ) {
			return;
		}

		\wp_cache_delete( 'stale_cornerstone_count_' . $indexable->object_sub_type, 'stale_cornerstone_counts' );
	}

	/**
	 * Invalidates the cache for the stale cornerstone content when content gets un-cornerstoned.
	 *
	 * @param Indexable $indexable        The indexable that got deleted.
	 * @param Indexable $indexable_before The indexable before it got saved.
	 *
	 * @return void
	 */
	public function maybe_invalidate_cache( $indexable, $indexable_before ) {
		if ( ( $indexable->is_cornerstone === false ) && ( $indexable_before->is_cornerstone === false ) ) {
			return;
		}

		\wp_cache_delete( 'stale_cornerstone_count_' . $indexable->object_sub_type, 'stale_cornerstone_counts' );
	}
}
