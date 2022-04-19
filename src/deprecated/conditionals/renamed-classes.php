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

namespace Yoast\WP\SEO\Conditionals;

use Yoast\WP\SEO\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional as New_Zapier_Enabled_Conditional;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.5' );

/**
 * Class Zapier_Enabled_Conditional.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional} instead.
 */
class Zapier_Enabled_Conditional extends New_Zapier_Enabled_Conditional {

	/**
	 * Zapier_Enabled_Conditional constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional} instead.
	 *
	 * @param Zapier_Helper $zapier The Zapier helper.
	 */
	public function __construct( Zapier_Helper $zapier ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional' );
		parent::__construct( $zapier );
	}
}
