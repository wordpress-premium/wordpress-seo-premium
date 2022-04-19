<?php

namespace Yoast\WP\SEO\Presenters\Admin\Prominent_Words;

use Yoast\WP\SEO\Presenters\Abstract_Presenter;

/**
 * Represents the list item presenter for the prominent words indexing.
 *
 * @deprecated 15.1
 * @codeCoverageIgnore
 *
 * @package Yoast\WP\SEO\Presentations\Admin
 */
class Indexation_List_Item_Presenter extends Abstract_Presenter {

	/**
	 * Prominent_Words_Indexation_List_Item_Presenter constructor.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @param int $total_unindexed The number of objects that need to be indexed.
	 */
	public function __construct( $total_unindexed ) {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}

	/**
	 * Returns the output as string.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @return string The output.
	 */
	public function present() {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
		return '';
	}
}
