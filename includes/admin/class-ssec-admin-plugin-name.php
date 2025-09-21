<?php
/**
 * SSEC Admin Plugin Name class file.
 *
 * @package SSEC
 * @since 1.0.0
 */

namespace SSEC\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin Plugin Class
 */
class SSEC_Admin_Plugin_Name {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Constructor code here.
	}

	/**
	 * Instance of this class.
	 *
	 * @var SSEC_Admin_Plugin_Name
	 */
	private static $instance;

	/**
	 * Get the instance of this class.
	 *
	 * @return SSEC_Admin_Plugin_Name
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
		// Initialization code here.
	}
}
