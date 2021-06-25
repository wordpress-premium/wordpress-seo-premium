<?php
/**
 * Yoast SEO Plugin.
 *
 * WPSEO Premium plugin file.
 *
 * @package   WPSEO\Main
 * @copyright Copyright (C) 2008-2019, Yoast BV - support@yoast.com
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 *
 * @wordpress-plugin
 * Plugin Name: Yoast SEO Premium
 * Version:     16.5
 * Plugin URI:  https://yoa.st/2jc
 * Description: The first true all-in-one SEO solution for WordPress, including on-page content analysis, XML sitemaps and much more.
 * Author:      Team Yoast
 * Author URI:  https://yoa.st/2jc
 * Text Domain: wordpress-seo-premium
 * Domain Path: /languages/
 * License:     GPL v3
 * Requires at least: 5.6
 * Requires PHP: 5.6.20
 *
 * WC requires at least: 3.0
 * WC tested up to: 5.1
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

use Yoast\WP\SEO\Premium\Addon_Installer;

if ( ! defined( 'WPSEO_PREMIUM_FILE' ) ) {
	define( 'WPSEO_PREMIUM_FILE', __FILE__ );
}

if ( ! defined( 'WPSEO_PREMIUM_PATH' ) ) {
	define( 'WPSEO_PREMIUM_PATH', plugin_dir_path( WPSEO_PREMIUM_FILE ) );
}

if ( ! defined( 'WPSEO_PREMIUM_BASENAME' ) ) {
	define( 'WPSEO_PREMIUM_BASENAME', plugin_basename( WPSEO_PREMIUM_FILE ) );
}

/**
 * {@internal Nobody should be able to overrule the real version number as this can cause
 *            serious issues with the options, so no if ( ! defined() ).}}
 */
define( 'WPSEO_PREMIUM_VERSION', '16.5' );

// Initialize Premium autoloader.
$wpseo_premium_dir               = WPSEO_PREMIUM_PATH;
$yoast_seo_premium_autoload_file = $wpseo_premium_dir . 'vendor/autoload.php';

if ( is_readable( $yoast_seo_premium_autoload_file ) ) {
	require $yoast_seo_premium_autoload_file;
}

// This class has to exist outside of the container as the container requires Yoast SEO to exist.
$wpseo_addon_installer = new Addon_Installer( __DIR__ );
$wpseo_addon_installer->install_or_load_yoast_seo_from_vendor_directory();

// Load the container.
if ( ! wp_installing() ) {
	require_once __DIR__ . '/src/functions.php';
	YoastSEOPremium();
}

\register_activation_hook( \WPSEO_PREMIUM_FILE, [ 'WPSEO_Premium', 'install' ] );
