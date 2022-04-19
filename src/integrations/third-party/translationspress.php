<?php

namespace Yoast\WP\SEO\Integrations\Third_Party;

use DateTime;
use stdClass;
use Yoast\WP\SEO\Conditionals\No_Conditionals;
use Yoast\WP\SEO\Helpers\Date_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Allows to download translations from TranslationsPress.
 */
class TranslationsPress implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The plugin slug to retrieve the translations for.
	 *
	 * @var string
	 */
	protected $slug = 'wordpress-seo-premium';

	/**
	 * The key of the custom transient where to store the translations info.
	 *
	 * @var string
	 */
	protected $transient_key;

	/**
	 * The URL for the TranslationsPress API service.
	 *
	 * @var string
	 */
	protected $api_url;

	/**
	 * The array to cache our addition to the `site_transient_update_plugins` filter.
	 *
	 * @var array|null
	 */
	protected $cached_translations;

	/**
	 * The Date helper object.
	 *
	 * @var Date_Helper
	 */
	protected $date_helper;

	/**
	 * Adds a new project to load translations for.
	 *
	 * @param Date_Helper $date_helper The Date Helper object.
	 */
	public function __construct( Date_Helper $date_helper ) {
		$this->transient_key = 'yoast_translations_' . $this->slug;
		$this->api_url       = 'https://packages.translationspress.com/yoast/' . $this->slug . '/packages.json';
		$this->date_helper   = $date_helper;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		\add_action( 'init', [ $this, 'register_clean_translations_cache' ], \PHP_INT_MAX );
		\add_filter( 'translations_api', [ $this, 'translations_api' ], 10, 3 );
		\add_filter( 'site_transient_update_plugins', [ $this, 'site_transient_update_plugins' ] );
	}

	/**
	 * Short-circuits translations API requests for private projects.
	 *
	 * @param bool|array $result         The result object. Default false.
	 * @param string     $requested_type The type of translations being requested.
	 * @param object     $args           Translation API arguments.
	 *
	 * @return bool|array The translations array. False by default.
	 */
	public function translations_api( $result, $requested_type, $args ) {
		if ( $requested_type === 'plugins' && $args['slug'] === $this->slug ) {
			return $this->get_translations();
		}

		return $result;
	}

	/**
	 * Filters the translations transients to include the private plugin or theme.
	 * Caches our own return value to prevent heavy overhead.
	 *
	 * @param bool|object $value The transient value.
	 *
	 * @return object The filtered transient value.
	 */
	public function site_transient_update_plugins( $value ) {
		if ( ! $value ) {
			$value = new stdClass();
		}

		if ( ! isset( $value->translations ) ) {
			$value->translations = [];
		}

		if ( \is_array( $this->cached_translations ) ) {
			$value->translations = \array_merge( $value->translations, $this->cached_translations );
			return $value;
		}

		$this->cached_translations = [];

		$translations = $this->get_translations();
		if ( empty( $translations[ $this->slug ]['translations'] ) ) {
			return $value;
		}

		// The following call is the reason we need to cache the results of this method.
		$installed_translations = \wp_get_installed_translations( 'plugins' );
		$available_languages    = \get_available_languages();
		foreach ( $translations[ $this->slug ]['translations'] as $translation ) {
			if ( ! \in_array( $translation['language'], $available_languages, true ) ) {
				continue;
			}

			if ( isset( $installed_translations[ $this->slug ][ $translation['language'] ] ) && $translation['updated'] ) {
				$local  = new DateTime( $installed_translations[ $this->slug ][ $translation['language'] ]['PO-Revision-Date'] );
				$remote = new DateTime( $translation['updated'] );

				if ( $local >= $remote ) {
					continue;
				}
			}

			$translation['type']         = 'plugin';
			$translation['slug']         = $this->slug;
			$translation['autoupdate']   = true;
			$value->translations[]       = $translation;
			$this->cached_translations[] = $translation;
		}

		return $value;
	}

	/**
	 * Registers actions for clearing translation caches.
	 *
	 * @return void
	 */
	public function register_clean_translations_cache() {
		\add_action( 'set_site_transient_update_plugins', [ $this, 'clean_translations_cache' ] );
		\add_action( 'delete_site_transient_update_plugins', [ $this, 'clean_translations_cache' ] );
	}

	/**
	 * Clears existing translation cache.
	 *
	 * @return void
	 */
	public function clean_translations_cache() {
		$translations = \get_site_transient( $this->transient_key );
		if ( ! \is_array( $translations ) ) {
			return;
		}

		$cache_lifespan   = \DAY_IN_SECONDS;
		$time_not_changed = isset( $translations['_last_checked'] ) && ( $this->date_helper->current_time() - $translations['_last_checked'] ) > $cache_lifespan;

		if ( ! $time_not_changed ) {
			return;
		}

		\delete_site_transient( $this->transient_key );
	}

	/**
	 * Gets the translations for a given project.
	 *
	 * @return array The translation data.
	 */
	public function get_translations() {
		$translations = \get_site_transient( $this->transient_key );
		if ( $translations !== false && \is_array( $translations ) ) {
			return $translations;
		}

		$translations = [];

		$result = \json_decode( \wp_remote_retrieve_body( \wp_remote_get( $this->api_url ) ), true );

		// Nothing found.
		if ( ! \is_array( $result ) ) {
			$result = [];
		}

		$translations[ $this->slug ]   = $result;
		$translations['_last_checked'] = $this->date_helper->current_time();

		\set_site_transient( $this->transient_key, $translations );

		return $translations;
	}
}
