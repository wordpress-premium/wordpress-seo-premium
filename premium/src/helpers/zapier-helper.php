<?php

namespace Yoast\WP\SEO\Helpers;

use WPSEO_Utils;
use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Surfaces\Meta_Surface;

/**
 * Class Zapier_Helper
 *
 * @package Yoast\WP\SEO\Helpers
 */
class Zapier_Helper {

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options;

	/**
	 * The meta surface.
	 *
	 * @var Meta_Surface
	 */
	protected $meta_surface;

	/**
	 * Zapier_Helper constructor.
	 *
	 * @codeCoverageIgnore It only sets dependencies.
	 *
	 * @param Options_Helper $options      The options helper.
	 * @param Meta_Surface   $meta_surface The Meta surface.
	 */
	public function __construct(
		Options_Helper $options,
		Meta_Surface $meta_surface
	) {
		$this->options      = $options;
		$this->meta_surface = $meta_surface;
	}

	/**
	 * Checks if a subscription exists in the database.
	 *
	 * @return bool Whether a subscription exists in the database.
	 */
	public function is_connected() {
		$subscription = $this->options->get( 'zapier_subscription' );

		if ( \is_array( $subscription )
			&& ! empty( $subscription['id'] )
			&& \filter_var( $subscription['url'], \FILTER_VALIDATE_URL )
		) {
			return true;
		}

		return false;
	}

	/**
	 * Checks if the Zapier integration is currently enabled.
	 *
	 * @return bool Whether the integration is enabled.
	 */
	public function is_enabled() {
		return ( $this->options->get( 'zapier_integration_active', false ) ) ? true : false;
	}

	/**
	 * Gets the stored Zapier API Key.
	 *
	 * @return string The Zapier API Key.
	 */
	public function get_or_generate_zapier_api_key() {
		$zapier_api_key = $this->options->get( 'zapier_api_key' );

		if ( empty( $zapier_api_key ) ) {
			$zapier_api_key = \wp_generate_password( 32, false );
			$this->options->set( 'zapier_api_key', $zapier_api_key );
		}

		return $zapier_api_key;
	}

	/**
	 * Check if a string matches the API key in the DB, if present.
	 *
	 * @param string $api_key The API key to test.
	 *
	 * @return bool Whether the API key is valid or not.
	 */
	public function is_valid_api_key( $api_key ) {
		return ( ! empty( $api_key ) && $this->options->get( 'zapier_api_key' ) === $api_key );
	}

	/**
	 * Returns the Zapier hook URL of the trigger if present, null otherwise.
	 *
	 * @return string|null The hook URL, null if not set.
	 */
	public function get_trigger_url() {
		if ( $this->is_connected() ) {
			$subscription = $this->options->get( 'zapier_subscription', [] );

			return $subscription['url'];
		}

		return null;
	}

	/**
	 * Returns whether the submitted id is present in the subscriptions.
	 *
	 * @param string $id The id to be tested.
	 *
	 * @return bool Whether the id is present in the subscriptions.
	 */
	public function is_subscribed_id( $id ) {
		if ( $this->is_connected() ) {
			$subscription = $this->options->get( 'zapier_subscription', [] );

			return $subscription['id'] === $id;
		}

		return false;
	}

	/**
	 * Unsubscribes the submitted id.
	 *
	 * @param string $id The id to be unsubscribed.
	 *
	 * @return bool Whether the unsubscription was successful.
	 */
	public function unsubscribe_id( $id ) {
		if ( $this->is_connected() && $this->is_subscribed_id( $id ) ) {
			return $this->options->set( 'zapier_subscription', [] );
		}

		return false;
	}

	/**
	 * Creates a new subscription with the submitted URL.
	 *
	 * @param string $url The URL to be subscribed.
	 *
	 * @return array|bool The subscription data (id and URL) if successful, false otherwise.
	 */
	public function subscribe_url( $url ) {
		if ( ! $this->is_connected() ) {
			$subscription_data = [
				'id'  => \wp_generate_password( 32, false ),
				'url' => \esc_url_raw( $url, [ 'http', 'https' ] ),
			];

			if ( $this->options->set( 'zapier_subscription', $subscription_data ) ) {
				return $subscription_data;
			}
		}

		return false;
	}

	/**
	 * Builds and returns the data for Zapier.
	 *
	 * @param Indexable $indexable The indexable from which the data must be extracted.
	 *
	 * @return array[] The array of data ready to be sent to Zapier.
	 */
	public function get_data_for_zapier( Indexable $indexable ) {
		$post = \get_post( $indexable->object_id );
		if ( ! $post ) {
			return [];
		}

		$meta = $this->meta_surface->for_indexable( $indexable );

		$open_graph_image = '';
		if ( \count( $meta->open_graph_images ) > 0 ) {
			$open_graph_image_array = \reset( $meta->open_graph_images );
			$open_graph_image       = $open_graph_image_array['url'];
		}

		return [
			'url'                    => $indexable->permalink,
			'post_type'              => $post->post_type,
			'post_title'             => \html_entity_decode( $post->post_title ),
			'author'                 => \get_the_author_meta( 'display_name', $post->post_author ),
			'tags'                   => \html_entity_decode( \implode( ', ', \wp_get_post_tags( $post->ID, [ 'fields' => 'names' ] ) ) ),
			'categories'             => \html_entity_decode( \implode( ', ', \wp_get_post_categories( $post->ID, [ 'fields' => 'names' ] ) ) ),
			'primary_category'       => \html_entity_decode( \yoast_get_primary_term( 'category', $post ) ),
			'meta_description'       => \html_entity_decode( $meta->description ),
			'open_graph_title'       => \html_entity_decode( $meta->open_graph_title ),
			'open_graph_description' => \html_entity_decode( $meta->open_graph_description ),
			'open_graph_image'       => $open_graph_image,
			'twitter_title'          => \html_entity_decode( $meta->twitter_title ),
			'twitter_description'    => \html_entity_decode( $meta->twitter_description ),
			'twitter_image'          => $meta->twitter_image,
		];
	}

	/**
	 * Returns whether the post type is supported by the Zapier integration.
	 *
	 * The Zapier integration should be visible and working only for post types
	 * that support the Yoast Metabox. We filter out attachments regardless of
	 * the Yoast SEO settings, anyway.
	 *
	 * @param string $post_type The post type to be checked.
	 *
	 * @return bool Whether the post type is supported by the Zapier integration.
	 */
	public function is_post_type_supported( $post_type ) {
		return $post_type !== 'attachment' && WPSEO_Utils::is_metabox_active( $post_type, 'post_type' );
	}
}
