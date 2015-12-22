<?php 

/**
 * No Payment Gateways Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/no-payment-gatway.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//if there is no payment gateways selected then show error

?>

<div class="deals-error">
	<p>
		<?php echo apply_filters( 'wps_deals_no_payment_gateway_message', __('<strong>ERROR : </strong> You must enable a payment gateway to use '.WPS_DEALS_PLUGIN_NAME.'.', 'wpsdeals' ) );
		?>
	</p>
</div>