<?php
/**
 * Job remote location block template.
 *
 * @package Yoast\WP\SEO\Schema_Templates
 */

use Yoast\WP\SEO\Schema_Templates\Assets\Icons;

// phpcs:disable WordPress.Security.EscapeOutput -- Reason: The Icons contains safe svg.
?>
{{block name="yoast/remote-location" title="<?php \esc_attr_e( 'Remote job', 'wordpress-seo-premium' ); ?>" category="common" description="<?php \esc_attr_e( 'This job is 100% remote.', 'wordpress-seo-premium' ); ?>" icon="<?php echo Icons::heroicons_globe(); ?>" parent=[ "yoast/job-location" ] supports={"multiple": false} }}
<div class="yoast-job-block__location {{class-name}}">
	{{rich-text required=true tag="p" name="remote-location" default="<?php \esc_attr_e( 'This job is 100% remote.', 'wordpress-seo-premium' ); ?>"}}
</div>
