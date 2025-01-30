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
use Yoast\WP\SEO\Premium\Helpers\AI_Optimizer_Helper;

/**
 * Handles the actual requests to our API endpoints.
 */
class AI_Optimizer_Action extends AI_Base_Action {

	/**
	 * The AI suggestion helper.
	 *
	 * @var AI_Optimizer_Helper
	 */
	private $ai_optimizer_helper;

	/**
	 * AI_Generator_Action constructor.
	 *
	 * @param AI_Generator_Helper $ai_generator_helper The AI_Generator helper.
	 * @param Options_Helper      $options_helper      The Options helper.
	 * @param User_Helper         $user_helper         The User helper.
	 * @param WPSEO_Addon_Manager $addon_manager       The add-on manager.
	 * @param AI_Optimizer_Helper $ai_optimizer_helper The AI optimizer helper.
	 */
	public function __construct(
		AI_Generator_Helper $ai_generator_helper,
		Options_Helper $options_helper,
		User_Helper $user_helper,
		WPSEO_Addon_Manager $addon_manager,
		AI_Optimizer_Helper $ai_optimizer_helper
	) {
		parent::__construct( $ai_generator_helper, $options_helper, $user_helper, $addon_manager );

		$this->ai_optimizer_helper = $ai_optimizer_helper;
	}

	// phpcs:disable Squiz.Commenting.FunctionCommentThrowTag.WrongNumber -- PHPCS doesn't take into account exceptions thrown in called methods.

	/**
	 * Action used to generate improved copy through AI, that scores better on our content analysis' assessments.
	 *
	 * @param WP_User $user                  The WP user.
	 * @param string  $assessment            The assessment to improve.
	 * @param string  $language              The language of the post.
	 * @param string  $prompt_content        The excerpt taken from the post.
	 * @param string  $focus_keyphrase       The focus keyphrase associated to the post.
	 * @param string  $synonyms              Synonyms for the focus keyphrase.
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
	public function optimize(
		WP_User $user,
		string $assessment,
		string $language,
		string $prompt_content,
		string $focus_keyphrase,
		string $synonyms,
		bool $retry_on_unauthorized = true
	): string {
		$token = $this->get_or_request_access_token( $user );

		$subject = [
			'language'        => $language,
			'content'         => $prompt_content,
		];
		// We are not sending the synonyms for now, as these are not used in the current prompts.
		if ( $focus_keyphrase !== '' ) {
			$subject['focus_keyphrase'] = $focus_keyphrase;
		}

		$request_body    = [
			'service' => 'openai',
			'user_id' => (string) $user->ID,
			'subject' => $subject,
		];
		$request_headers = [
			'Authorization' => "Bearer $token",
		];

		try {
			$response = $this->ai_generator_helper->request( "/fix/assessments/$assessment", $request_body, $request_headers );
		} catch ( Unauthorized_Exception $exception ) {
			// Delete the stored JWT tokens, as they appear to be no longer valid.
			$this->user_helper->delete_meta( $user->ID, '_yoast_wpseo_ai_generator_access_jwt' );
			$this->user_helper->delete_meta( $user->ID, '_yoast_wpseo_ai_generator_refresh_jwt' );

			if ( ! $retry_on_unauthorized ) {
				throw $exception;
			}

			// Try again once more by fetching a new set of tokens and trying the suggestions endpoint again.
			return $this->optimize( $user, $assessment, $language, $prompt_content, $focus_keyphrase, $synonyms, false );
		} catch ( Forbidden_Exception $exception ) {
			// Follow the API in the consent being revoked (Use case: user sent an e-mail to revoke?).
			// phpcs:disable WordPress.Security.EscapeOutput.ExceptionNotEscaped -- false positive.
			throw $this->handle_consent_revoked( $user->ID, $exception->getCode() );
			// phpcs:enable WordPress.Security.EscapeOutput.ExceptionNotEscaped
		}

		return $this->ai_optimizer_helper->build_optimize_response( $assessment, $prompt_content, $response );
	}

	// phpcs:enable Squiz.Commenting.FunctionCommentThrowTag.WrongNumber
}
