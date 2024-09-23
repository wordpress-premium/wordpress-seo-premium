<?php

namespace Yoast\WP\SEO\Premium\DOM_Manager\Application;

use DOMElement;

/**
 * Class implementing the processing elements used to unify the AI suggestions.
 */
class Node_Processor {

	/**
	 * Unwrap the input node
	 *
	 * @param DOMElement $node The node to unwrap.
	 *
	 * @return void
	 */
	public function unwrap( DOMElement $node ): void {
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$parent = $node->parentNode;
		while ( $node->hasChildNodes() ) {
			$child = $node->removeChild( $node->firstChild );
			$parent->insertBefore( $child, $node );
		}
		// phpcs:enable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$parent->removeChild( $node );
	}

	/**
	 * Remove the input node
	 *
	 * @param DOMElement $node The node to remove.
	 *
	 * @return void
	 */
	public function remove( DOMElement $node ): void {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$parent = $node->parentNode;
		$parent->removeChild( $node );
	}
}
