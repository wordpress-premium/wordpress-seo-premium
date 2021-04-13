<?php // phpcs:ignore Internal.NoCodeFound ?>
{{block name="yoast/office-location" title="<?php esc_attr_e( 'Office location', 'wordpress-seo-premium' ); ?>" category="common" parent=[ "yoast/job-location" ] supports={"multiple": false} }}
<div class={{class-name}}>
	{{variable-tag-rich-text name="<?php esc_attr_e( 'Location', 'wordpress-seo-premium' ); ?>" value="<?php esc_attr_e( 'Location', 'wordpress-seo-premium' ); ?>" tags=[ "h3", "h2", "h4", "h5", "h6", "strong" ]}}
	{{variable-tag-rich-text name="address-title" tags=[ "h4", "h2", "h3", "h5", "h6", "strong" ] }}
	{{rich-text name="address" tag="p" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter street address', 'wordpress-seo-premium' ); ?>"}}
	{{variable-tag-rich-text name="postal-code-title" tags=[ "h4", "h2", "h3", "h5", "h6", "strong" ] }}
	{{rich-text name="postal-code" tag="p" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter postal code', 'wordpress-seo-premium' ); ?>"}}
	{{variable-tag-rich-text name="city-title" tags=[ "h4", "h2", "h3", "h5", "h6", "strong" ] }}
	{{rich-text name="city" tag="p" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter city', 'wordpress-seo-premium' ); ?>"}}
	{{variable-tag-rich-text name="region-title" tags=[ "h4", "h2", "h3", "h5", "h6", "strong" ] }}
	{{rich-text name="region" tag="p" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter region', 'wordpress-seo-premium' ); ?>"}}
	{{variable-tag-rich-text name="country-title" tags=[ "h4", "h2", "h3", "h5", "h6", "strong" ] }}
	{{rich-text name="country" tag="p" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter country', 'wordpress-seo-premium' ); ?>"}}
</div>
{{inherit-sidebar parents=[ "yoast/job-posting" ] }}
