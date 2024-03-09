<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use WP_Admin_Bar;
use WPSEO_Metabox_Analysis_Readability;
use WPSEO_Metabox_Analysis_SEO;
use WPSEO_Options;
use Yoast\WP\SEO\Conditionals\Front_End_Conditional;
use Yoast\WP\SEO\Helpers\Robots_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Frontend_Inspector class
 */
class Frontend_Inspector implements Integration_Interface {

	/**
	 * The identifier used for the frontend inspector submenu.
	 *
	 * @var string
	 */
	public const FRONTEND_INSPECTOR_SUBMENU_IDENTIFIER = 'wpseo-frontend-inspector';

	/**
	 * Holds the Robots_Helper.
	 *
	 * @var Robots_Helper
	 */
	protected $robots_helper;

	/**
	 * Constructs a Frontend_Inspector.
	 *
	 * @param Robots_Helper $robots_helper The Robots_Helper.
	 */
	public function __construct( Robots_Helper $robots_helper ) {
		$this->robots_helper = $robots_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [ Front_End_Conditional::class ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ], 11 );
		\add_action( 'wpseo_add_adminbar_submenu', [ $this, 'add_frontend_inspector_submenu' ], 10, 2 );
	}

	/**
	 * Adds the frontend inspector submenu.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar    The admin bar.
	 * @param string       $menu_identifier The menu identifier.
	 *
	 * @return void
	 */
	public function add_frontend_inspector_submenu( WP_Admin_Bar $wp_admin_bar, $menu_identifier ) {
		if ( ! \is_admin() ) {
			$menu_args = [
				'parent' => $menu_identifier,
				'id'     => self::FRONTEND_INSPECTOR_SUBMENU_IDENTIFIER,
				'title'  => \sprintf(
					'%1$s <span class="yoast-badge yoast-beta-badge">%2$s</span>',
					\__( 'Front-end SEO inspector', 'wordpress-seo-premium' ),
					\__( 'Beta', 'wordpress-seo-premium' )
				),
				'href'   => '#wpseo-frontend-inspector',
				'meta'   => [
					'tabindex' => '0',
				],
			];
			$wp_admin_bar->add_menu( $menu_args );
		}
	}

	/**
	 * Enqueue the workouts app.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		if ( ! \is_admin_bar_showing() || ! WPSEO_Options::get( 'enable_admin_bar_menu' ) ) {
			return;
		}

		// If the current user can't write posts, this is all of no use, so let's not output an admin menu.
		if ( ! \current_user_can( 'edit_posts' ) ) {
			return;
		}

		$analysis_seo         = new WPSEO_Metabox_Analysis_SEO();
		$analysis_readability = new WPSEO_Metabox_Analysis_Readability();
		$current_page_meta    = \YoastSEO()->meta->for_current_page();
		$indexable            = $current_page_meta->indexable;
		$page_type            = $current_page_meta->page_type;

		$is_seo_analysis_active         = $analysis_seo->is_enabled();
		$is_readability_analysis_active = $analysis_readability->is_enabled();
		$display_metabox                = true;

		switch ( $page_type ) {
			case 'Home_Page':
			case 'Post_Type_Archive':
			case 'Date_Archive':
			case 'Error_Page':
			case 'Fallback':
			case 'Search_Result_Page':
				break;
			case 'Static_Home_Page':
			case 'Static_Posts_Page':
			case 'Post_Type':
				$display_metabox = WPSEO_Options::get( 'display-metabox-pt-' . $indexable->object_sub_type );
				break;
			case 'Term_Archive':
				$display_metabox = WPSEO_Options::get( 'display-metabox-tax-' . $indexable->object_sub_type );
				break;
			case 'Author_Archive':
				$display_metabox = false;
				break;
		}

		if ( ! $display_metabox ) {
			$is_seo_analysis_active         = false;
			$is_readability_analysis_active = false;
		}

		\wp_enqueue_script( 'yoast-seo-premium-frontend-inspector' );
		\wp_localize_script(
			'yoast-seo-premium-frontend-inspector',
			'wpseoScriptData',
			[
				'frontendInspector' => [
					'isIndexable'           => $this->robots_helper->is_indexable( $indexable ),
					'indexable'             => [
						'is_robots_noindex'           => $indexable->is_robots_noindex,
						'primary_focus_keyword'       => $indexable->primary_focus_keyword,
						'primary_focus_keyword_score' => $indexable->primary_focus_keyword_score,
						'readability_score'           => $indexable->readability_score,
					],
					'contentAnalysisActive' => $is_readability_analysis_active,
					'keywordAnalysisActive' => $is_seo_analysis_active,
				],
			]
		);
	}
}
