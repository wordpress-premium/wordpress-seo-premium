<?php

namespace Yoast\WP\SEO\Premium\Integrations\Admin;

use WP_User;
use Yoast\WP\SEO\Conditionals\Admin_Conditional;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Class User_Profile_Integration.
 *
 * This class deals with the interface for and the storing of user Schema fields. The output of these fields is done
 * by this class's sibling frontend integration. Note that the output is done "as is", so all the sanitization happens in
 * this class.
 */
class User_Profile_Integration implements Integration_Interface {

	const NONCE_FIELD_ACTION = 'show_user_profile';
	const NONCE_FIELD_NAME   = 'wpseo_premium_user_profile_schema_nonce';

	/**
	 * Holds the schema fields we're adding to the user profile.
	 *
	 * @var array
	 */
	private $fields;

	/**
	 * User_Profile_Integration constructor.
	 */
	public function __construct() {
		$this->set_fields();
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'show_user_profile', [ $this, 'user_profile' ], 5 );
		\add_action( 'edit_user_profile', [ $this, 'user_profile' ], 5 );

		\add_action( 'personal_options_update', [ $this, 'process_user_option_update' ] );
		\add_action( 'edit_user_profile_update', [ $this, 'process_user_option_update' ] );
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Admin_Conditional::class ];
	}

	/**
	 * Sets the fields and their labels and descriptions.
	 */
	private function set_fields() {
		$this->fields = [
			'basicInfo'       => [
				'label' => \__( 'Basic information', 'wordpress-seo-premium' ),
				'type'  => 'group',
			],
			'honorificPrefix' => [
				'label'       => \__( 'Honorific prefix', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'E.g. %1$sDr%2$s, %1$sMs%2$s, %1$sMr%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'string',
			],
			'honorificSuffix' => [
				'label'       => \__( 'Honorific suffix', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'E.g. %1$sMD%2$s, %1$sPhD%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'string',
			],
			'birthDate'       => [
				'label'       => \__( 'Birth date', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'Use format: %1$sYYYY-MM-DD%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'date',
			],
			'gender'          => [
				'label'       => \__( 'Gender', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'E.g. %1$sfemale%2$s, %1$smale%2$s, %1$snon-binary%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'string',
			],
			'extraInfo'       => [
				'label' => \__( 'Extra information', 'wordpress-seo-premium' ),
				'type'  => 'group',
			],
			'award'           => [
				'label'       => \__( 'Awards', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'Comma separated, e.g. %1$sMost likely to succeed - 1991, Smartest in class - 1990%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'array',
			],
			'knowsAbout'      => [
				'label'       => \__( 'Expertise in', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'Comma separated, e.g. %1$sPHP, JavaScript, 90\'s rock music%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'array',
			],
			'knowsLanguage'   => [
				'label'       => \__( 'Language(s) spoken', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'Comma separated, e.g. %1$sEnglish, French, Dutch%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'array',
			],
			'jobInfo'         => [
				'label' => \__( 'Employer information', 'wordpress-seo-premium' ),
				'type'  => 'group',
			],
			'jobTitle'        => [
				'label'       => \__( 'Job title', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'E.g. %1$ssoftware engineer%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'string',
			],
			'worksFor'        => [
				'label'       => \__( 'Employer name', 'wordpress-seo-premium' ),
				/* translators: %1$s is replaced by `<code>`, %2$s by `</code>`. */
				'description' => \sprintf( \esc_html__( 'E.g. %1$sAcme inc%2$s', 'wordpress-seo-premium' ), '<code>', '</code>' ),
				'type'        => 'string',
			],
		];
	}

	/**
	 * Shows a form to add Schema fields to a user.
	 *
	 * @param WP_User $user The current page's user.
	 *
	 * @return void
	 */
	public function user_profile( $user ) {
		\wp_nonce_field( self::NONCE_FIELD_ACTION, self::NONCE_FIELD_NAME );

		echo '<h2 id="yoast-seo-schema">', \esc_html__( 'Yoast SEO Schema enhancements', 'wordpress-seo-premium' ), '</h2>';
		echo '<p>', \esc_html__( 'The info you add below is added to the data Yoast SEO outputs in its schema.org output, for instance when you\'re the author of a page. Please only add the info you feel good sharing publicly.', 'wordpress-seo-premium' ), '</p>';

		$user_schema = \get_user_meta( $user->ID, 'wpseo_user_schema', true );

		echo '<div class="yoast yoast-settings">';
		foreach ( $this->fields as $key => $field ) {
			if ( $field['type'] === 'group' ) {
				echo '<h2>', \esc_html( $field['label'] ), '</h2>';
				continue;
			}
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- False positive, $key is set in the code above, not by a user.
			echo '<label for="wpseo_user_schema_', $key, '">', \esc_html( $field['label'] ), '</label>';
			$val = '';
			if ( isset( $user_schema[ $key ] ) ) {
				$val = $user_schema[ $key ];
			}
			if ( $field['type'] === 'array' && \is_array( $val ) ) {
				$val = \implode( ', ', $val );
			}
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- False positive, $key is set in the code above, not by a user.
			echo '<input class="yoast-settings__text regular-text" type="text" id="wpseo_user_schema_', $key, '" name="wpseo_user_schema[', $key, ']" value="', \esc_attr( $val ), '"/>';
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- False positive, $field['description'] is set in the code above, not by a user.
			echo '<p>', $field['description'], '</p>';
		}
		echo '</div>';
	}

	/**
	 * Updates the user metas that (might) have been set on the user profile page.
	 *
	 * @param int $user_id User ID of the updated user.
	 */
	public function process_user_option_update( $user_id ) {
		// phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
		$nonce_value = \filter_input( \INPUT_POST, self::NONCE_FIELD_NAME, @\FILTER_SANITIZE_STRING );
		if ( empty( $nonce_value ) ) {
			return;
		}

		\check_admin_referer( self::NONCE_FIELD_ACTION, self::NONCE_FIELD_NAME );

		\update_user_meta( $user_id, 'wpseo_user_schema', $this->get_posted_user_fields() );
	}

	/**
	 * Builds the arguments for filter_var_array which makes sure we only get the fields that we've defined above.
	 *
	 * @return array Filter arguments.
	 */
	private function build_filter_args() {
		$args = [];
		foreach ( $this->fields as $key => $field ) {
			if ( $field['type'] === 'group' ) {
				continue;
			}
			// phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
			$args[ $key ] = @\FILTER_SANITIZE_STRING;
		}

		return $args;
	}

	/**
	 * Gets the posted user fields and sanitizes them.
	 *
	 * As we output these values straight from the database both on frontend and backend, this sanitization is quite important.
	 *
	 * @return array The posted user fields, restricted to allowed fields.
	 */
	private function get_posted_user_fields() {
		$args        = [
			'wpseo_user_schema' => [
				// phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- This deprecation will be addressed later.
				'filter' => @\FILTER_SANITIZE_STRING,
				'flags'  => \FILTER_FORCE_ARRAY,
			],
		];
		$user_schema = \filter_input_array( \INPUT_POST, $args )['wpseo_user_schema'];
		$user_schema = \filter_var_array( $user_schema, $this->build_filter_args(), false );

		foreach ( $this->fields as $key => $object ) {
			switch ( $object['type'] ) {
				case 'array':
					$user_schema[ $key ] = \explode( ',', $user_schema[ $key ] );
					// Trim each item in the comma separated array.
					foreach ( $user_schema[ $key ] as $index => $item ) {
						$user_schema[ $key ][ $index ] = \trim( $item );
					}
					// Remove empty items.
					$user_schema[ $key ] = \array_filter( $user_schema[ $key ] );

					if ( $user_schema[ $key ] === [] || $user_schema[ $key ][0] === '' ) {
						unset( $user_schema[ $key ] );
					}
					break;
				case 'date':
					$date = \explode( '-', $user_schema[ $key ] );
					if ( \count( $date ) !== 3 || ! \checkdate( (int) $date[1], (int) $date[2], (int) $date[0] ) ) {
						unset( $user_schema[ $key ] );
					}
					break;
				default:
					if ( empty( $user_schema[ $key ] ) ) {
						unset( $user_schema[ $key ] );
					}
					// Nothing further to be done for strings.
					break;
			}
		}

		return $user_schema;
	}
}
