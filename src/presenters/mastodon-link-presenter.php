<?php

namespace Yoast\WP\SEO\Premium\Presenters;

use Yoast\WP\SEO\Presenters\Abstract_Indexable_Tag_Presenter;

/**
 * Presenter class for the link rel="me" meta tag used for Mastodon verification.
 */
class Mastodon_Link_Presenter extends Abstract_Indexable_Tag_Presenter {

	/**
	 * The tag key name.
	 *
	 * @var string
	 */
	protected $key = 'me';

	/**
	 * The tag format including placeholders.
	 *
	 * @var string
	 */
	protected $tag_format = self::LINK_REL_HREF;

	/**
	 * The method of escaping to use.
	 *
	 * @var string
	 */
	protected $escaping = 'url';

	/**
	 * Returns the rel me meta tag.
	 *
	 * @return string The rel me tag.
	 */
	public function present() {
		$output = parent::present();

		if ( ! empty( $output ) ) {
			/**
			 * Filter: 'wpseo_mastodon_link' - Allow changing link output by Yoast SEO.
			 *
			 * @param string $unsigned The full `<link>` element.
			 */
			return \apply_filters( 'wpseo_mastodon_link', $output );
		}

		return '';
	}

	/**
	 * Returns the URL to be presented in the tag.
	 *
	 * @return string The URL to be presented in the tag.
	 */
	public function get() {
		switch ( $this->helpers->options->get( 'company_or_person', false ) ) {
			case 'company':
				$social_profiles = $this->helpers->social_profiles->get_organization_social_profiles();
				break;

			case 'person':
				$company_or_person_id = $this->helpers->options->get( 'company_or_person_user_id', 0 );
				$social_profiles      = $this->helpers->social_profiles->get_person_social_profiles( $company_or_person_id );
				break;
			default:
				$social_profiles = [];
		}

		// Person case.
		if ( ! empty( $social_profiles['mastodon'] ) ) {
			return $social_profiles['mastodon'];
		}

		// Organization case.
		if ( ! empty( $social_profiles['mastodon_url'] ) ) {
			return $social_profiles['mastodon_url'];
		}

		return '';
	}
}
