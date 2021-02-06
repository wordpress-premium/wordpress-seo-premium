<?php

namespace Yoast\WP\SEO\Integrations\Blocks;

/**
 * Estimated_Reading_Time_Block class.
 */
class Estimated_Reading_Time_Block extends Dynamic_Block {

	/**
	 * The name of the block.
	 *
	 * @var string
	 */
	protected $block_name = 'estimated-reading-time';

	/**
	 * The editor script for the block.
	 *
	 * @var string
	 */
	protected $script = 'wp-seo-premium-dynamic-blocks';

	/**
	 * Registers the block.
	 *
	 * @return void
	 */
	public function register_block() {
		\register_block_type(
			'yoast-seo/' . $this->block_name,
			[
				'editor_script'   => $this->script,
				'render_callback' => [ $this, 'present' ],
				'attributes'      => [
					'className'            => [
						'default' => '',
						'type'    => 'string',
					],
					'estimatedReadingTime' => [
						'type'    => 'number',
						'default' => 0,
					],
					'descriptiveText'      => [
						'type'    => 'string',
						'default' => __( 'Estimated reading time:', 'wordpress-seo-premium' ) . ' ',
					],
					'showDescriptiveText'  => [
						'type'    => 'boolean',
						'default' => true,
					],
					'showIcon'             => [
						'type'    => 'boolean',
						'default' => true,
					],
				],
			]
		);
	}

	/**
	 * Presents the block output.
	 *
	 * @param array  $attributes The block attributes.
	 * @param string $content    The content.
	 *
	 * @return string The block output.
	 */
	public function present( $attributes, $content = '' ) {
		if ( $attributes['showIcon'] ) {
			return \preg_replace(
				'/ICON_PLACEHOLDER/',
				'<span class="yoast-reading-time__icon"><svg aria-hidden="true" focusable="false" data-icon="clock" width="20" height="20" fill="none" stroke="currentColor" style="display:inline-block;vertical-align:-0.1em" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span><span class="yoast-reading-time__spacer" style="display:inline-block;width:1em"></span>',
				$content,
				1
			);
		}

		return $content;
	}
}
