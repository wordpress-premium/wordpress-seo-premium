<?php

namespace Yoast\WP\SEO\Premium;

use Yoast\WP\Lib\Abstract_Main;
use Yoast\WP\SEO\Dependency_Injection\Container_Compiler;
use Yoast\WP\SEO\Premium\Generated\Cached_Container;
use Yoast\WP\SEO\Premium\Surfaces\Helpers_Surface;
use Yoast\WP\SEO\Surfaces\Classes_Surface;

/**
 * Main plugin class for premium.
 *
 * @property Classes_Surface $classes
 * @property Helpers_Surface $helpers
 */
class Main extends Abstract_Main {

	// @phpcs:disable Generic.Commenting.DocComment.MissingShort -- Short description is in the inherited comments.

	/**
	 * @inheritDoc
	 */
	protected function get_name() {
		return 'yoast-seo-premium';
	}

	/**
	 * @inheritDoc
	 */
	protected function get_container() {
		if (
			$this->is_development()
			&& \class_exists( '\Yoast\WP\SEO\Dependency_Injection\Container_Compiler' )
			&& \file_exists( __DIR__ . '/../config/dependency-injection/services.php' )
		) {
			// Exception here is unhandled as it will only occur in development.
			Container_Compiler::compile(
				$this->is_development(),
				__DIR__ . '/generated/container.php',
				__DIR__ . '/../config/dependency-injection/services.php',
				__DIR__ . '/../vendor/composer/autoload_classmap.php',
				'Yoast\WP\SEO\Premium\Generated'
			);
		}

		if ( \file_exists( __DIR__ . '/generated/container.php' ) ) {
			require_once __DIR__ . '/generated/container.php';

			return new Cached_Container();
		}

		return null;
	}

	/**
	 * @inheritDoc
	 */
	protected function get_surfaces() {
		return [
			'classes' => Classes_Surface::class,
			'helpers' => Helpers_Surface::class,
		];
	}
}
