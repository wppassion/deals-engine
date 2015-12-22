<?php 

/**
 * Create Account Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/create-account.php
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
		 * wps_deals_create_account_top hook
		 */
		do_action( 'wps_deals_create_account_top' );
	?>	

	<?php
		// if the user isn't logged in, we will display the create account content	
		if( !is_user_logged_in() ) {

			/**
			 * wps_deals_create_account_content hook
			 */
			do_action( 'wps_deals_create_account_content' );
			
			
		} else {

			/**
			 * wps_deals_create_account_logout_content hook
			 */
			do_action( 'wps_deals_create_account_logout_content' );
			
		}
	?>
					
	<?php
		/**
		 * wps_deals_create_account_bottom hook
		 */
		do_action( 'wps_deals_create_account_bottom' );
	?>	
					
</div>