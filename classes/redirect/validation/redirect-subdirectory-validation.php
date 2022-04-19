<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Validates if the origin starts with the subdirectory where the WordPress installation is in.
 */
class WPSEO_Redirect_Subdirectory_Validation extends WPSEO_Redirect_Abstract_Validation {

	/**
	 * Validate the redirect to check if the origin already exists.
	 *
	 * @param WPSEO_Redirect      $redirect     The redirect to validate.
	 * @param WPSEO_Redirect|null $old_redirect The old redirect to compare.
	 * @param array|null          $redirects    Array with redirects to validate against.
	 *
	 * @return bool
	 */
	public function run( WPSEO_Redirect $redirect, WPSEO_Redirect $old_redirect = null, array $redirects = null ) {

		$subdirectory = $this->get_subdirectory();

		// When there is no subdirectory, there is nothing to validate.
		if ( $subdirectory === '' ) {
			return true;
		}

		// When the origin starts with subdirectory, it is okay.
		if ( $this->origin_starts_with_subdirectory( $subdirectory, $redirect->get_origin() ) ) {
			return true;
		}

		/* translators: %1$s expands to the subdirectory WordPress is installed. */
		$error = __( 'Your redirect is missing the subdirectory where WordPress is installed in. This will result in a redirect that won\'t work. Make sure the redirect starts with %1$s', 'wordpress-seo-premium' );
		$error = sprintf( $error, '<code>' . $subdirectory . '</code>' );
		$this->set_error( new WPSEO_Validation_Warning( $error, 'origin' ) );

		return false;
	}

	/**
	 * Returns the subdirectory if applicable.
	 *
	 * Calculates the difference between the home and site url. It strips of the site_url from the home_url and returns
	 * the part that remains.
	 *
	 * @return string
	 */
	protected function get_subdirectory() {
		$home_url = untrailingslashit( home_url() );
		$site_url = untrailingslashit( site_url() );
		if ( $home_url === $site_url ) {
			return '';
		}

		// Strips the site_url from the home_url. substr is used because we want it from the start.
		$encoding = get_bloginfo( 'charset' );
		return mb_substr( $home_url, mb_strlen( $site_url, $encoding ), null, $encoding );
	}

	/**
	 * Checks if the origin starts with the given subdirectory. If so, the origin must start with the subdirectory.
	 *
	 * @param string $subdirectory The subdirectory that should be present.
	 * @param string $origin       The origin to check for.
	 *
	 * @return bool
	 */
	protected function origin_starts_with_subdirectory( $subdirectory, $origin ) {
		// Strip slashes at the beginning because the origin doesn't start with a slash.
		$subdirectory = ltrim( $subdirectory, '/' );

		if ( strstr( $origin, $subdirectory ) ) {
			return substr( $origin, 0, strlen( $subdirectory ) ) === $subdirectory;
		}

		return false;
	}
}
