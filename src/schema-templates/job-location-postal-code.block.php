<?php
/**
 * Job location postal code block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-location-postal-code" title="<?php \esc_attr_e( 'Job postal code', 'wordpress-seo-premium' ); ?>" description="<?php \esc_attr_e( 'The postal code. For example, 90012.', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" icon="<?php echo Icons::heroicons_grid(); ?>" parent=[ "yoast/office-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location__postal-code {{class-name}}">
	{{rich-text required=true name="postal-code" tag="span" keepPlaceholderOnFocus=true placeholder="<?php \esc_attr_e( 'Enter postal code', 'wordpress-seo-premium' ); ?>"}}
</div>
