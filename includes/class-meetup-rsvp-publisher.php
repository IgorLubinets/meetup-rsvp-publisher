<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/includes
 * @author     Igor Lubinets <igor@webilect.com>
 */
class Meetup_Rsvp_Publisher {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Meetup_Rsvp_Publisher_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * "The Meat" of this plugin:
	 * The object that hooks up to the Meetup.com API
	 * We can run queries against it
	 * Made it a static property, so that you can reference it anywhere.
	 */
	public static $rsvps;


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'meetup-rsvp-publisher';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
			
		//Create a global object instance to hook up to the Meetup.com API
		//$this->rsvps = new Meetup_RSVPS();
		//NO NEED

		$this->define_admin_hooks();
		$this->define_public_hooks();

		self::$rsvps = new Meetup_RSVPS();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Meetup_Rsvp_Publisher_Loader. Orchestrates the hooks of the plugin.
	 * - Meetup_Rsvp_Publisher_i18n. Defines internationalization functionality.
	 * - Meetup_Rsvp_Publisher_Admin. Defines all hooks for the admin area.
	 * - Meetup_Rsvp_Publisher_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-meetup-rsvp-publisher-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-meetup-rsvp-publisher-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-meetup-rsvp-publisher-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-meetup-rsvp-publisher-public.php';

		/**
		 * The Meetup_RSVPs class that communicates with Meetup.com API
		 * The "meat" of the plugin's functionality here
 		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/Meetup_RSVPS.php';
		
		/** 
		 * Handle Javascript requests here
		 *
		 */
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/Meetup_RSVPS_ajax.php';

		$this->loader = new Meetup_Rsvp_Publisher_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Meetup_Rsvp_Publisher_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Meetup_Rsvp_Publisher_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Meetup_Rsvp_Publisher_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );	
		
		//handle both public and private javascript calls to display the RSVPs
		$this->loader->add_action( 'wp_ajax_webilect_rsvp_publish_ajax', $plugin_admin, 'webilect_rsvp_publish_ajax' );
		$this->loader->add_action( 'wp_ajax_nopriv_webilect_rsvp_publish_ajax', $plugin_admin, 'webilect_rsvp_publish_ajax' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Meetup_Rsvp_Publisher_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_public, 'webilect_meetup_rsvp_publisher_register_shortcodes' );
		
	
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Meetup_Rsvp_Publisher_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
