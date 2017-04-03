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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		$this->shortcode();
		$this->ajax();
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue() {

		wp_enqueue_style( $this->plugin_name, WNPW_URL . '/views/css/prayer-wall.css', array(), $this->version, 'all' );

		wp_enqueue_script( $this->plugin_name, WNPW_URL . '/views/js/prayer-wall.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name ,  'wnpw' ,  array(
			'close_praybox_button' => __( 'CLOSE YOUR PRAYER REQUEST ', 'wnpw' ),
			'open_praybox_button'  => __( 'OPEN YOUR PRAYER REQUEST', 'wnpw' ),
			'adminurl'			   =>	admin_url( 'admin-ajax.php' ),
			'security'			   => wp_create_nonce( 'wnpw-ajax' )	
		) );

	}

	/**
	 * Create shortcode for front end.
	 *
	 * @since    1.0.0
	 */
	public function shortcode() {

		$shortcode = new Wnpw_Shortcode;
		$shortcode->init();

	}

	/**
	 * Init ajax class for process.
	 *
	 * @since    1.0.0
	 */
	public function ajax() {

		$ajax = new Wnpw_Ajax;
		$ajax->init();

	}
}