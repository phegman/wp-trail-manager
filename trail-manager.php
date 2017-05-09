<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://peterhegman.com/
 * @since             1.0.0
 * @package           Trail_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Trail Manager
 * Plugin URI:        
 * Description:       Manage trail networks and display them on the front end
 * Version:           1.0.0
 * Author:            Peter Hegman
 * Author URI:        https://peterhegman.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trail-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trail-manager-activator.php
 */
function activate_trail_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trail-manager-activator.php';
	Trail_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trail-manager-deactivator.php
 */
function deactivate_trail_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trail-manager-deactivator.php';
	Trail_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_trail_manager' );
register_deactivation_hook( __FILE__, 'deactivate_trail_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-trail-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trail_manager() {

	$plugin = new Trail_Manager();
	$plugin->run();

}
run_trail_manager();
