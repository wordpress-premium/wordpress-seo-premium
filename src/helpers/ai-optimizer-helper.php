<?php

namespace Yoast\WP\SEO\Premium\Helpers;

use Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Unifier;
use Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Suggestion_Processor;
use Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain\Suggestion;
use Yoast\WP\SEO\Premium\Exceptions\Remote_Request\Bad_Request_Exception;

/**
 * Class AI_Optimizer_Helper
 *
 * @package Yoast\WP\SEO\Helpers
 */
class AI_Optimizer_Helper {

	/**
	 * The AI suggestion helper.
	 *
	 * @var AI_Suggestions_Unifier
	 */
	private $ai_suggestions_unifier;

	/**
	 * The suggestion processor.
	 *
	 * @var Suggestion_Processor
	 */
	private $suggestion_processor;

	/**
	 * AI_Optimizer_Helper constructor.
	 *
	 * @param AI_Suggestions_Unifier $ai_suggestions_unifier The AI suggestion unifier.
	 * @param Suggestion_Processor   $suggestion_processor   The suggestion processor.
	 */
	public function __construct(
		AI_Suggestions_Unifier $ai_suggestions_unifier,
		Suggestion_Processor $suggestion_processor
	) {
		$this->ai_suggestions_unifier = $ai_suggestions_unifier;
		$this->suggestion_processor   = $suggestion_processor;
	}

	/**
	 * Builds a response for the AI Optimize route by comparing the response to the input.
	 * We output the diff as an HTML string and will parse this string on the JavaScript side.
	 * The differences are marked with `<ins>` and `<del>` tags.
	 *
	 * @param string $assessment The assessment to improve.
	 * @param string $original   The original text.
	 * @param object $response   The response from the API.
	 *
	 * @return string The HTML containing the suggested content.
	 *
	 * @throws Bad_Request_Exception Bad_Request_Exception.
	 */
	public function build_optimize_response( string $assessment, string $original, object $response ): string {
		$raw_fixes = $this->suggestion_processor->get_suggestion_from_ai_response( $response->body );
		if ( $raw_fixes === '' ) {
			return '';
		}

		$diff = $this->suggestion_processor->calculate_diff( $original, $raw_fixes );

		// For the paragraph length assessment, we need to replace any introduced paragraph breaks with a special class.
		if ( $assessment === 'read-paragraph-length' ) {
			$diff = $this->suggestion_processor->mark_new_paragraphs_in_suggestions( $diff );
		}

		$diff = $this->suggestion_processor->remove_html_from_suggestion( $diff );

		$diff = $this->suggestion_processor->keep_nbsp_in_suggestions( $diff );

		// If we end up with no suggestions, we have to show an error to the user.
		if ( \preg_match( '/<(ins|del) class="yst-/', $diff ) === false ) {
			throw new Bad_Request_Exception();
		}
		$suggestion = new Suggestion();
		$suggestion->set_content( $diff );
		return $this->ai_suggestions_unifier->unify_diffs( $suggestion );
	}
}
