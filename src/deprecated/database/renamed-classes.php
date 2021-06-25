<?php
/**
 * Graceful deprecation of various classes which were renamed.
 *
 * {@internal As this file is just (temporarily) put in place to warn extending
 * plugins about the class name changes, it is exempt from select CS standards.}
 *
 * @package Yoast\WP\SEO\Premium
 *
 * @since      16.3
 * @deprecated 16.3
 *
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound
 * @phpcs:disable Yoast.Commenting.CodeCoverageIgnoreDeprecated
 * @phpcs:disable Yoast.Commenting.FileComment.Unnecessary
 * @phpcs:disable Yoast.Files.FileName.InvalidClassFileName
 */

namespace Yoast\WP\SEO\Database;

use Yoast\WP\Lib\Migrations\Adapter;
use Yoast\WP\SEO\Config\Migration_Status;
use Yoast\WP\SEO\Loader;
use Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium as New_Migration_Runner_Premium;

\_deprecated_file( \basename( __FILE__ ), 'Yoast SEO Premium 16.3' );

/**
 * Class Migration_Runner_Premium.
 *
 * @deprecated 16.3 Use {@see \Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium} instead.
 */
class Migration_Runner_Premium extends New_Migration_Runner_Premium {

	/**
	 * Class constructor.
	 *
	 * @param Migration_Status $migration_status The migration status.
	 * @param Loader           $loader           The loader.
	 * @param Adapter          $adapter          The migrations adapter.
	 *
	 * @deprecated 16.3 Use {@see \Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium} instead.
	 */
	public function __construct(
		Migration_Status $migration_status,
		Loader $loader,
		Adapter $adapter
	) {
		\_deprecated_function( __METHOD__, 'Yoast SEO Premium 16.3', '\Yoast\WP\SEO\Premium\Database\Migration_Runner_Premium' );
		parent::__construct( $migration_status, $loader, $adapter );
	}
}
