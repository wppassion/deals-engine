<?php 

/**
 * Template Checkout Header Part
 * 
 * Handles to show checkout page header part
 * 
 * Override this template by copying it to
 * yourtheme/deals-engine/checkout/checkout-header.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post,$wps_deals_message, $wps_deals_cart;

	//message class
	$message = $wps_deals_message;
	
	//cart class
	$cart = $wps_deals_cart;
	
	$cartdetails = $cart->get();
	
	
	if ( $message->size( 'error' ) > 0 ) {
		// if we need to display the error message, we will do it here
		echo $message->output( 'error' );
	}
	
	if( !empty( $cartdetails ) ) {

?>		
		<div class="wps-deals-cart-success"></div>
			
		<div class="wps-deals-error wps-deals-cart-error"></div>
		
		<div class="wps-deals-cartdetails-loader"><img src="<?php echo WPS_DEALS_URL;?>includes/images/cart-loader.gif"/></div>
<?php		

	}
		//do action to add checkout cart header content
		//it will show only when cart is not empty
		do_action( 'wps_deals_checkout_header_content' );

?>