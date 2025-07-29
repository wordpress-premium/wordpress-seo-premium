<?php
// Snake case is globally ignored for this file since its uses DOMDocument and DOMElement functions which are in camelCase.
// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

namespace Yoast\WP\SEO\Premium\Integrations\Admin\Extension_Importer;

use DOMDocument;
use DOMElement;
use DOMNode;

/**
 * DOM_Processor class.
 */
class DOM_Processor {

	/**
	 * Extracts style attribute from a DOMElement and returns the formatted string.
	 *
	 * @param DOMElement|null $element        The element to extract style from.
	 * @param bool            $with_attribute Whether to include the style attribute name.
	 *
	 * @return string The formatted style string.
	 */
	public function get_style_attribute( ?DOMElement $element, bool $with_attribute = true ): string {
		if ( $element === null ) {
			return '';
		}

		$style = $element->getAttribute( 'style' );

		if ( empty( $style ) ) {
			return '';
		}

		return ( $with_attribute === true ) ? ' style="' . \esc_attr( $style ) . '"' : \esc_attr( $style );
	}

	/**
	 * Extracts class attribute from a DOMElement and returns the formatted string.
	 *
	 * @param DOMElement|null $element       The element to extract class from.
	 * @param string          $default_class Default class to include.
	 *
	 * @return string The formatted class string.
	 */
	public function get_class_attribute( ?DOMElement $element, string $default_class = '' ): string {
		if ( $element === null ) {
			return ( $default_class !== '' ) ? ' class="' . \esc_attr( $default_class ) . '"' : '';
		}

		$class = $element->getAttribute( 'class' );

		if ( empty( $class ) ) {
			return ( $default_class !== '' ) ? ' class="' . \esc_attr( $default_class ) . '"' : '';
		}

		if ( $default_class ) {
			$class = $default_class . ' ' . $class;
		}

		return ' class="' . \esc_attr( $class ) . '"';
	}

	/**
	 * Gets the HTML representation of a node.
	 *
	 * @param DOMNode|null $node The node.
	 *
	 * @return string The HTML representation.
	 */
	public function get_node_html( ?DOMNode $node ): string {
		if ( $node === null ) {
			return '';
		}

		$dom = new DOMDocument();
		$dom->appendChild( $dom->importNode( $node, true ) );

		$html = $dom->saveHTML();

		// Remove the XML declaration and doctype.
		$html = \preg_replace( '/^<!DOCTYPE.+?>/', '', $html );
		$html = \preg_replace( '/<\?xml.+?\?>/', '', $html );

		return \trim( $html );
	}

	/**
	 * Processes inline elements within a block element.
	 *
	 * @param DOMElement|null $element The element to process.
	 *
	 * @return string The processed content with inline elements.
	 */
	public function process_inline_elements( ?DOMElement $element ): string {
		$content = '';

		if ( $element === null ) {
			return $content;
		}

		// Loop through each childnode and process them.
		foreach ( $element->childNodes as $child ) {
			if ( $child->nodeType === \XML_TEXT_NODE ) {
				$content .= $child->nodeValue;
				continue;
			}

			if ( $child->nodeType !== \XML_ELEMENT_NODE ) {
				continue;
			}

			// Skip image elements in paragraphs as they should be separate blocks.
			if ( $child->nodeName === 'img' ) {
				continue;
			}

			// Skip spans with images.
			if ( $child->nodeName === 'span' && $child->getElementsByTagName( 'img' )->length > 0 ) {
				continue;
			}

			// Process the element based on its type.
			$content .= $this->process_inline_element_by_type( $child );
		}

		return $content;
	}

	/**
	 * Processes an inline element based on its nodeName.
	 *
	 * @param DOMElement $element The element to process.
	 *
	 * @return string The processed element.
	 */
	private function process_inline_element_by_type( DOMElement $element ): string {
		$tag             = $element->nodeName;
		$style           = $this->get_style_attribute( $element );
		$element_content = $this->process_inline_elements( $element );

		switch ( $tag ) {
			case 'a':
				$href = $element->getAttribute( 'href' );

				return '<a href="' . \esc_url( $href ) . '"' . $style . '>' . \wp_kses_post( $element_content ) . '</a>';

			case 'strong':
			case 'b':
				return '<strong' . $style . '>' . \wp_kses_post( $element_content ) . '</strong>';

			case 'em':
			case 'i':
				return '<em' . $style . '>' . \wp_kses_post( $element_content ) . '</em>';

			case 's':
			case 'strike':
			case 'del':
				return '<s' . $style . '>' . \wp_kses_post( $element_content ) . '</s>';

			case 'u':
				// Create underline using span with text-decoration.
				$style_content = \trim( $style, '"' );
				$style_content = \trim( $style_content, ' ' );
				$style_attr    = ' style="text-decoration: underline' . ( ! empty( $style_content ) ? '; ' . $style_content : '' ) . '"';

				return '<span' . $style_attr . '>' . \wp_kses_post( $element_content ) . '</span>';

			case 'span':
				return $this->process_span_element( $element, $element_content );

			default:
				// For any other elements, get their HTML representation.
				return $this->get_node_html( $element );
		}
	}

	/**
	 * Specialized processor for span elements to process inline styles.
	 *
	 * Text formats accepted : Bold, Italics, Strikethrough, Underline.
	 * Since underline is implemented via inline styles, we allow inline styles strictly for underlined spans.
	 * Else, we return span with other text formats that are implemented via HTML tags (strong, em, s, etc.).
	 *
	 * @param DOMElement $span    The span element.
	 * @param string     $content The preprocessed content.
	 *
	 * @return string The processed span.
	 */
	private function process_span_element( DOMElement $span, string $content ): string {
		$style = $span->getAttribute( 'style' );

		// Only allow text-decoration: underline inline style for spans.
		if (
			\strpos( $style, 'text-decoration: underline' ) !== false
			|| \strpos( $style, 'text-decoration:underline' ) !== false
		) {
			// Other styled spans.
			return '<span style="' . \esc_attr( $style ) . '">' . \wp_kses_post( $content ) . '</span>';
		}

		// Plain spans with just content.
		return '<span>' . \wp_kses_post( $content ) . '</span>';
	}
}
