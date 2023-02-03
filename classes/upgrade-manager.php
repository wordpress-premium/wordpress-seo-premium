<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class WPSEO_Upgrade_Manager
 */
class WPSEO_Upgrade_Manager {

	/**
	 * Option key to save the version of Premium.
	 */
	const VERSION_OPTION_KEY = 'wpseo_premium_version';

	/**
	 * Run the upgrade routine when it's necessary.
	 *
	 * @param string $current_version The current WPSEO version.
	 */
	public function run_upgrade( $current_version ) {
		if ( wp_doing_ajax() ) {
			return;
		}

		$saved_version = get_option( self::VERSION_OPTION_KEY, '3.0.7' );

		if ( version_compare( $saved_version, $current_version, '<' ) ) {
			$this->check_update( $saved_version );

			update_option( self::VERSION_OPTION_KEY, $current_version );

			add_action( 'shutdown', 'flush_rewrite_rules' );
		}
	}

	/**
	 * Runs the specific updates when it is necessary.
	 *
	 * @param string $version_number The version number that will be compared.
	 */
	public function check_update( $version_number ) {
		// Get current version.
		$current_version = get_site_option( WPSEO_Premium::OPTION_CURRENT_VERSION, 1 );

		// Check if update is required.
		if ( WPSEO_Premium::PLUGIN_VERSION_CODE > $current_version ) {

			// Do update.
			$this->do_update( $current_version );

			// Update version code.
			$this->update_current_version_code();
		}

		if ( version_compare( $version_number, '2.3', '<' ) ) {
			add_action( 'wp', [ 'WPSEO_Redirect_Upgrade', 'import_redirects_2_3' ], 11 );
			add_action( 'admin_head', [ 'WPSEO_Redirect_Upgrade', 'import_redirects_2_3' ], 11 );
		}

		if ( version_compare( $version_number, '3.1', '<' ) ) {
			add_action( 'wp', [ 'WPSEO_Redirect_Upgrade', 'upgrade_3_1' ], 12 );
			add_action( 'admin_head', [ 'WPSEO_Redirect_Upgrade', 'upgrade_3_1' ], 12 );
		}

		if ( version_compare( $version_number, '4.7', '<' ) ) {
			add_action( 'wp', [ 'WPSEO_Premium_Prominent_Words_Versioning', 'upgrade_4_7' ], 12 );
			add_action( 'admin_head', [ 'WPSEO_Premium_Prominent_Words_Versioning', 'upgrade_4_7' ], 12 );
		}

		if ( version_compare( $version_number, '4.8', '<' ) ) {
			add_action( 'wp', [ 'WPSEO_Premium_Prominent_Words_Versioning', 'upgrade_4_8' ], 12 );
			add_action( 'admin_head', [ 'WPSEO_Premium_Prominent_Words_Versioning', 'upgrade_4_8' ], 12 );
		}

		if ( version_compare( $version_number, '9.8-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_9_8' ], 12 );
		}

		if ( version_compare( $version_number, '10.3', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_11' ], 12 );
		}

		if ( version_compare( $version_number, '13.0-RC0', '<' ) ) {
			add_action( 'init', [ 'WPSEO_Redirect_Upgrade', 'upgrade_13_0' ], 12 );
		}

		if ( version_compare( $version_number, '15.3-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_15_3' ], 12 );
		}

		if ( version_compare( $version_number, '16.2-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_16_2' ], 12 );
		}

		if ( version_compare( $version_number, '16.3-beta2', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_16_3' ], 12 );
		}

		if ( version_compare( $version_number, '17.2-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_17_2' ], 12 );
		}

		if ( version_compare( $version_number, '17.3-RC4', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_17_3' ], 12 );
		}

		if ( version_compare( $version_number, '17.4-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_17_4' ], 12 );
		}

		if ( version_compare( $version_number, '17.7-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_17_7' ], 12 );
		}

		if ( version_compare( $version_number, '19.3-RC0', '<' ) ) {
			add_action( 'init', [ $this, 'upgrade_19_3' ], 12 );
		}
	}

	/**
	 * Removes the inclusive language feature notification from the Notification center.
	 *
	 * @return void
	 */
	public function upgrade_19_3() {
		Yoast_Notification_Center::get()->remove_notification_by_id( 'wpseo-inclusive-language-notice' );
	}

	/**
	 * Make sure our options autoload.
	 *
	 * @return void
	 */
	public function upgrade_17_7() {
		global $wpdb;

		foreach ( [ WPSEO_Redirect_Option::OPTION_PLAIN, WPSEO_Redirect_Option::OPTION_REGEX ] as $option ) {
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery -- Normal methods only work if the option value has changed.
			$wpdb->update( $wpdb->options, [ 'autoload' => 'yes' ], [ 'option_name' => $option ] );
		}

		// Make sure we don't autoload the non-exported option.
		$wpdb->update( $wpdb->options, [ 'autoload' => 'no' ], [ 'option_name' => WPSEO_Redirect_Option::OPTION ] );
	}

	/**
	 * Schedules the cleanup integration if it's no already scheduled.
	 *
	 * @return void
	 */
	public function upgrade_17_4() {
		$this->retrigger_cleanup();
	}

	/**
	 * Clears the first step of the orphaned workout.
	 *
	 * @return void
	 */
	public function upgrade_17_3() {
		$workouts_option = WPSEO_Options::get( 'workouts' );

		if ( isset( $workouts_option['orphaned'] )
			&& isset( $workouts_option['orphaned']['indexablesByStep'] )
			&& is_array( $workouts_option['orphaned']['indexablesByStep'] )
		) {
			$workouts_option['orphaned']['indexablesByStep']['improveRemove'] = [];
			WPSEO_Options::set( 'workouts', $workouts_option );
		}
	}

	/**
	 * Schedules the cleanup integration if it's no already scheduled.
	 *
	 * @return void
	 */
	public function upgrade_17_2() {
		$this->retrigger_cleanup();
	}

	/**
	 * Re-triggers the cleanup of old things from the database.
	 *
	 * @return void
	 */
	protected function retrigger_cleanup() {
		// If Yoast SEO hasn't been upgraded to 17.2 the cleanup integration has not been implemented in the current way.
		if ( ! \defined( '\Yoast\WP\SEO\Integrations\Cleanup_Integration::START_HOOK' ) ) {
			return;
		}
		// If Yoast SEO premium was upgraded after Yoast SEO, reschedule the task to clean out orphaned prominent words.
		if ( ! \wp_next_scheduled( \Yoast\WP\SEO\Integrations\Cleanup_Integration::START_HOOK ) ) {
			\wp_schedule_single_event( ( time() + ( MINUTE_IN_SECONDS * 5 ) ), \Yoast\WP\SEO\Integrations\Cleanup_Integration::START_HOOK );
		}
	}

	/**
	 * Runs the language pack upgrader to migrate to TranslationsPress.
	 *
	 * @return void
	 */
	public function upgrade_16_3() {
		require_once ABSPATH . 'wp-admin/includes/admin.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		$upgrader       = new WP_Upgrader();
		$upgrader->skin = new Automatic_Upgrader_Skin();
		Language_Pack_Upgrader::async_upgrade( $upgrader );
	}

	/**
	 * Makes sure the Premium capabilities exist.
	 *
	 * @return void
	 */
	public function upgrade_16_2() {
		\do_action( 'wpseo_register_capabilities_premium' );
		\WPSEO_Capability_Manager_Factory::get( 'premium' )->add();
	}

	/**
	 * Renames the `prominent_words_indexation_completed` option.
	 *
	 * @return void
	 */
	public function upgrade_15_3() {
		$old_value = WPSEO_Options::get( 'prominent_words_indexation_completed' );
		WPSEO_Options::set( 'prominent_words_indexing_completed', $old_value );
	}

	/**
	 * Removes the orphaned content notification.
	 *
	 * @return void
	 */
	public function upgrade_11() {
		$orphaned_content_support = new WPSEO_Premium_Orphaned_Content_Support();
		$notification_manager     = Yoast_Notification_Center::get();

		foreach ( $orphaned_content_support->get_supported_post_types() as $post_type ) {
			// We need to remove the dismissal first, to clean up better but also as otherwise the remove won't work.
			delete_metadata( 'user', false, 'wpseo-premium-orphaned-content-' . $post_type, '', true );
			$notification_manager->remove_notification_by_id( 'wpseo-premium-orphaned-content-' . $post_type, true );
		}

		// Remove the cronjob if present.
		wp_clear_scheduled_hook( 'wpseo-premium-orphaned-content' );
	}

	/**
	 * Removes the stale cornerstone content beta notification.
	 *
	 * @return void
	 */
	public function upgrade_9_8() {
		$notification_manager = Yoast_Notification_Center::get();
		$notification_manager->remove_notification_by_id( 'wpseo-stale-content-notification' );

		// Delete the user meta data that tracks whether the user has seen the notification.
		delete_metadata( 'user', false, 'wp_wpseo-stale-content-notification', '', true );
	}

	/**
	 * Returns whether or not we should retry the 31 upgrade.
	 *
	 * @return bool
	 */
	public function should_retry_upgrade_31() {
		$retry = false;

		$new_redirects = get_option( WPSEO_Redirect_Option::OPTION, null );
		if ( $new_redirects === null ) {
			$old_plain_redirects = get_option( WPSEO_Redirect_Option::OLD_OPTION_PLAIN, [] );
			$old_regex_redirects = get_option( WPSEO_Redirect_Option::OLD_OPTION_REGEX, [] );

			if ( ! empty( $old_plain_redirects ) || ! empty( $old_regex_redirects ) ) {
				$retry = true;
			}
		}

		return $retry;
	}

	/**
	 * Validates if the 31 upgrade routine has correctly run and if not retries to run it
	 *
	 * @param bool $immediately Whether to do the upgrade immediately when this function is called.
	 */
	public function retry_upgrade_31( $immediately = false ) {
		/*
		 * If we detect that the new redirect option doesn't exist but there are redirects in the old option we try the
		 * upgrade routine again. This brings the redirects back for people if the upgrade routine failed the first
		 * time.
		 */
		if ( $this->should_retry_upgrade_31() ) {
			if ( $immediately ) {
				WPSEO_Redirect_Upgrade::upgrade_3_1();

				return;
			}
			add_action( 'wp', [ 'WPSEO_Redirect_Upgrade', 'upgrade_3_1' ], 12 );
			add_action( 'admin_head', [ 'WPSEO_Redirect_Upgrade', 'upgrade_3_1' ], 12 );
		}
	}

	/**
	 * An update is required, do it
	 *
	 * @param string $current_version The current version number of the installation.
	 */
	private function do_update( $current_version ) {
		// Upgrade to version 1.2.0.
		if ( $current_version < 15 ) {
			/**
			 * Upgrade redirects
			 */
			add_action( 'wp', [ 'WPSEO_Redirect_Upgrade', 'upgrade_1_2_0' ], 10 );
			add_action( 'admin_head', [ 'WPSEO_Redirect_Upgrade', 'upgrade_1_2_0' ], 10 );
		}
	}

	/**
	 * Update the current version code
	 */
	private function update_current_version_code() {
		update_site_option( WPSEO_Premium::OPTION_CURRENT_VERSION, WPSEO_Premium::PLUGIN_VERSION_CODE );
	}
}
