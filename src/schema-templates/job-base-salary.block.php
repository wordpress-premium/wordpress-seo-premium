<?php
/**
 * Job base salary block schema template.
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
{{block name="yoast/job-base-salary" title="<?php esc_attr_e( 'Base salary', 'wordpress-seo-premium' ); ?>" category="common" description="<?php esc_attr_e( 'The base salary of the job.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_currency_dollar(); ?>" parent=[ "yoast/job-salary" ] supports={"multiple": false} }}
<div class="yoast-job-block__salary {{class-name}}">
	<div>
		{{rich-text name="title" tag="strong" keepPlaceholderOnFocus=true default="<?php esc_attr_e( 'Base salary', 'wordpress-seo-premium' ); ?>"}}
	</div>
	<div class="yoast-schema-flex">
		{{currency-select name="currency" hideLabelFromVision=true label="<?php esc_attr_e( 'Currency', 'wordpress-seo-premium' ); ?>" className="yoast-schema-select"}}&nbsp;
		{{text-input name="value" type="number" hideLabelFromVision=true placeholder="<?php esc_attr_e( 'Enter amount', 'wordpress-seo-premium' ); ?>" label="<?php esc_attr_e( 'Value', 'wordpress-seo-premium' ); ?>" }}
		&nbsp;/&nbsp;{{select name="unit" label="<?php esc_attr_e( 'Unit', 'wordpress-seo-premium' ); ?>" hideLabelFromVision=true className="yoast-schema-select" options=<?php echo \wp_json_encode( $wpseo_time_unit_options ); ?> defaultValue="MONTH"}}
	</div>
</div>
