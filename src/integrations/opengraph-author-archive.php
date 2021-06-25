<?php

namespace Yoast\WP\SEO\Premium\Integrations;

/**
 * Class OpenGraph_Author_Archive.
 */
class OpenGraph_Author_Archive extends Abstract_OpenGraph_Integration {

	/**
	 * The name of the social title option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_TITLE = 'social-title-author-wpseo';

	/**
	 * The name of the social description option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_DESCRIPTION = 'social-description-author-wpseo';

	/**
	 * The name of the social image ID option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_IMAGE_ID = 'social-image-id-author-wpseo';

	/**
	 * The name of the social image URL option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_IMAGE = 'social-image-url-author-wpseo';

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'Yoast\WP\SEO\open_graph_title_user', [ $this, 'filter_title' ] );
		\add_filter( 'Yoast\WP\SEO\open_graph_description_user', [ $this, 'filter_description' ] );
		\add_filter( 'Yoast\WP\SEO\open_graph_image_id_user', [ $this, 'filter_image_id' ] );
		\add_filter( 'Yoast\WP\SEO\open_graph_image_user', [ $this, 'filter_image' ] );
	}
}
