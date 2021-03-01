<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Localizes JavaScript files.
 */
final class WPSEO_Premium_Asset_JS_L10n {

	/**
	 * Localizes the given script with the JavaScript translations.
	 *
	 * @param string $script_handle The script handle to localize for.
	 *
	 * @return void
	 */
	public function localize_script( $script_handle ) {
		$translations = [
			'wordpress-seo-premium' => $this->get_translations( 'wordpress-seo-premiumjs' ),
		];
		wp_localize_script( $script_handle, 'wpseoPremiumJSL10n', $translations );
	}

	/**
	 * Returns translations necessary for JS files.
	 *
	 * @param string $component The component to retrieve the translations for.
	 * @return object|null The translations in a Jed format for JS files or null
	 *                     if the translation file could not be found.
	 */
	protected function get_translations( $component ) {
		$locale = \get_user_locale();

		$file = plugin_dir_path( WPSEO_PREMIUM_FILE ) . '/languages/' . $component . '-' . $locale . '.json';
		if ( file_exists( $file ) ) {
			$file = file_get_contents( $file );
			if ( is_string( $file ) && $file !== '' ) {
				return json_decode( $file, true );
			}
		}

		return null;
	}
}
