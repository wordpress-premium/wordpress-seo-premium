<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

if ( class_exists( 'Yoast_Product' ) && ! class_exists( 'WPSEO_Product_Premium', false ) ) {

	/**
	 * Class WPSEO_Product_Premium
	 */
	class WPSEO_Product_Premium extends Yoast_Product {

		/**
		 * Plugin author name.
		 *
		 * @var string
		 */
		const PLUGIN_AUTHOR = 'Yoast';

		/**
		 * License endpoint.
		 *
		 * @var string
		 */
		const EDD_STORE_URL = 'http://my.yoast.com';

		/**
		 * Product name to use for license checks.
		 *
		 * @var string
		 */
		const EDD_PLUGIN_NAME = 'Yoast SEO Premium';

		/**
		 * Construct the Product Premium class
		 */
		public function __construct() {
			$file = plugin_basename( WPSEO_FILE );
			$slug = dirname( $file );

			parent::__construct(
				trailingslashit( self::EDD_STORE_URL ) . 'edd-sl-api',
				self::EDD_PLUGIN_NAME,
				$slug,
				WPSEO_Premium::PLUGIN_VERSION_NAME,
				'https://yoast.com/wordpress/plugins/seo-premium/',
				'admin.php?page=wpseo_licenses#top#licenses',
				'wordpress-seo',
				self::PLUGIN_AUTHOR,
				$file
			);

			if ( method_exists( $this, 'set_extension_url' ) ) {
				$this->set_extension_url( 'https://my.yoast.com/licenses/' );
			}
		}
	}
}
