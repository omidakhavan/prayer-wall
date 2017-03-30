<?php

/**
 *
 * @link              http://webnus.biz
 * @since             1.0.0
 * @package           Wp Prayer Wall
 *
 * @wordpress-plugin
 * Plugin Name:       Prayer Wall
 * Plugin URI:        http://webnus.biz
 * Description:       Add awesome prayer wall to your wordpress site.
 * Version:           1.0.0
 * Author:            Webnus
 * Author URI:        http://Webnus.biz/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wnpw
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define Some Var
 */
define( 'WNPW_VER', '1.0.0' );
define( 'WNPW_DIR', plugin_dir_path(  __FILE__  ));
define( 'WNPW_URL', plugins_url( '' , __FILE__ ));

require_once WNPW_DIR . 'controllers/class-wnpw-init.php';
new Wnpw_Init;