<?php

namespace Yoast\WP\SEO\Integrations\Third_Party;

use DateInterval;
use DateTime;
use WP_Error;
use Yoast\WP\SEO\Conditionals\Zapier_Enabled_Conditional;
use Yoast\WP\SEO\Helpers\Meta_Helper;
use Yoast\WP\SEO\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Models\Indexable;

/**
 * Class to manage the triggering of the Zapier integration.
 */
class Zapier_Trigger implements Integration_Interface {

	/**
	 * The meta helper.
	 *
	 * @var Meta_Helper
	 */
	protected $meta_helper;

	/**
	 * The Zapier helper.
	 *
	 * @var Zapier_Helper
	 */
	protected $zapier_helper;

	/**
	 * Zapier constructor.
	 *
	 * @param Meta_Helper   $meta_helper   The meta helper.
	 * @param Zapier_Helper $zapier_helper The Zapier helper.
	 */
	public function __construct(
		Meta_Helper $meta_helper,
		Zapier_Helper $zapier_helper
	) {
		$this->meta_helper   = $meta_helper;
		$this->zapier_helper = $zapier_helper;
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Zapier_Enabled_Conditional::class ];
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'wpseo_save_indexable', [ $this, 'maybe_call_zapier' ] );
	}

	/**
	 * Decides if Zapier should be triggered.
	 *
	 * Zapier should be triggered only if:
	 * - we have a connection established
	 * - the item is a post (in the Indexable sense, as opposed to taxonomies etc.)
	 * - the item status is 'publish'
	 * - we are not serving a REST request (to avoid triggering on the first request by the block editor)
	 * - if the item hasn't been sent before
	 * - if the post_date is recent (so we are not just updating a post published before enabling Zapier)
	 *
	 * @param Indexable $indexable The indexable.
	 *
	 * @return void
	 */
	public function maybe_call_zapier( Indexable $indexable ) {
		if ( ! $this->zapier_helper->is_connected()
			|| $indexable->object_type !== 'post'
			|| $indexable->post_status !== 'publish'
			|| \defined( 'REST_REQUEST' ) && \REST_REQUEST
			|| $this->meta_helper->get_value( 'zapier_trigger_sent', $indexable->object_id ) === '1' ) {
			return;
		}

		$post                      = \get_post( $indexable->object_id );
		$published_datetime        = new DateTime( $post->post_date );
		$now_datetime              = new DateTime();
		$half_an_hour_ago_datetime = $now_datetime->sub( new DateInterval( 'PT30M' ) );
		if ( ! $this->zapier_helper->is_post_type_supported( $post->post_type )
			|| $published_datetime < $half_an_hour_ago_datetime ) {
			return;
		}

		$this->call_zapier( $indexable );
	}

	/**
	 * Sends a request to the Zapier trigger hook.
	 *
	 * @param Indexable $indexable The indexable.
	 *
	 * @return void
	 */
	public function call_zapier( Indexable $indexable ) {
		$trigger_url = $this->zapier_helper->get_trigger_url();
		$zapier_data = $this->zapier_helper->get_data_for_zapier( $indexable );

		$response = \wp_remote_post(
			$trigger_url,
			[
				'body' => $zapier_data,
			]
		);

		if ( ! $response instanceof WP_Error ) {
			// Need to cast the new value to a string as booleans aren't supported.
			$this->meta_helper->set_value( 'zapier_trigger_sent', '1', $indexable->object_id );
		}
	}
}
