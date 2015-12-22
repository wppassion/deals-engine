<?php 

/**
 * Cart Update Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/header/cart-action-buttons/cart-update-button.php
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

?>

<button name="wps_deals_cart_update" class="<?php echo $btncolor; ?> deals-button deals-cart-item-update">
	<?php echo apply_filters( 'wps_deals_update_cart_button_text',__('Update Cart','wpsdeals') );?>
</button>