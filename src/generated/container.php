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
            'yoast\\wp\\seo\\conditionals\\admin_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional',
            'yoast\\wp\\seo\\conditionals\\front_end_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional',
            'yoast\\wp\\seo\\conditionals\\migrations_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional',
            'yoast\\wp\\seo\\conditionals\\schema_blocks_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Schema_Blocks_Conditional',
            'yoast\\wp\\seo\\conditionals\\third_party\\elementor_edit_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional',
            'yoast\\wp\\seo\\conditionals\\yoast_admin_and_dashboard_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional',
            'yoast\\wp\\seo\\conditionals\\zapier_enabled_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Zapier_Enabled_Conditional',
            'yoast\\wp\\seo\\config\\migration_status' => 'Yoast\\WP\\SEO\\Config\\Migration_Status',
            'yoast\\wp\\seo\\config\\migrations\\wpyoastpremiumimprovedinternallinking' => 'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking',
            'yoast\\wp\\seo\\database\\migration_runner_premium' => 'Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium',
            'yoast\\wp\\seo\\helpers\\indexing_helper' => 'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper',
            'yoast\\wp\\seo\\helpers\\language_helper' => 'Yoast\\WP\\SEO\\Helpers\\Language_Helper',
            'yoast\\wp\\seo\\helpers\\meta_helper' => 'Yoast\\WP\\SEO\\Helpers\\Meta_Helper',
            'yoast\\wp\\seo\\helpers\\options_helper' => 'Yoast\\WP\\SEO\\Helpers\\Options_Helper',
            'yoast\\wp\\seo\\helpers\\prominent_words_helper' => 'Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper',
            'yoast\\wp\\seo\\helpers\\zapier_helper' => 'Yoast\\WP\\SEO\\Helpers\\Zapier_Helper',
            'yoast\\wp\\seo\\initializers\\redirect_handler' => 'Yoast\\WP\\SEO\\Initializers\\Redirect_Handler',
            'yoast\\wp\\seo\\integrations\\admin\\prominent_words\\indexing_integration' => 'Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration',
            'yoast\\wp\\seo\\integrations\\admin\\prominent_words\\metabox_integration' => 'Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration',
            'yoast\\wp\\seo\\integrations\\blocks\\estimated_reading_time_block' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block',
            'yoast\\wp\\seo\\integrations\\blocks\\job_posting_block' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block',
            'yoast\\wp\\seo\\integrations\\blocks\\related_links_block' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block',
            'yoast\\wp\\seo\\integrations\\blocks\\schema_blocks' => 'Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks',
            'yoast\\wp\\seo\\integrations\\third_party\\elementor_premium' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium',
            'yoast\\wp\\seo\\integrations\\third_party\\zapier' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier',
            'yoast\\wp\\seo\\integrations\\third_party\\zapier_classic_editor' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor',
            'yoast\\wp\\seo\\integrations\\third_party\\zapier_trigger' => 'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger',
            'yoast\\wp\\seo\\integrations\\watchers\\premium_option_wpseo_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher',
            'yoast\\wp\\seo\\integrations\\watchers\\zapier_apikey_reset_watcher' => 'Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher',
            'yoast\\wp\\seo\\loader' => 'Yoast\\WP\\SEO\\Loader',
            'yoast\\wp\\seo\\memoizers\\meta_tags_context_memoizer' => 'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer',
            'yoast\\wp\\seo\\premium\\initializers\\plugin' => 'Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin',
            'yoast\\wp\\seo\\premium\\integrations\\admin\\plugin_links_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration',
            'yoast\\wp\\seo\\premium\\integrations\\upgrade_integration' => 'Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration',
            'yoast\\wp\\seo\\premium\\main' => 'Yoast\\WP\\SEO\\Premium\\Main',
            'yoast\\wp\\seo\\repositories\\indexable_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository',
            'yoast\\wp\\seo\\repositories\\prominent_words_repository' => 'Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository',
            'yoast\\wp\\seo\\routes\\link_suggestions_route' => 'Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route',
            'yoast\\wp\\seo\\routes\\prominent_words_route' => 'Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route',
            'yoast\\wp\\seo\\routes\\zapier_route' => 'Yoast\\WP\\SEO\\Routes\\Zapier_Route',
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
            'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional' => 'getAdminConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Front_End_Conditional' => 'getFrontEndConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Migrations_Conditional' => 'getMigrationsConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Schema_Blocks_Conditional' => 'getSchemaBlocksConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Third_Party\\Elementor_Edit_Conditional' => 'getElementorEditConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Yoast_Admin_And_Dashboard_Conditional' => 'getYoastAdminAndDashboardConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Zapier_Enabled_Conditional' => 'getZapierEnabledConditionalService',
            'Yoast\\WP\\SEO\\Config\\Migration_Status' => 'getMigrationStatusService',
            'Yoast\\WP\\SEO\\Config\\Migrations\\WpYoastPremiumImprovedInternalLinking' => 'getWpYoastPremiumImprovedInternalLinkingService',
            'Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium' => 'getMigrationRunnerPremiumService',
            'Yoast\\WP\\SEO\\Helpers\\Indexing_Helper' => 'getIndexingHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Language_Helper' => 'getLanguageHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Meta_Helper' => 'getMetaHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Options_Helper' => 'getOptionsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper' => 'getProminentWordsHelperService',
            'Yoast\\WP\\SEO\\Helpers\\Zapier_Helper' => 'getZapierHelperService',
            'Yoast\\WP\\SEO\\Initializers\\Redirect_Handler' => 'getRedirectHandlerService',
            'Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration' => 'getIndexingIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration' => 'getMetaboxIntegrationService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block' => 'getEstimatedReadingTimeBlockService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block' => 'getJobPostingBlockService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block' => 'getRelatedLinksBlockService',
            'Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks' => 'getSchemaBlocksService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium' => 'getElementorPremiumService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier' => 'getZapierService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor' => 'getZapierClassicEditorService',
            'Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger' => 'getZapierTriggerService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher' => 'getPremiumOptionWpseoWatcherService',
            'Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher' => 'getZapierAPIKeyResetWatcherService',
            'Yoast\\WP\\SEO\\Loader' => 'getLoaderService',
            'Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer' => 'getMetaTagsContextMemoizerService',
            'Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin' => 'getPluginService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration' => 'getPluginLinksIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration' => 'getUpgradeIntegrationService',
            'Yoast\\WP\\SEO\\Premium\\Main' => 'getMainService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => 'getIndexableRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository' => 'getProminentWordsRepositoryService',
            'Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route' => 'getLinkSuggestionsRouteService',
            'Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route' => 'getProminentWordsRouteService',
            'Yoast\\WP\\SEO\\Routes\\Zapier_Route' => 'getZapierRouteService',
            'Yoast\\WP\\SEO\\Surfaces\\Classes_Surface' => 'getClassesSurfaceService',
            'Yoast\\WP\\SEO\\Surfaces\\Helpers_Surface' => 'getHelpersSurfaceService',
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
     */
    protected function getLinkSuggestionsActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action'] = new \Yoast\WP\SEO\Actions\Link_Suggestions_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Repositories\Prominent_Words_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action
     */
    protected function getCompleteActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action'] = new \Yoast\WP\SEO\Actions\Prominent_Words\Complete_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Prominent_Words\Content_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Prominent_Words\Content_Action
     */
    protected function getContentActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action'] = new \Yoast\WP\SEO\Actions\Prominent_Words\Content_Action(${($_ = isset($this->services['WPSEO_Premium_Prominent_Words_Support']) ? $this->services['WPSEO_Premium_Prominent_Words_Support'] : $this->getWPSEOPremiumProminentWordsSupportService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer']) ? $this->services['Yoast\\WP\\SEO\\Memoizers\\Meta_Tags_Context_Memoizer'] : $this->getMetaTagsContextMemoizerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Prominent_Words\Save_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Prominent_Words\Save_Action
     */
    protected function getSaveActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action'] = new \Yoast\WP\SEO\Actions\Prominent_Words\Save_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] : ($this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Repositories\Prominent_Words_Repository())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Actions\Zapier_Action' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Actions\Zapier_Action
     */
    protected function getZapierActionService()
    {
        return $this->services['Yoast\\WP\\SEO\\Actions\\Zapier_Action'] = new \Yoast\WP\SEO\Actions\Zapier_Action(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] : $this->getZapierHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'});
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
     */
    protected function getZapierEnabledConditionalService()
    {
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
     */
    protected function getMigrationRunnerPremiumService()
    {
        return $this->services['Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium'] = new \Yoast\WP\SEO\Database\Migration_Runner_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Config\\Migration_Status']) ? $this->services['Yoast\\WP\\SEO\\Config\\Migration_Status'] : $this->getMigrationStatusService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loader']) ? $this->services['Yoast\\WP\\SEO\\Loader'] : $this->getLoaderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Lib\\Migrations\\Adapter']) ? $this->services['Yoast\\WP\\Lib\\Migrations\\Adapter'] : $this->getAdapterService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Helpers\Prominent_Words_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Prominent_Words_Helper
     */
    protected function getProminentWordsHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] = new \Yoast\WP\SEO\Helpers\Prominent_Words_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Helpers\Zapier_Helper' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Helpers\Zapier_Helper
     */
    protected function getZapierHelperService()
    {
        return $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] = new \Yoast\WP\SEO\Helpers\Zapier_Helper(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface']) ? $this->services['Yoast\\WP\\SEO\\Surfaces\\Meta_Surface'] : $this->getMetaSurfaceService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Initializers\Redirect_Handler' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Initializers\Redirect_Handler
     */
    protected function getRedirectHandlerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Initializers\\Redirect_Handler'] = new \Yoast\WP\SEO\Initializers\Redirect_Handler();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Admin\Prominent_Words\Indexing_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Admin\Prominent_Words\Indexing_Integration
     */
    protected function getIndexingIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration'] = new \Yoast\WP\SEO\Integrations\Admin\Prominent_Words\Indexing_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Indexation_Action'] : $this->getIndexablePostIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Term_Indexation_Action'] : $this->getIndexableTermIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_General_Indexation_Action'] : $this->getIndexableGeneralIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Indexing\\Indexable_Post_Type_Archive_Indexation_Action'] : $this->getIndexablePostTypeArchiveIndexationActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Language_Helper'] : $this->getLanguageHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Admin\Prominent_Words\Metabox_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Admin\Prominent_Words\Metabox_Integration
     */
    protected function getMetaboxIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration'] = new \Yoast\WP\SEO\Integrations\Admin\Prominent_Words\Metabox_Integration(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveActionService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block
     */
    protected function getEstimatedReadingTimeBlockService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block'] = new \Yoast\WP\SEO\Integrations\Blocks\Estimated_Reading_Time_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Job_Posting_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Job_Posting_Block
     */
    protected function getJobPostingBlockService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block'] = new \Yoast\WP\SEO\Integrations\Blocks\Job_Posting_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block
     */
    protected function getRelatedLinksBlockService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block'] = new \Yoast\WP\SEO\Integrations\Blocks\Related_Links_Block();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks
     */
    protected function getSchemaBlocksService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks'] = new \Yoast\WP\SEO\Integrations\Blocks\Schema_Blocks(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium
     */
    protected function getElementorPremiumService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium'] = new \Yoast\WP\SEO\Integrations\Third_Party\Elementor_Premium(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Prominent_Words_Helper'] : $this->getProminentWordsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Zapier' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Zapier
     */
    protected function getZapierService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier'] = new \Yoast\WP\SEO\Integrations\Third_Party\Zapier(${($_ = isset($this->services['WPSEO_Admin_Asset_Manager']) ? $this->services['WPSEO_Admin_Asset_Manager'] : $this->getWPSEOAdminAssetManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] : $this->getZapierHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor
     */
    protected function getZapierClassicEditorService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor'] = new \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Classic_Editor(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] : $this->getZapierHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger
     */
    protected function getZapierTriggerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger'] = new \Yoast\WP\SEO\Integrations\Third_Party\Zapier_Trigger(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Meta_Helper'] : $this->getMetaHelperService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Zapier_Helper'] : $this->getZapierHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher
     */
    protected function getPremiumOptionWpseoWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher'] = new \Yoast\WP\SEO\Integrations\Watchers\Premium_Option_Wpseo_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Integrations\Watchers\Zapier_APIKey_Reset_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Integrations\Watchers\Zapier_APIKey_Reset_Watcher
     */
    protected function getZapierAPIKeyResetWatcherService()
    {
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
        $instance->register_initializer('Yoast\\WP\\SEO\\Database\\Migration_Runner_Premium');
        $instance->register_initializer('Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin');
        $instance->register_initializer('Yoast\\WP\\SEO\\Initializers\\Redirect_Handler');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Admin\\Plugin_Links_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Indexing_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Admin\\Prominent_Words\\Metabox_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Estimated_Reading_Time_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Job_Posting_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Related_Links_Block');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Blocks\\Schema_Blocks');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Elementor_Premium');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Classic_Editor');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier_Trigger');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Third_Party\\Zapier');
        $instance->register_integration('Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Premium_Option_Wpseo_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Integrations\\Watchers\\Zapier_APIKey_Reset_Watcher');
        $instance->register_route('Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route');
        $instance->register_route('Yoast\\WP\\SEO\\Routes\\Zapier_Route');

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
     * Gets the public 'Yoast\WP\SEO\Premium\Initializers\Plugin' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Initializers\Plugin
     */
    protected function getPluginService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Initializers\\Plugin'] = new \Yoast\WP\SEO\Premium\Initializers\Plugin(${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Options_Helper'] : $this->getOptionsHelperService()) && false ?: '_'});
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
     * Gets the public 'Yoast\WP\SEO\Premium\Integrations\Upgrade_Integration' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Premium\Integrations\Upgrade_Integration
     */
    protected function getUpgradeIntegrationService()
    {
        return $this->services['Yoast\\WP\\SEO\\Premium\\Integrations\\Upgrade_Integration'] = new \Yoast\WP\SEO\Premium\Integrations\Upgrade_Integration();
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
     */
    protected function getProminentWordsRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\Prominent_Words_Repository'] = new \Yoast\WP\SEO\Repositories\Prominent_Words_Repository();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Link_Suggestions_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Link_Suggestions_Route
     */
    protected function getLinkSuggestionsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Routes\\Link_Suggestions_Route'] = new \Yoast\WP\SEO\Routes\Link_Suggestions_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Link_Suggestions_Action'] : $this->getLinkSuggestionsActionService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Prominent_Words_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Prominent_Words_Route
     */
    protected function getProminentWordsRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Routes\\Prominent_Words_Route'] = new \Yoast\WP\SEO\Routes\Prominent_Words_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Content_Action'] : $this->getContentActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Save_Action'] : $this->getSaveActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Prominent_Words\\Complete_Action'] : $this->getCompleteActionService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper']) ? $this->services['Yoast\\WP\\SEO\\Helpers\\Indexing_Helper'] : $this->getIndexingHelperService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Routes\Zapier_Route' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Routes\Zapier_Route
     */
    protected function getZapierRouteService()
    {
        return $this->services['Yoast\\WP\\SEO\\Routes\\Zapier_Route'] = new \Yoast\WP\SEO\Routes\Zapier_Route(${($_ = isset($this->services['Yoast\\WP\\SEO\\Actions\\Zapier_Action']) ? $this->services['Yoast\\WP\\SEO\\Actions\\Zapier_Action'] : $this->getZapierActionService()) && false ?: '_'});
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
