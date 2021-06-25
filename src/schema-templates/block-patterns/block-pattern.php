<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A Gutenberg block pattern.
 */
abstract class Block_Pattern {

	/**
	 * Returns the block pattern configuration.
	 *
	 * @return string[] The configuration.
	 */
	public function get_configuration() {
		return [
			'title'      => $this->get_title(),
			'content'    => $this->get_content(),
			'categories' => (array) $this->get_categories(),
			'keywords'   => (array) $this->get_keywords(),
		];
	}

	/**
	 * Gets the name of this block pattern.
	 *
	 * @return string The name of this block pattern.
	 */
	abstract public function get_name();

	/**
	 * Gets the title of this block pattern.
	 *
	 * @return string The title of this block pattern.
	 */
	abstract public function get_title();

	/**
	 * Gets the contents of this block pattern.
	 *
	 * @return string The contents of this block pattern.
	 */
	abstract public function get_content();

	/**
	 * Gets the categories of this block pattern.
	 *
	 * @return string[] The categories of this block pattern.
	 */
	abstract public function get_categories();

	/**
	 * Gets the keywords of this block pattern.
	 *
	 * @return string[] The keywords of this block pattern.
	 */
	abstract public function get_keywords();
}
