<?php 

/**
 * Empty Cart Button Template
 *
 * Override this template by copying it to yourtheme/deals-engine/checkout/header/cart-action-buttons/cart-empty-button.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options;

?>

<button name="wps_deals_cart_empty" class="deals-button deals-cart-empty">
	<?php echo apply_filters( 'wps_deals_empty_cart_button_text',__('Empty Cart','wpsdeals') );?>
</button>
