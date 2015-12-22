<?php 

/**
 * Order Cancel Template
 * 
 * Displays the content after the user cancelled the order.
 * 
 * Override this template by copying it to yourtheme/deals-engine/order-cancel.php
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
		 * wps_deals_orders_cancel_top hook
		 */
		do_action( 'wps_deals_orders_cancel_top' );
	?>	
						
	<?php
		/**
		 * wps_deals_orders_cancel_content hook
		 */
		do_action( 'wps_deals_orders_cancel_content' );
	?>
					
	<?php
		/**
		 * wps_deals_orders_cancel_bottom hook
		 */
		do_action( 'wps_deals_orders_cancel_bottom' );
	?>	
				
</div>