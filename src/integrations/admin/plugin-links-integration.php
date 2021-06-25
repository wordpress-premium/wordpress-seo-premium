<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Addon_Manager;
use WPSEO_Shortlinker;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Plugin_Links_Integration class
 */
class Plugin_Links_Integration implements Integration_Interface {

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_filter( 'plugin_action_links_' . \WPSEO_BASENAME, [ $this, 'remove_yoast_seo_action_link' ], 10 );
		\add_filter( 'network_admin_plugin_action_links_' . \WPSEO_BASENAME, [ $this, 'remove_yoast_seo_action_link' ], 10 );

		\add_filter( 'plugin_action_links_' . \WPSEO_PREMIUM_BASENAME, [ $this, 'add_yoast_seo_premium_action_link' ], 10 );
		\add_filter( 'network_admin_plugin_action_links_' . \WPSEO_PREMIUM_BASENAME, [ $this, 'add_yoast_seo_premium_action_link' ], 10 );
	}

	/**
	 * Removes the upgrade link from Yoast SEO free.
	 *
	 * @param string[] $links The action links.
	 *
	 * @return string[] The action link with the upgrade link removed.
	 */
	public function remove_yoast_seo_action_link( $links ) {
		$link_to_remove = $this->get_upgrade_link();
		return \array_filter(
			$links,
			static function ( $link ) use ( $link_to_remove ) {
				return $link !== $link_to_remove;
			}
		);
	}

	/**
	 * Adds the upgrade link to the premium actions.
	 *
	 * @param string[] $links The action links.
	 *
	 * @return string[] The action link with the upgrade link added.
	 */
	public function add_yoast_seo_premium_action_link( $links ) {
		$addon_manager = new WPSEO_Addon_Manager();

		if ( ! $addon_manager->has_valid_subscription( WPSEO_Addon_Manager::PREMIUM_SLUG ) ) {
			\array_unshift( $links, $this->get_upgrade_link() );
		}

		return $links;
	}

	/**
	 * Returns the upgrade link.
	 *
	 * @return string The upgrade link.
	 */
	protected function get_upgrade_link() {
        // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reason: text is originally from Yoast SEO.
		return '<a style="font-weight: bold;" href="' . \esc_url( WPSEO_Shortlinker::get( 'https://yoa.st/activate-my-yoast' ) ) . '" target="_blank">' . \__( 'Activate your subscription', 'wordpress-seo' ) . '</a>';
	}
}
