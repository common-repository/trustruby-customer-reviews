<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       trustruby
 * @since      1.0.0
 *
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/public
 * @author     TrustRuby <info@trustruby.com>
 */
class Trustruby_Customer_Reviews_Public {

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
		 * defined in Trustruby_Customer_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trustruby_Customer_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trustruby-customer-reviews-public.css', array(), $this->version, 'all' );

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
		 * defined in Trustruby_Customer_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trustruby_Customer_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/trustruby-customer-reviews-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function register_shortcodes() {
		 add_shortcode( 'trustruby_widget', [$this, 'trustruby_shortcodes'] );
	}
	
	public function trustruby_shortcodes( $atts ) {
		if( is_home() || is_single() || is_page() || is_category() || is_tax() )
		{
				$atts = shortcode_atts( [
				'type' => 'mini',	
				'width' => '90px',
				'height' => '100%',
				'domain' => get_option('trustruby_domain'),
				'placeholder_id' => 'trw-placeholder',
				'theme' => 'light',
				'lang' => 'en',
				'number_of_reviews' => 10
			], $atts );
			ob_start();
			require_once('partials/trustruby-customer-reviews-public-widget.php');
			$output = ob_get_contents();
			ob_end_clean();
		  	return $output;
		}
	}
	
	public function on_order_completed( $order_id ) {
		$api_token = get_option( 'trustruby_api_key' );
		
		if( !empty( $api_token ) )
		{
			$domain = get_option('trustruby_domain');
			// Get an instance of the WC_Order object
			$order = wc_get_order( $order_id );
			
			$user_id   = $order->get_user_id(); // Get the costumer ID
			$user      = $order->get_user(); // Get the WP_User object
			$name = $user->data->display_name;
			$email = $user->data->user_email;
			
			$postfields = sprintf('domain=%s&email=%s&name=%s&reference=%s&api_token=%s', $domain, $email, $name, $order_id, $api_token);
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://business.trustruby.com/api/invitations',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $postfields,
				CURLOPT_HTTPHEADER => [
					'accept: application/json',
					'content-type: application/x-www-form-urlencoded'
				],
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			
			return [
				'response' => $response,
				'err'	=>	$err
			];
		}
	}

}
