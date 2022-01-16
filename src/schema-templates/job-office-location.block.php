<?php
/**
 * Job office location block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

$yoast_seo_block_template = [
	[ 'yoast/job-location-address' ],
	[ 'yoast/job-location-postal-code' ],
	[ 'yoast/job-location-city' ],
	[ 'yoast/job-location-region' ],
	[ 'yoast/job-location-country' ],
];

$yoast_seo_required_blocks = [
	[ 'name' => 'yoast/job-location-address' ],
	[ 'name' => 'yoast/job-location-postal-code' ],
	[ 'name' => 'yoast/job-location-city' ],
	[ 'name' => 'yoast/job-location-region' ],
	[ 'name' => 'yoast/job-location-country' ],
];

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/office-location" title="<?php esc_attr_e( 'Office location', 'wordpress-seo-premium' ); ?>" category="common" description="<?php esc_attr_e( 'The address where the office is located.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_office_building(); ?>" parent=[ "yoast/job-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location {{class-name}}">
	{{inner-blocks template=<?php echo WPSEO_Utils::format_json_encode( $yoast_seo_block_template ); ?> appender="button" appenderLabel="<?php esc_attr_e( 'Add additional information to your location details...', 'wordpress-seo-premium' ); ?>" }}
</div>
