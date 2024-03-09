<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Class WPSEO_Redirect_Table.
 */
class WPSEO_Redirect_Table extends WP_List_Table {

	/**
	 * List of all redirects.
	 *
	 * @var WPSEO_Redirect[]
	 */
	public $items;

	/**
	 * List containing redirect filter parameters.
	 *
	 * @var array
	 */
	private $filter = [
		'redirect_type' => null,
		'search_string' => null,
	];

	/**
	 * The name of the first column.
	 *
	 * @var string
	 */
	private $current_column;

	/**
	 * The primary column.
	 *
	 * @var string
	 */
	private $primary_column = 'type';

	/**
	 * Caches the WPSEO_Redirect_Types::get() result.
	 *
	 * @var string[]
	 */
	private $redirect_types;

	/**
	 * Holds the orderby.
	 *
	 * @var string
	 */
	private $orderby = 'old';

	/**
	 * Holds the order.
	 *
	 * @var string
	 */
	private $order = 'asc';

	/**
	 * WPSEO_Redirect_Table constructor.
	 *
	 * @param array|string     $type           Type of the redirects that is opened.
	 * @param string           $current_column The value of the first column.
	 * @param WPSEO_Redirect[] $redirects      The redirects.
	 */
	public function __construct( $type, $current_column, $redirects ) {
		parent::__construct( [ 'plural' => $type ] );

		$this->current_column = $current_column;

		// Cache used in filter_items and extra_tablenav.
		$wpseo_redirect_types = new WPSEO_Redirect_Types();
		$this->redirect_types = $wpseo_redirect_types->get();

		$this->set_items( $redirects );

		add_filter( 'list_table_primary_column', [ $this, 'redirect_list_table_primary_column' ], 10, 2 );
	}

	/**
	 * Renders the extra table navigation.
	 *
	 * @param string $which Which tablenav is called.
	 *
	 * @return void
	 */
	public function extra_tablenav( $which ) {
		if ( $which !== 'top' ) {
			return;
		}

		$selected = $this->filter['redirect_type'];
		if ( $selected === null ) {
			$selected = 0;
		}
		?>
		<div class="alignleft actions">
			<label for="filter-by-redirect" class="screen-reader-text">
			<?php
				/* translators: Hidden accessibility text. */
				esc_html_e( 'Filter by redirect type', 'wordpress-seo-premium' );
			?>
			</label>
			<select name="redirect-type" id="filter-by-redirect">
				<option<?php selected( $selected, 0 ); ?> value="0"><?php esc_html_e( 'All redirect types', 'wordpress-seo-premium' ); ?></option>
				<?php
				foreach ( $this->redirect_types as $http_code => $redirect_type ) {
					printf(
						"<option %s value='%s'>%s</option>\n",
						selected( $selected, $http_code, false ),
						esc_attr( $http_code ),
						esc_html( $redirect_type )
					);
				}
				?>
			</select>
			<?php submit_button( __( 'Filter', 'wordpress-seo-premium' ), '', 'filter_action', false, [ 'id' => 'post-query-submit' ] ); ?>
		</div>
		<?php
	}

	/**
	 * Set the table columns.
	 *
	 * @return string[] The table columns.
	 */
	public function get_columns() {
		return [
			'cb'   => '<input type="checkbox" />',
			'type' => _x( 'Type', 'noun', 'wordpress-seo-premium' ),
			'old'  => $this->current_column,
			'new'  => __( 'New URL', 'wordpress-seo-premium' ),
		];
	}

	/**
	 * Counts the total columns for the table.
	 *
	 * @return int The total amount of columns.
	 */
	public function count_columns() {
		return count( $this->get_columns() );
	}

	/**
	 * Filter for setting the primary table column.
	 *
	 * @param string $column The current column.
	 * @param string $screen The current opened window.
	 *
	 * @return string The primary table column.
	 */
	public function redirect_list_table_primary_column( $column, $screen ) {
		if ( $screen === 'seo_page_wpseo_redirects' ) {
			$column = $this->primary_column;
		}

		return $column;
	}

	/**
	 * Sets up the table variables, fetch the items from the database, search, sort and format the items.
	 * Sets the items as the WPSEO_Redirect_Table items variable.
	 *
	 * @return void
	 */
	public function prepare_items() {
		// Setup the columns.
		$this->_column_headers = [ $this->get_columns(), [], $this->get_sortable_columns() ];

		// Get variables needed for pagination.
		$per_page        = $this->get_items_per_page( 'redirects_per_page', 25 );
		$total_items     = count( $this->items );
		$pagination_args = [
			'total_items' => $total_items,
			'total_pages' => ceil( $total_items / $per_page ),
			'per_page'    => $per_page,
		];

		// Set pagination.
		$this->set_pagination_args( $pagination_args );

		$current_page = $this->get_pagenum();

		// Setting the starting point. If starting point is below 1, overwrite it with value 0, otherwise it will be sliced of at the back.
		$slice_start = ( $current_page - 1 );
		if ( $slice_start < 0 ) {
			$slice_start = 0;
		}

		// Apply 'pagination'.
		$formatted_items = array_slice( $this->items, ( $slice_start * $per_page ), $per_page );

		// Set items.
		$this->items = $formatted_items;
	}

	/**
	 * Returns the columns that are sortable.
	 *
	 * @return array[] An array containing the sortable columns.
	 */
	public function get_sortable_columns() {
		return [
			'old'  => [ 'old', false ],
			'new'  => [ 'new', false ],
			'type' => [ 'type', false ],
		];
	}

	/**
	 * Reorders the items based on user input.
	 *
	 * @param array $a The current sort direction.
	 * @param array $b The new sort direction.
	 *
	 * @return int The order that should be used.
	 */
	public function do_reorder( $a, $b ) {
		// Determine sort order.
		$result = strcmp( $a[ $this->orderby ], $b[ $this->orderby ] );

		// Send final sort direction to usort.
		return ( $this->order === 'asc' ) ? $result : ( -$result );
	}

	/**
	 * Creates a column for a checkbox.
	 *
	 * @param array $item Array with the row data.
	 *
	 * @return string The column with a checkbox.
	 */
	public function column_cb( $item ) {
		return sprintf(
			'<label class="screen-reader-text" for="wpseo-redirects-bulk-cb-%2$s">%3$s</label> <input type="checkbox" name="wpseo_redirects_bulk_delete[]" id="wpseo-redirects-bulk-cb-%2$s" value="%1$s" />',
			esc_attr( $item['old'] ),
			$item['row_number'],
			/* translators: Hidden accessibility text. */
			esc_html( __( 'Select this redirect', 'wordpress-seo-premium' ) )
		);
	}

	/**
	 * Displays a default column.
	 *
	 * @param array  $item        Array with the row data.
	 * @param string $column_name The name of the needed column.
	 *
	 * @return string The default column.
	 */
	public function column_default( $item, $column_name ) {

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		$is_regex    = isset( $_GET['tab'] ) && is_string( $_GET['tab'] ) && sanitize_text_field( wp_unslash( $_GET['tab'] ) ) === 'regex';
		$row_actions = $this->get_row_actions( $column_name );

		switch ( $column_name ) {
			case 'new':
				$classes      = [ 'val' ];
				$new_url      = $item['new'];
				$new_full_url = $new_url;
				if ( ! $is_regex && WPSEO_Redirect_Util::requires_trailing_slash( $new_url ) ) {
					$classes[] = 'has-trailing-slash';
				}
				if ( WPSEO_Redirect_Util::is_relative_url( $new_url ) ) {
					$new_full_url = home_url( $new_url );
				}

				if (
					$new_url === ''
					|| $new_url === '/'
					|| ! WPSEO_Redirect_Util::is_relative_url( $new_url )
				) {

					$classes[] = 'remove-slashes';
				}

				if ( $new_url ) {
					return '<a class="' . esc_attr( implode( ' ', $classes ) ) . '" href="' . esc_url( $new_full_url ) . '" target="_blank">' . esc_html( $new_url ) . '</a>' . $row_actions;
				}
				return '<div class="val remove-slashes"></div>' . $row_actions;

			case 'old':
				$classes      = '';
				$old_full_url = home_url( $item['old'] );
				if ( $is_regex === true ) {
					return '<div class="val remove-slashes">' . esc_html( $item['old'] ) . '</div>' . $row_actions;
				}

				return '<a class="val' . $classes . '" href="' . esc_url( $old_full_url ) . '" target="_blank">' . esc_html( $item['old'] ) . '</a>' . $row_actions;

			case 'type':
				return '<div class="val type">' . esc_html( $item['type'] ) . '</div>' . $row_actions;

			default:
				return $item[ $column_name ];
		}
	}

	/**
	 * Returns the available bulk actions.
	 *
	 * @return string[] Array containing the available bulk actions.
	 */
	public function get_bulk_actions() {
		return [
			'delete' => __( 'Delete', 'wordpress-seo-premium' ),
		];
	}

	/**
	 * Sets the items and orders them.
	 *
	 * @param array $items The data that will be showed.
	 *
	 * @return void
	 */
	private function set_items( $items ) {
		// Getting the items.
		$this->items = $this->filter_items( $items );

		$this->format_items();

		// Sort the results.
		if ( count( $this->items ) > 0 ) {
			$this->orderby = $this->get_orderby();
			$this->order   = $this->get_order();
			usort( $this->items, [ $this, 'do_reorder' ] );
		}
	}

	/**
	 * Filters the given items.
	 *
	 * @param WPSEO_Redirect[] $items The items to filter.
	 *
	 * @return array The filtered items.
	 */
	private function filter_items( array $items ) {
		$search_string = '';
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We come from our own redirect in a simple search form, let's not overcomplicate.
		if ( isset( $_GET['s'] ) && is_string( $_GET['s'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Same as above.
			$search_string = trim( sanitize_text_field( wp_unslash( $_GET['s'] ) ), '/' );
		}
		if ( $search_string !== '' ) {
			$this->filter['search_string'] = $search_string;

			$items = array_filter( $items, [ $this, 'filter_by_search_string' ] );
		}

		$redirect_type = 0;
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We come from our own redirect in a simple filter form, let's not overcomplicate.
		if ( isset( $_GET['redirect-type'] ) && is_string( $_GET['redirect-type'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: Cast to an integer and strictly compared against known keys.
			$redirect_type = (int) wp_unslash( $_GET['redirect-type'] );
			$redirect_type = array_key_exists( $redirect_type, $this->redirect_types ) ? $redirect_type : 0;
		}
		if ( $redirect_type !== 0 ) {
			$this->filter['redirect_type'] = $redirect_type;

			$items = array_filter( $items, [ $this, 'filter_by_type' ] );
		}

		return $items;
	}

	/**
	 * Formats the items.
	 *
	 * @return void
	 */
	private function format_items() {
		// Format the data.
		$formatted_items = [];

		$counter = 1;

		foreach ( $this->items as $redirect ) {
			$formatted_items[] = [
				'old'        => $redirect->get_origin(),
				'new'        => $redirect->get_target(),
				'type'       => $redirect->get_type(),
				'row_number' => $counter,
			];

			++$counter;
		}

		$this->items = $formatted_items;
	}

	/**
	 * Filters the redirect by entered search string.
	 *
	 * @param WPSEO_Redirect $redirect The redirect to filter.
	 *
	 * @return bool True when the search strings match.
	 */
	private function filter_by_search_string( WPSEO_Redirect $redirect ) {
		return ( stripos( $redirect->get_origin(), $this->filter['search_string'] ) !== false || stripos( $redirect->get_target(), $this->filter['search_string'] ) !== false );
	}

	/**
	 * Filters the redirect by redirect type.
	 *
	 * @param WPSEO_Redirect $redirect The redirect to filter.
	 *
	 * @return bool True when type matches redirect type.
	 */
	private function filter_by_type( WPSEO_Redirect $redirect ) {
		return $redirect->get_type() === $this->filter['redirect_type'];
	}

	/**
	 * The old column actions.
	 *
	 * @param string $column The column name to verify.
	 *
	 * @return string
	 */
	private function get_row_actions( $column ) {
		if ( $column === $this->primary_column ) {
			$actions = [
				'edit'  => '<a href="#" role="button" class="redirect-edit">' . __( 'Edit', 'wordpress-seo-premium' ) . '</a>',
				'trash' => '<a href="#" role="button" class="redirect-delete">' . __( 'Delete', 'wordpress-seo-premium' ) . '</a>',
			];

			return $this->row_actions( $actions );
		}

		return '';
	}

	/**
	 * Generates and display row actions links for the list table.
	 *
	 * We override the parent class method to avoid doubled buttons to be printed out.
	 *
	 * @param object $item        The item being acted upon.
	 * @param string $column_name Current column name.
	 * @param string $primary     Primary column name.
	 *
	 * @return string Empty string.
	 */
	protected function handle_row_actions( $item, $column_name, $primary ) {
		return '';
	}

	/**
	 * Retrieves the orderby from the request.
	 *
	 * @return string The orderby value.
	 */
	private function get_orderby() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: WP list table is not using a nonce.
		if ( isset( $_GET['orderby'] ) && is_string( $_GET['orderby'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: same as above and we are strictly comparing the values.
			$orderby = wp_unslash( $_GET['orderby'] );
			if ( array_key_exists( $orderby, $this->get_sortable_columns() ) ) {
				return $orderby;
			}
		}

		return 'old';
	}

	/**
	 * Retrieves the order from the request.
	 *
	 * @return string The order value.
	 */
	private function get_order() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: WP list table is not using a nonce.
		if ( isset( $_GET['order'] ) && is_string( $_GET['order'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Reason: same as above and we are strictly comparing the values.
			$order = wp_unslash( $_GET['order'] );
			if ( in_array( $order, [ 'asc', 'desc' ], true ) ) {
				return $order;
			}
		}

		return 'asc';
	}
}
