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

namespace Yoast\WP\SEO\Actions\Prominent_Words;

use WPSEO_Premium_Prominent_Words_Support;
use Yoast\WP\SEO\Helpers\Meta_Helper;
use Yoast\WP\SEO\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action as New_Complete_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action as New_Content_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action as New_Save_Action;
use Yoast\WP\SEO\Repositories\Indexable_Repository;
use Yoast\WP\SEO\Repositories\Prominent_Words_Repository;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.1' );

/**
 * Class Complete_Action.
 *
 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action} instead.
 */
class Complete_Action extends New_Complete_Action {

	/**
	 * Complete_Action constructor.
	 *
	 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action} instead.
	 *
	 * @param Prominent_Words_Helper $prominent_words_helper The prominent words helper.
	 */
	public function __construct( Prominent_Words_Helper $prominent_words_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.1', '\Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action' );
		parent::__construct( $prominent_words_helper );
	}
}

/**
 * Class Content_Action.
 *
 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action} instead.
 */
class Content_Action extends New_Content_Action {

	/**
	 * Content_Action constructor.
	 *
	 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action} instead.
	 *
	 * @param WPSEO_Premium_Prominent_Words_Support $prominent_words_support An instance of
	 *                                                                       WPSEO_Premium_Prominent_Words_Support.
	 * @param Indexable_Repository                  $indexable_repository    An instance of Indexable_Repository.
	 * @param Meta_Tags_Context_Memoizer            $memoizer                The meta tags context memoizer.
	 * @param Meta_Helper                           $meta                    The meta value helper.
	 */
	public function __construct(
		WPSEO_Premium_Prominent_Words_Support $prominent_words_support,
		Indexable_Repository $indexable_repository,
		Meta_Tags_Context_Memoizer $memoizer,
		Meta_Helper $meta
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.1', '\Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action' );
		parent::__construct( $prominent_words_support, $indexable_repository, $memoizer, $meta );
	}
}

/**
 * Class Save_Action.
 *
 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action} instead.
 */
class Save_Action extends New_Save_Action {

	/**
	 * Prominent_Words_Link_Service constructor.
	 *
	 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action} instead.
	 *
	 * @param Prominent_Words_Repository $prominent_words_repository The repository to create, read, update and delete
	 *                                                               prominent words from.
	 * @param Indexable_Repository       $indexable_repository       The repository to read, update and delete
	 *                                                               indexables from.
	 * @param Prominent_Words_Helper     $prominent_words_helper     The prominent words helper.
	 */
	public function __construct(
		Prominent_Words_Repository $prominent_words_repository,
		Indexable_Repository $indexable_repository,
		Prominent_Words_Helper $prominent_words_helper
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.1', '\Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action' );
		parent::__construct( $prominent_words_repository, $indexable_repository, $prominent_words_helper );
	}
}
