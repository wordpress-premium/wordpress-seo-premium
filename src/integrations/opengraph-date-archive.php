<?php

namespace Yoast\WP\SEO\Premium\Integrations;

/**
 * Class OpenGraph_Date_Archive.
 */
class OpenGraph_Date_Archive extends Abstract_OpenGraph_Integration {

	/**
	 * The name of the social title option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_TITLE = 'social-title-archive-wpseo';

	/**
	 * The name of the social description option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_DESCRIPTION = 'social-description-archive-wpseo';

	/**
	 * The name of the social image ID option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_IMAGE_ID = 'social-image-id-archive-wpseo';

	/**
	 * The name of the social image URL option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_IMAGE = 'social-image-url-archive-wpseo';

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'Yoast\WP\SEO\open_graph_title_date-archive', [ $this, 'filter_title' ] );
		\add_filter( 'Yoast\WP\SEO\open_graph_description_date-archive', [ $this, 'filter_description' ] );
		\add_filter( 'Yoast\WP\SEO\open_graph_image_id_date-archive', [ $this, 'filter_image_id' ] );
		\add_filter( 'Yoast\WP\SEO\open_graph_image_date-archive', [ $this, 'filter_image' ] );
	}
}
