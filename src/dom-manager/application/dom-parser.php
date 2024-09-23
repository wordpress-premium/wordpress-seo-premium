<?php

namespace Yoast\WP\SEO\Premium\DOM_Manager\Application;

use DOMDocument;

/**
 * Class used to parse a string into a DOMDocument object.
 */
class DOM_Parser {

	/**
	 * Parses a string into a DOMDocument object
	 *
	 * @param string      $html_string The string to be parsed.
	 * @param string|null $charset     The charset of the string.
	 *
	 * @return DOMDocument
	 */
	public function parse( string $html_string, ?string $charset = null ): DOMDocument {
		$dom = new DOMDocument();
		\libxml_use_internal_errors( true );
		$dom->loadHTML( $this->add_charset( $html_string, $charset ), ( \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD ) );
		\libxml_clear_errors();
		return $dom;
	}

	/**
	 * Add charset to the node html
	 *
	 * @param string      $html_string The node html to add charset to.
	 * @param string|null $charset     The charset to add to the node html.
	 *
	 * @return string The node html with charset
	 */
	public function add_charset( string $html_string, ?string $charset ): string {
		if ( \is_null( $charset ) ) {
			return $html_string;
		}
		return \sprintf( '<html><head><meta content="text/html; charset=%s" http-equiv="Content-Type"></head><body>%s</body></html>', $charset, $html_string );
	}
}
