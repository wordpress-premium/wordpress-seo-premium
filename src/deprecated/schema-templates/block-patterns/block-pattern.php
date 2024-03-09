<?php

namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A Gutenberg block pattern.
 *
 * @deprecated 20.5
 * @codeCoverageIgnore
 */
abstract class Block_Pattern {

	/**
	 * Returns the block pattern configuration.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return string[] The configuration.
	 */
	public function get_configuration() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
		return [
			'title'      => '',
			'content'    => '',
			'categories' => [],
			'keywords'   => [],
		];
	}

	/**
	 * Gets the name of this block pattern.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return string The name of this block pattern.
	 */
	abstract public function get_name();

	/**
	 * Gets the title of this block pattern.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return string The title of this block pattern.
	 */
	abstract public function get_title();

	/**
	 * Gets the contents of this block pattern.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return string The contents of this block pattern.
	 */
	abstract public function get_content();

	/**
	 * Gets the categories of this block pattern.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return string[] The categories of this block pattern.
	 */
	abstract public function get_categories();

	/**
	 * Gets the keywords of this block pattern.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return string[] The keywords of this block pattern.
	 */
	abstract public function get_keywords();
}
