<?php

namespace Yoast\WP\SEO\Premium\Presenters\Icons;

/**
 * A checkmark icon.
 */
class Checkmark_Icon_Presenter extends Icon_Presenter {

	/**
	 * Returns the path of the icon.
	 *
	 * @return string The path of the icon.
	 */
	public function get_path() {
		return "<path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7' />";
	}
}
