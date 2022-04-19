<?php
/**
 * Job location country block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contain safe svg.
?>
{{block name="yoast/job-location-country" title="<?php esc_attr_e( 'Job country', 'wordpress-seo-premium' ); ?>" description="<?php esc_attr_e( 'The country. For example, USA.', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" icon="<?php echo Icons::heroicons_grid(); ?>" description="<?php esc_attr_e( 'The country. For example, USA.', 'wordpress-seo-premium' ); ?>" parent=[ "yoast/office-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location__country {{class-name}}">
	{{rich-text required=true name="country" tag="span" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter country', 'wordpress-seo-premium' ); ?>"}}
</div>
