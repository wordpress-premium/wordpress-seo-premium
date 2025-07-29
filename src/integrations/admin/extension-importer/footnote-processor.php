<?php
// Snake case is globally ignored for this file since its uses DOMDocument and DOMElement functions which are in camelCase.
// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use DOMDocument;

/**
 * Footnote_Processor class.
 */
class Footnote_Processor {

	/**
	 * Footnotes extracted from content.
	 *
	 * @var array<int, array<string, string>>
	 */
	public $footnotes = [];

	/**
	 * Mapping of original footnote IDs to UUIDs.
	 *
	 * @var array<string, string>
	 */
	public $footnote_id_map = [];

	/**
	 * The constructor.
	 *
	 * @param DOMDocument|null $dom The DOM document.
	 *
	 * @return void
	 */
	public function convert_footnotes( ?DOMDocument $dom ) {
		// Bail if the dom is null.
		if ( $dom === null ) {
			return;
		}

		// First, extract any footnotes found in the content.
		$this->extract_footnotes( $dom );
		// Process footnote references in the content.
		$this->process_footnote_references( $dom );
	}

	/**
	 * Extracts footnotes from the HTML document.
	 *
	 * This method identifies and extracts footnotes by:
	 * 1. Finding anchors with IDs that match footnote patterns (ftnt*).
	 * 2. Extracting the footnote content from the surrounding paragraphs.
	 * 3. Generating UUIDs for each footnote and maintaining a mapping to original IDs.
	 * 4. Removing the footnote elements from the DOM so they don't appear in the content.
	 *
	 * @param DOMDocument $dom The DOM document.
	 *
	 * @return void
	 */
	private function extract_footnotes( DOMDocument $dom ): void {
		// Find elements by tag and attribute without traversing the whole document repeatedly.
		$processed_ids      = [];
		$elements_to_remove = [];

		// First, let's find all anchors with IDs that look like footnote IDs.
		$all_anchors  = $dom->getElementsByTagName( 'a' );
		$footnote_ids = [];

		foreach ( \iterator_to_array( $all_anchors ) as $anchor ) {
			$id = $anchor->getAttribute( 'id' );

			// If the anchor ID matches the footnote ID pattern.
			if ( \strpos( $id, 'ftnt' ) === 0 && ! isset( $processed_ids[ $id ] ) ) {
				// Check if this is inside a paragraph.
				$parent = $anchor->parentNode;

				while ( $parent && $parent->nodeName !== 'body' ) {
					if ( $parent->nodeName === 'p' ) {
						// This is a footnote paragraph.
						$grand_parent = $parent->parentNode;

						if ( $grand_parent && $grand_parent->nodeName === 'div' ) {
							// Store the div for processing.
							$footnote_ids[ $id ] = [
								'anchor'    => $anchor,
								'paragraph' => $parent,
								'div'       => $grand_parent,
							];

							$processed_ids[ $id ] = true;

							// Try to find the preceding HR - often indicates footnote section.
							$prev_sibling = $grand_parent->previousSibling;

							while ( $prev_sibling ) {
								if ( $prev_sibling->nodeType === \XML_ELEMENT_NODE ) {
									if ( $prev_sibling->nodeName === 'hr' ) {
										$footnote_ids[ $id ]['hr'] = $prev_sibling;
										break;
									}

									break;
								}
								$prev_sibling = $prev_sibling->previousSibling;
							}

							break;
						}
					}
					$parent = $parent->parentNode;
				}
			}
		}

		// Process each footnote we've found.
		$processed_divs = [];
		$processed_hrs  = [];

		foreach ( $footnote_ids as $id => $data ) {
			$anchor = $data['anchor'];
			$div    = $data['div'];

			// Skip if we've already processed this div.
			if ( isset( $processed_divs[ $div->getNodePath() ] ) ) {
				continue;
			}

			// Get the footnote content.
			$content      = '';
			$current_node = $anchor->nextSibling;

			while ( $current_node ) {
				if ( $current_node->nodeType === \XML_TEXT_NODE ) {
					$content .= $current_node->nodeValue;
				}
				elseif ( $current_node->nodeType === \XML_ELEMENT_NODE ) {
					$content .= $current_node->textContent;
				}

				$current_node = $current_node->nextSibling;
			}

			// Clean up the content.
			$content = \trim( $content );

			// Remove non-breaking spaces and other problematic characters at the beginning.
			$content = \preg_replace( '/^[\x00-\x20\xA0]+/u', '', $content );

			// Generate a UUID for this footnote.
			$uuid = \wp_generate_uuid4();

			// Map the original ID to the UUID.
			$this->footnote_id_map[ $id ] = $uuid;

			// Store the footnote with the original ID preserved.
			$this->footnotes[] = [
				'content' => $content,
				'id'      => $uuid,
				'href'    => $id,
			];

			// Mark div as processed.
			$processed_divs[ $div->getNodePath() ] = true;
			$elements_to_remove[]                  = $div;

			// Mark HR for removal if found.
			if ( isset( $data['hr'] ) && ! isset( $processed_hrs[ $data['hr']->getNodePath() ] ) ) {
				$elements_to_remove[]                        = $data['hr'];
				$processed_hrs[ $data['hr']->getNodePath() ] = true;
			}
		}

		// Remove all identified elements from the DOM.
		foreach ( $elements_to_remove as $element ) {
			if ( $element->parentNode ) {
				$element->parentNode->removeChild( $element );
			}
		}
	}

	/**
	 * Process footnote references in the content by updating href values to use UUIDs.
	 *
	 * This method connects footnote references in the text with their footnote content by:
	 * 1. Finding all links that point to footnote IDs (#ftnt*).
	 * 2. Updating those links to use the UUID system.
	 * 3. Setting appropriate ID attributes for the footnote system to work.
	 *
	 * @param DOMDocument $dom The DOM document.
	 *
	 * @return void
	 */
	private function process_footnote_references( DOMDocument $dom ): void {
		if ( empty( $this->footnote_id_map ) ) {
			return;
		}

		// Find all anchors that reference footnotes.
		$anchors            = $dom->getElementsByTagName( 'a' );
		$anchors_to_process = [];

		// Build a list first to avoid issues with the live collection during modification.
		foreach ( $anchors as $anchor ) {
			$href = $anchor->getAttribute( 'href' );

			// Check if this is a footnote reference (links to #ftnt1, etc.).
			if ( \strpos( $href, '#ftnt' ) === 0 ) {
				$anchors_to_process[] = $anchor;
			}
		}

		// Now update all footnote references.
		foreach ( $anchors_to_process as $anchor ) {
			$href      = $anchor->getAttribute( 'href' );
			$target_id = \substr( $href, 1 ); // Remove the leading #.

			// If we have a UUID for this footnote reference.
			if ( isset( $this->footnote_id_map[ $target_id ] ) ) {
				$uuid = $this->footnote_id_map[ $target_id ];

				// Set the ID to the UUID with "-link" suffix (WordPress footnote convention).
				$anchor->setAttribute( 'id', \esc_attr( $uuid . '-link' ) );

				// Set href to the original footnote ID (without # prefix).
				$anchor->setAttribute( 'href', \esc_url( '#' . $uuid ) );
			}
		}
	}

	/**
	 * Resets the footnote processor.
	 *
	 * @return void
	 */
	public function reset(): void {
		$this->footnotes       = [];
		$this->footnote_id_map = [];
	}
}
