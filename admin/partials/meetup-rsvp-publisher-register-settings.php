<?php
	//Add settings for Meetup.com API KEY
	/////////////////////////////////////////////////////////////////	
	add_settings_section(
     $this->options_name . '_key_settings',
  	   'Meetup.com Credentials', 
     	array( $this, $this->options_name . '_api_key_text' ),
     	$this->plugin_name
  	);
	add_settings_field(
		$this->options_name . '_api_key_value',
		__( 'Enter your meetup.com API key into this field', 'meetup-rsvp-publisher' ),
		array( $this, $this->options_name . '_api_key_tab' ),
		$this->plugin_name,
		$this->options_name . '_key_settings',
		array( 'label_for' => $this->options_name . '_api_key_value' )
	);
	register_setting( $this->plugin_name, $this->options_name . '_api_key_value', array( $this, 'api_key_value_sanitation') );

	//Add settings to set slider or list 
	/////////////////////////////////////////////////////////////////	
	add_settings_section(
      $this->options_name . '_rsvps_styles_settings',
  	   'Choose Styling', 
     	array( $this, $this->options_name . '_rsvp_card_style' ),
     	$this->plugin_name
  	);
	add_settings_field(
		$this->options_name . '_rsvp_card_style_format',
		'Choose RSVP container style',
		array( $this, $this->options_name . '_rsvp_card_style_selector' ),
		$this->plugin_name,
		$this->options_name . '_rsvps_styles_settings',
		array( 'label_for' => $this->options_name . '_rsvp_card_style_format' )
	);
	register_setting( $this->plugin_name, $this->options_name . '_rsvp_card_style_format', array( $this, 'api_key_value_sanitation') );

	//Create a list of RSVP fields 
	/////////////////////////////////////////////////////////////////	
	add_settings_section(
      $this->options_name . '_rsvp_field_list_section',
  	   'RSVP Fields to Display', 
     	array( $this, $this->options_name . '_rsvp_fields_list_callback' ),
     	$this->plugin_name
  	);
	add_settings_field(
		$this->plugin_name . 'event_title', //id
		'Event Title',				//title
		array( $this, $this->options_name . '_add_event_title_callback' ), //callback
		$this->plugin_name, 
		$this->options_name . '_rsvp_field_list_section',
		//a label for our field, optional	
		array( 'label_for' => $this->options_name . '_rsvp_field_list_new[event_title]' )
	);
	register_setting( $this->plugin_name, $this->options_name . '_rsvp_field_list_new',	array( $this, 'api_key_value_sanitation') );


