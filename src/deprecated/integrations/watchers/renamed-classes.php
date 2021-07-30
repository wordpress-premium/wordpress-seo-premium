<?php
/**
 * Graceful deprecation of various classes which were renamed.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @package Yoast\WP\SEO\Premium
 *
 * @since      16.8
 * @deprecated 16.8
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */

namespace Yoast\WP\SEO\Integrations\Watchers;

use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher as New_Premium_Option_Wpseo_Watcher;
use Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher as New_Zapier_APIKey_Reset_Watcher;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.8' );

/**
 * Class Premium_Option_Wpseo_Watcher.
 *
 * @deprecated 16.8 Use {@see \Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher} instead.
 */
class Premium_Option_Wpseo_Watcher extends New_Premium_Option_Wpseo_Watcher {

	/**
	 * Watcher constructor.
	 *
	 * @deprecated 16.8 Use {@see \Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher} instead.
	 *
	 * @param Options_Helper $options The options helper.
	 */
	public function __construct( Options_Helper $options ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.8', '\Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher' );
		parent::__construct( $options );
	}
}

/**
 * Class Zapier_APIKey_Reset_Watcher.
 *
 * @deprecated 16.8 Use {@see \Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher} instead.
 */
class Zapier_APIKey_Reset_Watcher extends New_Zapier_APIKey_Reset_Watcher {

	/**
	 * Watcher constructor.
	 *
	 * @deprecated 16.8 Use {@see \Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher} instead.
	 *
	 * @param Options_Helper $options The options helper.
	 */
	public function __construct( Options_Helper $options ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.8', '\Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher' );
		parent::__construct( $options );
	}
}
