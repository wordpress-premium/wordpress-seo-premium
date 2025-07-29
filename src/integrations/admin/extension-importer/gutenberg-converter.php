<?php
// Snake case is globally ignored for this file since its uses DOMDocument and DOMElement functions which are in camelCase.
// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use DOMDocument;
use DOMElement;
use Exception;

/**
 * Gutenberg_Converter class.
 */
class Gutenberg_Converter {

	/**
	 * Footnote processor instance.
	 *
	 * @var Footnote_Processor
	 */
	private $footnote_processor;

	/**
	 * DOM processor instance.
	 *
	 * @var DOM_Processor
	 */
	private $dom_processor;

	/**
	 * Content processor instance.
	 *
	 * @var Content_Processor
	 */
	private $content_processor;

	/**
	 * Nested list creator instance.
	 *
	 * @var Nested_List_Creator
	 */
	private $nested_list_creator;

	/**
	 * The constructor.
	 *
	 * @param Footnote_Processor  $footnote_processor  The footnote processor instance.
	 * @param DOM_Processor       $dom_processor       The DOM processor instance.
	 * @param Content_Processor   $content_processor   The content processor instance.
	 * @param Nested_List_Creator $nested_list_creator The nested list creator instance.
	 *
	 * @return void
	 */
	public function __construct(
		Footnote_Processor $footnote_processor,
		DOM_Processor $dom_processor,
		Content_Processor $content_processor,
		Nested_List_Creator $nested_list_creator
	) {
		$this->footnote_processor  = $footnote_processor;
		$this->dom_processor       = $dom_processor;
		$this->content_processor   = $content_processor;
		$this->nested_list_creator = $nested_list_creator;
	}

	/**
	 * Converts HTML content to Gutenberg blocks.
	 *
	 * @param string $html_content HTML content to convert.
	 *
	 * @return string The converted Gutenberg blocks.
	 */
	public function convert( string $html_content ): string {
		if ( $html_content === '' ) {
			return '';
		}

		try {
			// Special case for allowing escaped script tags as DOMDocument doesn't handle them.
			$script_safe_html_content = \str_replace(
				[ '&lt;script&gt;', '&lt;/script&gt;' ],
				[ '[encoded_script_open]', '[encoded_script_close]' ],
				$html_content
			);

			// Create a DOM document from the HTML content.
			$dom = new DOMDocument();

			// Load the HTML content in UTF-8 encoding into the DOM document.
			$dom->loadHTML( '<?xml encoding="UTF-8">' . $script_safe_html_content, ( \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD ) );

			// Early bail if the DOM document is not created.
			if ( ! $dom ) {
				return $html_content;
			}

			$body = $dom->getElementsByTagName( 'body' )->item( 0 );

			// Early bail if the body element is not found.
			if ( $body === null ) {
				return $html_content;
			}

			// Convert footnotes to Gutenberg blocks.
			$this->footnote_processor->convert_footnotes( $dom );

			// Extract code blocks from the content.
			$code_blocks = $this->content_processor->extract_code_blocks( $body, $this->dom_processor );

			// Now process the content and convert to blocks.
			$blocks = [];

			// First, extract the cover image since it will always be the first element, if it exists.
			$cover_block = $this->content_processor->extract_cover_image( $body );

			if ( $cover_block !== '' ) {
				$blocks[] = $cover_block;
			}

			// Now process the rest of the content, skipping code block elements.
			$this->process_content( $body, $blocks, $code_blocks );

			// If we find footnotes, add the footnotes block as its data is stored in postmeta.
			if ( ! empty( $this->footnote_processor->footnotes ) ) {
				$blocks[] = '<!-- wp:footnotes /-->';
			}

			return \implode( \PHP_EOL . \PHP_EOL, $blocks );
		}
		catch ( Exception $e ) {
			return $html_content;
		}
	}

	/**
	 * Processes HTML content and adds blocks to the blocks array later to be added as post content.
	 *
	 * This method is responsible for converting HTML elements to their
	 * corresponding Gutenberg block representations and handling complex
	 * nested structures like lists.
	 *
	 * @param DOMElement                                                 $element     The element to process.
	 * @param array<string>                                              $blocks      The blocks array to add to.
	 * @param array<array{elements: array<DOMElement>, content: string}> $code_blocks The code blocks array to add to.
	 *
	 * @return void
	 */
	private function process_content( $element, &$blocks, $code_blocks ): void {
		// Build a list of elements that should be skipped (already in code blocks).
		$skip_elements = $this->content_processor->determine_elements_to_skip( $code_blocks );

		// PHASE 1: First pass to identify nested list groups and track positions.
		$nested_list_data = $this->nested_list_creator->process_nested_lists( $element );
		$list_groups      = $nested_list_data['list_groups'];
		$nodes_to_skip    = $nested_list_data['nodes_to_skip'];

		// Determine Google Document TOC nodes to be skipped and considered as paragraph elements.
		$toc_sections = $this->content_processor->get_toc_nodes( $element );

		// Combine the TOC nodes into the nodes to skip.
		foreach ( $toc_sections as $toc_section ) {
			$toc_nodes     = \array_column( $toc_section, 'node' );
			$nodes_to_skip = \array_merge( $nodes_to_skip, $toc_nodes );
		}

		// PHASE 2: Process all content and create positioned blocks.
		// This array allows us to maintain correct ordering of mixed content types.
		$positioned_blocks = [];

		// Reset position counter for the main content processing pass.
		$current_position = 0;

		if ( $element->childNodes->length !== 0 ) {
			foreach ( $element->childNodes as $node ) {
				// Skip non-element nodes.
				if ( $node->nodeType !== \XML_ELEMENT_NODE ) {
					continue;
				}

				// Check if this is the position where a list group should be inserted.
				foreach ( $list_groups as $group_index => $group ) {
					if ( isset( $group['position'] ) && $group['position'] === $current_position ) {
						$positioned_blocks[] = [
							'content'  => $this->nested_list_creator->create_nested_list_block( $group['lists'], $this->content_processor, $this->dom_processor ),
							'position' => $current_position,
						];

						// Remove this group so we don't process it again.
						unset( $list_groups[ $group_index ] );
						break;
					}
				}

				// Add the TOC block if it exists and is at the current position.
				foreach ( $toc_sections as $toc_section ) {
					// Only check if the first position of the section is encountered.
					if ( $toc_section[0]['position'] === $current_position ) {
						$positioned_blocks[] = [
							'content'  => $this->content_processor->create_toc_block( $element ),
							'position' => $current_position,
						];
					}
				}

				// Keep track of position for element nodes.
				++$current_position;

				// Skip elements that are part of code blocks.
				if ( \in_array( $node, $skip_elements, true ) ) {
					// If this is the last element of a code block, add the code block.
					foreach ( $code_blocks as $code_block ) {
						$last_element = \end( $code_block['elements'] );

						if ( $node === $last_element ) {
							$positioned_blocks[] = [
								'content'  => $this->content_processor->create_code_block( $code_block['content'] ),
								'position' => ( $current_position - 1 ),
							];
							break;
						}
					}
					continue;
				}

				// Skip nodes that will be processed as part of nested lists.
				if ( \in_array( $node, $nodes_to_skip, true ) ) {
					continue;
				}

				// Check for paragraphs with only an image.
				if ( $node->nodeName === 'p' ) {
					$spans     = $node->getElementsByTagName( 'span' );
					$processed = false;

					if ( $spans->length !== 0 ) {
						foreach ( $spans as $span ) {
							if ( $span->getElementsByTagName( 'img' )->length > 0 ) {
								$image_block = $this->content_processor->extract_image_from_paragraph( $node );

								if ( $image_block !== '' ) {
									$positioned_blocks[] = [
										'content'  => $image_block,
										'position' => ( $current_position - 1 ),
									];
									$processed           = true;
									break;
								}
							}
						}
					}

					// If already processed as an image block, continue.
					if ( $processed ) {
						continue;
					}

					// Check for bookmark paragraph structure - any paragraph with span + anchor with ID.
					$bookmark_block = $this->content_processor->create_bookmark_paragraph( $node );

					if ( $bookmark_block !== '' ) {
						$positioned_blocks[] = [
							'content'  => $bookmark_block,
							'position' => ( $current_position - 1 ),
						];
						continue;
					}
				}

				// Process regular lists (ul or ol) that aren't part of a nested group.
				if (
					( $node->nodeName === 'ul' || $node->nodeName === 'ol' )
					&& ! \in_array( $node, $nodes_to_skip, true )
				) {
					$positioned_blocks[] = [
						'content'  => $this->content_processor->create_list_block( $node, $this->dom_processor ),
						'position' => ( $current_position - 1 ),
					];
					continue;
				}

				// Process table elements.
				if ( $node->nodeName === 'table' ) {
					$positioned_blocks[] = [
						'content'  => $this->content_processor->create_table_block( $node, $this->dom_processor ),
						'position' => ( $current_position - 1 ),
					];
					continue;
				}

				// Process horizontal line.
				if ( $node->nodeName === 'hr' ) {
					$positioned_blocks[] = [
						'content'  => $this->content_processor->create_separator_block(),
						'position' => ( $current_position - 1 ),
					];
					continue;
				}

				// Process links.
				if ( $node->nodeName === 'a' ) {
					$positioned_blocks[] = [
						'content'  => $this->content_processor->create_paragraph_with_link( $node ),
						'position' => ( $current_position - 1 ),
					];
					continue;
				}

				// Process headings.
				if ( \preg_match( '/h[1-6]/', $node->nodeName ) ) {
					$positioned_blocks[] = [
						'content'  => $this->content_processor->create_heading_block( $node, $this->dom_processor ),
						'position' => ( $current_position - 1 ),
					];
					continue;
				}

				// Process paragraphs that weren't already processed as image blocks.
				if ( $node->nodeName === 'p' && \trim( $node->textContent ) !== '' ) {
					$positioned_blocks[] = [
						'content'  => $this->content_processor->create_paragraph_block( $node, $this->dom_processor ),
						'position' => ( $current_position - 1 ),
					];
					continue;
				}
			}
		}

		// Add any remaining list groups that weren't processed in the main loop.
		foreach ( $list_groups as $group ) {
			$positioned_blocks[] = [
				'content'  => $this->nested_list_creator->create_nested_list_block( $group['lists'], $this->content_processor, $this->dom_processor ),
				'position' => $group['position'],
			];
		}

		/**
		 * Sort all blocks by position to maintain the original document order.
		 * This ensures elements appear in the same order as they did in the source HTML.
		 * Which is essential for preserving content flow and semantic relationships.
		 */
		\usort(
			$positioned_blocks,
			static function ( $a, $b ) {
				return ( $a['position'] - $b['position'] );
			}
		);

		if ( ! empty( $positioned_blocks ) ) {
			// Finally, add all blocks to the output array in correct sequence.
			foreach ( $positioned_blocks as $block ) {
				// Revert escaped script tags.
				if ( \strpos( $block['content'], '[encoded_script_open]' ) !== false ) {
					$block['content'] = \str_replace(
						[ '[encoded_script_open]', '[encoded_script_close]' ],
						[ '&lt;script&gt;', '&lt;/script&gt;' ],
						$block['content']
					);
				}

				$blocks[] = $block['content'];
			}
		}
	}
}
