<?php
/**
 * Job location block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-location" title="<?php \esc_attr_e( 'Job location', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" description="<?php \esc_attr_e( 'The (typically single) geographic location associated with the job.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_location_marker(); ?>" supports={"multiple": false} }}
<div class={{class-name}}>
	{{variation name="office-location" title="<?php \esc_attr_e( 'Office location', 'wordpress-seo-premium' ); ?>" description="<?php \esc_attr_e( 'Address where the office is located', 'wordpress-seo-premium' ); ?>" scope=[ "block" ] icon="<?php echo Icons::heroicons_office_building( Icons::SIZE_VARIATION ); ?>" innerBlocks=[ { "name": "yoast/office-location", "attributes": { "address-title": "<?php \esc_attr_e( 'Address', 'wordpress-seo-premium' ); ?>", "postal-code-title": "<?php \esc_attr_e( 'Postal code', 'wordpress-seo-premium' ); ?>", "city-title": "<?php \esc_attr_e( 'City', 'wordpress-seo-premium' ); ?>", "region-title": "<?php \esc_attr_e( 'Region', 'wordpress-seo-premium' ); ?>", "country-title": "<?php \esc_attr_e( 'Country', 'wordpress-seo-premium' ); ?>" } }] }}
	{{variation name="remote-location" title="<?php \esc_attr_e( 'Remote job', 'wordpress-seo-premium' ); ?>" description="<?php \esc_attr_e( 'This job is 100% remote', 'wordpress-seo-premium' ); ?>" scope=[ "block" ] icon="<?php echo Icons::heroicons_globe( Icons::SIZE_VARIATION ); ?>" innerBlocks=[ { "name": "yoast/remote-location" } ]}}
	{{inner-blocks appender=false}}
	{{variation-picker required=true}}
</div>
