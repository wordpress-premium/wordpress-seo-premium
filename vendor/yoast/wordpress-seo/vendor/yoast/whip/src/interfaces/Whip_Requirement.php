<?php
/**
 * WHIP libary file.
 *
 * @package Yoast\WHIP
 */

/**
 * Interface Whip_Requirement.
 */
interface Whip_Requirement {

	/**
	 * Retrieves the component name defined for the requirement.
	 *
	 * @return string The component name.
	 */
	public function component();
}
