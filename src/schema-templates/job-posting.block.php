<?php
/**
 * Job posting block schema template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

/* translators: %1$s expands to Yoast */
$yoast_seo_block_title = sprintf( __( '%1$s Job posting', 'wordpress-seo-premium' ), 'Yoast' );

$yoast_seo_block_template = [
	[ 'yoast/job-title' ],
	[ 'yoast/job-expiration' ],
	[ 'yoast/job-employment-type' ],
	[ 'yoast/job-salary' ],
	[ 'core/separator' ],
	[ 'yoast/job-description' ],
	[ 'yoast/job-requirements' ],
	[ 'yoast/job-benefits' ],
	[ 'yoast/job-location' ],
	[ 'core/separator' ],
	[ 'core/buttons', [ 'template' => [ 'core/button' ] ] ],
];

$yoast_seo_required_blocks = [
	[ 'name' => 'yoast/job-title' ],
	[ 'name' => 'yoast/job-description' ],
	[ 'name' => 'yoast/job-location' ],
];

$yoast_seo_recommended_blocks = [
	[ 'name' => 'yoast/job-expiration' ],
	[ 'name' => 'yoast/job-employment-type' ],
	[ 'name' => 'yoast/job-salary' ],
	[ 'name' => 'yoast/job-requirements' ],
	[ 'name' => 'yoast/job-benefits' ],
];

$yoast_seo_block_example = [
	'innerBlocks' => [
		[
			'name'       => 'yoast/job-title',
			'attributes' => [
				'title'  => esc_html__( 'Job title', 'wordpress-seo-premium' ),
			],
		],
		[
			'name'       => 'yoast/job-expiration',
			'attributes' => [
				'expirationDate' => gmdate( 'Y-m-d', strtotime( '+30days' ) ),
			],
		],
		[
			'name'       => 'yoast/job-description',
			'attributes' => [
				'description' => esc_html__( 'This is the job description.', 'wordpress-seo-premium' ),
			],
		],
		[
			'name'       => 'yoast/job-requirements',
			'attributes' => [
				'requirements' => str_repeat( '<li>' . esc_html__( 'Enter requirement', 'wordpress-seo-premium' ) . '</li>', 3 ),
			],
		],
		[
			'name'       => 'yoast/job-benefits',
			'attributes' => [
				'benefits' => str_repeat( '<li>' . esc_html__( 'Enter benefit', 'wordpress-seo-premium' ) . '</li>', 3 ),
			],
		],
	],
];

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: WPSEO_Utils::format_json_encode is safe.
?>
{{block name="yoast/job-posting" example=<?php echo WPSEO_Utils::format_json_encode( $yoast_seo_block_example ); ?> title="<?php echo esc_attr( $yoast_seo_block_title ); ?>" keywords=[ "SEO", "Schema"] description="<?php esc_attr_e( 'Create a Job Posting in an SEO-friendly way. You can only use one Job Posting block per post.', 'wordpress-seo-premium' ); ?>" icon="portfolio" category="yoast-structured-data-blocks" supports={"multiple": false} }}
{{sidebar-input name="minimum-hours" output=false type="number" label="<?php esc_attr_e( 'Minimum hours', 'wordpress-seo-premium' ); ?>" }}
{{sidebar-input name="maximum-hours" output=false type="number" label="<?php esc_attr_e( 'Maximum hours', 'wordpress-seo-premium' ); ?>" }}
<div class={{class-name}}>
	{{inner-blocks appender="button" template=<?php echo WPSEO_Utils::format_json_encode( $yoast_seo_block_template ); ?> required-blocks=<?php echo WPSEO_Utils::format_json_encode( $yoast_seo_required_blocks ); ?> recommended-blocks=<?php echo WPSEO_Utils::format_json_encode( $yoast_seo_recommended_blocks ); ?> appenderLabel="<?php esc_attr_e( 'Add a block to your job posting...', 'wordpress-seo-premium' ); ?>" }}
</div>
