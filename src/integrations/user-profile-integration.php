<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use Yoast\WP\SEO\Conditionals\Front_End_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Class User_Profile_Integration.
 */
class User_Profile_Integration implements Integration_Interface {

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_schema_person_data', [ $this, 'filter_person_schema' ], 10, 2 );
	}

	/**
	 * Filters the Person schema to add our stored user schema fields.
	 *
	 * To see which fields we can store see this class's sibling admin integration.
	 *
	 * @param array $data    The Person schema data.
	 * @param int   $user_id The user ID.
	 *
	 * @return array The Person schema data.
	 */
	public function filter_person_schema( $data, $user_id ) {
		$user_schema = \get_user_meta( $user_id, 'wpseo_user_schema', true );
		if ( \is_array( $user_schema ) ) {
			$data = \array_merge( $data, $user_schema );
		}
		return $data;
	}

	/**
	 * Returns the conditionals based on which this loadable should be active.
	 *
	 * @return array The conditionals.
	 */
	public static function get_conditionals() {
		return [ Front_End_Conditional::class ];
	}
}
