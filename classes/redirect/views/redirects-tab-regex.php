<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Views
 *
 * @uses array $view_vars {
 *     @type string                              redirect_table   The file path to show in the notices.
 *     @type string                              nonce            The nonce.
 *     @type WPSEO_Redirect_Form_Presenter       form_presenter   Instance of the WPSEO_Redirect_Form_Presenter class.
 *     @type string                              origin_from_url  The redirect origin.
 *     @type WPSEO_Redirect_Quick_Edit_Presenter quick_edit_table Instance of the WPSEO_Redirect_Quick_Edit_Presenter class.
 * }
 */

$yoast_seo_redirect_table   = $view_vars['redirect_table'];
$yoast_seo_nonce            = $view_vars['nonce'];
$yoast_seo_form_presenter   = $view_vars['form_presenter'];
$yoast_seo_origin_from_url  = $view_vars['origin_from_url'];
$yoast_seo_quick_edit_table = $view_vars['quick_edit_table'];

?>

<div id="table-regex" class="tab-url redirect-table-tab">
<?php echo '<h2>' . esc_html__( 'Regular Expression redirects', 'wordpress-seo-premium' ) . '</h2>'; ?>
	<p>
		<?php
		printf(
			/* translators: 1: opens a link to a related help center article. 2: closes the link. */
			esc_html__( 'Regular Expression (regex) Redirects are extremely powerful redirects. You should only use them if you know what you are doing. %1$sRead more about regex redirects on our help center%2$s.', 'wordpress-seo-premium' ),
			'<a href="' . esc_url( WPSEO_Shortlinker::get( 'https://yoa.st/3lo' ) ) . '" target="_blank">',
			'</a>'
		);
		?>
	</p>

	<form class='wpseo-new-redirect-form' method='post'>
		<div class='wpseo_redirect_form'>
<?php
$yoast_seo_form_presenter->display(
	[
		'input_suffix' => '',
		'values'       => [
			'origin' => $yoast_seo_origin_from_url,
			'target' => '',
			'type'   => '',
		],
	]
);
?>

			<button type="button" class="button button-primary"><?php esc_html_e( 'Add Redirect', 'wordpress-seo-premium' ); ?></button>
		</div>
	</form>

	<p class='desc'>&nbsp;</p>

	<?php
	$yoast_seo_quick_edit_table->display(
		[
			'form_presenter' => $yoast_seo_form_presenter,
			'total_columns'  => $yoast_seo_redirect_table->count_columns(),
		]
	);
	?>

	<form id='regex' class='wpseo-redirects-table-form' method='post'>
		<input type='hidden' class="wpseo_redirects_ajax_nonce" name='wpseo_redirects_ajax_nonce' value='<?php echo esc_attr( $yoast_seo_nonce ); ?>' />
		<?php
		// The list table.
		$yoast_seo_redirect_table->prepare_items();
		$yoast_seo_redirect_table->search_box( __( 'Search', 'wordpress-seo-premium' ), 'wpseo-redirect-search' );
		$yoast_seo_redirect_table->display();
		?>
	</form>
</div>
