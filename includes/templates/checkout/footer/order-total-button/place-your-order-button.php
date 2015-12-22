<?php 

/**
 * Place Order Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/order-total-button/place-your-order-button.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options;

// get the color scheme from the settings
$button_color = $wps_deals_options['deals_btn_color'];
$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
$regclass = is_user_logged_in() ? '' : ' deals-reg-button-submit';


?>

<input type="hidden" name="wps_deals_submit_payment" value="<?php _e('Deals Purchase','wpsdeals');?>">
<?php echo apply_filters('wps_deals_place_your_order_button','<button type="submit" class="deals-checkout-button ' . $btncolor . ' deals-button btn-big '.$regclass.'">'.__( 'Place your order','wpsdeals').'</button>');?>