<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Admin
 */

/**
 * Keeps track of the prominent words version.
 */
class WPSEO_Premium_Prominent_Words_Versioning {

	// Needs to be manually updated in case of a major change.
	public const VERSION_NUMBER = 2;

	public const POST_META_NAME = '_yst_prominent_words_version';

	/**
	 * Gets the version number.
	 *
	 * @return int The version number that was set in WPSEO_Premium_Prominent_Words_Versioning.
	 */
	public static function get_version_number() {
		return self::VERSION_NUMBER;
	}

	/**
	 * Renames the meta key for the prominent words version. It was a public meta field and it has to be private.
	 *
	 * @return void
	 */
	public static function upgrade_4_7() {
		global $wpdb;

		// The meta key has to be private, so prefix it.
		$wpdb->query(
			$wpdb->prepare(
				'UPDATE ' . $wpdb->postmeta . ' SET meta_key = %s WHERE meta_key = "yst_prominent_words_version"',
				self::POST_META_NAME
			)
		);
	}

	/**
	 * Removes the meta key for the prominent words version for the unsupported languages that might have this value
	 * set.
	 *
	 * @return void
	 */
	public static function upgrade_4_8() {
		$supported_languages = [ 'en', 'de', 'nl', 'es', 'fr', 'it', 'pt', 'ru', 'pl', 'sv', 'id' ];

		if ( in_array( WPSEO_Language_Utils::get_language( get_locale() ), $supported_languages, true ) ) {
			return;
		}

		global $wpdb;

		// The remove all post metas.
		$wpdb->query(
			$wpdb->prepare(
				'DELETE FROM ' . $wpdb->postmeta . ' WHERE meta_key = %s',
				self::POST_META_NAME
			)
		);
	}
}
