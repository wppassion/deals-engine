<?php 

/**
 * Template Checkout Content Part
 * 
 * Handles to show checkout page content part
 * 
 * Override this template by copying it to
 * yourtheme/deals-engine/checkout/checkout-footer.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post,$wps_deals_message,$wps_deals_cart;
	
	//cart class
	$cart = $wps_deals_cart;
	
	//message class
	$message = $wps_deals_message;
	
	$cartdetails = $cart->get();

	if( !empty( $cartdetails ) ) { //check cart is empty or not
?>


	<div class="row-fluid">
	
		<?php
				if ( $message->size( 'cartuser' ) > 0 ) {
					// if we need to display the error message, we will do it here
		?>
					<div class="wps-deals-multierror">
						<?php echo $message->output( 'cartuser' );?>
					</div><!--wps-deals-multierror-->
					
		<?php	}  ?>
		
			<div class="wps-deals-error wps-deals-cart-user-error"></div>
	
		<form method="POST" id="wps_deals_checkout_form">
			
			<?php
			
				//do action to add content to before footer contetn on checkout page
				do_action( 'wps_deals_checkout_footer_content_before' );
				
				//do action to add content in checkout page middle part
				do_action( 'wps_deals_checkout_footer_content' );
			
				//do action to add credit card form
				do_action( 'wps_deals_checkout_cc_form' );
			
				//do action to add content to after footer contetn on checkout page
				do_action( 'wps_deals_checkout_footer_content_after' );
			?>
			
		</form>
	
	</div><!--.row-fluid-->
	
<?php 

}

?>