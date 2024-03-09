<?php

namespace Yoast\WP\SEO\Premium\Presenters\Icons;

/**
 * A cross icon.
 */
class Cross_Icon_Presenter extends Icon_Presenter {

	/**
	 * Returns the path of the icon.
	 *
	 * @return string The path of the icon.
	 */
	public function get_path() {
		return "<path stroke-linecap='round' stroke-linejoin='round' d='M6 18L18 6M6 6l12 12' />";
	}
}
