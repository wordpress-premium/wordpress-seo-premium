<?php

namespace Yoast\WP\SEO\Integrations\Admin;

use Yoast\WP\SEO\Actions\Indexing\Indexable_General_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Type_Archive_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Term_Indexation_Action;
use Yoast\WP\SEO\Actions\Prominent_Words\Content_Action;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Capability_Helper;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast_Notification_Center;

/**
 * Integration for determining and showing the notification
 * to ask users to calculate prominent words for their site.
 *
 * @deprecated 15.1
 * @codeCoverageIgnore
 *
 * @package Yoast\WP\SEO\Integrations\Admin
 */
class Prominent_Words_Notification implements Integration_Interface {

	/**
	 * The ID of the notification.
	 */
	const NOTIFICATION_ID = 'wpseo-premium-prominent-words-recalculate';

	/**
	 * How many indexables without prominent words should exist before this notification is shown to the user.
	 */
	const UNINDEXED_THRESHOLD = 25;

	/**
	 * Prominent_Words_Notification_Integration constructor.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @param Yoast_Notification_Center                     $notification_center          The notification center.
	 * @param Content_Action                                $content_action               The content action.
	 * @param Indexable_Post_Indexation_Action              $post_indexation              The post indexing action.
	 * @param Indexable_Term_Indexation_Action              $term_indexation              The term indexing action.
	 * @param Indexable_General_Indexation_Action           $general_indexation           The general indexing action.
	 * @param Indexable_Post_Type_Archive_Indexation_Action $post_type_archive_indexation The post type indexing action.
	 * @param Capability_Helper                             $capability                   The capability helper.
	 * @param Options_Helper                                $options                      The options helper.
	 */
	public function __construct(
		Yoast_Notification_Center $notification_center,
		Content_Action $content_action,
		Indexable_Post_Indexation_Action $post_indexation,
		Indexable_Term_Indexation_Action $term_indexation,
		Indexable_General_Indexation_Action $general_indexation,
		Indexable_Post_Type_Archive_Indexation_Action $post_type_archive_indexation,
		Capability_Helper $capability,
		Options_Helper $options
	) {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}

	/**
	 * Initializes the integration by registering the right hooks and filters.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Handles the option change to make sure the notification will be removed when link suggestions are disabled.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @param mixed $old_value The old value.
	 * @param mixed $new_value The new value.
	 */
	public function handle_option_change( $old_value, $new_value ) {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}

	/**
	 * Manages, for each user, if the notification should be shown or removed.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 */
	public function manage_notification() {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}

	/**
	 * Cleans up the notification for all applicable users.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 */
	public function cleanup_notification() {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}
}
