<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option('meetup-rsvp-publisher_rsvp_field_order');
delete_option('webilect_meetup_rsvp_publisher_options_transient_value');
delete_option('webilect_meetup_rsvp_publisher_options_transient_period');
delete_option('webilect_meetup_rsvp_publisher_options_show_hide_rsvp_fields_list');
delete_option('webilect_meetup_rsvp_publisher_options_rsvp_field_list');
delete_option('webilect_meetup_rsvp_publisher_options_rsvp_card_style_format');
delete_option('webilect_meetup_rsvp_publisher_options_main_container_blah');
delete_option('webilect_meetup_rsvp_publisher_options_api_key_value');
delete_option('webilect_meetup_rsvp_publisher_options_api_key');

delete_transient('webilect_meetup_rsvps');
delete_transient('webilect_meetup_rsvps_groups');
