<?php

/**
 * Fired during plugin activation
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/includes
 * @author     Igor Lubinets <igor@webilect.com>
 */
class Meetup_Rsvp_Publisher_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		/*
		$rsvpFieldOrder = get_option( 'meetup-rsvp-publisher_rsvp_field_order' );
		if($rsvpFieldOrder === false) {
			$rsvpFieldOrder = array( 
				'rsvp-fields-date', 
				'rsvp-fields-event-title', 
				'rsvp-fields-address', 
				'rsvp-fields-hostedby', 
				'rsvp-fields-details' 
				);
		}
		
		$showHideRsvpFields = (array)get_option( 'webilect_meetup_rsvp_publisher_options_show_hide_rsvp_fields_list' );
		if($showHideRsvpField === false) {
			$rsvpFieldOrder = array( 
				'rsvp-fields-date', 
				'rsvp-fields-event-title', 
				'rsvp-fields-address', 
				'rsvp-fields-hostedby', 
				'rsvp-fields-details' );
		}
		*/


	}

}
