<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium
 */

// Mark this file as deprecated.
_deprecated_file( __FILE__, 'WPSEO Premium 14.5' );

/**
 * Handles adding site wide analysis UI to the WordPress admin.
 */
class WPSEO_Premium_Prominent_Words_Recalculation implements WPSEO_WordPress_Integration {

	/**
	 * Base height of the recalculation modal in pixels.
	 *
	 * @var int
	 */
	const MODAL_DIALOG_HEIGHT_BASE = 220;

	/**
	 * Height of the recalculation progressbar in pixels.
	 *
	 * @var int
	 */
	const PROGRESS_BAR_HEIGHT = 32;

	/**
	 * WPSEO_Premium_Prominent_Words_Recalculation constructor.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @param WPSEO_Premium_Prominent_Words_Support $prominent_words_support Unused. The prominent words support class to determine supported posts types to index.
	 */
	public function __construct( WPSEO_Premium_Prominent_Words_Support $prominent_words_support ) {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Registers all hooks to WordPress.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Adds an item on the tools page list.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function show_tools_overview_item() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Initialize the modal box to be displayed when needed.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function modal_box() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}

	/**
	 * Enqueues site wide analysis script.
	 *
	 * @deprecated 14.5
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function enqueue() {
		_deprecated_function( __METHOD__, 'WPSEO Premium 14.5' );
	}
}
