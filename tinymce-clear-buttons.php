<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin
 * and defines a function that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/tyrannous/
 * @since             1.0.0
 * @package           Tinymce_Clear_Button
 *
 * @wordpress-plugin
 * Plugin Name:       TinyMCE Clear Float
 * Plugin URI:        https://wordpress.org/plugins/tinymce-clear-buttons/
 * Description:       Adds a button to the WordPress TinyMCE editor to clear floats.
 * Version:           1.3.2
 * Author:            Philipp Bammes
 * Author URI:        https://profiles.wordpress.org/tyrannous/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tinymce-clear-buttons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define admin-specific hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tinymce-clear-float.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.2.0
 */
function run_tinymce_clear_float() {

	$plugin = new Tinymce_Clear_Float();
	$plugin->run();

}
run_tinymce_clear_float();
