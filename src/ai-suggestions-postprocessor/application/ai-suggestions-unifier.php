<?php

namespace Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application;

use DOMDocument;
use DOMXPath;
use Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain\Suggestion_Interface;
use Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser;
use Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor;
/**
 * Class that implements the main flow of the AI suggestions unifier.
 */
class AI_Suggestions_Unifier {

	public const PUNCTUATION_SPLIT_REGEX = '/(?<=[.!?])/i';

	/**
	 * The suggestion parser.
	 *
	 * @var DOM_Parser
	 */
	protected $parser;

	/**
	 * The suggestion processor.
	 *
	 * @var Node_Processor
	 */
	protected $node_processor;

	/**
	 * The sentence processor.
	 *
	 * @var Sentence_Processor
	 */
	protected $sentence_processor;

	/**
	 * The suggestion serializer.
	 *
	 * @var Suggestion_Processor
	 */
	private $suggestion_processor;

	/**
	 * The suggestion serializer.
	 *
	 * @var AI_Suggestions_Serializer
	 */
	protected $serializer;

	/**
	 * The class constructor.
	 *
	 * @param DOM_Parser                $parser               The DOM parser.
	 * @param Node_Processor            $node_processor       The node processor.
	 * @param Sentence_Processor        $sentence_processor   The sentence processor.
	 * @param Suggestion_Processor      $suggestion_processor The suggestion processor.
	 * @param AI_Suggestions_Serializer $serializer           The suggestion serializer.
	 */
	public function __construct( DOM_Parser $parser, Node_Processor $node_processor, Sentence_Processor $sentence_processor, Suggestion_Processor $suggestion_processor, AI_Suggestions_Serializer $serializer ) {
		$this->parser               = $parser;
		$this->node_processor       = $node_processor;
		$this->suggestion_processor = $suggestion_processor;
		$this->sentence_processor   = $sentence_processor;
		$this->serializer           = $serializer;
	}

	/**
	 * Process the suggestion
	 *
	 * @param Suggestion_Interface $suggestion The suggestion to process.
	 *
	 * @return string The processed suggestion
	 */
	public function unify_diffs( Suggestion_Interface $suggestion ): string {
		// Parse the suggestion into a DOMDocument object.
		$input_dom = $this->parser->parse( $suggestion->get_content(), \get_bloginfo( 'charset' ) );

		$dom = $this->suggestion_processor->convert_diff_nodes_to_string_nodes( $input_dom );

		// Fetch only the text nodes.
		$xpath = new DOMXPath( $dom );
		$nodes = $xpath->query( '//text()' );

		foreach ( \iterator_to_array( $nodes ) as $node ) {
			// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$text = \htmlentities( $node->nodeValue );
			if ( $text === '\n' ) {
				continue;
			}
			// This node doesn't contain any diff tags.
			if ( ( \strpos( $text, $this->sentence_processor::INS_PLACEHOLDER ) === false ) && \strpos( $text, $this->sentence_processor::DEL_PLACEHOLDER ) === false ) {
				continue;
			}

			$sentences = \array_filter( \preg_split( self::PUNCTUATION_SPLIT_REGEX, $text ) );
			$this->sentence_processor->check_last_sentence( $sentences );
			$is_ins_tag_open = false;
			$is_del_tag_open = false;
			foreach ( $sentences as &$sentence ) {
				$is_ins_tag_open = $this->sentence_processor->ensure_well_formedness_for_tag( $this->sentence_processor::INS_PLACEHOLDER, $sentence, $is_ins_tag_open );
				$is_del_tag_open = $this->sentence_processor->ensure_well_formedness_for_tag( $this->sentence_processor::DEL_PLACEHOLDER, $sentence, $is_del_tag_open );
			}

			$processed_sentences = [];

			foreach ( $sentences as $well_formed_sentence ) {
				if ( $this->sentence_processor->should_switch_to_sentence_based( $well_formed_sentence ) ) {
					$processed_sentences[] = $this->sentence_processor::open( $this->sentence_processor::DEL_PLACEHOLDER )
						. $this->sentence_processor->dismiss_fixes( $well_formed_sentence )
						. $this->sentence_processor::close( $this->sentence_processor::DEL_PLACEHOLDER );
					$processed_sentences[] = $this->sentence_processor::open( $this->sentence_processor::INS_PLACEHOLDER )
						. $this->sentence_processor->apply_fixes( $well_formed_sentence )
						. $this->sentence_processor::close( $this->sentence_processor::INS_PLACEHOLDER );
				}
				else {
					// Not enough diff tags to warrant sentence based processing.
					$processed_sentences[] = $well_formed_sentence;
				}
			}

			$processed_suggestion = \htmlentities( \implode( '', $processed_sentences ) );

			$processed_suggestion = $this->suggestion_processor->replace_placeholders_with_diff_tags( $processed_suggestion );

			// Parse the new content into a DOMDocument object.
			$processed_content_dom = new DOMDocument();
			$processed_content_dom->loadHTML( $this->parser->add_charset( $processed_suggestion, \get_bloginfo( 'charset' ) ), ( \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD ) );

			$processed_content_nodes = $processed_content_dom->getElementsByTagName( 'body' )->item( 0 )->childNodes;
			// Import the new DOMDocument object into the original DOM.
			foreach ( $processed_content_nodes as $processed_content_node ) {
				// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$imported_node = $dom->importNode( $processed_content_node, true );
				// Replace the original node with the new node.
				$node->parentNode->insertBefore( $imported_node, $node );
			}
			$parent = $node->parentNode;
			$parent->removeChild( $node );
		}

		$this->suggestion_processor->unify_suggestion( $dom );

		$this->suggestion_processor->fix_leading_full_stop( $dom );

		return $this->serializer->serialize( $dom );
	}
}
