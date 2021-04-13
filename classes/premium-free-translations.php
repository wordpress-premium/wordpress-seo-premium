<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Load WordPress SEO translations from WordPress.org for the Free part of the plugin, to make sure the translations
 * are present.
 */
class WPSEO_Premium_Free_Translations implements WPSEO_WordPress_Integration {

	/**
	 * Registers all hooks to WordPress.
	 */
	public function register_hooks() {
		add_filter( 'http_request_args', [ $this, 'request_wordpress_seo_translations' ], 10, 2 );
	}

	/**
	 * Adds Yoast SEO (Free) to the update checklist of installed plugins, to check for new translations.
	 *
	 * @param array  $args HTTP Request arguments to modify.
	 * @param string $url  The HTTP request URI that is executed.
	 *
	 * @return array The modified Request arguments to use in the update request.
	 */
	public function request_wordpress_seo_translations( $args, $url ) {
		// Only do something on upgrade requests.
		if ( strpos( $url, 'api.wordpress.org/plugins/update-check' ) === false ) {
			return $args;
		}

		/*
		 * If Yoast SEO is already in the list, don't add it again.
		 *
		 * Checking this by name because the install path is not guaranteed.
		 * The capitalized json data defines the array keys, therefore we need to check and define these as such.
		 */
		$plugins = json_decode( $args['body']['plugins'], true );
		foreach ( $plugins['plugins'] as $data ) {
			if ( isset( $data['Name'] ) && $data['Name'] === 'Yoast SEO' ) {
				return $args;
			}
		}

		/*
		 * Add an entry to the list that matches the WordPress.org slug for Yoast SEO Free.
		 *
		 * This entry is based on the currently present data from this plugin, to make sure the version and textdomain
		 * settings are as expected. Take care of the capitalized array key as before.
		 */
		$plugins['plugins']['wordpress-seo/wp-seo.php'] = $plugins['plugins'][ WPSEO_PREMIUM_BASENAME ];
		// Override the name of the plugin.
		$plugins['plugins']['wordpress-seo/wp-seo.php']['Name'] = 'Yoast SEO';
		// Override the version of the plugin to prevent increasing the update count.
		$plugins['plugins']['wordpress-seo/wp-seo.php']['Version'] = '9999.0';

		// Overwrite the plugins argument in the body to be sent in the upgrade request.
		$args['body']['plugins'] = WPSEO_Utils::format_json_encode( $plugins );

		return $args;
	}
}
