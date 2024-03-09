<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use Yoast\WP\SEO\Actions\Indexing\Indexation_Action_Interface;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Premium\Actions\Prominent_Words\Content_Action;

/**
 * Adds prominent words to the missing indexables bucket.
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Missing_Indexables_Count_Integration implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The content indexable action.
	 *
	 * @var Content_Action
	 */
	private $content_action;

	/**
	 * The constructor.
	 *
	 * @param Content_Action $content_action The action.
	 */
	public function __construct( Content_Action $content_action ) {
		$this->content_action = $content_action;
	}

	/**
	 * Registers hooks with WordPress.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_indexable_collector_add_indexation_actions', [ $this, 'add_index_action' ] );
	}

	/**
	 * Adds the Content_Action to the indexable collector.
	 *
	 * @param array<Indexation_Action_Interface> $indexation_actions The current indexation actions.
	 * @return array<Indexation_Action_Interface>
	 */
	public function add_index_action( $indexation_actions ) {
		$indexation_actions[] = $this->content_action;
		return $indexation_actions;
	}
}
