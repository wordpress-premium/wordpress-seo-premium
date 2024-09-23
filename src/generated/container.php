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
            'autowired.yoast\\wp\\seo\\introductions\\infrastructure\\introductions_seen_repository' => 'autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository',
            'wpseo_addon_manager' => 'WPSEO_Addon_Manager',
            'wpseo_admin_asset_manager' => 'WPSEO_Admin_Asset_Manager',
            'wpseo_premium_prominent_words_support' => 'WPSEO_Premium_Prominent_Words_Support',
            'wpseo_premium_prominent_words_unindexed_post_query' => 'WPSEO_Premium_Prominent_Words_Unindexed_Post_Query',
            'wpseo_shortlinker' => 'WPSEO_Shortlinker',
            'yoast\\wp\\lib\\migrations\\adapter' => 'Yoast\\WP\\Lib\\Migrations\\Adapter',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_general_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_post_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_post_type_archive_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexing\\indexable_term_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action',
            'yoast\\wp\\seo\\builders\\indexable_term_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder',
            'yoast\\wp\\seo\\conditionals\\admin\\post_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin\\Post_Conditional',
            'yoast\\wp\\seo\\conditionals\\admin\\posts_overview_or_ajax_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin\\Posts_Overview_Or_Ajax_Conditional',
            'yoast\\wp\\seo\\conditionals\\admin\\yoast_admin_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin\\Yoast_Admin_Conditional',
            'yoast\\wp\\seo\\conditionals\\admin_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional',
            'yoast\\wp\\seo\\conditionals\\front_end_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional',
            'yoast\\wp\\seo\\conditionals\\migrations_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional',
            'yoast\\wp\\seo\\conditionals\\open_graph_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional',
            'yoast\\wp\\seo\\conditionals\\robots_txt_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Robots_Txt_Conditional',
            'yoast\\wp\\seo\\conditionals\\settings_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Settings_Conditional',
            'yoast\\wp\\seo\\conditionals\\third_party\\elementor_activated_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Activated_Conditional',
            'yoast\\wp\\seo\\conditionals\\third_party\\elementor_edit_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional',
            'yoast\\wp\\seo\\conditionals\\user_profile_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\User_Profile_Conditional',
            'yoast\\wp\\seo\\conditionals\\wincher_enabled_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Wincher_Enabled_Conditional',
            'yoast\\wp\\seo\\config\\migration_status' => 'Yoast\\WP\\SEO\\Config\\Migration_Status',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastpremiumimprovedinternallinking' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking',
            'yoast\\wp\\seo\\helpers\\capability_helper' => 'Yoast\\WP\\SEO\\Helpers\\Capability_Helper',
            'yoast\\wp\\seo\\helpers\\current_page_helper' => 'Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper',
            'yoast\\wp\\seo\\helpers\\date_helper' => 'Yoast\\WP\\SEO\\Helpers\\Date_Helper',
            'yoast\\wp\\seo\\helpers\\indexable_helper' => 'Yoast\\WP\\SEO\\Helpers\\Indexable_Helper',
            'yoast\\wp\\seo\\helpers\\indexing_helper' => 'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper',
            'yoast\\wp\\seo\\helpers\\language_helper' => 'Yoast\\WP\\SEO\\Helpers\\Language_Helper',
            'yoast\\wp\\seo\\helpers\\meta_helper' => 'Yoast\\WP\\SEO\\Helpers\\Meta_Helper',
            'yoast\\wp\\seo\\helpers\\options_helper' => 'Yoast\\WP\\SEO\\Helpers\\Options_Helper',
            'yoast\\wp\\seo\\helpers\\post_type_helper' => 'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper',
            'yoast\\wp\\seo\\helpers\\request_helper' => 'Yoast\\WP\\SEO\\Helpers\\Request_Helper',
            'yoast\\wp\\seo\\helpers\\robots_helper' => 'Yoast\\WP\\SEO\\Helpers\\Robots_Helper',
            'yoast\\wp\\seo\\helpers\\score_icon_helper' => 'Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper',
            'yoast\\wp\\seo\\helpers\\social_profiles_helper' => 'Yoast\\WP\\SEO\\Helpers\\Social_Profiles_Helper',
            'yoast\\wp\\seo\\helpers\\url_helper' => 'Yoast\\WP\\SEO\\Helpers\\Url_Helper',
            'yoast\\wp\\seo\\helpers\\user_helper' => 'Yoast\\WP\\SEO\\Helpers\\User_Helper',
            'yoast\\wp\\seo\\integrations\\admin\\admin_columns_cache_integration' => 'Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration',
            'yoast\\wp\\seo\\integrations\\third_party\\translationspress' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress',
            'yoast\\wp\\seo\\integrations\\third_party\\wincher_keyphrases' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Wincher_Keyphrases',
            'yoast\\wp\\seo\\introductions\\infrastructure\\wistia_embed_permission_repository' => 'Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Wistia_Embed_Permission_Repository',
            'yoast\\wp\\seo\\loader' => 'Yoast\\WP\\SEO\\Loader',
            'yoast\\wp\\seo\\memoizers\\meta_tags_context_memoizer' => 'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer',
            'yoast\\wp\\seo\\premium\\actions\\ai_generator_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\AI_Generator_Action',
            'yoast\\wp\\seo\\premium\\actions\\link_suggestions_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action',
            'yoast\\wp\\seo\\premium\\actions\\prominent_words\\complete_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action',
            'yoast\\wp\\seo\\premium\\actions\\prominent_words\\content_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action',
            'yoast\\wp\\seo\\premium\\actions\\prominent_words\\save_action' => 'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action',
            'yoast\\wp\\seo\\premium\\ai_suggestions_postprocessor\\application\\ai_suggestions_serializer' => 'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer',
            'yoast\\wp\\seo\\premium\\ai_suggestions_postprocessor\\application\\ai_suggestions_unifier' => 'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Unifier',
            'yoast\\wp\\seo\\premium\\ai_suggestions_postprocessor\\application\\sentence_processor' => 'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Sentence_Processor',
            'yoast\\wp\\seo\\premium\\ai_suggestions_postprocessor\\application\\suggestion_processor' => 'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor',
            'yoast\\wp\\seo\\premium\\ai_suggestions_postprocessor\\domain\\suggestion' => 'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Domain\\Suggestion',
            'yoast\\wp\\seo\\premium\\conditionals\\ai_editor_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Ai_Editor_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\algolia_enabled_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Algolia_Enabled_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\cornerstone_enabled_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Cornerstone_Enabled_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\edd_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\EDD_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\inclusive_language_enabled_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Inclusive_Language_Enabled_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\term_overview_or_ajax_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Term_Overview_Or_Ajax_Conditional',
            'yoast\\wp\\seo\\premium\\conditionals\\yoast_admin_or_introductions_route_conditional' => 'Yoast\\WP\\SEO\\Premium\\Conditionals\\Yoast_Admin_Or_Introductions_Route_Conditional',
            'yoast\\wp\\seo\\premium\\config\\badge_group_names' => 'Yoast\\WP\\SEO\\Premium\\Config\\Badge_Group_Names',
            'yoast\\wp\\seo\\premium\\config\\migrations\\addindexonindexableidandstem' => 'Yoast\\WP\\SEO\\Premium\\Config\\Migrations\\AddIndexOnIndexableIdAndStem',
            'yoast\\wp\\seo\\premium\\database\\migration_runner_premium' => 'Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium',
            'yoast\\wp\\seo\\premium\\dom_manager\\application\\dom_parser' => 'Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser',
            'yoast\\wp\\seo\\premium\\dom_manager\\application\\node_processor' => 'Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor',
            'yoast\\wp\\seo\\premium\\helpers\\ai_generator_helper' => 'Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper',
            'yoast\\wp\\seo\\premium\\helpers\\current_page_helper' => 'Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper',
            'yoast\\wp\\seo\\premium\\helpers\\prominent_words_helper' => 'Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper',
            'yoast\\wp\\seo\\premium\\helpers\\version_helper' => 'Yoast\\WP\\SEO\\Premium\\Helpers\\Version_Helper',
            'yoast\\wp\\seo\\premium\\initializers\\index_now_key' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Index_Now_Key',
            'yoast\\wp\\seo\\premium\\initializers\\introductions_initializer' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Introductions_Initializer',
            'yoast\\wp\\seo\\premium\\initializers\\plugin' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin',
            'yoast\\wp\\seo\\premium\\initializers\\redirect_handler' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler',
            'yoast\\wp\\seo\\premium\\initializers\\woocommerce' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Woocommerce',
            'yoast\\wp\\seo\\premium\\initializers\\wp_cli_initializer' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Wp_Cli_Initializer',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\ai_consent_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Consent_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\ai_fix_assessments_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Fix_Assessments_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\ai_generator_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Generator_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\cornerstone_column_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Column_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\cornerstone_taxonomy_column_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Taxonomy_Column_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\inclusive_language_column_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Column_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\inclusive_language_filter_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Filter_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\inclusive_language_taxonomy_column_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Taxonomy_Column_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\keyword_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Keyword_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\metabox_formatter_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Metabox_Formatter_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\plugin_links_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\prominent_words\\indexing_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\prominent_words\\metabox_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\related_keyphrase_filter_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Related_Keyphrase_Filter_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\replacement_variables_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Replacement_Variables_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\settings_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Settings_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\thank_you_page_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\update_premium_notification' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Update_Premium_Notification',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\user_profile_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\workouts_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\alerts\\ai_generator_tip_notification' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Alerts\\Ai_Generator_Tip_Notification',
            'yoast\\wp\\seo\\premium\\integrations\\blocks\\estimated_reading_time_block' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block',
            'yoast\\wp\\seo\\premium\\integrations\\blocks\\related_links_block' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block',
            'yoast\\wp\\seo\\premium\\integrations\\cleanup_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\front_end\\robots_txt_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Front_End\\Robots_Txt_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\frontend_inspector' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Frontend_Inspector',
            'yoast\\wp\\seo\\premium\\integrations\\index_now_ping' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Index_Now_Ping',
            'yoast\\wp\\seo\\premium\\integrations\\missing_indexables_count_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Missing_Indexables_Count_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_author_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_date_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_post_type' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_posttype_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\opengraph_term_archive' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive',
            'yoast\\wp\\seo\\premium\\integrations\\organization_schema_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Organization_Schema_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\publishing_principles_schema_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Publishing_Principles_Schema_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\routes\\ai_generator_route' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\AI_Generator_Route',
            'yoast\\wp\\seo\\premium\\integrations\\routes\\workouts_routes_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\algolia' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\edd' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\EDD',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\elementor_premium' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\elementor_preview' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Preview',
            'yoast\\wp\\seo\\premium\\integrations\\third_party\\mastodon' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Mastodon',
            'yoast\\wp\\seo\\premium\\integrations\\upgrade_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\user_profile_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\watchers\\prominent_words_watcher' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Prominent_Words_Watcher',
            'yoast\\wp\\seo\\premium\\integrations\\watchers\\stale_cornerstone_content_watcher' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Stale_Cornerstone_Content_Watcher',
            'yoast\\wp\\seo\\premium\\introductions\\application\\ai_fix_assessments_introduction' => 'Yoast\\WP\\SEO\\Premium\\Introductions\\Application\\Ai_Fix_Assessments_Introduction',
            'yoast\\wp\\seo\\premium\\main' => 'Yoast\\WP\\SEO\\Premium\\Main',
            'yoast\\wp\\seo\\premium\\repositories\\prominent_words_repository' => 'Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository',
            'yoast\\wp\\seo\\premium\\routes\\link_suggestions_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route',
            'yoast\\wp\\seo\\premium\\routes\\prominent_words_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route',
            'yoast\\wp\\seo\\premium\\routes\\workouts_route' => 'Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route',
            'yoast\\wp\\seo\\premium\\surfaces\\helpers_surface' => 'Yoast\\WP\\SEO\\Premium\\Surfaces\\Helpers_Surface',
            'yoast\\wp\\seo\\premium\\user_meta\\framework\\additional_contactmethods\\mastodon' => 'Yoast\\WP\\SEO\\Premium\\User_Meta\\Framework\\Additional_Contactmethods\\Mastodon',
            'yoast\\wp\\seo\\premium\\user_meta\\user_interface\\additional_contactmethods_integration' => 'Yoast\\WP\\SEO\\Premium\\User_Meta\\User_Interface\\Additional_Contactmethods_Integration',
            'yoast\\wp\\seo\\repositories\\indexable_cleanup_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Cleanup_Repository',
            'yoast\\wp\\seo\\repositories\\indexable_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository',
            'yoast\\wp\\seo\\repositories\\seo_links_repository' => 'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository',
            'yoast\\wp\\seo\\surfaces\\classes_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface',
            'yoast\\wp\\seo\\surfaces\\helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\meta_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface',
            'yoast\\wp\\seo\\surfaces\\open_graph_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\schema_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\twitter_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface',
            'yoastseo_vendor\\symfony\\component\\dependencyinjection\\containerinterface' => 'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface',
        ];
        $this->methodMap = [
            'WPSEO_Addon_Manager' => 'getWPSEOAddonManagerService',
            'WPSEO_Admin_Asset_Manager' => 'getWPSEOAdminAssetManagerService',
            'WPSEO_Premium_Prominent_Words_Support' => 'getWPSEOPremiumProminentWordsSupportService',
            'WPSEO_Premium_Prominent_Words_Unindexed_Post_Query' => 'getWPSEOPremiumProminentWordsUnindexedPostQueryService',
            'WPSEO_Shortlinker' => 'getWPSEOShortlinkerService',
            'Yoast\\WP\\Lib\\Migrations\\Adapter' => 'getAdapterService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action' => 'getIndexableGeneralIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action' => 'getIndexablePostIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action' => 'getIndexablePostTypeArchiveIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action' => 'getIndexableTermIndexationActionService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder' => 'getIndexableTermBuilderService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin\\Post_Conditional' => 'getPostConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin\\Posts_Overview_Or_Ajax_Conditional' => 'getPostsOverviewOrAjaxConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin\\Yoast_Admin_Conditional' => 'getYoastAdminConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional' => 'getAdminConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional' => 'getFrontEndConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional' => 'getMigrationsConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional' => 'getOpenGraphConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Robots_Txt_Conditional' => 'getRobotsTxtConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Settings_Conditional' => 'getSettingsConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Activated_Conditional' => 'getElementorActivatedConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional' => 'getElementorEditConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\User_Profile_Conditional' => 'getUserProfileConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Wincher_Enabled_Conditional' => 'getWincherEnabledConditionalService',
            'Yoast\\WP\\SEO\\Config\\Migration_Status' => 'getMigrationStatusService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking' => 'getWpYoastPremiumImprovedInternalLinkingService',
            'Yoast\\WP\\SEO\\Helpers\\Capability_Helper' => 'getCapabilityHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper' => 'getCurrentPageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Date_Helper' => 'getDateHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Indexable_Helper' => 'getIndexableHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper' => 'getIndexingHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Language_Helper' => 'getLanguageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Meta_Helper' => 'getMetaHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Options_Helper' => 'getOptionsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper' => 'getPostTypeHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Request_Helper' => 'getRequestHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Robots_Helper' => 'getRobotsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper' => 'getScoreIconHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Social_Profiles_Helper' => 'getSocialProfilesHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Url_Helper' => 'getUrlHelperService',
            'Yoast\\WP\\SEO\\Helpers\\User_Helper' => 'getUserHelperService',
            'Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration' => 'getAdminColumnsCacheIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress' => 'getTranslationsPressService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Wincher_Keyphrases' => 'getWincherKeyphrasesService',
            'Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Wistia_Embed_Permission_Repository' => 'getWistiaEmbedPermissionRepositoryService',
            'Yoast\\WP\\SEO\\Loader' => 'getLoaderService',
            'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer' => 'getMetaTagsContextMemoizerService',
            'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer' => 'getAISuggestionsSerializerService',
            'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Unifier' => 'getAISuggestionsUnifierService',
            'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Sentence_Processor' => 'getSentenceProcessorService',
            'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor' => 'getSuggestionProcessorService',
            'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Domain\\Suggestion' => 'getSuggestionService',
            'Yoast\\WP\\SEO\\Premium\\Actions\\AI_Generator_Action' => 'getAIGeneratorActionService',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action' => 'getLinkSuggestionsActionService',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action' => 'getCompleteActionService',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action' => 'getContentActionService',
            'Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action' => 'getSaveActionService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Ai_Editor_Conditional' => 'getAiEditorConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Algolia_Enabled_Conditional' => 'getAlgoliaEnabledConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Cornerstone_Enabled_Conditional' => 'getCornerstoneEnabledConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\EDD_Conditional' => 'getEDDConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Inclusive_Language_Enabled_Conditional' => 'getInclusiveLanguageEnabledConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Term_Overview_Or_Ajax_Conditional' => 'getTermOverviewOrAjaxConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Conditionals\\Yoast_Admin_Or_Introductions_Route_Conditional' => 'getYoastAdminOrIntroductionsRouteConditionalService',
            'Yoast\\WP\\SEO\\Premium\\Config\\Badge_Group_Names' => 'getBadgeGroupNamesService',
            'Yoast\\WP\\SEO\\Premium\\Config\\Migrations\\AddIndexOnIndexableIdAndStem' => 'getAddIndexOnIndexableIdAndStemService',
            'Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser' => 'getDOMParserService',
            'Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor' => 'getNodeProcessorService',
            'Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium' => 'getMigrationRunnerPremiumService',
            'Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper' => 'getAIGeneratorHelperService',
            'Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper' => 'getCurrentPageHelper2Service',
            'Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper' => 'getProminentWordsHelperService',
            'Yoast\\WP\\SEO\\Premium\\Helpers\\Version_Helper' => 'getVersionHelperService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Index_Now_Key' => 'getIndexNowKeyService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Introductions_Initializer' => 'getIntroductionsInitializerService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin' => 'getPluginService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler' => 'getRedirectHandlerService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Woocommerce' => 'getWoocommerceService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Wp_Cli_Initializer' => 'getWpCliInitializerService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Consent_Integration' => 'getAiConsentIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Fix_Assessments_Integration' => 'getAiFixAssessmentsIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Generator_Integration' => 'getAiGeneratorIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Column_Integration' => 'getCornerstoneColumnIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Taxonomy_Column_Integration' => 'getCornerstoneTaxonomyColumnIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Column_Integration' => 'getInclusiveLanguageColumnIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Filter_Integration' => 'getInclusiveLanguageFilterIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Taxonomy_Column_Integration' => 'getInclusiveLanguageTaxonomyColumnIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Keyword_Integration' => 'getKeywordIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Metabox_Formatter_Integration' => 'getMetaboxFormatterIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration' => 'getPluginLinksIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration' => 'getIndexingIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration' => 'getMetaboxIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Related_Keyphrase_Filter_Integration' => 'getRelatedKeyphraseFilterIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Replacement_Variables_Integration' => 'getReplacementVariablesIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Settings_Integration' => 'getSettingsIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration' => 'getThankYouPageIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Update_Premium_Notification' => 'getUpdatePremiumNotificationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration' => 'getUserProfileIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration' => 'getWorkoutsIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Alerts\\Ai_Generator_Tip_Notification' => 'getAiGeneratorTipNotificationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block' => 'getEstimatedReadingTimeBlockService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block' => 'getRelatedLinksBlockService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration' => 'getCleanupIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Front_End\\Robots_Txt_Integration' => 'getRobotsTxtIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Frontend_Inspector' => 'getFrontendInspectorService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Index_Now_Ping' => 'getIndexNowPingService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Missing_Indexables_Count_Integration' => 'getMissingIndexablesCountIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive' => 'getOpenGraphAuthorArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive' => 'getOpenGraphDateArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive' => 'getOpenGraphPostTypeArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type' => 'getOpenGraphPostTypeService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive' => 'getOpenGraphTermArchiveService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Organization_Schema_Integration' => 'getOrganizationSchemaIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Publishing_Principles_Schema_Integration' => 'getPublishingPrinciplesSchemaIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\AI_Generator_Route' => 'getAIGeneratorRouteService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration' => 'getWorkoutsRoutesIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia' => 'getAlgoliaService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\EDD' => 'getEDDService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium' => 'getElementorPremiumService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Preview' => 'getElementorPreviewService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Mastodon' => 'getMastodonService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration' => 'getUpgradeIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration' => 'getUserProfileIntegration2Service',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Prominent_Words_Watcher' => 'getProminentWordsWatcherService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Stale_Cornerstone_Content_Watcher' => 'getStaleCornerstoneContentWatcherService',
            'Yoast\\WP\\SEO\\Premium\\Introductions\\Application\\Ai_Fix_Assessments_Introduction' => 'getAiFixAssessmentsIntroductionService',
            'Yoast\\WP\\SEO\\Premium\\Main' => 'getMainService',
            'Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository' => 'getProminentWordsRepositoryService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route' => 'getLinkSuggestionsRouteService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route' => 'getProminentWordsRouteService',
            'Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route' => 'getWorkoutsRouteService',
            'Yoast\\WP\\SEO\\Premium\\Surfaces\\Helpers_Surface' => 'getHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Premium\\User_Meta\\Framework\\Additional_Contactmethods\\Mastodon' => 'getMastodon2Service',
            'Yoast\\WP\\SEO\\Premium\\User_Meta\\User_Interface\\Additional_Contactmethods_Integration' => 'getAdditionalContactmethodsIntegrationService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Cleanup_Repository' => 'getIndexableCleanupRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => 'getIndexableRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository' => 'getSEOLinksRepositoryService',
            'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface' => 'getClassesSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface' => 'getHelpersSurface2Service',
            'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface' => 'getMetaSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface' => 'getOpenGraphHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface' => 'getSchemaHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface' => 'getTwitterHelpersSurfaceService',
            'autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository' => 'getIntroductionsSeenRepositoryService',
            'wpdb' => 'getWpdbService',
        ];
        $this->privates = [
            'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository' => true,
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
            'Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Domain\\Suggestion_Interface' => true,
            'autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository' => true,
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
     * Gets the public 'WPSEO_Addon_Manager' shared service.
     *
     * @return \WPSEO_Addon_Manager
     */
    protected function getWPSEOAddonManagerService()
    {
        return $this->services['WPSEO_Addon_Manager'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'WPSEO_Addon_Manager');
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
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Term_Builder' shared service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Term_Builder
     */
    protected function getIndexableTermBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Admin\Post_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Admin\Post_Conditional
     */
    protected function getPostConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Post_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Admin\\Post_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Admin\Posts_Overview_Or_Ajax_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Admin\Posts_Overview_Or_Ajax_Conditional
     */
    protected function getPostsOverviewOrAjaxConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Posts_Overview_Or_Ajax_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Admin\\Posts_Overview_Or_Ajax_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Admin\Yoast_Admin_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Admin\Yoast_Admin_Conditional
     */
    protected function getYoastAdminConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Yoast_Admin_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Admin\\Yoast_Admin_Conditional');
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
     * Gets the public 'Yoast\WP\SEO\Conditionals\Robots_Txt_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Robots_Txt_Conditional
     */
    protected function getRobotsTxtConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Robots_Txt_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Robots_Txt_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Settings_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Settings_Conditional
     */
    protected function getSettingsConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Settings_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Settings_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Third_Party\Elementor_Activated_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Third_Party\Elementor_Activated_Conditional
     */
    protected function getElementorActivatedConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Activated_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Activated_Conditional');
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
     * Gets the public 'Yoast\WP\SEO\Conditionals\User_Profile_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\User_Profile_Conditional
     */
    protected function getUserProfileConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\User_Profile_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\User_Profile_Conditional');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Wincher_Enabled_Conditional' shared service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Wincher_Enabled_Conditional
     */
    protected function getWincherEnabledConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Wincher_Enabled_Conditional'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Conditionals\\Wincher_Enabled_Conditional');
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
     * Gets the public 'Yoast\WP\SEO\Helpers\Capability_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Capability_Helper
     */
    protected function getCapabilityHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Capability_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Capability_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Current_Page_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Current_Page_Helper
     */
    protected function getCurrentPageHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper');
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
     * Gets the public 'Yoast\WP\SEO\Helpers\Indexable_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Indexable_Helper
     */
    protected function getIndexableHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Indexable_Helper');
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
     * Gets the public 'Yoast\WP\SEO\Helpers\Request_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Request_Helper
     */
    protected function getRequestHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Request_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Request_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Robots_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Robots_Helper
     */
    protected function getRobotsHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Robots_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Score_Icon_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Score_Icon_Helper
     */
    protected function getScoreIconHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Social_Profiles_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\Social_Profiles_Helper
     */
    protected function getSocialProfilesHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Social_Profiles_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\Social_Profiles_Helper');
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
     * Gets the public 'Yoast\WP\SEO\Helpers\User_Helper' shared service.
     *
     * @return \Yoast\WP\SEO\Helpers\User_Helper
     */
    protected function getUserHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Helpers\\User_Helper');
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Admin\Admin_Columns_Cache_Integration' shared service.
     *
     * @return \Yoast\WP\SEO\Integrations\Admin\Admin_Columns_Cache_Integration
     */
    protected function getAdminColumnsCacheIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration');
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
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Wincher_Keyphrases' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Wincher_Keyphrases
     */
    protected function getWincherKeyphrasesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Wincher_Keyphrases'] = new \Yoast\WP\SEO\Integrations\Third_Party\Wincher_Keyphrases();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Introductions\Infrastructure\Wistia_Embed_Permission_Repository' shared service.
     *
     * @return \Yoast\WP\SEO\Introductions\Infrastructure\Wistia_Embed_Permission_Repository
     */
    protected function getWistiaEmbedPermissionRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Wistia_Embed_Permission_Repository'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Wistia_Embed_Permission_Repository');
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
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Index_Now_Key');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Introductions_Initializer');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Woocommerce');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Wp_Cli_Initializer');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Consent_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Fix_Assessments_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Generator_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Column_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Taxonomy_Column_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Column_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Filter_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Taxonomy_Column_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Keyword_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Metabox_Formatter_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Related_Keyphrase_Filter_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Replacement_Variables_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Settings_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Thank_You_Page_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Update_Premium_Notification');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\User_Profile_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Alerts\\Ai_Generator_Tip_Notification');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Front_End\\Robots_Txt_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Frontend_Inspector');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Index_Now_Ping');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Missing_Indexables_Count_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Author_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Date_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Post_Type');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_PostType_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\OpenGraph_Term_Archive');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Organization_Schema_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Publishing_Principles_Schema_Integration');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\AI_Generator_Route');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Algolia');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\EDD');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Preview');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Mastodon');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\TranslationsPress');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Wincher_Keyphrases');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\User_Profile_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Prominent_Words_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Stale_Cornerstone_Content_Watcher');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\User_Meta\\User_Interface\\Additional_Contactmethods_Integration');

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
     * Gets the public 'Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Serializer' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Serializer
     */
    protected function getAISuggestionsSerializerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Serializer();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Unifier' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Unifier
     */
    protected function getAISuggestionsUnifierService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Unifier'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Unifier(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser']) ? $this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser'] : ($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser'] = new \Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor']) ? $this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor'] : ($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor'] = new \Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Sentence_Processor']) ? $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Sentence_Processor'] : ($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Sentence_Processor'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Sentence_Processor())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor']) ? $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor'] : $this->getSuggestionProcessorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer']) ? $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer'] : ($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Serializer())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Sentence_Processor' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Sentence_Processor
     */
    protected function getSentenceProcessorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Sentence_Processor'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Sentence_Processor();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Suggestion_Processor' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Suggestion_Processor
     */
    protected function getSuggestionProcessorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\Suggestion_Processor(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser']) ? $this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser'] : ($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser'] = new \Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor']) ? $this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor'] : ($this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor'] = new \Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer']) ? $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer'] : ($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Serializer'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Application\AI_Suggestions_Serializer())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain\Suggestion' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain\Suggestion
     */
    protected function getSuggestionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Domain\\Suggestion'] = new \Yoast\WP\SEO\Premium\AI_Suggestions_Postprocessor\Domain\Suggestion();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\AI_Generator_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\AI_Generator_Action
     */
    protected function getAIGeneratorActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\AI_Generator_Action'] = new \Yoast\WP\SEO\Premium\Actions\AI_Generator_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper'] : $this->getAIGeneratorHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Addon_Manager']) ? $this->services['WPSEO_Addon_Manager'] : $this->getWPSEOAddonManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action
     */
    protected function getLinkSuggestionsActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] = new \Yoast\WP\SEO\Premium\Actions\Link_Suggestions_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] : $this->getSEOLinksRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action
     */
    protected function getCompleteActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action'] = new \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Complete_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action
     */
    protected function getContentActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] = new \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action(${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action
     */
    protected function getSaveActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] = new \Yoast\WP\SEO\Premium\Actions\Prominent_Words\Save_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper'] : $this->getIndexableHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Ai_Editor_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Ai_Editor_Conditional
     */
    protected function getAiEditorConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Ai_Editor_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Ai_Editor_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Post_Conditional']) ? $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Post_Conditional'] : $this->getPostConditionalService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Cornerstone_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Cornerstone_Enabled_Conditional
     */
    protected function getCornerstoneEnabledConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Cornerstone_Enabled_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Cornerstone_Enabled_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\EDD_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\EDD_Conditional
     */
    protected function getEDDConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\EDD_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\EDD_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Inclusive_Language_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Inclusive_Language_Enabled_Conditional
     */
    protected function getInclusiveLanguageEnabledConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Inclusive_Language_Enabled_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Inclusive_Language_Enabled_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Term_Overview_Or_Ajax_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Term_Overview_Or_Ajax_Conditional
     */
    protected function getTermOverviewOrAjaxConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Term_Overview_Or_Ajax_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Term_Overview_Or_Ajax_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Conditionals\Yoast_Admin_Or_Introductions_Route_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Conditionals\Yoast_Admin_Or_Introductions_Route_Conditional
     */
    protected function getYoastAdminOrIntroductionsRouteConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Conditionals\\Yoast_Admin_Or_Introductions_Route_Conditional'] = new \Yoast\WP\SEO\Premium\Conditionals\Yoast_Admin_Or_Introductions_Route_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Yoast_Admin_Conditional']) ? $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin\\Yoast_Admin_Conditional'] : $this->getYoastAdminConditionalService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser
     */
    protected function getDOMParserService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\DOM_Parser'] = new \Yoast\WP\SEO\Premium\DOM_Manager\Application\DOM_Parser();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor
     */
    protected function getNodeProcessorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\DOM_Manager\\Application\\Node_Processor'] = new \Yoast\WP\SEO\Premium\DOM_Manager\Application\Node_Processor();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium
     */
    protected function getMigrationRunnerPremiumService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Database\\Migration_Runner_Premium'] = new \Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : $this->getMigrationStatusService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loader']) ? $this->services['Yoast\\WP\\SEO\\Loader'] : $this->getLoaderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : $this->getAdapterService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper
     */
    protected function getAIGeneratorHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\AI_Generator_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Unifier']) ? $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\AI_Suggestions_Unifier'] : $this->getAISuggestionsUnifierService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor']) ? $this->services['Yoast\\WP\\SEO\\Premium\\AI_Suggestions_Postprocessor\\Application\\Suggestion_Processor'] : $this->getSuggestionProcessorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] : $this->getDateHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper
     */
    protected function getCurrentPageHelper2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper
     */
    protected function getProminentWordsHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Prominent_Words_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Helpers\Version_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Helpers\Version_Helper
     */
    protected function getVersionHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Version_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Version_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Index_Now_Key' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Index_Now_Key
     */
    protected function getIndexNowKeyService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Index_Now_Key'] = new \Yoast\WP\SEO\Premium\Initializers\Index_Now_Key(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Introductions_Initializer' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Introductions_Initializer
     */
    protected function getIntroductionsInitializerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Introductions_Initializer'] = new \Yoast\WP\SEO\Premium\Initializers\Introductions_Initializer(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Introductions\\Application\\Ai_Fix_Assessments_Introduction']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Introductions\\Application\\Ai_Fix_Assessments_Introduction'] : $this->getAiFixAssessmentsIntroductionService()) && false ?: '_'});
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
    protected function getRedirectHandlerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Redirect_Handler'] = new \Yoast\WP\SEO\Premium\Initializers\Redirect_Handler();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Woocommerce' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Woocommerce
     */
    protected function getWoocommerceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Woocommerce'] = new \Yoast\WP\SEO\Premium\Initializers\Woocommerce();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Wp_Cli_Initializer' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Wp_Cli_Initializer
     */
    protected function getWpCliInitializerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Wp_Cli_Initializer'] = new \Yoast\WP\SEO\Premium\Initializers\Wp_Cli_Initializer();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Consent_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Consent_Integration
     */
    protected function getAiConsentIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Consent_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Consent_Integration(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Addon_Manager']) ? $this->services['WPSEO_Addon_Manager'] : $this->getWPSEOAddonManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Wistia_Embed_Permission_Repository']) ? $this->services['Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Wistia_Embed_Permission_Repository'] : $this->getWistiaEmbedPermissionRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Fix_Assessments_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Fix_Assessments_Integration
     */
    protected function getAiFixAssessmentsIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Fix_Assessments_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Fix_Assessments_Integration(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Addon_Manager']) ? $this->services['WPSEO_Addon_Manager'] : $this->getWPSEOAddonManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper'] : $this->getAIGeneratorHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'}, ${($_ = isset($this->services['autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository']) ? $this->services['autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository'] : $this->getIntroductionsSeenRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Generator_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Generator_Integration
     */
    protected function getAiGeneratorIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Ai_Generator_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Ai_Generator_Integration(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Addon_Manager']) ? $this->services['WPSEO_Addon_Manager'] : $this->getWPSEOAddonManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper'] : $this->getAIGeneratorHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'}, ${($_ = isset($this->services['autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository']) ? $this->services['autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository'] : $this->getIntroductionsSeenRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Cornerstone_Column_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Cornerstone_Column_Integration
     */
    protected function getCornerstoneColumnIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Column_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Cornerstone_Column_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'}, ${($_ = isset($this->services['wpdb']) ? $this->services['wpdb'] : $this->getWpdbService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration']) ? $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration'] : $this->getAdminColumnsCacheIntegrationService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Cornerstone_Taxonomy_Column_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Cornerstone_Taxonomy_Column_Integration
     */
    protected function getCornerstoneTaxonomyColumnIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Cornerstone_Taxonomy_Column_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Cornerstone_Taxonomy_Column_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Column_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Column_Integration
     */
    protected function getInclusiveLanguageColumnIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Column_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Column_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper'] : $this->getScoreIconHelperService()) && false ?: '_'}, ${($_ = isset($this->services['wpdb']) ? $this->services['wpdb'] : $this->getWpdbService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration']) ? $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Admin_Columns_Cache_Integration'] : $this->getAdminColumnsCacheIntegrationService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Filter_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Filter_Integration
     */
    protected function getInclusiveLanguageFilterIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Filter_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Filter_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Taxonomy_Column_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Taxonomy_Column_Integration
     */
    protected function getInclusiveLanguageTaxonomyColumnIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Inclusive_Language_Taxonomy_Column_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Inclusive_Language_Taxonomy_Column_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Score_Icon_Helper'] : $this->getScoreIconHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Keyword_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Keyword_Integration
     */
    protected function getKeywordIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Keyword_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Keyword_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Metabox_Formatter_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Metabox_Formatter_Integration
     */
    protected function getMetaboxFormatterIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Metabox_Formatter_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Metabox_Formatter_Integration();
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
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Indexing_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action'] : $this->getIndexablePostIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action'] : $this->getIndexableTermIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action'] : $this->getIndexableGeneralIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action'] : $this->getIndexablePostTypeArchiveIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper'] : $this->getLanguageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : $this->getUrlHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration
     */
    protected function getMetaboxIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Prominent_Words\Metabox_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveActionService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Related_Keyphrase_Filter_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Related_Keyphrase_Filter_Integration
     */
    protected function getRelatedKeyphraseFilterIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Related_Keyphrase_Filter_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Related_Keyphrase_Filter_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Replacement_Variables_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Replacement_Variables_Integration
     */
    protected function getReplacementVariablesIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Replacement_Variables_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Replacement_Variables_Integration();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Settings_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Settings_Integration
     */
    protected function getSettingsIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Settings_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Settings_Integration(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Admin\Update_Premium_Notification' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Admin\Update_Premium_Notification
     */
    protected function getUpdatePremiumNotificationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Update_Premium_Notification'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Update_Premium_Notification(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Version_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Version_Helper'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Version_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Version_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Capability_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Capability_Helper'] : $this->getCapabilityHelperService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'});
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
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Workouts_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Admin\Workouts_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Shortlinker']) ? $this->services['WPSEO_Shortlinker'] : $this->getWPSEOShortlinkerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Alerts\Ai_Generator_Tip_Notification' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Alerts\Ai_Generator_Tip_Notification
     */
    protected function getAiGeneratorTipNotificationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Alerts\\Ai_Generator_Tip_Notification'] = new \Yoast\WP\SEO\Premium\Integrations\Alerts\Ai_Generator_Tip_Notification();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block
     */
    protected function getEstimatedReadingTimeBlockService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Estimated_Reading_Time_Block'] = new \Yoast\WP\SEO\Premium\Integrations\Blocks\Estimated_Reading_Time_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block
     */
    protected function getRelatedLinksBlockService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Blocks\\Related_Links_Block'] = new \Yoast\WP\SEO\Premium\Integrations\Blocks\Related_Links_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Cleanup_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Cleanup_Integration
     */
    protected function getCleanupIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Cleanup_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Cleanup_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Cleanup_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Cleanup_Repository'] : $this->getIndexableCleanupRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Front_End\Robots_Txt_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Front_End\Robots_Txt_Integration
     */
    protected function getRobotsTxtIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Front_End\\Robots_Txt_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Front_End\Robots_Txt_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Frontend_Inspector' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Frontend_Inspector
     */
    protected function getFrontendInspectorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Frontend_Inspector'] = new \Yoast\WP\SEO\Premium\Integrations\Frontend_Inspector(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] : $this->getRobotsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Index_Now_Ping' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Index_Now_Ping
     */
    protected function getIndexNowPingService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Index_Now_Ping'] = new \Yoast\WP\SEO\Premium\Integrations\Index_Now_Ping(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Request_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Request_Helper'] : $this->getRequestHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Missing_Indexables_Count_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Missing_Indexables_Count_Integration
     */
    protected function getMissingIndexablesCountIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Missing_Indexables_Count_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Missing_Indexables_Count_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentActionService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Organization_Schema_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Organization_Schema_Integration
     */
    protected function getOrganizationSchemaIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Organization_Schema_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Organization_Schema_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Publishing_Principles_Schema_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Publishing_Principles_Schema_Integration
     */
    protected function getPublishingPrinciplesSchemaIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Publishing_Principles_Schema_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Publishing_Principles_Schema_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper'] : $this->getIndexableHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Routes\AI_Generator_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Routes\AI_Generator_Route
     */
    protected function getAIGeneratorRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\AI_Generator_Route'] = new \Yoast\WP\SEO\Premium\Integrations\Routes\AI_Generator_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\AI_Generator_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\AI_Generator_Action'] : $this->getAIGeneratorActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\AI_Generator_Helper'] : $this->getAIGeneratorHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Routes\Workouts_Routes_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Routes\Workouts_Routes_Integration
     */
    protected function getWorkoutsRoutesIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Routes\\Workouts_Routes_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Routes\Workouts_Routes_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsActionService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Shortlinker']) ? $this->services['WPSEO_Shortlinker'] : $this->getWPSEOShortlinkerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\EDD' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\EDD
     */
    protected function getEDDService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\EDD'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\EDD(${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium
     */
    protected function getElementorPremiumService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Premium'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Helpers\\Current_Page_Helper'] = new \Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Preview' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Preview
     */
    protected function getElementorPreviewService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Elementor_Preview'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Elementor_Preview(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Third_Party\Mastodon' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Third_Party\Mastodon
     */
    protected function getMastodonService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Third_Party\\Mastodon'] = new \Yoast\WP\SEO\Premium\Integrations\Third_Party\Mastodon(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Social_Profiles_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Social_Profiles_Helper'] : $this->getSocialProfilesHelperService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Watchers\Prominent_Words_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Watchers\Prominent_Words_Watcher
     */
    protected function getProminentWordsWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Prominent_Words_Watcher'] = new \Yoast\WP\SEO\Premium\Integrations\Watchers\Prominent_Words_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Premium\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Premium\Repositories\Prominent_Words_Repository())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Watchers\Stale_Cornerstone_Content_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Watchers\Stale_Cornerstone_Content_Watcher
     */
    protected function getStaleCornerstoneContentWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Watchers\\Stale_Cornerstone_Content_Watcher'] = new \Yoast\WP\SEO\Premium\Integrations\Watchers\Stale_Cornerstone_Content_Watcher();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Introductions\Application\Ai_Fix_Assessments_Introduction' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Introductions\Application\Ai_Fix_Assessments_Introduction
     */
    protected function getAiFixAssessmentsIntroductionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Introductions\\Application\\Ai_Fix_Assessments_Introduction'] = new \Yoast\WP\SEO\Premium\Introductions\Application\Ai_Fix_Assessments_Introduction(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'});
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
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Link_Suggestions_Route'] = new \Yoast\WP\SEO\Premium\Routes\Link_Suggestions_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsActionService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route
     */
    protected function getProminentWordsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Prominent_Words_Route'] = new \Yoast\WP\SEO\Premium\Routes\Prominent_Words_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Prominent_Words\\Complete_Action'] : $this->getCompleteActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper'] : $this->getIndexingHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\Routes\Workouts_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Routes\Workouts_Route
     */
    protected function getWorkoutsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Routes\\Workouts_Route'] = new \Yoast\WP\SEO\Premium\Routes\Workouts_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Premium\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] : $this->getIndexableTermBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexable_Helper'] : $this->getIndexableHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : $this->getPostTypeHelperService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\User_Meta\Framework\Additional_Contactmethods\Mastodon' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\User_Meta\Framework\Additional_Contactmethods\Mastodon
     */
    protected function getMastodon2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\User_Meta\\Framework\\Additional_Contactmethods\\Mastodon'] = new \Yoast\WP\SEO\Premium\User_Meta\Framework\Additional_Contactmethods\Mastodon();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Premium\User_Meta\User_Interface\Additional_Contactmethods_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\User_Meta\User_Interface\Additional_Contactmethods_Integration
     */
    protected function getAdditionalContactmethodsIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\User_Meta\\User_Interface\\Additional_Contactmethods_Integration'] = new \Yoast\WP\SEO\Premium\User_Meta\User_Interface\Additional_Contactmethods_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Premium\\User_Meta\\Framework\\Additional_Contactmethods\\Mastodon']) ? $this->services['Yoast\\WP\\SEO\\Premium\\User_Meta\\Framework\\Additional_Contactmethods\\Mastodon'] : ($this->services['Yoast\\WP\\SEO\\Premium\\User_Meta\\Framework\\Additional_Contactmethods\\Mastodon'] = new \Yoast\WP\SEO\Premium\User_Meta\Framework\Additional_Contactmethods\Mastodon())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\Indexable_Cleanup_Repository' shared service.
     *
     * @return \Yoast\WP\SEO\Repositories\Indexable_Cleanup_Repository
     */
    protected function getIndexableCleanupRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Cleanup_Repository'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Repositories\\Indexable_Cleanup_Repository');
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
     * Gets the public 'Yoast\WP\SEO\Repositories\SEO_Links_Repository' shared service.
     *
     * @return \Yoast\WP\SEO\Repositories\SEO_Links_Repository
     */
    protected function getSEOLinksRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository');
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

    /**
     * Gets the public 'wpdb' shared service.
     *
     * @return \wpdb
     */
    protected function getWpdbService()
    {
        return $this->services['wpdb'] = \Yoast\WP\Lib\Dependency_Injection\Container_Registry::get('yoast-seo', 'wpdb');
    }

    /**
     * Gets the private 'autowired.Yoast\WP\SEO\Introductions\Infrastructure\Introductions_Seen_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Introductions\Infrastructure\Introductions_Seen_Repository
     */
    protected function getIntroductionsSeenRepositoryService()
    {
        return $this->services['autowired.Yoast\\WP\\SEO\\Introductions\\Infrastructure\\Introductions_Seen_Repository'] = new \Yoast\WP\SEO\Introductions\Infrastructure\Introductions_Seen_Repository(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : $this->getUserHelperService()) && false ?: '_'});
    }
}
