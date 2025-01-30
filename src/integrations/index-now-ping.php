<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use WP_Post;
use WPSEO_Remote_Request;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Index_Now_Ping class.
 */
class Index_Now_Ping implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * The post type helper.
	 *
	 * @var Post_Type_Helper
	 */
	private $post_type_helper;

	/**
	 * The IndexNow endpoint URL we're using.
	 *
	 * @var string
	 */
	private $endpoint;

	/**
	 * Index_Now_Ping integration constructor.
	 *
	 * @param Options_Helper   $options_helper   The option helper.
	 * @param Post_Type_Helper $post_type_helper The post type helper.
	 */
	public function __construct(
		Options_Helper $options_helper,
		Post_Type_Helper $post_type_helper
	) {
		$this->options_helper   = $options_helper;
		$this->post_type_helper = $post_type_helper;

		/**
		 * Filter: 'Yoast\WP\SEO\indexnow_endpoint' - Allow changing the Indexnow endpoint.
		 *
		 * Note: This is a Premium plugin-only hook.
		 *
		 * @since 18.8
		 *
		 * @param string $endpoint The IndexNow endpoint URL.
		 */
		$this->endpoint = \apply_filters( 'Yoast\WP\SEO\indexnow_endpoint', 'https://api.indexnow.org/indexnow' );
	}

	/**
	 * Registers the hooks this integration acts on.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( $this->options_helper->get( 'enable_index_now' ) === false ) {
			return;
		}

		if ( \wp_get_environment_type() !== 'production' ) {
			return;
		}

		/**
		 * Please note that the name transition_post_status is misleading.
		 * The hook does not only fire on a post status transition but also when a post is updated
		 * while the status is not changed from one to another at all.
		 */
		\add_action( 'transition_post_status', [ $this, 'ping_index_now' ], 10, 3 );
	}

	/**
	 * Pings IndexNow for changes.
	 *
	 * @param string  $new_status The new status for the post.
	 * @param string  $old_status The old status for the post.
	 * @param WP_Post $post       The post.
	 *
	 * @return void
	 */
	public function ping_index_now( $new_status, $old_status, $post ) {
		if ( $new_status !== 'publish' && $old_status !== 'publish' ) {
			// If we're not transitioning to or from a published status, do nothing.
			return;
		}

		// The block editor saves published posts twice, we want to ping only on the first request.
		if ( $new_status === 'publish' && \wp_is_serving_rest_request() ) {
			return;
		}

		if ( ! $post instanceof WP_Post ) {
			return;
		}

		if ( ! \in_array( $post->post_type, $this->post_type_helper->get_accessible_post_types(), true )
			|| ! $this->post_type_helper->is_indexable( $post->post_type ) ) {
			return;
		}

		// Bail out if last ping was less than two minutes ago.
		$indexnow_last_ping = \get_post_meta( $post->ID, '_yoast_indexnow_last_ping', true );
		if ( \is_numeric( $indexnow_last_ping ) && \abs( \time() - ( (int) $indexnow_last_ping ) ) < 120 ) {
			return;
		}

		$key       = $this->options_helper->get( 'index_now_key' );
		$permalink = $this->get_permalink( $post );
		$urls      = [ $permalink ];

		if ( $post->post_type === 'post' ) {
			$urls[] = \get_home_url();
		}

		if ( ! empty( \get_option( 'permalink_structure' ) ) ) {
			$key_location = \trailingslashit( \get_home_url() ) . 'yoast-index-now-' . $key . '.txt';
		}
		else {
			$key_location = \add_query_arg( 'yoast_index_now_key', $key, \trailingslashit( \get_home_url() ) );
		}

		$content = (object) [
			'host'        => \wp_parse_url( \get_home_url(), \PHP_URL_HOST ),
			'key'         => $key,
			'keyLocation' => $key_location,
			'urlList'     => $urls,
		];

		// Set a 'content-type' header of 'application/json' and an identifying source header.
		// The "false" on the end of the x-source-info header determines whether this is a manual submission or not.
		$request_args = [
			'headers' => [
				'content-type'  => 'application/json; charset=utf-8',
				'x-source-info' => 'https://yoast.com/wordpress/plugins/seo-premium/' . \WPSEO_PREMIUM_VERSION . '/false',
			],
		];

		$request = new WPSEO_Remote_Request( $this->endpoint, $request_args );
		// phpcs:ignore Yoast.Yoast.JsonEncodeAlternative.Found -- This is being sent to an API, not displayed.
		$request->set_body( \wp_json_encode( $content ) );
		$request->send();

		\update_post_meta( $post->ID, '_yoast_indexnow_last_ping', \time() );
	}

	/**
	 * Determines the (former) permalink for a post.
	 *
	 * @param WP_Post $post Post object.
	 *
	 * @return string Permalink.
	 */
	private function get_permalink( WP_Post $post ) {
		if ( \in_array( $post->post_status, [ 'trash', 'draft', 'pending', 'future' ], true ) ) {
			if ( $post->post_status === 'trash' ) {
				// Fix the post_name.
				$post->post_name = \preg_replace( '/__trashed$/', '', $post->post_name );
			}
			// Force post_status to publish briefly, so we get the correct URL.
			$post->post_status = 'publish';
		}

		return \get_permalink( $post );
	}
}
