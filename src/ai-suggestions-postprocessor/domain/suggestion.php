<?php

namespace Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain;

/**
 * Class implementing the Suggestion_Interface.
 */
class Suggestion implements Suggestion_Interface {

	/**
	 * The suggestion.
	 *
	 * @var string
	 */
	private $content;

	/**
	 * Gets the suggestion content.
	 *
	 * @return string
	 */
	public function get_content(): string {
		return $this->content;
	}

	/**
	 * Sets the suggestion string.
	 *
	 * @param string $content The suggestion content.
	 *
	 * @return void
	 */
	public function set_content( string $content ): void {
		$this->content = $content;
	}
}
