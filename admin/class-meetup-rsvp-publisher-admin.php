<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/admin
 * @author     Igor Lubinets <igor@webilect.com>
 */
class Meetup_Rsvp_Publisher_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	/**
	 * The options name to be used in this plugin
	 * 
	 * @access private
	 * @var string $option_name	meetup-rsvp-publisher-options
	 */
	private $options_name = 'webilect_meetup_rsvp_publisher_options';


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function * defined in Meetup_Rsvp_Publisher_Loader as all of the hooks are defined * in that particular class.
		 *
		 * The Meetup_Rsvp_Publisher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/meetup-rsvp-publisher-admin.css', array(), $this->version, 'all' );
	
	//buggy css file
		wp_enqueue_style( 'slick-styles', plugins_url() . '/meetup-rsvp-publisher/public/css/slick.css' );		

		//add public stylesheet for preview pane
		//revise later?
		wp_enqueue_style( 'include-preview-pane-styles', plugins_url() . '/meetup-rsvp-publisher/public/css/meetup-rsvp-publisher-public.css' );	
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meetup_Rsvp_Publisher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meetup_Rsvp_Publisher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'backbone' );		
		wp_enqueue_script( 'jquery-ui-core' );
		
//		wp_enqueue_script('jquery-ui-draggable');
//		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-touch-punch');

		wp_enqueue_script('jquery-ui-spinner');	

		wp_enqueue_script( 'slick-slider', plugins_url() . '/meetup-rsvp-publisher/public/js/slick.min.js', $this->plugin_name, '', true);		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meetup-rsvp-publisher-admin.js', array( 'jquery', 'backbone', 'slick-slider' ), $this->version, true);
	
	}

	/**
	 * Add options page under the Settings submenu
	 * 
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Meetup RSVP Publisher', 'meetup-rsvp-publisher' ),
			__( 'Meetup RSVP Publisher', 'meetup-rsvp-publisher' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
		
		add_options_page(
			'Meetup RSVP Publisher Settings',
			'Meetup RSVP Publisher Settings',
			'manage_options',
			'meetup-rsvp-publisher-settings', /* url slug */
			array( $this, 'display_key_settings' )
		); 
		remove_submenu_page( 'options-general.php', 'meetup-rsvp-publisher-settings' );

		add_options_page(
			__( 'Meetup RSVP Publisher Documentation', 'meetup-rsvp-publisher-documentation' ),
			__( 'Meetup RSVP Publisher Documentation', 'meetup-rsvp-publisher-documentation' ),
			'manage_options',
			'meetup-rsvp-publisher-documentation',
			array( $this, 'display_plugin_documentation_page' )
		); 
		remove_submenu_page( 'options-general.php', 'meetup-rsvp-publisher-documentation' );
	
		add_options_page(
			'Meetup RSVP Publisher Security',
			'Meetup RSVP Publisher Security',
			'manage_options',
			$this->plugin_name . '-security', /* url slug */
			array( $this, 'display_plugin_security_page' )
		); 
		remove_submenu_page( 'options-general.php', 'meetup-rsvp-publisher-security' );


	}

	/**
	 * Render the options page for meetup-rsvp-publisher
	 *
	 */
	public function display_options_page() {
		include_once 'partials/meetup-rsvp-publisher-admin-display.php';
	}
	/**
	 * Render the options page for meetup-rsvp-publisher
	 *
	 */
	public function display_key_settings() {
		include_once 'partials/meetup-rsvp-publisher-admin-settings.php';
	}
	/**
	 * Render the documentation page for meetup-rsvp-publisher
	 *
	 */
	public function display_plugin_documentation_page() {
		include_once 'partials/meetup-rsvp-publisher-admin-documentation.php';
	}
	/**
	 * Render the Security page for meetup-rsvp-publisher
	 * This is where you input your Meetup.com API Key
	 */
	public function display_plugin_security_page() {
		include_once 'partials/meetup-rsvp-publisher-admin-security.php';
	}

	/**
	 * Register all related settings for Meetup RSVPs Publisher here
	 *
	 */
	public function register_setting() {
	
		//Add Security settings to hold Meetup.com API KEY
		/////////////////////////////////////////////////////////////////	
		add_settings_section(
	      $this->options_name . '_key_settings',
   	   'Meetup.com Credentials', 
      	array( $this, $this->options_name . '_api_key_text' ),
      	$this->plugin_name . '-security'  
   	);
		add_settings_field(
			$this->options_name . '_api_key_value',
			__( 'Enter your meetup.com API key into this field', 'meetup-rsvp-publisher' ),
			array( $this, $this->options_name . '_api_key_tab' ),
			$this->plugin_name . '-security',
			$this->options_name . '_key_settings',
			array( 'label_for' => $this->options_name . '_api_key_value' )
		);
		register_setting( $this->plugin_name . '_security_key', $this->options_name . '_api_key_value', array( $this, 'api_key_value_sanitation') );


		//Add Transient Period for the API call
		////////////////////////////////////////////////////////////////	
		add_settings_section(
	      $this->options_name . '_transient_settings',
   	   'Meetup API Polling Period', 
      	array( $this, $this->options_name . '_transient_period_callback' ),
      	$this->plugin_name . '-security'
   	);
		add_settings_field(
			$this->plugin_name . '_transient_period', //id
			'Note:  Meetup limits the number of API requests',				//title
			array( $this, $this->options_name . '_transient_period_field_callback' ), //callback
			$this->plugin_name . '-security', 
			$this->options_name . '_transient_settings'
		);
		register_setting( $this->plugin_name . '_security_key', $this->options_name . '_transient_period',	array( $this, 'api_key_value_sanitation') );


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

/*		add_settings_section(
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
*/

	} //End register setting...


/* Not needed now, but keep it around for little longer 
	public function webilect_meetup_rsvp_publisher_options_rsvp_fields_list_callback() {
		echo '<hr style="background-color: red; height: 3px"><h4>Handle RSVP Fields</h4>';
	} 
	public function webilect_meetup_rsvp_publisher_options_add_event_title_callback() {
		$options = (array)get_option( $this->options_name . '_rsvp_field_list_new' );
	?>
		<input type="checkbox" id="event_title" 
			name="<?php echo $this->options_name . '_rsvp_field_list_new[event_title]'; ?>"
		 	<?php 
			if( isset($options['event_title']) ) { 
				echo 'checked'; 
			}
			?> />
	<?php
	}
*/

	// Functions to render settings sections and fields
	/////////////////////////////////////////////////////////////
	public function webilect_meetup_rsvp_publisher_options_api_key_text() {
		echo '<hr><h2>' . __( 'Please enter Your Meetup.com API key', 'meetup-rsvp-publisher' ) . '</h2>';
	}

	public function webilect_meetup_rsvp_publisher_options_api_key_tab() { 
		$api_key = get_option( $this->options_name . '_api_key_value' ); 
		?>
		<input type="text" name="<?php echo $this->options_name . '_api_key_value';?>" 
				id="<?php echo $this->options_name . '_api_key_value'; ?>" value="<?php echo $api_key; ?>"
				style="width: 300px; height: 50px;" />
	<?php
	}

	public function webilect_meetup_rsvp_publisher_options_transient_period_callback() {
		echo '<hr><h2>Specify how often to poll Meetup.com for new data</h2>';
	}

	public function webilect_meetup_rsvp_publisher_options_transient_period_field_callback() { 
	?>
		<?php
		/** Nugget to display current page, to selectively load scripts **/
		//		global $current_screen;
		//	 echo $current_screen->id; ?>	

		<?php
		//Load the array containing the transient period values
		$transient_period = (array)get_option( $this->options_name . '_transient_period' );
		$transient_value = 0;
		
		//process the transient period: convert to seconds + store in the DB
		foreach( $transient_period as $key => $value) {
			if( $key === 'seconds' && isset($value) )  {
				$transient_value += $value * 1;	
			}
			else if( $key === 'minutes' && isset($value) )  {
				$transient_value += $value * 60;	
			}
			else if( $key === 'hours' && isset($value) )  {
				$transient_value += $value * 60 * 60;	
			}
			else if( $key === 'days' && isset($value) )  {
				$transient_value += $value * 60 * 60 * 24;	
			}
		}
		update_option( $this->options_name . '_transient_value', $transient_value, true );
		//	echo '<h2>Transient Value:  ' . $transient_value . '</h2>';
		
		?>
	
	<table style="table-layout: fixed; width: 300px">
		<tbody>
			<tr>
				<th style="vertical-align: middle; width: 80px; text-align: right">	
					<label for="seconds">Seconds: </label>
				</th>
				<td>
					<input id="seconds" name="<?php echo $this->options_name . '_transient_period[seconds]'; ?>"
						value="<?php echo ( isset($transient_period['seconds']) ) ? $transient_period['seconds'] : ''; ?>" 
						type="text" style="width: 80px; height: 50px"/> <br>
				</td>
			</tr>
			<tr style="vertical-align: middle;">
				<th style="vertical-align: middle; text-align: right">
					<label style="vertical-align: middle" for="minutes">Minutes: </label>
				</th>
				<td>
					<input id="minutes" name="<?php echo $this->options_name . '_transient_period[minutes]'; ?>"
						value="<?php echo ( isset($transient_period['minutes']) ) ? $transient_period['minutes'] : ''; ?>" 
						type="text" style="width: 80px; height: 50px;"/> <br>	
				</td>
			</tr>	
			<tr>
				<th style="vertical-align: middle; text-align: right;">	
					<label for="hours">Hours: </label>
				</th>
				<td>
					<input id="hours" name="<?php echo $this->options_name . '_transient_period[hours]'; ?>"
						value="<?php echo ( isset($transient_period['hours']) ) ? $transient_period['hours'] : ''; ?>" 
						type="text" style="width: 80px; height: 50px"/> <br>	
				</td>
			</tr>
			<tr>
				<th style="vertical-align: middle; text-align: right">
					<label for="days">Days: </label>
				</th>
				<td>	
					<input id="days" name="<?php echo $this->options_name . '_transient_period[days]'; ?>"
						value="<?php echo ( isset($transient_period['days']) ) ? $transient_period['days'] : ''; ?>" 
						type="text" style="width: 80px; height: 50px"/> <br> 	
				</td>
			</tr>	
		</tbody>
	</table>


	<?php 
	}

	public function api_key_value_sanitation( $input ) {
		return $input; //does nothing right now, dummy function
	}

	public function webilect_meetup_rsvp_publisher_options_rsvp_card_style() { 
		echo '<hr style="background-color: red; height: 3px"><h2>Please choose the RSVP layout</h2>';
	}

	public function webilect_meetup_rsvp_publisher_options_rsvp_card_style_selector() { 
		$rsvp_style_format = get_option($this->options_name . '_rsvp_card_style_format');
	?>
		<select name="<?php echo $this->options_name . '_rsvp_card_style_format'; ?>" 
				id="<?php echo $this->options_name . '_rsvp_card_style_format'; ?>"
				style="width: 160px; height: 35px; font-size: 1.35em; padding: 5px">
			<option value="slider" <?php echo ( 'slider'===$rsvp_style_format ) ? 'selected' : ''; ?> >Slider</option>
			<option value="list" <?php echo ( 'list'===$rsvp_style_format ) ? 'selected' : ''; ?> >List</option>
		</select>	
	<?php
	}
	///////////////////////////////////////////////////////////
	// End AUX Functions

	// WP ADMIN AJAX FUNCTIONS
 	//////////////////////////////////////////////////////////
	public function handle_wrong_api_key() {

	}
	/*
	 * Function for AJAX requests for JS enabled components
	 *
	 */
	public function webilect_rsvp_publish_ajax() {
  		$results = Meetup_Rsvp_Publisher::$rsvps->getCachedRSVPs();
		
		//echo 'Shortcode received: ' . $_POST['shortcode'];	
		//wp_send_json( $results );

		//echo do_shortcode('[meetup-rsvps-publish show="all" display="slider" admin_preview="true" /]');	
		echo do_shortcode( stripslashes($_POST['shortcode'])  );	
		
		/*
		$response = WP_Ajax_Response( $dummy );
		$response->send();
		exit();
		*/
		wp_die();
	}
	
	/*
	 * Function for AJAX requests to reorder RSVP fields 
	 *
	 */
	public function webilect_rsvp_publish_rsvp_fields_reorder_ajax() {
		$rsvpFieldOrder = $_POST['rsvpFieldOrder'];
		
		if( isset($rsvpFieldOrder) ) {
			update_option( $this->plugin_name . '_rsvp_field_order', $rsvpFieldOrder, true ); 
		}	
		echo "success!!!";
		echo "received: " . json_encode($rsvpFieldOrder);  
		
		wp_die();
	}
 	//////////////////////////////////////////////////////////
	// END WP ADMIN AJAX FUNCTIONS

}
