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

$yoast_premium_redirect_table   = $view_vars['redirect_table'];
$yoast_premium_nonce            = $view_vars['nonce'];
$yoast_premium_form_presenter   = $view_vars['form_presenter'];
$yoast_premium_origin_from_url  = $view_vars['origin_from_url'];
$yoast_premium_quick_edit_table = $view_vars['quick_edit_table'];

?>

<div id="table-plain" class="tab-url redirect-table-tab">
<?php echo '<h2>' . esc_html__( 'Plain redirects', 'wordpress-seo-premium' ) . '</h2>'; ?>
	<form class='wpseo-new-redirect-form' method='post'>
		<div class='wpseo_redirect_form'>
<?php
$yoast_premium_form_presenter->display(
	array(
		'input_suffix' => '',
		'values'       => array(
			'origin' => $yoast_premium_origin_from_url,
			'target' => '',
			'type'   => '',
		),
	)
);
?>

			<button type="button" class="button button-primary"><?php esc_html_e( 'Add Redirect', 'wordpress-seo-premium' ); ?></button>
		</div>
	</form>

	<p class='desc'>&nbsp;</p>

	<?php
	$yoast_premium_quick_edit_table->display(
		array(
			'form_presenter' => $yoast_premium_form_presenter,
			'total_columns'  => $yoast_premium_redirect_table->count_columns(),
		)
	);
	?>

	<form id='plain' class='wpseo-redirects-table-form' method='post' action=''>
		<input type='hidden' class="wpseo_redirects_ajax_nonce" name='wpseo_redirects_ajax_nonce' value='<?php echo esc_attr( $yoast_premium_nonce ); ?>' />
		<?php
		// The list table.
		$yoast_premium_redirect_table->prepare_items();
		$yoast_premium_redirect_table->search_box( __( 'Search', 'wordpress-seo-premium' ), 'wpseo-redirect-search' );
		$yoast_premium_redirect_table->display();
		?>
	</form>
</div>
