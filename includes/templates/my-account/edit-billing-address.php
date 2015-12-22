<?php 

/**
 * Edit Billing Address Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/edit-billing-address.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message;

if ( $wps_deals_message->size( 'cartuser' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo '<div class="deals-multierror">';
	echo 	$wps_deals_message->output( 'cartuser' );
	echo '</div>';
}

?>
	
<div class="deals-message deals-error deals-cart-user-error"></div>
	
<form method="POST" action="">
	
	<?php
		/**
		 * wps_deals_manage_billing_address hook
		 */
		do_action( 'wps_deals_manage_billing_address' );
	?>
		
	<div class="deals-save-address-wrapper">
		
		<p class="deals-form-submit">
			<input type="submit" class="button deals-save-address-btn" name="wps_deals_save_billing_address" value="<?php _e( 'Save Address', 'wpsdeals' ) ?>">
		</p>
			
	</div>
		
</form>