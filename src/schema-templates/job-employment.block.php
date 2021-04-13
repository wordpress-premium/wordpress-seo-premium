<?php
/**
 * Job employment block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

$wpseo_employment_type_options = [
	[
		'value' => 'FULL_TIME',
		'label' => __( 'Full time', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'PART_TIME',
		'label' => __( 'Part time', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'CONTRACTOR',
		'label' => __( 'Contractor', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'TEMPORARY',
		'label' => __( 'Temporary', 'wordpress-seo-premium' ),
	],
];

// phpcs:disable Yoast.Yoast.AlternativeFunctions.json_encode_wp_json_encode -- We do not want any pretty printing, since it would break the schema blocks.
?>
{{block name="yoast/job-employment-type" title="<?php esc_attr_e( 'Employment', 'wordpress-seo-premium' ); ?>" category="common" parent=[ "yoast/job-posting" ] supports={"multiple": false} }}
<div class={{class-name}}>
	{{variable-tag-rich-text name="title" tags=[ "h3", "h2", "h4", "h5", "h6", "strong" ] default="<?php esc_attr_e( 'Employment', 'wordpress-seo-premium' ); ?>" }}
	{{select name="employmentType" label="<?php esc_attr_e( 'Employment', 'wordpress-seo-premium' ); ?>" options=<?php echo \wp_json_encode( $wpseo_employment_type_options ); ?> hideLabelFromVision=true }}
	{{sidebar-checkbox name="isInternship" label="<?php esc_attr_e( 'This is an internship', 'wordpress-seo-premium' ); ?>" output=", <?php esc_attr_e( 'this is an internship', 'wordpress-seo-premium' ); ?>" }}
	{{sidebar-checkbox name="isVolunteer" label="<?php esc_attr_e( 'This is a volunteer role', 'wordpress-seo-premium' ); ?>" output=", <?php esc_attr_e( 'this is a volunteer role', 'wordpress-seo-premium' ); ?>" }}
</div>
{{inherit-sidebar parents=[ "yoast/job-posting" ] }}
