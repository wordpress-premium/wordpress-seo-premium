<?php
/**
 * Job employment type block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

$wpseo_employment_type_options = [
	[
		'value' => 'FULL_TIME',
		'label' => \__( 'Full time', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'PART_TIME',
		'label' => \__( 'Part time', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'CONTRACTOR',
		'label' => \__( 'Contractor', 'wordpress-seo-premium' ),
	],
	[
		'value' => 'TEMPORARY',
		'label' => \__( 'Temporary', 'wordpress-seo-premium' ),
	],
];

// phpcs:disable Yoast.Yoast.AlternativeFunctions.json_encode_wp_json_encode -- We do not want any pretty printing, since it would break the schema blocks.
// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-employment-type" title="<?php \esc_attr_e( 'Job employment type', 'wordpress-seo-premium' ); ?>" category="yoast-recommended-job-blocks" description="<?php \esc_attr_e( 'The type of employment (e.g. full-time, part-time, contract, temporary, seasonal, internship).', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_document_text(); ?>" supports={"multiple": false} }}
<div class="yoast-job-block__employment {{class-name}}">
	<div>
		{{select tag="span" name="employmentType" label="<?php \esc_attr_e( 'Employment', 'wordpress-seo-premium' ); ?>" options=<?php echo \wp_json_encode( $wpseo_employment_type_options ); ?> hideLabelFromVision=true }}
		{{sidebar-checkbox name="isInternship" label="<?php \esc_attr_e( 'This is an internship', 'wordpress-seo-premium' ); ?>" output=", <?php \esc_attr_e( 'this is an internship', 'wordpress-seo-premium' ); ?>" }}
		{{sidebar-checkbox name="isVolunteer" label="<?php \esc_attr_e( 'This is a volunteer role', 'wordpress-seo-premium' ); ?>" output=", <?php \esc_attr_e( 'this is a volunteer role', 'wordpress-seo-premium' ); ?>" }}
	</div>
</div>
