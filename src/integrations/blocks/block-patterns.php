<?php

// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
namespace Yoast\WP\SEO\Integrations\Blocks;

use Yoast\WP\SEO\Conditionals\Schema_Blocks_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern;
use Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Categories;

/**
 * Registers the block patterns needed for the Premium Schema blocks.
 */
class Block_Patterns implements Integration_Interface {

	/**
	 * The block patterns to register.
	 *
	 * @var Block_Pattern[]
	 */
	protected $block_patterns = [];

	/**
	 * Block_Patterns integration constructor.
	 *
	 * @param Block_Pattern ...$block_patterns The block patterns to register.
	 */
	public function __construct( Block_Pattern ...$block_patterns ) {
		$this->block_patterns = $block_patterns;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'admin_init', [ $this, 'register_block_pattern_category' ] );
		\add_action( 'admin_init', [ $this, 'register_block_patterns' ] );
	}

	/**
	 * Returns the list of conditionals.
	 *
	 * @return array The conditionals.
	 */
	public static function get_conditionals() {
		return [ Schema_Blocks_Conditional::class ];
	}

	/**
	 * Registers the block patterns with WordPress.
	 *
	 * @return void
	 */
	public function register_block_patterns() {
		foreach ( $this->block_patterns as $block_pattern ) {
			\register_block_pattern( $block_pattern->get_name(), $block_pattern->get_configuration() );
		}
	}

	/**
	 * Registers the block pattern category with WordPress.
	 *
	 * @return void
	 */
	public function register_block_pattern_category() {
		$category = [ 'label' => \__( 'Yoast Job Posting', 'wordpress-seo-premium' ) ];
		\register_block_pattern_category( Block_Pattern_Categories::YOAST_JOB_POSTING, $category );
	}
}
