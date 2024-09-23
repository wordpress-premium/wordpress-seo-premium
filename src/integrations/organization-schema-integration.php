<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use Yoast\WP\SEO\Conditionals\Front_End_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Integration to add organization details to the Schema.
 */
class Organization_Schema_Integration implements Integration_Interface {

	/**
	 * Constant holding the mapping between database option and actual schema name.
	 */
	public const ORGANIZATION_DETAILS_MAPPING = [
		'org-description'      => 'description',
		'org-email'            => 'email',
		'org-phone'            => 'telephone',
		'org-legal-name'       => 'legalName',
		'org-founding-date'    => 'foundingDate',
		'org-number-employees' => 'numberOfEmployees',
		'org-vat-id'           => 'vatID',
		'org-tax-id'           => 'taxID',
		'org-iso'              => 'iso6523Code',
		'org-duns'             => 'duns',
		'org-leicode'          => 'leiCode',
		'org-naics'            => 'naics',
	];

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * Returns the conditionals based on which this loadable should be active.
	 *
	 * @return array<object> The conditionals to check.
	 */
	public static function get_conditionals() {
		return [ Front_End_Conditional::class ];
	}

	/**
	 * Organization_Schema_Integration constructor.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct(
		Options_Helper $options_helper
	) {
		$this->options_helper = $options_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_schema_organization', [ $this, 'filter_organization_schema' ] );
	}

	/**
	 * Filters the organization schema.
	 *
	 * @param array<string,array<string|int>> $profiles The organization schema data.
	 * @return array<string,array<string|int>> The filtered organization schema data.
	 */
	public function filter_organization_schema( $profiles ) {
		$options = [];
		$exclude = [ 'org-number-employees' ];
		if ( \defined( 'WPSEO_LOCAL_FILE' ) ) {
			\array_push( $exclude, 'org-vat-id', 'org-tax-id', 'org-phone', 'org-email' );
		}
		foreach ( self::ORGANIZATION_DETAILS_MAPPING as $option_name => $schema_name ) {
			$options[ $option_name ] = $this->options_helper->get( $option_name );
			if ( $options[ $option_name ] && ! \in_array( $option_name, $exclude, true ) ) {
				$profiles[ $schema_name ] = $options[ $option_name ];
			}
		}

		$profiles = $this->add_employees_number( $profiles, $options['org-number-employees'] );

		return $profiles;
	}

	/**
	 * Adds employees number to the organization schema tree.
	 *
	 * @param array<string,array<string|int>> $profiles  The organization schema tree.
	 * @param array<string,array<string|int>> $employees The option for employees number.
	 * @return array<string,array<string|int>> The modified organization schema tree.
	 */
	public function add_employees_number( $profiles, $employees ) {
		if ( ! $employees ) {
			return $profiles;
		}

		$profiles['numberOfEmployees'] = [
			'@type' => 'QuantitativeValue',
		];

		$range = \explode( '-', $employees );

		if ( \count( $range ) === 2 ) {
			$profiles['numberOfEmployees']['minValue'] = $range[0];
			$profiles['numberOfEmployees']['maxValue'] = $range[1];
		}
		else {
			$profiles['numberOfEmployees']['value'] = $employees;
		}

		return $profiles;
	}
}
