<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Admin_Asset_Manager;
use WPSEO_Taxonomy_Meta;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Score_Icon_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Inclusive_Language_Enabled_Conditional;
use Yoast\WP\SEO\Premium\Conditionals\Term_Overview_Or_Ajax_Conditional;
use Yoast\WP\SEO\Premium\Helpers\Current_Page_Helper;

/**
 * Inclusive_Language_Column_Integration class.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Inclusive_Language_Taxonomy_Column_Integration implements Integration_Interface {

	/**
	 * Name of the column.
	 *
	 * @var string
	 */
	public const INCLUSIVE_LANGUAGE_COLUMN_NAME = 'wpseo-inclusive-language';

	/**
	 * The score icon helper.
	 *
	 * @var Score_Icon_Helper
	 */
	protected $score_icon_helper;

	/**
	 * Holds the Current_Page_Helper instance.
	 *
	 * @var Current_Page_Helper
	 */
	private $current_page_helper;

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [
			Admin_Conditional::class,
			Term_Overview_Or_Ajax_Conditional::class,
			Inclusive_Language_Enabled_Conditional::class,
		];
	}

	/**
	 * Inclusive_Language_Column_Integration constructor
	 *
	 * @param Score_Icon_Helper   $score_icon_helper   The score icon helper.
	 * @param Current_Page_Helper $current_page_helper The Current_Page_Helper.
	 */
	public function __construct(
		Score_Icon_Helper $score_icon_helper,
		Current_Page_Helper $current_page_helper
	) {
		$this->score_icon_helper   = $score_icon_helper;
		$this->current_page_helper = $current_page_helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_action( 'admin_init', [ $this, 'register_init_hooks' ] );
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Register hooks that need to be registered after `init` due to all post types not yet being registered.
	 *
	 * @return void
	 */
	public function register_init_hooks() {
		$taxonomy       = $this->current_page_helper->get_current_taxonomy();
		$is_product     = $this->current_page_helper->get_current_post_type() === 'product';
		$is_product_cat = $taxonomy === 'product_cat';
		$is_product_tag = $taxonomy === 'product_tag';

		if ( ( $is_product && ( $is_product_cat || $is_product_tag ) ) || ( ! $is_product && $taxonomy ) ) {
			\add_filter( 'manage_edit-' . $taxonomy . '_columns', [ $this, 'add_inclusive_language_column' ] );
			\add_filter( 'manage_' . $taxonomy . '_custom_column', [ $this, 'column_content' ], 10, 3 );
		}
	}

	/**
	 * Enqueues the assets needed for the integration to work.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		\wp_enqueue_style( WPSEO_Admin_Asset_Manager::PREFIX . 'premium-post-overview' );
	}

	/**
	 * Adds the inclusive language column for the term overview.
	 *
	 * @param array $columns Array with columns.
	 *
	 * @return array The extended array with columns.
	 */
	public function add_inclusive_language_column( $columns ) {
		if ( ! \is_array( $columns ) ) {
			return $columns;
		}

		$columns[ self::INCLUSIVE_LANGUAGE_COLUMN_NAME ] = \sprintf(
			'<span class="yoast-tooltip yoast-tooltip-n yoast-tooltip-alt" data-label="%1$s">
				<span class="yoast-column-inclusive-language yoast-column-header-has-tooltip">
					<span class="screen-reader-text">%2$s</span>
				</span>
			</span>',
			\esc_attr__( 'Inclusive language score', 'wordpress-seo-premium' ),
			\esc_html__( 'Inclusive language score', 'wordpress-seo-premium' )
		);

		return $columns;
	}

	/**
	 * Displays the column content for the given column.
	 *
	 * @param string $content     The current content of the column.
	 * @param string $column_name The name of the column.
	 * @param int    $term_id     ID of requested taxonomy.
	 *
	 * @return string
	 */
	public function column_content( $content, $column_name, $term_id ) {
		$score = (int) WPSEO_Taxonomy_Meta::get_term_meta( $term_id, $this->current_page_helper->get_current_taxonomy(), 'inclusive_language_score' );

		if ( $column_name === self::INCLUSIVE_LANGUAGE_COLUMN_NAME ) {
			return $this->score_icon_helper->for_inclusive_language( $score );
		}

		return $content;
	}
}
