<?php

// phpcs:disable Yoast.NamingConventions.NamespaceName.TooLong
namespace Yoast\WP\SEO\Premium\User_Meta\Framework\Additional_Contactmethods;

use Yoast\WP\SEO\User_Meta\Domain\Additional_Contactmethod_Interface;

/**
 * The Mastodon contactmethod.
 */
class Mastodon implements Additional_Contactmethod_Interface {

	/**
	 * Returns the key of the Mastodon contactmethod.
	 *
	 * @return string The key of the Mastodon contactmethod.
	 */
	public function get_key(): string {
		return 'mastodon';
	}

	/**
	 * Returns the label of the Mastodon field.
	 *
	 * @return string The label of the Mastodon field.
	 */
	public function get_label(): string {
		return \__( 'Mastodon profile URL', 'wordpress-seo-premium' );
	}
}
