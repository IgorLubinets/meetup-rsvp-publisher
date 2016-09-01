<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://igorcodes.com
 * @since             1.0.0
 * @package           Meetup_Rsvp_Publisher
 *
 * @wordpress-plugin
 * Plugin Name:       Meetup RSVP Publisher
 * Plugin URI:        http://igorcodes.com/meetup-rsvp-publisher
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Igor Lubinets
 * Author URI:        http://igorcodes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       meetup-rsvp-publisher
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-meetup-rsvp-publisher-activator.php
 */
function activate_meetup_rsvp_publisher() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-meetup-rsvp-publisher-activator.php';
	Meetup_Rsvp_Publisher_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-meetup-rsvp-publisher-deactivator.php
 */
function deactivate_meetup_rsvp_publisher() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-meetup-rsvp-publisher-deactivator.php';
	Meetup_Rsvp_Publisher_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_meetup_rsvp_publisher' );
register_deactivation_hook( __FILE__, 'deactivate_meetup_rsvp_publisher' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-meetup-rsvp-publisher.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_meetup_rsvp_publisher() {

	$plugin = new Meetup_Rsvp_Publisher();
	$plugin->run();

}
run_meetup_rsvp_publisher();
