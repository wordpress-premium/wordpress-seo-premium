<?php
/**
 * Job location city block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-location-city" title="<?php \esc_attr_e( 'Job city', 'wordpress-seo-premium' ); ?>" description="<?php \esc_attr_e( 'The city in which the street address is, and which is in the region. For example, Los Angeles.', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" icon="<?php echo Icons::heroicons_grid(); ?>" parent=[ "yoast/office-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location__city {{class-name}}">
	{{rich-text required=true name="city" tag="span" keepPlaceholderOnFocus=true placeholder="<?php \esc_attr_e( 'Enter city', 'wordpress-seo-premium' ); ?>"}}
</div>
