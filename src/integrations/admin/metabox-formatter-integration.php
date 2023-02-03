<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Options;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Metabox_Formatter_Integration class
 */
class Metabox_Formatter_Integration implements Integration_Interface {

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
		\add_filter( 'wpseo_social_template_post_type', [ $this, 'get_template_for_post_type' ], 10, 3 );
		\add_filter( 'wpseo_social_template_taxonomy', [ $this, 'get_template_for_taxonomy' ], 10, 3 );
	}

	/**
	 * Retrieves a template for a post type.
	 *
	 * @param string $template             The default template.
	 * @param string $template_option_name The subname of the option in which the template you want to get is saved.
	 * @param string $post_type            The name of the post type.
	 *
	 * @return string
	 */
	public function get_template_for_post_type( $template, $template_option_name, $post_type ) {
		$needed_option = \sprintf( 'social-%s-%s', $template_option_name, $post_type );

		if ( WPSEO_Options::get( $needed_option, '' ) !== '' ) {
			return WPSEO_Options::get( $needed_option );
		}

		return $template;
	}

	/**
	 * Retrieves a template for a taxonomy.
	 *
	 * @param string $template             The default template.
	 * @param string $template_option_name The subname of the option in which the template you want to get is saved.
	 * @param string $taxonomy             The name of the taxonomy.
	 *
	 * @return string
	 */
	public function get_template_for_taxonomy( $template, $template_option_name, $taxonomy ) {
		$needed_option = \sprintf( 'social-%s-tax-%s', $template_option_name, $taxonomy );
		return WPSEO_Options::get( $needed_option, $template );
	}
}
