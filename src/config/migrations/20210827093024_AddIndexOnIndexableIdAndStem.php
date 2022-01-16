<?php

namespace Yoast\WP\SEO\Premium\Config\Migrations;

use Yoast\WP\Lib\Migrations\Migration;
use Yoast\WP\Lib\Model;

/**
 * AddIndexOnIndexableIdAndStem class.
 */
class AddIndexOnIndexableIdAndStem extends Migration {

	/**
	 * The plugin this migration belongs to.
	 *
	 * @var string
	 */
	public static $plugin = 'premium';

	/**
	 * The columns on which an index should be added.
	 *
	 * @var string[]
	 */
	protected $columns_with_index = [
		'indexable_id',
		'stem',
	];

	/**
	 * Migration up. Adds a combined index on 'indexable_id' and 'stem'.
	 *
	 * @return void
	 */
	public function up() {
		$table_name = $this->get_table_name();
		$adapter    = $this->get_adapter();

		if ( ! $adapter->has_table( $table_name ) ) {
			return;
		}

		// Create the index if it doesn't exist already.
		if ( ! $adapter->has_index( $table_name, $this->columns_with_index, [ 'name' => 'indexable_id_and_stem' ] ) ) {
			$this->add_index(
				$this->get_table_name(),
				$this->columns_with_index,
				[ 'name' => 'indexable_id_and_stem' ]
			);
		}
	}

	/**
	 * Migration down. Removes the combined index on 'indexable_id' and 'stem'.
	 *
	 * @return void
	 */
	public function down() {
		$table_name = $this->get_table_name();
		$adapter    = $this->get_adapter();

		if ( ! $adapter->has_table( $table_name ) ) {
			return;
		}

		// Remove the index if it exists.
		if ( $adapter->has_index( $table_name, $this->columns_with_index, [ 'name' => 'indexable_id_and_stem' ] ) ) {

			$this->remove_index(
				$this->get_table_name(),
				$this->columns_with_index,
				[ 'name' => 'indexable_id_and_stem' ]
			);
		}
	}

	/**
	 * Retrieves the table name to use for storing prominent words.
	 *
	 * @return string The table name to use.
	 */
	protected function get_table_name() {
		return Model::get_table_name( 'Prominent_Words' );
	}
}
