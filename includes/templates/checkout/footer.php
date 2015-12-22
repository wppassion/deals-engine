<?php 

/**
 * Checkout Footer Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message,$wps_deals_cart;
	
// cart class
$cart = $wps_deals_cart;
	
// message class
$message = $wps_deals_message;
	
// cart details
$cartdetails = $cart->get();

// check if there is an item in the cart
if( !empty( $cartdetails ) ) :

?>

	<div class="deals-container deals-clearfix">
	
	<?php
		if ( $message->size( 'cartuser' ) > 0 ) {
		// if we need to display the error message, we will do it here
	?>
			<div class="deals-multierror">
				<?php echo $message->output( 'cartuser' );?>
			</div>
					
	<?php }  ?>
	
		<div class="deals-checkout-content">
		
			<div class="deals-message deals-error deals-cart-user-error"></div>		
	
			<form method="POST" id="deals_checkout_form">
			
			<?php
				/**
				 * wps_deals_checkout_footer_content_before hook
				 */
				do_action( 'wps_deals_checkout_footer_content_before' );
				
				/**
				 * wps_deals_checkout_footer_content hook
				 *
				 * @hooked wps_deals_checkout_payment_gateways - 5
				 * @hooked wps_deals_checkout_user_form - 10
				 * @hooked wps_deals_cart_user_personal_details - 15
				 * @hooked wps_deals_cart_user_billing_details - 20
				 */
				do_action( 'wps_deals_checkout_footer_content' );
			
				/**
				 * wps_deals_checkout_cc_form hook
				 */
				do_action( 'wps_deals_checkout_cc_form' );
			
				/**
				 * wps_deals_checkout_footer_content_after hook
				 *
				 * @hooked wps_deals_cart_agree_terms - 5
				 * @hooked wps_deals_checkout_order_total_button - 10
				 */
				do_action( 'wps_deals_checkout_footer_content_after' );
			?>
			
			</form>
			
		</div>
	
	</div>
	
<?php 
	endif;
?>