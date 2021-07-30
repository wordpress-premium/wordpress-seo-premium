<?php

// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
namespace Yoast\WP\SEO\Integrations\Blocks;

use Yoast\WP\SEO\Conditionals\Schema_Blocks_Conditional;
use Yoast\WP\SEO\Helpers\Wordpress_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Adds the block categories for the Jobs Posting block.
 */
class Job_Posting_Block implements Integration_Interface {

	/**
	 * Represents the WordPress helper.
	 *
	 * @var Wordpress_Helper
	 */
	protected $wordpress_helper;

	/**
	 * Job_Posting_Block constructor.
	 *
	 * @param Wordpress_Helper $wordpress_helper The WordPress helper.
	 */
	public function __construct( Wordpress_Helper $wordpress_helper ) {
		$this->wordpress_helper = $wordpress_helper;
	}

	/**
	 * Registers the hooks.
	 */
	public function register_hooks() {
		$wordpress_version = $this->wordpress_helper->get_wordpress_version();

		// The 'block_categories' filter has been deprecated in WordPress 5.8 and replaced by 'block_categories_all'.
		if ( \version_compare( $wordpress_version, '5.8-beta0', '<' ) ) {
			\add_filter( 'block_categories', [ $this, 'add_block_categories' ] );
		}
		else {
			\add_filter( 'block_categories_all', [ $this, 'add_block_categories' ] );
		}
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
