<?php
/**
 * Job description block schema template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-description" title="<?php esc_attr_e( 'Job description', 'wordpress-seo-premium' ); ?>" category="yoast-required-job-blocks" description="<?php esc_attr_e( 'The description of the job.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_identification(); ?>" supports={"multiple": false} }}
<div class="yoast-job-block__description {{class-name}}">
	{{rich-text name="description" required=true tag="p" keepPlaceholderOnFocus=true placeholder="<?php esc_attr_e( 'Enter a job description...', 'wordpress-seo-premium' ); ?>"}}
</div>
