<?php

namespace Yoast\WP\SEO\Generated;

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
            'wpseo_breadcrumbs' => 'WPSEO_Breadcrumbs',
            'wpseo_frontend' => 'WPSEO_Frontend',
            'wpseo_replace_vars' => 'WPSEO_Replace_Vars',
            'yoast\\wp\\lib\\migrations\\adapter' => 'Yoast\\WP\\Lib\\Migrations\\Adapter',
            'yoast\\wp\\seo\\actions\\indexables\\indexable_head_action' => 'Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action',
            'yoast\\wp\\seo\\actions\\indexation\\indexable_complete_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexation\\indexable_general_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexation\\indexable_post_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexation\\indexable_post_type_archive_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action',
            'yoast\\wp\\seo\\actions\\indexation\\indexable_term_indexation_action' => 'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action',
            'yoast\\wp\\seo\\builders\\indexable_author_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder',
            'yoast\\wp\\seo\\builders\\indexable_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Builder',
            'yoast\\wp\\seo\\builders\\indexable_date_archive_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Date_Archive_Builder',
            'yoast\\wp\\seo\\builders\\indexable_hierarchy_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder',
            'yoast\\wp\\seo\\builders\\indexable_home_page_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Home_Page_Builder',
            'yoast\\wp\\seo\\builders\\indexable_post_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder',
            'yoast\\wp\\seo\\builders\\indexable_post_type_archive_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Type_Archive_Builder',
            'yoast\\wp\\seo\\builders\\indexable_rebuilder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Rebuilder',
            'yoast\\wp\\seo\\builders\\indexable_system_page_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_System_Page_Builder',
            'yoast\\wp\\seo\\builders\\indexable_term_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder',
            'yoast\\wp\\seo\\builders\\primary_term_builder' => 'Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder',
            'yoast\\wp\\seo\\commands\\index_command' => 'Yoast\\WP\\SEO\\Commands\\Index_Command',
            'yoast\\wp\\seo\\conditionals\\admin_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional',
            'yoast\\wp\\seo\\conditionals\\breadcrumbs_enabled_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Breadcrumbs_Enabled_Conditional',
            'yoast\\wp\\seo\\conditionals\\development_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Development_Conditional',
            'yoast\\wp\\seo\\conditionals\\front_end_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional',
            'yoast\\wp\\seo\\conditionals\\headless_rest_endpoints_enabled_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Headless_Rest_Endpoints_Enabled_Conditional',
            'yoast\\wp\\seo\\conditionals\\jetpack_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Jetpack_Conditional',
            'yoast\\wp\\seo\\conditionals\\migrations_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional',
            'yoast\\wp\\seo\\conditionals\\open_graph_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional',
            'yoast\\wp\\seo\\conditionals\\primary_category_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Primary_Category_Conditional',
            'yoast\\wp\\seo\\conditionals\\woocommerce_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\WooCommerce_Conditional',
            'yoast\\wp\\seo\\conditionals\\wpml_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\WPML_Conditional',
            'yoast\\wp\\seo\\conditionals\\xmlrpc_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\XMLRPC_Conditional',
            'yoast\\wp\\seo\\conditionals\\yoast_admin_and_dashboard_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional',
            'yoast\\wp\\seo\\config\\dependency_management' => 'Yoast\\WP\\SEO\\Config\\Dependency_Management',
            'yoast\\wp\\seo\\config\\migration_status' => 'Yoast\\WP\\SEO\\Config\\Migration_Status',
            'yoast\\wp\\seo\\config\\migrations\\addcollationtotables' => 'Yoast\\WP\\SEO\\Config\\Migrations\\AddCollationToTables',
            'yoast\\wp\\seo\\config\\migrations\\addcolumnstoindexables' => 'Yoast\\WP\\SEO\\Config\\Migrations\\AddColumnsToIndexables',
            'yoast\\wp\\seo\\config\\migrations\\addhasancestorscolumn' => 'Yoast\\WP\\SEO\\Config\\Migrations\\AddHasAncestorsColumn',
            'yoast\\wp\\seo\\config\\migrations\\addindexableobjectidandtypeindex' => 'Yoast\\WP\\SEO\\Config\\Migrations\\AddIndexableObjectIdAndTypeIndex',
            'yoast\\wp\\seo\\config\\migrations\\breadcrumbtitleandhierarchyreset' => 'Yoast\\WP\\SEO\\Config\\Migrations\\BreadcrumbTitleAndHierarchyReset',
            'yoast\\wp\\seo\\config\\migrations\\clearindexabletables' => 'Yoast\\WP\\SEO\\Config\\Migrations\\ClearIndexableTables',
            'yoast\\wp\\seo\\config\\migrations\\createindexablesubpagesindex' => 'Yoast\\WP\\SEO\\Config\\Migrations\\CreateIndexableSubpagesIndex',
            'yoast\\wp\\seo\\config\\migrations\\deleteduplicateindexables' => 'Yoast\\WP\\SEO\\Config\\Migrations\\DeleteDuplicateIndexables',
            'yoast\\wp\\seo\\config\\migrations\\expandindexablecolumnlengths' => 'Yoast\\WP\\SEO\\Config\\Migrations\\ExpandIndexableColumnLengths',
            'yoast\\wp\\seo\\config\\migrations\\resetindexablehierarchytable' => 'Yoast\\WP\\SEO\\Config\\Migrations\\ResetIndexableHierarchyTable',
            'yoast\\wp\\seo\\config\\migrations\\truncateindexabletables' => 'Yoast\\WP\\SEO\\Config\\Migrations\\TruncateIndexableTables',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastdropindexablemetatableifexists' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastDropIndexableMetaTableIfExists',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastindexable' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexable',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastindexablehierarchy' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexableHierarchy',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastprimaryterm' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPrimaryTerm',
            'yoast\\wp\\seo\\config\\schema_ids' => 'Yoast\\WP\\SEO\\Config\\Schema_IDs',
            'yoast\\wp\\seo\\context\\meta_tags_context' => 'Yoast\\WP\\SEO\\Context\\Meta_Tags_Context',
            'yoast\\wp\\seo\\exceptions\\missing_method' => 'Yoast\\WP\\SEO\\Exceptions\\Missing_Method',
            'yoast\\wp\\seo\\generators\\breadcrumbs_generator' => 'Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator',
            'yoast\\wp\\seo\\generators\\open_graph_image_generator' => 'Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator',
            'yoast\\wp\\seo\\generators\\open_graph_locale_generator' => 'Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator',
            'yoast\\wp\\seo\\generators\\schema\\article' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Article',
            'yoast\\wp\\seo\\generators\\schema\\author' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Author',
            'yoast\\wp\\seo\\generators\\schema\\breadcrumb' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Breadcrumb',
            'yoast\\wp\\seo\\generators\\schema\\faq' => 'Yoast\\WP\\SEO\\Generators\\Schema\\FAQ',
            'yoast\\wp\\seo\\generators\\schema\\howto' => 'Yoast\\WP\\SEO\\Generators\\Schema\\HowTo',
            'yoast\\wp\\seo\\generators\\schema\\main_image' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Main_Image',
            'yoast\\wp\\seo\\generators\\schema\\organization' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Organization',
            'yoast\\wp\\seo\\generators\\schema\\person' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Person',
            'yoast\\wp\\seo\\generators\\schema\\webpage' => 'Yoast\\WP\\SEO\\Generators\\Schema\\WebPage',
            'yoast\\wp\\seo\\generators\\schema\\website' => 'Yoast\\WP\\SEO\\Generators\\Schema\\Website',
            'yoast\\wp\\seo\\generators\\schema_generator' => 'Yoast\\WP\\SEO\\Generators\\Schema_Generator',
            'yoast\\wp\\seo\\generators\\twitter_image_generator' => 'Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator',
            'yoast\\wp\\seo\\helpers\\author_archive_helper' => 'Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper',
            'yoast\\wp\\seo\\helpers\\blocks_helper' => 'Yoast\\WP\\SEO\\Helpers\\Blocks_Helper',
            'yoast\\wp\\seo\\helpers\\current_page_helper' => 'Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper',
            'yoast\\wp\\seo\\helpers\\date_helper' => 'Yoast\\WP\\SEO\\Helpers\\Date_Helper',
            'yoast\\wp\\seo\\helpers\\home_url_helper' => 'Yoast\\WP\\SEO\\Helpers\\Home_Url_Helper',
            'yoast\\wp\\seo\\helpers\\image_helper' => 'Yoast\\WP\\SEO\\Helpers\\Image_Helper',
            'yoast\\wp\\seo\\helpers\\language_helper' => 'Yoast\\WP\\SEO\\Helpers\\Language_Helper',
            'yoast\\wp\\seo\\helpers\\meta_helper' => 'Yoast\\WP\\SEO\\Helpers\\Meta_Helper',
            'yoast\\wp\\seo\\helpers\\open_graph\\image_helper' => 'Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper',
            'yoast\\wp\\seo\\helpers\\options_helper' => 'Yoast\\WP\\SEO\\Helpers\\Options_Helper',
            'yoast\\wp\\seo\\helpers\\pagination_helper' => 'Yoast\\WP\\SEO\\Helpers\\Pagination_Helper',
            'yoast\\wp\\seo\\helpers\\post_helper' => 'Yoast\\WP\\SEO\\Helpers\\Post_Helper',
            'yoast\\wp\\seo\\helpers\\post_type_helper' => 'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper',
            'yoast\\wp\\seo\\helpers\\primary_term_helper' => 'Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper',
            'yoast\\wp\\seo\\helpers\\product_helper' => 'Yoast\\WP\\SEO\\Helpers\\Product_Helper',
            'yoast\\wp\\seo\\helpers\\redirect_helper' => 'Yoast\\WP\\SEO\\Helpers\\Redirect_Helper',
            'yoast\\wp\\seo\\helpers\\robots_helper' => 'Yoast\\WP\\SEO\\Helpers\\Robots_Helper',
            'yoast\\wp\\seo\\helpers\\schema\\article_helper' => 'Yoast\\WP\\SEO\\Helpers\\Schema\\Article_Helper',
            'yoast\\wp\\seo\\helpers\\schema\\html_helper' => 'Yoast\\WP\\SEO\\Helpers\\Schema\\HTML_Helper',
            'yoast\\wp\\seo\\helpers\\schema\\id_helper' => 'Yoast\\WP\\SEO\\Helpers\\Schema\\ID_Helper',
            'yoast\\wp\\seo\\helpers\\schema\\image_helper' => 'Yoast\\WP\\SEO\\Helpers\\Schema\\Image_Helper',
            'yoast\\wp\\seo\\helpers\\schema\\language_helper' => 'Yoast\\WP\\SEO\\Helpers\\Schema\\Language_Helper',
            'yoast\\wp\\seo\\helpers\\site_helper' => 'Yoast\\WP\\SEO\\Helpers\\Site_Helper',
            'yoast\\wp\\seo\\helpers\\string_helper' => 'Yoast\\WP\\SEO\\Helpers\\String_Helper',
            'yoast\\wp\\seo\\helpers\\taxonomy_helper' => 'Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper',
            'yoast\\wp\\seo\\helpers\\twitter\\image_helper' => 'Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper',
            'yoast\\wp\\seo\\helpers\\url_helper' => 'Yoast\\WP\\SEO\\Helpers\\Url_Helper',
            'yoast\\wp\\seo\\helpers\\user_helper' => 'Yoast\\WP\\SEO\\Helpers\\User_Helper',
            'yoast\\wp\\seo\\initializers\\disable_core_sitemaps' => 'Yoast\\WP\\SEO\\Initializers\\Disable_Core_Sitemaps',
            'yoast\\wp\\seo\\initializers\\migration_runner' => 'Yoast\\WP\\SEO\\Initializers\\Migration_Runner',
            'yoast\\wp\\seo\\integrations\\admin\\indexation_integration' => 'Yoast\\WP\\SEO\\Integrations\\Admin\\Indexation_Integration',
            'yoast\\wp\\seo\\integrations\\admin\\migration_error_integration' => 'Yoast\\WP\\SEO\\Integrations\\Admin\\Migration_Error_Integration',
            'yoast\\wp\\seo\\integrations\\blocks\\internal_linking_category' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Internal_Linking_Category',
            'yoast\\wp\\seo\\integrations\\blocks\\structured_data_blocks' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Structured_Data_Blocks',
            'yoast\\wp\\seo\\integrations\\breadcrumbs_integration' => 'Yoast\\WP\\SEO\\Integrations\\Breadcrumbs_Integration',
            'yoast\\wp\\seo\\integrations\\front_end\\backwards_compatibility' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Backwards_Compatibility',
            'yoast\\wp\\seo\\integrations\\front_end\\category_term_description' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Category_Term_Description',
            'yoast\\wp\\seo\\integrations\\front_end\\comment_link_fixer' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Comment_Link_Fixer',
            'yoast\\wp\\seo\\integrations\\front_end\\force_rewrite_title' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Force_Rewrite_Title',
            'yoast\\wp\\seo\\integrations\\front_end\\handle_404' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Handle_404',
            'yoast\\wp\\seo\\integrations\\front_end\\indexing_controls' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Indexing_Controls',
            'yoast\\wp\\seo\\integrations\\front_end\\open_graph_oembed' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Open_Graph_OEmbed',
            'yoast\\wp\\seo\\integrations\\front_end\\redirects' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Redirects',
            'yoast\\wp\\seo\\integrations\\front_end\\rss_footer_embed' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\RSS_Footer_Embed',
            'yoast\\wp\\seo\\integrations\\front_end\\theme_titles' => 'Yoast\\WP\\SEO\\Integrations\\Front_End\\Theme_Titles',
            'yoast\\wp\\seo\\integrations\\front_end_integration' => 'Yoast\\WP\\SEO\\Integrations\\Front_End_Integration',
            'yoast\\wp\\seo\\integrations\\primary_category' => 'Yoast\\WP\\SEO\\Integrations\\Primary_Category',
            'yoast\\wp\\seo\\integrations\\third_party\\amp' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\AMP',
            'yoast\\wp\\seo\\integrations\\third_party\\bbpress' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\BbPress',
            'yoast\\wp\\seo\\integrations\\third_party\\jetpack' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Jetpack',
            'yoast\\wp\\seo\\integrations\\third_party\\woocommerce' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\WooCommerce',
            'yoast\\wp\\seo\\integrations\\third_party\\wpml' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\WPML',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_author_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Author_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_date_archive_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Date_Archive_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_home_page_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Home_Page_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_permalink_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Permalink_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_post_meta_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Meta_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_post_type_archive_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Type_Archive_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_post_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_static_home_page_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Static_Home_Page_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_system_page_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_System_Page_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\indexable_term_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Term_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\option_titles_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Option_Titles_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\primary_term_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Primary_Term_Watcher',
            'yoast\\wp\\seo\\integrations\\xmlrpc' => 'Yoast\\WP\\SEO\\Integrations\\XMLRPC',
            'yoast\\wp\\seo\\loader' => 'Yoast\\WP\\SEO\\Loader',
            'yoast\\wp\\seo\\loggers\\logger' => 'Yoast\\WP\\SEO\\Loggers\\Logger',
            'yoast\\wp\\seo\\memoizers\\meta_tags_context_memoizer' => 'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer',
            'yoast\\wp\\seo\\memoizers\\presentation_memoizer' => 'Yoast\\WP\\SEO\\Memoizers\\Presentation_Memoizer',
            'yoast\\wp\\seo\\oauth\\client' => 'Yoast\\WP\\SEO\\Oauth\\Client',
            'yoast\\wp\\seo\\presentations\\abstract_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Abstract_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_author_archive_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Author_Archive_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_date_archive_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Date_Archive_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_error_page_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Error_Page_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_home_page_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Home_Page_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_post_type_archive_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Post_Type_Archive_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_post_type_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Post_Type_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_search_result_page_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Search_Result_Page_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_static_home_page_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Static_Home_Page_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_static_posts_page_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Static_Posts_Page_Presentation',
            'yoast\\wp\\seo\\presentations\\indexable_term_archive_presentation' => 'Yoast\\WP\\SEO\\Presentations\\Indexable_Term_Archive_Presentation',
            'yoast\\wp\\seo\\repositories\\indexable_hierarchy_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository',
            'yoast\\wp\\seo\\repositories\\indexable_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository',
            'yoast\\wp\\seo\\repositories\\primary_term_repository' => 'Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository',
            'yoast\\wp\\seo\\repositories\\seo_links_repository' => 'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository',
            'yoast\\wp\\seo\\repositories\\seo_meta_repository' => 'Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository',
            'yoast\\wp\\seo\\routes\\indexable_indexation_route' => 'Yoast\\WP\\SEO\\Routes\\Indexable_Indexation_Route',
            'yoast\\wp\\seo\\routes\\indexables_head_route' => 'Yoast\\WP\\SEO\\Routes\\Indexables_Head_Route',
            'yoast\\wp\\seo\\routes\\yoast_head_rest_field' => 'Yoast\\WP\\SEO\\Routes\\Yoast_Head_REST_Field',
            'yoast\\wp\\seo\\surfaces\\classes_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface',
            'yoast\\wp\\seo\\surfaces\\helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\meta_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface',
            'yoast\\wp\\seo\\surfaces\\open_graph_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\schema_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface',
            'yoast\\wp\\seo\\surfaces\\twitter_helpers_surface' => 'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface',
            'yoast\\wp\\seo\\values\\images' => 'Yoast\\WP\\SEO\\Values\\Images',
            'yoast\\wp\\seo\\values\\open_graph\\images' => 'Yoast\\WP\\SEO\\Values\\Open_Graph\\Images',
            'yoast\\wp\\seo\\wrappers\\wp_query_wrapper' => 'Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper',
            'yoast\\wp\\seo\\wrappers\\wp_rewrite_wrapper' => 'Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper',
            'yoastseo_vendor\\symfony\\component\\dependencyinjection\\containerinterface' => 'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface',
        ];
        $this->methodMap = [
            'WPSEO_Admin_Asset_Manager' => 'getWPSEOAdminAssetManagerService',
            'WPSEO_Breadcrumbs' => 'getWPSEOBreadcrumbsService',
            'WPSEO_Frontend' => 'getWPSEOFrontendService',
            'WPSEO_Replace_Vars' => 'getWPSEOReplaceVarsService',
            'Yoast\\WP\\Lib\\Migrations\\Adapter' => 'getAdapterService',
            'Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action' => 'getIndexableHeadActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action' => 'getIndexableCompleteIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action' => 'getIndexableGeneralIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action' => 'getIndexablePostIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action' => 'getIndexablePostTypeArchiveIndexationActionService',
            'Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action' => 'getIndexableTermIndexationActionService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder' => 'getIndexableAuthorBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Builder' => 'getIndexableBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Date_Archive_Builder' => 'getIndexableDateArchiveBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder' => 'getIndexableHierarchyBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Home_Page_Builder' => 'getIndexableHomePageBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder' => 'getIndexablePostBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Type_Archive_Builder' => 'getIndexablePostTypeArchiveBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Rebuilder' => 'getIndexableRebuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_System_Page_Builder' => 'getIndexableSystemPageBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder' => 'getIndexableTermBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder' => 'getPrimaryTermBuilderService',
            'Yoast\\WP\\SEO\\Commands\\Index_Command' => 'getIndexCommandService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional' => 'getAdminConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Breadcrumbs_Enabled_Conditional' => 'getBreadcrumbsEnabledConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Development_Conditional' => 'getDevelopmentConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional' => 'getFrontEndConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Headless_Rest_Endpoints_Enabled_Conditional' => 'getHeadlessRestEndpointsEnabledConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Jetpack_Conditional' => 'getJetpackConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional' => 'getMigrationsConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional' => 'getOpenGraphConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Primary_Category_Conditional' => 'getPrimaryCategoryConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\WPML_Conditional' => 'getWPMLConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\WooCommerce_Conditional' => 'getWooCommerceConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\XMLRPC_Conditional' => 'getXMLRPCConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional' => 'getYoastAdminAndDashboardConditionalService',
            'Yoast\\WP\\SEO\\Config\\Dependency_Management' => 'getDependencyManagementService',
            'Yoast\\WP\\SEO\\Config\\Migration_Status' => 'getMigrationStatusService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\AddCollationToTables' => 'getAddCollationToTablesService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\AddColumnsToIndexables' => 'getAddColumnsToIndexablesService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\AddHasAncestorsColumn' => 'getAddHasAncestorsColumnService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\AddIndexableObjectIdAndTypeIndex' => 'getAddIndexableObjectIdAndTypeIndexService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\BreadcrumbTitleAndHierarchyReset' => 'getBreadcrumbTitleAndHierarchyResetService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\ClearIndexableTables' => 'getClearIndexableTablesService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\CreateIndexableSubpagesIndex' => 'getCreateIndexableSubpagesIndexService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\DeleteDuplicateIndexables' => 'getDeleteDuplicateIndexablesService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\ExpandIndexableColumnLengths' => 'getExpandIndexableColumnLengthsService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\ResetIndexableHierarchyTable' => 'getResetIndexableHierarchyTableService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\TruncateIndexableTables' => 'getTruncateIndexableTablesService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastDropIndexableMetaTableIfExists' => 'getWpYoastDropIndexableMetaTableIfExistsService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexable' => 'getWpYoastIndexableService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexableHierarchy' => 'getWpYoastIndexableHierarchyService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPrimaryTerm' => 'getWpYoastPrimaryTermService',
            'Yoast\\WP\\SEO\\Config\\Schema_IDs' => 'getSchemaIDsService',
            'Yoast\\WP\\SEO\\Context\\Meta_Tags_Context' => 'getMetaTagsContextService',
            'Yoast\\WP\\SEO\\Exceptions\\Missing_Method' => 'getMissingMethodService',
            'Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator' => 'getBreadcrumbsGeneratorService',
            'Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator' => 'getOpenGraphImageGeneratorService',
            'Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator' => 'getOpenGraphLocaleGeneratorService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Article' => 'getArticleService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Author' => 'getAuthorService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Breadcrumb' => 'getBreadcrumbService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\FAQ' => 'getFAQService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\HowTo' => 'getHowToService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Main_Image' => 'getMainImageService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Organization' => 'getOrganizationService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Person' => 'getPersonService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\WebPage' => 'getWebPageService',
            'Yoast\\WP\\SEO\\Generators\\Schema\\Website' => 'getWebsiteService',
            'Yoast\\WP\\SEO\\Generators\\Schema_Generator' => 'getSchemaGeneratorService',
            'Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator' => 'getTwitterImageGeneratorService',
            'Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper' => 'getAuthorArchiveHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Blocks_Helper' => 'getBlocksHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper' => 'getCurrentPageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Date_Helper' => 'getDateHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Home_Url_Helper' => 'getHomeUrlHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Image_Helper' => 'getImageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Language_Helper' => 'getLanguageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Meta_Helper' => 'getMetaHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper' => 'getImageHelper2Service',
            'Yoast\\WP\\SEO\\Helpers\\Options_Helper' => 'getOptionsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Pagination_Helper' => 'getPaginationHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Post_Helper' => 'getPostHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper' => 'getPostTypeHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper' => 'getPrimaryTermHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Product_Helper' => 'getProductHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Redirect_Helper' => 'getRedirectHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Robots_Helper' => 'getRobotsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Schema\\Article_Helper' => 'getArticleHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Schema\\HTML_Helper' => 'getHTMLHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Schema\\ID_Helper' => 'getIDHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Schema\\Image_Helper' => 'getImageHelper3Service',
            'Yoast\\WP\\SEO\\Helpers\\Schema\\Language_Helper' => 'getLanguageHelper2Service',
            'Yoast\\WP\\SEO\\Helpers\\Site_Helper' => 'getSiteHelperService',
            'Yoast\\WP\\SEO\\Helpers\\String_Helper' => 'getStringHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper' => 'getTaxonomyHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper' => 'getImageHelper4Service',
            'Yoast\\WP\\SEO\\Helpers\\Url_Helper' => 'getUrlHelperService',
            'Yoast\\WP\\SEO\\Helpers\\User_Helper' => 'getUserHelperService',
            'Yoast\\WP\\SEO\\Initializers\\Disable_Core_Sitemaps' => 'getDisableCoreSitemapsService',
            'Yoast\\WP\\SEO\\Initializers\\Migration_Runner' => 'getMigrationRunnerService',
            'Yoast\\WP\\SEO\\Integrations\\Admin\\Indexation_Integration' => 'getIndexationIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Admin\\Migration_Error_Integration' => 'getMigrationErrorIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Internal_Linking_Category' => 'getInternalLinkingCategoryService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Structured_Data_Blocks' => 'getStructuredDataBlocksService',
            'Yoast\\WP\\SEO\\Integrations\\Breadcrumbs_Integration' => 'getBreadcrumbsIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Backwards_Compatibility' => 'getBackwardsCompatibilityService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Category_Term_Description' => 'getCategoryTermDescriptionService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Comment_Link_Fixer' => 'getCommentLinkFixerService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Force_Rewrite_Title' => 'getForceRewriteTitleService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Handle_404' => 'getHandle404Service',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Indexing_Controls' => 'getIndexingControlsService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Open_Graph_OEmbed' => 'getOpenGraphOEmbedService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\RSS_Footer_Embed' => 'getRSSFooterEmbedService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Redirects' => 'getRedirectsService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End\\Theme_Titles' => 'getThemeTitlesService',
            'Yoast\\WP\\SEO\\Integrations\\Front_End_Integration' => 'getFrontEndIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Primary_Category' => 'getPrimaryCategoryService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\AMP' => 'getAMPService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\BbPress' => 'getBbPressService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Jetpack' => 'getJetpackService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\WPML' => 'getWPMLService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\WooCommerce' => 'getWooCommerceService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Author_Watcher' => 'getIndexableAuthorWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Date_Archive_Watcher' => 'getIndexableDateArchiveWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Home_Page_Watcher' => 'getIndexableHomePageWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Permalink_Watcher' => 'getIndexablePermalinkWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Meta_Watcher' => 'getIndexablePostMetaWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Type_Archive_Watcher' => 'getIndexablePostTypeArchiveWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Watcher' => 'getIndexablePostWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Static_Home_Page_Watcher' => 'getIndexableStaticHomePageWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_System_Page_Watcher' => 'getIndexableSystemPageWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Term_Watcher' => 'getIndexableTermWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Option_Titles_Watcher' => 'getOptionTitlesWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Primary_Term_Watcher' => 'getPrimaryTermWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\XMLRPC' => 'getXMLRPCService',
            'Yoast\\WP\\SEO\\Loader' => 'getLoaderService',
            'Yoast\\WP\\SEO\\Loggers\\Logger' => 'getLoggerService',
            'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer' => 'getMetaTagsContextMemoizerService',
            'Yoast\\WP\\SEO\\Memoizers\\Presentation_Memoizer' => 'getPresentationMemoizerService',
            'Yoast\\WP\\SEO\\Oauth\\Client' => 'getClientService',
            'Yoast\\WP\\SEO\\Presentations\\Abstract_Presentation' => 'getAbstractPresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Author_Archive_Presentation' => 'getIndexableAuthorArchivePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Date_Archive_Presentation' => 'getIndexableDateArchivePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Error_Page_Presentation' => 'getIndexableErrorPagePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Home_Page_Presentation' => 'getIndexableHomePagePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Post_Type_Archive_Presentation' => 'getIndexablePostTypeArchivePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Post_Type_Presentation' => 'getIndexablePostTypePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Presentation' => 'getIndexablePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Search_Result_Page_Presentation' => 'getIndexableSearchResultPagePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Static_Home_Page_Presentation' => 'getIndexableStaticHomePagePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Static_Posts_Page_Presentation' => 'getIndexableStaticPostsPagePresentationService',
            'Yoast\\WP\\SEO\\Presentations\\Indexable_Term_Archive_Presentation' => 'getIndexableTermArchivePresentationService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository' => 'getIndexableHierarchyRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => 'getIndexableRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository' => 'getPrimaryTermRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository' => 'getSEOLinksRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository' => 'getSEOMetaRepositoryService',
            'Yoast\\WP\\SEO\\Routes\\Indexable_Indexation_Route' => 'getIndexableIndexationRouteService',
            'Yoast\\WP\\SEO\\Routes\\Indexables_Head_Route' => 'getIndexablesHeadRouteService',
            'Yoast\\WP\\SEO\\Routes\\Yoast_Head_REST_Field' => 'getYoastHeadRESTFieldService',
            'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface' => 'getClassesSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface' => 'getHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Meta_Surface' => 'getMetaSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface' => 'getOpenGraphHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface' => 'getSchemaHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface' => 'getTwitterHelpersSurfaceService',
            'Yoast\\WP\\SEO\\Values\\Images' => 'getImagesService',
            'Yoast\\WP\\SEO\\Values\\Open_Graph\\Images' => 'getImages2Service',
            'Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper' => 'getWPQueryWrapperService',
            'Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper' => 'getWPRewriteWrapperService',
            'wpdb' => 'getWpdbService',
        ];
        $this->privates = [
            'YoastSEO_Vendor\\YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'wpdb' => true,
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
            'Yoast\\WP\\SEO\\Commands\\Command_Interface' => true,
            'wpdb' => true,
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
        return $this->services['WPSEO_Admin_Asset_Manager'] = \Yoast\WP\SEO\WordPress\Wrapper::get_admin_asset_manager();
    }

    /**
     * Gets the public 'WPSEO_Breadcrumbs' shared autowired service.
     *
     * @return \WPSEO_Breadcrumbs
     */
    protected function getWPSEOBreadcrumbsService()
    {
        return $this->services['WPSEO_Breadcrumbs'] = new \WPSEO_Breadcrumbs();
    }

    /**
     * Gets the public 'WPSEO_Frontend' shared autowired service.
     *
     * @return \WPSEO_Frontend
     */
    protected function getWPSEOFrontendService()
    {
        return $this->services['WPSEO_Frontend'] = new \WPSEO_Frontend();
    }

    /**
     * Gets the public 'WPSEO_Replace_Vars' shared service.
     *
     * @return \WPSEO_Replace_Vars
     */
    protected function getWPSEOReplaceVarsService()
    {
        return $this->services['WPSEO_Replace_Vars'] = \Yoast\WP\SEO\WordPress\Wrapper::get_replace_vars();
    }

    /**
     * Gets the public 'Yoast\WP\Lib\Migrations\Adapter' shared autowired service.
     *
     * @return \Yoast\WP\Lib\Migrations\Adapter
     */
    protected function getAdapterService()
    {
        return $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexables\Indexable_Head_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexables\Indexable_Head_Action
     */
    protected function getIndexableHeadActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action'] = new \Yoast\WP\SEO\Actions\Indexables\Indexable_Head_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexation\Indexable_Complete_Indexation_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexation\Indexable_Complete_Indexation_Action
     */
    protected function getIndexableCompleteIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action'] = new \Yoast\WP\SEO\Actions\Indexation\Indexable_Complete_Indexation_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexation\Indexable_General_Indexation_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexation\Indexable_General_Indexation_Action
     */
    protected function getIndexableGeneralIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action'] = new \Yoast\WP\SEO\Actions\Indexation\Indexable_General_Indexation_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexation\Indexable_Post_Indexation_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexation\Indexable_Post_Indexation_Action
     */
    protected function getIndexablePostIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action'] = new \Yoast\WP\SEO\Actions\Indexation\Indexable_Post_Indexation_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['wpdb']) ? $this->services['wpdb'] : $this->getWpdbService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexation\Indexable_Post_Type_Archive_Indexation_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexation\Indexable_Post_Type_Archive_Indexation_Action
     */
    protected function getIndexablePostTypeArchiveIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action'] = new \Yoast\WP\SEO\Actions\Indexation\Indexable_Post_Type_Archive_Indexation_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Indexation\Indexable_Term_Indexation_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Indexation\Indexable_Term_Indexation_Action
     */
    protected function getIndexableTermIndexationActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action'] = new \Yoast\WP\SEO\Actions\Indexation\Indexable_Term_Indexation_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper'] : $this->getTaxonomyHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['wpdb']) ? $this->services['wpdb'] : $this->getWpdbService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Author_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Author_Builder
     */
    protected function getIndexableAuthorBuilderService()
    {
        $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] = $instance = new \Yoast\WP\SEO\Builders\Indexable_Author_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper'] = new \Yoast\WP\SEO\Helpers\Author_Archive_Helper())) && false ?: '_'});

        $instance->set_social_image_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] : $this->getImageHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'] : $this->getImageHelper4Service()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Builder
     */
    protected function getIndexableBuilderService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] : $this->getIndexableAuthorBuilderService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'])) {
            return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'];
        }
        $b = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder'] : $this->getIndexablePostBuilderService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'])) {
            return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'];
        }
        $c = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] : $this->getIndexableTermBuilderService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'])) {
            return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'];
        }
        $d = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Home_Page_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Home_Page_Builder'] : $this->getIndexableHomePageBuilderService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'])) {
            return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'];
        }
        $e = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder'] : $this->getIndexableHierarchyBuilderService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'])) {
            return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'];
        }

        $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] = $instance = new \Yoast\WP\SEO\Builders\Indexable_Builder($a, $b, $c, $d, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Type_Archive_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Type_Archive_Builder'] : $this->getIndexablePostTypeArchiveBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Date_Archive_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Date_Archive_Builder'] : $this->getIndexableDateArchiveBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_System_Page_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_System_Page_Builder'] : $this->getIndexableSystemPageBuilderService()) && false ?: '_'}, $e, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder'] : $this->getPrimaryTermBuilderService()) && false ?: '_'});

        $instance->set_indexable_repository(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Date_Archive_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Date_Archive_Builder
     */
    protected function getIndexableDateArchiveBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Date_Archive_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Date_Archive_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Hierarchy_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Hierarchy_Builder
     */
    protected function getIndexableHierarchyBuilderService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository'] : $this->getIndexableHierarchyRepositoryService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder'])) {
            return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder'];
        }

        $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder'] = $instance = new \Yoast\WP\SEO\Builders\Indexable_Hierarchy_Builder($a, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] : ($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] = new \Yoast\WP\SEO\Repositories\Primary_Term_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'});

        $instance->set_indexable_repository(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Home_Page_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Home_Page_Builder
     */
    protected function getIndexableHomePageBuilderService()
    {
        $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Home_Page_Builder'] = $instance = new \Yoast\WP\SEO\Builders\Indexable_Home_Page_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'});

        $instance->set_social_image_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] : $this->getImageHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'] : $this->getImageHelper4Service()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Post_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Post_Builder
     */
    protected function getIndexablePostBuilderService()
    {
        $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder'] = $instance = new \Yoast\WP\SEO\Builders\Indexable_Post_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository'] : ($this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository'] = new \Yoast\WP\SEO\Repositories\SEO_Meta_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'});

        $instance->set_indexable_repository(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
        $instance->set_social_image_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] : $this->getImageHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'] : $this->getImageHelper4Service()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Post_Type_Archive_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Post_Type_Archive_Builder
     */
    protected function getIndexablePostTypeArchiveBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Type_Archive_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Post_Type_Archive_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Rebuilder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Rebuilder
     */
    protected function getIndexableRebuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Rebuilder'] = new \Yoast\WP\SEO\Builders\Indexable_Rebuilder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_System_Page_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_System_Page_Builder
     */
    protected function getIndexableSystemPageBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_System_Page_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_System_Page_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Indexable_Term_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Term_Builder
     */
    protected function getIndexableTermBuilderService()
    {
        $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] = $instance = new \Yoast\WP\SEO\Builders\Indexable_Term_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper'] : $this->getTaxonomyHelperService()) && false ?: '_'});

        $instance->set_social_image_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] : $this->getImageHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'] : $this->getImageHelper4Service()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Builders\Primary_Term_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Primary_Term_Builder
     */
    protected function getPrimaryTermBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder'] = new \Yoast\WP\SEO\Builders\Primary_Term_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] : ($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] = new \Yoast\WP\SEO\Repositories\Primary_Term_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper'] = new \Yoast\WP\SEO\Helpers\Primary_Term_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] = new \Yoast\WP\SEO\Helpers\Meta_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Commands\Index_Command' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Commands\Index_Command
     */
    protected function getIndexCommandService()
    {
        return $this->services['Yoast\\WP\\SEO\\Commands\\Index_Command'] = new \Yoast\WP\SEO\Commands\Index_Command(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action'] : $this->getIndexablePostIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action'] : $this->getIndexableTermIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action'] : $this->getIndexablePostTypeArchiveIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action'] : $this->getIndexableGeneralIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action'] : $this->getIndexableCompleteIndexationActionService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Admin_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Admin_Conditional
     */
    protected function getAdminConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional'] = new \Yoast\WP\SEO\Conditionals\Admin_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Breadcrumbs_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Breadcrumbs_Enabled_Conditional
     */
    protected function getBreadcrumbsEnabledConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Breadcrumbs_Enabled_Conditional'] = new \Yoast\WP\SEO\Conditionals\Breadcrumbs_Enabled_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Development_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Development_Conditional
     */
    protected function getDevelopmentConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Development_Conditional'] = new \Yoast\WP\SEO\Conditionals\Development_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Front_End_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Front_End_Conditional
     */
    protected function getFrontEndConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional'] = new \Yoast\WP\SEO\Conditionals\Front_End_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Headless_Rest_Endpoints_Enabled_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Headless_Rest_Endpoints_Enabled_Conditional
     */
    protected function getHeadlessRestEndpointsEnabledConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Headless_Rest_Endpoints_Enabled_Conditional'] = new \Yoast\WP\SEO\Conditionals\Headless_Rest_Endpoints_Enabled_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Jetpack_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Jetpack_Conditional
     */
    protected function getJetpackConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Jetpack_Conditional'] = new \Yoast\WP\SEO\Conditionals\Jetpack_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Migrations_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Migrations_Conditional
     */
    protected function getMigrationsConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional'] = new \Yoast\WP\SEO\Conditionals\Migrations_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : ($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] = new \Yoast\WP\SEO\Config\Migration_Status())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Open_Graph_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Open_Graph_Conditional
     */
    protected function getOpenGraphConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Open_Graph_Conditional'] = new \Yoast\WP\SEO\Conditionals\Open_Graph_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Primary_Category_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Primary_Category_Conditional
     */
    protected function getPrimaryCategoryConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Primary_Category_Conditional'] = new \Yoast\WP\SEO\Conditionals\Primary_Category_Conditional(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\WPML_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\WPML_Conditional
     */
    protected function getWPMLConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\WPML_Conditional'] = new \Yoast\WP\SEO\Conditionals\WPML_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\WooCommerce_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\WooCommerce_Conditional
     */
    protected function getWooCommerceConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\WooCommerce_Conditional'] = new \Yoast\WP\SEO\Conditionals\WooCommerce_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\XMLRPC_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\XMLRPC_Conditional
     */
    protected function getXMLRPCConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\XMLRPC_Conditional'] = new \Yoast\WP\SEO\Conditionals\XMLRPC_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Yoast_Admin_And_Dashboard_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Yoast_Admin_And_Dashboard_Conditional
     */
    protected function getYoastAdminAndDashboardConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional'] = new \Yoast\WP\SEO\Conditionals\Yoast_Admin_And_Dashboard_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Dependency_Management' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Dependency_Management
     */
    protected function getDependencyManagementService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Dependency_Management'] = new \Yoast\WP\SEO\Config\Dependency_Management();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migration_Status' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migration_Status
     */
    protected function getMigrationStatusService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] = new \Yoast\WP\SEO\Config\Migration_Status();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\AddCollationToTables' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\AddCollationToTables
     */
    protected function getAddCollationToTablesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\AddCollationToTables'] = new \Yoast\WP\SEO\Config\Migrations\AddCollationToTables(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\AddColumnsToIndexables' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\AddColumnsToIndexables
     */
    protected function getAddColumnsToIndexablesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\AddColumnsToIndexables'] = new \Yoast\WP\SEO\Config\Migrations\AddColumnsToIndexables(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\AddHasAncestorsColumn' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\AddHasAncestorsColumn
     */
    protected function getAddHasAncestorsColumnService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\AddHasAncestorsColumn'] = new \Yoast\WP\SEO\Config\Migrations\AddHasAncestorsColumn(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\AddIndexableObjectIdAndTypeIndex' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\AddIndexableObjectIdAndTypeIndex
     */
    protected function getAddIndexableObjectIdAndTypeIndexService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\AddIndexableObjectIdAndTypeIndex'] = new \Yoast\WP\SEO\Config\Migrations\AddIndexableObjectIdAndTypeIndex(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\BreadcrumbTitleAndHierarchyReset' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\BreadcrumbTitleAndHierarchyReset
     */
    protected function getBreadcrumbTitleAndHierarchyResetService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\BreadcrumbTitleAndHierarchyReset'] = new \Yoast\WP\SEO\Config\Migrations\BreadcrumbTitleAndHierarchyReset(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\ClearIndexableTables' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\ClearIndexableTables
     */
    protected function getClearIndexableTablesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\ClearIndexableTables'] = new \Yoast\WP\SEO\Config\Migrations\ClearIndexableTables(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\CreateIndexableSubpagesIndex' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\CreateIndexableSubpagesIndex
     */
    protected function getCreateIndexableSubpagesIndexService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\CreateIndexableSubpagesIndex'] = new \Yoast\WP\SEO\Config\Migrations\CreateIndexableSubpagesIndex(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\DeleteDuplicateIndexables' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\DeleteDuplicateIndexables
     */
    protected function getDeleteDuplicateIndexablesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\DeleteDuplicateIndexables'] = new \Yoast\WP\SEO\Config\Migrations\DeleteDuplicateIndexables(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\ExpandIndexableColumnLengths' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\ExpandIndexableColumnLengths
     */
    protected function getExpandIndexableColumnLengthsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\ExpandIndexableColumnLengths'] = new \Yoast\WP\SEO\Config\Migrations\ExpandIndexableColumnLengths(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\ResetIndexableHierarchyTable' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\ResetIndexableHierarchyTable
     */
    protected function getResetIndexableHierarchyTableService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\ResetIndexableHierarchyTable'] = new \Yoast\WP\SEO\Config\Migrations\ResetIndexableHierarchyTable(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\TruncateIndexableTables' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\TruncateIndexableTables
     */
    protected function getTruncateIndexableTablesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\TruncateIndexableTables'] = new \Yoast\WP\SEO\Config\Migrations\TruncateIndexableTables(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\WpYoastDropIndexableMetaTableIfExists' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\WpYoastDropIndexableMetaTableIfExists
     */
    protected function getWpYoastDropIndexableMetaTableIfExistsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastDropIndexableMetaTableIfExists'] = new \Yoast\WP\SEO\Config\Migrations\WpYoastDropIndexableMetaTableIfExists(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\WpYoastIndexable' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\WpYoastIndexable
     */
    protected function getWpYoastIndexableService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexable'] = new \Yoast\WP\SEO\Config\Migrations\WpYoastIndexable(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\WpYoastIndexableHierarchy' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\WpYoastIndexableHierarchy
     */
    protected function getWpYoastIndexableHierarchyService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexableHierarchy'] = new \Yoast\WP\SEO\Config\Migrations\WpYoastIndexableHierarchy(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Migrations\WpYoastPrimaryTerm' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Migrations\WpYoastPrimaryTerm
     */
    protected function getWpYoastPrimaryTermService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPrimaryTerm'] = new \Yoast\WP\SEO\Config\Migrations\WpYoastPrimaryTerm(${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Config\Schema_IDs' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Config\Schema_IDs
     */
    protected function getSchemaIDsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Config\\Schema_IDs'] = new \Yoast\WP\SEO\Config\Schema_IDs();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Context\Meta_Tags_Context' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Context\Meta_Tags_Context
     */
    protected function getMetaTagsContextService()
    {
        return $this->services['Yoast\\WP\\SEO\\Context\\Meta_Tags_Context'] = new \Yoast\WP\SEO\Context\Meta_Tags_Context(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\ID_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\ID_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\ID_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\ID_Helper())) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Replace_Vars']) ? $this->services['WPSEO_Replace_Vars'] : $this->getWPSEOReplaceVarsService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] = new \Yoast\WP\SEO\Helpers\Site_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Exceptions\Missing_Method' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Exceptions\Missing_Method
     */
    protected function getMissingMethodService()
    {
        return $this->services['Yoast\\WP\\SEO\\Exceptions\\Missing_Method'] = new \Yoast\WP\SEO\Exceptions\Missing_Method();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Breadcrumbs_Generator' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Breadcrumbs_Generator
     */
    protected function getBreadcrumbsGeneratorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] = new \Yoast\WP\SEO\Generators\Breadcrumbs_Generator(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Open_Graph_Image_Generator' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Open_Graph_Image_Generator
     */
    protected function getOpenGraphImageGeneratorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Image_Generator(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] : $this->getImageHelper2Service()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator
     */
    protected function getOpenGraphLocaleGeneratorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Article' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Article
     */
    protected function getArticleService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Article'] = new \Yoast\WP\SEO\Generators\Schema\Article();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Author' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Author
     */
    protected function getAuthorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Author'] = new \Yoast\WP\SEO\Generators\Schema\Author();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Breadcrumb' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Breadcrumb
     */
    protected function getBreadcrumbService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Breadcrumb'] = new \Yoast\WP\SEO\Generators\Schema\Breadcrumb();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\FAQ' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\FAQ
     */
    protected function getFAQService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\FAQ'] = new \Yoast\WP\SEO\Generators\Schema\FAQ();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\HowTo' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\HowTo
     */
    protected function getHowToService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\HowTo'] = new \Yoast\WP\SEO\Generators\Schema\HowTo();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Main_Image' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Main_Image
     */
    protected function getMainImageService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Main_Image'] = new \Yoast\WP\SEO\Generators\Schema\Main_Image();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Organization' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Organization
     */
    protected function getOrganizationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Organization'] = new \Yoast\WP\SEO\Generators\Schema\Organization();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Person' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Person
     */
    protected function getPersonService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Person'] = new \Yoast\WP\SEO\Generators\Schema\Person();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\WebPage' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\WebPage
     */
    protected function getWebPageService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\WebPage'] = new \Yoast\WP\SEO\Generators\Schema\WebPage();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema\Website' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema\Website
     */
    protected function getWebsiteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema\\Website'] = new \Yoast\WP\SEO\Generators\Schema\Website();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Schema_Generator' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Schema_Generator
     */
    protected function getSchemaGeneratorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] = new \Yoast\WP\SEO\Generators\Schema_Generator(${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface'] : $this->getHelpersSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Generators\Twitter_Image_Generator' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Generators\Twitter_Image_Generator
     */
    protected function getTwitterImageGeneratorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] = new \Yoast\WP\SEO\Generators\Twitter_Image_Generator(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'] : $this->getImageHelper4Service()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Author_Archive_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Author_Archive_Helper
     */
    protected function getAuthorArchiveHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper'] = new \Yoast\WP\SEO\Helpers\Author_Archive_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Blocks_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Blocks_Helper
     */
    protected function getBlocksHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Blocks_Helper'] = new \Yoast\WP\SEO\Helpers\Blocks_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Current_Page_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Current_Page_Helper
     */
    protected function getCurrentPageHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] = new \Yoast\WP\SEO\Helpers\Current_Page_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Date_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Date_Helper
     */
    protected function getDateHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] = new \Yoast\WP\SEO\Helpers\Date_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Home_Url_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Home_Url_Helper
     */
    protected function getHomeUrlHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Home_Url_Helper'] = new \Yoast\WP\SEO\Helpers\Home_Url_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Image_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Image_Helper
     */
    protected function getImageHelperService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'])) {
            return $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'];
        }

        return $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] = new \Yoast\WP\SEO\Helpers\Image_Helper($a);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Language_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Language_Helper
     */
    protected function getLanguageHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper'] = new \Yoast\WP\SEO\Helpers\Language_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Meta_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Meta_Helper
     */
    protected function getMetaHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] = new \Yoast\WP\SEO\Helpers\Meta_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Open_Graph\Image_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Open_Graph\Image_Helper
     */
    protected function getImageHelper2Service()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'])) {
            return $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'];
        }

        return $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] = new \Yoast\WP\SEO\Helpers\Open_Graph\Image_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, $a);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Options_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Options_Helper
     */
    protected function getOptionsHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Pagination_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Pagination_Helper
     */
    protected function getPaginationHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] = new \Yoast\WP\SEO\Helpers\Pagination_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Rewrite_Wrapper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Post_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Post_Helper
     */
    protected function getPostHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper'] = new \Yoast\WP\SEO\Helpers\String_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Post_Type_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Post_Type_Helper
     */
    protected function getPostTypeHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Primary_Term_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Primary_Term_Helper
     */
    protected function getPrimaryTermHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper'] = new \Yoast\WP\SEO\Helpers\Primary_Term_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Product_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Product_Helper
     */
    protected function getProductHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Product_Helper'] = new \Yoast\WP\SEO\Helpers\Product_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Redirect_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Redirect_Helper
     */
    protected function getRedirectHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper'] = new \Yoast\WP\SEO\Helpers\Redirect_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Robots_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Robots_Helper
     */
    protected function getRobotsHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] = new \Yoast\WP\SEO\Helpers\Robots_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Schema\Article_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Schema\Article_Helper
     */
    protected function getArticleHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\Article_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\Article_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Schema\HTML_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Schema\HTML_Helper
     */
    protected function getHTMLHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\HTML_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\HTML_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Schema\ID_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Schema\ID_Helper
     */
    protected function getIDHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\ID_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\ID_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Schema\Image_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Schema\Image_Helper
     */
    protected function getImageHelper3Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\Image_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\Image_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\HTML_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\HTML_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\HTML_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\HTML_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\Language_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\Language_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\Language_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\Language_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Schema\Language_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Schema\Language_Helper
     */
    protected function getLanguageHelper2Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Schema\\Language_Helper'] = new \Yoast\WP\SEO\Helpers\Schema\Language_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Site_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Site_Helper
     */
    protected function getSiteHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] = new \Yoast\WP\SEO\Helpers\Site_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\String_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\String_Helper
     */
    protected function getStringHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper'] = new \Yoast\WP\SEO\Helpers\String_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Taxonomy_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Taxonomy_Helper
     */
    protected function getTaxonomyHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper'] = new \Yoast\WP\SEO\Helpers\Taxonomy_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\String_Helper'] = new \Yoast\WP\SEO\Helpers\String_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Twitter\Image_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Twitter\Image_Helper
     */
    protected function getImageHelper4Service()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'])) {
            return $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'];
        }

        return $this->services['Yoast\\WP\\SEO\\Helpers\\Twitter\\Image_Helper'] = new \Yoast\WP\SEO\Helpers\Twitter\Image_Helper($a);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Url_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Url_Helper
     */
    protected function getUrlHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\User_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\User_Helper
     */
    protected function getUserHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Initializers\Disable_Core_Sitemaps' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Initializers\Disable_Core_Sitemaps
     */
    protected function getDisableCoreSitemapsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Initializers\\Disable_Core_Sitemaps'] = new \Yoast\WP\SEO\Initializers\Disable_Core_Sitemaps();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Initializers\Migration_Runner' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Initializers\Migration_Runner
     */
    protected function getMigrationRunnerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Initializers\\Migration_Runner'] = new \Yoast\WP\SEO\Initializers\Migration_Runner(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : ($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] = new \Yoast\WP\SEO\Config\Migration_Status())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loader']) ? $this->services['Yoast\\WP\\SEO\\Loader'] : $this->getLoaderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : ($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] = new \Yoast\WP\Lib\Migrations\Adapter())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Admin\Indexation_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Admin\Indexation_Integration
     */
    protected function getIndexationIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Indexation_Integration'] = new \Yoast\WP\SEO\Integrations\Admin\Indexation_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action'] : $this->getIndexablePostIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action'] : $this->getIndexableTermIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action'] : $this->getIndexablePostTypeArchiveIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action'] : $this->getIndexableGeneralIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action'] : $this->getIndexableCompleteIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Admin\Migration_Error_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Admin\Migration_Error_Integration
     */
    protected function getMigrationErrorIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Migration_Error_Integration'] = new \Yoast\WP\SEO\Integrations\Admin\Migration_Error_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : ($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] = new \Yoast\WP\SEO\Config\Migration_Status())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Internal_Linking_Category' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Internal_Linking_Category
     */
    protected function getInternalLinkingCategoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Internal_Linking_Category'] = new \Yoast\WP\SEO\Integrations\Blocks\Internal_Linking_Category();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Structured_Data_Blocks' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Structured_Data_Blocks
     */
    protected function getStructuredDataBlocksService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Structured_Data_Blocks'] = new \Yoast\WP\SEO\Integrations\Blocks\Structured_Data_Blocks(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Breadcrumbs_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Breadcrumbs_Integration
     */
    protected function getBreadcrumbsIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Breadcrumbs_Integration'] = new \Yoast\WP\SEO\Integrations\Breadcrumbs_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface'] : $this->getHelpersSurfaceService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Replace_Vars']) ? $this->services['WPSEO_Replace_Vars'] : $this->getWPSEOReplaceVarsService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Backwards_Compatibility' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Backwards_Compatibility
     */
    protected function getBackwardsCompatibilityService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Backwards_Compatibility'] = new \Yoast\WP\SEO\Integrations\Front_End\Backwards_Compatibility(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Category_Term_Description' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Category_Term_Description
     */
    protected function getCategoryTermDescriptionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Category_Term_Description'] = new \Yoast\WP\SEO\Integrations\Front_End\Category_Term_Description();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Comment_Link_Fixer' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Comment_Link_Fixer
     */
    protected function getCommentLinkFixerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Comment_Link_Fixer'] = new \Yoast\WP\SEO\Integrations\Front_End\Comment_Link_Fixer(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper'] = new \Yoast\WP\SEO\Helpers\Redirect_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] = new \Yoast\WP\SEO\Helpers\Robots_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Force_Rewrite_Title' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Force_Rewrite_Title
     */
    protected function getForceRewriteTitleService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Force_Rewrite_Title'] = new \Yoast\WP\SEO\Integrations\Front_End\Force_Rewrite_Title(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Handle_404' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Handle_404
     */
    protected function getHandle404Service()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Handle_404'] = new \Yoast\WP\SEO\Integrations\Front_End\Handle_404(${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Indexing_Controls' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Indexing_Controls
     */
    protected function getIndexingControlsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Indexing_Controls'] = new \Yoast\WP\SEO\Integrations\Front_End\Indexing_Controls(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Robots_Helper'] = new \Yoast\WP\SEO\Helpers\Robots_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Open_Graph_OEmbed' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Open_Graph_OEmbed
     */
    protected function getOpenGraphOEmbedService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Open_Graph_OEmbed'] = new \Yoast\WP\SEO\Integrations\Front_End\Open_Graph_OEmbed(${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\RSS_Footer_Embed' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\RSS_Footer_Embed
     */
    protected function getRSSFooterEmbedService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\RSS_Footer_Embed'] = new \Yoast\WP\SEO\Integrations\Front_End\RSS_Footer_Embed(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Redirects' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Redirects
     */
    protected function getRedirectsService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Redirects'] = new \Yoast\WP\SEO\Integrations\Front_End\Redirects(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] = new \Yoast\WP\SEO\Helpers\Meta_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Redirect_Helper'] = new \Yoast\WP\SEO\Helpers\Redirect_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End\Theme_Titles' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End\Theme_Titles
     */
    protected function getThemeTitlesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End\\Theme_Titles'] = new \Yoast\WP\SEO\Integrations\Front_End\Theme_Titles();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Front_End_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Front_End_Integration
     */
    protected function getFrontEndIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End_Integration'] = new \Yoast\WP\SEO\Integrations\Front_End_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, $this, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface'] : $this->getHelpersSurfaceService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Replace_Vars']) ? $this->services['WPSEO_Replace_Vars'] : $this->getWPSEOReplaceVarsService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Primary_Category' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Primary_Category
     */
    protected function getPrimaryCategoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Primary_Category'] = new \Yoast\WP\SEO\Integrations\Primary_Category();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\AMP' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\AMP
     */
    protected function getAMPService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\AMP'] = new \Yoast\WP\SEO\Integrations\Third_Party\AMP(${($_ = isset($this->services['Yoast\\WP\\SEO\\Integrations\\Front_End_Integration']) ? $this->services['Yoast\\WP\\SEO\\Integrations\\Front_End_Integration'] : $this->getFrontEndIntegrationService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\BbPress' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\BbPress
     */
    protected function getBbPressService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\BbPress'] = new \Yoast\WP\SEO\Integrations\Third_Party\BbPress(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Jetpack' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Jetpack
     */
    protected function getJetpackService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Jetpack'] = new \Yoast\WP\SEO\Integrations\Third_Party\Jetpack();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\WPML' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\WPML
     */
    protected function getWPMLService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\WPML'] = new \Yoast\WP\SEO\Integrations\Third_Party\WPML();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\WooCommerce' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\WooCommerce
     */
    protected function getWooCommerceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\WooCommerce'] = new \Yoast\WP\SEO\Integrations\Third_Party\WooCommerce(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Replace_Vars']) ? $this->services['WPSEO_Replace_Vars'] : $this->getWPSEOReplaceVarsService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Author_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Author_Watcher
     */
    protected function getIndexableAuthorWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Author_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Author_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Date_Archive_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Date_Archive_Watcher
     */
    protected function getIndexableDateArchiveWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Date_Archive_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Date_Archive_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Home_Page_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Home_Page_Watcher
     */
    protected function getIndexableHomePageWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Home_Page_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Home_Page_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Permalink_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Permalink_Watcher
     */
    protected function getIndexablePermalinkWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Permalink_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Permalink_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Meta_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Meta_Watcher
     */
    protected function getIndexablePostMetaWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Meta_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Meta_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Watcher']) ? $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Watcher'] : $this->getIndexablePostWatcherService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Type_Archive_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Type_Archive_Watcher
     */
    protected function getIndexablePostTypeArchiveWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Type_Archive_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Type_Archive_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Watcher
     */
    protected function getIndexablePostWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Post_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository'] : $this->getIndexableHierarchyRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper'] = new \Yoast\WP\SEO\Helpers\Author_Archive_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Static_Home_Page_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Static_Home_Page_Watcher
     */
    protected function getIndexableStaticHomePageWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Static_Home_Page_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Static_Home_Page_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_System_Page_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_System_Page_Watcher
     */
    protected function getIndexableSystemPageWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_System_Page_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_System_Page_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Indexable_Term_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Indexable_Term_Watcher
     */
    protected function getIndexableTermWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Term_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Indexable_Term_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] = new \Yoast\WP\SEO\Helpers\Site_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Option_Titles_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Option_Titles_Watcher
     */
    protected function getOptionTitlesWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Option_Titles_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Option_Titles_Watcher();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Primary_Term_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Primary_Term_Watcher
     */
    protected function getPrimaryTermWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Primary_Term_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Primary_Term_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] : ($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] = new \Yoast\WP\SEO\Repositories\Primary_Term_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Site_Helper'] = new \Yoast\WP\SEO\Helpers\Site_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Primary_Term_Helper'] = new \Yoast\WP\SEO\Helpers\Primary_Term_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Primary_Term_Builder'] : $this->getPrimaryTermBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\XMLRPC' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\XMLRPC
     */
    protected function getXMLRPCService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\XMLRPC'] = new \Yoast\WP\SEO\Integrations\XMLRPC();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Loader' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Loader
     */
    protected function getLoaderService()
    {
        $this->services['Yoast\\WP\\SEO\\Loader'] = $instance = new \Yoast\WP\SEO\Loader($this);

        $instance->register_command('Yoast\\WP\\SEO\\Commands\\Index_Command');
        $instance->register_migration('free', '20171228151840', 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexable');
        $instance->register_migration('free', '20171228151841', 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPrimaryTerm');
        $instance->register_migration('free', '20190529075038', 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastDropIndexableMetaTableIfExists');
        $instance->register_migration('free', '20191011111109', 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastIndexableHierarchy');
        $instance->register_migration('free', '20200408101900', 'Yoast\\WP\\SEO\\Config\\Migrations\\AddCollationToTables');
        $instance->register_migration('free', '20200420073606', 'Yoast\\WP\\SEO\\Config\\Migrations\\AddColumnsToIndexables');
        $instance->register_migration('free', '20200428123747', 'Yoast\\WP\\SEO\\Config\\Migrations\\BreadcrumbTitleAndHierarchyReset');
        $instance->register_migration('free', '20200428194858', 'Yoast\\WP\\SEO\\Config\\Migrations\\ExpandIndexableColumnLengths');
        $instance->register_migration('free', '20200429105310', 'Yoast\\WP\\SEO\\Config\\Migrations\\TruncateIndexableTables');
        $instance->register_migration('free', '20200430075614', 'Yoast\\WP\\SEO\\Config\\Migrations\\AddIndexableObjectIdAndTypeIndex');
        $instance->register_migration('free', '20200430150130', 'Yoast\\WP\\SEO\\Config\\Migrations\\ClearIndexableTables');
        $instance->register_migration('free', '20200507054848', 'Yoast\\WP\\SEO\\Config\\Migrations\\DeleteDuplicateIndexables');
        $instance->register_migration('free', '20200513133401', 'Yoast\\WP\\SEO\\Config\\Migrations\\ResetIndexableHierarchyTable');
        $instance->register_migration('free', '20200609154515', 'Yoast\\WP\\SEO\\Config\\Migrations\\AddHasAncestorsColumn');
        $instance->register_migration('free', '20200702141921', 'Yoast\\WP\\SEO\\Config\\Migrations\\CreateIndexableSubpagesIndex');
        $instance->register_initializer('Yoast\\WP\\SEO\\Initializers\\Disable_Core_Sitemaps');
        $instance->register_initializer('Yoast\\WP\\SEO\\Initializers\\Migration_Runner');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Admin\\Indexation_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Admin\\Migration_Error_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Internal_Linking_Category');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Structured_Data_Blocks');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Breadcrumbs_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Backwards_Compatibility');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Category_Term_Description');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Comment_Link_Fixer');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Force_Rewrite_Title');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Handle_404');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Indexing_Controls');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Open_Graph_OEmbed');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Redirects');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\RSS_Footer_Embed');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Front_End\\Theme_Titles');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Primary_Category');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\AMP');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\BbPress');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Jetpack');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\WooCommerce');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\WPML');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Author_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Date_Archive_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Home_Page_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Permalink_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Meta_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Type_Archive_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Post_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Static_Home_Page_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_System_Page_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Indexable_Term_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Option_Titles_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Primary_Term_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\XMLRPC');
        $instance->register_route('Yoast\\WP\\SEO\\Routes\\Indexable_Indexation_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Routes\\Indexables_Head_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Routes\\Yoast_Head_REST_Field');

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Loggers\Logger' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Loggers\Logger
     */
    protected function getLoggerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer
     */
    protected function getMetaTagsContextMemoizerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] = new \Yoast\WP\SEO\Memoizers\Meta_Tags_Context_Memoizer(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Blocks_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Blocks_Helper'] : $this->getBlocksHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Context\\Meta_Tags_Context']) ? $this->services['Yoast\\WP\\SEO\\Context\\Meta_Tags_Context'] : $this->getMetaTagsContextService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Presentation_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Presentation_Memoizer'] : ($this->services['Yoast\\WP\\SEO\\Memoizers\\Presentation_Memoizer'] = new \Yoast\WP\SEO\Memoizers\Presentation_Memoizer($this))) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Memoizers\Presentation_Memoizer' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Memoizers\Presentation_Memoizer
     */
    protected function getPresentationMemoizerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Memoizers\\Presentation_Memoizer'] = new \Yoast\WP\SEO\Memoizers\Presentation_Memoizer($this);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Oauth\Client' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Oauth\Client
     */
    protected function getClientService()
    {
        return $this->services['Yoast\\WP\\SEO\\Oauth\\Client'] = new \Yoast\WP\SEO\Oauth\Client();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Abstract_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Abstract_Presentation
     */
    protected function getAbstractPresentationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Presentations\\Abstract_Presentation'] = new \Yoast\WP\SEO\Presentations\Abstract_Presentation();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Author_Archive_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Author_Archive_Presentation
     */
    protected function getIndexableAuthorArchivePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Author_Archive_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Author_Archive_Presentation(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'});

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});
        $instance->set_archive_adjacent_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Date_Archive_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Date_Archive_Presentation
     */
    protected function getIndexableDateArchivePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Date_Archive_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Date_Archive_Presentation(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'});

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Error_Page_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Error_Page_Presentation
     */
    protected function getIndexableErrorPagePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Error_Page_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Error_Page_Presentation();

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Home_Page_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Home_Page_Presentation
     */
    protected function getIndexableHomePagePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Home_Page_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Home_Page_Presentation();

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});
        $instance->set_archive_adjacent_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Post_Type_Archive_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Post_Type_Archive_Presentation
     */
    protected function getIndexablePostTypeArchivePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Post_Type_Archive_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Post_Type_Archive_Presentation();

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});
        $instance->set_archive_adjacent_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation
     */
    protected function getIndexablePostTypePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Post_Type_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] = new \Yoast\WP\SEO\Helpers\Date_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'});

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Presentation
     */
    protected function getIndexablePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Presentation();

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Search_Result_Page_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Search_Result_Page_Presentation
     */
    protected function getIndexableSearchResultPagePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Search_Result_Page_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Search_Result_Page_Presentation();

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Static_Home_Page_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Static_Home_Page_Presentation
     */
    protected function getIndexableStaticHomePagePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Static_Home_Page_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Static_Home_Page_Presentation(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] = new \Yoast\WP\SEO\Helpers\Date_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'});

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Static_Posts_Page_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Static_Posts_Page_Presentation
     */
    protected function getIndexableStaticPostsPagePresentationService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'};

        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Static_Posts_Page_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Static_Posts_Page_Presentation(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Date_Helper'] = new \Yoast\WP\SEO\Helpers\Date_Helper())) && false ?: '_'}, $a, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Helper'] : $this->getPostHelperService()) && false ?: '_'});

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});
        $instance->set_archive_adjacent_helpers($a);

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Presentations\Indexable_Term_Archive_Presentation' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Presentations\Indexable_Term_Archive_Presentation
     */
    protected function getIndexableTermArchivePresentationService()
    {
        $this->services['Yoast\\WP\\SEO\\Presentations\\Indexable_Term_Archive_Presentation'] = $instance = new \Yoast\WP\SEO\Presentations\Indexable_Term_Archive_Presentation(${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper'] : $this->getTaxonomyHelperService()) && false ?: '_'});

        $instance->set_generators(${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Schema_Generator'] : $this->getSchemaGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] : ($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Locale_Generator'] = new \Yoast\WP\SEO\Generators\Open_Graph_Locale_Generator())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Open_Graph_Image_Generator'] : $this->getOpenGraphImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Twitter_Image_Generator'] : $this->getTwitterImageGeneratorService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator']) ? $this->services['Yoast\\WP\\SEO\\Generators\\Breadcrumbs_Generator'] : $this->getBreadcrumbsGeneratorService()) && false ?: '_'});
        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\User_Helper'] = new \Yoast\WP\SEO\Helpers\User_Helper())) && false ?: '_'});
        $instance->set_archive_adjacent_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Pagination_Helper'] : $this->getPaginationHelperService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\Indexable_Hierarchy_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\Indexable_Hierarchy_Repository
     */
    protected function getIndexableHierarchyRepositoryService()
    {
        $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository'] = $instance = new \Yoast\WP\SEO\Repositories\Indexable_Hierarchy_Repository();

        $instance->set_builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Hierarchy_Builder'] : $this->getIndexableHierarchyBuilderService()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\Indexable_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\Indexable_Repository
     */
    protected function getIndexableRepositoryService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Builder'] : $this->getIndexableBuilderService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'])) {
            return $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'];
        }
        $b = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Hierarchy_Repository'] : $this->getIndexableHierarchyRepositoryService()) && false ?: '_'};

        if (isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'])) {
            return $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'];
        }

        return $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] = new \Yoast\WP\SEO\Repositories\Indexable_Repository($a, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Current_Page_Helper'] : $this->getCurrentPageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'}, $b);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\Primary_Term_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\Primary_Term_Repository
     */
    protected function getPrimaryTermRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] = new \Yoast\WP\SEO\Repositories\Primary_Term_Repository();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\SEO_Links_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\SEO_Links_Repository
     */
    protected function getSEOLinksRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] = new \Yoast\WP\SEO\Repositories\SEO_Links_Repository();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Repositories\SEO_Meta_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\SEO_Meta_Repository
     */
    protected function getSEOMetaRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository'] = new \Yoast\WP\SEO\Repositories\SEO_Meta_Repository();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Indexable_Indexation_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Indexable_Indexation_Route
     */
    protected function getIndexableIndexationRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Routes\\Indexable_Indexation_Route'] = new \Yoast\WP\SEO\Routes\Indexable_Indexation_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Indexation_Action'] : $this->getIndexablePostIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Term_Indexation_Action'] : $this->getIndexableTermIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Post_Type_Archive_Indexation_Action'] : $this->getIndexablePostTypeArchiveIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_General_Indexation_Action'] : $this->getIndexableGeneralIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexation\\Indexable_Complete_Indexation_Action'] : $this->getIndexableCompleteIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] = new \Yoast\WP\SEO\Helpers\Options_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Indexables_Head_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Indexables_Head_Route
     */
    protected function getIndexablesHeadRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Routes\\Indexables_Head_Route'] = new \Yoast\WP\SEO\Routes\Indexables_Head_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action'] : $this->getIndexableHeadActionService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Yoast_Head_REST_Field' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Yoast_Head_REST_Field
     */
    protected function getYoastHeadRESTFieldService()
    {
        return $this->services['Yoast\\WP\\SEO\\Routes\\Yoast_Head_REST_Field'] = new \Yoast\WP\SEO\Routes\Yoast_Head_REST_Field(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Post_Type_Helper'] = new \Yoast\WP\SEO\Helpers\Post_Type_Helper())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Taxonomy_Helper'] : $this->getTaxonomyHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexables\\Indexable_Head_Action'] : $this->getIndexableHeadActionService()) && false ?: '_'});
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
    protected function getHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Helpers_Surface($this, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface'] : ($this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Open_Graph_Helpers_Surface($this))) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface'] : ($this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Schema_Helpers_Surface($this))) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface'] : ($this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Twitter_Helpers_Surface($this))) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Meta_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Meta_Surface
     */
    protected function getMetaSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] = new \Yoast\WP\SEO\Surfaces\Meta_Surface($this, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper']) ? $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper'] : ($this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Rewrite_Wrapper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Open_Graph_Helpers_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Open_Graph_Helpers_Surface
     */
    protected function getOpenGraphHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Open_Graph_Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Open_Graph_Helpers_Surface($this);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Schema_Helpers_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Schema_Helpers_Surface
     */
    protected function getSchemaHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Schema_Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Schema_Helpers_Surface($this);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Surfaces\Twitter_Helpers_Surface' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Surfaces\Twitter_Helpers_Surface
     */
    protected function getTwitterHelpersSurfaceService()
    {
        return $this->services['Yoast\\WP\\SEO\\Surfaces\\Twitter_Helpers_Surface'] = new \Yoast\WP\SEO\Surfaces\Twitter_Helpers_Surface($this);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Values\Images' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Values\Images
     */
    protected function getImagesService()
    {
        return $this->services['Yoast\\WP\\SEO\\Values\\Images'] = new \Yoast\WP\SEO\Values\Images(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Values\Open_Graph\Images' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Values\Open_Graph\Images
     */
    protected function getImages2Service()
    {
        $this->services['Yoast\\WP\\SEO\\Values\\Open_Graph\\Images'] = $instance = new \Yoast\WP\SEO\Values\Open_Graph\Images(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Image_Helper'] : $this->getImageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] : ($this->services['Yoast\\WP\\SEO\\Helpers\\Url_Helper'] = new \Yoast\WP\SEO\Helpers\Url_Helper())) && false ?: '_'});

        $instance->set_helpers(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Open_Graph\\Image_Helper'] : $this->getImageHelper2Service()) && false ?: '_'});

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Wrappers\WP_Query_Wrapper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper
     */
    protected function getWPQueryWrapperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Query_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Query_Wrapper();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Wrappers\WP_Rewrite_Wrapper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Wrappers\WP_Rewrite_Wrapper
     */
    protected function getWPRewriteWrapperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Wrappers\\WP_Rewrite_Wrapper'] = new \Yoast\WP\SEO\Wrappers\WP_Rewrite_Wrapper();
    }

    /**
     * Gets the private 'wpdb' shared service.
     *
     * @return \wpdb
     */
    protected function getWpdbService()
    {
        return $this->services['wpdb'] = \Yoast\WP\SEO\WordPress\Wrapper::get_wpdb();
    }
}
