<?php

namespace Yoast\WP\SEO\Premium\Introductions\Application;

use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Introductions\Application\User_Allowed_Trait;
use Yoast\WP\SEO\Introductions\Domain\Introduction_Interface;

/**
 * Represents the introduction for the AI fix assessments feature.
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Ai_Fix_Assessments_Introduction implements Introduction_Interface {

	use User_Allowed_Trait;

	public const ID = 'ai-fix-assessments';

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
	 * @return string The ID.
	 */
	public function get_id() {
		return self::ID;
	}

	/**
	 * Returns the name of the introdyction.
	 *
	 * @return string The name.
	 */
	public function get_name() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 21.6', 'Please use get_id() instead' );

		return self::ID;
	}

	/**
	 * Returns the requested pagination priority. Lower means earlier.
	 *
	 * @return int The priority.
	 */
	public function get_priority() {
		return 10;
	}

	/**
	 * Returns whether this introduction should show.
	 * We no longer show this introduction, so we always return false.
	 *
	 * @return bool Whether this introduction should show.
	 */
	public function should_show() {
		return false;
	}
}
