<?php

namespace Yoast\WP\SEO\Premium\Generated;

use YoastSEO_Vendor\Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\ContainerInterface;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\Container;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\Exception\LogicException;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\Exception\RuntimeException;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class Cached_Container extends Container
{
    private $parameters = [];
    private $targetDirs = [];

    public function __construct()
    {
        $this->services = [];
        $this->normalizedIds = [
            'wpseo_admin_asset_manager' => 'WPSEO_Admin_Asset_Manager',
            'wpseo_premium_prominent_words_support' => 'WPSEO_Premium_Prominent_Words_Support',
            'wpseo_premium_prominent_words_unindexed_post_query' => 'WPSEO_Premium_Prominent_Words_Unindexed_Post_Query',
            'wpseo_shortlinker' => 'WPSEO_Shortlinker',
            'yoast\\wp\\lib\\migrations\\adapter' => 'Yoast\\WP\\Lib\\Migrations\\Adapter',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_general_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_post_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_post_type_archive_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_term_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action',
            'yoast\\wp\\seo\\actions\\link_suggestions_action' => 'Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action',
            'yoast\\wp\\seo\\actions\\prominent_words\\complete_action' => 'Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action',
            'yoast\\wp\\seo\\actions\\prominent_words\\content_action' => 'Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action',
            'yoast\\wp\\seo\\actions\\prominent_words\\save_action' => 'Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action',
            'yoast\\wp\\seo\\actions\\zapier_action' => 'Yoast\\WP\\SEO\\Actions\\Zapier_Action',
            'yoast\\wp\\seo\\builders\\indexable_term_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder',
            'yoast\\wp\\seo\\conditionals\\admin_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional',
            'yoast\\wp\\seo\\conditionals\\front_end_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional',
            'yoast\\wp\\seo\\conditionals\\migrations_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional',
            'yoast\\wp\\seo\\conditionals\\open_graph_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional',
            'yoast\\wp\\seo\\conditionals\\schema_blocks_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Schema_Blocks_Conditional',
            'yoast\\wp\\seo\\conditionals\\third_party\\elementor_edit_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional',
            'yoast\\wp\\seo\\conditionals\\yoast_admin_and_dashboard_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional',
            'yoast\\wp\\seo\\conditionals\\zapier_enabled_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Zapier_Enabled_Conditional',
            'yoast\\wp\\seo\\config\\migration_status' => 'Yoast\\WP\\SEO\\Config\\Migration_Status',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastpremiumimprovedinternallinking' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking',
            'yoast\\wp\\seo\\database\\migration_runner_premium' => 'Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium',
            'yoast\\wp\\seo\\helpers\\date_helper' => 'Yoast\\WP\\SEO\\Helpers\\Date_Helper',
            'yoast\\wp\\seo\\helpers\\indexing_helper' => 'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper',
            'yoast\\wp\\seo\\helpers\\language_helper' => 'Yoast\\WP\\SEO\\Helpers\\Language_Helper',
            'yoast\\wp\\seo\\helpers\\meta_helper' => 'Yoast\\WP\\SEO\\Helpers\\Meta_Helper',
            'yoast\\wp\\seo\\helpers\\options_helper' => 'Yoast\\WP\\SEO\\Helpers\\Options_Helper',
            'yoast\\wp\\seo\\helpers\\post_type_helper' => 'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper',
            'yoast\\wp\\seo\\helpers\\prominent_words_helper' => 'Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper',
            'yoast\\wp\\seo\\helpers\\url_helper' => 'Yoast\\WP\\SEO\\Helpers\\Url_Helper',
            'yoast\\wp\\seo\\helpers\\wordpress_helper' => 'Yoast\\WP\\SEO\\Helpers\\Wordpress_Helper',
            'yoast\\wp\\seo\\helpers\\zapier_helper' => 'Yoast\\WP\\SEO\\Helpers\\Zapier_Helper',
            'yoast\\wp\\seo\\initializers\\redirect_handler' => 'Yoast\\WP\\SEO\\Initializers\\Redirect_Handler',
            'yoast\\wp\\seo\\integrations\\blocks\\block_patterns' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Block_Patterns',
            'yoast\\wp\\seo\\integrations\\blocks\\estimated_reading_time_block' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block',
            'yoast\\wp\\seo\\integrations\\blocks\\job_posting_block' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block',
            'yoast\\wp\\seo\\integrations\\blocks\\related_links_block' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block',
            'yoast\\wp\\seo\\integrations\\blocks\\schema_blocks' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks',
            'yoast\\wp\\seo\\integrations\\third_party\\elementor_premium' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium',
            'yoast\\wp\\seo\\integrations\\third_party\\translationspress' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress',
            'yoast\\wp\\seo\\integrations\\third_party\\zapier' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier',
            'yoast\\wp\\seo\\integrations\\third_party\\zapier_classic_editor' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor',
            'yoast\\wp\\seo\\integrations\\third_party\\zapier_trigger' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger',
            'yoast\\wp\\seo\\integrations\\watchers\\premium_option_wpseo_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\zapier_apikey_reset_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher',
            'yoast\\wp\\seo\\loader' => 'Yoast\\WP\\SEO\\Loader',
            'yoast\\wp\\seo\\memoizers\\meta_tags_context_memoizer' => 'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer',
            'yoast\\wp\\seo\\premium\\actions\\link_suggestions_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action',
            'yoast\\wp\\seo\\premium\\actions\\prominent_words\\complete_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action',
            'yoast\\wp\\seo\\premium\\actions\\prominent_words\\content_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action',
            'yoast\\wp\\seo\\premium\\actions\\prominent_words\\save_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action',
            'yoast\\wp\\seo\\premium\\actions\\zapier_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action',
            'yoast\\wp\\seo\\premium\\conditionals\\algolia_enabled_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Algolia_Enabled_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\zapier_enabled_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Zapier_Enabled_Conditional',
            'yoast\\wp\\seo\\premium\\config\\badge_group_names' => 'Yoast\\WP\\SEO\\Premium\\Config\\Badge_Group_Names',
            'yoast\\wp\\seo\\premium\\config\\migrations\\addindexonindexableidandstem' => 'Yoast\\WP\\SEO\\Premium\\Config\\Migrations\\AddIndexOnIndexableIdAndStem',
            'yoast\\wp\\seo\\premium\\database\\migration_runner_premium' => 'Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium',
            'yoast\\wp\\seo\\premium\\helpers\\prominent_words_helper' => 'Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper',
            'yoast\\wp\\seo\\premium\\helpers\\zapier_helper' => 'Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper',
            'yoast\\wp\\seo\\premium\\initializers\\plugin' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin',
            'yoast\\wp\\seo\\premium\\initializers\\redirect_handler' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\plugin_links_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\prominent_words\\indexing_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\prominent_words\\metabox_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\thank_you_page_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\user_profile_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\workouts_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\blocks\\estimated_reading_time_block' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block',
            'yoast\\wp\\seo\\premium\\integrations\\blocks\\related_links_block' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block',
            'yoast\\wp\\seo\\premium\\integrations\\blocks\\schema_blocks' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Schema_Blocks',
            'yoast\\wp\\seo\\premium\\integrations\\cleanup_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_author_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_date_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_post_type' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_posttype_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_term_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\routes\\workouts_routes_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\algolia' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\elementor_premium' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\zapier' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\zapier_classic_editor' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Classic_Editor',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\zapier_trigger' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Trigger',
            'yoast\\wp\\seo\\premium\\integrations\\upgrade_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\user_profile_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\watchers\\premium_option_wpseo_watcher' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher',
            'yoast\\wp\\seo\\premium\\integrations\\watchers\\zapier_apikey_reset_watcher' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher',
            'yoast\\wp\\seo\\premium\\main' => 'Yoast\\WP\\SEO\\Premium\\Main',
            'yoast\\wp\\seo\\premium\\repositories\\prominent_words_repository' => 'Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository',
            'yoast\\wp\\seo\\premium\\routes\\link_suggestions_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route',
            'yoast\\wp\\seo\\premium\\routes\\prominent_words_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route',
            'yoast\\wp\\seo\\premium\\routes\\workouts_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route',
            'yoast\\wp\\seo\\premium\\routes\\zapier_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Zapier_Route',
            'yoast\\wp\\seo\\premium\\surfaces\\helpers_surface' => 'Yoast\\WP\\SEO\\Premium\\Surfaces\\Helpers_Surface',
            'yoast\\wp\\seo\\repositories\\indexable_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository',
            'yoast\\wp\\seo\\repositories\\prominent_words_repository' => 'Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository',
            'yoast\\wp\\seo\\repositories\\seo_links_repository' => 'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository',
            'yoast\\wp\\seo\\routes\\link_suggestions_route' => 'Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route',
            'yoast\\wp\\seo\\routes\\prominent_words_route' => 'Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route',
            'yoast\\wp\\seo\\routes\\zapier_route' => 'Yoast\\WP\\SEO\\Routes\\Zapier_Route',
            'yoast\\wp\\seo\\schema_templates\\block_patterns\\block_pattern_categories' => 'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Block_Pattern_Categories',
            'yoast\\wp\\seo\\schema_templates\\block_patterns\\block_pattern_keywords' => 'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Block_Pattern_Keywords',
            'yoast\\wp\\seo\\schema_templates\\block_patterns\\job_posting_one_column' => 'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_One_Column',
            'yoast\\wp\\seo\\schema_templates\\block_patterns\\job_posting_two_columns' => 'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_Two_Columns',
            'yoast\\wp\\seo\\surfaces\\classes_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface',
            'yoast\\wp\\seo\\surfaces\\helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\meta_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface',
            'yoast\\wp\\seo\\surfaces\\open_graph_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\schema_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\twitter_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface',
            'yoastseo_vendor\\symfony\\component\\dependencyinjection\\containerinterface' => 'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface',
        ];
        $this->methodMap = [
            'WPSEO_Admin_Asset_Manager' => 'getWPSEOAdminAssetManagerService',
            'WPSEO_Premium_Prominent_Words_Support' => 'getWPSEOPremiumProminentWordsSupportService',
            'WPSEO_Premium_Prominent_Words_Unindexed_Post_Query' => 'getWPSEOPremiumProminentWordsUnindexedPostQueryService',
            'WPSEO_Shortlinker' => 'getWPSEOShortlinkerService',
            'Yoast\\WP\\Lib\\Migrations\\Adapter' => 'getAdapterService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action' => 'getIndexableGeneralIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action' => 'getIndexablePostIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action' => 'getIndexablePostTypeArchiveIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action' => 'getIndexableTermIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action' => 'getLinkSuggestionsActionService',
            'Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action' => 'getCompleteActionService',
            'Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action' => 'getContentActionService',
            'Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action' => 'getSaveActionService',
            'Yoast\\WP\\SEO\\Actions\\Zapier_Action' => 'getZapierActionService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder' => 'getIndexableTermBuilderService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional' => 'getAdminConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional' => 'getFrontEndConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional' => 'getMigrationsConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional' => 'getOpenGraphConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Schema_Blocks_Conditional' => 'getSchemaBlocksConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional' => 'getElementorEditConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional' => 'getYoastAdminAndDashboardConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Zapier_Enabled_Conditional' => 'getZapierEnabledConditionalService',
            'Yoast\\WP\\SEO\\Config\\Migration_Status' => 'getMigrationStatusService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking' => 'getWpYoastPremiumImprovedInternalLinkingService',
            'Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium' => 'getMigrationRunnerPremiumService',
            'Yoast\\WP\\SEO\\Helpers\\Date_Helper' => 'getDateHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper' => 'getIndexingHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Language_Helper' => 'getLanguageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Meta_Helper' => 'getMetaHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Options_Helper' => 'getOptionsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper' => 'getPostTypeHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper' => 'getProminentWordsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Url_Helper' => 'getUrlHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Wordpress_Helper' => 'getWordpressHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Zapier_Helper' => 'getZapierHelperService',
            'Yoast\\WP\\SEO\\Initializers\\Redirect_Handler' => 'getRedirectHandlerService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Block_Patterns' => 'getBlockPatternsService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block' => 'getEstimatedReadingTimeBlockService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block' => 'getJobPostingBlockService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block' => 'getRelatedLinksBlockService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks' => 'getSchemaBlocksService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium' => 'getElementorPremiumService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress' => 'getTranslationsPressService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier' => 'getZapierService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor' => 'getZapierClassicEditorService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger' => 'getZapierTriggerService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher' => 'getPremiumOptionWpseoWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher' => 'getZapierAPIKeyResetWatcherService',
            'Yoast\\WP\\SEO\\Loader' => 'getLoaderService',
            'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer' => 'getMetaTagsContextMemoizerService',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action' => 'getLinkSuggestionsAction2Service',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action' => 'getCompleteAction2Service',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action' => 'getContentAction2Service',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action' => 'getSaveAction2Service',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action' => 'getZapierAction2Service',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Algolia_Enabled_Conditional' => 'getAlgoliaEnabledConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Zapier_Enabled_Conditional' => 'getZapierEnabledConditional2Service',
            'Yoast\\WP\\SEO\\Premium\\Config\\Badge_Group_Names' => 'getBadgeGroupNamesService',
            'Yoast\\WP\\SEO\\Premium\\Config\\Migrations\\AddIndexOnIndexableIdAndStem' => 'getAddIndexOnIndexableIdAndStemService',
            'Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium' => 'getMigrationRunnerPremium2Service',
            'Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper' => 'getProminentWordsHelper2Service',
            'Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper' => 'getZapierHelper2Service',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin' => 'getPluginService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler' => 'getRedirectHandler2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration' => 'getPluginLinksIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration' => 'getIndexingIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration' => 'getMetaboxIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration' => 'getThankYouPageIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration' => 'getUserProfileIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration' => 'getWorkoutsIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block' => 'getEstimatedReadingTimeBlock2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block' => 'getRelatedLinksBlock2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Schema_Blocks' => 'getSchemaBlocks2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration' => 'getCleanupIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive' => 'getOpenGraphAuthorArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive' => 'getOpenGraphDateArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive' => 'getOpenGraphPostTypeArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type' => 'getOpenGraphPostTypeService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive' => 'getOpenGraphTermArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration' => 'getWorkoutsRoutesIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia' => 'getAlgoliaService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium' => 'getElementorPremium2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier' => 'getZapier2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Classic_Editor' => 'getZapierClassicEditor2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Trigger' => 'getZapierTrigger2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration' => 'getUpgradeIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration' => 'getUserProfileIntegration2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher' => 'getPremiumOptionWpseoWatcher2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher' => 'getZapierAPIKeyResetWatcher2Service',
            'Yoast\\WP\\SEO\\Premium\\Main' => 'getMainService',
            'Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository' => 'getProminentWordsRepositoryService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route' => 'getLinkSuggestionsRouteService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route' => 'getProminentWordsRouteService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route' => 'getWorkoutsRouteService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Zapier_Route' => 'getZapierRouteService',
            'Yoast\\WP\\SEO\\Premium\\Surfaces\\Helpers_Surface' => 'getHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => 'getIndexableRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository' => 'getProminentWordsRepository2Service',
            'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository' => 'getSEOLinksRepositoryService',
            'Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route' => 'getLinkSuggestionsRoute2Service',
            'Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route' => 'getProminentWordsRoute2Service',
            'Yoast\\WP\\SEO\\Routes\\Zapier_Route' => 'getZapierRoute2Service',
            'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Block_Pattern_Categories' => 'getBlockPatternCategoriesService',
            'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Block_Pattern_Keywords' => 'getBlockPatternKeywordsService',
            'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_One_Column' => 'getJobPostingOneColumnService',
            'Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_Two_Columns' => 'getJobPostingTwoColumnsService',
            'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface' => 'getClassesSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface' => 'getHelpersSurface2Service',
            'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface' => 'getMetaSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface' => 'getOpenGraphHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface' => 'getSchemaHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface' => 'getTwitterHelpersSurfaceService',
        ];
        $this->privates = [
            'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
        ];
        $this->aliases = [
            'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => 'service_container',
        ];
    }

    public function getRemovedIds()
    {
        return [
            'Psr\\Container\\ContainerInterface' => true,
            'YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
        ];
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return true;
    }

    /**
     * Gets the public 'WPSEO_Admin_Asset_Manager' shared service.
     *
     * @return \WPSEO_Admin_Asset_Manager
     */
    protected function getWPSEOAdminAssetManagerService()
    {
        return $this->services['WPSEO_Admin_Asset_Manager'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'WPSEO_Admin_Asset_Manager');
    }

    /**
     * Gets the public 'WPSEO_Premium_Prominent_Words_Support' shared service.
     *
     * @return \WPSEO_Premium_Prominent_Words_Support
     */
    protected function getWPSEOPremiumProminentWordsSupportService()
    {
        return $this->services['WPSEO_Premium_Prominent_Words_Support'] = \Yoast\WP\SEO\Premium\WordPress\Wrapper::get_prominent_words_support();
    }

    /**
     * Gets the public 'WPSEO_Premium_Prominent_Words_Unindexed_Post_Query' shared service.
     *
     * @return \WPSEO_Premium_Prominent_Words_Unindexed_Post_Query
     */
    protected function getWPSEOPremiumProminentWordsUnindexedPostQueryService()
    {
        return $this->services['WPSEO_Premium_Prominent_Words_Unindexed_Post_Query'] = \Yoast\WP\SEO\Premium\WordPress\Wrapper::get_prominent_words_unindex_post_query();
    }

    /**
     * Gets the public 'WPSEO_Shortlinker' shared service.
     *
     * @return \WPSEO_Shortlinker
     */
    protected function getWPSEOShortlinkerService()
    {
        return $this->services['WPSEO_Shortlinker'] = \Yoast\WP\SEO\Premium\WordPress\Wrapper::get_shortlinker();
    }

    /**
     * Gets the public 'Yoast\WP\Lib\Migrations\Adapter' shared service.
     *
     * @return \Yoast\WP\Lib\Migrations\Adapter
     */
    protected function getAdapterService()
    {
        return $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\Lib\\Migrations\\Adapter');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexing\Indexable_General_Indexation_Action' shared service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexing\Indexable_General_Indexation_Action
     */
    protected function getIndexableGeneralIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Indexation_Action' shared service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Indexation_Action
     */
    protected function getIndexablePostIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Type_Archive_Indexation_Action' shared service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexing\Indexable_Post_Type_Archive_Indexation_Action
     */
    protected function getIndexablePostTypeArchiveIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexing\Indexable_Term_Indexation_Action' shared service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexing\Indexable_Term_Indexation_Action
     */
    protected function getIndexableTermIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Link_Suggestions_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Link_Suggestions_Action
     *
     * @deprecated Yoast\WP\SEO\Actions\Link_Suggestions_Action is deprecated since version 16.1! Use Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action instead.
     */
    protected function getLinkSuggestionsActionService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action is deprecated since version 16.1! Use Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action'] = new \Yoast\WP\SEO\Actions\Link_Suggestions_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] : $this->getProminentWordsRepository2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] : $this->getSEOLinksRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action
     *
     * @deprecated Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action is deprecated since version 16.1! Use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action instead.
     */
    protected function getCompleteActionService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action is deprecated since version 16.1! Use Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action'] = new \Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Prominent_Words\Content_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Prominent_Words\Content_Action
     *
     * @deprecated Yoast\WP\SEO\Actions\Prominent_Words\Content_Action is deprecated since version 16.1! Use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action instead.
     */
    protected function getContentActionService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action is deprecated since version 16.1! Use Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action'] = new \Yoast\WP\SEO\Actions\Prominent_Words\Content_Action(${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Prominent_Words\Save_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Prominent_Words\Save_Action
     *
     * @deprecated Yoast\WP\SEO\Actions\Prominent_Words\Save_Action is deprecated since version 16.1! Use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action instead.
     */
    protected function getSaveActionService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action is deprecated since version 16.1! Use Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action'] = new \Yoast\WP\SEO\Actions\Prominent_Words\Save_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] : $this->getProminentWordsRepository2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Zapier_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Zapier_Action
     *
     * @deprecated Yoast\WP\SEO\Actions\Zapier_Action is deprecated since version 16.1! Use Yoast\WP\SEO\Premium\Actions\Zapier_Action instead.
     */
    protected function getZapierActionService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Actions\\Zapier_Action is deprecated since version 16.1! Use Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Actions\\Zapier_Action'] = new \Yoast\WP\SEO\Actions\Zapier_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] : $this->getZapierHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Term_Builder' shared service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Term_Builder
     */
    protected function getIndexableTermBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Admin_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Admin_Conditional
     */
    protected function getAdminConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Front_End_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Front_End_Conditional
     */
    protected function getFrontEndConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Migrations_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Migrations_Conditional
     */
    protected function getMigrationsConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Open_Graph_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Open_Graph_Conditional
     */
    protected function getOpenGraphConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Schema_Blocks_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Schema_Blocks_Conditional
     */
    protected function getSchemaBlocksConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Schema_Blocks_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Schema_Blocks_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Third_Party\Elementor_Edit_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Third_Party\Elementor_Edit_Conditional
     */
    protected function getElementorEditConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Yoast_Admin_And_Dashboard_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Yoast_Admin_And_Dashboard_Conditional
     */
    protected function getYoastAdminAndDashboardConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Zapier_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Zapier_Enabled_Conditional
     *
     * @deprecated Yoast\WP\SEO\Conditionals\Zapier_Enabled_Conditional is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional instead.
     */
    protected function getZapierEnabledConditionalService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Conditionals\\Zapier_Enabled_Conditional is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Conditionals\\Zapier_Enabled_Conditional instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Zapier_Enabled_Conditional'] = new \Yoast\WP\SEO\Conditionals\Zapier_Enabled_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] : $this->getZapierHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migration_Status' shared service.
     *
     * @return \Yoast\WP\SEO\Config\Migration_Status
     */
    protected function getMigrationStatusService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Config\\Migration_Status');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\WpYoastPremiumImprovedInternalLinking' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\WpYoastPremiumImprovedInternalLinking
     */
    protected function getWpYoastPremiumImprovedInternalLinkingService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking'] = new \Yoast\WP\SEO\Config\Migrations\WpYoastPremiumImprovedInternalLinking(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : $this->getAdapterService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Database\Migration_Runner_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Database\Migration_Runner_Premium
     *
     * @deprecated Yoast\WP\SEO\Database\Migration_Runner_Premium is deprecated since version 16.3! Use Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium instead.
     */
    protected function getMigrationRunnerPremiumService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium is deprecated since version 16.3! Use Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium'] = new \Yoast\WP\SEO\Database\Migration_Runner_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : $this->getMigrationStatusService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loader']) ? $this->services['Yoast\\WP\\SEO\\Loader'] : $this->getLoaderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : $this->getAdapterService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Date_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Date_Helper
     */
    protected function getDateHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Date_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Indexing_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Indexing_Helper
     */
    protected function getIndexingHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Language_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Language_Helper
     */
    protected function getLanguageHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Language_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Meta_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Meta_Helper
     */
    protected function getMetaHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Meta_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Options_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Options_Helper
     */
    protected function getOptionsHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Options_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Post_Type_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Post_Type_Helper
     */
    protected function getPostTypeHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Prominent_Words_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Prominent_Words_Helper
     *
     * @deprecated Yoast\WP\SEO\Helpers\Prominent_Words_Helper is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper instead.
     */
    protected function getProminentWordsHelperService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] = new \Yoast\WP\SEO\Helpers\Prominent_Words_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Url_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Url_Helper
     */
    protected function getUrlHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Url_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Wordpress_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Wordpress_Helper
     */
    protected function getWordpressHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Wordpress_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Wordpress_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Zapier_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Zapier_Helper
     *
     * @deprecated Yoast\WP\SEO\Helpers\Zapier_Helper is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Helpers\Zapier_Helper instead.
     */
    protected function getZapierHelperService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Helpers\\Zapier_Helper is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] = new \Yoast\WP\SEO\Helpers\Zapier_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Initializers\Redirect_Handler' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Initializers\Redirect_Handler
     *
     * @deprecated Yoast\WP\SEO\Initializers\Redirect_Handler is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Initializers\Redirect_Handler instead.
     */
    protected function getRedirectHandlerService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Initializers\\Redirect_Handler is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Initializers\\Redirect_Handler'] = new \Yoast\WP\SEO\Initializers\Redirect_Handler();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Block_Patterns' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Block_Patterns
     */
    protected function getBlockPatternsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Block_Patterns'] = new \Yoast\WP\SEO\Integrations\Blocks\Block_Patterns(${($_ = isset($this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_One_Column']) ? $this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_One_Column'] : ($this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_One_Column'] = new \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_One_Column())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_Two_Columns']) ? $this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_Two_Columns'] : ($this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_Two_Columns'] = new \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_Two_Columns())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block
     *
     * @deprecated Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block instead.
     */
    protected function getEstimatedReadingTimeBlockService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block'] = new \Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Job_Posting_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Job_Posting_Block
     */
    protected function getJobPostingBlockService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block'] = new \Yoast\WP\SEO\Integrations\Blocks\Job_Posting_Block(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Wordpress_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Wordpress_Helper'] : $this->getWordpressHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block
     *
     * @deprecated Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block instead.
     */
    protected function getRelatedLinksBlockService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block'] = new \Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks
     *
     * @deprecated Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks instead.
     */
    protected function getSchemaBlocksService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Schema_Blocks instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks'] = new \Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium
     *
     * @deprecated Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium instead.
     */
    protected function getElementorPremiumService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium'] = new \Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\TranslationsPress' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\TranslationsPress
     */
    protected function getTranslationsPressService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress'] = new \Yoast\WP\SEO\Integrations\Third_Party\TranslationsPress(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] : $this->getDateHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Zapier' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Zapier
     *
     * @deprecated Yoast\WP\SEO\Integrations\Third_Party\Zapier is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier instead.
     */
    protected function getZapierService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier'] = new \Yoast\WP\SEO\Integrations\Third_Party\Zapier(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor
     *
     * @deprecated Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor instead.
     */
    protected function getZapierClassicEditorService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Classic_Editor instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor'] = new \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger
     *
     * @deprecated Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger is deprecated since version 16.5! Use Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger instead.
     */
    protected function getZapierTriggerService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger is deprecated since version 16.5! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Trigger instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger'] = new \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher
     *
     * @deprecated Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher is deprecated since version 16.8! Use Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher instead.
     */
    protected function getPremiumOptionWpseoWatcherService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher is deprecated since version 16.8! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Zapier_APIKey_Reset_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Zapier_APIKey_Reset_Watcher
     *
     * @deprecated Yoast\WP\SEO\Integrations\Watchers\Zapier_APIKey_Reset_Watcher is deprecated since version 16.8! Use Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher instead.
     */
    protected function getZapierAPIKeyResetWatcherService()
    {
        @trigger_error('Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher is deprecated since version 16.8! Use Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Zapier_APIKey_Reset_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Loader' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Loader
     */
    protected function getLoaderService()
    {
        $this->services['Yoast\\WP\\SEO\\Loader'] = $instance = new \Yoast\WP\SEO\Loader($this);

        $instance->register_migration('premium', '20190715101200', 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking');
        $instance->register_migration('premium', '20210827093024', 'Yoast\\WP\\SEO\\Premium\\Config\\Migrations\\AddIndexOnIndexableIdAndStem');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Block_Patterns');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Schema_Blocks');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Classic_Editor');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Trigger');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Zapier_Route');

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer' shared service.
     *
     * @return \Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer
     */
    protected function getMetaTagsContextMemoizerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action
     */
    protected function getLinkSuggestionsAction2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] = new \Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] : $this->getSEOLinksRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action
     */
    protected function getCompleteAction2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action'] = new \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action
     */
    protected function getContentAction2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] = new \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action(${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action
     */
    protected function getSaveAction2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] = new \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Zapier_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Zapier_Action
     */
    protected function getZapierAction2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action'] = new \Yoast\WP\SEO\Premium\Actions\Zapier_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Algolia_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Algolia_Enabled_Conditional
     */
    protected function getAlgoliaEnabledConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Algolia_Enabled_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Algolia_Enabled_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional
     */
    protected function getZapierEnabledConditional2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Zapier_Enabled_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Zapier_Enabled_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Config\Badge_Group_Names' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Config\Badge_Group_Names
     */
    protected function getBadgeGroupNamesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Config\\Badge_Group_Names'] = new \Yoast\WP\SEO\Premium\Config\Badge_Group_Names();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Config\Migrations\AddIndexOnIndexableIdAndStem' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Config\Migrations\AddIndexOnIndexableIdAndStem
     */
    protected function getAddIndexOnIndexableIdAndStemService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Config\\Migrations\\AddIndexOnIndexableIdAndStem'] = new \Yoast\WP\SEO\Premium\Config\Migrations\AddIndexOnIndexableIdAndStem(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : $this->getAdapterService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium
     */
    protected function getMigrationRunnerPremium2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium'] = new \Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : $this->getMigrationStatusService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loader']) ? $this->services['Yoast\\WP\\SEO\\Loader'] : $this->getLoaderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : $this->getAdapterService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper
     */
    protected function getProminentWordsHelper2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Helpers\Zapier_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Helpers\Zapier_Helper
     */
    protected function getZapierHelper2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Zapier_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Plugin' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Plugin
     */
    protected function getPluginService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin'] = new \Yoast\WP\SEO\Premium\Initializers\Plugin(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Redirect_Handler' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Redirect_Handler
     */
    protected function getRedirectHandler2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler'] = new \Yoast\WP\SEO\Premium\Initializers\Redirect_Handler();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Plugin_Links_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Plugin_Links_Integration
     */
    protected function getPluginLinksIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Plugin_Links_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration
     */
    protected function getIndexingIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action'] : $this->getIndexablePostIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action'] : $this->getIndexableTermIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action'] : $this->getIndexableGeneralIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action'] : $this->getIndexablePostTypeArchiveIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper'] : $this->getLanguageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : $this->getUrlHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration
     */
    protected function getMetaboxIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveAction2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Thank_You_Page_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Thank_You_Page_Integration
     */
    protected function getThankYouPageIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Thank_You_Page_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\User_Profile_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\User_Profile_Integration
     */
    protected function getUserProfileIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\User_Profile_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Workouts_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Workouts_Integration
     */
    protected function getWorkoutsIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Workouts_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Shortlinker']) ? $this->services['WPSEO_Shortlinker'] : $this->getWPSEOShortlinkerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block
     */
    protected function getEstimatedReadingTimeBlock2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block'] = new \Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block
     */
    protected function getRelatedLinksBlock2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block'] = new \Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks
     */
    protected function getSchemaBlocks2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Schema_Blocks'] = new \Yoast\WP\SEO\Premium\Integrations\Blocks\Schema_Blocks(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Cleanup_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Cleanup_Integration
     */
    protected function getCleanupIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Cleanup_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\OpenGraph_Author_Archive' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Author_Archive
     */
    protected function getOpenGraphAuthorArchiveService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive'] = new \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Author_Archive(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\OpenGraph_Date_Archive' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Date_Archive
     */
    protected function getOpenGraphDateArchiveService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive'] = new \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Date_Archive(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\OpenGraph_PostType_Archive' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\OpenGraph_PostType_Archive
     */
    protected function getOpenGraphPostTypeArchiveService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive'] = new \Yoast\WP\SEO\Premium\Integrations\OpenGraph_PostType_Archive(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\OpenGraph_Post_Type' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Post_Type
     */
    protected function getOpenGraphPostTypeService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type'] = new \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Post_Type(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\OpenGraph_Term_Archive' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Term_Archive
     */
    protected function getOpenGraphTermArchiveService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive'] = new \Yoast\WP\SEO\Premium\Integrations\OpenGraph_Term_Archive(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Routes\Workouts_Routes_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Routes\Workouts_Routes_Integration
     */
    protected function getWorkoutsRoutesIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Routes\Workouts_Routes_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Shortlinker']) ? $this->services['WPSEO_Shortlinker'] : $this->getWPSEOShortlinkerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Algolia' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Algolia
     */
    protected function getAlgoliaService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Algolia(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium
     */
    protected function getElementorPremium2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier
     */
    protected function getZapier2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor
     */
    protected function getZapierClassicEditor2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Classic_Editor'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Classic_Editor(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger
     */
    protected function getZapierTrigger2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Zapier_Trigger'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Zapier_Trigger(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Zapier_Helper'] : $this->getZapierHelper2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Upgrade_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Upgrade_Integration
     */
    protected function getUpgradeIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Upgrade_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\User_Profile_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\User_Profile_Integration
     */
    protected function getUserProfileIntegration2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\User_Profile_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher
     */
    protected function getPremiumOptionWpseoWatcher2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher'] = new \Yoast\WP\SEO\Premium\Integrations\Watchers\Premium_Option_Wpseo_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher
     */
    protected function getZapierAPIKeyResetWatcher2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher'] = new \Yoast\WP\SEO\Premium\Integrations\Watchers\Zapier_APIKey_Reset_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Main' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Main
     */
    protected function getMainService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Main'] = new \Yoast\WP\SEO\Premium\Main();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository
     */
    protected function getProminentWordsRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route
     */
    protected function getLinkSuggestionsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route'] = new \Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsAction2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route
     */
    protected function getProminentWordsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route'] = new \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action'] : $this->getCompleteAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper'] : $this->getIndexingHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Routes\Workouts_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Routes\Workouts_Route
     */
    protected function getWorkoutsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route'] = new \Yoast\WP\SEO\Premium\Routes\Workouts_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] : $this->getIndexableTermBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Routes\Zapier_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Routes\Zapier_Route
     */
    protected function getZapierRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Zapier_Route'] = new \Yoast\WP\SEO\Premium\Routes\Zapier_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action'] : $this->getZapierAction2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Surfaces\Helpers_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Surfaces\Helpers_Surface
     */
    protected function getHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Surfaces\\Helpers_Surface'] = new \Yoast\WP\SEO\Premium\Surfaces\Helpers_Surface($this);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\Indexable_Repository' shared service.
     *
     * @return \Yoast\WP\SEO\Repositories\Indexable_Repository
     */
    protected function getIndexableRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\Prominent_Words_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\Prominent_Words_Repository
     *
     * @deprecated Yoast\WP\SEO\Repositories\Prominent_Words_Repository is deprecated since version 16.9! Use Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository instead.
     */
    protected function getProminentWordsRepository2Service()
    {
        @trigger_error('Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository is deprecated since version 16.9! Use Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Repositories\Prominent_Words_Repository();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\SEO_Links_Repository' shared service.
     *
     * @return \Yoast\WP\SEO\Repositories\SEO_Links_Repository
     */
    protected function getSEOLinksRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Link_Suggestions_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Link_Suggestions_Route
     *
     * @deprecated Yoast\WP\SEO\Routes\Link_Suggestions_Route is deprecated since version 17.0! Use Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route instead.
     */
    protected function getLinkSuggestionsRoute2Service()
    {
        @trigger_error('Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route is deprecated since version 17.0! Use Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route'] = new \Yoast\WP\SEO\Routes\Link_Suggestions_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsAction2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Prominent_Words_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Prominent_Words_Route
     *
     * @deprecated Yoast\WP\SEO\Routes\Prominent_Words_Route is deprecated since version 17.0! Use Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route instead.
     */
    protected function getProminentWordsRoute2Service()
    {
        @trigger_error('Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route is deprecated since version 17.0! Use Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route'] = new \Yoast\WP\SEO\Routes\Prominent_Words_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action'] : $this->getCompleteAction2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper'] : $this->getIndexingHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Zapier_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Zapier_Route
     *
     * @deprecated Yoast\WP\SEO\Routes\Zapier_Route is deprecated since version 17.0! Use Yoast\WP\SEO\Premium\Routes\Zapier_Route instead.
     */
    protected function getZapierRoute2Service()
    {
        @trigger_error('Yoast\\WP\\SEO\\Routes\\Zapier_Route is deprecated since version 17.0! Use Yoast\\WP\\SEO\\Premium\\Routes\\Zapier_Route instead.', E_USER_DEPRECATED);

        return $this->services['Yoast\\WP\\SEO\\Routes\\Zapier_Route'] = new \Yoast\WP\SEO\Routes\Zapier_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Zapier_Action'] : $this->getZapierAction2Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Categories' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Categories
     */
    protected function getBlockPatternCategoriesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Block_Pattern_Categories'] = new \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Categories();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Keywords' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Keywords
     */
    protected function getBlockPatternKeywordsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Block_Pattern_Keywords'] = new \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Block_Pattern_Keywords();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_One_Column' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_One_Column
     */
    protected function getJobPostingOneColumnService()
    {
        return $this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_One_Column'] = new \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_One_Column();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_Two_Columns' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_Two_Columns
     */
    protected function getJobPostingTwoColumnsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Schema_Templates\\Block_Patterns\\Job_Posting_Two_Columns'] = new \Yoast\WP\SEO\Schema_Templates\Block_Patterns\Job_Posting_Two_Columns();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Classes_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Classes_Surface
     */
    protected function getClassesSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Classes_Surface'] = new \Yoast\WP\SEO\Surfaces\Classes_Surface($this);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Helpers_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Helpers_Surface
     */
    protected function getHelpersSurface2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Helpers_Surface($this, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface'] : $this->getOpenGraphHelpersSurfaceService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface'] : $this->getSchemaHelpersSurfaceService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface'] : $this->getTwitterHelpersSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Meta_Surface' shared service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Meta_Surface
     */
    protected function getMetaSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Open_Graph_Helpers_Surface' shared service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Open_Graph_Helpers_Surface
     */
    protected function getOpenGraphHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Schema_Helpers_Surface' shared service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Schema_Helpers_Surface
     */
    protected function getSchemaHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Twitter_Helpers_Surface' shared service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Twitter_Helpers_Surface
     */
    protected function getTwitterHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface');
    }
}
