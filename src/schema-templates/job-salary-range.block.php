<?php
/**
 * Job salary range block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

$wpseo_time_unit_options = [
	[
		'value' => 'HOUR',
		'label' => __( 'hour', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'DAY',
		'label' => __( 'day', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'WEEK',
		'label' => __( 'week', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'MONTH',
		'label' => __( 'month', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'YEAR',
		'label' => __( 'year', 'wordpress-seo-premium' ),
	],
];

// phpcs:disable Yoast.Yoast.AlternativeFunctions.json_encode_wp_json_encode -- We do not want any pretty printing, since it would break the schema blocks.
// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-salary-range" title="<?php esc_attr_e( 'Salary range', 'wordpress-seo-premium' ); ?>" category="common" description="<?php esc_attr_e( 'The salary range of the job, depending on a variety of factors (e.g. education level or level of experience).', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_switch_horizontal(); ?>" parent=[ "yoast/job-salary" ] supports={"multiple": false} }}
<div class="yoast-job-block__salary {{class-name}}">
	<div class="yoast-schema-flex">
		{{currency-select name="currency" hideLabelFromVision=true label="<?php esc_attr_e( 'Currency', 'wordpress-seo-premium' ); ?>" className="yoast-schema-select"}}
		&nbsp;{{text-input name="minValue" type="number" hideLabelFromVision=true placeholder="<?php esc_attr_e( 'Enter amount', 'wordpress-seo-premium' ); ?>" label="<?php esc_attr_e( 'Min value', 'wordpress-seo-premium' ); ?>" }}
		&nbsp;-&nbsp;
		{{text-input name="maxValue" type="number" hideLabelFromVision=true placeholder="<?php esc_attr_e( 'Enter amount', 'wordpress-seo-premium' ); ?>" label="<?php esc_attr_e( 'Max value', 'wordpress-seo-premium' ); ?>" }}
		&nbsp;/&nbsp;
		{{select name="unit" label="<?php esc_attr_e( 'Unit', 'wordpress-seo-premium' ); ?>" hideLabelFromVision=true className="yoast-schema-select" options=<?php echo wp_json_encode( $wpseo_time_unit_options ); ?> defaultValue="MONTH"}}
	</div>
</div>
