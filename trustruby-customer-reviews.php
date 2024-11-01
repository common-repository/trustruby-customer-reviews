<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              trustruby
 * @since             1.0.0
 * @package           Trustruby_Customer_Reviews
 *
 * @wordpress-plugin
 * Plugin Name:       TrustRuby Customer Reviews
 * Plugin URI:        trustruby-reviews
 * Description:       Display and collect reviews from your customers. Increase your sales by displaying easy-to-embed widgets for free!
 * Version:           1.2.0
 * Author:            TrustRuby
 * Author URI:        https://trustruby.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trustruby_customer_reviews
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TRUSTRUBY_CUSTOMER_REVIEWS_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trustruby-customer-reviews-activator.php
 */
function activate_trustruby_customer_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trustruby-customer-reviews-activator.php';
	Trustruby_Customer_Reviews_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trustruby-customer-reviews-deactivator.php
 */
function deactivate_trustruby_customer_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trustruby-customer-reviews-deactivator.php';
	Trustruby_Customer_Reviews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_trustruby_customer_reviews' );
register_deactivation_hook( __FILE__, 'deactivate_trustruby_customer_reviews' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-trustruby-customer-reviews.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trustruby_customer_reviews() {

	$plugin = new Trustruby_Customer_Reviews();
	$plugin->run();

}
run_trustruby_customer_reviews();

