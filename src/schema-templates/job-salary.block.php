<?php
/**
 * Job salary block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-salary" title="<?php esc_attr_e( 'Job base salary', 'wordpress-seo-premium' ); ?>" category="yoast-recommended-job-blocks" description="<?php esc_attr_e( 'The base salary of the job.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_currency_dollar(); ?>" supports={"multiple": false} }}
<div class={{class-name}}>
	{{variation name="base-salary" title="<?php esc_attr_e( 'Base salary', 'wordpress-seo-premium' ); ?>" description="<?php esc_attr_e( 'The base salary of the job.', 'wordpress-seo-premium' ); ?>" scope=[ "block" ] icon="<?php echo Icons::heroicons_currency_dollar( Icons::SIZE_VARIATION ); ?>" innerBlocks=[ { "name": "yoast/job-base-salary" }] }}
	{{variation name="salary-range" title="<?php esc_attr_e( 'Salary range', 'wordpress-seo-premium' ); ?>" description="<?php esc_attr_e( 'The salary range of the job, depending on a variety of factors (e.g. a candidate\'s education level or level of experience).', 'wordpress-seo-premium' ); ?>" scope=[ "block" ] icon="<?php echo Icons::heroicons_switch_horizontal( Icons::SIZE_VARIATION ); ?>" innerBlocks=[ { "name": "yoast/job-salary-range" } ]}}
	{{inner-blocks appender=false}}
	{{variation-picker}}
</div>
