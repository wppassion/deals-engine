<?php 

/**
 * Checkout Header Template
 * 
 * Override this template by copying it toyourtheme/deals-engine/checkout/header.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post,$wps_deals_message, $wps_deals_cart;

// message class
$message = $wps_deals_message;
	
// cart class
$cart = $wps_deals_cart;
	
// cart details
$cartdetails = $cart->get();
	
	
if ( $message->size( 'error' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo $message->output( 'error' );
}
	
// check if there is an item in the cart
if( !empty( $cartdetails ) ) :

?>		

	<div class="deals-row">

		<div class="deals-col-12">
				
			<div class="deals-cart-success deals-message deals-success"></div>
						
			<div class="deals-message deals-error deals-cart-error"></div>
					
			<div class="deals-cart-process-show">
				<div class="deals-cart-loader"><img src="<?php echo WPS_DEALS_URL;?>includes/images/cart-loader.gif"/></div>
			</div>
					
		</div>
				
	</div>

<?php
	endif;
?>

<div class="deals-container deals-cart-details deals-clearfix">

<?php
	
		/**
		 * wps_deals_checkout_header_content hook
		 *
		 * @hooked wps_deals_cart_details - 5
		 * @hooked wps_deals_cart_action_buttons - 10
		 */
		do_action( 'wps_deals_checkout_header_content' );
?>

</div>