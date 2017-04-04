<?php

/**
 * Load admin incs.
 *
 * @since      1.0.0
 * @package    Wp Prayer Wall
 *
 */

interface Wnpw_Meta_Box {

	public function add();
	public function display( $post );
	public function save( $post_id );

}

class Wnpw_Meta implements Wnpw_Meta_Box {

	public function init() {

		add_action( 'add_meta_boxes', array( $this, 'add' ) );
		add_action( 'save_post', array( $this, 'save' ) );

	}

	public function add() {

		add_meta_box(
			'prayer_info',
			__( 'Prayer Information', 'wnpw' ),
			array( $this, 'display' ),
			'prayerwall',
			'advanced',
			'high'
		);

	}

	public function display( $post ) {
		
		global $post;
		
		$values = get_post_meta( $post->ID , 'prayer-wall-info' );
		$count  = get_post_meta( $post->ID , 'prayer-wall-count' );
		wp_nonce_field( 'wbpw', 'wbpw_nonce' );
		?>	
		<div class="prayer_wall_container_backend">
			<label for="first_name"><?php esc_html_e( 'First Name:', 'wnpw' ); ?></label>
			<input type="text" name="first_name" id="first_name" value="<?php echo isset($values['0']['0']) ?  esc_attr( $values['0']['0'] ) : ''; ?>">

			<label for="last_name"><?php esc_html_e( 'Last Name:', 'wnpw' ); ?></label>
			<input type="text" name="last_name" id="last_name" value="<?php echo isset( $values['0']['1'] ) ? esc_attr( $values['0']['1'] ) : ''; ?>">

			<label for="email_address"><?php esc_html_e( 'Email Address:', 'wnpw' ); ?></label>
			<input type="email" name="email_address" id="email_address" value="<?php echo isset( $values['0']['2']) ? esc_attr( $values['0']['2'] ) : ''; ?>">

			<label for="prayer_title"><?php esc_html_e( 'Prayer Request Title:', 'wnpw' ); ?></label>
			<input type="text" name="prayer_title" id="prayer_title" value="<?php echo isset($values['0']['3']) ? esc_attr( $values['0']['3'] ) : ''; ?>">

			<label for="prayer_request"><?php esc_html_e( 'Prayer Request:', 'wnpw' ); ?></label>
			<textarea name="prayer_request" id="prayer_request" cols="100" rows="10"><?php echo isset($values['0']['4']) ? esc_textarea( $values['0']['4'] ) : ''; ?></textarea>

			<input type="hidden" name="prayercount" id="prayercount" value="<?php echo isset($count['0']) ? esc_attr( $count['0'] ) : ''; ?>">
		</div>
		<style>
			input , textarea {display: block; margin: 10px 0 10px;}
		</style>
		<?php
	}

	public function save( $post_id ) {

		$post = $_POST;
		//check nonce 
		if ( !isset( $post['wbpw_nonce'] )) {
			return;
		}

		if ( !wp_verify_nonce( $_POST['wbpw_nonce'], 'wbpw' ) ) {
			return;
		}

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( !current_user_can( 'edit_post', $post_id ) ) {
			return;
        }

        $arr = array();
        array_push($arr, sanitize_text_field( $post['first_name'] ) );
        array_push($arr, sanitize_text_field( $post['last_name'] ) );
        array_push($arr, sanitize_text_field( $post['email_address'] ) );
        array_push($arr, sanitize_text_field( $post['prayer_title'] ) );
        array_push($arr, sanitize_text_field( $post['prayer_request'] ) );

		update_post_meta( $post_id, 'prayer-wall-info', $arr );
		update_post_meta( $post_id, 'prayer-wall-count', $post['prayercount'] );

	}

}