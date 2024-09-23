<?php
/**
 * Graceful deprecation of the Ai_Generate_Titles_And_Descriptions_Introduction class.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @deprecated 23.2
 *
 * @codeCoverageIgnore
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */
namespace Yoast\WP\SEO\Premium\Introductions\Application;

use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\User_Helper;
use Yoast\WP\SEO\Introductions\Application\User_Allowed_Trait;

/**
 * Represents the introduction for the AI generate titles and introduction upsell.
 *
 * @deprecated 23.2 Use {@see \Yoast\WP\SEO\Premium\Introductions\Application\Ai_Fix_Assessments_Introduction} instead.
 */
class Ai_Generate_Titles_And_Descriptions_Introduction extends Ai_Fix_Assessments_Introduction {

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
	 * @deprecated 23.2
	 *
	 * @param Options_Helper $options_helper The options helper.
	 * @param User_Helper    $user_helper    The user helper.
	 */
	public function __construct( Options_Helper $options_helper, User_Helper $user_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO 23.2' );
		$this->options_helper = $options_helper;
		$this->user_helper    = $user_helper;
	}

	/**
	 * Returns the ID.
	 *
	 * @deprecated 23.2
	 * @codeCoverageIgnore
	 *
	 * @return string
	 */
	public function get_id() {
		\_deprecated_function( __METHOD__, 'Yoast SEO 23.2' );
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
	 * @deprecated 23.2
	 * @codeCoverageIgnore
	 *
	 * @return int
	 */
	public function get_priority() {
		\_deprecated_function( __METHOD__, 'Yoast SEO 23.2' );
		return 10;
	}

	/**
	 * Returns whether this introduction should show.
	 *
	 * @deprecated 23.2
	 * @codeCoverageIgnore
	 *
	 * @return bool
	 */
	public function should_show() {
		\_deprecated_function( __METHOD__, 'Yoast SEO 23.2' );
		// Outdated feature introduction.
		return false;
	}
}
