<?php
/**
 * Graceful deprecation of various classes which were renamed.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @package Yoast\WP\SEO\Premium
 *
 * @since      16.5
 * @deprecated 16.5
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */

namespace Yoast\WP\SEO\Initializers;

use Yoast\WP\SEO\Premium\Initializers\Redirect_Handler as New_Redirect_Handler;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.5' );

/**
 * Class Redirect_Handler.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Initializers\Redirect_Handler} instead.
 */
class Redirect_Handler extends New_Redirect_Handler {

	/**
	 * Class constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Initializers\Redirect_Handler} instead.
	 */
	public function __construct() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Initializers\Redirect_Handler' );
	}
}
