<?php

namespace Yoast\WP\SEO\Premium\Actions;

use RuntimeException;
use WP_User;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Bad_Request_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Forbidden_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Internal_Server_Error_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Not_Found_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Payment_Required_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Request_Timeout_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Service_Unavailable_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Too_Many_Requests_Exception;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Unauthorized_Exception;

/**
 * Handles the actual requests to our API endpoints.
 */
class AI_Generator_Action extends AI_Base_Action {

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

	// phpcs:enable Squiz.Commenting.FunctionCommentThrowTag.WrongNumber
}
