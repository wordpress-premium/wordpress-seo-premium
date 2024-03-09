<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Class WPSEO_Redirect_Ajax.
 */
class WPSEO_Redirect_Ajax {

	/**
	 * Instance of the WPSEO_Redirect_Manager instance.
	 *
	 * @var WPSEO_Redirect_Manager
	 */
	private $redirect_manager;

	/**
	 * Format of the redirect, might be plain or regex.
	 *
	 * @var string
	 */
	private $redirect_format;

	/**
	 * Setting up the object by instantiate the redirect manager and setting the hooks.
	 *
	 * @param string $redirect_format The redirects format.
	 */
	public function __construct( $redirect_format ) {
		$this->redirect_manager = new WPSEO_Redirect_Manager( $redirect_format );
		$this->redirect_format  = $redirect_format;

		$this->set_hooks( $redirect_format );
	}

	/**
	 * Function that handles the AJAX 'wpseo_add_redirect' action.
	 *
	 * @return void
	 */
	public function ajax_add_redirect() {
		$this->valid_ajax_check();

		// Save the redirect.
		$redirect = $this->get_redirect_from_post( 'redirect' );
		$this->validate( $redirect );

		// The method always returns the added redirect.
		if ( $this->redirect_manager->create_redirect( $redirect ) ) {
			$response = [
				'origin' => $redirect->get_origin(),
				'target' => $redirect->get_target(),
				'type'   => $redirect->get_type(),
				'info'   => [
					'hasTrailingSlash' => WPSEO_Redirect_Util::requires_trailing_slash( $redirect->get_target() ),
					'isTargetRelative' => WPSEO_Redirect_Util::is_relative_url( $redirect->get_target() ),
				],
			];
		}
		else {
			// Set the value error.
			$error = [
				'type'    => 'error',
				'message' => __( 'Unknown error. Failed to create redirect.', 'wordpress-seo-premium' ),
			];

			$response = [ 'error' => $error ];
		}

		// Response.
		// phpcs:ignore WordPress.Security.EscapeOutput -- WPCS bug/methods can't be whitelisted yet.
		wp_die( WPSEO_Utils::format_json_encode( $response ) );
	}

	/**
	 * Function that handles the AJAX 'wpseo_update_redirect' action.
	 *
	 * @return void
	 */
	public function ajax_update_redirect() {

		$this->valid_ajax_check();

		$current_redirect = $this->get_redirect_from_post( 'old_redirect' );
		$new_redirect     = $this->get_redirect_from_post( 'new_redirect' );
		$this->validate( $new_redirect, $current_redirect );

		// The method always returns the added redirect.
		if ( $this->redirect_manager->update_redirect( $current_redirect, $new_redirect ) ) {
			$response = [
				'origin' => $new_redirect->get_origin(),
				'target' => $new_redirect->get_target(),
				'type'   => $new_redirect->get_type(),
			];
		}
		else {
			// Set the value error.
			$error = [
				'type'    => 'error',
				'message' => __( 'Unknown error. Failed to update redirect.', 'wordpress-seo-premium' ),
			];

			$response = [ 'error' => $error ];
		}

		// Response.
		// phpcs:ignore WordPress.Security.EscapeOutput -- WPCS bug/methods can't be whitelisted yet.
		wp_die( WPSEO_Utils::format_json_encode( $response ) );
	}

	/**
	 * Run the validation.
	 *
	 * @param WPSEO_Redirect      $redirect         The redirect to save.
	 * @param WPSEO_Redirect|null $current_redirect The current redirect.
	 *
	 * @return void
	 */
	private function validate( WPSEO_Redirect $redirect, ?WPSEO_Redirect $current_redirect = null ) {
		$validator = new WPSEO_Redirect_Validator();

		if ( $validator->validate( $redirect, $current_redirect ) === true ) {
			return;
		}

		$ignore_warning = filter_input( INPUT_POST, 'ignore_warning' );

		$error = $validator->get_error();

		if ( $error->get_type() === 'error' || ( $error->get_type() === 'warning' && $ignore_warning === 'false' ) ) {
			wp_die(
				// phpcs:ignore WordPress.Security.EscapeOutput -- WPCS bug/methods can't be whitelisted yet.
				WPSEO_Utils::format_json_encode( [ 'error' => $error->to_array() ] )
			);
		}
	}

	/**
	 * Setting the AJAX hooks.
	 *
	 * @param string $hook_suffix The piece that will be stitched after the hooknames.
	 *
	 * @return void
	 */
	private function set_hooks( $hook_suffix ) {
		// Add the new redirect.
		add_action( 'wp_ajax_wpseo_add_redirect_' . $hook_suffix, [ $this, 'ajax_add_redirect' ] );

		// Update an existing redirect.
		add_action( 'wp_ajax_wpseo_update_redirect_' . $hook_suffix, [ $this, 'ajax_update_redirect' ] );

		// Add URL response code check AJAX.
		if ( ! has_action( 'wp_ajax_wpseo_check_url' ) ) {
			add_action( 'wp_ajax_wpseo_check_url', [ $this, 'ajax_check_url' ] );
		}
	}

	/**
	 * Check if the posted nonce is valid and if the user has the needed rights.
	 *
	 * @return void
	 */
	private function valid_ajax_check() {
		// Check nonce.
		check_ajax_referer( 'wpseo-redirects-ajax-security', 'ajax_nonce' );

		$this->permission_check();
	}

	/**
	 * Checks whether the current user is allowed to do what he's doing.
	 *
	 * @return void
	 */
	private function permission_check() {
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_die( '0' );
		}
	}

	/**
	 * Get the redirect from the post values.
	 *
	 * @param string $post_value The key where the post values are located in the $_POST.
	 *
	 * @return WPSEO_Redirect
	 */
	private function get_redirect_from_post( $post_value ) {
		// phpcs:ignore WordPress.Security.NonceVerification -- Reason: nonce is verified in ajax_update_redirect and ajax_add_redirect.
		if ( isset( $_POST[ $post_value ] ) && is_array( $_POST[ $post_value ] ) ) {
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized,WordPress.Security.NonceVerification -- Reason: we want to stick to sanitize_url function, while the nonce has been already checked.
			$post_values = wp_unslash( $_POST[ $post_value ] );

			return new WPSEO_Redirect(
				$this->sanitize_url( $post_values['origin'] ),
				$this->sanitize_url( $post_values['target'] ),
				urldecode( $post_values['type'] ),
				$this->redirect_format
			);
		}

		return new WPSEO_Redirect( '', '', '', '' );
	}

	/**
	 * Sanitize the URL for displaying on the window.
	 *
	 * @param string $url The URL to sanitize.
	 *
	 * @return string
	 */
	private function sanitize_url( $url ) {
		return trim( htmlspecialchars_decode( rawurldecode( $url ) ) );
	}
}
