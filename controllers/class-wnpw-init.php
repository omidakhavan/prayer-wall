<?php

/**
 * Loader class that includes and loads dependencies and implements activation and desactivation methods
 *
 * @since      1.0.0
 * @package    Wp Prayer Wall
 *
 */

if ( ! class_exists( 'Wnpw_Init' ) ) {

	class Wnpw_Init {

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		public function __construct() {

			$this->init();
			$this->set_locale();
			$this->set_posttype();
			$this->init_setting();
			$this->define_admin_hooks();
			$this->define_public_hooks();
		}

		/**
		 * Inin and include main classes and functions.
		 *
		 * @since    1.0.0
		 */
		private function init() {

			/**
			 * The class responsible for defining internationalization functionality
			 * of the plugin.
			 */
			require_once WNPW_DIR . 'controllers/class-wnpw-i18n.php';			

			/**
			 * Create post type for prayer wall.
			 */
			require_once WNPW_DIR . 'controllers/class-wnpw-posttype.php';

			/**
			 * Call To Option Page Panel
			 */
			require_once WNPW_DIR .'controllers/class-wnpw-setting.php';

			/**
			 * Load admin includes.
			 */
			require_once WNPW_DIR . 'includes/class-wnpw-admin.php';

			/**
			 * Load Public includes
			 */
			require_once WNPW_DIR . 'includes/class-wnpw-public.php';
	
			/**
			 * Load Admin MetBox.
			 */
			require  WNPW_DIR . 'includes/class-wnpw-meta.php';

			/**
			 * Load public shortcode.
			 */
			require  WNPW_DIR . 'includes/class-wnpw-shortcode.php';

			/**
			 * Load public shortcode.
			 */
			require  WNPW_DIR . 'includes/class-wnpw-ajax.php';

		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * @since    1.0.0
		 */
		private function set_locale() {

			$plugin_i18n = new Wnpw_i18n();
			$plugin_i18n->load_plugin_textdomain();

		}		

		/**
		 * Register post type for prayer wall.
		 *
		 * @since    1.0.0
		 */
		private function set_posttype() {

			$posttype = new Wnpw_Post_Type();

		}

		/**
		 * Register prayer wall setting.
		 *
		 * @since    1.0.0
		 */
		private function init_setting() {

			$posttype = new Wnpw_Settings();

		}

		/**
		 * Register all of the hooks related to the admin area functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_admin_hooks() {

			$admin_assets = new Wnpw_Admin();

		}

		/**
		 * Register all of the hooks related to the public-facing functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_public_hooks() {

			$plugin_public = new Wnpw_Public();

		}


	}
}