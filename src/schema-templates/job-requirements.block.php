<?php
/**
 * Job requirements block schema template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-requirements" title="<?php esc_attr_e( 'Requirements', 'wordpress-seo-premium' ); ?>" category="yoast-recommended-job-blocks" description="<?php esc_attr_e( 'The description of skills and experience needed for the position.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_clipboard_list(); ?>" supports={"multiple": false} }}
<div class="yoast-job-block__requirements {{class-name}}">
	{{heading name="title" defaultHeadingLevel=3 default="<?php esc_attr_e( 'Requirements', 'wordpress-seo-premium' ); ?>" }}
	{{rich-text name="requirements" tag="ul" multiline="li" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter requirement', 'wordpress-seo-premium' ); ?>" }}
</div>
