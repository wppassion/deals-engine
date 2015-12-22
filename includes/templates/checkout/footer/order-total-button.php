<?php 

/**
 * Order Total and Order Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/order-total-button.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>									

<div class="deals-details deals-clearfix">

	<div class="deals-order-total">	
		<?php 
			/**
			 * wps_deals_cart_footer_total_button hook
			 *
			 * @hooked wps_deals_cart_order_total_footer - 5
			 * @hooked wps_deals_cart_place_order_button_footer - 10
			 */
			do_action( 'wps_deals_cart_footer_total_button' );
		?>
	</div>
	
</div>