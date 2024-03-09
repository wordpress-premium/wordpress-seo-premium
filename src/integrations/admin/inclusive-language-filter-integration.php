<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WPSEO_Meta;
use WPSEO_Rank;
use Yoast\WP\SEO\Conditionals\Admin\Posts_Overview_Or_Ajax_Conditional;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Conditionals\Inclusive_Language_Enabled_Conditional;

/**
 * Inclusive_Language_Filter_Integration class.
 *
 * phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Inclusive_Language_Filter_Integration implements Integration_Interface {

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
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		// Creates the inclusive language score filter dropdown -- with priority 20 to fire after the SEO/readability filter.
		\add_action( 'restrict_manage_posts', [ $this, 'posts_filter_dropdown_inclusive_language' ], 20 );
		// Adds the inclusive language score filter to the list of active filters -- if selected for filtering.
		\add_filter( 'wpseo_change_applicable_filters', [ $this, 'add_inclusive_language_filter' ] );
		// Adds the inclusive language score meta column to the order by part of the query -- if selected for ordering.
		\add_filter( 'wpseo_change_order_by', [ $this, 'add_inclusive_language_order_by' ] );
	}

	/**
	 * Adds a dropdown that allows filtering on inclusive language score.
	 *
	 * @return void
	 */
	public function posts_filter_dropdown_inclusive_language() {
		$ranks = WPSEO_Rank::get_all_inclusive_language_ranks();

		echo '<label class="screen-reader-text" for="wpseo-inclusive-language-filter">'
			/* translators: Hidden accessibility text. */
			. \esc_html__( 'Filter by Inclusive Language Score', 'wordpress-seo-premium' )
			. '</label>';
		echo '<select name="inclusive_language_filter" id="wpseo-inclusive-language-filter">';

		// phpcs:ignore WordPress.Security.EscapeOutput -- Output is correctly escaped in the generate_option() method.
		echo $this->generate_option( '', \__( 'All Inclusive Language Scores', 'wordpress-seo-premium' ) );

		foreach ( $ranks as $rank ) {
			$selected = \selected( $this->get_current_inclusive_language_filter(), $rank->get_rank(), false );

			// phpcs:ignore WordPress.Security.EscapeOutput -- Output is correctly escaped in the generate_option() method.
			echo $this->generate_option( $rank->get_rank(), $rank->get_drop_down_inclusive_language_labels(), $selected );
		}

		echo '</select>';
	}

	/**
	 * Generates an <option> element.
	 *
	 * @param string $value    The option's value.
	 * @param string $label    The option's label.
	 * @param string $selected HTML selected attribute for an option.
	 *
	 * @return string The generated <option> element.
	 */
	protected function generate_option( $value, $label, $selected = '' ) {
		return '<option ' . $selected . ' value="' . \esc_attr( $value ) . '">' . \esc_html( $label ) . '</option>';
	}

	/**
	 * Retrieves the current inclusive language score filter value from the $_GET variable.
	 *
	 * @return string|null The sanitized inclusive language score filter value or null when the variable is not set in $_GET.
	 */
	public function get_current_inclusive_language_filter() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
		if ( isset( $_GET['inclusive_language_filter'] ) && \is_string( $_GET['inclusive_language_filter'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
			return \sanitize_text_field( \wp_unslash( $_GET['inclusive_language_filter'] ) );
		}
		return null;
	}

	/**
	 * Determines the inclusive language score filter to the meta query, based on the passed inclusive language filter.
	 *
	 * @param string $inclusive_language_filter The inclusive language filter to use to determine what further filter to apply.
	 *
	 * @return array The inclusive language score filter.
	 */
	public function determine_inclusive_language_filters( $inclusive_language_filter ) {
		$rank = new WPSEO_Rank( $inclusive_language_filter );

		return $this->create_inclusive_language_score_filter( $rank->get_starting_score(), $rank->get_end_score() );
	}

	/**
	 * Creates an inclusive language score filter.
	 *
	 * @param number $low  The lower boundary of the score.
	 * @param number $high The higher boundary of the score.
	 *
	 * @return array The inclusive language score filter.
	 */
	protected function create_inclusive_language_score_filter( $low, $high ) {
		return [
			[
				'key'     => WPSEO_Meta::$meta_prefix . 'inclusive_language_score',
				'value'   => [ $low, $high ],
				'type'    => 'numeric',
				'compare' => 'BETWEEN',
			],
		];
	}

	/**
	 * Adds the inclusive language filter to the list of active filters -- if it has been used for filtering.
	 *
	 * @param array $active_filters The currently active filters.
	 * @return array The active filters, including the inclusive language filter -- if it has been used for filtering.
	 */
	public function add_inclusive_language_filter( $active_filters ) {
		$inclusive_language_filter = $this->get_current_inclusive_language_filter();

		if ( \is_string( $inclusive_language_filter ) && $inclusive_language_filter !== '' ) {
			$active_filters = \array_merge(
				$active_filters,
				$this->determine_inclusive_language_filters( $inclusive_language_filter )
			);
		}

		return $active_filters;
	}

	/**
	 * Adds the inclusive language score field to the order by part of the query -- if it has been selected during filtering.
	 *
	 * @param array  $order_by        The current order by statement.
	 * @param string $order_by_column The column to use for ordering.
	 * @return array The order by.
	 */
	public function add_inclusive_language_order_by( $order_by, $order_by_column = '' ) {
		if ( $order_by === [] && $order_by_column === Inclusive_Language_Column_Integration::INCLUSIVE_LANGUAGE_COLUMN_NAME ) {
			return [
				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Reason: Only used when user requests sorting.
				'meta_key' => WPSEO_Meta::$meta_prefix . 'inclusive_language_score',
				'orderby'  => 'meta_value_num',
			];
		}

		return $order_by;
	}
}
