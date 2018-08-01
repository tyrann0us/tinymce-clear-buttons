<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across the admin area.
 *
 * @link       https://profiles.wordpress.org/tyrannous/
 * @since      1.2.0
 *
 * @package    Tinymce_Clear_Float
 * @subpackage Tinymce_Clear_Float/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define admin-specific hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.2.0
 * @package    Tinymce_Clear_Float
 * @subpackage Tinymce_Clear_Float/includes
 * @author     Philipp Bammes <tyrannous@chat.wordpress.org>
 */
class Tinymce_Clear_Float {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.2.0
	 * @access   protected
	 * @var      Tinymce_Clear_Float_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.2.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.2.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.2.0
	 */
	public function __construct() {

		$this->plugin_name = 'tinymce-clear-float';
		$this->version = '1.3.2';

		$this->load_dependencies();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tinymce_Clear_Float_Loader. Orchestrates the hooks of the plugin.
	 * - Tinymce_Clear_Float_Admin. Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.2.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tinymce-clear-float-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tinymce-clear-float-admin.php';

		$this->loader = new Tinymce_Clear_Float_Loader();

	}

	/**
	 * Register all of the hooks related to the admin area functionality of the plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tinymce_Clear_Float_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_filter( 'mce_buttons_2', $plugin_admin, 'add_tinymce_button' );
		$this->loader->add_filter( 'mce_css', $plugin_admin, 'add_tinymce_css' );
		$this->loader->add_filter( 'mce_external_languages', $plugin_admin, 'add_tinymce_language' );
		$this->loader->add_filter( 'mce_external_plugins', $plugin_admin, 'add_tinymce_plugin' );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'add_thanks_links', 10, 2 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.2.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.2.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.2.0
	 * @return    Tinymce_Clear_Float_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.2.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
