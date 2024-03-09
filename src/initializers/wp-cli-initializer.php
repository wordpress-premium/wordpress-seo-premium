<?php

namespace Yoast\WP\SEO\Premium\Initializers;

use WP_CLI;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Initializers\Initializer_Interface;

/**
 * Wp_Cli_Initializer class
 */
class Wp_Cli_Initializer implements Initializer_Interface {

	use No_Conditionals;

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( \defined( 'WP_CLI' ) && \WP_CLI ) {
			\add_action( 'plugins_loaded', [ $this, 'wpseo_cli_init' ], 20 );
		}
	}

	/**
	 * Initialize the WP-CLI integration.
	 *
	 * The WP-CLI integration needs PHP 5.3 support, which should be automatically
	 * enforced by the check for the WP_CLI constant. As WP-CLI itself only runs
	 * on PHP 5.3+, the constant should only be set when requirements are met.
	 *
	 * @return void
	 */
	public function wpseo_cli_init() {
		WP_CLI::add_command(
			'yoast redirect list',
			'WPSEO_CLI_Redirect_List_Command',
			[ 'before_invoke' => 'WPSEO_CLI_Premium_Requirement::enforce' ]
		);

		WP_CLI::add_command(
			'yoast redirect create',
			'WPSEO_CLI_Redirect_Create_Command',
			[ 'before_invoke' => 'WPSEO_CLI_Premium_Requirement::enforce' ]
		);

		WP_CLI::add_command(
			'yoast redirect update',
			'WPSEO_CLI_Redirect_Update_Command',
			[ 'before_invoke' => 'WPSEO_CLI_Premium_Requirement::enforce' ]
		);

		WP_CLI::add_command(
			'yoast redirect delete',
			'WPSEO_CLI_Redirect_Delete_Command',
			[ 'before_invoke' => 'WPSEO_CLI_Premium_Requirement::enforce' ]
		);

		WP_CLI::add_command(
			'yoast redirect has',
			'WPSEO_CLI_Redirect_Has_Command',
			[ 'before_invoke' => 'WPSEO_CLI_Premium_Requirement::enforce' ]
		);

		WP_CLI::add_command(
			'yoast redirect follow',
			'WPSEO_CLI_Redirect_Follow_Command',
			[ 'before_invoke' => 'WPSEO_CLI_Premium_Requirement::enforce' ]
		);
	}
}
