<?php
/**
 * Graceful deprecation of various classes which were renamed.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @package Yoast\WP\SEO\Premium
 *
 * @since      16.1
 * @deprecated 16.1
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */

namespace Yoast\WP\SEO\Actions;

use WPSEO_Premium_Prominent_Words_Support;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action as New_Link_Suggestions_Action;
use Yoast\WP\SEO\Premium\Actions\Zapier_Action as New_Zapier_Action;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use Yoast\WP\SEO\Repositories\Prominent_Words_Repository;
use Yoast\WP\SEO\Repositories\SEO_Links_Repository;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.1' );

/**
 * Class Link_Suggestions_Action.
 *
 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action} instead.
 */
class Link_Suggestions_Action extends New_Link_Suggestions_Action {

	/**
	 * Link_Suggestions_Service constructor.
	 *
	 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action} instead.
	 *
	 * @param Prominent_Words_Repository            $prominent_words_repository The repository to retrieve prominent words from.
	 * @param Indexable_Repository                  $indexable_repository       The repository to retrieve indexables from.
	 * @param Prominent_Words_Helper                $prominent_words_helper     Class with helper methods for prominent words.
	 * @param WPSEO_Premium_Prominent_Words_Support $prominent_words_support    The prominent words support class.
	 * @param SEO_Links_Repository                  $links_repository           The repository to retrieve links from.
	 */
	public function __construct(
		Prominent_Words_Repository $prominent_words_repository,
		Indexable_Repository $indexable_repository,
		Prominent_Words_Helper $prominent_words_helper,
		WPSEO_Premium_Prominent_Words_Support $prominent_words_support,
		SEO_Links_Repository $links_repository
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.1', '\Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action' );

		parent::__construct(
			$prominent_words_repository,
			$indexable_repository,
			$prominent_words_helper,
			$prominent_words_support,
			$links_repository
		);
	}
}

/**
 * Class Zapier_Action.
 *
 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Zapier_Action} instead.
 */
class Zapier_Action extends New_Zapier_Action {

	/**
	 * Zapier_Action constructor.
	 *
	 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Zapier_Action} instead.
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
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.1', '\Yoast\WP\SEO\Premium\Actions\Zapier_Action' );

		parent::__construct( $options_helper, $zapier_helper, $indexable_repository );
	}
}
