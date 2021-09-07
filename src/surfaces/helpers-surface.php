<?php

namespace Yoast\WP\SEO\Premium\Surfaces;

use Yoast\WP\SEO\Premium\Helpers;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Helpers_Surface.
 *
 * Surface for the helpers.
 *
 * @property Helpers\Prominent_Words_Helper $prominent_words
 * @property Helpers\Zapier_Helper          $zapier
 */
class Helpers_Surface {

	/**
	 * The DI container.
	 *
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * Loader constructor.
	 *
	 * @param ContainerInterface $container The dependency injection container.
	 */
	public function __construct( ContainerInterface $container ) {
		$this->container = $container;
	}

	/**
	 * Magic getter for getting helper classes.
	 *
	 * @param string $helper The helper to get.
	 *
	 * @return mixed The helper class.
	 */
	public function __get( $helper ) {
		$helper = \implode( '_', \array_map( 'ucfirst', \explode( '_', $helper ) ) );
		$class  = "Yoast\WP\SEO\Premium\Helpers\\{$helper}_Helper";
		return $this->container->get( $class );
	}
}
