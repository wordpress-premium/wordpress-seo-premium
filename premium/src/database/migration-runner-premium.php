<?php

namespace Yoast\WP\SEO\Database;

use Exception;
use Yoast\WP\SEO\Initializers\Migration_Runner;

/**
 * Triggers premium database migrations and handles results.
 */
class Migration_Runner_Premium extends Migration_Runner {

	/**
	 * Runs this initializer.
	 *
	 * @inheritDoc
	 */
	public function initialize() {
		$this->run_premium_migrations();

		// The below action is used when queries fail, this may happen in a multisite environment when switch_to_blog is used.
		\add_action( '_yoast_run_migrations', [ $this, 'run_premium_migrations' ] );
	}

	/**
	 * Runs the Premium migrations.
	 *
	 * @return void
	 *
	 * @throws Exception When a migration errored.
	 */
	public function run_premium_migrations() {
		$this->run_migrations( 'premium' );
	}
}
