<?php

namespace Yoast\WP\SEO\Premium\Surfaces;

use Yoast\WP\SEO\Premium\Exceptions\Forbidden_Property_Mutation_Exception;
use Yoast\WP\SEO\Premium\Helpers;
use YoastSEO_Vendor\Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Helpers_Surface.
 *
 * Surface for the helpers.
 *
 * @property Helpers\Current_Page_Helper    $current_page
 * @property Helpers\Prominent_Words_Helper $prominent_words
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
		return $this->container->get( $this->get_helper_class( $helper ) );
	}

	/**
	 * Magic isset for ensuring helper exists.
	 *
	 * @param string $helper The helper to get.
	 *
	 * @return bool Whether the helper exists.
	 */
	public function __isset( $helper ) {
		return $this->container->has( $this->get_helper_class( $helper ) );
	}

	/**
	 * Prevents setting dynamic properties.
	 *
	 * @param string $name  The property name.
	 * @param mixed  $value The property value.
	 *
	 * @return void
	 *
	 * @throws Forbidden_Property_Mutation_Exception Set is never meant to be called.
	 */
	public function __set( $name, $value ) {
		throw Forbidden_Property_Mutation_Exception::cannot_set_because_property_is_immutable( $name );
	}

	/**
	 * Prevents unsetting dynamic properties.
	 *
	 * @param string $name The property name.
	 *
	 * @return void
	 *
	 * @throws Forbidden_Property_Mutation_Exception Unset is never meant to be called.
	 */
	public function __unset( $name ) {
		throw Forbidden_Property_Mutation_Exception::cannot_unset_because_property_is_immutable( $name );
	}

	/**
	 * Gets the classname for a premium helper.
	 *
	 * @param string $helper The name of the helper.
	 *
	 * @return string The classname of the helper
	 */
	protected function get_helper_class( $helper ) {
		$helper = \implode( '_', \array_map( 'ucfirst', \explode( '_', $helper ) ) );

		return "Yoast\WP\SEO\Premium\Helpers\\{$helper}_Helper";
	}
}
