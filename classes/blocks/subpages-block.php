<?php

namespace Yoast\WP\SEO\Integrations\Blocks;

use Yoast\WP\SEO\Models\Indexable;
use Yoast\WP\SEO\Presenters\Url_List_Presenter;
use Yoast\WP\SEO\Repositories\Indexable_Repository;

/**
 * Subpages block class
 */
class Subpages_Block extends Dynamic_Block {

	/**
	 * The name of the block.
	 *
	 * @var string
	 */
	protected $block_name = 'subpages';

	/**
	 * The editor script for the block.
	 *
	 * @var string
	 */
	protected $script = 'wp-seo-premium-dynamic-blocks';

	/**
	 * The indexable repository.
	 *
	 * @var Indexable_Repository
	 */
	private $indexable_repository;

	/**
	 * Subpages_Block constructor.
	 *
	 * @param Indexable_Repository $indexable_repository The indexable repository.
	 */
	public function __construct( Indexable_Repository $indexable_repository ) {
		$this->indexable_repository = $indexable_repository;
	}

	/**
	 * Presents the block output.
	 *
	 * @param array $attributes The block attributes.
	 *
	 * @return string The block output.
	 */
	public function present( $attributes ) {
		$indexables = $this->indexable_repository->get_subpages_by_post_parent( \get_the_ID() );

		$links = \array_map(
			static function ( Indexable $indexable ) {
				return [
					'title'     => $indexable->breadcrumb_title,
					'permalink' => $indexable->permalink,
				];
			},
			$indexables
		);

		if ( empty( $links ) ) {
			return '';
		}

		$class_name = 'yoast-url-list';
		if ( ! empty( $attributes['className'] ) ) {
			$class_name .= ' ' . \esc_attr( $attributes['className'] );
		}

		$presenter = new Url_List_Presenter( $links, $class_name );

		return $presenter->present();
	}
}
