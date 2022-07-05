<?php

/**
 *           
 * @since             1.0.0
 * @package           M2sys
 *
 * @wordpress-plugin
 * Plugin Name:       M2sys
 * Plugin URI:        
 * Description:       M2sys.
 * Version:           1.0.0
 * Author:            GGLink
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       
 * Text Domain:       m2sys
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Moksy_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-m2sys-activator.php
 */
function activate_Moksy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-m2sys-activator.php';
	Moksy_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-m2sys-deactivator.php
 */
function deactivate_Moksy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-m2sys-deactivator.php';
	Moksy_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Moksy' );
register_deactivation_hook( __FILE__, 'deactivate_Moksy' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-m2sys.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Moksy() {

	$plugin = new M2sys();
	$plugin->run();

}
run_Moksy();






