<?php // phpcs:ignore Internal.NoCodeFound ?>
{{block name="yoast/remote-location" title="<?php esc_attr_e( 'Remote job', 'wordpress-seo-premium' ); ?>" category="common" parent=[ "yoast/job-location" ] supports={"multiple": false} }}
<div class={{class-name}}>
	{{variable-tag-rich-text name="<?php esc_attr_e( 'Location', 'wordpress-seo-premium' ); ?>" value="<?php esc_attr_e( 'Location', 'wordpress-seo-premium' ); ?>" tags=[ "h3", "h2", "h4", "h5", "h6", "strong" ]}}
	{{rich-text tag="p" name="remote-location" default="<?php esc_attr_e( 'This job is 100% remote.', 'wordpress-seo-premium' ); ?>"}}
</div>
{{inherit-sidebar parents=[ "yoast/job-posting" ] }}
