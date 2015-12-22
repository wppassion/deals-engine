<?php 

/**
 * Payment Gateway Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/payment-gateway.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
if(count($paymentgatway) > 1) { //when more than one payment gateways selected then show dropdown
	
?>	
	<div class="deals-payment-wrap dealsclearfix">

		<div class="deals-payment-form checkout-fields-container">
		
			<h2><?php echo apply_filters('wps_deals_cart_payment_method_label', __('Payment Method','wpsdeals'));?></h2>
					
			<?php
				/**
				 * wps_deals_checkout_payment_combo_before hook
				 */
				do_action( 'wps_deals_checkout_payment_combo_before' );
			?>			
					
			<select name="wps_deals_payment_gateways" id="deals_payment_gateways" class="deals-required-field">
				<?php 			
					foreach ($paymentgatway as $key => $gateway) {
						if( isset( $gateway['checkout_label'] ) ) {
				?>			
							<option value="<?php echo $key;?>" <?php selected( $defaultgatway, $key, true );?>><?php echo $gateway['checkout_label'];?></option>
				<?php 		
						}
					}
				?>		
			</select>
			
			<?php
				/**
				 * wps_deals_checkout_payment_combo_after hook
				 */
				do_action( 'wps_deals_checkout_payment_combo_after' );
			?>			
		</div>

	</div>

	<?php
	
} else {
	//when more than one payment gateways selected then show dropdown
?>
	<input type="hidden" name="wps_deals_payment_gateways" id="deals_payment_gateways" value="<?php echo key($paymentgatway);?>"/>
	
<?php 
}
?>