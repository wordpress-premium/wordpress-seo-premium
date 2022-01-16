<?php

namespace Yoast\WP\SEO\Models;

use Yoast\WP\Lib\Model;

/**
 * Table definition for the Prominent Words table.
 *
 * @property int    $id                 The unique ID of this prominent word.
 * @property string $stem               The stem of the prominent word.
 * @property int    $indexable_id       The ID of the indexable in which the prominent word is located.
 * @property float  $weight             Currently just the nr. of occurrences (of stemmed prominent word in indexable) But could be any weight value (higher means that it carries more weight in the final calculation).
 */
class Prominent_Words extends Model {

	/**
	 * Which columns contain float values.
	 *
	 * @var array
	 */
	protected $float_columns = [
		'weight',
	];
}
