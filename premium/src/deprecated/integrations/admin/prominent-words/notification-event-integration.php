<?php

namespace Yoast\WP\SEO\Integrations\Admin\Prominent_Words;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Integrations\Admin\Prominent_Words_Notification;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Integration for the prominent words notification event used in the cron job.
 *
 * @deprecated 15.1
 * @codeCoverageIgnore
 */
class Notification_Event_Integration implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Notification_Event_Integration constructor.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @param Prominent_Words_Notification $prominent_words_notification The prominent words notification integration.
	 */
	public function __construct( Prominent_Words_Notification $prominent_words_notification ) {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}

	/**
	 * Initializes the integration by registering the right hooks and filters.
	 *
	 * @deprecated 15.1
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		\_deprecated_function( __METHOD__, 'WPSEO 15.1' );
	}
}
