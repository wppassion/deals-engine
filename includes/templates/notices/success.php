<?php

/**
 * Success Message Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/notices/success.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message;
	
// message class
$message = $wps_deals_message;
	
if ( $message->size( 'error' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo $message->output( 'error' );
}

?>

<div class="deals-col-12">

	<div class="deals-checkout">

		<div class="deals-message deals-success">
		
			<span>
				<?php echo apply_filters( 'wps_deals_added_to_cart_message', __( 'Item was successfully added to your cart.', 'wpsdeals' ) );?>
			</span>
				
			<a href="<?php echo $checkouturl; ?>" class="deals-checkout deals-button btn-small">
				<?php echo apply_filters( 'wps_deals_view_cart_text', __( 'View Cart', 'wpsdeals' ) ); ?> &rarr;
			</a>
			
		</div>
		
	</div>
	
</div>