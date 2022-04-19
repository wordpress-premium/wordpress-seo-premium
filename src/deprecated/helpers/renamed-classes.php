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

namespace Yoast\WP\SEO\Helpers;

use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper as New_Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper as New_Zapier_Helper;
use Yoast\WP\SEO\Surfaces\Meta_Surface;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.5' );

/**
 * Class Prominent_Words_Helper.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper} instead.
 */
class Prominent_Words_Helper extends New_Prominent_Words_Helper {

	/**
	 * Prominent_Words_Helper constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper} instead.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct( Options_Helper $options_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper' );
		parent::__construct( $options_helper );
	}
}

/**
 * Class Zapier_Helper.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Helpers\Zapier_Helper} instead.
 */
class Zapier_Helper extends New_Zapier_Helper {

	/**
	 * Zapier_Helper constructor.
	 *
	 * @deprecated 16.5    Use {@see \Yoast\WP\SEO\Premium\Helpers\Zapier_Helper} instead.
	 * @codeCoverageIgnore It only sets dependencies.
	 *
	 * @param Options_Helper $options      The options helper.
	 * @param Meta_Surface   $meta_surface The Meta surface.
	 */
	public function __construct( Options_Helper $options, Meta_Surface $meta_surface ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Helpers\Zapier_Helper' );
		parent::__construct( $options, $meta_surface );
	}
}
