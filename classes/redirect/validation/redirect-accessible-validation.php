<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirect\Validation
 */

/**
 * Validates the accessibility of a redirect's target.
 */
class WPSEO_Redirect_Accessible_Validation extends WPSEO_Redirect_Abstract_Validation {

	/**
	 * Validates if the target is accessible and based on its response code it will set a warning (if applicable).
	 *
	 * @param WPSEO_Redirect      $redirect     The redirect to validate.
	 * @param WPSEO_Redirect|null $old_redirect The old redirect to compare.
	 * @param array|null          $redirects    Unused.
	 *
	 * @return bool Whether or not the target is valid.
	 */
	public function run( WPSEO_Redirect $redirect, ?WPSEO_Redirect $old_redirect = null, ?array $redirects = null ) {
		// Do the request.
		$target      = $this->parse_target( $redirect->get_target() );
		$decoded_url = rawurldecode( $target );
		$response    = $this->remote_head( $decoded_url, [ 'sslverify' => false ] );

		if ( is_wp_error( $response ) ) {
			$error = __( 'The URL you entered could not be resolved.', 'wordpress-seo-premium' );
			$this->set_error( new WPSEO_Validation_Warning( $error, 'target' ) );

			return false;
		}

		$response_code = $this->retrieve_response_code( $response );

		// Check if the target is a temporary location.
		if ( $this->is_temporary( $response_code ) ) {
			/* translators: %1$s expands to the returned http code  */
			$error = __( 'The URL you are redirecting to seems to return a %1$s status. You might want to check if the target can be reached manually before saving.', 'wordpress-seo-premium' );
			$error = sprintf( $error, $response_code );
			$this->set_error( new WPSEO_Validation_Warning( $error, 'target' ) );

			return false;
		}

		// Check if the response code is 301.
		if ( $response_code === 301 ) {
			$error = __( 'You\'re redirecting to a target that returns a 301 HTTP code (permanently moved). Make sure the target you specify is directly reachable.', 'wordpress-seo-premium' );
			$this->set_error( new WPSEO_Validation_Warning( $error, 'target' ) );

			return false;
		}

		if ( $response_code !== 200 ) {
			/* translators: %1$s expands to the returned http code  */
			$error = __( 'The URL you entered returned a HTTP code different than 200(OK). The received HTTP code is %1$s.', 'wordpress-seo-premium' );
			$error = sprintf( $error, $response_code );
			$this->set_error( new WPSEO_Validation_Warning( $error, 'target' ) );

			return false;
		}

		return true;
	}

	/**
	 * Retrieves the response code from the response array.
	 *
	 * @param array $response The response.
	 *
	 * @return int The response code.
	 */
	protected function retrieve_response_code( $response ) {
		return wp_remote_retrieve_response_code( $response );
	}

	/**
	 * Sends a HEAD request to the passed remote URL.
	 *
	 * @param string $url     The URL to send the request to.
	 * @param array  $options The options to send along with the request.
	 *
	 * @return array|WP_Error The response or WP_Error if something goes wrong.
	 */
	protected function remote_head( $url, $options = [] ) {
		return wp_remote_head( $url, $options );
	}

	/**
	 * Check if the given response code is a temporary one.
	 *
	 * @param int $response_code The response code to check.
	 *
	 * @return bool
	 */
	protected function is_temporary( $response_code ) {
		return in_array( $response_code, [ 302, 307 ], true ) || in_array( substr( $response_code, 0, 2 ), [ '40', '50' ], true );
	}

	/**
	 * Check if the target is relative, if so just parse a full URL.
	 *
	 * @param string $target The target to parse.
	 *
	 * @return string
	 */
	protected function parse_target( $target ) {
		$scheme = wp_parse_url( $target, PHP_URL_SCHEME );

		// If we have an absolute url return it.
		if ( ! empty( $scheme ) ) {
			return $target;
		}

		// Removes the installation directory if present.
		$target = WPSEO_Redirect_Util::strip_base_url_path_from_url( $this->get_home_url(), $target );

		// If we have a relative url make it absolute.
		$absolute = get_home_url( null, $target );

		// If the path does not end with an extension then add a trailing slash.
		if ( WPSEO_Redirect_Util::requires_trailing_slash( $target ) ) {
			return trailingslashit( $absolute );
		}

		return $absolute;
	}

	/**
	 * Returns the home url.
	 *
	 * @return string The home url.
	 */
	protected function get_home_url() {
		return home_url();
	}
}
