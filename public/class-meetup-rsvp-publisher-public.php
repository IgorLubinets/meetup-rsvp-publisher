<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/public
 * @author     Igor Lubinets <igor@webilect.com>
 */
class Meetup_Rsvp_Publisher_Public {

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
	 * @access   private * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/meetup-rsvp-publisher-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meetup-rsvp-publisher-public.js', array( 'jquery' ), $this->version, false );

	}

	public function webilect_meetup_rsvp_publisher_register_shortcodes() {
		add_shortcode( 'meetup-rsvps-publish', array( $this, 'webilect_meetup_rsvp_publisher_the_shortcode' ) );
	}
	
	public function webilect_meetup_rsvp_publisher_the_shortcode( $shortcode_Filters ) {

		wp_enqueue_style('slick-slider-css', plugin_dir_url( __FILE__ ) . 'css/slick.css');
		wp_enqueue_style('slick-slider-default-theme', plugin_dir_url( __FILE__ ) . 'css/slick-theme.css');

		//Don't load twice for admin, only for public use
		if( ! is_admin() ) {
			wp_enqueue_script('slick-slider-script', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', 'jquery', '', true);
			wp_enqueue_script('webilect-slick-script', plugin_dir_url( __FILE__ ) . 'js/webilect-slick-script.js', 'slick-slider-script', '', true);
		}

		Meetup_Rsvp_Publisher::$rsvps->setFilters( $shortcode_Filters );

		//echo 'Dumping filters from the shortcode function';
		//var_dump( $shortcode_Filters );

		$results = Meetup_Rsvp_Publisher::$rsvps->getCachedRSVPs();  
		//var_dump($results);

		$plugin_base_path = WP_PLUGIN_DIR . '/' . $this->plugin_name;
	
		if( false === Meetup_Rsvp_Publisher::$rsvps->error ) {
			ob_start();
			if( isset( $shortcode_Filters['display'] ) ) {
				if( $shortcode_Filters['display'] === 'list' ) {
					include( $plugin_base_path . '/includes/list.php' );
				}
				if( $shortcode_Filters['display'] === 'slider' ) {
				//	include( 'slider.php' );
					include( $plugin_base_path . '/includes/slider.php' );
				}
			} else {
				//include( 'list.php' );	
				include( $plugin_base_path . '/includes/list.php' );

			}	

			//	return ob_get_clean(); //without creating an extra variable
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		} else {
			return '<p>An Error Has Occurred :-(</p>';	
		}	
	}

}
