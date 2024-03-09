<?php

namespace Yoast\WP\SEO\Premium\Introductions\Application;

use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Introductions\Application\User_Allowed_Trait;
use Yoast\WP\SEO\Introductions\Domain\Introduction_Interface;

/**
 * Represents the introduction for the AI generate titles and introduction upsell.
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Ai_Generate_Titles_And_Descriptions_Introduction implements Introduction_Interface {

	use User_Allowed_Trait;

	public const ID = 'ai-generate-titles-and-descriptions';

	/**
	 * Holds the options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * Holds the user helper.
	 *
	 * @var User_Helper
	 */
	private $user_helper;

	/**
	 * Constructs the introduction.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 * @param User_Helper    $user_helper    The user helper.
	 */
	public function __construct( Options_Helper $options_helper, User_Helper $user_helper ) {
		$this->options_helper = $options_helper;
		$this->user_helper    = $user_helper;
	}

	/**
	 * Returns the ID.
	 *
	 * @return string
	 */
	public function get_id() {
		return self::ID;
	}

	/**
	 * Returns the unique name.
	 *
	 * @deprecated 21.6
	 * @codeCoverageIgnore
	 *
	 * @return string
	 */
	public function get_name() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 21.6', 'Please use get_id() instead' );

		return self::ID;
	}

	/**
	 * Returns the requested pagination priority. Lower means earlier.
	 *
	 * @return int
	 */
	public function get_priority() {
		return 10;
	}

	/**
	 * Returns whether this introduction should show.
	 *
	 * @return bool
	 */
	public function should_show() {
		// Feature was already enabled, no need to introduce it again.
		if ( $this->options_helper->get( 'ai_enabled_pre_default', false ) ) {
			return false;
		}

		// Get the current user ID, if no user is logged in we bail as this is needed for the next checks.
		$current_user_id = $this->user_helper->get_current_user_id();
		if ( $current_user_id === 0 ) {
			return false;
		}

		// Consent was already given, no need to ask again.
		if ( $this->user_helper->get_meta( $current_user_id, '_yoast_wpseo_ai_consent', true ) ) {
			return false;
		}

		if ( ! $this->is_user_allowed( [ 'edit_posts' ] ) ) {
			return false;
		}

		return true;
	}
}
