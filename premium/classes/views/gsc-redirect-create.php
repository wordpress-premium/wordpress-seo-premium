<?php
/**
 * WPSEO Premium plugin file.
 *
 * This is the view for the modal box that appears when the url can be added as a redirect.
 *
 * @package WPSEO\Admin|Google_Search_Console
 */

/**
 * The old URL that redirects to the new URL.
 *
 * @var string $url
 */

_deprecated_file( __FILE__, 'WPSEO 12.5' );

$yoast_seo_unique_id      = md5( $url );
$yoast_seo_redirect_types = new WPSEO_Redirect_Types();

$yoast_seo_i18n_fixed_in_gsc = sprintf(
	/* Translators: %1$s: expands to 'Google Search Console'. */
	__( 'Mark this issue as fixed in %1$s.', 'wordpress-seo-premium' ),
	'Google Search Console'
);

?>
	<h1 class="wpseo-redirect-url-title"><?php esc_html_e( 'Redirect this broken URL and fix the error', 'wordpress-seo-premium' ); ?></h1>

	<div class='form-field form-required'>
		<label for='<?php echo esc_attr( 'wpseo-current-url-' . $yoast_seo_unique_id ); ?>'><?php esc_html_e( 'Old URL:', 'wordpress-seo-premium' ); ?></label>
		<input type='text' id='<?php echo esc_attr( 'wpseo-current-url-' . $yoast_seo_unique_id ); ?>' name='current_url' value='<?php echo esc_url( $url ); ?>' readonly />
	</div>
	<div class='form-field form-required'>
		<label for='<?php echo esc_attr( 'wpseo-redirect-type-' . $yoast_seo_unique_id ); ?>'><?php echo esc_html_x( 'Type', 'noun', 'wordpress-seo-premium' ); ?></label>
		<select name='redirect-type' id='<?php echo esc_attr( 'wpseo-redirect-type-' . $yoast_seo_unique_id ); ?>' class='select'>
			<?php
			// Loop through the redirect types.
			foreach ( $yoast_seo_redirect_types->get() as $yoast_seo_redirect_type => $yoast_seo_redirect_desc ) {
				echo '<option value="' . esc_attr( $yoast_seo_redirect_type ) . '">'
					. esc_html( $yoast_seo_redirect_desc ) . '</option>' . "\n";
			}
			?>
		</select>
	</div>
	<div class='form-field form-required form-field-target'>
		<label for='<?php echo esc_attr( 'wpseo-new-url-' . $yoast_seo_unique_id ); ?>'><?php esc_html_e( 'New URL:', 'wordpress-seo-premium' ); ?></label>
		<input type='text' id='<?php echo esc_attr( 'wpseo-new-url-' . $yoast_seo_unique_id ); ?>' name='new_url' value='' />
	</div>
	<div class='form-field form-required'>
		<label for='<?php echo esc_attr( 'wpseo-mark-as-fixed-' . $yoast_seo_unique_id ); ?>' class='clear'><?php esc_html_e( 'Mark as fixed:', 'wordpress-seo-premium' ); ?></label>
		<input type='checkbox' checked value='1' id='<?php echo esc_attr( 'wpseo-mark-as-fixed-' . $yoast_seo_unique_id ); ?>' name='mark_as_fixed' class='clear' aria-describedby='<?php echo esc_attr( 'wpseo-mark-as-fixed-desc-' . $yoast_seo_unique_id ); ?>' />
		<p id='<?php echo esc_attr( 'wpseo-mark-as-fixed-desc-' . $yoast_seo_unique_id ); ?>'><?php echo esc_html( $yoast_seo_i18n_fixed_in_gsc ); ?></p>
	</div>
	<p class='submit'>
		<input type='button' name='submit' id='<?php echo esc_attr( 'submit-' . $yoast_seo_unique_id ); ?>' class='button button-primary' value='<?php esc_attr_e( 'Create redirect', 'wordpress-seo-premium' ); ?>' onclick='wpseoPostRedirectToGSC( jQuery( this ) );' />
		<button type="button" class="button wpseo-redirect-close"><?php esc_html_e( 'Cancel', 'wordpress-seo-premium' ); ?></button>
	</p>
