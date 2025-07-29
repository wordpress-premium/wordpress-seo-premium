<?php
// Snake case is globally ignored for this file since its uses DOMDocument and DOMElement functions which are in camelCase.
// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use DOMElement;

/**
 * Nested_List_Creator class.
 */
class Nested_List_Creator {

	/**
	 * Processes nested lists in the given element.
	 *
	 * @param DOMElement|null $elements The elements to process.
	 *
	 * @return array{list_groups: array<int, array<string, string|int|array>>, nodes_to_skip: array<DOMElement>} The nested list groups and nodes to skip.
	 */
	public function process_nested_lists( ?DOMElement $elements ): array {
		if ( $elements === null ) {
			return [
				'list_groups'   => [],
				'nodes_to_skip' => [],
			];
		}

		// Track nested list structures that require special processing.
		$list_groups   = [];
		$current_group = null;
		$nodes_to_skip = []; // Nodes that will be processed as part of nested lists.

		// Position tracking system to maintain the original document order.
		// This is critical for proper rendering of mixed content types.
		$node_tracker     = []; // Track nodes by position instead of using them as keys.
		$current_position = 0;

		// Keep track of lists at each level for handling start attributes.
		$list_levels = [];

		if ( $elements->childNodes->length !== 0 ) {
			// PHASE 1: First pass to identify nested list groups and track positions.
			// Lists with the same prefix and consecutive levels form a nested structure.
			// Ignoring the snake_case naming convention for this variable since its set by the DOM parser.
			foreach ( $elements->childNodes as $node_index => $node ) {
				// Skip non-element nodes for list detection.
				if ( $node->nodeType !== \XML_ELEMENT_NODE ) {
					continue;
				}

				// Track this node's position in the document.
				$node_tracker[] = [
					'node'     => $node,
					'position' => $current_position++,
				];

				// Get position index (array index corresponds to position).
				$node_position = ( \count( $node_tracker ) - 1 );

				// Check if this is a list that might be part of a nested structure.
				if (
					( $node->nodeName === 'ul' || $node->nodeName === 'ol' )
					&& $this->has_nesting_class( $node )
				) {

					// Get the nesting prefix, level, and start information.
					list( $prefix, $level, $is_start, $start_number ) = $this->get_list_nesting_info( $node );

					// Create a unique key for this prefix+level combination.
					$level_key = $prefix . $level;

					// Start a new group if we don't have one or if this list doesn't share the prefix.
					if ( $current_group === null || $current_group['prefix'] !== $prefix ) {
						// Store the previous group if it exists.
						if ( $current_group !== null ) {
							$list_groups[] = $current_group;
						}

						// Start a new group.
						$current_group = [
							'prefix'     => $prefix,
							'lists'      => [
								[
									'node'         => $node,
									'level'        => $level,
									'node_index'   => $node_index,
									'is_start'     => $is_start,
									'start_number' => $start_number,
								],
							],
							'position'   => $node_position,
							'level_info' => [ $level_key => 1 ], // Track count of lists at each level.
						];

						// Initialize list level trackers.
						$list_levels[ $prefix ] = [
							$level => [
								'current_list' => 0,  // Index in the list group.
								'current_item' => 0,   // Current item count at this level.
							],
						];

					}
					else {
						// We're continuing with the same prefix, check level information.

						// Update the level counter.
						if ( ! isset( $current_group['level_info'][ $level_key ] ) ) {
							$current_group['level_info'][ $level_key ] = 1;
						}
						else {
							++$current_group['level_info'][ $level_key ];
						}

						// Add to the current group.
						$current_group['lists'][] = [
							'node'         => $node,
							'level'        => $level,
							'node_index'   => $node_index,
							'is_start'     => $is_start,
							'start_number' => $start_number,
						];

						// Initialize this level if it doesn't exist yet.
						if ( ! isset( $list_levels[ $prefix ][ $level ] ) ) {
							$list_levels[ $prefix ][ $level ] = [
								'current_list' => ( \count( $current_group['lists'] ) - 1 ),
								'current_item' => 0,
							];
						}
					}

					// Mark this node to be skipped in the main processing loop
					// as it will be processed as part of a nested list.
					$nodes_to_skip[] = $node;
				}
				elseif ( $current_group !== null ) {
					// Non-list element encountered, store the current group and reset.
					$list_groups[] = $current_group;
					$current_group = null;
				}
			}
		}

		// Add the last group if it exists.
		if ( $current_group !== null ) {
			$list_groups[] = $current_group;
		}

		// Sort list groups by position to maintain document order.
		\usort(
			$list_groups,
			static function ( $a, $b ) {
				return ( $a['position'] - $b['position'] );
			}
		);

		return [
			'list_groups'   => $list_groups,
			'nodes_to_skip' => $nodes_to_skip,
		];
	}

	/**
	 * Checks if a list element has a class indicating it's part of a nested structure.
	 *
	 * @param DOMElement $list_element The list element to check.
	 *
	 * @return bool Whether the list has a nesting class.
	 */
	private function has_nesting_class( DOMElement $list_element ): bool {
		if ( empty( $list_element ) ) {
			return false;
		}

		$class = $list_element->getAttribute( 'class' );

		// Check for classes like 'lst-kix_*'.
		return (bool) \preg_match( '/lst-[a-zA-Z0-9_]+-\d+/', $class );
	}

	/**
	 * Gets the nesting information (prefix and level) from a list's class.
	 *
	 * @param DOMElement $list_element The list element.
	 *
	 * @return array{prefix: string, level: int, is_start: bool, start_number: int} An array containing the prefix, level, and whether it's a start list.
	 */
	private function get_list_nesting_info( DOMElement $list_element ): array {
		if ( empty( $list_element ) ) {
			return [ '', 0, false, 1 ];
		}

		$class        = $list_element->getAttribute( 'class' );
		$prefix       = '';
		$level        = 0;
		$start_number = 1;

		// Check if this list has a "start" class.
		$is_start = \strpos( $class, 'start' ) !== false;

		// Get the start attribute if it exists.
		$start_attr = $list_element->getAttribute( 'start' );

		if ( ! empty( $start_attr ) && \is_numeric( $start_attr ) ) {
			$start_number = \absint( $start_attr );
		}

		// Extract nesting information from classes like 'lst-kix_ttyq3pf6h3x3-0'.
		if ( \preg_match( '/(lst-[a-zA-Z0-9_]+-)(\d+)/', $class, $matches ) ) {
			$prefix = $matches[1]; // e.g., 'lst-kix_ttyq3pf6h3x3-'.
			$level  = \absint( $matches[2] ); // e.g., 0, 1, 2, ...
		}

		return [ $prefix, $level, $is_start, $start_number ];
	}

	/**
	 * Gets the list items from a list element.
	 *
	 * @param DOMElement    $list_element  The list element.
	 * @param DOM_Processor $dom_processor The DOM processor instance.
	 *
	 * @return array<string> Array of list item content.
	 */
	private function get_list_items( DOMElement $list_element, DOM_Processor $dom_processor ): array {
		if ( empty( $list_element ) ) {
			return [];
		}

		$items = [];

		foreach ( $list_element->childNodes as $child ) {
			if ( $child->nodeType !== \XML_ELEMENT_NODE || $child->nodeName !== 'li' ) {
				continue;
			}

			$items[] = $dom_processor->process_inline_elements( $child );
		}

		return $items;
	}

	/**
	 * Creates a nested list block from a group of consecutive lists with nesting indicators.
	 *
	 * This method handles complex nested list structures by:
	 * 1. Organizing lists by their nesting level.
	 * 2. Preserving the original document order.
	 * 3. Building a nested structure that matches the semantic hierarchy.
	 *
	 * @param array<int, array<string, string|int|array>> $lists             Array of list information.
	 * @param Content_Processor|null                      $content_processor The content processor instance.
	 * @param DOM_Processor|null                          $dom_processor     The DOM processor instance.
	 *
	 * @return string The nested list block.
	 */
	public function create_nested_list_block( array $lists, ?Content_Processor $content_processor, ?DOM_Processor $dom_processor ): string {
		if ( empty( $lists ) || $content_processor === null || $dom_processor === null ) {
			return '';
		}

		// First, preserve the original order of lists.
		\usort(
			$lists,
			static function ( $a, $b ) {
				return ( $a['node_index'] - $b['node_index'] );
			}
		);

		// Group lists by level.
		$lists_by_level = [];

		foreach ( $lists as $list_index => $list ) {
			$level = $list['level'];

			if ( ! isset( $lists_by_level[ $level ] ) ) {
				$lists_by_level[ $level ] = [];
			}

			$lists_by_level[ $level ][] = [
				'list'     => $list,
				'index'    => $list_index, // Original index in the full lists array.
				'items'    => $this->get_list_items( $list['node'], $dom_processor ),
				'type'     => $list['node']->nodeName, // ol or ul.
				'start'    => isset( $list['start_number'] ) ? $list['start_number'] : 1,
				'is_start' => isset( $list['is_start'] ) ? $list['is_start'] : false,
			];
		}

		// Sort level groups by level (ascending).
		\ksort( $lists_by_level );

		// Get the minimum level - this is our top level.
		$min_level = \min( \array_keys( $lists_by_level ) );

		// Start with the top level list.
		$top_lists = $lists_by_level[ $min_level ];

		// Determine if the top level is ordered.
		$is_top_ordered = $top_lists[0]['type'] === 'ol';

		// Create block comments.
		$block = $content_processor->create_block_comments( 'list', ( $is_top_ordered === true ) ? [ 'ordered' => true ] : [] );

		// Start building the output.
		$output  = $block['open'] . \PHP_EOL;
		$output .= ( $is_top_ordered === true ) ? '<ol class="wp-block-list">' : '<ul class="wp-block-list">';

		// Track the processed lists to avoid duplication.
		$processed_lists = [];

		if ( ! empty( $top_lists ) ) {
			// Process each top-level list.
			foreach ( $top_lists as $top_list ) {
				$current_list_pos  = $top_list['index'];
				$processed_lists[] = $current_list_pos;

				// Get all list items for this list.
				$items      = $top_list['items'];
				$item_count = \count( $items );

				if ( empty( $items ) ) {
					continue;
				}

				// Process each list item but handle nested lists only on the last item.
				foreach ( $items as $item_index => $item_content ) {
					$item_block = $content_processor->create_block_comments( 'list-item' );
					$output    .= $item_block['open'] . \PHP_EOL;
					$output    .= '<li>' . $item_content;

					// Only check for nested lists on the last item of the list.
					if ( $item_index === ( $item_count - 1 ) ) {
						// Check if there's a nested list that should appear after this list.
						// Next level would be current level + 1.
						$next_level = ( $min_level + 1 );

						if ( isset( $lists_by_level[ $next_level ] ) ) {
							$has_nested      = false;
							$next_list_index = null;

							// Find the first list at the next level that appears after this list.
							foreach ( $lists_by_level[ $next_level ] as $nested_list_index => $nested_list ) {
								if (
									$nested_list['index'] > $current_list_pos
									&& ! \in_array( $nested_list['index'], $processed_lists, true )
								) {
									$has_nested      = true;
									$next_list_index = $nested_list_index;
									break;
								}
							}

							if ( $has_nested && $next_list_index !== null ) {
								// Get the nested list.
								$nested_list       = $lists_by_level[ $next_level ][ $next_list_index ];
								$processed_lists[] = $nested_list['index'];

								// Add the nested list.
								$output .= $this->build_nested_list_structure( $nested_list, $lists_by_level, $processed_lists, $content_processor );
							}
						}
					}

					$output .= '</li>' . \PHP_EOL;
					$output .= $item_block['close'];
				}
			}
		}

		// Close the list.
		$output .= ( $is_top_ordered === true ) ? '</ol>' : '</ul>';
		$output .= \PHP_EOL . $block['close'];

		return $output;
	}

	/**
	 * Builds a nested list structure recursively.
	 *
	 * This method recursively processes nested lists at deeper levels by:
	 * 1. Creating properly nested <ul> tags (Gutenberg uses <ul> for all nested lists).
	 * 2. Tracking processed lists to avoid duplication.
	 * 3. Connecting lists at the same level with their children at deeper levels.
	 *
	 * @param array<string, string|int|array>        $current_list      The current list.
	 * @param array<array<string, string|int|array>> $lists_by_level    All lists organized by level.
	 * @param array<int>                             &$processed_lists  Array of processed list indices to avoid duplication.
	 * @param Content_Processor                      $content_processor The content processor instance.
	 *
	 * @return string The nested list HTML.
	 */
	private function build_nested_list_structure( array $current_list, array $lists_by_level, array &$processed_lists, Content_Processor $content_processor ): string {
		// Get block comments.
		$block = $content_processor->create_block_comments( 'list' );

		// Start building the nested list - always unordered in Gutenberg.
		$output  = $block['open'] . \PHP_EOL;
		$output .= '<ul class="wp-block-list">';

		// Process all items in this list.
		$items              = $current_list['items'];
		$item_count         = \count( $items );
		$current_list_pos   = $current_list['index'];
		$current_list_level = isset( $current_list['list']['level'] ) ? $current_list['list']['level'] : null;

		// If we don't have level info, try to extract it from the lists_by_level array.
		if ( $current_list_level === null && ! empty( $lists_by_level ) ) {
			foreach ( $lists_by_level as $level => $lists ) {
				foreach ( $lists as $list ) {
					if ( $list['index'] === $current_list_pos ) {
						$current_list_level = $level;
						break 2;
					}
				}
			}
		}

		if ( ! empty( $items ) ) {
			// Process each item in this list.
			foreach ( $items as $item_index => $item_content ) {
				$item_block = $content_processor->create_block_comments( 'list-item' );
				$output    .= $item_block['open'] . \PHP_EOL;
				$output    .= '<li>' . $item_content;

				// Only check for nested lists on the last item of the list.
				if ( $item_index === ( $item_count - 1 ) && $current_list_level !== null ) {
					// Next level is current + 1.
					$next_level = ( $current_list_level + 1 );

					if ( isset( $lists_by_level[ $next_level ] ) ) {
						$has_nested      = false;
						$next_list_index = null;

						// Find the first list at the next level that appears after this list.
						foreach ( $lists_by_level[ $next_level ] as $nested_list_index => $nested_list ) {
							if ( $nested_list['index'] > $current_list_pos && ! \in_array( $nested_list['index'], $processed_lists, true ) ) {
								$has_nested      = true;
								$next_list_index = $nested_list_index;
								break;
							}
						}

						if ( $has_nested && $next_list_index !== null ) {
							// Get the nested list.
							$nested_list       = $lists_by_level[ $next_level ][ $next_list_index ];
							$processed_lists[] = $nested_list['index'];

							// Recursively process deeper nested lists.
							$output .= $this->build_nested_list_structure( $nested_list, $lists_by_level, $processed_lists, $content_processor );
						}
					}
				}

				$output .= '</li>' . \PHP_EOL;
				$output .= $item_block['close'];
			}
		}

		// Close the list.
		$output .= '</ul>' . \PHP_EOL;
		$output .= $block['close'];

		return $output;
	}
}
