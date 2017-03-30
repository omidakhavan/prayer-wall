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
	public function display();
	public function save();

}

class Wnpw_Meta implements Wnpw_Meta_Box {

	public function init() {

		add_action( 'add_meta_boxes', array( $this, 'add' ) );

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

	public function display() {
		?>	
			<label for=""></label>
			<input type="text" name="" id="">

			<label for=""></label>
			<input type="text" name="" id="">

			<label for=""></label>
			<input type="email" name="" id="">

			<label for=""></label>
			<input type="text" name="" id="">

			<label for=""></label>
			<textarea name="" id="" cols="30" rows="10"></textarea>

		<?php
	}

	public function save() {

	}

}