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

namespace Yoast\WP\SEO\WordPress;

use Yoast\WP\SEO\Premium\WordPress\Wrapper;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.1' );

/**
 * Class Premium_Wrapper.
 *
 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\WordPress\Wrapper} instead.
 */
class Premium_Wrapper extends Wrapper {

	/**
	 * Class constructor.
	 *
	 * @deprecated 16.1 Use {@see \Yoast\WP\SEO\Premium\WordPress\Wrapper} instead.
	 */
	public function __construct() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.1', '\Yoast\WP\SEO\Premium\WordPress\Wrapper' );
		parent::__construct();
	}
}
