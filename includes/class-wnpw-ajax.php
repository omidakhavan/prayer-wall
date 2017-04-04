<?php

/**
 * Prayer wall ajax process.
 *
 * @since      1.0.0
 * @package    Wp Prayer Wall
 *
 */

/**
* Create ajax class for prayer wall requests
*/
class Wnpw_Ajax {
	
	public function init() {
		// process pray submit form
		add_action('wp_ajax_wnpwall',array ( $this , 'ajaxwall' ) );
		add_action('wp_ajax_nopriv_wnpwall',array ( $this , 'ajaxwall' ) );		

		// prayer button on form
		add_action('wp_ajax_wnpwprayed',array ( $this , 'ajaxprayer' ) );
		add_action('wp_ajax_nopriv_wnpwprayed',array ( $this , 'ajaxprayer' ) );
	}

	public function ajaxwall(){

		// security check
		check_ajax_referer( 'wnpw-ajax', 'security' );
		$post_status = wnpw_get_option( 'wnpw','general_tab' );
		// insert post
		$post = array(
			'post_title' => sanitize_text_field( $_POST['title'] ),
			'post_status' => $post_status,
			'post_type' => 'prayerwall',
		);
		$postid = wp_insert_post( $post );

        $arr = array();
        array_push($arr, sanitize_text_field( $_POST['name'] ) );
        array_push($arr, sanitize_text_field( $_POST['last'] ) );
        array_push($arr, sanitize_email( $_POST['mail'] ) );
        array_push($arr, sanitize_text_field( $_POST['title'] ) );
        array_push($arr, sanitize_text_field( $_POST['request'] ) );

		update_post_meta( $postid, 'prayer-wall-info', $arr );
	}

	public function ajaxprayer(){
		// security check
		check_ajax_referer( 'wnpw-ajax', 'security' );
		update_post_meta( sanitize_text_field( $_POST['post_id'] ) , 'prayer-wall-count', $_POST['number'] );

	}

	public function wnpw_get_option( $option, $section, $default = '' ) {
		if ( empty( $option ) )
			return;
		$options = get_option( $section );
		if ( isset( $options[$option] ) ) {
			return $options[$option];
		}
		return $default;
	}

}