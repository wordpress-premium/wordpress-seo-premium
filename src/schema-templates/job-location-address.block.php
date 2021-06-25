<?php
/**
 * Job location address block schema template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-location-address" title="<?php esc_attr_e( 'Address', 'wordpress-seo-premium' ); ?>" description="<?php esc_attr_e( 'The street address. For example, 111 South Grand Avenue.', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" description="<?php esc_attr_e( 'The address where the office is located.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_grid(); ?>" parent=[ "yoast/office-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location__address {{class-name}}">
	{{rich-text required=true name="address" tag="span" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter street address', 'wordpress-seo-premium' ); ?>"}}
</div>
