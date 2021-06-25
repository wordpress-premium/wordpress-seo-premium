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

namespace Yoast\WP\SEO\Integrations\Blocks;

use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block as New_Estimated_Reading_Time_Block;
use Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block as New_Related_Links_Block;
use Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks as New_Schema_Blocks;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.5' );

/**
 * Class Estimated_Reading_Time_Block.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block} instead.
 */
class Estimated_Reading_Time_Block extends New_Estimated_Reading_Time_Block {

	/**
	 * Class constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block} instead.
	 */
	public function __construct() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block' );
	}
}

/**
 * Class Related_Links_Block.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block} instead.
 */
class Related_Links_Block extends New_Related_Links_Block {

	/**
	 * Class constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block} instead.
	 */
	public function __construct() {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block' );
	}
}

/**
 * Class Schema_Blocks.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks} instead.
 */
class Schema_Blocks extends New_Schema_Blocks {

	/**
	 * Schema_Blocks constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks} instead.
	 *
	 * @param WPSEO_Admin_Asset_Manager $asset_manager The asset manager.
	 */
	public function __construct( WPSEO_Admin_Asset_Manager $asset_manager ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks' );
		parent::__construct( $asset_manager );
	}
}
