<?php

namespace Yoast\WP\SEO\Integrations\Blocks;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Wordpress_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Adds the block categories for the Jobs Posting block.
 *
 * @deprecated 20.5
 * @codeCoverageIgnore
 */
class Job_Posting_Block implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Represents the WordPress helper.
	 *
	 * @var Wordpress_Helper
	 */
	protected $wordpress_helper;

	/**
	 * Job_Posting_Block constructor.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @param Wordpress_Helper $wordpress_helper The WordPress helper.
	 */
	public function __construct( Wordpress_Helper $wordpress_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
		$this->wordpress_helper = $wordpress_helper;
	}

	/**
	 * Registers the hooks.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
	}

	/**
	 * Adds Yoast block categories.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @param array $categories The categories to filter.
	 *
	 * @return array The filtered categories.
	 */
	public function add_block_categories( $categories ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
		return $categories;
	}
}
