<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

/**
 * Registers the endpoint to delete the redirect for a Post to WordPress.
 */
class WPSEO_Premium_Redirect_Undo_EndPoint implements WPSEO_WordPress_Integration {

	const REST_NAMESPACE = 'yoast/v1';
	const ENDPOINT_UNDO  = 'redirects/undo-for-object';

	/**
	 * Instance of the WPSEO_Redirect_Manager class.
	 *
	 * @var WPSEO_Redirect_Manager
	 */
	protected $manager;

	/**
	 * Sets the service to handle the request.
	 *
	 * @param WPSEO_Redirect_Manager $manager The manager for working with redirects.
	 */
	public function __construct( WPSEO_Redirect_Manager $manager ) {
		$this->manager = $manager;
	}

	/**
	 * Registers all hooks to WordPress.
	 */
	public function register_hooks() {
		add_action( 'rest_api_init', [ $this, 'register' ] );
	}

	/**
	 * Register the REST endpoint to WordPress.
	 */
	public function register() {
		register_rest_route(
			self::REST_NAMESPACE,
			self::ENDPOINT_UNDO,
			[
				'methods'             => 'POST',
				'args'                => [
					'obj_id' => [
						'required'    => true,
						'type'        => 'int',
						'description' => 'The id of the post or term',
					],
					'obj_type' => [
						'required'    => true,
						'type'        => 'string',
						'description' => 'The object type: post or term',
					],
				],
				'callback'            => [ $this, 'undo_redirect' ],
				'permission_callback' => [ $this, 'can_save_data' ],
			]
		);
	}

	/**
	 * Deletes the latest redirect to the post or term referenced in the request.
	 *
	 * @param WP_REST_Request $request The request.
	 *
	 * @return WP_REST_Response The response.
	 */
	public function undo_redirect( WP_REST_Request $request ) {
		$object_id   = $request->get_param( 'obj_id' );
		$object_type = $request->get_param( 'obj_type' );

		$redirect_info = $this->retrieve_post_or_term_redirect_info( $object_type, $object_id );
		$redirect      = $this->map_redirect_info_to_redirect( $redirect_info );

		if ( ! $redirect->get_origin() ) {
			return new WP_REST_Response(
				[
					'title'   => __( 'Redirect not deleted.', 'wordpress-seo-premium' ),
					'message' => __( 'Something went wrong when deleting this redirect.', 'wordpress-seo-premium' ),
					'success' => false,
				],
				400
			);
		}

		if ( $this->manager->delete_redirects( [ $redirect ] ) ) {
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
	 * Maps the given redirect info to an instance of the WPSEO_Redirect.
	 *
	 * @param array $redirect_info The redirect info array.
	 *
	 * @return WPSEO_Redirect Redirect instance.
	 */
	protected function map_redirect_info_to_redirect( $redirect_info ) {
		$origin = isset( $redirect_info['origin'] ) ? $redirect_info['origin'] : null;
		$target = isset( $redirect_info['target'] ) ? $redirect_info['target'] : null;
		$type   = isset( $redirect_info['type'] ) ? $redirect_info['type'] : null;
		$format = isset( $redirect_info['format'] ) ? $redirect_info['format'] : null;

		return new WPSEO_Redirect( $origin, $target, $type, $format );
	}

	/**
	 * Retrieve the redirect info from the meta for the specified object and id.
	 *
	 * @param string $object_type The type of object: post or term.
	 * @param int    $object_id   The post or term ID.
	 *
	 * @return array
	 */
	private function retrieve_post_or_term_redirect_info( $object_type, $object_id ) {
		if ( $object_type === 'post' ) {
			$redirect_info = get_post_meta( $object_id, '_yoast_post_redirect_info', true );
			delete_post_meta( $object_id, '_yoast_post_redirect_info' );
			return $redirect_info;
		}

		if ( $object_type === 'term' ) {
			$redirect_info = get_term_meta( $object_id, '_yoast_term_redirect_info', true );
			delete_term_meta( $object_id, '_yoast_term_redirect_info' );
			return $redirect_info;
		}

		return [];
	}

	/**
	 * Determines if the current user is allowed to use this endpoint.
	 *
	 * @param WP_REST_Request $request The request.
	 *
	 * @return bool True user is allowed to use this endpoint.
	 */
	public function can_save_data( WP_REST_Request $request ) {
		$object_id   = $request->get_param( 'obj_id' );
		$object_type = $request->get_param( 'obj_type' );

		if ( $object_type === 'post' ) {
			return current_user_can( 'edit_post', $object_id );
		}

		if ( $object_type === 'term' ) {
			return current_user_can( 'edit_term', $object_id );
		}

		return false;
	}
}
