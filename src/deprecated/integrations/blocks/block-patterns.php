<?php

namespace Yoast\WP\SEO\Integrations\Blocks;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern;

/**
 * Registers the block patterns needed for the Premium Schema blocks.
 *
 * @deprecated 20.5
 * @codeCoverageIgnore
 */
class Block_Patterns implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The block patterns to register.
	 *
	 * @var Block_Pattern[]
	 */
	protected $block_patterns = [];

	/**
	 * Block_Patterns integration constructor.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @param Block_Pattern ...$block_patterns The block patterns to register.
	 */
	public function __construct( Block_Pattern ...$block_patterns ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
		$this->block_patterns = $block_patterns;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
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
	 * Registers the block patterns with WordPress.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_block_patterns() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
	}

	/**
	 * Registers the block pattern category with WordPress.
	 *
	 * @deprecated 20.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_block_pattern_category() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.5' );
	}
}
