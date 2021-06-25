<?php

// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
namespace Yoast\WP\SEO\Integrations\Blocks;

use Yoast\WP\SEO\Conditionals\Schema_Blocks_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Adds the block categories for the Jobs Posting block.
 */
class Job_Posting_Block implements Integration_Interface {

	/**
	 * Registers the hooks.
	 */
	public function register_hooks() {
		\add_filter( 'block_categories', [ $this, 'add_block_categories' ] );
	}

	/**
	 * Returns the list of conditionals.
	 *
	 * @return array The conditionals.
	 */
	public static function get_conditionals() {
		return [
			Schema_Blocks_Conditional::class,
		];
	}

	/**
	 * Adds Yoast block categories.
	 *
	 * @param array $categories The categories to filter.
	 *
	 * @return array The filtered categories.
	 */
	public function add_block_categories( $categories ) {
		$categories[] = [
			'slug'  => 'yoast-required-job-blocks',
			'title' => \__( 'Required Job Posting Blocks', 'wordpress-seo-premium' ),
		];

		$categories[] = [
			'slug'  => 'yoast-recommended-job-blocks',
			'title' => \__( 'Recommended Job Posting Blocks', 'wordpress-seo-premium' ),
		];

		return $categories;
	}
}
