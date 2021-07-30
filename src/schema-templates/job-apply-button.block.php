<?php
/**
 * Job apply button block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/job-apply-button" title="<?php \esc_attr_e( 'Job apply button', 'wordpress-seo-premium' ); ?>" category="yoast-recommended-job-blocks" description="<?php \esc_attr_e( 'A button through which visitors can apply for the job. (Make sure to add a link.)', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_cursor_click(); ?>" supports={"multiple": false} }}
<div class="yoast-job-block__apply-button {{class-name}}">
	{{link-button name="apply_button" placeholder="<?php \esc_attr_e( 'Apply button (add a link)', 'wordpress-seo-premium' ); ?>" }}
</div>
