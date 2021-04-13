<?php // phpcs:ignore Internal.NoCodeFound ?>
{{block name="yoast/job-expiration" title="<?php esc_attr_e( 'Job expiration date', 'wordpress-seo-premium' ); ?>" category="common" parent=[ "yoast/job-posting" ] supports={"multiple": false} }}
<div class={{class-name}}>
	{{rich-text name="title" tag="strong" default="<?php esc_attr_e( 'Closes on', 'wordpress-seo-premium' ); ?>"}}
	{{date name="expirationDate" }}
</div>
{{inherit-sidebar parents=[ "yoast/job-posting" ] }}
