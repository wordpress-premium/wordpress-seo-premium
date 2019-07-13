<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes\Redirects
 */

/**
 * Represents the filter for removing redirected entries from the sitemaps.
 */
class WPSEO_Redirect_Sitemap_Filter implements WPSEO_WordPress_Integration {

	/**
	 * URL to the homepage.
	 *
	 * @var string
	 */
	protected $home_url;

	/**
	 * Constructs the object.
	 *
	 * @param string $home_url The home url.
	 */
	public function __construct( $home_url ) {
		$this->home_url = $home_url;
	}

	/**
	 * Registers the hooks.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_filter( 'wpseo_sitemap_entry', array( $this, 'filter_sitemap_entry' ) );
		add_action( 'wpseo_premium_redirects_modified', array( $this, 'clear_sitemap_cache' ) );
	}

	/**
	 * Prevents a redirected URL from being added to the sitemap.
	 *
	 * @param array $url The url data.
	 *
	 * @return bool|array False when entry will be redirected.
	 */
	public function filter_sitemap_entry( $url ) {
		if ( empty( $url['loc'] ) ) {
			return $url;
		}

		$entry_location = str_replace( $this->home_url, '', $url['loc'] );

		if ( $this->is_redirect( $entry_location ) !== false ) {
			return false;
		}

		return $url;
	}

	/**
	 * Clears the sitemap cache.
	 *
	 * @return void
	 */
	public function clear_sitemap_cache() {
		WPSEO_Sitemaps_Cache::clear();
	}

	/**
	 * Checks if the given entry location already exists as a redirect.
	 *
	 * @param string $entry_location The entry location.
	 *
	 * @return bool Whether the entry location exists as a redirect.
	 */
	protected function is_redirect( $entry_location ) {
		static $redirects = null;

		if ( $redirects === null ) {
			$redirects = new WPSEO_Redirect_Option();
		}

		return $redirects->search( $entry_location ) !== false;
	}
}
