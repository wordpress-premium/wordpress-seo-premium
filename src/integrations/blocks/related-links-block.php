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
		\register_block_type( 'yoast-seo/related-links', [ 'editor_script' => 'wp-seo-premium-blocks' ] );
	}
}
