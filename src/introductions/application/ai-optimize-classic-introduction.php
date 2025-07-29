<?php

namespace Yoast\WP\SEO\Premium\Introductions\Application;

use WP_Screen;
use Yoast\WP\SEO\Conditionals\Admin\Post_Conditional;
use Yoast\WP\SEO\Conditionals\Third_Party\Elementor_Edit_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Introductions\Application\User_Allowed_Trait;
use Yoast\WP\SEO\Introductions\Domain\Introduction_Interface;

/**
 * Represents the introduction for the AI Optimize feature in Classic Editor.
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class AI_Optimize_Classic_Introduction implements Introduction_Interface {

	use User_Allowed_Trait;

	public const ID = 'ai-optimize-classic';

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
	 * Returns the name of the introduction.
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
	 *
	 * @return bool Whether this introduction should show.
	 */
	public function should_show() {
		// Get the current user ID, if no user is logged in, we bail as this is needed for the next check.
		$current_user_id = $this->user_helper->get_current_user_id();
		if ( $current_user_id === 0 ) {
			return false;
		}

		// Check if the user is allowed to edit posts.
		if ( ! $this->is_user_allowed( [ 'edit_posts' ] ) ) {
			return false;
		}

		// Check if we are editing a post.
		$post_conditional = new Post_Conditional();
		if ( ! $post_conditional->is_met() ) {
			return false;
		}

		// Check if the block editor is NOT active.
		if ( WP_Screen::get()->is_block_editor() ) {
			return false;
		}

		// Check if Elementor is NOT active.
		$elementor_conditional = new Elementor_Edit_Conditional();
		if ( $elementor_conditional->is_met() ) {
			return false;
		}

		return true;
	}
}
