<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/tyrannous/
 * @since      1.2.0
 *
 * @package    Tinymce_Clear_Float
 * @subpackage Tinymce_Clear_Float/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and all required hooks.
 *
 * @package    Tinymce_Clear_Float
 * @subpackage Tinymce_Clear_Float/admin
 * @author     Philipp Bammes <tyrannous@chat.wordpress.org>
 */
class Tinymce_Clear_Float_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The assets suffix.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $asset_suffix    `.min` if SCRIPT_DEBUG is set and true, empty string otherwise.
	 */
	private $asset_suffix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.2.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->asset_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	}

	/**
	 * Add TinyMCE Clear Float CSS to get applied in the TinyMCE editor window.
	 *
	 * @since    1.2.0
	 */
	public function add_tinymce_css( $stylesheets ) {

		if ( ! empty( $stylesheets ) ) {
			$stylesheets .= ',';
		}
		$stylesheets .= plugin_dir_url( __FILE__ ) . "tinymce/{$this->plugin_name}/css/{$this->plugin_name}{$this->asset_suffix}.css";
		return $stylesheets;

	}

	/**
	 * Add TinyMCE Clear Float button to the TinyMCE toolbar.
	 *
	 * @param    array    $plugins    An array of all plugins.
	 * @return   array
	 *
	 * @since    1.2.0
	 */
	public function add_tinymce_button( $buttons ) {

		array_push( $buttons, $this->plugin_name );
		return $buttons;

	}

	/**
	 * Add language file for TinyMCE Clear Float plugin.
	 *
	 * @param    array    $locaes    An array of all locales.
	 * @return   array
	 *
	 * @since    1.2.0
	 */
	public function add_tinymce_language( $locales ) {

		$locales[ $this->plugin_name ] = plugin_dir_path( __FILE__ ) . "tinymce/{$this->plugin_name}/languages/{$this->plugin_name}-lang.php";
		return $locales;

	}

	/**
	 * Add the TinyMCE Clear Float plugin.
	 *
	 * @param    array    $plugins    An array of all plugins.
	 * @return   array
	 *
	 * @since    1.2.0
	 */
	public function add_tinymce_plugin( $plugins ) {

		$plugin_name = str_replace( '-', '_', $this->plugin_name . '-plugin' );

		$plugins[ $plugin_name ] = plugin_dir_url( __FILE__ ) . "tinymce/{$this->plugin_name}/js/plugin{$this->asset_suffix}.js";
		return $plugins;

	}

	/**
	 * Add link to PayPal donation page and wordpress.org rating page.
	 * 
	 * @param    array     $data    Current plugin row links.
	 * @param    string    $file    Plugin basename.
	 * @return   array     $data    Merged array with links.
	 *
	 * @since    1.2.0
	 */
	public static function add_thanks_links( $data, $file ) {

		if ( 'tinymce-clear-buttons/tinymce-clear-buttons.php' !== $file ) {
			return $data;
		}
		if ( current_user_can( 'manage_options' ) ) {
			return array_merge( $data, array(
				sprintf(
					'<a href="%s" target="blank">%s</a>',
					'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=T5JM3KRTUBEZA',
					__( 'Donate', 'tinymce-clear-buttons' )
				),
				sprintf(
					'<a href="%s" target="blank">%s</a>',
					'https://wordpress.org/support/plugin/tinymce-clear-buttons/reviews/#new-post',
					__( 'Rate', 'tinymce-clear-buttons' )
				)
			) );
		}
		return $data;

	}

}
