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

		/**
		 * Substitutes the diff nodes with string placeholders.
		 * This is done because of the next step where we ask for the text nodes: we need to have the diff tags in the text so that we can process them in the context of their parent node.
		 */
		$dom = $this->suggestion_processor->convert_diff_nodes_to_string_nodes( $input_dom );

		/**
		 * Fetch only the text nodes. This allows us to ignore all the other nodes which represents the post's structure.
		 * By doing so we can process the nodes we're interested in disregarding whatever complex formatting the post has.
		 */
		$xpath = new DOMXPath( $dom );
		$nodes = $xpath->query( '//text()' );

		// Process each text node.
		foreach ( \iterator_to_array( $nodes ) as $node ) {
			/**
			 * We need to convert each applicable character to the corresponding HTML entity.
			 * We do this because the WordPress editor expects so, and if we don't do this we get an error about the block not being correct.
			 */
			// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$text = \htmlentities( $node->nodeValue );
			if ( $text === '\n' ) {
				continue;
			}
			// This node doesn't contain any diff tags.
			if ( ( \strpos( $text, $this->sentence_processor::INS_PLACEHOLDER ) === false ) && \strpos( $text, $this->sentence_processor::DEL_PLACEHOLDER ) === false ) {
				continue;
			}

			// Naively split the text into sentences.
			$sentences = \array_filter( \preg_split( self::PUNCTUATION_SPLIT_REGEX, $text ) );
			/**
			 * This step takes care of the cases where the last sentence in the array is a closing placeholder tag. This might happen if the text inside a diff tag ends with a punctuation mark.
			 * If it is, we append the tag to the previous sentence.
			 */
			$this->sentence_processor->check_last_sentence( $sentences );
			/**
			 * These two variables keep track of whether a dangling open ins or del tag has been encountered in the previous sentence.
			 * This is important because if the current sentence doesn't contain any diff tags, we need to enclose it in the same diff tag as the previous sentence.
			 */
			$is_ins_tag_open = false;
			$is_del_tag_open = false;
			/**
			 * This loop ensures that the diff tags are well-formed in each sentence.
			 * It also checks if the sentence should be processed as a whole.
			 */
			foreach ( $sentences as &$sentence ) {
				$is_ins_tag_open = $this->sentence_processor->ensure_well_formedness_for_tag( $this->sentence_processor::INS_PLACEHOLDER, $sentence, $is_ins_tag_open );
				$is_del_tag_open = $this->sentence_processor->ensure_well_formedness_for_tag( $this->sentence_processor::DEL_PLACEHOLDER, $sentence, $is_del_tag_open );
			}

			$processed_sentences = [];
			/**
			 * Now we are sure that the diff tags are well-formed in each sentence, we can proceed to process them.
			 */
			foreach ( $sentences as $well_formed_sentence ) {
				// Check if the number of diff tags in the sentence is above the threshold.
				if ( $this->sentence_processor->should_switch_to_sentence_based( $well_formed_sentence ) ) {
					// First we create a new sentence of the form: [del-yst-tag]original sentence[/del-yst-tag].
					$processed_sentences[] = $this->sentence_processor::open( $this->sentence_processor::DEL_PLACEHOLDER )
						. $this->sentence_processor->dismiss_fixes( $well_formed_sentence )
						. $this->sentence_processor::close( $this->sentence_processor::DEL_PLACEHOLDER );
					// Then we create a new sentence of the form: [ins-yst-tag]corrected sentence[/ins-yst-tag].
					$processed_sentences[] = $this->sentence_processor::open( $this->sentence_processor::INS_PLACEHOLDER )
						. $this->sentence_processor->apply_fixes( $well_formed_sentence )
						. $this->sentence_processor::close( $this->sentence_processor::INS_PLACEHOLDER );
				}
				else {
					// Not enough diff tags to warrant sentence based processing.
					$processed_sentences[] = $well_formed_sentence;
				}
			}

			// Join the processed sentences into a single string and convert the applicable characters to HTML entities.
			$processed_suggestion = \htmlentities( \implode( '', $processed_sentences ) );

			// Replace the placeholders with actual diff tags.
			$processed_suggestion = $this->suggestion_processor->replace_placeholders_with_diff_tags( $processed_suggestion );

			// Parse the new suggestion into a DOMDocument object to get the HTML nodes related to each part of the suggestion.
			$processed_content_dom = new DOMDocument();
			$processed_content_dom->loadHTML( $this->parser->add_charset( $processed_suggestion, \get_bloginfo( 'charset' ) ), ( \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD ) );

			// The previous step added an extra <html> and <body> tag, so we need to keep only the nodes inside the body tag.
			$processed_content_nodes = $processed_content_dom->getElementsByTagName( 'body' )->item( 0 )->childNodes;
			// Import the nodes into the original DOM representing the whole post.
			foreach ( $processed_content_nodes as $processed_content_node ) {
				// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$imported_node = $dom->importNode( $processed_content_node, true );
				$node->parentNode->insertBefore( $imported_node, $node );
			}
			// Remove the original text node.
			$parent = $node->parentNode;
			$parent->removeChild( $node );
		}

		// This is an additional unification step which searches for contiguous diff nodes and merges them into a single diff node.
		$this->suggestion_processor->unify_suggestion( $dom );

		// This step searches for ins nodes whose content starts with a full stop, removes the full stop and moves it to the previous text node.
		$this->suggestion_processor->fix_leading_full_stop( $dom );

		// Serialize the DOM back to a string.
		return $this->serializer->serialize( $dom );
	}
}
