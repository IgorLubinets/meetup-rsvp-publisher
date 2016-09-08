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
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meetup-rsvp-publisher-admin.js', array( 'jquery', 'backbone' ), $this->version, false );
		wp_enqueue_script( 'slick-slider', plugins_url() . '/meetup-rsvp-publisher/public/js/slick.min.js', $this->plugin_name, '', false );		
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
			__( 'Meetup RSVP Publisher Settings', 'meetup-rsvp-publisher-settings' ),
			__( 'Meetup RSVP Publisher Settings', 'meetup-rsvp-publisher-settings' ),
			'manage_options',
			'meetup-rsvp-publisher-settings',
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


	}

	/**
	 * Render the options page for meetup-rsvp-publisher
	 *
	 */
	public function display_options_page() {

//		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/Meetup_RSVPS.php';

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
	 * Render the options page for meetup-rsvp-publisher
	 *
	 */
	public function display_plugin_documentation_page() {
		include_once 'partials/meetup-rsvp-publisher-admin-documentation.php';
	}

	/**
	 * Register all related settings for Meetup RSVPs Publisher here
	 *
	 */
	public function register_setting() {
	
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
	}

	public function webilect_meetup_rsvp_publisher_options_api_key_text() {
		echo '<hr><h2>' . __( 'Please enter Your Meetup.com API key', 'meetup-rsvp-publisher' ) . '</h2>';
	}

	public function webilect_meetup_rsvp_publisher_options_api_key_tab() { 
		$api_key = get_option( $this->options_name . '_api_key_value' ); 
		//		var_dump( $api_key );
		?>
		<input type="text" name="<?php echo $this->options_name . '_api_key_value';?>" 
				id="<?php echo $this->options_name . '_api_key_value'; ?>" value="<?php echo $api_key; ?>"
				style="width: 300px; height: 50px;" />
	<?php
	}

	public function api_key_value_sanitation( $input ) {
		return $input; //does nothing right now
	}

	/*
	 * Function for AJAX requests for JS enabled components
	 *
	 */
	public function webilect_rsvp_publish_ajax() {
  		$results = Meetup_Rsvp_Publisher::$rsvps->getCachedRSVPs();
		
//echo 'Shortcode received: ' . $_POST['shortcode'];	

//		wp_send_json( $results );

		//echo do_shortcode('[meetup-rsvps-publish show="all" display="slider" admin_preview="true" /]');	
		echo do_shortcode( stripslashes($_POST['shortcode'])  );	
		
		/*
		$response = WP_Ajax_Response( $dummy );
		$response->send();
		exit();
		*/
		wp_die();
	}
	
}
