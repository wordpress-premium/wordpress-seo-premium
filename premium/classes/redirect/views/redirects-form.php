<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Views
 *
 * @uses array $display_vars {
 *     @type string origin_label_value The label that reflects the origin of the redirect: Old URL or Regular Expression.
 *     @type array  redirect_types     The redirect types to show in the drop-down menu.
 *     @type string input_suffix       The input suffix.
 *     @type array  values             The pre-filled values for the input fields.
 * }
 */

$yoast_premium_origin_label_value = $display_vars['origin_label_value'];
$yoast_premium_redirect_types     = $display_vars['redirect_types'];
$yoast_premium_input_suffix       = $display_vars['input_suffix'];
$yoast_premium_values             = $display_vars['values'];
?>
<div class="redirect_form_row" id="row-wpseo_redirects_type">
	<label class='textinput' for='<?php echo esc_attr( 'wpseo_redirects_type' . $yoast_premium_input_suffix ); ?>'>
		<span class="title"><?php echo esc_html_x( 'Type', 'noun', 'wordpress-seo-premium' ); ?></span>
	</label>
	<select name='wpseo_redirects_type' id='<?php echo esc_attr( 'wpseo_redirects_type' . $yoast_premium_input_suffix ); ?>' class='select'>
		<?php
		// Loop through the redirect types.
		if ( count( $yoast_premium_redirect_types ) > 0 ) {
			foreach ( $yoast_premium_redirect_types as $yoast_premium_redirect_type => $yoast_premium_redirect_desc ) {
				echo '<option value="' . esc_attr( $yoast_premium_redirect_type ) . '"'
					. sprintf( $yoast_premium_values['type'], $yoast_premium_redirect_type ) . '>'
					. esc_html( $yoast_premium_redirect_desc ) . '</option>' . "\n";
			}
		}
		?>
	</select>
</div>

<p class="label desc description wpseo-redirect-clear">
	<?php
	printf(
		/* translators: 1: opens a link to a related knowledge base article. 2: closes the link. */
		esc_html__( 'The redirect type is the HTTP response code sent to the browser telling the browser what type of redirect is served. %1$sLearn more about redirect types%2$s.', 'wordpress-seo-premium' ),
		'<a href="' . WPSEO_Shortlinker::get( 'https://yoa.st/2jb' ) . '" target="_blank">',
		'</a>'
	);
	?>
</p>

<div class='redirect_form_row' id="row-wpseo_redirects_origin">
	<label class='textinput' for='<?php echo esc_attr( 'wpseo_redirects_origin' . $yoast_premium_input_suffix ); ?>'>
		<span class="title"><?php echo esc_html( $yoast_premium_origin_label_value ); ?></span>
	</label>
	<input type='text' class='textinput' name='wpseo_redirects_origin' id='<?php echo esc_attr( 'wpseo_redirects_origin' . $yoast_premium_input_suffix ); ?>' value='<?php echo esc_attr( $yoast_premium_values['origin'] ); ?>' />
</div>
<br class='clear'/>

<div class="redirect_form_row wpseo_redirect_target_holder" id="row-wpseo_redirects_target">
	<label class='textinput' for='<?php echo esc_attr( 'wpseo_redirects_target' . $yoast_premium_input_suffix ); ?>'>
		<span class="title"><?php esc_html_e( 'URL', 'wordpress-seo-premium' ); ?></span>
	</label>
	<input type='text' class='textinput' name='wpseo_redirects_target' id='<?php echo esc_attr( 'wpseo_redirects_target' . $yoast_premium_input_suffix ); ?>' value='<?php echo esc_attr( $yoast_premium_values['target'] ); ?>' />
</div>
<br class='clear'/>
