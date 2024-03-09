<?php

namespace Yoast\WP\SEO\Premium\Integrations;

/**
 * Class OpenGraph_PostType_Archive.
 */
class OpenGraph_PostType_Archive extends Abstract_OpenGraph_Integration {

	/**
	 * The prefix for the social title option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_TITLE = 'social-title-ptarchive-';

	/**
	 * The prefix for the social description option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_DESCRIPTION = 'social-description-ptarchive-';

	/**
	 * The prefix for the social image ID option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_IMAGE_ID = 'social-image-id-ptarchive-';

	/**
	 * The prefix for the social image URL option.
	 *
	 * @var string
	 */
	public const OPTION_TITLES_KEY_IMAGE = 'social-image-url-ptarchive-';

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'Yoast\WP\SEO\open_graph_title_post-type-archive', [ $this, 'filter_title_for_subtype' ], 10, 2 );
		\add_filter( 'Yoast\WP\SEO\open_graph_description_post-type-archive', [ $this, 'filter_description_for_subtype' ], 10, 2 );
		\add_filter( 'Yoast\WP\SEO\open_graph_image_id_post-type-archive', [ $this, 'filter_image_id_for_subtype' ], 10, 2 );
		\add_filter( 'Yoast\WP\SEO\open_graph_image_post-type-archive', [ $this, 'filter_image_for_subtype' ], 10, 2 );
	}
}
