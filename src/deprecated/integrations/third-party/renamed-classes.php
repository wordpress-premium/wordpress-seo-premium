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

namespace Yoast\WP\SEO\Integrations\Third_Party;

use WPSEO_Admin_Asset_Manager;
use Yoast\WP\SEO\Helpers\Meta_Helper;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper;
use Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium as New_Elementor_Premium;
use Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier as New_Zapier;
use Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor as New_Zapier_Classic_Editor;
use Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger as New_Zapier_Trigger;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.5' );

/**
 * Class Elementor_Premium.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium} instead.
 */
class Elementor_Premium extends New_Elementor_Premium {

	/**
	 * Constructs the class.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium} instead.
	 *
	 * @param Prominent_Words_Helper $prominent_words_helper The prominent words helper.
	 */
	public function __construct( Prominent_Words_Helper $prominent_words_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium' );
		parent::__construct( $prominent_words_helper );
	}
}

/**
 * Class Zapier.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier} instead.
 */
class Zapier extends New_Zapier {

	/**
	 * Zapier constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier} instead.
	 *
	 * @param WPSEO_Admin_Asset_Manager $asset_manager The admin asset manager.
	 * @param Zapier_Helper             $zapier_helper The Zapier helper.
	 */
	public function __construct( WPSEO_Admin_Asset_Manager $asset_manager, Zapier_Helper $zapier_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier' );
		parent::__construct( $asset_manager, $zapier_helper );
	}
}

/**
 * Class Zapier_Classic_Editor.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor} instead.
 */
class Zapier_Classic_Editor extends New_Zapier_Classic_Editor {

	/**
	 * Zapier constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor} instead.
	 *
	 * @param Zapier_Helper $zapier_helper The Zapier helper.
	 */
	public function __construct( Zapier_Helper $zapier_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor' );
		parent::__construct( $zapier_helper );
	}
}

/**
 * Class Zapier_Trigger.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger} instead.
 */
class Zapier_Trigger extends New_Zapier_Trigger {

	/**
	 * Zapier constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger} instead.
	 *
	 * @param Meta_Helper   $meta_helper   The meta helper.
	 * @param Zapier_Helper $zapier_helper The Zapier helper.
	 */
	public function __construct( Meta_Helper $meta_helper, Zapier_Helper $zapier_helper ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger' );
		parent::__construct( $meta_helper, $zapier_helper );
	}
}
