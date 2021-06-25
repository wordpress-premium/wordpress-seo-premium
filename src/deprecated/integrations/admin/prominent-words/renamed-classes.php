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

namespace Yoast\WP\SEO\Integrations\Admin\Prominent_Words;

use Yoast\WP\SEO\Actions\Indexing\Indexable_General_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Type_Archive_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Term_Indexation_Action;
use Yoast\WP\SEO\Helpers\Language_Helper;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action;
use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration as New_Indexing_Integration;
use Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration as New_Metabox_Integration;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.5' );

/**
 * Class Indexing_Integration.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration} instead.
 */
class Indexing_Integration extends New_Indexing_Integration {

	/**
	 * WPSEO_Premium_Prominent_Words_Recalculation constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration} instead.
	 *
	 * @param Content_Action                                $content_indexation_action           The content indexing action.
	 * @param Indexable_Post_Indexation_Action              $post_indexation_action              The post indexing action.
	 * @param Indexable_Term_Indexation_Action              $term_indexation_action              The term indexing action.
	 * @param Indexable_General_Indexation_Action           $general_indexation_action           The general indexing action.
	 * @param Indexable_Post_Type_Archive_Indexation_Action $post_type_archive_indexation_action The post type archive indexing action.
	 * @param Language_Helper                               $language_helper                     The language helper.
	 * @param Prominent_Words_Helper                        $prominent_words_helper              The prominent words helper.
	 */
	public function __construct(
		Content_Action $content_indexation_action,
		Indexable_Post_Indexation_Action $post_indexation_action,
		Indexable_Term_Indexation_Action $term_indexation_action,
		Indexable_General_Indexation_Action $general_indexation_action,
		Indexable_Post_Type_Archive_Indexation_Action $post_type_archive_indexation_action,
		Language_Helper $language_helper,
		Prominent_Words_Helper $prominent_words_helper
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration' );

		parent::__construct(
			$content_indexation_action,
			$post_indexation_action,
			$term_indexation_action,
			$general_indexation_action,
			$post_type_archive_indexation_action,
			$language_helper,
			$prominent_words_helper
		);
	}
}

/**
 * Class Metabox_Integration.
 *
 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration} instead.
 */
class Metabox_Integration extends New_Metabox_Integration {

	/**
	 * Prominent_Words_Metabox constructor.
	 *
	 * @deprecated 16.5 Use {@see \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration} instead.
	 *
	 * @param Save_Action $save_action The prominent words save action.
	 */
	public function __construct( Save_Action $save_action ) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.5', '\Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration' );
		parent::__construct( $save_action );
	}
}
