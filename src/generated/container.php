<?php

namespace Yoast\WP\Free\Generated;

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
    private $parameters;
    private $targetDirs = [];

    public function __construct()
    {
        $this->services = [];
        $this->normalizedIds = [
            'yoast\\wp\\free\\builders\\indexable_author_builder' => 'Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder',
            'yoast\\wp\\free\\builders\\indexable_post_builder' => 'Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder',
            'yoast\\wp\\free\\builders\\indexable_term_builder' => 'Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder',
            'yoast\\wp\\free\\conditionals\\admin_conditional' => 'Yoast\\WP\\Free\\Conditionals\\Admin_Conditional',
            'yoast\\wp\\free\\conditionals\\indexables_feature_flag_conditional' => 'Yoast\\WP\\Free\\Conditionals\\Indexables_Feature_Flag_Conditional',
            'yoast\\wp\\free\\database\\database_setup' => 'Yoast\\WP\\Free\\Database\\Database_Setup',
            'yoast\\wp\\free\\database\\migration_runner' => 'Yoast\\WP\\Free\\Database\\Migration_Runner',
            'yoast\\wp\\free\\loader' => 'Yoast\\WP\\Free\\Loader',
            'yoast\\wp\\free\\loggers\\logger' => 'Yoast\\WP\\Free\\Loggers\\Logger',
            'yoast\\wp\\free\\repositories\\indexable_repository' => 'Yoast\\WP\\Free\\Repositories\\Indexable_Repository',
            'yoast\\wp\\free\\repositories\\primary_term_repository' => 'Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository',
            'yoast\\wp\\free\\repositories\\seo_links_repository' => 'Yoast\\WP\\Free\\Repositories\\SEO_Links_Repository',
            'yoast\\wp\\free\\repositories\\seo_meta_repository' => 'Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository',
            'yoast\\wp\\free\\watchers\\indexable_author_watcher' => 'Yoast\\WP\\Free\\Watchers\\Indexable_Author_Watcher',
            'yoast\\wp\\free\\watchers\\indexable_post_watcher' => 'Yoast\\WP\\Free\\Watchers\\Indexable_Post_Watcher',
            'yoast\\wp\\free\\watchers\\indexable_term_watcher' => 'Yoast\\WP\\Free\\Watchers\\Indexable_Term_Watcher',
            'yoast\\wp\\free\\watchers\\primary_term_watcher' => 'Yoast\\WP\\Free\\Watchers\\Primary_Term_Watcher',
        ];
        $this->methodMap = [
            'Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder' => 'getIndexableAuthorBuilderService',
            'Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder' => 'getIndexablePostBuilderService',
            'Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder' => 'getIndexableTermBuilderService',
            'Yoast\\WP\\Free\\Conditionals\\Admin_Conditional' => 'getAdminConditionalService',
            'Yoast\\WP\\Free\\Conditionals\\Indexables_Feature_Flag_Conditional' => 'getIndexablesFeatureFlagConditionalService',
            'Yoast\\WP\\Free\\Database\\Database_Setup' => 'getDatabaseSetupService',
            'Yoast\\WP\\Free\\Database\\Migration_Runner' => 'getMigrationRunnerService',
            'Yoast\\WP\\Free\\Loader' => 'getLoaderService',
            'Yoast\\WP\\Free\\Loggers\\Logger' => 'getLoggerService',
            'Yoast\\WP\\Free\\Repositories\\Indexable_Repository' => 'getIndexableRepositoryService',
            'Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository' => 'getPrimaryTermRepositoryService',
            'Yoast\\WP\\Free\\Repositories\\SEO_Links_Repository' => 'getSEOLinksRepositoryService',
            'Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository' => 'getSEOMetaRepositoryService',
            'Yoast\\WP\\Free\\Watchers\\Indexable_Author_Watcher' => 'getIndexableAuthorWatcherService',
            'Yoast\\WP\\Free\\Watchers\\Indexable_Post_Watcher' => 'getIndexablePostWatcherService',
            'Yoast\\WP\\Free\\Watchers\\Indexable_Term_Watcher' => 'getIndexableTermWatcherService',
            'Yoast\\WP\\Free\\Watchers\\Primary_Term_Watcher' => 'getPrimaryTermWatcherService',
            'wp_query' => 'getWpQueryService',
            'wpdb' => 'getWpdbService',
        ];
        $this->privates = [
            'Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder' => true,
            'Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder' => true,
            'Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder' => true,
            'Yoast\\WP\\Free\\Loggers\\Logger' => true,
            'Yoast\\WP\\Free\\Repositories\\Indexable_Repository' => true,
            'Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository' => true,
            'Yoast\\WP\\Free\\Repositories\\SEO_Links_Repository' => true,
            'Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository' => true,
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
            'Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder' => true,
            'Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder' => true,
            'Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder' => true,
            'Yoast\\WP\\Free\\Config\\Dependency_Management' => true,
            'Yoast\\WP\\Free\\Database\\Ruckusing_Framework' => true,
            'Yoast\\WP\\Free\\Exceptions\\Missing_Method' => true,
            'Yoast\\WP\\Free\\Loggers\\Logger' => true,
            'Yoast\\WP\\Free\\Loggers\\Migration_Logger' => true,
            'Yoast\\WP\\Free\\Oauth\\Client' => true,
            'Yoast\\WP\\Free\\Repositories\\Indexable_Repository' => true,
            'Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository' => true,
            'Yoast\\WP\\Free\\Repositories\\SEO_Links_Repository' => true,
            'Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository' => true,
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
     * Gets the public 'Yoast\WP\Free\Conditionals\Admin_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\Free\Conditionals\Admin_Conditional
     */
    protected function getAdminConditionalService()
    {
        return $this->services['Yoast\\WP\\Free\\Conditionals\\Admin_Conditional'] = new \Yoast\WP\Free\Conditionals\Admin_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\Free\Conditionals\Indexables_Feature_Flag_Conditional' shared autowired service.
     *
     * @return \Yoast\WP\Free\Conditionals\Indexables_Feature_Flag_Conditional
     */
    protected function getIndexablesFeatureFlagConditionalService()
    {
        return $this->services['Yoast\\WP\\Free\\Conditionals\\Indexables_Feature_Flag_Conditional'] = new \Yoast\WP\Free\Conditionals\Indexables_Feature_Flag_Conditional();
    }

    /**
     * Gets the public 'Yoast\WP\Free\Database\Database_Setup' shared autowired service.
     *
     * @return \Yoast\WP\Free\Database\Database_Setup
     */
    protected function getDatabaseSetupService()
    {
        return $this->services['Yoast\\WP\\Free\\Database\\Database_Setup'] = new \Yoast\WP\Free\Database\Database_Setup(${($_ = isset($this->services['Yoast\\WP\\Free\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\Free\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\Free\\Loggers\\Logger'] = new \Yoast\WP\Free\Loggers\Logger())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\Free\Database\Migration_Runner' shared autowired service.
     *
     * @return \Yoast\WP\Free\Database\Migration_Runner
     */
    protected function getMigrationRunnerService()
    {
        $a = ${($_ = isset($this->services['Yoast\\WP\\Free\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\Free\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\Free\\Loggers\\Logger'] = new \Yoast\WP\Free\Loggers\Logger())) && false ?: '_'};

        return $this->services['Yoast\\WP\\Free\\Database\\Migration_Runner'] = new \Yoast\WP\Free\Database\Migration_Runner(new \Yoast\WP\Free\Database\Ruckusing_Framework(${($_ = isset($this->services['wpdb']) ? $this->services['wpdb'] : $this->getWpdbService()) && false ?: '_'}, new \Yoast\WP\Free\Config\Dependency_Management(), new \Yoast\WP\Free\Loggers\Migration_Logger($a)), $a);
    }

    /**
     * Gets the public 'Yoast\WP\Free\Loader' shared autowired service.
     *
     * @return \Yoast\WP\Free\Loader
     */
    protected function getLoaderService()
    {
        $this->services['Yoast\\WP\\Free\\Loader'] = $instance = new \Yoast\WP\Free\Loader($this);

        $instance->register_initializer('Yoast\\WP\\Free\\Database\\Database_Setup');
        $instance->register_initializer('Yoast\\WP\\Free\\Database\\Migration_Runner');
        $instance->register_integration('Yoast\\WP\\Free\\Watchers\\Indexable_Author_Watcher');
        $instance->register_integration('Yoast\\WP\\Free\\Watchers\\Indexable_Post_Watcher');
        $instance->register_integration('Yoast\\WP\\Free\\Watchers\\Indexable_Term_Watcher');
        $instance->register_integration('Yoast\\WP\\Free\\Watchers\\Primary_Term_Watcher');

        return $instance;
    }

    /**
     * Gets the public 'Yoast\WP\Free\Watchers\Indexable_Author_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\Free\Watchers\Indexable_Author_Watcher
     */
    protected function getIndexableAuthorWatcherService()
    {
        return $this->services['Yoast\\WP\\Free\\Watchers\\Indexable_Author_Watcher'] = new \Yoast\WP\Free\Watchers\Indexable_Author_Watcher(${($_ = isset($this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder']) ? $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder'] : ($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Author_Builder())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\Free\Watchers\Indexable_Post_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\Free\Watchers\Indexable_Post_Watcher
     */
    protected function getIndexablePostWatcherService()
    {
        return $this->services['Yoast\\WP\\Free\\Watchers\\Indexable_Post_Watcher'] = new \Yoast\WP\Free\Watchers\Indexable_Post_Watcher(${($_ = isset($this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder']) ? $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder'] : $this->getIndexablePostBuilderService()) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\Free\Watchers\Indexable_Term_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\Free\Watchers\Indexable_Term_Watcher
     */
    protected function getIndexableTermWatcherService()
    {
        return $this->services['Yoast\\WP\\Free\\Watchers\\Indexable_Term_Watcher'] = new \Yoast\WP\Free\Watchers\Indexable_Term_Watcher(${($_ = isset($this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository']) ? $this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository'] : $this->getIndexableRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder'] : ($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Term_Builder())) && false ?: '_'});
    }

    /**
     * Gets the public 'Yoast\WP\Free\Watchers\Primary_Term_Watcher' shared autowired service.
     *
     * @return \Yoast\WP\Free\Watchers\Primary_Term_Watcher
     */
    protected function getPrimaryTermWatcherService()
    {
        return $this->services['Yoast\\WP\\Free\\Watchers\\Primary_Term_Watcher'] = new \Yoast\WP\Free\Watchers\Primary_Term_Watcher(${($_ = isset($this->services['Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository']) ? $this->services['Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository'] : $this->getPrimaryTermRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the private 'Yoast\WP\Free\Builders\Indexable_Author_Builder' shared autowired service.
     *
     * @return \Yoast\WP\Free\Builders\Indexable_Author_Builder
     */
    protected function getIndexableAuthorBuilderService()
    {
        return $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Author_Builder();
    }

    /**
     * Gets the private 'Yoast\WP\Free\Builders\Indexable_Post_Builder' shared autowired service.
     *
     * @return \Yoast\WP\Free\Builders\Indexable_Post_Builder
     */
    protected function getIndexablePostBuilderService()
    {
        return $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Post_Builder(${($_ = isset($this->services['Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository']) ? $this->services['Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository'] : $this->getSEOMetaRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the private 'Yoast\WP\Free\Builders\Indexable_Term_Builder' shared autowired service.
     *
     * @return \Yoast\WP\Free\Builders\Indexable_Term_Builder
     */
    protected function getIndexableTermBuilderService()
    {
        return $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Term_Builder();
    }

    /**
     * Gets the private 'Yoast\WP\Free\Loggers\Logger' shared autowired service.
     *
     * @return \Yoast\WP\Free\Loggers\Logger
     */
    protected function getLoggerService()
    {
        return $this->services['Yoast\\WP\\Free\\Loggers\\Logger'] = new \Yoast\WP\Free\Loggers\Logger();
    }

    /**
     * Gets the private 'Yoast\WP\Free\Repositories\Indexable_Repository' shared autowired service.
     *
     * @return \Yoast\WP\Free\Repositories\Indexable_Repository
     */
    protected function getIndexableRepositoryService()
    {
        return $this->services['Yoast\\WP\\Free\\Repositories\\Indexable_Repository'] = \Yoast\WP\Free\Repositories\Indexable_Repository::get_instance(${($_ = isset($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder']) ? $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder'] : ($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Author_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Author_Builder())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder']) ? $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Post_Builder'] : $this->getIndexablePostBuilderService()) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder']) ? $this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder'] : ($this->services['Yoast\\WP\\Free\\Builders\\Indexable_Term_Builder'] = new \Yoast\WP\Free\Builders\Indexable_Term_Builder())) && false ?: '_'}, ${($_ = isset($this->services['Yoast\\WP\\Free\\Loggers\\Logger']) ? $this->services['Yoast\\WP\\Free\\Loggers\\Logger'] : ($this->services['Yoast\\WP\\Free\\Loggers\\Logger'] = new \Yoast\WP\Free\Loggers\Logger())) && false ?: '_'});
    }

    /**
     * Gets the private 'Yoast\WP\Free\Repositories\Primary_Term_Repository' shared autowired service.
     *
     * @return \Yoast\WP\Free\Repositories\Primary_Term_Repository
     */
    protected function getPrimaryTermRepositoryService()
    {
        return $this->services['Yoast\\WP\\Free\\Repositories\\Primary_Term_Repository'] = \Yoast\WP\Free\Repositories\Primary_Term_Repository::get_instance();
    }

    /**
     * Gets the private 'Yoast\WP\Free\Repositories\SEO_Links_Repository' shared autowired service.
     *
     * @return \Yoast\WP\Free\Repositories\SEO_Links_Repository
     */
    protected function getSEOLinksRepositoryService()
    {
        return $this->services['Yoast\\WP\\Free\\Repositories\\SEO_Links_Repository'] = \Yoast\WP\Free\Repositories\SEO_Links_Repository::get_instance();
    }

    /**
     * Gets the private 'Yoast\WP\Free\Repositories\SEO_Meta_Repository' shared autowired service.
     *
     * @return \Yoast\WP\Free\Repositories\SEO_Meta_Repository
     */
    protected function getSEOMetaRepositoryService()
    {
        return $this->services['Yoast\\WP\\Free\\Repositories\\SEO_Meta_Repository'] = \Yoast\WP\Free\Repositories\SEO_Meta_Repository::get_instance();
    }

    /**
     * Gets the private 'wp_query' shared service.
     *
     * @return \WP_Query
     */
    protected function getWpQueryService()
    {
        return $this->services['wp_query'] = \Yoast\WP\Free\WordPress\Wrapper::get_wp_query();
    }

    /**
     * Gets the private 'wpdb' shared service.
     *
     * @return \wpdb
     */
    protected function getWpdbService()
    {
        return $this->services['wpdb'] = \Yoast\WP\Free\WordPress\Wrapper::get_wpdb();
    }
}
