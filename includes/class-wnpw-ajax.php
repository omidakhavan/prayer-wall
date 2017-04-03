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

		add_action('wp_ajax_wnpwall',array ( $this , 'ajax' ) );
		add_action('wp_ajax_nopriv_wnpwall',array ( $this , 'ajax' ) );

	}

	public function ajax(){

		// security check
		check_ajax_referer( 'wnpw-ajax', 'security' );

		// insert post
		$post = array(
			'post_title' => sanitize_text_field( $_POST['title'] ),
			'post_status' => 'pending',
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

}