<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

use Yoast\WP\SEO\Actions\Indexing\Post_Link_Indexing_Action;
use Yoast\WP\SEO\Config\Migration_Status;

/**
 * Represents some util helpers for the orphaned posts.
 */
class WPSEO_Premium_Orphaned_Content_Utils {

	/**
	 * Checks if the orphaned content feature is enabled.
	 *
	 * @return bool True when the text link counter is enabled.
	 */
	public static function is_feature_enabled() {
		if ( ! YoastSEO()->classes->get( Migration_Status::class )->is_version( 'free', WPSEO_VERSION ) ) {
			return false;
		}

		return WPSEO_Options::get( 'enable_text_link_counter', false );
	}

	/**
	 * Checks if there are unprocessed objects.
	 *
	 * @return bool True when there are unprocessed objects.
	 */
	public static function has_unprocessed_content() {
		static $has_unprocessed_posts;

		if ( $has_unprocessed_posts === null ) {
			$post_link_action      = YoastSEO()->classes->get( Post_Link_Indexing_Action::class );
			$has_unprocessed_posts = $post_link_action->get_total_unindexed();
		}

		return $has_unprocessed_posts;
	}
}
