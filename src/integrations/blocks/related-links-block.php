<?php

namespace Yoast\WP\SEO\Premium\Integrations\Blocks;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Related content block class.
 */
class Related_Links_Block implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		$base_path = \WPSEO_PREMIUM_PATH . 'assets/blocks/dynamic-blocks/';
		\register_block_type( $base_path . 'related-links-block/block.json', [ 'editor_script_handles' => [ 'wp-seo-premium-blocks' ] ] );
	}
}
