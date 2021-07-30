<?php

namespace Yoast\WP\SEO\Premium\Routes;

use Yoast\WP\SEO\Routes\Route_Interface;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Main;

/**
 * Workouts_Route class.
 */
class Workouts_Route implements Route_Interface {

	use No_Conditionals;

	/**
	 * Represents workouts route.
	 *
	 * @var string
	 */
	const WORKOUTS_ROUTE = '/workouts';

	/**
	 * Allowed cornerstone steps.
	 *
	 * @var array
	 */
	const ALLOWED_CORNERSTONE_STEPS = [
		'chooseCornerstones',
		'markCornerstones',
		'checkCornerstones',
		'checkLinks',
		'addLinks',
	];

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes() {
		$edit_posts = function() {
			return \current_user_can( 'edit_posts' );
		};

		$route = [
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_workouts' ],
				'permission_callback' => $edit_posts,
			],
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'set_workouts' ],
				'permission_callback' => $edit_posts,
				'args'                => [
					'cornerstone' => [
						'validate_callback' => [ $this, 'is_allowed' ],
						'required'          => true,
					],
				],
			],
		];

		\register_rest_route( Main::API_V1_NAMESPACE, self::WORKOUTS_ROUTE, $route );
	}

	/**
	 * Returns the workouts as configured for the site.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function get_workouts() {
		return new \WP_REST_Response(
			[ 'json' => \YoastSEO()->helpers->options->get( 'workouts' ) ]
		);
	}

	/**
	 * Sets the workout configuration.
	 *
	 * @param \WP_Rest_Request $request The request object.
	 *
	 * @return \WP_REST_Response the configuration of the workouts.
	 */
	public function set_workouts( $request ) {
		$value = [ 'cornerstone' => $request['cornerstone'] ];
		return new \WP_REST_Response(
			[ 'json' => \YoastSEO()->helpers->options->set( 'workouts', $value ) ]
		);
	}

	/**
	 * Validates the cornerstone attribute.
	 *
	 * @param array $cornerstone The cornerstone attribute.
	 * @return bool If the payload is valid or not.
	 */
	public function is_allowed( $cornerstone ) {
		// Only 1 property is allowed, the below validated finishedSteps property.
		if ( \count( $cornerstone ) !== 1 ) {
			return false;
		}
		if ( isset( $cornerstone['finishedSteps'] ) && is_array( $cornerstone['finishedSteps'] ) ) {
			foreach ( $cornerstone['finishedSteps'] as $step ) {
				if ( ! in_array( $step, self::ALLOWED_CORNERSTONE_STEPS, true ) ) {
					return false;
				}
			}
			return true;
		}
		return false;
	}
}
