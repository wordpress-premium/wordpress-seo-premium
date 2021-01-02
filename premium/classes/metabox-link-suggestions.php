<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

/**
 * Represents the class for adding the link suggestions metabox for each post type.
 */
class WPSEO_Metabox_Link_Suggestions implements WPSEO_WordPress_Integration {

	/**
	 * Sets the hooks for adding the metaboxes.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
	}

	/**
	 * Adds a meta for each public post type.
	 *
	 * @return void
	 */
	public function add_meta_boxes() {
		/*
		 * Since the link suggestions are already added in the Yoast sidebar.
		 * Do not add them to the metabox when in the block editor.
		 */
		if ( WP_Screen::get()->is_block_editor() ) {
			return;
		}

		$post_types = $this->get_post_types();

		array_map( [ $this, 'add_meta_box' ], $post_types );
	}

	/**
	 * Returns whether the link suggestions are available for the given post type.
	 *
	 * @param string $post_type The post type for which to check if the link suggestions are available.
	 *
	 * @return bool Whether the link suggestions are available for the given post type.
	 */
	public function is_available( $post_type ) {
		$allowed_post_types = $this->get_post_types();

		return in_array( $post_type, $allowed_post_types, true );
	}

	/**
	 * Renders the content for the metabox. We leave this empty because we render with React.
	 *
	 * @return void
	 */
	public function render_metabox_content() {
		echo '';
	}

	/**
	 * Returns all the public post types.
	 *
	 * @return array The supported post types.
	 */
	protected function get_post_types() {
		$prominent_words_support = new WPSEO_Premium_Prominent_Words_Support();

		return $prominent_words_support->get_supported_post_types();
	}

	/**
	 * Returns whether or not the Link Suggestions are enabled.
	 *
	 * @return bool Whether or not the link suggestions are enabled.
	 */
	public function is_enabled() {
		return WPSEO_Options::get( 'enable_link_suggestions', false );
	}

	/**
	 * Adds a meta box for the given post type.
	 *
	 * @param string $post_type The post type to add a meta box for.
	 */
	protected function add_meta_box( $post_type ) {
		if ( ! $this->is_available( $post_type ) || ! $this->is_enabled() ) {
			return;
		}

		if ( ! WPSEO_Utils::are_content_endpoints_available() ) {
			return;
		}

		add_meta_box(
			'yoast_internal_linking',
			sprintf(
				/* translators: %s expands to Yoast  */
				__( '%s internal linking', 'wordpress-seo-premium' ),
				'Yoast'
			),
			[ $this, 'render_metabox_content' ],
			$post_type,
			'side',
			'low',
			[
				'__block_editor_compatible_meta_box' => true,
			]
		);
	}

	/**
	 * Returns whether or not we need to index more posts for correct link suggestion functionality
	 *
	 * @deprecated 14.7
	 * @codeCoverageIgnore
	 *
	 * @return bool Whether or not we need to index more posts.
	 */
	public function is_site_unindexed() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.7' );

		return false;
	}
}
