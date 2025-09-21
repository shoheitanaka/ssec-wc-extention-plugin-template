<?php
/**
 * Admin Plugin Name class file.
 *
 * @package Plugin_Name
 * @since 1.0.0
 */

namespace SSEC\Admin;

use Automattic\WooCommerce\Internal\Admin\Loader;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'SSEC\Admin\SSEC_Admin_Page' ) ) :

	/**
	 * Admin Plugin Class
	 */
	class SSEC_Admin_Page {

		/**
		 * Plugin options array.
		 *
		 * @var array
		 */
		private $options;

		/**
		 * Admin menu slug.
		 *
		 * @var string
		 */
		private $menu_slug;

		/**
		 * Constructor.
		 *
		 * @param array $options Plugin options array.
		 * @since 1.0.0
		 */
		public function __construct( $options ) {
			$this->options   = $options;
			$this->menu_slug = 'ssec-overview';

			add_action( 'admin_enqueue_scripts', array( $this, 'ssec_admin_register_scripts' ) );
			add_action( 'admin_menu', array( $this, 'register_ssec_admin_overview_page' ) );
			add_filter( 'admin_body_class', array( $this, 'add_ssec_admin_body_class' ) );
		}

		/**
		 * Instance of this class.
		 *
		 * @var SSEC_Admin_Page
		 */
		private static $instance;

		/**
		 * Get the instance of this class.
		 *
		 * @return SSEC_Admin_Page
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
				self::$instance->init( array() );
			}
			return self::$instance;
		}

		/**
		 * Initialize the plugin.
		 */
		private function init() {
		}

		/**
		 * Register SSEC WC admin overview page.
		 *
		 * @since 1.0.0
		 */
		public function register_ssec_admin_overview_page() {
			add_menu_page(
				$this->options['page_title'] ?? 'SSEC',
				$this->options['menu_title'] ?? 'SSEC',
				'manage_options',
				$this->menu_slug,
				array( $this, 'ssec_admin_overview_page_callback' ),
				PLUGIN_NAME_URL . 'assets/images/ssec_icon.svg',
				56
			);
		}

		/**
		 * Callback function for SSEC admin overview page.
		 *
		 * @since 1.0.0
		 */
		public function ssec_admin_overview_page_callback() {
			Loader::page_wrapper();
		}

		/**
		 * Register and enqueue admin scripts and styles for SSEC admin pages.
		 *
		 * @since 1.0.0
		 */
		public function ssec_admin_register_scripts() {
			$script_path       = PLUGIN_NAME_PATH . '/assets/build/ssec/admin/overview.js';
			$script_asset_path = PLUGIN_NAME_PATH . '/assets/build/ssec/admin/overview.asset.php';
			$script_asset      = file_exists( $script_asset_path )
			? require $script_asset_path
			: array(
				'dependencies' => array(),
				'version'      => filemtime( $script_path ),
			);
			$script_url        = PLUGIN_NAME_URL . 'assets/build/ssec/admin/overview.js';

			wp_register_script(
				$this->menu_slug,
				$script_url,
				$script_asset['dependencies'],
				$script_asset['version'],
				true
			);

			wp_register_style(
				$this->menu_slug,
				PLUGIN_NAME_URL . '/assets/build/ssec/admin/overview.css',
				// Add any dependencies styles may have, such as wp-components.
				array(),
				filemtime( PLUGIN_NAME_PATH . '/assets/build/ssec/admin/overview.css' )
			);

			wp_enqueue_script( $this->menu_slug );
			wp_enqueue_style( $this->menu_slug );
		}

		/**
		 * Add custom body class for SSEC admin pages.
		 *
		 * @param string $classes Existing admin body classes.
		 * @return string Modified admin body classes.
		 * @since 1.0.0
		 */
		public function add_ssec_admin_body_class( $classes ) {
			$screen = get_current_screen();
			if ( isset( $screen->id ) && 'toplevel_page_' . $this->menu_slug === $screen->id ) {
				$classes .= ' ssec-admin-page';
			}
			return $classes;
		}
	}
endif;
