<?php
/**
 * Job benefits block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-benefits" category="yoast-recommended-job-blocks" description="<?php \esc_attr_e( 'The description of benefits associated with the job.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_clipboard_check(); ?>" supports={"multiple": false} title="<?php \esc_attr_e( 'Job benefits', 'wordpress-seo-premium' ); ?>" }}
{{heading name="title" defaultHeadingLevel=3 default="<?php \esc_attr_e( 'Benefits', 'wordpress-seo-premium' ); ?>" }}
<div class="yoast-job-block__benefits {{class-name}}">
	{{rich-text name="benefits" tag="ul" multiline="li" keepPlaceholderOnFocus=true placeholder="<?php \esc_attr_e( 'Enter benefit', 'wordpress-seo-premium' ); ?>" }}
</div>
