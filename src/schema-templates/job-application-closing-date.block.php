<?php
/**
 * Job application closing date block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-application-closing-date" title="<?php esc_attr_e( 'Job application closing date', 'wordpress-seo-premium' ); ?>" category="yoast-recommended-job-blocks" description="<?php esc_attr_e( 'The date after which the job posting is not valid anymore.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_ban(); ?>" supports={"multiple": false} }}
<div class="yoast-job-block__application-closing-date {{class-name}}">
	{{rich-text name="title" tag="span" default="<?php esc_attr_e( 'Apply before', 'wordpress-seo-premium' ); ?>"}}&nbsp;
	{{date name="closingDate" }}
</div>
