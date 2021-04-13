<?php // phpcs:ignore Internal.NoCodeFound ?>
{{block name="yoast/job-requirements" title="<?php esc_attr_e( 'Requirements', 'wordpress-seo-premium' ); ?>" category="common" parent=[ "yoast/job-posting" ] supports={"multiple": false} }}
<div class={{class-name}}>
	{{variable-tag-rich-text name="title" default="<?php esc_attr_e( 'Requirements', 'wordpress-seo-premium' ); ?>" tags=[ "h3", "h2", "h4", "h5", "h6", "strong" ] }}
	{{variable-tag-rich-text name="requirements" tags=["ul", "ol"] multiline="li" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter requirement', 'wordpress-seo-premium' ); ?>" }}
</div>
{{inherit-sidebar parents=[ "yoast/job-posting" ] }}
