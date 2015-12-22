<?php 

/**
 * Add to Cart Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/add-to-cart.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_model,$post;
	
$prefix = WPS_DEALS_META_PREFIX;
	
$dealtype = $wps_deals_model->wps_deals_get_deal_type( $post->ID );
	
$behaviourbutton = get_post_meta( $post->ID, $prefix . 'behavior', true );
	
?>	
	
<div class="deals-product-btn deals-col-12 deals-clearfix">
		
	<?php 
		// check if it's an affiliate deal
		if( $dealtype == 'affiliate' ) {

			/**
			 * wps_deals_single_purchase_link hook
			 *
			 * @hooked wps_deals_purchase_link_button (outputs the affiliate link button)
			 */
			do_action( 'wps_deals_single_purchase_link' );
				
		} else if( $behaviourbutton == 'direct' ) { // check if it's a buy now button

			/**
			 * wps_deals_single_buy_now hook
			 *
			 * @hooked wps_deals_buy_now_button (outputs the buy now button)
			 */
			do_action( 'wps_deals_single_buy_now' );
					
		} else {

			/**
			 * wps_deals_single_add_to_cart hook
			 *
			 * @hooked wps_deals_add_to_cart_button (outputs the add to cart button)
			 */
			do_action( 'wps_deals_single_add_to_cart' );			
		}
	?>
	
</div>