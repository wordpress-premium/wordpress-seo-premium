<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WP_Query;
use wpdb;
use WPSEO_Admin_Asset_Manager;
use Yoast\WP\Lib\Model;
use Yoast\WP\SEO\Conditionals\Admin\Posts_Overview_Or_Ajax_Conditional;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Helpers\Score_Icon_Helper;
use Yoast\WP\SEO\Integrations\Admin\Admin_Columns_Cache_Integration;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Inclusive_Language_Enabled_Conditional;

/**
 * Inclusive_Language_Column_Integration class.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Inclusive_Language_Column_Integration implements Integration_Interface {

	/**
	 * Name of the column.
	 *
	 * @var string
	 */
	public const INCLUSIVE_LANGUAGE_COLUMN_NAME = 'wpseo-inclusive-language';

	/**
	 * The post type helper.
	 *
	 * @var Post_Type_Helper
	 */
	protected $post_type_helper;

	/**
	 * The score icon helper.
	 *
	 * @var Score_Icon_Helper
	 */
	protected $score_icon_helper;

	/**
	 * The database object.
	 *
	 * @var wpdb
	 */
	protected $wpdb;

	/**
	 * The admin columns cache.
	 *
	 * @var Admin_Columns_Cache_Integration
	 */
	protected $admin_columns_cache;

	/**
	 * {@inheritDoc}
	 */
	public static function get_conditionals() {
		return [
			Admin_Conditional::class,
			Posts_Overview_Or_Ajax_Conditional::class,
			Inclusive_Language_Enabled_Conditional::class,
		];
	}

	/**
	 * Inclusive_Language_Column_Integration constructor
	 *
	 * @codeCoverageIgnore
	 *
	 * @param Post_Type_Helper                $post_type_helper    The post type helper.
	 * @param Score_Icon_Helper               $score_icon_helper   The score icon helper.
	 * @param wpdb                            $wpdb                The wpdb object.
	 * @param Admin_Columns_Cache_Integration $admin_columns_cache The admin columns cache.
	 */
	public function __construct(
		Post_Type_Helper $post_type_helper,
		Score_Icon_Helper $score_icon_helper,
		wpdb $wpdb,
		Admin_Columns_Cache_Integration $admin_columns_cache
	) {
		$this->post_type_helper    = $post_type_helper;
		$this->score_icon_helper   = $score_icon_helper;
		$this->wpdb                = $wpdb;
		$this->admin_columns_cache = $admin_columns_cache;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_filter( 'posts_clauses', [ $this, 'order_by_inclusive_language_score' ], 1, 2 );
		\add_action( 'admin_init', [ $this, 'register_init_hooks' ] );

		// Adds a filter to exclude the attachments from the inclusive language column.
		\add_filter( 'wpseo_inclusive_language_column_post_types', [ 'WPSEO_Post_Type', 'filter_attachment_post_type' ] );

		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Register hooks that need to be registered after `init` due to all post types not yet being registered.
	 *
	 * @return void
	 */
	public function register_init_hooks() {
		$public_post_types = \apply_filters( 'wpseo_inclusive_language_column_post_types', $this->post_type_helper->get_accessible_post_types() );

		if ( ! \is_array( $public_post_types ) || empty( $public_post_types ) ) {
			return;
		}

		foreach ( $public_post_types as $post_type ) {
			\add_filter( 'manage_' . $post_type . '_posts_columns', [ $this, 'add_inclusive_language_column' ] );
			\add_action( 'manage_' . $post_type . '_posts_custom_column', [ $this, 'column_content' ], 10, 2 );
			\add_filter( 'manage_edit-' . $post_type . '_sortable_columns', [ $this, 'column_sort' ] );
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
	 * Adds the inclusive language column for the post overview.
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
			'<span class="yoast-column-inclusive-language yoast-column-header-has-tooltip" data-tooltip-text="%1$s"><span class="screen-reader-text">%2$s</span></span>',
			\esc_attr__( 'Inclusive language score', 'wordpress-seo-premium' ),
			\esc_html__( 'Inclusive language score', 'wordpress-seo-premium' )
		);

		return $columns;
	}

	/**
	 * Modifies the query pieces to allow ordering column by inclusive language score.
	 *
	 * @param array    $pieces Array of Query pieces.
	 * @param WP_Query $query  The Query on which to apply.
	 *
	 * @return array
	 */
	public function order_by_inclusive_language_score( $pieces, $query ) {
		if ( $query->get( 'orderby' ) !== self::INCLUSIVE_LANGUAGE_COLUMN_NAME ) {
			return $pieces;
		}

		return $this->build_sort_query_pieces( $pieces, $query );
	}

	/**
	 * Builds the pieces for a sorting query.
	 *
	 * @param array    $pieces Array of Query pieces.
	 * @param WP_Query $query  The Query on which to apply.
	 *
	 * @return array Modified Query pieces.
	 */
	protected function build_sort_query_pieces( $pieces, $query ) {
		// We only want our code to run in the main WP query.
		if ( ! $query->is_main_query() ) {
			return $pieces;
		}

		// Get the order query variable - ASC or DESC.
		$order = \strtoupper( $query->get( 'order' ) );

		// Make sure the order setting qualifies. If not, set default as ASC.
		if ( ! \in_array( $order, [ 'ASC', 'DESC' ], true ) ) {
			$order = 'ASC';
		}

		$table = Model::get_table_name( 'Indexable' );

		$pieces['join']   .= " LEFT JOIN $table AS yoast_indexable ON yoast_indexable.object_id = {$this->wpdb->posts}.ID AND yoast_indexable.object_type = 'post' ";
		$pieces['orderby'] = "yoast_indexable.inclusive_language_score $order, {$pieces['orderby']}";

		return $pieces;
	}

	/**
	 * Displays the column content for the given column.
	 *
	 * @param string $column_name Column to display the content for.
	 * @param int    $post_id     Post to display the column content for.
	 *
	 * @return void
	 */
	public function column_content( $column_name, $post_id ) {
		$indexable = $this->admin_columns_cache->get_indexable( $post_id );
		// Nothing to output if we don't have the value.
		if ( empty( $indexable ) ) {
			return;
		}

		if ( $column_name === self::INCLUSIVE_LANGUAGE_COLUMN_NAME ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Correctly escaped through the Score_Icon_Helper.
			echo $this->score_icon_helper->for_inclusive_language( $indexable->inclusive_language_score );
		}
	}

	/**
	 * Sets the sortable columns.
	 *
	 * @param array $columns Array with sortable columns.
	 *
	 * @return array The extended array with sortable columns.
	 */
	public function column_sort( $columns ) {
		$columns[ self::INCLUSIVE_LANGUAGE_COLUMN_NAME ] = self::INCLUSIVE_LANGUAGE_COLUMN_NAME;

		return $columns;
	}
}
