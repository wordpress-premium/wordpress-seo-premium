<?php

namespace Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application;

use DOMDocument;
use DOMNode;
use DOMNodeList;
use DOMXPath;
use Text_Diff;
use WPSEO_HTML_Diff_Renderer;
use Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser;
use Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor;

/**
 * Class implementing the processing elements used on the AI suggestions.
 */
class Suggestion_Processor {
	// Class name for the diff elements.
	public const YST_DIFF_CLASS = 'yst-diff';

	/**
	 * The DOM Parser.
	 *
	 * @var DOM_Parser
	 */
	private $parser;

	/**
	 * The suggestion processor.
	 *
	 * @var Node_Processor
	 */
	protected $node_processor;

	/**
	 * The suggestion serializer.
	 *
	 * @var AI_Suggestions_Serializer
	 */
	protected $serializer;

	/**
	 * Constructor
	 *
	 * @param DOM_Parser                $parser         The DOM parser.
	 * @param Node_Processor            $node_processor The node processor.
	 * @param AI_Suggestions_Serializer $serializer     The suggestion serializer.
	 */
	public function __construct(
		DOM_Parser $parser,
		Node_Processor $node_processor,
		AI_Suggestions_Serializer $serializer
	) {
		$this->parser         = $parser;
		$this->node_processor = $node_processor;
		$this->serializer     = $serializer;
	}

	/**
	 * Parses the AI response and returns the suggestion
	 *
	 * @param string $ai_response The AI response to parse.
	 *
	 * @return string The suggestion from the AI response.
	 */
	public function get_suggestion_from_ai_response( string $ai_response ): string {
		$json = \json_decode( $ai_response );
		if ( $json === null || ! isset( $json->choices ) ) {
			return '';
		}

		$raw_fixes = $json->choices[0]->text;
		// Remove any new lines (potentially surrounded by spaces) from the response.
		$raw_fixes = \preg_replace( '/\s*[\n\r]+\s*/', '', $raw_fixes );
		// Remove any newline characters from the response.
		$raw_fixes = \str_replace( "\\n", '', $raw_fixes );

		return $raw_fixes;
	}

	/**
	 * Calculates the diff between the original text and the fixed text.
	 * Differences are marked with `<ins>` and `<del>` tags.
	 *
	 * @param string $original  The original text.
	 * @param string $raw_fixes The suggested fixes.
	 * @return string The difference between the two strings.
	 */
	public function calculate_diff( string $original, string $raw_fixes ): string {
		if ( ! \class_exists( 'Text_Diff' ) ) {
			require_once \ABSPATH . '/wp-includes/wp-diff.php';
		}

		$left_lines  = \explode( "\n", $original );
		$right_lines = \explode( "\n", $raw_fixes );

		$text_diff = new Text_Diff( $left_lines, $right_lines );
		$renderer  = new WPSEO_HTML_Diff_Renderer();
		return $renderer->render( $text_diff );
	}

	/**
	 * Removes the HTML tags from the suggestion.
	 *
	 * @param string $diff The suggestion to remove the HTML tags from.
	 *
	 * @return string The suggestion without the HTML tags.
	 */
	public function remove_html_from_suggestion( string $diff ): string {
		// Sometimes, the AI inadvertently suggests adding HTML tags or new blocks (through comments). We remove these here.
		// Note that the HTML tags enter the diff escaped (so &lt; and &gt; instead of < and >).
		// And yes, we are using a regex to parse HTML. We are aware of the risks.
		$html_tags   = \sprintf( '/(<ins class="%s">)([^<]*?)&lt;.*?&gt;(.*?)(<\/ins>)/', self::YST_DIFF_CLASS );
		$replacement = static function ( $matches ) {
			// If there is no text before and after the tags, we remove the tags completely.
			if ( $matches[2] === '' && $matches[3] === '' ) {
				return '';
			}
			// Otherwise, we keep the text before and after the tags.
			else {
				return $matches[1] . $matches[2] . $matches[3] . $matches[4];
			}
		};
		// Keep replacing until there are no more tags left.
		while ( \preg_match( $html_tags, $diff ) ) {
			$diff = \preg_replace_callback( $html_tags, $replacement, $diff );
		}

		return $diff;
	}

	/**
	 * Retains any replacements of non-breaking spaces in suggestions.
	 *
	 * @param string $diff The diff to keep its non-breaking spaces.
	 *
	 * @return string The suggestion with non-breaking spaces intact.
	 */
	public function keep_nbsp_in_suggestions( string $diff ): string {
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase -- Not our properties.
		$dom = $this->parser->parse( $diff, \get_bloginfo( 'charset' ) );

		// XPath query to select all our <del> tags.
		$xpath           = new DOMXPath( $dom );
		$del_nodes_query = \sprintf( '//del[@class="%s"]', self::YST_DIFF_CLASS );
		$del_nodes       = $xpath->query( $del_nodes_query );

		$flattened_encoded_changes = false;

		// Iterate through all <del> tags that contain &nbsp;.
		foreach ( $del_nodes as $del_node ) {
			if ( \strpos( $del_node->textContent, '&nbsp;' ) === false ) {
				continue;
			}

			// Find the next sibling <ins> tag.
			$next_ins_node = $del_node->nextSibling;
			while ( $next_ins_node && $next_ins_node->nodeName !== 'ins' ) {
				$next_ins_node = $next_ins_node->nextSibling;
			}

			// If there is no later <ins> tag, we'll do no more post-processing and just show the rest of the <del> tags as is - unlikely, since <del>s usually are followed by <ins>s.
			if ( ! $next_ins_node ) {
				break;
			}

			// If the <ins> tag is the same with the <del> tag, apart from the &nbsp; transformation, flatten the change as if there was no suggestion.
			if ( $next_ins_node->textContent === \str_replace( '&nbsp;', ' ', $del_node->textContent ) ) {
				// Replace the <del> tag with the text content of the <del> tag.
				$del_node->parentNode->replaceChild( $dom->createTextNode( $del_node->textContent ), $del_node );

				// Remove the <ins> tag.
				$this->node_processor->remove( $next_ins_node );

				$flattened_encoded_changes = true;
				continue;
			}

			// If the <del> tag is just a &nbsp; and it's being suggested to be replaced by a block of text starting with a space, flatten the change and just move the &nbsp; into the suggested text.
			if ( $del_node->textContent === '&nbsp;' && ( \substr( $next_ins_node->textContent, 0, 1 ) === ' ' ) ) {
				// Replace the starting space with &nbsp; in the <ins> tag.
				$ins_content                = \ltrim( $next_ins_node->textContent, ' ' );
				$ins_content                = '&nbsp;' . $ins_content;
				$next_ins_node->textContent = $ins_content;

				// Remove the <del> tag.
				$this->node_processor->remove( $del_node );

				$flattened_encoded_changes = true;
				continue;
			}
		}
		// phpcs:enable

		if ( $flattened_encoded_changes ) {
			$diff = $this->serializer->serialize( $dom );
		}

		return $diff;
	}

	/**
	 * Get the Yoast diff nodes from the DOM
	 *
	 * @param DOMDocument $dom       The DOM to get the diff nodes from.
	 * @param string|null $node_type The type of node to get. If null the method will get both ins and del nodes.
	 *
	 * @return DOMNodeList The diff nodes
	 */
	public function get_diff_nodes( DOMDocument $dom, ?string $node_type = null ): DOMNodeList {
		$xpath = new DOMXPath( $dom );
		// If the node type is null, we get both ins and del nodes; if it's not, we get the specified node type.
		$local_name_query = \is_null( $node_type ) ? '//*[local-name()="ins" or local-name()="del"]' : \sprintf( "//*[local-name()='%s']", $node_type );
		$diff_nodes_query = \sprintf( "%s[contains(concat(' ', normalize-space(@class), ' '), '%s')]", $local_name_query, self::YST_DIFF_CLASS );
		return $xpath->query( $diff_nodes_query );
	}

	/**
	 * Check if a node is a Yoast diff node
	 *
	 * @param DOMNode $node The node to check.
	 *
	 * @return bool Whether the node is a Yoast diff node.
	 */
	public function is_yoast_diff_node( DOMNode $node ): bool {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		if ( $node->nodeName !== 'ins' && $node->nodeName !== 'del' ) {
			return false;
		}

		if ( ! $node->hasAttribute( 'class' ) ) {
			return false;
		}

		$class = $node->getAttribute( 'class' );
		return \strpos( $class, self::YST_DIFF_CLASS );
	}

	/**
	 * Convert diff nodes to string
	 *
	 * @param DOMDocument $dom The DOM to convert.
	 *
	 * @return DOMDocument The converted DOM
	 */
	public function convert_diff_nodes_to_string_nodes( DOMDocument $dom ): DOMDocument {
		$diff_nodes = $this->get_diff_nodes( $dom );

		foreach ( $diff_nodes as $node ) {
			// Build the text node content based on the diff node nodeName and nodeValue attributes.
			// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$text      = \sprintf( '[%s-yst-tag]%s[/%s-yst-tag]', $node->nodeName, $node->nodeValue, $node->nodeName );
			$text_node = $dom->createTextNode( $text );
			$parent    = $node->parentNode;
			// If the node has no parent, we insert the new  text node before the diff node and remove the diff node.
			if ( \is_null( $parent ) ) {
				$dom->insertBefore( $node, $text_node );
				$dom->removeChild( $node );
			}
			// If the node has a parent, we replace the diff node with the new text node.
			else {
				$parent->replaceChild( $text_node, $node );
			}
		}
		// phpcs:enable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		return $this->parser->parse( \rtrim( $dom->saveHTML(), "\n" ), \get_bloginfo( 'charset' ) );
	}

	/**
	 * Replace placeholders with diff tags
	 *
	 * @param string $suggestion The suggestion to process.
	 *
	 * @return string The suggestion with the tags replaced
	 */
	public function replace_placeholders_with_diff_tags( string $suggestion ): string {
		$suggestion = \str_replace( '[ins-yst-tag]', \sprintf( '<ins class="%s">', self::YST_DIFF_CLASS ), $suggestion );
		$suggestion = \str_replace( '[/ins-yst-tag]', '</ins>', $suggestion );
		$suggestion = \str_replace( '[del-yst-tag]', \sprintf( '<del class="%s">', self::YST_DIFF_CLASS ), $suggestion );
		$suggestion = \str_replace( '[/del-yst-tag]', '</del>', $suggestion );

		return $suggestion;
	}

	/**
	 * Additional unification step to join contiguous diff nodes with the same tag.
	 *
	 * @param DOMDocument $dom The DOM to unify.
	 *
	 * @return void
	 */
	public function unify_suggestion( DOMDocument $dom ): void {
		$diff_nodes = $this->get_diff_nodes( $dom );

		foreach ( $diff_nodes as $diff_node ) {
			// If this diff node has no next sibling, we continue to the next diff node.
			// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$next_sibling = $diff_node->nextSibling;
			if ( \is_null( $next_sibling ) ) {
				continue;
			}
			// If the next sibling is the same kind of the current node, we proceed to join them.
			if ( $next_sibling->nodeName === $diff_node->nodeName ) {
				// we encode the HTML entities in the diff node value, create a text node out of it and prepend it to the next sibling's content.
				$encoded_diff_node_value = \htmlentities( $diff_node->nodeValue, \ENT_QUOTES, \get_bloginfo( 'charset' ) );
				$text_diff_node          = $dom->createTextNode( $encoded_diff_node_value );
				$next_sibling->insertBefore( $text_diff_node, $next_sibling->firstChild );
				// We remove the diff node.
				( $diff_node->parentNode )->removeChild( $diff_node );
			}
			// phpcs:enable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		}
	}

	/**
	 * Takes care of the cases when an ins node starts with a full stop.
	 *
	 * @param DOMDocument $dom The DOM to fix the leading full stop in.
	 *
	 * @return void
	 */
	public function fix_leading_full_stop( DOMDocument $dom ): void {
		$ins_nodes = $this->get_diff_nodes( $dom, 'ins' );

		foreach ( $ins_nodes as $ins_node ) {
			// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			// Check if the diff node starts with a dot and a space.
			if ( \strpos( $ins_node->nodeValue, '. ' ) === 0 ) {
				// A next sibling needs to exist for the next check.
				$next_sibling = $ins_node->nextSibling;

				if ( \is_null( $next_sibling ) ) {
					continue;
				}

				// The previous sibling should exist because we need to append the full stop to it.
				$previous_sibling = $ins_node->previousSibling;

				if ( \is_null( $previous_sibling ) ) {
					continue;
				}

				// The next sibling should start with a full stop.
				if ( \strpos( $next_sibling->nodeValue, '.' ) !== 0 ) {
					continue;
				}

				// If the next sibling is a single full stop character, we remove the node, remove the full stop
				// at the beginning of the ins node and append the full stop  to the previous sibling.
				if ( \strlen( $next_sibling->nodeValue ) === 1 ) {
					( $next_sibling->parentNode )->removeChild( $next_sibling );
					$ins_node->nodeValue         = \substr( $ins_node->nodeValue, 2 ) . '.';
					$previous_sibling->nodeValue = $previous_sibling->nodeValue . '. ';
					continue;
				}

				// If the next sibling is a full stop followed by characters, we remove the full stop and space from it,
				// add it at the beginning of the ins node and append the full stop  to the previous sibling.
				if ( \strpos( $next_sibling->nodeValue, '. ' ) === 0 ) {
					$next_sibling->nodeValue     = \substr( $next_sibling->nodeValue, 1 );
					$ins_node->nodeValue         = \substr( $ins_node->nodeValue, 2 ) . '.';
					$previous_sibling->nodeValue = $previous_sibling->nodeValue . '. ';
				}
			}
			// phpcs:enable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		}
	}
}
