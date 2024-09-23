<?php

namespace Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain;

/**
 * Interface representing a suggestion domain object.
 */
interface Suggestion_Interface {

	/**
	 * Gets the suggestion content.
	 *
	 * @return string
	 */
	public function get_content(): string;

	/**
	 * Sets the suggestion string.
	 *
	 * @param string $content The suggestion content.
	 *
	 * @return void
	 */
	public function set_content( string $content ): void;
}
