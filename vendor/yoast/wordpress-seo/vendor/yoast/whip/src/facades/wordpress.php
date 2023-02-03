<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

if ( ! function_exists( 'whip_wp_check_versions' ) ) {
	/**
	 * Facade to quickly check if version requirements are met.
	 *
	 * @param array $requirements The requirements to check.
	 */
	function whip_wp_check_versions( $requirements ) {
		// Only show for admin users.
		if ( ! is_array( $requirements ) ) {
			return;
		}

		$config  = include dirname( __FILE__ ) . '/../configs/default.php';
		$checker = new Whip_RequirementsChecker( $config );

		foreach ( $requirements as $component => $versionComparison ) {
			$checker->addRequirement( Whip_VersionRequirement::fromCompareString( $component, $versionComparison ) );
		}

		$checker->check();

		if ( ! $checker->hasMessages() ) {
			return;
		}

		$dismissThreshold = ( WEEK_IN_SECONDS * 4 );
		$dismissMessage   = __( 'Remind me again in 4 weeks.', 'default' );

		$dismisser = new Whip_MessageDismisser( time(), $dismissThreshold, new Whip_WPDismissOption() );

		$presenter = new Whip_WPMessagePresenter( $checker->getMostRecentMessage(), $dismisser, $dismissMessage );

		// Prevent duplicate notices across multiple implementing plugins.
		if ( ! has_action( 'whip_register_hooks' ) ) {
			add_action( 'whip_register_hooks', array( $presenter, 'registerHooks' ) );
		}

		/**
		 * Fires during hooks registration for the message presenter.
		 *
		 * @param \Whip_WPMessagePresenter $presenter Message presenter instance.
		 */
		do_action( 'whip_register_hooks', $presenter );
	}
}
