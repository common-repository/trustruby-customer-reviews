<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       trustruby
 * @since      1.0.0
 *
 * @package    Trustruby_Customer_Reviews
 * @subpackage Trustruby_Customer_Reviews/admin/partials
 */
function trustruby_display_partial($partial) {
		ob_start();
		require_once($partial);
		$output = ob_get_contents();
		ob_end_clean();
	  	echo $output;
}


function trustruby_admin_page(){
		trustruby_display_partial('trustruby-customer-reviews-admin-options.php');	     
}
?>


