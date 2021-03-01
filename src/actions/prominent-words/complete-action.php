<?php

namespace Yoast\WP\SEO\Actions\Prominent_Words;

use Yoast\WP\SEO\Helpers\Prominent_Words_Helper;

/**
 * Action for completing the prominent words indexing.
 *
 * @package Yoast\WP\SEO\Actions\Prominent_Words
 */
class Complete_Action {

	/**
	 * Represents the prominent words helper.
	 *
	 * @var Prominent_Words_Helper
	 */
	protected $prominent_words_helper;

	/**
	 * Complete_Action constructor.
	 *
	 * @param Prominent_Words_Helper $prominent_words_helper The prominent words helper.
	 */
	public function __construct( Prominent_Words_Helper $prominent_words_helper ) {
		$this->prominent_words_helper = $prominent_words_helper;
	}

	/**
	 * Sets the indexing state to complete.
	 */
	public function complete() {
		$this->prominent_words_helper->complete_indexing();
	}
}
