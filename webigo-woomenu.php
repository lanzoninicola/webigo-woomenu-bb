<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webigo.com.br
 * @since             1.0.0
 * @package           Webigo_Woomenu
 *
 * @wordpress-plugin
 * Plugin Name:       Webigo Woomenu
 * Plugin URI:        https://webigo.com.br
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Lanzoni Nicola
 * Author URI:        https://webigo.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       webigo-woomenu
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
define( 'WEBIGO_WOOMENU_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webigo-woomenu-activator.php
 */
function activate_webigo_woomenu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webigo-woomenu-activator.php';
	Webigo_Woomenu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webigo-woomenu-deactivator.php
 */
function deactivate_webigo_woomenu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webigo-woomenu-deactivator.php';
	Webigo_Woomenu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_webigo_woomenu' );
register_deactivation_hook( __FILE__, 'deactivate_webigo_woomenu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webigo-woomenu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webigo_woomenu() {

	$plugin = new Webigo_Woomenu();
	$plugin->run();

}
run_webigo_woomenu();
