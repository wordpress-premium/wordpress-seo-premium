<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Class WPSEO_Premium_Prominent_Words_Language_Support.
 *
 * @deprecated 14.7
 * @codeCoverageIgnore
 */
class WPSEO_Premium_Prominent_Words_Language_Support {

	/**
	 * List of supported languages.
	 *
	 * @var string[]
	 */
	protected $supported_languages = [ 'en', 'de', 'nl', 'es', 'fr', 'it', 'pt', 'ru', 'pl', 'sv', 'id' ];

	/**
	 * Returns whether the current language is supported for the link suggestions.
	 *
	 * @deprecated 14.7
	 * @codeCoverageIgnore
	 *
	 * @param string $language The language to check for.
	 *
	 * @return bool Whether the current language is supported for the link suggestions.
	 */
	public function is_language_supported( $language ) {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.7' );

		return in_array( $language, $this->supported_languages, true );
	}
}
