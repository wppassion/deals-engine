<?php 

/**
 * Template Checkout Footer Part
 * 
 * Handles to show checkout page footer part
 * 
 * Override this template by copying it to
 * yourtheme/deals-engine/checkout/checkout-content.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $wps_deals_cart;

	//cart class
	$cart = $wps_deals_cart;
	
	$cartdetails = $cart->get();

	if(!empty($cartdetails)) { //check cart details should not blank
	
		?>
			<div class="row-fluid">
				<?php
					//do action to add content in footer
					do_action( 'wps_deals_checkout_middle_content' );
				?>
			</div><!--row-fluid-->
		<?php
	}
?>