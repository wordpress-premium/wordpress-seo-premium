<?php
// Snake case is globally ignored for this file since its uses DOMDocument and DOMElement functions which are in camelCase.
// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use DOMElement;
use WPSEO_Utils;

/**
 * Content_Processor class.
 */
class Content_Processor {

	/**
	 * The start marker for code blocks.
	 *
	 * @var string
	 */
	private const CODE_BLOCK_START_MARKER = '&#60419;';

	/**
	 * The end marker for code blocks.
	 *
	 * @var string
	 */
	private const CODE_BLOCK_END_MARKER = '&#60418;';

	/**
	 * Creates Gutenberg block comment wrappers.
	 *
	 * @param string                         $block_name The name of the block.
	 * @param array<string, string|int|bool> $attributes Optional attributes as array or JSON string.
	 *
	 * @return array<string, string> Array with opening and closing comment tags.
	 */
	public function create_block_comments( string $block_name, array $attributes = [] ): array {
		$attr_str = '';

		if ( ! empty( $attributes ) ) {
			$attr_str = ' ' . WPSEO_Utils::format_json_encode( $attributes );
		}

		return [
			'open'  => '<!-- wp:' . \wp_kses_data( $block_name . $attr_str ) . ' -->',
			'close' => '<!-- /wp:' . \wp_kses_data( $block_name ) . ' -->',
		];
	}

	/**
	 * Extracts code blocks from the content.
	 *
	 * @param DOMElement|null    $body          The body element.
	 * @param DOM_Processor|null $dom_processor The DOM processor instance.
	 *
	 * @return array<array{elements: array<DOMElement>, content: string}> The code blocks.
	 */
	public function extract_code_blocks( ?DOMElement $body, ?DOM_Processor $dom_processor ): array {
		if ( $body === null || $dom_processor === null ) {
			return [];
		}

		// Pre-process the content to identify code blocks enclosed by special markers.
		// This first pass ensures code isn't broken up or incorrectly parsed as HTML.
		// The markers (HTML entity codes) are used to identify the start and end of code sections.
		$in_code_block       = false;
		$code_content        = '';
		$code_blocks         = [];
		$code_block_elements = [];

		// Get all paragraph elements that might contain code blocks.
		$paragraphs = $body->getElementsByTagName( 'p' );

		if ( $paragraphs->length === 0 ) {
			return $code_blocks;
		}

		foreach ( $paragraphs as $p ) {
			// Get the HTML content of the paragraph.
			$p_html = $dom_processor->get_node_html( $p );

			// Check if this paragraph contains a code block start marker.
			if ( ! $in_code_block && \strpos( $p_html, self::CODE_BLOCK_START_MARKER ) !== false ) {
				// We found the start of a code block.
				$in_code_block       = true;
				$code_content        = '';
				$code_block_elements = [ $p ];

				// Extract content after the marker.
				$content_parts = \explode( self::CODE_BLOCK_START_MARKER, $p_html, 2 );

				if ( ! empty( $content_parts[1] ) ) {
					$code_content .= $content_parts[1];
				}

				continue;
			}

			// Check if this paragraph contains a code block end marker.
			if ( $in_code_block && \strpos( $p_html, self::CODE_BLOCK_END_MARKER ) !== false ) {
				// We found the end of a code block.
				$code_block_elements[] = $p;

				// Extract content before the marker.
				$content_parts = \explode( self::CODE_BLOCK_END_MARKER, $p_html, 2 );

				if ( ! empty( $content_parts[0] ) ) {
					$code_content .= $content_parts[0];
				}

				// Store the code block info.
				$code_blocks[] = [
					'elements' => $code_block_elements,
					'content'  => $code_content,
				];

				$in_code_block = false;
				continue;
			}

			// If we're inside a code block, add the paragraph's content.
			if ( $in_code_block ) {
				$code_block_elements[] = $p;
				$code_content         .= $p_html;
			}
		}

		return $code_blocks;
	}

	/**
	 * Determine if the anchor element is a TOC node by checking if the href start with #h-.
	 *
	 * @param DOMElement|null $anchor The anchor element to check.
	 *
	 * @return bool True if the anchor element is a TOC node, false otherwise.
	 */
	private function is_toc_node( ?DOMElement $anchor ): bool {
		if ( $anchor === null ) {
			return false;
		}

		$href = $anchor->getAttribute( 'href' );

		return \strpos( $href, '#h-' ) === 0;
	}

	/**
	 * Get the TOC nodes from the element.
	 *
	 * @param DOMElement|null $element The element to get the TOC nodes from.
	 *
	 * @return array<array{node: DOMElement, position: int}> The TOC nodes.
	 */
	public function get_toc_nodes( ?DOMElement $element ): array {
		if ( $element === null ) {
			return [];
		}

		// Used for storing TOC sections.
		$toc_sections = [];

		// Used for creating TOC sections in case of multiple TOC blocks.
		$toc_index = 0;

		// Only increment the toc_index if we encounter the first TOC node.
		$has_encountered_toc_node = false;

		// Used for tracking the position of the TOC nodes which is later used to skip the node.
		$current_position = 0;

		if ( $element->childNodes->length !== 0 ) {
			foreach ( $element->childNodes as $node_index => $node ) {
				// Skip non-element nodes for list detection.
				if ( $node->nodeType !== \XML_ELEMENT_NODE ) {
					continue;
				}

				if ( $node->nodeName === 'p' ) {
					$anchor = $node->getElementsByTagName( 'a' );

					if ( $anchor->length > 0 ) {
						if ( $this->is_toc_node( $anchor->item( 0 ) ) ) {
							// Flip the flag to indicate that we have encountered a TOC node and can safely increment the toc_index.
							$has_encountered_toc_node = true;

							$toc_sections[ $toc_index ][] = [
								'node'     => $node,
								'position' => $current_position,
							];
						}

						// If next element is not a TOC node, end current TOC section and start a new one.
						if (
							$element->childNodes[ ( $node_index + 1 ) ] !== null
							&& $has_encountered_toc_node
							&& ! $this->is_toc_node( $element->childNodes[ ( $node_index + 1 ) ]->getElementsByTagName( 'a' )->item( 0 ) )
						) {
							++$toc_index;
						}
					}
				}

				++$current_position;
			}
		}

		return $toc_sections;
	}

	/**
	 * Generates the list structure for the TOC block items similar to the TOC block functionality.
	 *
	 * @param array<string, string|int> $headings Array of heading elements with content, href, and level properties.
	 *
	 * @return string The HTML structure for the table of contents.
	 */
	private function create_toc_heading_structure( array $headings ): string {
		// Return empty string if no headings provided.
		if ( empty( $headings ) ) {
			return '';
		}

		// Initialize the HTML structure with the opening ul tag.
		$heading_structure = '<ul>';

		// Create a tracking array to mark which headings have been processed.
		$processed_headings = \array_fill( 0, \count( $headings ), false );

		// Store the total number of headings for easier reference.
		$total_headings = \count( $headings );

		foreach ( $headings as $heading_index => $current_heading ) {
			// Skip headings that have already been processed (as children of other headings).
			if ( $processed_headings[ $heading_index ] ) {
				continue;
			}

			// Mark current heading as processed.
			$processed_headings[ $heading_index ] = true;

			// Start building this heading's list item with proper attributes.
			$heading_structure .= '<li><a href="' . \esc_url( $current_heading['href'] ) . '" data-level="' . \esc_attr( $current_heading['level'] ) . '">'
					. \wp_strip_all_tags( $current_heading['content'] )
				. '</a>';

			// Find all child headings (those with deeper nesting levels).
			$child_headings = [];
			$child_index    = ( $heading_index + 1 );

			// Collect all consecutive child headings that have deeper levels.
			while ( $child_index < $total_headings ) {
				// If we encounter a heading with same or higher hierarchy, stop collecting children.
				if ( $headings[ $child_index ]['level'] <= $current_heading['level'] ) {
					break;
				}

				// Add this heading to our child collection and mark it as processed.
				$child_headings[]                   = $headings[ $child_index ];
				$processed_headings[ $child_index ] = true;
				++$child_index;
			}

			// If we found child headings, create a nested list for them.
			if ( ! empty( $child_headings ) ) {
				$heading_structure .= '<ul>';
				foreach ( $child_headings as $child_heading ) {
					$heading_structure .= '<li><a href="' . \esc_url( $child_heading['href'] )
						. '" data-level="' . \esc_attr( $child_heading['level'] ) . '">'
						. \wp_strip_all_tags( $child_heading['content'] )
						. '</a></li>';
				}
				$heading_structure .= '</ul>';
			}

			// Close this heading's list item.
			$heading_structure .= '</li>';
		}

		// Close the main unordered list.
		$heading_structure .= '</ul>';

		return $heading_structure;
	}

	/**
	 * Creates a TOC block.
	 *
	 * @param DOMElement|null $element The element to attach the TOC block to.
	 *
	 * @return string The TOC block.
	 */
	public function create_toc_block( ?DOMElement $element ): string {
		// Early bail if the content is empty or the TOC block placeholder is not found.
		if ( $element === null ) {
			return '';
		}

		// Get the headings from the element.
		$headings = [];

		foreach ( $element->childNodes as $node ) {
			if ( $node->nodeType !== \XML_ELEMENT_NODE ) {
				continue;
			}

			$tag = $node->nodeName;

			/**
			 * During export on React app, we convert H1 to H2 and hence we can safely ignore the H1 headings.
			 * We only consider H2 and H3 headings since the TOC block has maxHeadingLevel attribute set to 3.
			 * We construct the TOC list items as it would be generated by the block's renderTableOfContents() function.
			 * This ensures that the TOC block is rendered correctly in the editor and on the post preview generated.
			 */
			if ( $tag === 'h2' || $tag === 'h3' ) {
				// Accept only headings that are present at the top level within the body element.
				if ( $node->parentNode->nodeName !== 'body' ) {
					continue;
				}

				$headings[] = [
					'content' => $node->textContent,
					'href'    => '#' . $node->getAttribute( 'id' ),
					'level'   => \intval( \substr( $tag, 1 ) ),
				];
			}
		}

		// Generate the heading structure expected by the Table of Contents block.
		$heading_structure = $this->create_toc_heading_structure( $headings );

		$block = $this->create_block_comments( 'yoast-seo/table-of-contents' );

		return $block['open']
				. '<div class="wp-block-yoast-seo-table-of-contents yoast-table-of-contents">' . \PHP_EOL
					. '<h2>' . \esc_html__( 'Table of contents', 'wordpress-seo-premium' ) . '</h2>' . \wp_kses_post( $heading_structure )
				. '</div>' . \PHP_EOL
		. $block['close'];
	}

	/**
	 * Determines the elements to skip from the code blocks.
	 *
	 * @param array<array{elements: array<DOMElement>}> $code_blocks The code blocks.
	 *
	 * @return array<DOMElement> The elements to skip.
	 */
	public function determine_elements_to_skip( array $code_blocks ): array {
		$skip_elements = [];

		if ( ! empty( $code_blocks ) ) {
			foreach ( $code_blocks as $code_block ) {
				if ( empty( $code_block['elements'] ) ) {
					continue;
				}

				foreach ( $code_block['elements'] as $element_to_skip ) {
					$skip_elements[] = $element_to_skip;
				}
			}
		}

		return $skip_elements;
	}

	/**
	 * Extracts a cover image from the body element.
	 *
	 * This method identifies a cover image by looking for:
	 * 1. Paragraphs with images at exact 768px width (which is a common indicator of a cover image).
	 * 2. First removes any identified cover image from the content to avoid duplication.
	 * 3. Creates a WordPress cover block with the proper image and layout.
	 *
	 * @param DOMElement|null $body Body Element.
	 *
	 * @return string The cover block if found, null otherwise.
	 */
	public function extract_cover_image( ?DOMElement $body ): string {
		if ( $body === null ) {
			return '';
		}

		// Get all paragraph elements.
		$paragraphs = $body->getElementsByTagName( 'p' );

		// Check if we have paragraphs.
		if ( $paragraphs->length === 0 ) {
			return '';
		}

		// Loop through each paragraph and check for first image as cover image.
		foreach ( $paragraphs as $p ) {
			$img_found = false;
			$img_src   = '';
			$img_alt   = '';

			// Check for spans that might contain the image with the specific style.
			$spans = $p->getElementsByTagName( 'span' );

			if ( $spans->length === 0 ) {
				continue;
			}

			foreach ( $spans as $span ) {
				$style = $span->getAttribute( 'style' );

				// Check if the span has a style with width of exactly 768.00px.
				// This specific width is a common indicator of a full-width cover image.
				if ( \preg_match( '/width:\s*768\.00px/i', $style ) ) {
					$imgs = $span->getElementsByTagName( 'img' );

					if ( ! empty( $imgs ) && $imgs->length > 0 ) {
						$img       = $imgs->item( 0 );
						$img_found = true;
						$img_src   = $img->getAttribute( 'src' );
						$img_alt   = $img->getAttribute( 'alt' );
						break;
					}
				}
			}

			// If no spans with 768px width, check for direct img elements with a width of 768.
			if ( ! $img_found ) {
				$imgs = $p->getElementsByTagName( 'img' );

				if ( $imgs->length > 0 ) {
					$img     = $imgs->item( 0 );
					$width   = $img->getAttribute( 'width' );
					$img_src = $img->getAttribute( 'src' );
					$img_alt = $img->getAttribute( 'alt' );

					// Check width attribute.
					if ( $width === '768' ) {
						$img_found = true;
					}
					else {
						// Also check style attribute for width: 768px.
						$style = $img->getAttribute( 'style' );
						if ( \preg_match( '/width:\s*768\.00px/i', $style ) || \preg_match( '/width:\s*768px/i', $style ) ) {
							$img_found = true;
						}
					}
				}
			}

			// If we found a suitable image in this paragraph.
			if ( $img_found && $img_src ) {
				// This is our cover image - remove it from the body content to avoid duplication.
				if ( $p->parentNode ) {
					$p->parentNode->removeChild( $p );
				}

				// Escape the image source URL.
				$safe_img_src = \esc_url( $img_src );

				// Generate the cover block comments.
				$cover_block = $this->create_block_comments(
					'cover',
					[
						'url'      => $safe_img_src,
						'id'       => 0,
						'isDark'   => false,
						'dimRatio' => 50,
					]
				);

				// Generate the paragraph block comments.
				$paragraph_block = $this->create_block_comments( 'paragraph' );

				// Create a cover block with appropriate settings for WordPress.
				return $cover_block['open'] . \PHP_EOL
						. '<div class="wp-block-cover is-light">' . \PHP_EOL
							. '<span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>' . \PHP_EOL
							. '<img class="wp-block-cover__image-background" alt="' . \esc_attr( $img_alt ) . '" src="' . $safe_img_src . '" data-object-fit="cover" />' . \PHP_EOL
							. '<div class="wp-block-cover__inner-container">' . \PHP_EOL
								. $paragraph_block['open'] . \PHP_EOL
								. '<p class="has-text-align-center"></p>' . \PHP_EOL
								. $paragraph_block['close'] . \PHP_EOL
							. '</div>' . \PHP_EOL
						. '</div>' . \PHP_EOL
						. $cover_block['close'];
			}

			// Only process the first paragraph that contains an image.
			if ( $p->getElementsByTagName( 'img' )->length > 0 ) {
				break;
			}
		}

		return '';
	}

	/**
	 * Creates a code block from the code content.
	 *
	 * @param string $code_content Code content.
	 *
	 * @return string The code block.
	 */
	public function create_code_block( string $code_content ): string {
		// Clean up the code content.
		$code_content = $this->clean_code_content( $code_content );

		// Get block comments.
		$block = $this->create_block_comments( 'code' );

		return $block['open'] . \PHP_EOL
				. "\t<pre class=\"wp-block-code\">" . \PHP_EOL
				. "\t\t<code>" . \wp_kses_post( $code_content ) . '</code>' . \PHP_EOL
				. "\t</pre>" . \PHP_EOL
				. $block['close'];
	}

	/**
	 * Sanitizes and cleans up code content by removing HTML artifacts.
	 *
	 * @param string $code_content The raw code content.
	 *
	 * @return string Cleaned code content.
	 */
	public function clean_code_content( string $code_content ): string {
		// Clean up the code content.
		$code_content = \trim( $code_content );

		// Bail if the code content is empty.
		if ( $code_content === '' ) {
			return '';
		}

		// Remove HTML tags that might be part of the styling but not the code.
		$code_content = \preg_replace( '/<\/p>/', \PHP_EOL, $code_content );
		$code_content = \preg_replace( '/<p[^>]*>/', '', $code_content );

		// Strip all span tags - first explicitly remove opening and closing tags that might be at beginning/end.
		$code_content = \preg_replace( '/^<\/?span[^>]*>/', '', $code_content );
		$code_content = \preg_replace( '/<\/?span[^>]*>$/', '', $code_content );

		// Final cleaup - Balance the tags.
		$code_content = \force_balance_tags( $code_content );

		// Remove the markers for the code block.
		$code_content = \str_replace( '&#60419;', '', $code_content );
		$code_content = \str_replace( '&#60418;', '', $code_content );

		return $code_content;
	}

	/**
	 * Extracts an image from a paragraph element.
	 *
	 * @param DOMElement $paragraph The paragraph element.
	 *
	 * @return string The image block if found, null otherwise.
	 */
	public function extract_image_from_paragraph( ?DOMElement $paragraph ): string {
		if ( $paragraph === null ) {
			return '';
		}

		// First check for direct img elements.
		$imgs = $paragraph->getElementsByTagName( 'img' );

		// Check for spans that contain images.
		$spans = $paragraph->getElementsByTagName( 'span' );

		if ( $spans->length === 0 ) {
			return '';
		}

		foreach ( $spans as $span ) {
			$imgs = $span->getElementsByTagName( 'img' );

			if ( $imgs->length > 0 ) {
				$img = $imgs->item( 0 );

				// Get the original image source and alt.
				$src = $img->getAttribute( 'src' );
				$alt = $img->getAttribute( 'alt' );

				// Check for style attributes that might indicate image dimensions.
				$style  = $img->getAttribute( 'style' );
				$width  = null;
				$height = null;

				// Parse dimensions from style attribute.
				if ( \preg_match( '/width:\s*([0-9]+(?:\.[0-9]+)?)(px|%|em|rem|vw|vh)?/', $style, $width_matches ) ) {
					$width = $width_matches[1];
				}

				if ( \preg_match( '/height:\s*([0-9]+(?:\.[0-9]+)?)(px|%|em|rem|vw|vh)?/', $style, $height_matches ) ) {
					$height = $height_matches[1];
				}

				// Also check for width/height attributes.
				if ( ! $width ) {
					$width = $img->getAttribute( 'width' );
				}

				if ( ! $height ) {
					$height = $img->getAttribute( 'height' );
				}

				// Build block attributes.
				$json_attrs = [
					'id'       => 0,
					'sizeSlug' => 'large',
				];

				if ( $width && \is_numeric( $width ) ) {
					$json_attrs['width'] = \absint( $width );
				}

				if ( $height && \is_numeric( $height ) ) {
					$json_attrs['height'] = \absint( $height );
				}

				$image_block = $this->create_block_comments( 'image', $json_attrs );

				// Create the image block.
				return $image_block['open'] . \PHP_EOL
						. '<figure class="wp-block-image size-large">' . \PHP_EOL
							. '<img src="' . \esc_url( $src ) . '" alt="' . \esc_attr( $alt ) . '" />' . \PHP_EOL
						. '</figure>' . \PHP_EOL
						. $image_block['close'];
			}
		}

		return '';
	}

	/**
	 * Creates a separator block.
	 *
	 * @return string The separator block.
	 */
	public function create_separator_block(): string {
		$block = $this->create_block_comments( 'separator' );

		return $block['open'] . \PHP_EOL . "\t<hr class=\"wp-block-separator has-alpha-channel-opacity\"/>" . \PHP_EOL . $block['close'];
	}

	/**
	 * Creates a paragraph with a link.
	 *
	 * @param DOMElement|null $anchor The node element interpreted as an anchor.
	 *
	 * @return string The paragraph block with a link.
	 */
	public function create_paragraph_with_link( ?DOMElement $anchor ): string {
		if ( $anchor === null ) {
			return '';
		}

		$href = $anchor->getAttribute( 'href' );
		$text = $anchor->textContent;

		$block = $this->create_block_comments( 'paragraph' );

		return $block['open'] . \PHP_EOL
				. '<p><a href="' . \esc_url( $href ) . '">' . \esc_html( $text ) . '</a></p>' . \PHP_EOL
				. $block['close'];
	}

	/**
	 * Creates a paragraph block from a p element.
	 *
	 * @param DOMElement|null    $paragraph     The paragraph element.
	 * @param DOM_Processor|null $dom_processor The DOM processor instance.
	 *
	 * @return string The paragraph block.
	 */
	public function create_paragraph_block( ?DOMElement $paragraph, ?DOM_Processor $dom_processor ): string {
		if ( $paragraph === null || $dom_processor === null ) {
			return '';
		}

		$content = $dom_processor->process_inline_elements( $paragraph );

		// Check for text alignment in inline styles.
		$block_attrs = [];
		$style       = $dom_processor->get_style_attribute( $paragraph, false );

		// Process alignment from inline style.
		if ( \preg_match( '/text-align:\s*(center|right|left)/i', $style, $matches ) ) {
			$block_attrs['align'] = $matches[1];
		}

		// Get block comments with attributes.
		$block = $this->create_block_comments( 'paragraph', $block_attrs );

		// Get the paragraph class and style.
		$p_class = $dom_processor->get_class_attribute( $paragraph );
		$p_style = $dom_processor->get_style_attribute( $paragraph );

		return $block['open'] . \PHP_EOL
				. "\t<p" . \wp_kses_data( $p_class . $p_style ) . '>' . \wp_kses_post( $content ) . '</p>' . \PHP_EOL
				. $block['close'];
	}

	/**
	 * Creates a table block from a table element.
	 *
	 * @param DOMElement|null    $table         The table element.
	 * @param DOM_Processor|null $dom_processor The DOM processor instance.
	 *
	 * @return string The table block.
	 */
	public function create_table_block( ?DOMElement $table, ?DOM_Processor $dom_processor ): string {
		if ( $table === null || $dom_processor === null ) {
			return '';
		}

		// First, get all rows from the table, regardless of where they are.
		$all_rows = $table->getElementsByTagName( 'tr' );

		if ( $all_rows->length === 0 ) {
			return '';
		}

		// Initialize arrays to store table data.
		$all_row_data     = [];
		$header_row_count = 0;

		// Process all rows.
		foreach ( $all_rows as $row_index => $row ) {
			$row_data      = [];
			$is_header_row = false;

			// Check if this is a header row.
			// Consider it a header if it's in a thead or if it has th cells.
			$parent = $row->parentNode;

			if ( $parent && $parent->nodeName === 'thead' ) {
				$is_header_row = true;
			}

			// Get all cells in this row (both th and td).
			$th_cells = $row->getElementsByTagName( 'th' );
			$td_cells = $row->getElementsByTagName( 'td' );

			// If there are th cells, this might be a header row.
			if ( $th_cells->length > 0 ) {
				$is_header_row = true;
			}

			// Process all cells in the row.
			$cells = ( $th_cells->length > 0 ) ? $th_cells : $td_cells;

			foreach ( $cells as $cell ) {
				// Get attributes we want to preserve.
				$colspan = $cell->getAttribute( 'colspan' );
				$rowspan = $cell->getAttribute( 'rowspan' );

				// Get the cell's HTML content.
				$cell_html = $dom_processor->process_inline_elements( $cell );

				// Store cell data with attributes.
				$cell_data = [
					'content'    => $cell_html,
					'attributes' => [
						'colspan' => ( $colspan !== '' ) ? \absint( $colspan ) : null,
						'rowspan' => ( $rowspan !== '' ) ? \absint( $rowspan ) : null,
					],
				];

				$row_data[] = $cell_data;
			}

			// Skip empty rows.
			if ( empty( $row_data ) ) {
				continue;
			}

			// Store the row data with a flag indicating if it's a header.
			$all_row_data[] = [
				'cells'     => $row_data,
				'is_header' => $is_header_row,
			];

			// Count header rows.
			if ( $is_header_row ) {
				++$header_row_count;
			}
		}

		// If we have no data, return empty string.
		if ( empty( $all_row_data ) ) {
			return '';
		}

		// Determine max columns considering colspan attributes.
		$max_columns = 0;

		foreach ( $all_row_data as $row ) {
			$row_cols = 0;

			foreach ( $row['cells'] as $cell ) {
				$colspan   = ( $cell['attributes']['colspan'] !== '' ) ? $cell['attributes']['colspan'] : 1;
				$row_cols += $colspan;
			}

			$max_columns = \max( $max_columns, $row_cols );
		}

		// Build the Gutenberg table block.
		$block  = '<!-- wp:table -->';
		$block .= '<figure class="wp-block-table"><table>';

		// If we have header rows, add them to thead.
		if ( $header_row_count > 0 ) {
			$block .= '<thead>';

			$header_rows_processed = 0;

			foreach ( $all_row_data as $row_index => $row ) {
				if ( $row['is_header'] ) {
					$block .= '<tr>';

					foreach ( $row['cells'] as $cell ) {
						$attrs = '';

						if ( $cell['attributes']['colspan'] && $cell['attributes']['colspan'] > 1 ) {
							$attrs .= ' colspan="' . \esc_attr( $cell['attributes']['colspan'] ) . '"';
						}

						if ( $cell['attributes']['rowspan'] && $cell['attributes']['rowspan'] > 1 ) {
							$attrs .= ' rowspan="' . \esc_attr( $cell['attributes']['rowspan'] ) . '"';
						}

						$is_cell_empty = \trim( \wp_strip_all_tags( $cell['content'] ) );

						if ( $is_cell_empty === '' ) {
							$cell['content'] = '';
						}

						$block .= '<th' . $attrs . '>' . \wp_kses_post( $cell['content'] ) . '</th>';
					}

					$block .= '</tr>';

					++$header_rows_processed;

					// Remove the row from all_row_data to avoid duplication.
					unset( $all_row_data[ $row_index ] );

					// If we've processed all header rows, stop.
					if ( $header_rows_processed >= $header_row_count ) {
						break;
					}
				}
			}

			$block .= '</thead>';
		}

		// Add tbody with remaining rows.
		$block .= '<tbody>';

		// If we have no body rows, add an empty row.
		if ( empty( $all_row_data ) ) {
			$block .= '<tr>';
			$block .= \str_repeat( '<td></td>', $max_columns );
			$block .= '</tr>';
		}
		else {
			// Add all remaining rows to tbody (reset array keys first).
			$all_row_data = \array_values( $all_row_data );

			foreach ( $all_row_data as $row ) {
				$block .= '<tr>';

				foreach ( $row['cells'] as $cell ) {
					$attrs = '';

					if ( $cell['attributes']['colspan'] && $cell['attributes']['colspan'] > 1 ) {
						$attrs .= ' colspan="' . \esc_attr( $cell['attributes']['colspan'] ) . '"';
					}

					if ( $cell['attributes']['rowspan'] && $cell['attributes']['rowspan'] > 1 ) {
						$attrs .= ' rowspan="' . \esc_attr( $cell['attributes']['rowspan'] ) . '"';
					}

					$is_cell_empty = \trim( \wp_strip_all_tags( $cell['content'] ) );

					if ( $is_cell_empty === '' ) {
						$cell['content'] = '';
					}

					$block .= '<td' . $attrs . '>' . \wp_kses_post( $cell['content'] ) . '</td>';
				}

				$block .= '</tr>';
			}
		}

		$block .= '</tbody>';
		$block .= '</table></figure>';
		$block .= '<!-- /wp:table -->';

		return $block;
	}

	/**
	 * Creates a heading block from a heading element.
	 *
	 * @param DOMElement|null    $heading       The heading element.
	 * @param DOM_Processor|null $dom_processor The DOM processor instance.
	 *
	 * @return string The heading block.
	 */
	public function create_heading_block( ?DOMElement $heading, ?DOM_Processor $dom_processor ): string {
		if ( $heading === null || $dom_processor === null ) {
			return '';
		}

		$level = \substr( $heading->nodeName, 1, 1 );

		// Process inline formatting elements instead of using plain text.
		$content = $dom_processor->process_inline_elements( $heading );

		// Check for text alignment in style attribute.
		$style       = $dom_processor->get_style_attribute( $heading, false );
		$block_attrs = [ 'level' => \absint( $level ) ];
		$alignment   = null;

		// Process alignment from inline style.
		if ( \preg_match( '/text-align:\s*(center|right|left)/i', $style, $matches ) ) {
			$alignment            = $matches[1];
			$block_attrs['align'] = $alignment;

			// Remove the text-align property from the style attribute.
			$style = \preg_replace( '/text-align:\s*(center|right|left)(;|$)/i', '', $style );
			$style = \trim( $style, " \t\n\r\0\x0B;" );
		}

		// Get the heading id attribute.
		$id_attr = $heading->getAttribute( 'id' );
		$id_html = ! empty( $id_attr ) ? ' id="' . \wp_kses_data( $id_attr ) . '"' : '';

		// Get the heading style attribute.
		$style_attr = ! empty( $style ) ? ' style="' . \wp_kses_data( $style ) . '"' : '';

		// Start with required wp-block-heading class.
		$classes = 'wp-block-heading';

		// Add alignment class if needed.
		if ( $alignment ) {
			$classes .= ' has-text-align-' . \esc_attr( $alignment );
		}

		// Get block comments.
		$block = $this->create_block_comments( 'heading', $block_attrs );

		return $block['open'] . \PHP_EOL
				. "\t<h" . $level . ' class="' . $classes . '"' . $id_html . $style_attr . '>' . \wp_kses_post( $content ) . '</h' . $level . '>' . \PHP_EOL
				. $block['close'];
	}

	/**
	 * Creates a list block from a list element (ul or ol).
	 *
	 * @param DOMElement|null    $list_element  The list element.
	 * @param DOM_Processor|null $dom_processor The DOM processor instance.
	 *
	 * @return string The list block.
	 */
	public function create_list_block( ?DOMElement $list_element, ?DOM_Processor $dom_processor ): string {
		if ( $list_element === null || empty( $list_element ) || $dom_processor === null ) {
			return '';
		}

		// Determine list type.
		$is_ordered = $list_element->nodeName === 'ol';

		// Create block attributes.
		$attrs = ( $is_ordered === true ) ? [ 'ordered' => true ] : [];

		// Get block comments.
		$block = $this->create_block_comments( 'list', $attrs );

		// Start the list block.
		$output  = $block['open'] . \PHP_EOL;
		$output .= '<' . $list_element->nodeName . ' class="wp-block-list">';

		// Process all list items.
		foreach ( $list_element->childNodes as $child ) {
			if ( $child->nodeType !== \XML_ELEMENT_NODE || $child->nodeName !== 'li' ) {
				continue;
			}

			// Process this list item.
			$output .= $this->process_list_item( $child, $dom_processor );
		}

		// Close the list block.
		$output .= '</' . $list_element->nodeName . '>' . \PHP_EOL;
		$output .= $block['close'];

		return $output;
	}

	/**
	 * Process a list item and its content, including any nested lists.
	 *
	 * @param DOMElement|null    $list_item     The list item element.
	 * @param DOM_Processor|null $dom_processor The DOM processor instance.
	 *
	 * @return string The processed list item HTML with Gutenberg comments.
	 */
	public function process_list_item( ?DOMElement $list_item, ?DOM_Processor $dom_processor ): string {
		if ( $list_item === null || empty( $list_item ) || $dom_processor === null ) {
			return '';
		}

		// Start the list item block.
		$output  = '<!-- wp:list-item -->' . \PHP_EOL;
		$output .= '<li>';

		// Extract nested lists.
		$nested_lists = [];
		$content      = '';

		// First pass: separate content and nested lists.
		foreach ( $list_item->childNodes as $node ) {
			// Capture nested lists.
			if (
				$node->nodeType === \XML_ELEMENT_NODE
				&& ( $node->nodeName === 'ul' || $node->nodeName === 'ol' )
			) {
				$nested_lists[] = $node;
			}
			// Process content nodes (text or other elements).
			elseif ( $node->nodeType === \XML_TEXT_NODE ) {
				$text = \trim( $node->textContent );
				if ( ! empty( $text ) ) {
					$content .= $text;
				}
			}
			elseif ( $node->nodeType === \XML_ELEMENT_NODE ) {
				$content .= $dom_processor->get_node_html( $node );
			}
		}

		// Add the content.
		$output .= $content;

		// Process nested lists.
		foreach ( $nested_lists as $nested_list ) {
			// Always use unordered list for nested lists.
			$output .= '<!-- wp:list -->' . \PHP_EOL;
			$output .= '<ul class="wp-block-list">';

			// Process nested list items.
			foreach ( $nested_list->childNodes as $nested_child ) {
				if ( $nested_child->nodeType !== \XML_ELEMENT_NODE || $nested_child->nodeName !== 'li' ) {
					continue;
				}

				// Recursively process nested list items.
				$output .= $this->process_list_item( $nested_child, $dom_processor );
			}

			$output .= '</ul>' . \PHP_EOL;
			$output .= '<!-- /wp:list -->';
		}

		// Close the list item.
		$output .= '</li>' . \PHP_EOL;
		$output .= '<!-- /wp:list-item -->';

		return $output;
	}

	/**
	 * Creates a bookmark paragraph that can be shared via link.
	 *
	 * @param DOMElement|null $paragraph The paragraph element.
	 *
	 * @return string The bookmark paragraph block if found, null otherwise.
	 */
	public function create_bookmark_paragraph( ?DOMElement $paragraph ): string {
		if ( $paragraph === null ) {
			return '';
		}

		// Check if this matches our bookmark structure.
		$spans   = $paragraph->getElementsByTagName( 'span' );
		$anchors = $paragraph->getElementsByTagName( 'a' );

		// Must have exactly one span followed by an anchor with ID.
		if ( $spans->length === 0 || $anchors->length === 0 ) {
			return '';
		}

		$span   = $spans->item( 0 );
		$anchor = $anchors->item( 0 );

		// The anchor should have an ID and be empty.
		$anchor_id = $anchor->getAttribute( 'id' );

		// Ensure ID is present and anchor has no text content.
		// Prevent conflict with footnotes.
		if ( $anchor_id === '' || \trim( $anchor->textContent ) !== '' ) {
			return '';
		}

		// Get the span text content.
		$span_text = \trim( $span->textContent );

		if ( $span_text === '' ) {
			return '';
		}

		// Create a paragraph block with a link and an ID for the bookmark.
		$block = $this->create_block_comments( 'paragraph' );

		return $block['open'] . \PHP_EOL
				. '<p id="' . \esc_attr( $anchor_id ) . '">'
				. '<a href="' . \esc_url( '#' . $anchor_id ) . '" class="bookmark-anchor">'
				. \esc_html( $span_text )
				. '</a>'
				. '</p>' . \PHP_EOL
				. $block['close'];
	}
}
