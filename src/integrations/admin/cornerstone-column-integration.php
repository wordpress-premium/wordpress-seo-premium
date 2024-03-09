<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WP_Query;
use wpdb;
use WPSEO_Admin_Asset_Manager;
use Yoast\WP\Lib\Model;
use Yoast\WP\SEO\Conditionals\Admin\Posts_Overview_Or_Ajax_Conditional;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Integrations\Admin\Admin_Columns_Cache_Integration;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Cornerstone_Enabled_Conditional;
use Yoast\WP\SEO\Premium\Presenters\Icons\Checkmark_Icon_Presenter;
use Yoast\WP\SEO\Premium\Presenters\Icons\Cross_Icon_Presenter;

/**
 * Cornerstone_Column_Integration class.
 */
class Cornerstone_Column_Integration implements Integration_Interface {

	/**
	 * Name of the column.
	 *
	 * @var string
	 */
	public const CORNERSTONE_COLUMN_NAME = 'wpseo-cornerstone';

	/**
	 * The post type helper.
	 *
	 * @var Post_Type_Helper
	 */
	protected $post_type_helper;

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
			Cornerstone_Enabled_Conditional::class,
		];
	}

	/**
	 * Cornerstone_Column_Integration constructor
	 *
	 * @codeCoverageIgnore
	 *
	 * @param Post_Type_Helper                $post_type_helper    The post type helper.
	 * @param wpdb                            $wpdb                The wpdb object.
	 * @param Admin_Columns_Cache_Integration $admin_columns_cache The admin columns cache.
	 */
	public function __construct(
		Post_Type_Helper $post_type_helper,
		wpdb $wpdb,
		Admin_Columns_Cache_Integration $admin_columns_cache
	) {
		$this->post_type_helper    = $post_type_helper;
		$this->wpdb                = $wpdb;
		$this->admin_columns_cache = $admin_columns_cache;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		\add_filter( 'posts_clauses', [ $this, 'order_by_cornerstone' ], 1, 2 );
		\add_action( 'admin_init', [ $this, 'register_init_hooks' ] );

		// Adds a filter to exclude the attachments from the cornerstone column.
		\add_filter( 'wpseo_cornerstone_column_post_types', [ 'WPSEO_Post_Type', 'filter_attachment_post_type' ] );

		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Register hooks that need to be registered after `init` due to all post types not yet being registered.
	 *
	 * @return void
	 */
	public function register_init_hooks() {
		$public_post_types = \apply_filters( 'wpseo_cornerstone_column_post_types', $this->post_type_helper->get_accessible_post_types() );

		if ( ! \is_array( $public_post_types ) || empty( $public_post_types ) ) {
			return;
		}

		foreach ( $public_post_types as $post_type ) {
			\add_filter( 'manage_' . $post_type . '_posts_columns', [ $this, 'add_cornerstone_column' ] );
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
	 * Adds the columns for the post overview.
	 *
	 * @param array $columns Array with columns.
	 *
	 * @return array The extended array with columns.
	 */
	public function add_cornerstone_column( $columns ) {
		if ( ! \is_array( $columns ) ) {
			return $columns;
		}

		$columns[ self::CORNERSTONE_COLUMN_NAME ] = \sprintf(
			'<span class="yoast-column-cornerstone yoast-column-header-has-tooltip" data-tooltip-text="%1$s"><span class="screen-reader-text">%2$s</span></span>',
			\esc_attr__( 'Is this cornerstone content?', 'wordpress-seo-premium' ),
			/* translators: Hidden accessibility text. */
			\esc_html__( 'Cornerstone content', 'wordpress-seo-premium' )
		);

		return $columns;
	}

	/**
	 * Modifies the query pieces to allow ordering column by cornerstone.
	 *
	 * @param array    $pieces Array of Query pieces.
	 * @param WP_Query $query  The Query on which to apply.
	 *
	 * @return array
	 */
	public function order_by_cornerstone( $pieces, $query ) {
		if ( $query->get( 'orderby' ) !== self::CORNERSTONE_COLUMN_NAME ) {
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
		$pieces['orderby'] = "yoast_indexable.is_cornerstone $order, FIELD( {$this->wpdb->posts}.post_status, 'publish' ) $order, {$pieces['orderby']}";

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

		// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
		if ( $column_name === self::CORNERSTONE_COLUMN_NAME ) {
			if ( $indexable->is_cornerstone === true ) {
				echo new Checkmark_Icon_Presenter( 20 );

				return;
			}

			echo new Cross_Icon_Presenter( 20 );
		}
		// phpcs:enable
	}

	/**
	 * Sets the sortable columns.
	 *
	 * @param array $columns Array with sortable columns.
	 *
	 * @return array The extended array with sortable columns.
	 */
	public function column_sort( $columns ) {
		$columns[ self::CORNERSTONE_COLUMN_NAME ] = self::CORNERSTONE_COLUMN_NAME;

		return $columns;
	}
}
