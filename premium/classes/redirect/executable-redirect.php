<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirects
 */

/**
 * Represents an executable redirect.
 */
final class WPSEO_Executable_Redirect {

	/**
	 * Redirect origin.
	 *
	 * @var string
	 */
	private $origin;

	/**
	 * Redirect target.
	 *
	 * @var string
	 */
	private $target;

	/**
	 * A HTTP code determining the redirect type.
	 *
	 * @var int
	 */
	private $type;

	/**
	 * A string determining the redirect format (plain or regex).
	 *
	 * @var string
	 */
	private $format;

	/**
	 * WPSEO_Redirect constructor.
	 *
	 * @param string $origin The origin of the redirect.
	 * @param string $target The target of the redirect.
	 * @param int    $type   The type of the redirect.
	 * @param string $format The format of the redirect.
	 *
	 * @codeCoverageIgnore
	 */
	public function __construct( $origin, $target, $type, $format ) {
		$this->origin = $origin;
		$this->target = $target;
		$this->type   = $type;
		$this->format = $format;
	}

	/**
	 * Creates an instance based on the given data.
	 *
	 * @param array $data The redirect data.
	 *
	 * @return WPSEO_Executable_Redirect The created object.
	 */
	public static function from_array( $data ) {
		return new self( $data['origin'], $data['target'], $data['type'], $data['format'] );
	}

	/**
	 * Retrieves the origin.
	 *
	 * @return string The origin.
	 */
	public function get_origin() {
		return $this->origin;
	}

	/**
	 * Retrieves the target.
	 *
	 * @return string The target.
	 */
	public function get_target() {
		return $this->target;
	}

	/**
	 * Retrieves the type.
	 *
	 * @return int The redirect type.
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Retrieves the redirect format.
	 *
	 * @return string The redirect format.
	 */
	public function get_format() {
		return $this->format;
	}
}
