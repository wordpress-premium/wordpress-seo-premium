<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

if ( ! class_exists( 'WP_Text_Diff_Renderer_inline' ) ) {
	require_once ABSPATH . '/wp-includes/wp-diff.php';
}

/**
 * Class HTML_Diff_Renderer.
 * This class is a modified version of Text_Diff_Renderer_inline from WordPress core.
 * The following methods have been modified:
 * - _lines: removed the encoding.
 * - _changed: removed the new line at the end of the diff.
 */
class WPSEO_HTML_Diff_Renderer extends WP_Text_Diff_Renderer_inline {

	// phpcs:disable PSR2.Classes.PropertyDeclaration.Underscore -- we are overriding a class.
	// phpcs:disable PSR2.Methods.MethodDeclaration.Underscore -- we are overriding a class.

	/**
	 * Prefix for inserted text.
	 *
	 * @var string
	 */
	public $_ins_prefix = '<ins class="yst-diff">';

	/**
	 * Prefix for deleted text.
	 *
	 * @var string
	 */
	public $_del_prefix = '<del class="yst-diff">';

	/**
	 * Handles the rendering of lines.
	 * This method has been modified to remove the encoding.
	 *
	 * @param string[] $lines  The lines to render.
	 * @param string   $prefix The prefix (unused).
	 * @param bool     $encode Whether to encode the lines (unused).
	 * @return string The rendered lines.
	 */
	public function _lines( $lines, $prefix = '', $encode = false ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- we are overriding a method.
		return implode( '', $lines );
	}

	/**
	 * Handles the rendering of changed lines.
	 *
	 * @param string[] $orig The original text.
	 * @param string[] $new_ The new text.
	 * @return string The rendered diff.
	 */
	public function _changed( $orig, $new_ ) {
		/* If we've already split on characters, just display. */
		if ( $this->_split_level === 'characters' ) {
			return $this->_deleted( $orig ) . $this->_added( $new_ );
		}

		/* If we've already split on words, just display. */
		if ( $this->_split_level === 'words' ) {
			$prefix = '';
			while ( $orig[0] !== false
				&& $new_[0] !== false
				&& substr( $orig[0], 0, 1 ) === ' '
				&& substr( $new_[0], 0, 1 ) === ' ' ) {
				$prefix .= substr( $orig[0], 0, 1 );
				$orig[0] = substr( $orig[0], 1 );
				$new_[0] = substr( $new_[0], 1 );
			}
			return $prefix . $this->_deleted( $orig ) . $this->_added( $new_ );
		}

		$text1 = implode( "\n", $orig );
		$text2 = implode( "\n", $new_ );

		/* Non-printing newline marker. */
		$nl = "\0";

		if ( $this->_split_characters ) {
			$diff = new Text_Diff(
				'native',
				[
					preg_split( '//', $text1 ),
					preg_split( '//', $text2 ),
				]
			);
		}
		else {
			/*
			 * We want to split on word boundaries, but we need to preserve
			 * whitespace as well. Therefore we split on words, but include
			 * all blocks of whitespace in the wordlist.
			 */
			$diff = new Text_Diff(
				'native',
				[
					$this->_splitOnWords( $text1, $nl ),
					$this->_splitOnWords( $text2, $nl ),
				]
			);
		}

		/* Get the diff in inline format. */
		$renderer = new WPSEO_HTML_Diff_Renderer(
			array_merge(
				$this->getParams(),
				[ 'split_level' => ( $this->_split_characters ) ? 'characters' : 'words' ]
			)
		);

		/* Run the diff and get the output. */
		return str_replace( $nl, "\n", $renderer->render( $diff ) );
	}

	// phpcs:enable PSR2.Classes.PropertyDeclaration.Underscore
	// phpcs:enable PSR2.Methods.MethodDeclaration.Underscore
}
