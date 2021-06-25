<?php
/**
 * Job location State/Province/Region block schema template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-location-region" title="<?php esc_attr_e( 'State/Province/Region', 'wordpress-seo-premium' ); ?>" description="<?php esc_attr_e( 'The state, province or region in which the city is, and which is in the country. For example, California.', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" icon="<?php echo Icons::heroicons_grid(); ?>" description="<?php esc_attr_e( 'The state, province or region in which the city is, and which is in the country. For example, California.', 'wordpress-seo-premium' ); ?>" parent=[ "yoast/office-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location__region {{class-name}}">
	{{rich-text required=true name="region" tag="span" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter state/province/region', 'wordpress-seo-premium' ); ?>"}}
</div>
