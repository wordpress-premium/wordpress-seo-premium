<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirects\Redirect\Exporters
 */

/**
 * Saving the redirects from a single file into two smaller options files.
 */
class WPSEO_Redirect_Option_Exporter implements WPSEO_Redirect_Exporter {

	/**
	 * This method will split the redirects in separate arrays and store them in an option.
	 *
	 * @param WPSEO_Redirect[] $redirects The redirects to export.
	 *
	 * @return bool
	 */
	public function export( $redirects ) {
		$formatted_redirects = [
			WPSEO_Redirect_Formats::PLAIN => [],
			WPSEO_Redirect_Formats::REGEX => [],
		];

		foreach ( $redirects as $redirect ) {
			$formatted_redirects[ $redirect->get_format() ][ $redirect->get_origin() ] = $this->format( $redirect );
		}

		/**
		 * Filters the parameter to save the redirect options as autoloaded.
		 *
		 * Note that the `autoload` value in the database will change only if the option value changes (i.e. a redirect is added, edited or deleted).
		 * Otherwise you will need to change the `autoload` value directly in the DB.
		 *
		 * @since 20.13
		 *
		 * @param bool   $autoload            The value of the `autoload` parameter. Default: true.
		 * @param string $type                The type of redirects, either `plain` or `regex`.
		 * @param array  $formatted_redirects The redirects to be written in the options, already formatted.
		 *
		 * @return bool The filtered value of the `autoload` parameter.
		 */
		$autoload_options_plain = apply_filters( 'Yoast\WP\SEO\redirects_options_autoload', true, 'plain', $formatted_redirects );
		$autoload_options_regex = apply_filters( 'Yoast\WP\SEO\redirects_options_autoload', true, 'regex', $formatted_redirects );

		update_option( WPSEO_Redirect_Option::OPTION_PLAIN, $formatted_redirects[ WPSEO_Redirect_Formats::PLAIN ], $autoload_options_plain );
		update_option( WPSEO_Redirect_Option::OPTION_REGEX, $formatted_redirects[ WPSEO_Redirect_Formats::REGEX ], $autoload_options_regex );

		return true;
	}

	/**
	 * Formats a redirect for use in the export.
	 *
	 * @param WPSEO_Redirect $redirect The redirect to format.
	 *
	 * @return array
	 */
	public function format( WPSEO_Redirect $redirect ) {
		return [
			'url'  => $redirect->get_target(),
			'type' => $redirect->get_type(),
		];
	}
}
