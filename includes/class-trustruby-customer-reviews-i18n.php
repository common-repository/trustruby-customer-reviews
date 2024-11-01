<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       trustruby
 * @since      1.0.0
 *
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/includes
 * @author     TrustRuby <info@trustruby.com>
 */
class Trustruby_Customer_Reviews_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'trustruby-customer-reviews',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
