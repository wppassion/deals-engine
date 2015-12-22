<?php

/**
 * Add To Cart Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/add-to-cart/add-to-cart-button.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $addcartbtntext ) return;

global $wps_deals_options;

?>

<?php
if( $soldout === true ) { ?>
	<a class="deals-sold-out-button <?php echo $btncolor; ?> deals-button btn-big">
		<?php echo apply_filters( 'wps_deals_sold_out_text', $soldout_btn_label ) ;?>
	</a>
<?php 
} else if( isset($wps_deals_options['item_quantities']) && !empty($wps_deals_options['item_quantities']) && $wps_deals_options['item_quantities'] == '1') {
	if($incart) { ?>
		<input type="hidden" id="deals_id" name="wps_deals_id" class="deals-id" value="<?php echo $dealid;?>" />
		
		<a href="<?php echo $checkouturl;?>" class="deals-checkout <?php echo $btncolor; ?> deals-button btn-big" style="display:block">
			<?php echo apply_filters( 'wps_deals_view_cart_text', __( 'View Cart', 'wpsdeals' ) ); ?>
		</a>
	<?php } else { ?>
		<a href="javascript:void(0);" class="deals-add-to-cart-button <?php echo $btncolor; ?> deals-button btn-big">
			<?php echo apply_filters( 'wps_deals_add_to_cart_text', $addcartbtntext ) ;?>
		</a>
					
		<input type="hidden" id="deals_id" name="wps_deals_id" class="deals-id" value="<?php echo $dealid;?>" />
					
		<div class="deals-cart-process-show">
			<img class="deals-cart-loader" src="<?php echo WPS_DEALS_URL.'includes/images/cart-loader.gif';?>"/>
		</div>
		
		<a href="<?php echo $checkouturl;?>" class="deals-checkout <?php echo $btncolor; ?> deals-button btn-big">
			<?php echo apply_filters( 'wps_deals_view_cart_text', __( 'View Cart', 'wpsdeals' ) ); ?>
		</a>
	<?php }	
} else { ?>
	<a href="javascript:void(0);" class="deals-add-to-cart-button <?php echo $btncolor; ?> deals-button btn-big">
		<?php echo apply_filters( 'wps_deals_add_to_cart_text', $addcartbtntext ) ;?>
	</a>
				
	<input type="hidden" id="deals_id" name="wps_deals_id" class="deals-id" value="<?php echo $dealid;?>" />
				
	<div class="deals-cart-process-show">
		<img class="deals-cart-loader" src="<?php echo WPS_DEALS_URL.'includes/images/cart-loader.gif';?>"/>
	</div>
				
	<a href="<?php echo $checkouturl;?>" class="deals-checkout <?php echo $btncolor; ?> deals-button btn-big">
		<?php echo apply_filters( 'wps_deals_view_cart_text', __( 'View Cart', 'wpsdeals' ) ); ?>
	</a>
<?php } ?>