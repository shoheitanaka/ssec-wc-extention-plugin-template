<?php
/**
 * Main class file for Plugin Name
 *
 * @package Plugin_Name
 * @since 1.0.0
 */

use SSEC\Admin\SSEC_Admin_Page;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Plugin Class
 */
class Plugin_Name {

	/**
	 * Instance of this class.
	 *
	 * @var Plugin_Name
	 */
	private static $instance;

	/**
	 * Get the instance of this class.
	 *
	 * @return Plugin_Name
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}

	/**
	 * Initialize the plugin.
	 */
	private function init() {
	}

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		if ( is_admin() ) {
			$admin_menu = array(
				'page_title'  => __( 'SSEC overview', 'plugin-name' ),
				'menu_title'  => __( 'SSEC', 'plugin-name' ),
				'plugin_path' => PLUGIN_NAME_PATH,
			);
			new SSEC_Admin_Page( $admin_menu );
		}
	}
}
