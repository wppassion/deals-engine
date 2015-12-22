<?php

/**
 * Order History Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/ordered-deals.php
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
		 * wps_deals_orders_top hook
		 */
		do_action( 'wps_deals_orders_top' );
	?>
				
	<?php
		/**
		 * wps_deals_orders_content hook
		 *
		 * @hooked wps_deals_orders_content - 5
		 */
		do_action( 'wps_deals_orders_content' );
	?>
					
	<?php
		/**
		 * wps_deals_orders_bottom hook
		 */
		do_action( 'wps_deals_orders_bottom' );
	?>
					
</div>