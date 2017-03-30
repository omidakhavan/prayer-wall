<?php
/**
 * Register Post Type for prayer wall
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp Prayer Wall
 */

/**
* Register post type for prayer wall
*/
class Wnpw_Post_Type {
	
	function __construct() {
		
		add_action( 'init', array( $this, 'register_post' ) );
				
	}

	function register_post() {

		$labels = array(
			'name'               => _x( 'Prayer Wall', 'post type general name', 'wnpw' ),
			'singular_name'      => _x( 'prayerwall', 'post type singular name', 'wnpw' ),
			'menu_name'          => _x( 'Prayer Wall', 'admin menu', 'wnpw' ),
			'name_admin_bar'     => _x( 'Prayer Wall', 'add new on admin bar', 'wnpw' ),
			'add_new'            => _x( 'Add New', 'book', 'wnpw' ),
			'add_new_item'       => __( 'Add New Pray', 'wnpw' ),
			'new_item'           => __( 'New Pray', 'wnpw' ),
			'edit_item'          => __( 'Edit Pray', 'wnpw' ),
			'view_item'          => __( 'View Pray', 'wnpw' ),
			'all_items'          => __( 'All Prays', 'wnpw' ),
			'search_items'       => __( 'Search Pray', 'wnpw' ),
			'parent_item_colon'  => __( 'Parent Pray:', 'wnpw' ),
			'not_found'          => __( 'No Pray found.', 'wnpw' ),
			'not_found_in_trash' => __( 'No Pray found in Trash.', 'wnpw' )
			);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Prayer Wall.', 'wnpw' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'prayer-wall' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' )
			);

		register_post_type( 'prayerwall', $args );
	}
}