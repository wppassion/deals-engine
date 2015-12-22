<?php 

/**
 * Order Complete Template
 * 
 * Displays the content after the user completed the order.
 * 
 * Override this template by copying it to yourtheme/deals-engine/order-complete.php
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
		 * wps_deals_orders_complete_top hook
		 */
		do_action( 'wps_deals_orders_complete_top' );
	?>	
						
	<?php
		/**
		 * wps_deals_orders_complete_content hook
		 */
		do_action( 'wps_deals_orders_complete_content' );
	?>
					
	<?php
		/**
		 * wps_deals_orders_complete_bottom hook
		 */
		do_action( 'wps_deals_orders_complete_bottom' );
	?>	
					
</div>