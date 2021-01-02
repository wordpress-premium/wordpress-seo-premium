<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Export\Views
 */

$yoast_seo_button_label = __( 'Export keyphrases', 'wordpress-seo-premium' );

$yoast_seo_csv_export_explain = sprintf(
	/* translators: %s resolves to the button label translation. */
	esc_html__(
		'If you need a list of all public posts, terms and related keyphrases, you can generate a CSV file using the %s button below.',
		'wordpress-seo-premium'
	),
	sprintf( '<code>%s</code>', esc_html( $yoast_seo_button_label ) )
);

?>
<div id="keywords-export" class="wpseotab">
	<h2><?php esc_html_e( 'Export keyphrases to a CSV file', 'wordpress-seo-premium' ); ?></h2>
	<p><?php echo $yoast_seo_csv_export_explain; /* phpcs:ignore WordPress.Security.EscapeOutput -- See above. */ ?></p>
	<p><?php esc_html_e( 'You can add or remove columns to be included in the export using the checkboxes below.', 'wordpress-seo-premium' ); ?></p>

	<form action="" method="post" accept-charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<?php
		wp_nonce_field( 'wpseo-export', '_wpnonce', true );

		$yoast_seo_export_fields = [
			'export-keywords-score'    => __( 'Export keyphrase scores', 'wordpress-seo-premium' ),
			'export-url'               => __( 'Export URL', 'wordpress-seo-premium' ),
			'export-title'             => __( 'Export title', 'wordpress-seo-premium' ),
			'export-seo-title'         => __( 'Export SEO title', 'wordpress-seo-premium' ),
			'export-meta-description'  => __( 'Export meta description', 'wordpress-seo-premium' ),
			'export-readability-score' => __( 'Export readability score', 'wordpress-seo-premium' ),
		];

		foreach ( $yoast_seo_export_fields as $yoast_seo_export_field_name => $yoast_seo_export_field_label ) {
			echo '<input class="checkbox double" type="checkbox" id="' . esc_attr( $yoast_seo_export_field_name ) . '" name="wpseo[' . esc_attr( $yoast_seo_export_field_name ) . ']" value="on" checked="checked" />';
			$yform->label( esc_html( $yoast_seo_export_field_label ), [ 'for' => $yoast_seo_export_field_name ] );
			echo '<br class="clear" />';
		}

		?>
		<br class="clear">
		<input type="submit" class="button button-primary" name="export-posts" value="<?php echo esc_attr( $yoast_seo_button_label ); ?>"/>
	</form>

	<p><strong><?php esc_html_e( 'Please note:', 'wordpress-seo-premium' ); ?></strong></p>
	<ul>
		<li><?php esc_html_e( 'The first row in this file is the header row. This row should be ignored when parsing or importing the data from the export.', 'wordpress-seo-premium' ); ?></li>
		<li><?php esc_html_e( 'Exporting data can take a long time when there are many posts, pages, public custom post types or terms.', 'wordpress-seo-premium' ); ?></li>
	</ul>
</div>
