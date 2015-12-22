<?php 

/**
 * Deals Lost Password Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/lost-password.php
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
		 * wps_deals_lost_password_top hook
		 */
		do_action( 'wps_deals_lost_password_top' );
	?>	
						
	<?php
		/**
		 * wps_deals_lost_password_content hook
		 *
		 * @hooked wps_deals_lost_password_content - 5
		 */
		do_action( 'wps_deals_lost_password_content' );
	?>
					
	<?php
		/**
		 * wps_deals_lost_password_bottom hook
		 */
		do_action( 'wps_deals_lost_password_bottom' );
	?>	
					
</div>