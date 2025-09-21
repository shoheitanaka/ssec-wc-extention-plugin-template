<?php
/**
 * Plugin Name: plugin_name
 * Plugin URI: https://example.com/
 * Description: A brief description of this plugin.
 * Version: 1.0.0
 * Author: Shohei Tanaka
 * Author URI: https://example.com/
 * License: GPL3
 * Text Domain: plugin-name
 * Domain Path: /i18n
 * Requires at least: 6.7
 * Tested up to: 6.8.2
 * Requires PHP: 8.1
 * WC requires at least: 8.0
 * WC tested up to: 10.1
 *
 * @package Plugin_Name
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WC Detection
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	/**
	 * Check if WooCommerce is active.
	 *
	 * @return bool True if WooCommerce is active, false otherwise.
	 */
	function is_woocommerce_active() {
		if ( ! isset( $active_plugins ) ) {
			$active_plugins = (array) get_option( 'active_plugins', array() );

			if ( is_multisite() ) {
				$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
			}
		}
		return in_array( 'woocommerce/woocommerce.php', $active_plugins, true ) || array_key_exists( 'woocommerce/woocommerce.php', $active_plugins );
	}
}

if ( is_woocommerce_active() ) {

	if ( ! defined( 'PLUGIN_NAME_PATH' ) ) {
		define( 'PLUGIN_NAME_PATH', __DIR__ );
		define( 'PLUGIN_NAME_URL', plugins_url( '/', __FILE__ ) );
	}

	// Load all php files in the includes directory.
	$includes_dir = __DIR__ . '/includes';

	try {
		$directory_iterator = new RecursiveDirectoryIterator(
			$includes_dir,
			FilesystemIterator::SKIP_DOTS
		);

		$iterator = new RecursiveIteratorIterator( $directory_iterator );

		foreach ( $iterator as $file_info ) {
			if ( $file_info->getExtension() === 'php' ) {
				require_once $file_info->getRealPath();
			}
		}
	} catch ( Exception $e ) {
		// Handle error silently in production or use WordPress admin notice.
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			wp_die( 'File load error in plugin: ' . esc_html( $e->getMessage() ) );
		}
	}

	add_action( 'plugins_loaded', 'plugin_name_init', 10 );

	/**
	 * Initialize the plugin.
	 *
	 * Loads the text domain and initializes the main plugin class.
	 */
	function plugin_name_init() {
		load_plugin_textdomain( 'plugin-name', false, plugin_basename( __DIR__ ) . '/i18n' );
		Plugin_Name::instance();
	}
}
