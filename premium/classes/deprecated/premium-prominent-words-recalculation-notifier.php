<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

_deprecated_file( __FILE__, 'WPSEO Premium 14.5' );

/**
 * Handles adding site wide analysis UI to the WordPress admin.
 */
class WPSEO_Premium_Prominent_Words_Recalculation_Notifier implements WPSEO_WordPress_Integration {

	const NOTIFICATION_ID = 'wpseo-premium-prominent-words-recalculate';

	const UNINDEXED_THRESHOLD = 10;

	/**
	 * Registers all hooks to WordPress
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 */
	public function register_hooks() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Removes the notification when it is set and the amount of unindexed items is lower than the threshold.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 */
	public function cleanup_notification() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Adds the notification when it isn't set already and the amount of unindexed items is greater than the set.
	 * threshold.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 */
	public function manage_notification() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Handles the option change to make sure the notification will be removed when link suggestions are disabled.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @param mixed $old_value The old value.
	 * @param mixed $new_value The new value.
	 */
	public function handle_option_change( $old_value, $new_value ) {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Checks if the notification has been set already.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @return bool True when there is a notification.
	 */
	public function has_notification() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );

		return false;
	}

	/**
	 * Migration for removing the persistent notification.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 */
	public static function upgrade_12_8() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}
}
