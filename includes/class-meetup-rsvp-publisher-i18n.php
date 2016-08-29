<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/includes
 * @author     Igor Lubinets <igor@webilect.com>
 */
class Meetup_Rsvp_Publisher_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'meetup-rsvp-publisher',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
