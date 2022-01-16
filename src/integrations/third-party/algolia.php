<?php

namespace Yoast\WP\SEO\Premium\Integrations\Third_Party;

use WP_Post;
use WP_Term;
use WP_User;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Algolia_Enabled_Conditional;
use Yoast\WP\SEO\Surfaces\Meta_Surface;
use Yoast\WP\SEO\Surfaces\Values\Meta;

/**
 * BbPress integration.
 */
class Algolia implements Integration_Interface {

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options;

	/**
	 * The meta helper.
	 *
	 * @var Meta_Surface
	 */
	protected $meta;

	/**
	 * Algolia constructor.
	 *
	 * @codeCoverageIgnore It only sets dependencies.
	 *
	 * @param Options_Helper $options The options helper.
	 * @param Meta_Surface   $meta    The meta surface.
	 */
	public function __construct( Options_Helper $options, Meta_Surface $meta ) {
		$this->options = $options;
		$this->meta    = $meta;
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [
			Algolia_Enabled_Conditional::class,
		];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'algolia_searchable_post_shared_attributes', [ $this, 'add_attributes_post' ], 10, 2 );
		\add_filter( 'algolia_term_record', [ $this, 'add_attributes_term' ] );
		\add_filter( 'algolia_user_record', [ $this, 'add_attributes_user' ] );
		\add_filter( 'algolia_should_index_searchable_post', [ $this, 'blacklist_no_index_posts' ], 10, 2 );
		\add_filter( 'algolia_should_index_term', [ $this, 'blacklist_no_index_terms' ], 10, 2 );
		\add_filter( 'algolia_should_index_user', [ $this, 'blacklist_no_index_users' ], 10, 2 );
	}

	/**
	 * Adds the search result priority and the number of internal links to an article to Algolia's index.
	 *
	 * @param array   $attributes The attributes Algolia should index.
	 * @param WP_Post $post       The post object that is being indexed.
	 *
	 * @return array The attributes Algolia should index.
	 */
	public function add_attributes_post( $attributes, $post ) {
		$meta = $this->meta->for_post( $post->ID );

		return $this->add_attributes( $attributes, $meta );
	}

	/**
	 * Adds the attributes for a term.
	 *
	 * @param array $attributes The recorded attributes.
	 *
	 * @return array The recorded attributes.
	 */
	public function add_attributes_term( $attributes ) {
		$meta = $this->meta->for_term( $attributes['objectID'] );

		return $this->add_attributes( $attributes, $meta );
	}

	/**
	 * Adds the attributes for a term.
	 *
	 * @param array $attributes The recorded attributes.
	 *
	 * @return array The recorded attributes.
	 */
	public function add_attributes_user( $attributes ) {
		$meta = $this->meta->for_author( $attributes['objectID'] );

		return $this->add_attributes( $attributes, $meta );
	}

	/**
	 * Adds the attributes for a searchable object.
	 *
	 * @param array $attributes Attributes to update.
	 * @param Meta  $meta       Meta value object for the current object.
	 *
	 * @return array Attributes for the searchable object.
	 */
	private function add_attributes( array $attributes, Meta $meta ) {
		$attributes['yoast_seo_links']    = (int) $meta->indexable->incoming_link_count;
		$attributes['yoast_seo_metadesc'] = $meta->meta_description;

		return $this->add_social_image( $attributes, $meta->open_graph_images );
	}

	/**
	 * Adds the social image to an attributes array if we have one.
	 *
	 * @param array $attributes The array of search attributes for a record.
	 * @param array $og_images  The social images for the current item.
	 *
	 * @return array The array of search attributes for a record.
	 */
	private function add_social_image( $attributes, $og_images ) {
		if ( \is_array( $og_images ) && \count( $og_images ) > 0 ) {
			$attributes['images']['social'] = \reset( $og_images );
		}

		return $attributes;
	}

	/**
	 * Checks whether a post should be indexed, taking the Yoast SEO no-index state into account.
	 *
	 * @param bool    $should_index Whether Algolia should index the post or not.
	 * @param WP_Post $post         The post object.
	 *
	 * @return bool Whether Algolia should index the post or not.
	 */
	public function blacklist_no_index_posts( $should_index, $post ) {
		if ( $this->meta->for_post( $post->ID )->robots['index'] === 'noindex' ) {
			return false;
		}

		return $should_index;
	}

	/**
	 * Checks whether a term should be indexed, taking the Yoast SEO no-index state into account.
	 *
	 * @param bool    $should_index Whether Algolia should index the term or not.
	 * @param WP_Term $term         The term object.
	 *
	 * @return bool Whether Algolia should index the term or not.
	 */
	public function blacklist_no_index_terms( $should_index, $term ) {
		if ( $this->meta->for_term( $term->term_id )->robots['index'] === 'noindex' ) {
			return false;
		}

		return $should_index;
	}

	/**
	 * Checks whether a user should be indexed, taking the Yoast SEO no-index state into account.
	 *
	 * @param bool    $should_index Whether Algolia should index the user or not.
	 * @param WP_User $user         The user object.
	 *
	 * @return bool Whether Algolia should index the user or not.
	 */
	public function blacklist_no_index_users( $should_index, $user ) {
		if ( $this->meta->for_author( $user->ID )->robots['index'] === 'noindex' ) {
			return false;
		}

		return $should_index;
	}
}
