<?php // phpcs:ignore Internal.NoCodeFound ?>
{{block name="yoast/job-benefits" title="<?php esc_attr_e( 'Benefits', 'wordpress-seo-premium' ); ?>" category="common" parent=[ "yoast/job-posting" ] supports={"multiple": false}}}
<div class={{class-name}}>
	{{variable-tag-rich-text name="title" default="<?php esc_attr_e( 'Benefits', 'wordpress-seo-premium' ); ?>" tags=[ "h3", "h2", "h4", "h5", "h6", "strong" ] }}
	{{variable-tag-rich-text name="benefits" tags=["ul", "ol"] multiline="li" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter benefit', 'wordpress-seo-premium' ); ?>" }}
</div>
{{inherit-sidebar parents=[ "yoast/job-posting" ] }}
