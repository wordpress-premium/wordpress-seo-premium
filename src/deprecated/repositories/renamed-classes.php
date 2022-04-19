<?php
/**
 * Graceful deprecation of various classes which were renamed.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @package Yoast\WP\SEO\Premium
 *
 * @since      16.9
 * @deprecated 16.9
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */

namespace Yoast\WP\SEO\Repositories;

use Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository as New_Prominent_Words_Repository;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.9' );

/**
 * Class Prominent_Words_Repository.
 *
 * @deprecated 16.9 Use {@see \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository} instead.
 */
class Prominent_Words_Repository extends New_Prominent_Words_Repository {

	/**
	 * Class constructor.
	 *
	 * @deprecated 16.9 Use {@see \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository} instead.
	 */
	public function __construct() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.9', '\Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository' );
		parent::__construct();
	}
}
