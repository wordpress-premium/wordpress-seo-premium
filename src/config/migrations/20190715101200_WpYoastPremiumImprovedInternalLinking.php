<?php

namespace Yoast\WP\SEO\Config\Migrations;

use Yoast\WP\Lib\Migrations\Migration;
use Yoast\WP\Lib\Model;

/**
 * Class WpYoastPremiumImprovedInternalLinking
 *
 * @package Yoast\WP\SEO\Config\Migrations
 */
class WpYoastPremiumImprovedInternalLinking extends Migration {

	/**
	 * The plugin this migration belongs to.
	 *
	 * @var string
	 */
	public static $plugin = 'premium';

	/**
	 * Migration up.
	 */
	public function up() {
		$table_name = $this->get_table_name();
		$adapter    = $this->get_adapter();

		if ( ! $adapter->has_table( $table_name ) ) {
			$table = $this->create_table( $table_name );

			$table->column(
				'stem',
				'string',
				[
					'null'  => true,
					'limit' => 191,
				]
			);
			$table->column(
				'indexable_id',
				'integer',
				[
					'unsigned' => true,
					'null'     => true,
					'limit'    => 11,
				]
			);
			$table->column( 'weight', 'float' );

			$table->finish();
		}

		if ( ! $adapter->has_index( $table_name, 'stem', [ 'name' => 'stem' ] ) ) {
			$this->add_index(
				$table_name,
				[
					'stem',
				],
				[
					'name' => 'stem',
				]
			);
		}

		if ( ! $adapter->has_index( $table_name, 'indexable_id', [ 'name' => 'indexable_id' ] ) ) {
			$this->add_index(
				$table_name,
				[
					'indexable_id',
				],
				[
					'name' => 'indexable_id',
				]
			);
		}
	}

	/**
	 * Migration down.
	 */
	public function down() {
		$table_name = $this->get_table_name();
		if ( $this->get_adapter()->has_table( $table_name ) ) {
			$this->drop_table( $table_name );
		}
	}

	/**
	 * Retrieves the table name to use.
	 *
	 * @return string The table name to use.
	 */
	protected function get_table_name() {
		return Model::get_table_name( 'Prominent_Words' );
	}
}
