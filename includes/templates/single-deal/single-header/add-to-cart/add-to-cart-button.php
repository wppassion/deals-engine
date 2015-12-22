<?php

/**
 * Template For Add to cart Button
 * 
 * Handles to show add to cart buttons
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/add-to-cart/add-to-cart-button.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $addcartbtntext ) return;

	//ob_start();
?>
	<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<a href="javascript:void(0);" class="wps-deals-add-to-cart-button"><?php echo apply_filters( 'wps_deals_add_to_cart_text', $addcartbtntext .' <span itemprop="price">'.$displayprice.'</span>', $addcartbtntext, $displayprice );?></a>
		<input type="hidden" id="wps_deals_id" name="wps_deals_id" class="wps-deals-id" value="<?php echo $dealid;?>" />
		<div class="wps-deals-cart-process-show">
			<img class="wps-deals-cart-loader" src="<?php echo WPS_DEALS_URL.'includes/images/cart-loader.gif';?>"/>
			<span class="wps-deals-cart-msg"><?php echo apply_filters('wps_deals_added_to_cart_message', __( 'Item was successfully added to your cart.', 'wpsdeals' ) );?></span>
		</div>
		<a href="<?php echo $checkouturl;?>" class="wps-deals-checkout"><?php echo apply_filters( 'wps_deals_view_cart_text', __('View Cart', 'wpsdeals') );?></a>
		<link itemprop="availability" href="http://schema.org/InStock" />
	</div>
<?php
	//$addcartmarkup = ob_get_clean();
	//echo apply_filters( 'wps_deals_add_to_cart_button', $addcartmarkup, $dealid, $displayprice );
?>
	