<?php 

/**
 * Edit Address Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/edit-address.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-container deals-clearfix">
				
	<?php
		/**
		 * wps_deals_edit_address_top hook
		 */
		do_action( 'wps_deals_edit_address_top' );
	?>	
						
	<?php
		// if the user is logged in, we will display the edit address form
		if( is_user_logged_in() ) {
			
			/**
			 * wps_deals_edit_address_content hook
			 */
			do_action( 'wps_deals_edit_address_content' );
			
		// if the user isn't logged in, we will display login form
		} else {
		
			/**
			 * wps_deals_edit_address_login_content hook
			 */
			do_action( 'wps_deals_edit_address_login_content' );
			
		}
	?>
					
	<?php
		/**
		 * wps_deals_edit_address_bottom hook
		 */
		do_action( 'wps_deals_edit_address_bottom' );
	?>	
					
</div>