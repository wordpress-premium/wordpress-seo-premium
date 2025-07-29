<?php // phpcs:ignore Yoast.Files.FileName.InvalidClassFileName -- Reason: this explicitly concerns the Yoast admin.

namespace Yoast\WP\SEO\Premium\Conditionals;

use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Conditionals\Conditional;
use Yoast\WP\SEO\Main;

/**
 * Conditional that is only met when on either on a Yoast SEO admin page or on the Yoast introductions rest route.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Admin_Or_Introductions_Route_Conditional implements Conditional {

	/**
	 * Holds the Admin_Conditional.
	 *
	 * @var Admin_Conditional
	 */
	private $admin_conditional;

	/**
	 * Constructs the instance.
	 *
	 * @param Admin_Conditional $admin_conditional The Admin_Conditional.
	 */
	public function __construct( Admin_Conditional $admin_conditional ) {
		$this->admin_conditional = $admin_conditional;
	}

	/**
	 * Returns whether this conditional is met.
	 *
	 * @return bool Whether the conditional is met.
	 */
	public function is_met() {
		if ( $this->admin_conditional->is_met() ) {
			return true;
		}

		if ( $this->is_post_request() && $this->is_introductions_rest_request() ) {
			return true;
		}

		return false;
	}

	/**
	 * Whether the request method is POST.
	 *
	 * @return bool
	 */
	private function is_post_request() {
		if ( ! isset( $_SERVER['REQUEST_METHOD'] ) ) {
			return false;
		}

		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	/**
	 * Whether the request URI starts with the prefix, Yoast API V1 and introductions.
	 *
	 * @return bool
	 */
	private function is_introductions_rest_request() {
		if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {
			return false;
		}

		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- Variable is only used in a case-insensitive comparison.
		return \stripos( $_SERVER['REQUEST_URI'], '/' . \rest_get_url_prefix() . '/' . Main::API_V1_NAMESPACE . '/introductions/' ) === 0;
	}
}
