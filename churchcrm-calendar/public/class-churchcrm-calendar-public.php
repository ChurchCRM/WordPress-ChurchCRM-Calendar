<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    ChurchCRM_Calendar
 * @subpackage ChurchCRM_Calendar/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    ChurchCRM_Calendar
 * @subpackage ChurchCRM_Calendar/public
 * @author     Your Name <email@example.com>
 */
class ChurchCRM_Calendar_Public {

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
	 * The default attributes for the shortcode
	 *
	 * @since  1.0.0
	 * @access  private
	 * @var
	 */
	 private $churchcrm_calendar_list_shortcode_atts_defaults;

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

		$this->churchcrm_calendar_list_shortcode_atts = array();
		$this->churchcrm_calendar_list_shortcode_atts_defaults = array(
			"max"=>stripslashes_deep( get_option('_events_count_max') ),
      "cat"=>""
		);
		$this->churchcrm_calendar_register_shortcodes();

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
		 * defined in ChurchCRM_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ChurchCRM_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/churchcrm-calendar-public.css', array(), $this->version, 'all' );

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
		 * defined in ChurchCRM_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ChurchCRM_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/churchcrm-calendar-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register plugin shortcode(s)
	 *
	 * @since 1.17
	 */
	public function churchcrm_calendar_register_shortcodes() {

		add_shortcode( 'churchcrm-calendar-list', array( $this, 'churchcrm_calendar_list_shortcode_callback' ) );

	}

	/**
	 * Callback for [simple-staff-list]
	 *
	 * @since 1.17
	 */
	public function churchcrm_calendar_list_shortcode_callback( $atts = array() ) {
		
		global $crmc_sc_output;
		
		$this->churchcrm_calendar_list_shortcode_atts = shortcode_atts( $this->churchcrm_calendar_list_shortcode_atts_defaults, $atts, 'churchcrm-calendar-list' );
		//print_r($atts);
		include( 'partials/churchcrm-calendar-list-shortcode-display.php' );
		return $crmc_sc_output;

	}

}
