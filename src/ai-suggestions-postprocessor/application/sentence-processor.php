<?php

namespace Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application;

/**
 * Sentence_Processor class
 */
class Sentence_Processor {
	private const DIFF_THRESHOLD = 5;
	public const INS_PLACEHOLDER = 'ins-yst-tag';
	public const DEL_PLACEHOLDER = 'del-yst-tag';

	/**
	 * Open a tag
	 *
	 * @param string $tag The tag to open.
	 *
	 * @return string The opened tag
	 */
	public static function open( string $tag ): string {
		return "[$tag]";
	}

	/**
	 * Close a tag
	 *
	 * @param string $tag The tag to close.
	 *
	 * @return string The closed tag
	 */
	public static function close( string $tag ): string {
		return "[/$tag]";
	}

	/**
	 * Get all the position of a tag in a text
	 *
	 * @param string $tag  The tag to search for.
	 * @param string $text The text to search in.
	 *
	 * @return array<int> The positions of the tag in the text.
	 */
	public function get_tag_positions( string $tag, string $text ): array {
		$positions = [];
		$position  = 0;

		while ( ( $position = \strpos( $text, $tag, $position ) ) !== false ) {
			$positions[] = $position;
			$position    = ( $position + \strlen( $tag ) );
		}

		return $positions;
	}

	/**
	 * Ensure a tag is properly open and closed in a text
	 *
	 * @param string $tag         The tag to check.
	 * @param string $text        The text containing the tag.
	 * @param bool   $is_tag_open Whether the ins tag is still open from previous sentence.
	 *
	 * @return bool Whether the tag is still open after the processing
	 */
	public function ensure_well_formedness_for_tag( string $tag, string &$text, bool $is_tag_open = false ): bool {
		$number_of_open_tags  = \substr_count( $text, self::open( $tag ) );
		$number_of_close_tags = \substr_count( $text, self::close( $tag ) );

		if ( $number_of_open_tags === 0 && $number_of_close_tags === 0 ) {
			if ( $is_tag_open ) {
				$text = self::open( $tag ) . $text . self::close( $tag );
			}
			return $is_tag_open;
		}

		if ( $number_of_open_tags > $number_of_close_tags ) {
			$text = $text . self::close( $tag );
			return true;
		}

		if ( $number_of_open_tags < $number_of_close_tags ) {
			$text = self::open( $tag ) . $text;
			return false;
		}

		$open_tag_positions  = $this->get_tag_positions( self::open( $tag ), $text );
		$close_tag_positions = $this->get_tag_positions( self::close( $tag ), $text );

		if ( \end( $open_tag_positions ) > \end( $close_tag_positions ) ) {
			$text = self::open( $tag ) . $text . self::close( $tag );
			return true;
		}
		return false;
	}

	/**
	 * Check if the suggestion preview should be switched to sentence based
	 *
	 * @param string $sentence The sentence to check.
	 *
	 * @return bool Whether the suggestion should be switched to sentence based
	 */
	public function should_switch_to_sentence_based( string $sentence ): bool {
		if ( ( \count( $this->get_tag_positions( self::open( self::INS_PLACEHOLDER ), $sentence ) ) +
				\count( $this->get_tag_positions( self::open( self::DEL_PLACEHOLDER ), $sentence ) ) ) < self::DIFF_THRESHOLD ) {
			return false;
		}
		return true;
	}

	/**
	 * Check if the last sentence in the array is a diff tag
	 * If it is, append it to the previous sentence
	 *
	 * @param array<string> $sentences The sentences to check.
	 *
	 * @return void
	 */
	public function check_last_sentence( array &$sentences ): void {
		$last_sentence = \end( $sentences );
		if ( \trim( $last_sentence ) === self::close( self::INS_PLACEHOLDER ) || \trim( $last_sentence ) === self::close( self::DEL_PLACEHOLDER ) ) {
			\array_pop( $sentences );
			\end( $sentences );
			$last_sentence_in_array  = &$sentences[ \key( $sentences ) ];
			$last_sentence_in_array .= $last_sentence;
		}
	}

	/**
	 * Apply fixes to a sentence
	 *
	 * @param string $sentence The sentence to apply the fixes to.
	 *
	 * @return string The sentence with the fixes applied
	 */
	public function apply_fixes( string $sentence ): string {
		$pattern        = \sprintf( '/\[%s\].*?\[\/%s\]/', self::DEL_PLACEHOLDER, self::DEL_PLACEHOLDER );
		$remove_applied = \preg_replace( $pattern, '', $sentence );
		return \str_replace( [ self::open( self::INS_PLACEHOLDER ), self::close( self::INS_PLACEHOLDER ) ], '', $remove_applied );
	}

	/**
	 * Dismiss fixes from a sentence
	 *
	 * @param string $sentence The sentence to dismiss the fixes from.
	 *
	 * @return string The sentence with the fixes dismissed
	 */
	public function dismiss_fixes( string $sentence ): string {
		$pattern          = \sprintf( '/\[%s\].*?\[\/%s\]/', self::INS_PLACEHOLDER, self::INS_PLACEHOLDER );
		$remove_dismissed = \str_replace( [ self::open( self::DEL_PLACEHOLDER ), self::close( self::DEL_PLACEHOLDER ) ], '', $sentence );
		return \preg_replace( $pattern, '', $remove_dismissed );
	}
}
