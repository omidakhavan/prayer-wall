<?php

/**
 * Load public incs.
 *
 * @since      1.0.0
 * @package    Wp Prayer Wall
 *
 */

/**
 * The admin-specific functionality of the plugin.
 */
class Wnpw_Public {

	/**
	 * The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct() {

		$this->plugin_name = 'wnpw-prayer-wall';
		$this->version = WNPW_VER;
		//add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue() {

		wp_enqueue_style( $this->plugin_name, WNPW_DIR . 'views/css/plugin-name-admin.css', array(), $this->version, 'all' );

		wp_enqueue_script( $this->plugin_name, WNPW_DIR . 'views/js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}
}