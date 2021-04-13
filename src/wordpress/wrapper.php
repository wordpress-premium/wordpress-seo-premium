<?php

namespace Yoast\WP\SEO\Premium\WordPress;

use WPSEO_Premium_Prominent_Words_Support;
use WPSEO_Premium_Prominent_Words_Unindexed_Post_Query;
use WPSEO_Replace_Vars;

/**
 * Wrapper class for Premium classes.
 *
 * This consists of factory functions to inject Premium classes into the dependency container.
 */
class Wrapper {

	/**
	 * Wrapper method for returning the WPSEO_Replace_Vars object for use in dependency injection.
	 *
	 * @return WPSEO_Replace_Vars The WPSEO_Replace_Vars global.
	 */
	public static function get_replace_vars() {
		static $instance;

		if ( \is_null( $instance ) ) {
			$instance = new WPSEO_Replace_Vars();
		}

		return $instance;
	}

	/**
	 * Wrapper method for returning the WPSEO_Premium_Prominent_Words_Unindexed_Post_Query object for use in dependency injection.
	 *
	 * @return WPSEO_Premium_Prominent_Words_Unindexed_Post_Query The WPSEO_Premium_Prominent_Words_Unindexed_Post_Query global.
	 */
	public static function get_prominent_words_unindex_post_query() {
		static $instance;

		if ( \is_null( $instance ) ) {
			$instance = new WPSEO_Premium_Prominent_Words_Unindexed_Post_Query();
		}

		return $instance;
	}

	/**
	 * Wrapper method for returning the WPSEO_Premium_Prominent_Words_Support object for use in dependency injection.
	 *
	 * @return WPSEO_Premium_Prominent_Words_Support The WPSEO_Premium_Prominent_Words_Support global.
	 */
	public static function get_prominent_words_support() {
		static $instance;

		if ( \is_null( $instance ) ) {
			$instance = new WPSEO_Premium_Prominent_Words_Support();
		}

		return $instance;
	}
}
