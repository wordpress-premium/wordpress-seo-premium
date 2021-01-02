<?php

namespace Yoast\WP\SEO\Integrations\Admin\Prominent_Words;

use WPSEO_Language_Utils;
use Yoast\WP\SEO\Actions\Indexing\Indexable_General_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Type_Archive_Indexation_Action;
use Yoast\WP\SEO\Actions\Indexing\Indexable_Term_Indexation_Action;
use Yoast\WP\SEO\Actions\Prominent_Words\Content_Action;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Conditionals\Migrations_Conditional;
use Yoast\WP\SEO\Helpers\Language_Helper;
use Yoast\WP\SEO\Helpers\Prominent_Words_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Routes\Prominent_Words_Route;

/**
 * Class Indexing_Integration.
 *
 * @package Yoast\WP\SEO\Integrations\Admin\Prominent_Words
 */
class Indexing_Integration implements Integration_Interface {

	/**
	 * Number of prominent words to index per indexable
	 * when a language has function word support.
	 *
	 * @var int
	 */
	const PER_INDEXABLE_LIMIT = 20;

	/**
	 * Number of prominent words to index per indexable
	 * when a language does not have function word support.
	 *
	 * @var int
	 */
	const PER_INDEXABLE_LIMIT_NO_FUNCTION_WORD_SUPPORT = 30;

	/**
	 * Holds the content action.
	 *
	 * @var Content_Action
	 */
	protected $content_indexation_action;

	/**
	 * The post indexing action.
	 *
	 * @var Indexable_Post_Indexation_Action
	 */
	protected $post_indexation_action;

	/**
	 * The term indexing action.
	 *
	 * @var Indexable_Term_Indexation_Action
	 */
	protected $term_indexation_action;

	/**
	 * The post type archive indexing action.
	 *
	 * @var Indexable_Post_Type_Archive_Indexation_Action
	 */
	protected $post_type_archive_indexation_action;

	/**
	 * Represents the general indexing action.
	 *
	 * @var Indexable_General_Indexation_Action
	 */
	protected $general_indexation_action;

	/**
	 * Represents the language helper.
	 *
	 * @var Language_Helper
	 */
	protected $language_helper;

	/**
	 * Represents the prominent words helper.
	 *
	 * @var Prominent_Words_Helper
	 */
	protected $prominent_words_helper;

	/**
	 * Holds the total number of unindexed objects.
	 *
	 * @var int
	 */
	protected $total_unindexed;

	/**
	 * WPSEO_Premium_Prominent_Words_Recalculation constructor.
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
		$this->content_indexation_action           = $content_indexation_action;
		$this->post_indexation_action              = $post_indexation_action;
		$this->term_indexation_action              = $term_indexation_action;
		$this->general_indexation_action           = $general_indexation_action;
		$this->post_type_archive_indexation_action = $post_type_archive_indexation_action;
		$this->language_helper                     = $language_helper;
		$this->prominent_words_helper              = $prominent_words_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		\add_filter( 'wpseo_indexing_data', [ $this, 'adapt_indexing_data' ] );
		\add_filter( 'wpseo_indexing_get_unindexed_count', [ $this, 'get_unindexed_count' ] );
		\add_filter( 'wpseo_indexing_endpoints', [ $this, 'add_endpoints' ] );
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [
			Admin_Conditional::class,
			Migrations_Conditional::class,
		];
	}

	/**
	 * Retrieves the endpoints to call.
	 *
	 * @param array $endpoints The endpoints to extend.
	 *
	 * @return array The endpoints.
	 */
	public function add_endpoints( $endpoints ) {
		$endpoints['get_content']    = Prominent_Words_Route::FULL_GET_CONTENT_ROUTE;
		$endpoints['complete_words'] = Prominent_Words_Route::FULL_COMPLETE_ROUTE;

		return $endpoints;
	}

	/**
	 * Adapts the indexing data as sent to the JavaScript side of the
	 * indexing process.
	 *
	 * Adds the appropriate prominent words endpoints and other settings.
	 *
	 * @param array $data The data to be adapted.
	 *
	 * @return array The adapted indexing data.
	 */
	public function adapt_indexing_data( $data ) {
		$site_locale = \get_locale();
		$language    = WPSEO_Language_Utils::get_language( $site_locale );

		$data['locale']   = $site_locale;
		$data['language'] = $language;

		$data['morphologySupported'] = $this->language_helper->is_word_form_recognition_active( $language );

		$per_indexable_limit = self::PER_INDEXABLE_LIMIT_NO_FUNCTION_WORD_SUPPORT;
		if ( $this->language_helper->has_function_word_support( $language ) ) {
			$per_indexable_limit = self::PER_INDEXABLE_LIMIT;
		}

		$data['prominentWords'] = [
			'endpoint'          => Prominent_Words_Route::FULL_SAVE_ROUTE,
			'perIndexableLimit' => $per_indexable_limit,
		];

		return $data;
	}

	/**
	 * Enqueues the required scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'wpseo_tools' || ( $_GET['page'] === 'wpseo_tools' && isset( $_GET['tool'] ) ) ) {
			return;
		}

		$is_completed = ( (int) $this->get_unindexed_count( 0 ) === 0 );
		$this->prominent_words_helper->set_indexing_completed( $is_completed );

		\wp_enqueue_script( 'yoast-premium-prominent-words-indexation' );
	}

	/**
	 * Returns the total number of unindexed objects.
	 *
	 * @param int $unindexed_count The unindexed count.
	 *
	 * @return int The total number of indexables to recalculate.
	 */
	public function get_unindexed_count( $unindexed_count ) {
		// Get the number of indexables that haven't had their prominent words indexed yet.
		$unindexed_count += $this->content_indexation_action->get_total_unindexed();

		// Take posts and terms into account that do not have indexables yet.
		$unindexed_count += $this->post_indexation_action->get_total_unindexed();
		$unindexed_count += $this->term_indexation_action->get_total_unindexed();
		$unindexed_count += $this->general_indexation_action->get_total_unindexed();
		$unindexed_count += $this->post_type_archive_indexation_action->get_total_unindexed();

		return $unindexed_count;
	}
}
