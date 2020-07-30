<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * The service for the redirects to WordPress.
 */
class WPSEO_Premium_Redirect_Service {

	/**
	 * Saves the redirect to the redirects.
	 *
	 * This save function is only used in the deprecated google-search-console integration.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response to send back.
	 */
	public function save( WP_REST_Request $request ) {
		$redirect = $this->map_request_to_redirect( $request );

		if ( $this->get_redirect_manager()->create_redirect( $redirect ) ) {
			return new WP_REST_Response( 'true' );
		}

		return new WP_REST_Response( 'false' );
	}

	/**
	 * Deletes the redirect from the redirects.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_REST_Response The response to send back.
	 */
	public function delete( WP_REST_Request $request ) {
		$redirect  = $this->map_request_to_redirect( $request );
		$redirects = [ $redirect ];

		$redirect_format = $request->get_param( 'format' );
		if ( ! $redirect_format ) {
			$redirect_format = WPSEO_Redirect_Formats::PLAIN;
		}

		if ( $this->get_redirect_manager( $redirect_format )->delete_redirects( $redirects ) ) {
			return new WP_REST_Response(
				[
					'title'   => __( 'Redirect deleted.', 'wordpress-seo-premium' ),
					'message' => __( 'The redirect was deleted successfully.', 'wordpress-seo-premium' ),
					'success' => true,
				]
			);
		}

		return new WP_REST_Response(
			[
				'title'   => __( 'Redirect not deleted.', 'wordpress-seo-premium' ),
				'message' => __( 'Something went wrong when deleting this redirect.', 'wordpress-seo-premium' ),
				'success' => false,
			],
			400
		);
	}

	/**
	 * Creates and returns an instance of the redirect manager.
	 *
	 * @param string $format The redirect format.
	 *
	 * @return WPSEO_Redirect_Manager The redirect maanger.
	 */
	protected function get_redirect_manager( $format = WPSEO_Redirect_Formats::PLAIN ) {
		return new WPSEO_Redirect_Manager( $format );
	}

	/**
	 * Maps the given request to an instance of the WPSEO_Redirect.
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WPSEO_Redirect Redirect instance.
	 */
	protected function map_request_to_redirect( WP_REST_Request $request ) {
		$origin = $request->get_param( 'origin' );
		$target = $request->get_param( 'target' );
		$type   = $request->get_param( 'type' );
		$format = $request->get_param( 'format' );

		return new WPSEO_Redirect( $origin, $target, $type, $format );
	}
}
