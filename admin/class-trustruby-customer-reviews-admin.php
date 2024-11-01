<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       trustruby
 * @since      1.0.0
 *
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/admin
 * @author     TrustRuby <info@trustruby.com>
 */
class Trustruby_Customer_Reviews_Admin {

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
		 * An instance of this class should be passed to the run() function
		 * defined in Trustruby_Customer_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trustruby_Customer_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trustruby-customer-reviews-admin.css', array(), $this->version, 'all' );

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
		 * defined in Trustruby_Customer_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trustruby_Customer_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_enqueue_script( $this->plugin_name . '-trustruby-embedding-script', '//trustruby.com/js/widget/main.es5.js', [], '1.0.0', false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/trustruby-customer-reviews-admin.js', [ 'jquery' ], $this->version, false );

	}
	
	public function setup_sections() {
		add_settings_section( 'trustruby_first_section', 'Collect Customer Reviews for your Website', false, 'trustruby_fields' );
	}
	public function setup_fields() {
		
		$host_name = get_option( 'trustruby_domain' );
		if( empty( $host_name ) )
		{
			$option = parse_url(get_site_url());
			$host = $option['host'];
			$host_names = explode(".", $host);
			$host_name = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];
		}
		$api_key = get_option( 'trustruby_api_key' );
		$should_send_invitations = get_option('trustruby_should_send_invitations');

		$fields = [
	        [
	            'uid' => 'trustruby_domain',
	            'label' => 'Your Domain',
	            'section' => 'trustruby_first_section',
	            'type' => 'text',
	            'options' => false,
	            'placeholder' => 'Type the domain you want to collect reviews for',
	            'helper' => '',
	            'supplemental' => '(without http://, https:// or www)',
	            'default' => $host_name,
	            'field_callback' => 'form_field'
	        ],
	        [
	            'uid' => 'trustruby_api_key',
	            'label' => 'Your API Key',
	            'section' => 'trustruby_first_section',
	            'type' => 'text',
	            'options' => false,
	            'placeholder' => 'Paste your API Key',
	            'helper' => '',
	            'supplemental' => 'If you don\'t have an API Key yet, you can register and <a href="https://trustruby.com/business" target="_blank">create one here</a>. It\'s free!',
	            'default' => $api_key,
	            'field_callback' => 'form_field'
	        ],
	        [
	            'uid' => 'trustruby_should_send_invitations',
	            'label' => 'Send review invitations after successfully placing an order',
	            'section' => 'trustruby_first_section',
	            'type' => 'checkbox',
	            'options' => false,
	            'placeholder' => '',
	            'helper' => '',
	            'supplemental' => 'Requires WooCommerce and a TrustRuby API Key',
	            'default' => $should_send_invitations,
	            'field_callback' => 'form_field'
	        ],
    	];
	    foreach( $fields as $field ){
	        add_settings_field( $field['uid'], $field['label'], $field['field_callback'], 'trustruby_fields', $field['section'], $field );
	        register_setting( 'trustruby_fields', $field['uid'] );
	    }
	
	}
	
	public function add_admin_menu() {
		add_menu_page( 'TrustRuby Reviews - Build Trust and Collect Customer Reviews', 'TrustRuby<br />Customer Reviews', 'manage_options', 'trustruby.php', 'trustruby_admin_page', 'dashicons-tickets', 6  );
		
		require_once('partials/trustruby-customer-reviews-admin-display.php');
	}
}
