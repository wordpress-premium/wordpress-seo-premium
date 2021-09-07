<?php
/**
 * Graceful deprecation of various classes which were renamed.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @package Yoast\WP\SEO\Premium
 *
 * @since      17.0
 * @deprecated 17.0
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */

namespace Yoast\WP\SEO\Routes;

use Yoast\WP\SEO\Helpers\Indexing_Helper;
use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action;
use Yoast\WP\SEO\Premium\Actions\Zapier_Action;
use Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route as New_Link_Suggestions_Route;
use Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route as New_Prominent_Words_Route;
use Yoast\WP\SEO\Premium\Routes\Zapier_Route as New_Zapier_Route;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 17.0' );

/**
 * Class Link_Suggestions_Route.
 *
 * @deprecated 17.0 Use {@see \Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route} instead.
 */
class Link_Suggestions_Route extends New_Link_Suggestions_Route {

	/**
	 * Link_Suggestions_Route constructor.
	 *
	 * @deprecated 17.0 Use {@see \Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route} instead.
	 *
	 * @param Link_Suggestions_Action $link_suggestions_action The action to handle the requests to the endpoint.
	 */
	public function __construct( Link_Suggestions_Action $link_suggestions_action ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 17.0', '\Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route' );
		parent::__construct( $link_suggestions_action );
	}
}

/**
 * Class Prominent_Words_Route.
 *
 * @deprecated 17.0 Use {@see \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route} instead.
 */
class Prominent_Words_Route extends New_Prominent_Words_Route {

	/**
	 * Prominent_Words_Route constructor.
	 *
	 * @deprecated 17.0 Use {@see \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route} instead.
	 *
	 * @param Content_Action  $content_action  The content action.
	 * @param Save_Action     $save_action     The save action.
	 * @param Complete_Action $complete_action The complete action.
	 * @param Indexing_Helper $indexing_helper The indexing helper.
	 */
	public function __construct(
		Content_Action $content_action,
		Save_Action $save_action,
		Complete_Action $complete_action,
		Indexing_Helper $indexing_helper
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 17.0', '\Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route' );
		parent::__construct( $content_action, $save_action, $complete_action, $indexing_helper );
	}
}

/**
 * Class Zapier_Route.
 *
 * @deprecated 17.0 Use {@see \Yoast\WP\SEO\Premium\Routes\Zapier_Route} instead.
 */
class Zapier_Route extends New_Zapier_Route {

	/**
	 * Zapier_Route constructor.
	 *
	 * @deprecated 17.0 Use {@see \Yoast\WP\SEO\Premium\Routes\Zapier_Route} instead.
	 *
	 * @param Zapier_Action $zapier_action The action to handle the requests to the endpoint.
	 */
	public function __construct( Zapier_Action $zapier_action ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 17.0', '\Yoast\WP\SEO\Premium\Routes\Zapier_Route' );
		parent::__construct( $zapier_action );
	}
}
