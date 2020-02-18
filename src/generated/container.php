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
            'yoast\\wp\\seo\\builders\\indexable_author_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder',
            'yoast\\wp\\seo\\builders\\indexable_post_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder',
            'yoast\\wp\\seo\\builders\\indexable_term_builder' => 'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder',
            'yoast\\wp\\seo\\conditionals\\admin_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional',
            'yoast\\wp\\seo\\conditionals\\indexables_feature_flag_conditional' => 'Yoast\\WP\\SEO\\Conditionals\\Indexables_Feature_Flag_Conditional',
            'yoast\\wp\\seo\\database\\database_setup' => 'Yoast\\WP\\SEO\\Database\\Database_Setup',
            'yoast\\wp\\seo\\database\\migration_runner' => 'Yoast\\WP\\SEO\\Database\\Migration_Runner',
            'yoast\\wp\\seo\\loader' => 'Yoast\\WP\\SEO\\Loader',
            'yoast\\wp\\seo\\loggers\\logger' => 'Yoast\\WP\\SEO\\Loggers\\Logger',
            'yoast\\wp\\seo\\repositories\\indexable_repository' => 'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository',
            'yoast\\wp\\seo\\repositories\\primary_term_repository' => 'Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository',
            'yoast\\wp\\seo\\repositories\\seo_links_repository' => 'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository',
            'yoast\\wp\\seo\\repositories\\seo_meta_repository' => 'Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository',
            'yoast\\wp\\seo\\watchers\\indexable_author_watcher' => 'Yoast\\WP\\SEO\\Watchers\\Indexable_Author_Watcher',
            'yoast\\wp\\seo\\watchers\\indexable_post_watcher' => 'Yoast\\WP\\SEO\\Watchers\\Indexable_Post_Watcher',
            'yoast\\wp\\seo\\watchers\\indexable_term_watcher' => 'Yoast\\WP\\SEO\\Watchers\\Indexable_Term_Watcher',
            'yoast\\wp\\seo\\watchers\\primary_term_watcher' => 'Yoast\\WP\\SEO\\Watchers\\Primary_Term_Watcher',
        ];
        $this->methodMap = [
            'Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder' => 'getIndexableAuthorBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder' => 'getIndexablePostBuilderService',
            'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder' => 'getIndexableTermBuilderService',
            'Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional' => 'getAdminConditionalService',
            'Yoast\\WP\\SEO\\Conditionals\\Indexables_Feature_Flag_Conditional' => 'getIndexablesFeatureFlagConditionalService',
            'Yoast\\WP\\SEO\\Database\\Database_Setup' => 'getDatabaseSetupService',
            'Yoast\\WP\\SEO\\Database\\Migration_Runner' => 'getMigrationRunnerService',
            'Yoast\\WP\\SEO\\Loader' => 'getLoaderService',
            'Yoast\\WP\\SEO\\Loggers\\Logger' => 'getLoggerService',
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => 'getIndexableRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository' => 'getPrimaryTermRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository' => 'getSEOLinksRepositoryService',
            'Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository' => 'getSEOMetaRepositoryService',
            'Yoast\\WP\\SEO\\Watchers\\Indexable_Author_Watcher' => 'getIndexableAuthorWatcherService',
            'Yoast\\WP\\SEO\\Watchers\\Indexable_Post_Watcher' => 'getIndexablePostWatcherService',
            'Yoast\\WP\\SEO\\Watchers\\Indexable_Term_Watcher' => 'getIndexableTermWatcherService',
            'Yoast\\WP\\SEO\\Watchers\\Primary_Term_Watcher' => 'getPrimaryTermWatcherService',
            'wp_query' => 'getWpQueryService',
            'wpdb' => 'getWpdbService',
        ];
        $this->privates = [
            'Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder' => true,
            'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder' => true,
            'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder' => true,
            'Yoast\\WP\\SEO\\Loggers\\Logger' => true,
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => true,
            'Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository' => true,
            'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository' => true,
            'Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository' => true,
            'wp_query' => true,
            'wpdb' => true,
        ];

        $this->aliases = [];
    }

    public function getRemovedIds()
    {
        return [
            'Psr\\Container\\ContainerInterface' => true,
            'YoastSEO_Vendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder' => true,
            'Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder' => true,
            'Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder' => true,
            'Yoast\\WP\\SEO\\Config\\Dependency_Management' => true,
            'Yoast\\WP\\SEO\\Database\\Ruckusing_Framework' => true,
            'Yoast\\WP\\SEO\\Exceptions\\Missing_Method' => true,
            'Yoast\\WP\\SEO\\Helpers\\Author_Archive_Helper' => true,
            'Yoast\\WP\\SEO\\Helpers\\Home_Url_Helper' => true,
            'Yoast\\WP\\SEO\\Loggers\\Logger' => true,
            'Yoast\\WP\\SEO\\Loggers\\Migration_Logger' => true,
            'Yoast\\WP\\SEO\\Oauth\\Client' => true,
            'Yoast\\WP\\SEO\\Repositories\\Indexable_Repository' => true,
            'Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository' => true,
            'Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository' => true,
            'Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository' => true,
            'wp_query' => true,
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
     * Gets the public 'Yoast\WP\SEO\Conditionals\Admin_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Admin_Conditional
     */
    protected function getAdminConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Admin_Conditional'] = new \Yoast\WP\SEO\Conditionals\Admin_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Conditionals\Indexables_Feature_Flag_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Conditionals\Indexables_Feature_Flag_Conditional
     */
    protected function getIndexablesFeatureFlagConditionalService()
    {
        return $this->services['Yoast\\WP\\SEO\\Conditionals\\Indexables_Feature_Flag_Conditional'] = new \Yoast\WP\SEO\Conditionals\Indexables_Feature_Flag_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Database\Database_Setup' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Database\Database_Setup
     */
    protected function getDatabaseSetupService()
    {
        return $this->services['Yoast\\WP\\SEO\\Database\\Database_Setup'] = new \Yoast\WP\SEO\Database\Database_Setup(${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Database\Migration_Runner' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Database\Migration_Runner
     */
    protected function getMigrationRunnerService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'};

        return $this->services['Yoast\\WP\\SEO\\Database\\Migration_Runner'] = new \Yoast\WP\SEO\Database\Migration_Runner(new \Yoast\WP\SEO\Database\Ruckusing_Framework(${($_ = isset($this->services['wpdb']) ? $this->services['wpdb'] : $this->getWpdbService()) && false ?: '_'}, new \Yoast\WP\SEO\Config\Dependency_Management(), new \Yoast\WP\SEO\Loggers\Migration_Logger($a)), $a);
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Loader' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Loader
     */
    protected function getLoaderService()
    {
        $this->services['Yoast\\WP\\SEO\\Loader'] = $instance = new \Yoast\WP\SEO\Loader($this);

        $instance->register_initializer('Yoast\\WP\\SEO\\Database\\Database_Setup');
        $instance->register_initializer('Yoast\\WP\\SEO\\Database\\Migration_Runner');
        $instance->register_integration('Yoast\\WP\\SEO\\Watchers\\Indexable_Author_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Watchers\\Indexable_Post_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Watchers\\Indexable_Term_Watcher');
        $instance->register_integration('Yoast\\WP\\SEO\\Watchers\\Primary_Term_Watcher');

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Watchers\Indexable_Author_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Watchers\Indexable_Author_Watcher
     */
    protected function getIndexableAuthorWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Watchers\\Indexable_Author_Watcher'] = new \Yoast\WP\SEO\Watchers\Indexable_Author_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] : ($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Author_Builder())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Watchers\Indexable_Post_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Watchers\Indexable_Post_Watcher
     */
    protected function getIndexablePostWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Watchers\\Indexable_Post_Watcher'] = new \Yoast\WP\SEO\Watchers\Indexable_Post_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder'] : $this->getIndexablePostBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Watchers\Indexable_Term_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Watchers\Indexable_Term_Watcher
     */
    protected function getIndexableTermWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Watchers\\Indexable_Term_Watcher'] = new \Yoast\WP\SEO\Watchers\Indexable_Term_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] : ($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Term_Builder())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\SEO\Watchers\Primary_Term_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Watchers\Primary_Term_Watcher
     */
    protected function getPrimaryTermWatcherService()
    {
        return $this->services['Yoast\\WP\\SEO\\Watchers\\Primary_Term_Watcher'] = new \Yoast\WP\SEO\Watchers\Primary_Term_Watcher(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] : $this->getPrimaryTermRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Builders\Indexable_Author_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Author_Builder
     */
    protected function getIndexableAuthorBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Author_Builder();
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Builders\Indexable_Post_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Post_Builder
     */
    protected function getIndexablePostBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Post_Builder(${($_ = isset($this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository']) ? $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository'] : $this->getSEOMetaRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Builders\Indexable_Term_Builder' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Builders\Indexable_Term_Builder
     */
    protected function getIndexableTermBuilderService()
    {
        return $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Term_Builder();
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Loggers\Logger' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Loggers\Logger
     */
    protected function getLoggerService()
    {
        return $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger();
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Repositories\Indexable_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\Indexable_Repository
     */
    protected function getIndexableRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\Indexable_Repository'] = \Yoast\WP\SEO\Repositories\Indexable_Repository::get_instance(${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] : ($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Author_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Author_Builder())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Post_Builder'] : $this->getIndexablePostBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] : ($this->services['Yoast\\WP\\SEO\\Builders\\Indexable_Term_Builder'] = new \Yoast\WP\SEO\Builders\Indexable_Term_Builder())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\SEO\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\SEO\\Loggers\\Logger'] = new \Yoast\WP\SEO\Loggers\Logger())) && false ?: '_'});
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Repositories\Primary_Term_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\Primary_Term_Repository
     */
    protected function getPrimaryTermRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\Primary_Term_Repository'] = \Yoast\WP\SEO\Repositories\Primary_Term_Repository::get_instance();
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Repositories\SEO_Links_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\SEO_Links_Repository
     */
    protected function getSEOLinksRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Links_Repository'] = \Yoast\WP\SEO\Repositories\SEO_Links_Repository::get_instance();
    }

    /**
     * Gets the private 'Yoast\WP\SEO\Repositories\SEO_Meta_Repository' shared autowired service.
     *
     * @return \Yoast\WP\SEO\Repositories\SEO_Meta_Repository
     */
    protected function getSEOMetaRepositoryService()
    {
        return $this->services['Yoast\\WP\\SEO\\Repositories\\SEO_Meta_Repository'] = \Yoast\WP\SEO\Repositories\SEO_Meta_Repository::get_instance();
    }

    /**
     * Gets the private 'wp_query' shared service.
     *
     * @return \WP_Query
     */
    protected function getWpQueryService()
    {
        return $this->services['wp_query'] = \Yoast\WP\SEO\WordPress\Wrapper::get_wp_query();
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
