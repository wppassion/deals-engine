<?php 

/**
 * Cart Action Buttons Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/header/cart-action-buttons.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_cart;
	
//cart class
$cart = $wps_deals_cart;

$cartdetails = $cart->get();
	
if ( !empty( $cartdetails ) ) :

?>
	
	<div class="deals-cart-action-buttons deals-clearfix">
		<?php 
			/**
			 * wps_deals_cart_action_buttons hook
			 *
			 * @hooked wps_deals_cart_update_button - 10
			 */
			do_action( 'wps_deals_cart_action_buttons' );
		?>
	</div>
	
<?php
endif;
?>