<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.cedcommerce.com
 * @since             1.0.0
 * @package           Woo_Func
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Functionality
 * Plugin URI:        https://www.cedcommerce.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Faiq Masood
 * Author URI:        https://www.cedcommerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-func
 * Domain Path:       /languages
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
define( 'WOO_FUNC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-func-activator.php
 */
function activate_woo_func() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-func-activator.php';
	Woo_Func_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-func-deactivator.php
 */
function deactivate_woo_func() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-func-deactivator.php';
	Woo_Func_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_func' );
register_deactivation_hook( __FILE__, 'deactivate_woo_func' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-func.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_func() {

	$plugin = new Woo_Func();
	$plugin->run();

}
run_woo_func();
