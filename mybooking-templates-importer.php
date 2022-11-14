<?php

/*
Plugin Name: Mybooking Templates Importer
Plugin URI: https://mybooking.es/
Description: Reservation templates importer for Mybooking theme and MyBooking Reservation Engine. It allows to creating a renting or accomoodation website in minutes. 
Version: 1.0.0
Author: mybooking
Author URI: https://mybooking.es
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: mybooking-templates-importer
*/

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main plugin class with initialization tasks.
 */
class MybookingTemplatesImporter_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.3.2.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '7.2', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		}
		else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Composer autoloader.
			require_once PT_MybookingTemplatesImporter_PATH . 'vendor/autoload.php';

			// Instantiate the main plugin class *Singleton*.
			$pt_one_click_demo_import = MybookingTemplatesImporter\MybookingTemplatesImport::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'mybooking-templates-importer list', array( 'MybookingTemplatesImporter\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'mybooking-templates-importer import', array( 'MybookingTemplatesImporter\WPCLICommands', 'import' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sMybooking Demo Import%3$s plugin requires %2$sPHP 7.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 7.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'mybooking-templates-importer' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'PT_MybookingTemplatesImporter_PATH' ) ) {
			define( 'PT_MybookingTemplatesImporter_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'PT_MybookingTemplatesImporter_URL' ) ) {
			define( 'PT_MybookingTemplatesImporter_URL', plugin_dir_url( __FILE__ ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
	}


	/**
	 * Set plugin version constant -> PT_MybookingTemplatesImporter_VERSION.
	 */
	public function set_plugin_version_constant() {
		if ( ! defined( 'PT_MybookingTemplatesImporter_VERSION' ) ) {
			$plugin_data = get_plugin_data( __FILE__ );
			define( 'PT_MybookingTemplatesImporter_VERSION', $plugin_data['Version'] );
		}
	}
}

// Instantiate the plugin class.
$mybookingTemplatesImporter_plugin = new MybookingTemplatesImporter_Plugin();

// Gets demo content
require_once( 'inc/MyBookingTemplateSites.php' );
