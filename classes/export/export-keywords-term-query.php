<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Export
 */

/**
 * Class WPSEO_Export_Keywords_Term_Query
 *
 * Creates an SQL query to gather all term data for a keywords export.
 */
class WPSEO_Export_Keywords_Term_Query implements WPSEO_Export_Keywords_Query {

	/**
	 * The columns to query for, an array of strings.
	 *
	 * @var array
	 */
	protected $columns;

	/**
	 * The database columns to select in the query, an array of strings.
	 *
	 * @var array
	 */
	protected $selects;

	/**
	 * Number of items to fetch per page.
	 *
	 * @var int
	 */
	protected $page_size;

	/**
	 * WPSEO_Export_Keywords_Query constructor.
	 *
	 * Supported values for columns are 'title', 'url', 'keywords', 'readability_score' and 'keywords_score'.
	 * Requesting 'keywords_score' will always also return 'keywords'.
	 *
	 * @param array $columns   List of columns that need to be retrieved.
	 * @param int   $page_size Number of items to retrieve.
	 */
	public function __construct( array $columns, $page_size = 1000 ) {
		$this->page_size = max( 1, (int) $page_size );
		$this->set_columns( $columns );
	}

	/**
	 * Returns the page size for the query.
	 *
	 * @return int Page size that is being used.
	 */
	public function get_page_size() {
		return $this->page_size;
	}

	/**
	 * Constructs the query and executes it, returning an array of objects containing the columns this object was constructed with.
	 * Every object will always contain the ID column.
	 *
	 * @param int $page Paginated page to retrieve.
	 *
	 * @return array An array of associative arrays containing the keys as requested in the constructor.
	 */
	public function get_data( $page = 1 ) {

		global $wpdb;

		if ( $this->columns === [] ) {
			return [];
		}

		$taxonomies = get_taxonomies(
			[
				'public'  => true,
				'show_ui' => true,
			],
			'names'
		);

		if ( empty( $taxonomies ) ) {
			return [];
		}

		// Pages have a starting index of 1, we need to convert to a 0 based offset.
		$offset_multiplier = max( 0, ( $page - 1 ) );

		$replacements   = [];
		$replacements[] = $wpdb->terms;
		$replacements[] = $wpdb->term_taxonomy;
		$replacements[] = 'term_id';
		$replacements[] = 'term_id';
		$replacements[] = 'taxonomy';
		$replacements   = array_merge( $replacements, $taxonomies );
		$replacements[] = $this->page_size;
		$replacements[] = ( $offset_multiplier * $this->page_size );

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.PreparedSQLPlaceholders.UnsupportedPlaceholder,WordPress.DB.PreparedSQLPlaceholders.ReplacementsWrongNumber,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Already prepared, and no cache applicable.
		return $wpdb->get_results(
			$wpdb->prepare(
				'SELECT ' . implode( ', ', $this->selects )
				. ' FROM %i AS terms'
				. ' INNER JOIN %i AS taxonomies'
				. ' ON terms.%i = taxonomies.%i AND taxonomies.%i IN ('
				. implode( ',', array_fill( 0, count( $taxonomies ), '%s' ) ) . ')'
				. ' LIMIT %d OFFSET %d',
				$replacements
			),
			ARRAY_A
		);
		// phpcs:enable
	}

	/**
	 * Prepares the necessary selects and joins to get all data in a single query.
	 *
	 * @param array $columns The columns we want our query to return.
	 *
	 * @return void
	 */
	public function set_columns( array $columns ) {
		$this->columns = $columns;

		$this->selects = [ 'terms.term_id', 'taxonomies.taxonomy' ];

		if ( in_array( 'title', $this->columns, true ) ) {
			$this->selects[] = 'terms.name';
		}
	}
}
