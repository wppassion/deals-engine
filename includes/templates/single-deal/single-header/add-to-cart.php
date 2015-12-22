<?php 

/**
 * Template Add to Cart
 * 
 * Handles to show add to cart on single 
 * deal view page
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/add-to-cart.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $wps_deals_model,$post;
	
	$prefix = WPS_DEALS_META_PREFIX;
	
	$dealtype = $wps_deals_model->wps_deals_get_deal_type( $post->ID );
	
	$behaviourbutton = get_post_meta( $post->ID, $prefix . 'behavior', true );
	
?>	
	
<div class="wps-deals-product-btn row-fluid">
		<?php 
			//check deal type is affiliate or not
			if( $dealtype == 'affiliate' ) {
				
				//if product type is affiliate
				//do action to show purchase link on single page action will call if deal type is affiliate
				do_action( 'wps_deals_single_purchase_link' );
				
			} else if( $behaviourbutton == 'direct' ) { // check behaviour button is buy now from meta
				
				// do action to show buy now button	
				do_action( 'wps_deals_single_buy_now' );
					
			} else {
					
				//if deal type is other then show add to cart button
				//do action to add to cart button on single page
				do_action( 'wps_deals_single_add_to_cart' );
			
			}
		?>
</div><!--wps-deals-product-btn-->