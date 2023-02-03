<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Class Whip_InvalidVersionMessage.
 */
class Whip_InvalidVersionRequirementMessage implements Whip_Message {

	/**
	 * Object containing the version requirement for a component.
	 *
	 * @var Whip_VersionRequirement
	 */
	private $requirement;

	/**
	 * Detected version requirement or -1 if not found.
	 *
	 * @var string|int
	 */
	private $detected;

	/**
	 * Whip_InvalidVersionRequirementMessage constructor.
	 *
	 * @param Whip_VersionRequirement $requirement Object containing the version requirement for a component.
	 * @param string|int              $detected    Detected version requirement or -1 if not found.
	 */
	public function __construct( Whip_VersionRequirement $requirement, $detected ) {
		$this->requirement = $requirement;
		$this->detected    = $detected;
	}

	/**
	 * Retrieves the message body.
	 *
	 * @return string Message.
	 */
	public function body() {
		return sprintf(
			'Invalid version detected for %s. Found %s but expected %s.',
			$this->requirement->component(),
			$this->detected,
			$this->requirement->version()
		);
	}
}
