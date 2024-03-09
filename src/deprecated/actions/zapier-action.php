<?php

namespace Yoast\WP\SEO\Premium\Actions;

use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Handles the actual requests to the Zapier endpoints.
 *
 * @deprecated 20.7
 * @codeCoverageIgnore
 */
class Zapier_Action {

	/**
	 * The Zapier helper.
	 *
	 * @var Zapier_Helper
	 */
	protected $zapier_helper;

	/**
	 * The Indexable repository.
	 *
	 * @var Indexable_Repository
	 */
	protected $indexable_repository;

	/**
	 * Zapier_Action constructor.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param Zapier_Helper        $zapier_helper        The Zapier helper.
	 * @param Indexable_Repository $indexable_repository The Indexable repository.
	 */
	public function __construct( Zapier_Helper $zapier_helper, Indexable_Repository $indexable_repository ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		$this->zapier_helper        = $zapier_helper;
		$this->indexable_repository = $indexable_repository;
	}

	/**
	 * Subscribes Zapier and stores the passed URL for later usage.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param string $url     The URL to subscribe.
	 * @param string $api_key The API key from Zapier to check against the one stored in the options.
	 *
	 * @return object The response object.
	 */
	public function subscribe( $url, $api_key ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! $this->zapier_helper->is_valid_api_key( $api_key ) ) {
			return (object) [
				'data'    => [],
				'message' => 'The API key does not match.',
				'status'  => 500,
			];
		}

		if ( $this->zapier_helper->is_connected() ) {
			return (object) [
				'data'    => [],
				'message' => 'Subscribing failed. A subscription already exists.',
				'status'  => 500,
			];
		}

		$subscription_data = $this->zapier_helper->subscribe_url( $url );

		if ( ! $subscription_data ) {
			return (object) [
				'data'    => [],
				'message' => 'Subscribing failed.',
				'status'  => 500,
			];
		}

		return (object) [
			'data'   => $subscription_data,
			'status' => 200,
		];
	}

	/**
	 * Unsubscribes Zapier based on the passed ID.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param string $id The ID to unsubscribe.
	 *
	 * @return object The response object.
	 */
	public function unsubscribe( $id ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! $this->zapier_helper->is_subscribed_id( $id ) ) {
			return (object) [
				'message' => \sprintf( 'Unsubscribing failed. Subscription with ID `%s` does not exist.', $id ),
				'status'  => 404,
			];
		}

		if ( ! $this->zapier_helper->unsubscribe_id( $id ) ) {
			return (object) [
				'message' => 'Unsubscribing failed. Unable to delete subscription.',
				'status'  => 500,
			];
		}

		return (object) [
			'message' => \sprintf( 'Successfully unsubscribed subscription with ID `%s`.', $id ),
			'status'  => 200,
		];
	}

	/**
	 * Checks the API key submitted by Zapier.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param string $api_key The API key from Zapier to check against the one
	 *     stored in the options.
	 *
	 * @return object The response object.
	 */
	public function check_api_key( $api_key ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! $this->zapier_helper->is_valid_api_key( $api_key ) ) {
			return (object) [
				'data'    => [],
				'message' => 'The API key does not match.',
				'status'  => 500,
			];
		}

		return (object) [
			'data'    => [],
			'message' => 'The API key is valid.',
			'status'  => 200,
		];
	}

	/**
	 * Sends an array of the last published post URLs.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param string $api_key The API key from Zapier to check against the one
	 *     stored in the options.
	 *
	 * @return object The response object.
	 */
	public function perform_list( $api_key ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! $this->zapier_helper->is_valid_api_key( $api_key ) ) {
			return (object) [
				'data'    => [],
				'message' => 'The API key does not match.',
				'status'  => 500,
			];
		}

		$latest_post = \get_posts(
			[
				'numberposts' => 1,
			]
		);
		$zapier_data = [];
		foreach ( $latest_post as $item ) {
			$indexable = $this->indexable_repository->find_by_id_and_type( $item->ID, 'post' );
			if ( $indexable ) {
				$zapier_data[] = (object) $this->zapier_helper->get_data_for_zapier( $indexable );
			}
		}

		return (object) [
			'data'   => $zapier_data,
			'status' => 200,
		];
	}

	/**
	 * Checks if Zapier is connected.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @return object The response object.
	 */
	public function is_connected() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		return (object) [
			'data'   => [
				'is_connected' => $this->zapier_helper->is_connected(),
			],
			'status' => 200,
		];
	}

	/**
	 * Resets the API key in the DB.
	 *
	 * @deprecated 20.7
	 * @codeCoverageIgnore
	 *
	 * @param string $api_key The API key to be reset.
	 *
	 * @return object The response object.
	 */
	public function reset_api_key( $api_key ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 20.7' );

		if ( ! $this->zapier_helper->is_valid_api_key( $api_key ) ) {
			return (object) [
				'data'    => [],
				'message' => 'The API key does not match.',
				'status'  => 500,
			];
		}

		$this->zapier_helper->reset_api_key_and_subscription();
		$new_api_key = $this->zapier_helper->get_or_generate_zapier_api_key();

		return (object) [
			'data' => [
				'zapier_api_key' => $new_api_key,
			],
		];
	}
}
