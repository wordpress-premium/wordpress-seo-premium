<?php

namespace Yoast\WP\SEO\Premium\Integrations\Third_Party;

use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Helpers\Social_Profiles_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Mastodon integration.
 */
class Mastodon implements Integration_Interface {

	use No_Conditionals;

	/**
	 * Holds the options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options_helper;

	/**
	 * Holds the social profiles helper.
	 *
	 * @var Social_Profiles_Helper
	 */
	protected $social_profiles_helper;

	/**
	 * Sets the helpers.
	 *
	 * @param Options_Helper         $options_helper         Options helper.
	 * @param Social_Profiles_Helper $social_profiles_helper Social Profiles helper.
	 */
	public function __construct( Options_Helper $options_helper, Social_Profiles_Helper $social_profiles_helper ) {
		$this->options_helper         = $options_helper;
		$this->social_profiles_helper = $social_profiles_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_filter( 'wpseo_frontend_presenter_classes', [ $this, 'add_social_link_tags' ], 10, 2 );
		\add_filter( 'wpseo_person_social_profile_fields', [ $this, 'add_mastodon_to_person_social_profile_fields' ], 11, 1 );
		\add_filter( 'wpseo_organization_social_profile_fields', [ $this, 'add_mastodon_to_organization_social_profile_fields' ], 11, 1 );
		\add_filter( 'wpseo_schema_person_social_profiles', [ $this, 'add_mastodon_to_person_schema' ], 10 );
		\add_filter( 'user_contactmethods', [ $this, 'add_mastodon_to_user_contactmethods' ], 10 );
		\add_filter( 'wpseo_mastodon_active', [ $this, 'check_mastodon_active' ], 10 );
	}

	/**
	 * Adds the social profiles presenter to the list of presenters to use.
	 *
	 * @param array  $presenters The list of presenters.
	 * @param string $page_type  The page type for which the presenters have been collected.
	 *
	 * @return array
	 */
	public function add_social_link_tags( $presenters, $page_type ) {
		// Bail out early if something's wrong with the presenters, let's not add any more confusion there.
		if ( ! \is_array( $presenters ) ) {
			return $presenters;
		}

		if ( \in_array( $page_type, [ 'Static_Home_Page', 'Home_Page' ], true ) ) {
			$presenters = \array_merge( $presenters, [ 'Yoast\WP\SEO\Premium\Presenters\Mastodon_Link_Presenter' ] );
		}

		return $presenters;
	}

	/**
	 * Adds Mastodon to the list of social profiles.
	 *
	 * @param array $social_profile_fields The social profiles array.
	 *
	 * @return array The updated social profiles array.
	 */
	public function add_mastodon_to_person_social_profile_fields( $social_profile_fields ) {
		// Bail out early if something's wrong with the social profiles, let's not add any more confusion there.
		if ( ! \is_array( $social_profile_fields ) ) {
			return $social_profile_fields;
		}
		$social_profile_fields['mastodon'] = 'get_non_valid_url';

		return $social_profile_fields;
	}

	/**
	 * Adds Mastodon to the list of social profiles.
	 *
	 * @param array $social_profile_fields The social profiles array.
	 *
	 * @return array The updated social profiles array.
	 */
	public function add_mastodon_to_organization_social_profile_fields( $social_profile_fields ) {
		// Bail out early if something's wrong with the social profiles, let's not add any more confusion there.
		if ( ! \is_array( $social_profile_fields ) ) {
			return $social_profile_fields;
		}
		$social_profile_fields['mastodon_url'] = 'get_non_valid_url';

		return $social_profile_fields;
	}

	/**
	 * Adds Mastodon to the list of social profiles to add to a Person's Schema.
	 *
	 * @param array $social_profiles The social profiles array.
	 *
	 * @return array
	 */
	public function add_mastodon_to_person_schema( $social_profiles ) {
		// Bail out early if something's wrong with the social profiles, let's not add any more confusion there.
		if ( ! \is_array( $social_profiles ) ) {
			return $social_profiles;
		}
		$social_profiles[] = 'mastodon';

		return $social_profiles;
	}

	/**
	 * Adds Mastodon to the list of contact methods for persons.
	 *
	 * @param array $contactmethods Currently set contactmethods.
	 *
	 * @return array
	 */
	public function add_mastodon_to_user_contactmethods( $contactmethods ) {
		// Bail out early if something's wrong with the contact methods, let's not add any more confusion there.
		if ( ! \is_array( $contactmethods ) ) {
			return $contactmethods;
		}

		$contactmethods['mastodon'] = \__( 'Mastodon profile URL', 'wordpress-seo-premium' );

		return $contactmethods;
	}

	/**
	 * Checks if the Mastodon field is filled in.
	 *
	 * @param bool $state The current state of the integration.
	 *
	 * @return bool
	 */
	public function check_mastodon_active( $state ) {
		switch ( $this->options_helper->get( 'company_or_person', false ) ) {
			case 'company':
				$social_profiles = $this->social_profiles_helper->get_organization_social_profiles();
				if ( ! empty( $social_profiles['mastodon_url'] ) ) {
					return true;
				}
				break;

			case 'person':
				$company_or_person_id = $this->options_helper->get( 'company_or_person_user_id', 0 );
				$social_profiles      = $this->social_profiles_helper->get_person_social_profiles( $company_or_person_id );
				if ( ! empty( $social_profiles['mastodon'] ) ) {
					return true;
				}
				break;
		}

		return $state;
	}
}
