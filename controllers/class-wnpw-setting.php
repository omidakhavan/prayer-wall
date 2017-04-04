<?php
/**
 * Register prayer wall setting
 */
require_once WNPW_DIR . 'controllers/class-wnpw-settingapi.php' ; 
if ( !class_exists( 'Wnpw_Settings' ) ):
	class Wnpw_Settings {

		private $settings_api;

		function __construct() {

			$this->settings_api = new Wnpw_Setting_API;
			add_action( 'admin_init', array($this, 'admin_init') );
			add_action( 'admin_menu', array($this, 'admin_menu') );

		}
		function admin_init() {

       	 	//set the settings
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );
        	//initialize settings
			$this->settings_api->admin_init();

		}
		function admin_menu() {

			add_submenu_page( 'edit.php?post_type=prayerwall', __( 'Setting', 'wnpw' ), __( 'Setting', 'wnpw' ), 'delete_posts', 'prayer_wall',  array($this, 'plugin_page') );

		}
		function get_settings_sections() {
			$sections = array(
				array(
					'id' => 'general_tab',
					'title' => __( 'General Settings', 'avla-maintenance' )
					)
				);
			return $sections;
		}
    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
    	$settings_fields = array(
    		'general_tab' => array(
                array(
                    'name'              => 'wnpw_submitform',
                    'label'             => __( 'Submit Form ShortCode', 'wnpw' ),
                    'desc'              => __( 'Copy this code and implent in your pages.', 'wnpw' ),
                    'type'              => 'text',
                    'default'           => '[prayer-form]'
                    ),                              
                array(
                    'name'              => 'wnpw_form',
                    'label'             => __( 'Prayer ShortCode', 'wnpw' ),
                    'desc'              => __( 'Copy this code and implent in your pages.', 'wnpw' ),
                    'type'              => 'text',
                    'default'           => '[prayer-wall]'
    			),
                array(
                    'name'              => 'wnpw',
                    'label'             => __( 'Auto Publish Pray', 'wnpw' ),
                    'desc'              => __( 'Defult is pending and all pray wait for admin verification.', 'wnpw' ),
                    'type'              => 'radio',
                    'options'           => array(
                            'publish' => 'Publish',
                            'pending'  => 'Pending'
                    ),
                    'default'           => 'pending'
                ),
            )
    		);
return $settings_fields;
}
function plugin_page() {
	echo '<div class="wrap">';
	$this->settings_api->show_navigation();
	$this->settings_api->show_forms();
	echo '</div>';
}
    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
    	$pages = get_pages();
    	$pages_options = array();
    	if ( $pages ) {
    		foreach ($pages as $page) {
    			$pages_options[$page->ID] = $page->post_title;
    		}
    	}
    	return $pages_options;
    }
}
endif;