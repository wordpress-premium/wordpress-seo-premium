<?php

namespace Yoast\WP\SEO\Premium;

use Exception;

/**
 * Class responsible for performing the premium as an addon installer.
 */
class Addon_Installer {

	/**
	 * The option key for tracking the status of the installer.
	 */
	const OPTION_KEY = 'yoast_premium_as_an_addon_installer';

	/**
	 * The minimum Yoast SEO version required.
	 */
	const MINIMUM_YOAST_SEO_VERSION = '16.9';

	/**
	 * The base directory for the installer.
	 *
	 * @var string
	 */
	protected $base_dir;

	/**
	 * The detected Yoast SEO version.
	 *
	 * @var string
	 */
	protected $yoast_seo_version = '0';

	/**
	 * The detected Yoast SEO plugin file.
	 *
	 * @var string
	 */
	protected $yoast_seo_file = 'wordpress-seo/wp-seo.php';

	/**
	 * The detected Yoast SEO directory.
	 *
	 * @var string
	 */
	protected $yoast_seo_dir = \WP_PLUGIN_DIR . '/wordpress-seo';

	/**
	 * Addon installer constructor.
	 *
	 * @param string $base_dir The base directory.
	 */
	public function __construct( $base_dir ) {
		$this->base_dir = $base_dir;
	}

	/**
	 * Performs the installer if it hasn't been done yet.
	 * Otherwise attempts to load Yoast SEO from the vendor directory.
	 *
	 * A notice will be shown in the admin if the installer failed.
	 *
	 * @return void
	 */
	public function install_or_load_yoast_seo_from_vendor_directory() {
		\add_action( 'admin_notices', [ $this, 'show_install_yoast_seo_notification' ] );
		\add_action( 'network_admin_notices', [ $this, 'show_install_yoast_seo_notification' ] );
		\add_action( 'plugins_loaded', [ $this, 'validate_installation_status' ] );
		if ( ! $this->get_status() ) {
			try {
				$this->install();
			} catch ( Exception $e ) {
				$this->load_yoast_seo_from_vendor_directory();
			}
		}
		elseif ( $this->get_status() === 'started' ) {
			require_once \ABSPATH . 'wp-admin/includes/plugin.php';
			$this->detect_yoast_seo();
			if ( \is_plugin_active( $this->yoast_seo_file ) ) {
				// Yoast SEO is active so mark installation as successful.
				\update_option( self::OPTION_KEY, 'completed', true );
				return;
			}
			$this->load_yoast_seo_from_vendor_directory();
		}
	}

	/**
	 * Displays a notification to install Yoast SEO.
	 *
	 * @return void
	 */
	public function show_install_yoast_seo_notification() {
		if ( ! $this->should_show_notification() ) {
			return;
		}

		require_once \ABSPATH . 'wp-admin/includes/plugin.php';
		$this->detect_yoast_seo();

		$action = $this->get_notification_action();

		if ( ! $action ) {
			return;
		}

		echo (
			'<div class="error">'
				. '<p>'
					. \sprintf(
						/* translators: %1$s: Yoast SEO, %2$s: The minimum Yoast SEO version required, %3$s: Yoast SEO Premium. */
						\esc_html__( '%1$s %2$s must be installed and activated in order to use %3$s.', 'wordpress-seo-premium' ),
						'Yoast SEO',
						\esc_html( self::MINIMUM_YOAST_SEO_VERSION ),
						'Yoast SEO Premium'
					)
				. '</p>'
				. '<p>'
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is escaped above.
					. $action
				. '</p>'
			. '</div>'
		);
	}

	/**
	 * Returns the notification action to display.
	 *
	 * @return false|string The notification action or false if no action should be taken.
	 */
	protected function get_notification_action() {
		$minimum_version_met = \version_compare( $this->yoast_seo_version, self::MINIMUM_YOAST_SEO_VERSION . '-RC0', '>=' );
		$network_active      = \is_plugin_active_for_network( \WPSEO_PREMIUM_BASENAME );
		$yoast_seo_active    = ( $network_active ) ? \is_plugin_active_for_network( $this->yoast_seo_file ) : \is_plugin_active( $this->yoast_seo_file );

		if ( $minimum_version_met && $yoast_seo_active ) {
			return false;
		}

		if ( $minimum_version_met ) {
			$permission = 'activate_plugins';
		}
		elseif ( $this->yoast_seo_version !== '0' ) {
			$permission = 'update_plugins';
		}
		else {
			$permission = 'install_plugins';
		}

		if ( \current_user_can( $permission ) ) {
			switch ( $permission ) {
				case 'activate_plugins':
					if ( $network_active ) {
						$base_url = \network_admin_url( 'plugins.php?action=activate&plugin=' . $this->yoast_seo_file );
						/* translators: %1$s: Yoast SEO, %2$s: Link start tag, %3$s: Link end tag. */
						$button_content = \__( '%2$sNetwork Activate %1$s now%3$s', 'wordpress-seo-premium' );
					}
					else {
						$base_url = \self_admin_url( 'plugins.php?action=activate&plugin=' . $this->yoast_seo_file );
						/* translators: %1$s: Yoast SEO, %2$s: Link start tag, %3$s: Link end tag. */
						$button_content = \__( '%2$sActivate %1$s now%3$s', 'wordpress-seo-premium' );
					}
					$url = \wp_nonce_url( $base_url, 'activate-plugin_' . $this->yoast_seo_file );
					break;
				case 'update_plugins':
					$url = \wp_nonce_url( \self_admin_url( 'update.php?action=upgrade-plugin&plugin=' . $this->yoast_seo_file ), 'upgrade-plugin_' . $this->yoast_seo_file );
					/* translators: %1$s: Yoast SEO, %2$s: Link start tag, %3$s: Link end tag. */
					$button_content = \__( '%2$sUpgrade %1$s now%3$s', 'wordpress-seo-premium' );
					break;
				case 'install_plugins':
					$url = \wp_nonce_url( \self_admin_url( 'update.php?action=install-plugin&plugin=wordpress-seo' ), 'install-plugin_wordpress-seo' );
					/* translators: %1$s: Yoast SEO, %2$s: Link start tag, %3$s: Link end tag. */
					$button_content = \__( '%2$sInstall %1$s now%3$s', 'wordpress-seo-premium' );
					break;
			}
			return \sprintf(
				\esc_html( $button_content ),
				'Yoast SEO',
				'<a class="button" href="' . \esc_url( $url ) . '">',
				'</a>'
			);
		}

		if ( \is_multisite() ) {
			/* translators: %1$s: Yoast SEO, %2$s: The minimum Yoast SEO version required. */
			$message = \__( 'Please contact a network administrator to install %1$s %2$s.', 'wordpress-seo-premium' );
		}
		else {
			/* translators: %1$s: Yoast SEO, %2$s: The minimum Yoast SEO version required. */
			$message = \__( 'Please contact an administrator to install %1$s %2$s.', 'wordpress-seo-premium' );
		}
		return \sprintf(
			\esc_html( $message ),
			'Yoast SEO',
			\esc_html( self::MINIMUM_YOAST_SEO_VERSION )
		);
	}

	/**
	 * Resets the installation status if Yoast SEO is not installed or outdated.
	 *
	 * @return void
	 */
	public function validate_installation_status() {
		if ( ! \defined( 'WPSEO_VERSION' ) || \version_compare( \WPSEO_VERSION, self::MINIMUM_YOAST_SEO_VERSION . '-RC0', '<' ) ) {
			\delete_option( self::OPTION_KEY );
			if ( ! \defined( 'WPSEO_VERSION' ) ) {
				$this->load_yoast_seo_from_vendor_directory();
			}
		}
	}

	/**
	 * Returns the status of the installer.
	 *
	 * This uses a separate option from our options framework as it needs to be available
	 * before Yoast SEO has been loaded.
	 *
	 * @return false|string false if the installer hasn't been started.
	 *                      "started" if it has but hasn't completed.
	 *                       "completed" if it has been completed.
	 */
	protected function get_status() {
		return \get_option( self::OPTION_KEY );
	}

	/**
	 * Installs to premium as an addon.
	 *
	 * @return void
	 *
	 * @throws Exception If the installer failed.
	 */
	protected function install() {
		if ( $this->get_status() ) {
			return;
		}
		// Mark the installer as having been started but not completed.
		\update_option( self::OPTION_KEY, 'started', true );

		require_once \ABSPATH . 'wp-admin/includes/plugin.php';

		$this->detect_yoast_seo();
		// Either the plugin is not installed or is installed and too old.
		if ( \version_compare( $this->yoast_seo_version, self::MINIMUM_YOAST_SEO_VERSION . '-RC0', '<' ) ) {
			$this->ensure_vendor_directory_exists();
			$this->clean_target_directory();
			$this->move_vendor_directory();
			// We just moved a new file to the plugins directory so clear the plugins cache.
			\wp_cache_delete( 'plugins', 'plugins' );
			// If for some weird reason the plugin file was previously renamed make sure we use the actual filename.
			$this->yoast_seo_file = \dirname( $this->yoast_seo_file ) . '/wp-seo.php';
		}

		$this->ensure_yoast_seo_is_activated();
		$this->transfer_auto_update_settings();
		// Mark the installer as having been completed.
		\update_option( self::OPTION_KEY, 'completed', true );
	}

	/**
	 * Loads Yoast SEO from the vendor directory.
	 *
	 * @return void
	 */
	protected function load_yoast_seo_from_vendor_directory() {
		if ( \file_exists( $this->base_dir . '/vendor/yoast/wordpress-seo/wp-seo.php' ) ) {
			require_once $this->base_dir . '/vendor/yoast/wordpress-seo/wp-seo.php';
			\register_activation_hook( \WPSEO_PREMIUM_FILE, 'wpseo_activate' );
			\register_deactivation_hook( \WPSEO_PREMIUM_FILE, 'wpseo_deactivate' );
		}
	}

	/**
	 * Detects the Yoast SEO plugin file and version.
	 *
	 * @return void
	 */
	protected function detect_yoast_seo() {
		// Make sure Yoast SEO isn't already installed in another directory.
		foreach ( \get_plugins() as $file => $plugin ) {
			// Use text domain to identify the plugin as it's the closest thing to a slug.
			if (
				isset( $plugin['TextDomain'] ) && $plugin['TextDomain'] === 'wordpress-seo'
				&& isset( $plugin['Name'] ) && $plugin['Name'] === 'Yoast SEO'
			) {
				$this->yoast_seo_file    = $file;
				$this->yoast_seo_version = isset( $plugin['Version'] ) ? $plugin['Version'] : '0';
				$this->yoast_seo_dir     = \WP_PLUGIN_DIR . '/' . \dirname( $file );
			}
		}
	}

	/**
	 * Asserts the vendor directory exists.
	 *
	 * @return void
	 *
	 * @throws Exception If the required vendor directory does not exist.
	 */
	protected function ensure_vendor_directory_exists() {
		// If Yoast SEO no longer exists in the vendor directory then abort.
		if ( ! \file_exists( $this->base_dir . '/vendor/yoast/wordpress-seo/wp-seo.php' ) ) {
			throw new Exception( 'Missing Yoast SEO in Yoast SEO Premium vendor.' );
		}
	}

	/**
	 * Cleans the target directory.
	 *
	 * @return void
	 *
	 * @throws Exception If the target directory could not be cleaned.
	 */
	protected function clean_target_directory() {
		if ( \file_exists( \WP_PLUGIN_DIR . '/' . $this->yoast_seo_file ) ) {
			if ( \file_exists( $this->yoast_seo_dir . '/.git' ) ) {
				throw new Exception( 'Existing Yoast SEO installation has a .git directory, refusing to automatically install.' );
			}
			if ( ! $this->remove_directory( $this->yoast_seo_dir ) ) {
				throw new Exception( 'Could not remove old Yoast SEO installation.' );
			}
		}
	}

	/**
	 * Removes a directory and all it's contents.
	 *
	 * @param string $directory The full path to the directory.
	 *
	 * @return bool Whether or not the remove was succesfull.
	 */
	protected function remove_directory( $directory ) {
		$items = \scandir( $directory );
		foreach ( $items as $item ) {
			if ( $item === '.' || $item === '..' ) {
				continue;
			}

			$path = $directory . '/' . $item;
			if ( \is_dir( $path ) ) {
				if ( ! $this->remove_directory( $path ) ) {
					return false;
				}
				continue;
			}
			if ( ! \unlink( $path ) ) {
				return false;
			}
		}
		return \rmdir( $directory );
	}

	/**
	 * Moves the vendor directory to the target directory.
	 *
	 * @return void
	 *
	 * @throws Exception If the move failed.
	 */
	protected function move_vendor_directory() {
		if ( ! \rename( $this->base_dir . '/vendor/yoast/wordpress-seo', $this->yoast_seo_dir ) ) {
			throw new Exception( 'Could not automatically installed Yoast SEO' );
		}
	}

	/**
	 * Activates Yoast SEO.
	 *
	 * @return void
	 *
	 * @throws Exception If Yoast SEO could not be activated.
	 */
	protected function ensure_yoast_seo_is_activated() {
		if ( ! \is_plugin_active( $this->yoast_seo_file ) ) {
			$network_active = \is_plugin_active_for_network( \WPSEO_PREMIUM_BASENAME );
			// If we're not active at all it means we're being activated.
			if ( ! $network_active && ! \is_plugin_active( \WPSEO_PREMIUM_BASENAME ) ) {
				// So set network active to whether or not we're in the network admin.
				$network_active = \is_network_admin();
			}
			// Activate Yoast SEO. If Yoast SEO Premium is network active then make sure Yoast SEO is as well.
			$activation = \activate_plugin( $this->yoast_seo_file, '', $network_active );
			if ( \is_wp_error( $activation ) ) {
				throw new Exception( 'Could not activate Yoast SEO: ' . $activation->get_error_message() );
			}
		}
	}

	/**
	 * Transfers the auto update settings for Yoast SEO Premium to Yoast SEO.
	 *
	 * @return void
	 */
	protected function transfer_auto_update_settings() {
		$auto_updates = (array) \get_site_option( 'auto_update_plugins', [] );

		if ( \in_array( \WPSEO_PREMIUM_BASENAME, $auto_updates, true ) ) {
			$auto_updates[] = $this->yoast_seo_file;
			$auto_updates   = \array_unique( $auto_updates );
			\update_site_option( 'auto_update_plugins', $auto_updates );
		}
	}

	/**
	 * Wether or not the notification to install Yoast SEO should be shown.
	 *
	 * This is copied from the Yoast_Admin_And_Dashboard_Conditional which we can't use as Yoast SEO may not be installed.
	 *
	 * @return bool
	 */
	protected function should_show_notification() {
		global $pagenow;

		// Do not output on plugin / theme upgrade pages or when WordPress is upgrading.
		if ( ( \defined( 'IFRAME_REQUEST' ) && \IFRAME_REQUEST ) || \wp_installing() ) {
			return false;
		}

		/*
		 * IFRAME_REQUEST is not defined on these pages,
		 * though these action pages do show when upgrading themes or plugins.
		 */
		$actions = [ 'do-theme-upgrade', 'do-plugin-upgrade', 'do-core-upgrade', 'do-core-reinstall' ];
		if ( isset( $_GET['action'] ) && \in_array( $_GET['action'], $actions, true ) ) {
			return false;
		}

		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- Only a strpos is done in the input.
		if ( $pagenow === 'admin.php' && isset( $_GET['page'] ) && \strpos( $_GET['page'], 'wpseo' ) === 0 ) {
			return true;
		}

		$target_pages = [
			'index.php',
			'plugins.php',
			'update-core.php',
			'options-permalink.php',
		];

		return \in_array( $pagenow, $target_pages, true );
	}
}
