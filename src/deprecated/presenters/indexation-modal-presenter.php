<?php

namespace Yoast\WP\SEO\Presenters\Admin\Prominent_Words;

use Yoast\WP\SEO\Presenters\Abstract_Presenter;

/**
 * Class Indexation_Modal_Presenter.
 *
 * @deprecated 15.1
 * @codeCoverageIgnore
 */
class Indexation_Modal_Presenter extends Abstract_Presenter {

	/**
	 * Indexation_Modal constructor.
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
	 * Presents the modal.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @return string The modal HTML.
	 */
	public function present() {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
		return '';
	}
}
