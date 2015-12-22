<?php 

/**
 * Checkout Content Template
 * 
 * Displays the content between the Cart Details and the Customer Info, such as the social login buttons.
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_cart;

// cart class
$cart = $wps_deals_cart;
	
// cart details
$cartdetails = $cart->get();

?>

<?php
	/**
	 * wps_deals_checkout_top hook
	 */
	do_action( 'wps_deals_checkout_top' );
?>

<?php
	if( !empty( $cartdetails ) ) { //check cart details should not blank
?>
		<div class="deals-cart-wrapper">
			<?php
				/**
				 * wps_deals_checkout_middle_content hook
				 *
				 * @hooked wps_deals_cart_social_login - 5
				 */
				do_action( 'wps_deals_checkout_middle_content' );
			?>
		</div>
	<?php
	}
?>

<?php
	/**
	 * wps_deals_checkout_bottom hook
	 */
	do_action( 'wps_deals_checkout_bottom' );
?>