<?php

namespace Yoast\WP\SEO\Premium\User_Meta\User_Interface;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\User_Meta\Framework\Additional_Contactmethods\Mastodon;

/**
 * Handles registering and saving additional contactmethods for users.
 */
class Additional_Contactmethods_Integration implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The Mastodon class.
	 *
	 * @var Mastodon $mastodon The Mastodon class.
	 */
	private $mastodon;

	/**
	 * The constructor.
	 *
	 * @param Mastodon $mastodon The Mastodon class.
	 */
	public function __construct( Mastodon $mastodon ) {
		$this->mastodon = $mastodon;
	}

	/**
	 * Registers action hook.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		\add_filter( 'wpseo_additional_contactmethods', [ $this, 'add_contactmethods' ] );
	}

	/**
	 * Adds to the contactmethods the Premium contactmethods.
	 *
	 * @param array<Additional_Contactmethod_Interface> $contactmethods Currently set contactmethods.
	 *
	 * @return array<Additional_Contactmethod_Interface> Contactmethods with added Premium contactmethods.
	 */
	public function add_contactmethods( $contactmethods ) {
		$premium_contactmethod   = [];
		$premium_contactmethod[] = $this->mastodon;

		return \array_merge( $contactmethods, $premium_contactmethod );
	}
}
