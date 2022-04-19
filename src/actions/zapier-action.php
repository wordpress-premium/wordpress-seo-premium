<?php

namespace Yoast\WP\SEO\Premium\Actions;

use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Handles the actual requests to the Zapier endpoints.
 */
class Zapier_Action {

	/**
	 * Instance of the Options_Helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

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
	 * @param Options_Helper       $options_helper       The Options Helper.
	 * @param Zapier_Helper        $zapier_helper        The Zapier helper.
	 * @param Indexable_Repository $indexable_repository The Indexable repository.
	 */
	public function __construct(
		Options_Helper $options_helper,
		Zapier_Helper $zapier_helper,
		Indexable_Repository $indexable_repository
	) {
		$this->options_helper       = $options_helper;
		$this->zapier_helper        = $zapier_helper;
		$this->indexable_repository = $indexable_repository;
	}

	/**
	 * Subscribes Zapier and stores the passed URL for later usage.
	 *
	 * @param string $url     The URL to subscribe.
	 * @param string $api_key The API key from Zapier to check against the one stored in the options.
	 *
	 * @return object The response object.
	 */
	public function subscribe( $url, $api_key ) {
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
	 * @param string $id The ID to unsubscribe.
	 *
	 * @return object The response object.
	 */
	public function unsubscribe( $id ) {
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
	 * @param string $api_key The API key from Zapier to check against the one
	 *     stored in the options.
	 *
	 * @return object The response object.
	 */
	public function check_api_key( $api_key ) {
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
	 * @param string $api_key The API key from Zapier to check against the one
	 *     stored in the options.
	 *
	 * @return object The response object.
	 */
	public function perform_list( $api_key ) {
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
			$indexable     = $this->indexable_repository->find_by_id_and_type( $item->ID, 'post' );
			$zapier_data[] = (object) $this->zapier_helper->get_data_for_zapier( $indexable );
		}

		return (object) [
			'data'   => $zapier_data,
			'status' => 200,
		];
	}
}
