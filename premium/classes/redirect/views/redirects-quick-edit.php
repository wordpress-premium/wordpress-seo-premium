<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Views
 *
 * @uses array $display_data {
 *     @type int                           total_columns  The number of columns.
 *     @type WPSEO_Redirect_Form_Presenter form_presenter Instance of the WPSEO_Redirect_Form_Presenter class.
 * }
 */

$yoast_seo_total_columns  = $display_data['total_columns'];
$yoast_seo_form_presenter = $display_data['form_presenter'];

?>
	<script type="text/plain" id="tmpl-redirects-inline-edit">
			<tr id="inline-edit" class="inline-edit-row hidden">
				<td colspan="<?php echo (int) $yoast_seo_total_columns; ?>" class="colspanchange">

					<fieldset>
						<legend class="inline-edit-legend"><?php esc_html_e( 'Edit redirect', 'wordpress-seo-premium' ); ?></legend>
						<div class="inline-edit-col">
							<div class="wpseo_redirect_form">
								<?php
								$yoast_seo_form_presenter->display(
									[
										'input_suffix' => '{{data.suffix}}',
										'values'       => [
											'origin' => '{{data.origin}}',
											'target' => '{{data.target}}',
											'type'   => '<# if(data.type === %1$s) {  #> selected="selected"<# } #>',
										],
									]
								);
								?>
							</div>
						</div>
					</fieldset>

					<p class="inline-edit-save submit">
						<button type="button" class="button button-primary save"><?php esc_html_e( 'Update Redirect', 'wordpress-seo-premium' ); ?></button>
						<button type="button" class="button cancel"><?php esc_html_e( 'Cancel', 'wordpress-seo-premium' ); ?></button>
					</p>
				</td>
			</tr>
			</script>
