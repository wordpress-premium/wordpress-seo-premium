<?php

namespace Yoast\WP\SEO\Premium\Config;

use Yoast\WP\SEO\Config\Badge_Group_Names as New_Badge_Group_Names;

/**
 * Class Badge_Group_Names.
 *
 * This class defines groups for "new" badges, with the version in which those groups are no longer considered
 * to be "new".
 */
class Badge_Group_Names extends New_Badge_Group_Names {

	const GROUP_GLOBAL_TEMPLATES = 'global-templates';

	/**
	 * Constant describing when certain groups of new badges will no longer be shown.
	 */
	const GROUP_NAMES = [
		self::GROUP_GLOBAL_TEMPLATES => '16.5-beta0',
	];

	/**
	 * Badge_Group_Names constructor.
	 *
	 * @param string|null $version Optional. The current version number.
	 */
	public function __construct( $version = null ) {
		parent::__construct( $version );

		if ( ! $version ) {
			$version = \WPSEO_PREMIUM_VERSION;
		}
		$this->version = $version;
	}
}
