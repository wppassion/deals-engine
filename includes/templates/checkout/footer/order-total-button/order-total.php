<?php 

/**
 * Cart Total Footer Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/order-total-button/order-total.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_currency,$wps_deals_cart;
	
//get all details from cart
$cartdata = $wps_deals_cart->get();
	
$carttotal = apply_filters( 'wps_deals_checkout_total_html', $wps_deals_currency->wps_deals_formatted_value( $cartdata['total'] ), $cartdata );

?>

<div class="deals-cart-purchase-total">
	<?php echo apply_filters( 'wps_deals_cart_order_total',__('Order Total : ','wpsdeals').'<span class="deals_cart_total">'.$carttotal, $wps_deals_currency->wps_deals_formatted_value( $cartdata['total'] ));?></span>
</div>