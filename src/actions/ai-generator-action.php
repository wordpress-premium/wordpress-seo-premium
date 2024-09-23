<?php

namespace Yoast\WP\SEO\Premium\Actions;

use RuntimeException;
use WP_User;
use WPSEO_Addon_Manager;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Bad_Request_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Forbidden_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Internal_Server_Error_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Not_Found_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Payment_Required_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Request_Timeout_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Service_Unavailable_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Too_Many_Requests_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Unauthorized_Exception;
use Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper;

/**
 * Handles the actual requests to our API endpoints.
 */
class AI_Generator_Action {

	/**
	 * The AI_Generator helper.
	 *
	 * @var AI_Generator_Helper
	 */
	protected $ai_generator_helper;

	/**
	 * The Options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

	/**
	 * The User helper.
	 *
	 * @var User_Helper
	 */
	protected $user_helper;

	/**
	 * The add-on manager.
	 *
	 * @var WPSEO_Addon_Manager
	 */
	private $addon_manager;

	/**
	 * AI_Generator_Action constructor.
	 *
	 * @param AI_Generator_Helper $ai_generator_helper The AI_Generator helper.
	 * @param Options_Helper      $options_helper      The Options helper.
	 * @param User_Helper         $user_helper         The User helper.
	 * @param WPSEO_Addon_Manager $addon_manager       The add-on manager.
	 */
	public function __construct(
		AI_Generator_Helper $ai_generator_helper,
		Options_Helper $options_helper,
		User_Helper $user_helper,
		WPSEO_Addon_Manager $addon_manager
	) {
		$this->ai_generator_helper = $ai_generator_helper;
		$this->options_helper      = $options_helper;
		$this->user_helper         = $user_helper;
		$this->addon_manager       = $addon_manager;
	}

	/**
	 * Requests a new set of JWT tokens.
	 *
	 * Requests a new JWT access and refresh token for a user from the Yoast AI Service and stores it in the database
	 * under usermeta. The storing of the token happens in a HTTP callback that is triggered by this request.
	 *
	 * @param WP_User $user The WP user.
	 *
	 * @return void
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Forbidden_Exception Forbidden_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 */
	public function token_request( WP_User $user ): void {
		// Ensure the user has given consent.
		if ( $this->user_helper->get_meta( $user->ID, '_yoast_wpseo_ai_consent', true ) !== '1' ) {
			// phpcs:disable WordPress.Security.EscapeOutput.ExceptionNotEscaped -- false positive.
			throw $this->handle_consent_revoked( $user->ID );
			// phpcs:enable WordPress.Security.EscapeOutput.ExceptionNotEscaped
		}

		// Generate a verification code and store it in the database.
		$code_verifier = $this->ai_generator_helper->generate_code_verifier( $user );
		$this->ai_generator_helper->set_code_verifier( $user->ID, $code_verifier );

		$request_body = [
			'service'              => 'openai',
			'code_challenge'       => \hash( 'sha256', $code_verifier ),
			'license_site_url'     => $this->ai_generator_helper->get_license_url(),
			'user_id'              => (string) $user->ID,
			'callback_url'         => $this->ai_generator_helper->get_callback_url(),
			'refresh_callback_url' => $this->ai_generator_helper->get_refresh_callback_url(),
		];

		$this->ai_generator_helper->request( '/token/request', $request_body );

		// The callback saves the metadata. Because that is in another session, we need to delete the current cache here. Or we may get the old token.
		\wp_cache_delete( $user->ID, 'user_meta' );
	}

	/**
	 * Refreshes the JWT access token.
	 *
	 * Refreshes a stored JWT access token for a user with the Yoast AI Service and stores it in the database under
	 * usermeta. The storing of the token happens in a HTTP callback that is triggered by this request.
	 *
	 * @param WP_User $user The WP user.
	 *
	 * @return void
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Forbidden_Exception Forbidden_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 * @throws RuntimeException Unable to retrieve the refresh token.
	 */
	public function token_refresh( WP_User $user ): void {
		$refresh_jwt = $this->ai_generator_helper->get_refresh_token( $user->ID );

		// Generate a verification code and store it in the database.
		$code_verifier = $this->ai_generator_helper->generate_code_verifier( $user );
		$this->ai_generator_helper->set_code_verifier( $user->ID, $code_verifier );

		$request_body    = [
			'code_challenge' => \hash( 'sha256', $code_verifier ),
		];
		$request_headers = [
			'Authorization' => "Bearer $refresh_jwt",
		];

		$this->ai_generator_helper->request( '/token/refresh', $request_body, $request_headers );

		// The callback saves the metadata. Because that is in another session, we need to delete the current cache here. Or we may get the old token.
		\wp_cache_delete( $user->ID, 'user_meta' );
	}

	/**
	 * Callback function that will be invoked by our API.
	 *
	 * @param string $access_jwt     The access JWT.
	 * @param string $refresh_jwt    The refresh JWT.
	 * @param string $code_challenge The verification code.
	 * @param int    $user_id        The user ID.
	 *
	 * @return string The code verifier.
	 *
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 */
	public function callback(
		string $access_jwt,
		string $refresh_jwt,
		string $code_challenge,
		int $user_id
	): string {
		try {
			$code_verifier = $this->ai_generator_helper->get_code_verifier( $user_id );
		} catch ( RuntimeException $exception ) {
			throw new Unauthorized_Exception( 'Unauthorized' );
		}

		if ( $code_challenge !== \hash( 'sha256', $code_verifier ) ) {
			throw new Unauthorized_Exception( 'Unauthorized' );
		}
		$this->user_helper->update_meta( $user_id, '_yoast_wpseo_ai_generator_access_jwt', $access_jwt );
		$this->user_helper->update_meta( $user_id, '_yoast_wpseo_ai_generator_refresh_jwt', $refresh_jwt );
		$this->ai_generator_helper->delete_code_verifier( $user_id );

		return $code_verifier;
	}

	// phpcs:disable Squiz.Commenting.FunctionCommentThrowTag.WrongNumber -- PHPCS doesn't take into account exceptions thrown in called methods.

	/**
	 * Action used to generate suggestions through AI.
	 *
	 * @param WP_User $user                  The WP user.
	 * @param string  $suggestion_type       The type of the requested suggestion.
	 * @param string  $prompt_content        The excerpt taken from the post.
	 * @param string  $focus_keyphrase       The focus keyphrase associated to the post.
	 * @param string  $language              The language of the post.
	 * @param string  $platform              The platform the post is intended for.
	 * @param bool    $retry_on_unauthorized Whether to retry when unauthorized (mechanism to retry once).
	 *
	 * @return string[] The suggestions.
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Forbidden_Exception Forbidden_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 * @throws RuntimeException Unable to retrieve the access token.
	 */
	public function get_suggestions(
		WP_User $user,
		string $suggestion_type,
		string $prompt_content,
		string $focus_keyphrase,
		string $language,
		string $platform,
		bool $retry_on_unauthorized = true
	): array {
		$token = $this->get_or_request_access_token( $user );

		$request_body    = [
			'service' => 'openai',
			'user_id' => (string) $user->ID,
			'subject' => [
				'content'         => $prompt_content,
				'focus_keyphrase' => $focus_keyphrase,
				'language'        => $language,
				'platform'        => $platform,
			],
		];
		$request_headers = [
			'Authorization' => "Bearer $token",
		];

		try {
			$response = $this->ai_generator_helper->request( "/openai/suggestions/$suggestion_type", $request_body, $request_headers );
		} catch ( Unauthorized_Exception $exception ) {
			// Delete the stored JWT tokens, as they appear to be no longer valid.
			$this->user_helper->delete_meta( $user->ID, '_yoast_wpseo_ai_generator_access_jwt' );
			$this->user_helper->delete_meta( $user->ID, '_yoast_wpseo_ai_generator_refresh_jwt' );

			if ( ! $retry_on_unauthorized ) {
				throw $exception;
			}

			// Try again once more by fetching a new set of tokens and trying the suggestions endpoint again.
			return $this->get_suggestions( $user, $suggestion_type, $prompt_content, $focus_keyphrase, $language, $platform, false );
		} catch ( Forbidden_Exception $exception ) {
			// Follow the API in the consent being revoked (Use case: user sent an e-mail to revoke?).
			// phpcs:disable WordPress.Security.EscapeOutput.ExceptionNotEscaped -- false positive.
			throw $this->handle_consent_revoked( $user->ID, $exception->getCode() );
			// phpcs:enable WordPress.Security.EscapeOutput.ExceptionNotEscaped
		}

		return $this->ai_generator_helper->build_suggestions_array( $response );
	}

	/**
	 * Action used to generate improved copy through AI, that scores better on our content analysis' assessments.
	 *
	 * @param WP_User $user                  The WP user.
	 * @param string  $assessment            The assessment to improve.
	 * @param string  $prompt_content        The excerpt taken from the post.
	 * @param string  $focus_keyphrase       The focus keyphrase associated to the post.
	 * @param string  $synonyms              Synonyms for the focus keyphrase.
	 * @param string  $language              The language of the post.
	 * @param bool    $retry_on_unauthorized Whether to retry when unauthorized (mechanism to retry once).
	 *
	 * @return string The AI-generated content.
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Forbidden_Exception Forbidden_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 * @throws RuntimeException Unable to retrieve the access token.
	 */
	public function fix_assessments(
		WP_User $user,
		string $assessment,
		string $prompt_content,
		string $focus_keyphrase,
		string $synonyms,
		string $language,
		bool $retry_on_unauthorized = true
	): string {
		$token = $this->get_or_request_access_token( $user );

		// We are not sending the synonyms for now, as these are not used in the current prompts.
		$request_body    = [
			'service' => 'openai',
			'user_id' => (string) $user->ID,
			'subject' => [
				'content'         => $prompt_content,
				'focus_keyphrase' => $focus_keyphrase,
				'language'        => $language,
			],
		];
		$request_headers = [
			'Authorization' => "Bearer $token",
		];

		try {
			$response = $this->ai_generator_helper->request( "/fix/assessments/seo-$assessment", $request_body, $request_headers );
		} catch ( Unauthorized_Exception $exception ) {
			// Delete the stored JWT tokens, as they appear to be no longer valid.
			$this->user_helper->delete_meta( $user->ID, '_yoast_wpseo_ai_generator_access_jwt' );
			$this->user_helper->delete_meta( $user->ID, '_yoast_wpseo_ai_generator_refresh_jwt' );

			if ( ! $retry_on_unauthorized ) {
				throw $exception;
			}

			// Try again once more by fetching a new set of tokens and trying the suggestions endpoint again.
			return $this->fix_assessments( $user, $assessment, $prompt_content, $focus_keyphrase, $synonyms, $language, false );
		} catch ( Forbidden_Exception $exception ) {
			// Follow the API in the consent being revoked (Use case: user sent an e-mail to revoke?).
			// phpcs:disable WordPress.Security.EscapeOutput.ExceptionNotEscaped -- false positive.
			throw $this->handle_consent_revoked( $user->ID, $exception->getCode() );
			// phpcs:enable WordPress.Security.EscapeOutput.ExceptionNotEscaped
		}

		return $this->ai_generator_helper->build_fixes_response( $prompt_content, $response );
	}

	// phpcs:enable Squiz.Commenting.FunctionCommentThrowTag.WrongNumber

	/**
	 * Stores the consent given or revoked by the user.
	 *
	 * @param int  $user_id The user ID.
	 * @param bool $consent Whether the consent has been given.
	 *
	 * @return void
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws RuntimeException Unable to retrieve the access token.
	 */
	public function consent( int $user_id, bool $consent ): void {
		if ( $consent ) {
			// Store the consent at user level.
			$this->user_helper->update_meta( $user_id, '_yoast_wpseo_ai_consent', true );
		}
		else {
			$this->token_invalidate( $user_id );

			// Delete the consent at user level.
			$this->user_helper->delete_meta( $user_id, '_yoast_wpseo_ai_consent' );
		}
	}

	/**
	 * Busts the subscription cache.
	 *
	 * @return void
	 */
	public function bust_subscription_cache(): void {
		$this->addon_manager->remove_site_information_transients();
	}

	/**
	 * Retrieves the access token.
	 *
	 * @param WP_User $user The WP user.
	 *
	 * @return string The access token.
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Forbidden_Exception Forbidden_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 * @throws RuntimeException Unable to retrieve the access or refresh token.
	 */
	private function get_or_request_access_token( WP_User $user ): string {
		$access_jwt = $this->user_helper->get_meta( $user->ID, '_yoast_wpseo_ai_generator_access_jwt', true );
		if ( ! \is_string( $access_jwt ) || $access_jwt === '' ) {
			$this->token_request( $user );
			$access_jwt = $this->ai_generator_helper->get_access_token( $user->ID );
		}
		elseif ( $this->ai_generator_helper->has_token_expired( $access_jwt ) ) {
			try {
				$this->token_refresh( $user );
			} catch ( Unauthorized_Exception $exception ) {
				$this->token_request( $user );
			} catch ( Forbidden_Exception $exception ) {
				// Follow the API in the consent being revoked (Use case: user sent an e-mail to revoke?).
				// phpcs:disable WordPress.Security.EscapeOutput.ExceptionNotEscaped -- false positive.
				throw $this->handle_consent_revoked( $user->ID, $exception->getCode() );
				// phpcs:enable WordPress.Security.EscapeOutput.ExceptionNotEscaped
			}
			$access_jwt = $this->ai_generator_helper->get_access_token( $user->ID );
		}

		return $access_jwt;
	}

	/**
	 * Invalidates the access token.
	 *
	 * @param string $user_id The user ID.
	 *
	 * @return void
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws RuntimeException Unable to retrieve the access token.
	 */
	private function token_invalidate( string $user_id ): void {
		try {
			$access_jwt = $this->ai_generator_helper->get_access_token( $user_id );
		} catch ( RuntimeException $e ) {
			$access_jwt = '';
		}

		$request_body    = [
			'user_id' => (string) $user_id,
		];
		$request_headers = [
			'Authorization' => "Bearer $access_jwt",
		];

		try {
			$this->ai_generator_helper->request( '/token/invalidate', $request_body, $request_headers );
		} catch ( Unauthorized_Exception | Forbidden_Exception $e ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch -- Reason: Ignored on purpose.
			// We do nothing in this case, we trust nonce verification and try to remove the user data anyway.
			// I.e. we fallthrough to the same logic as if we got a 200 OK.
		}

		// Delete the stored JWT tokens.
		$this->user_helper->delete_meta( $user_id, '_yoast_wpseo_ai_generator_access_jwt' );
		$this->user_helper->delete_meta( $user_id, '_yoast_wpseo_ai_generator_refresh_jwt' );
	}

	/**
	 * Action used to retrieve how much usage of the AI API has the current user had so far this month.
	 *
	 * @param WP_User $user The WP user.
	 *
	 * @return object<string, object<string>> The AI-generated content.
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 * @throws Forbidden_Exception Forbidden_Exception.
	 * @throws Internal_Server_Error_Exception Internal_Server_Error_Exception.
	 * @throws Not_Found_Exception Not_Found_Exception.
	 * @throws Payment_Required_Exception Payment_Required_Exception.
	 * @throws Request_Timeout_Exception Request_Timeout_Exception.
	 * @throws Service_Unavailable_Exception Service_Unavailable_Exception.
	 * @throws Too_Many_Requests_Exception Too_Many_Requests_Exception.
	 * @throws Unauthorized_Exception Unauthorized_Exception.
	 * @throws RuntimeException Unable to retrieve the access token.
	 */
	public function get_usage(
		WP_User $user
	) {
		$token           = $this->get_or_request_access_token( $user );
		$request_headers = [
			'Authorization' => "Bearer $token",
		];

		$response = $this->ai_generator_helper->request( '/usage/' . \gmdate( 'Y-m' ), [], $request_headers, false );
		$json     = \json_decode( $response->body );

		return $json;
	}

	/**
	 * Handles consent revoked.
	 *
	 * By deleting the consent user metadata from the database.
	 * And then throwing a Forbidden_Exception.
	 *
	 * @param int $user_id     The user ID.
	 * @param int $status_code The status code. Defaults to 403.
	 *
	 * @return Forbidden_Exception The Forbidden_Exception.
	 */
	private function handle_consent_revoked( int $user_id, int $status_code = 403 ): Forbidden_Exception {
		$this->user_helper->delete_meta( $user_id, '_yoast_wpseo_ai_consent' );

		return new Forbidden_Exception( 'CONSENT_REVOKED', $status_code );
	}
}
