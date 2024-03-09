<?php

namespace Yoast\WP\SEO\Premium\Presenters\Icons;

use Yoast\WP\SEO\Presenters\Abstract_Presenter;

/**
 * Presents an icon.
 */
abstract class Icon_Presenter extends Abstract_Presenter {

	/**
	 * The start tag of an SVG element.
	 */
	public const SVG_START_TAG = "<svg xmlns='http://www.w3.org/2000/svg' fill='none' style='fill:none' viewBox='0 0 24 24' stroke='currentColor' height='%SIZE%' width='%SIZE%' >";

	/**
	 * The default height and width of an icon in pixels.
	 */
	public const SIZE_DEFAULT = 24;

	/**
	 * The size of the icon in pixels.
	 *
	 * @var int
	 */
	protected $size;

	/**
	 * Creates a new icon.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param int $size The size of the icon.
	 */
	public function __construct( $size ) {
		$this->size = $size;
	}

	/**
	 * Generates the SVG based on the given path.
	 *
	 * @param string $path     The path to generate SVG icon for.
	 * @param int    $svg_size The height and width of the SVG icon.
	 *
	 * @return string The generated icon svg.
	 */
	private static function svg( $path, $svg_size = self::SIZE_DEFAULT ) {
		$start = \str_replace( '%SIZE%', $svg_size, self::SVG_START_TAG );
		return $start . $path . '</svg>';
	}

	/**
	 * Returns the icon as a string.
	 *
	 * @return string The icon.
	 */
	public function present() {
		return self::svg( $this->get_path(), $this->get_size() );
	}

	/**
	 * Returns the size of the icon.
	 *
	 * @return int The size of the icon.
	 */
	public function get_size() {
		return $this->size;
	}

	/**
	 * Returns the path of the icon.
	 *
	 * @return string The path of the icon.
	 */
	abstract public function get_path();
}
