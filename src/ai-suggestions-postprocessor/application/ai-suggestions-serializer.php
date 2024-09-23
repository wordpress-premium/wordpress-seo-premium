<?php

namespace Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application;

use DOMDocument;

/**
 * Class used to serialize the output dom to a string.
 */
class AI_Suggestions_Serializer {

	/**
	 * Serializes the output DOM to a string.
	 *
	 * @param DOMDocument $dom The output dom.
	 *
	 * @return string The serialized output dom.
	 */
	public function serialize( DOMDocument $dom ): string {
		$output_dom = new DOMDocument();
		$nodes      = $dom->getElementsByTagName( 'body' )->item( 0 )->childNodes;
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		foreach ( $nodes as $node ) {
			if ( $node->nodeName !== 'meta' ) {
				$node = $output_dom->importNode( $node, true );
				$output_dom->appendChild( $node );
			}
		}
		// phpcs:enable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		return \html_entity_decode( \rtrim( $output_dom->saveHTML() ), \ENT_QUOTES, \get_bloginfo( 'charset' ) );
	}
}
