<?php 

/**
 * Shopping Cart Details Template
 * 
 * Displays the Deals added to the shopping cart.
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/header/cart-details.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_render,$wps_deals_cart,$wps_deals_price,$wps_deals_currency,$wps_deals_model,$wps_deals_options;
	
$prefix = WPS_DEALS_META_PREFIX;
	
// render class
$render = $wps_deals_render;
	
// price class
$price = $wps_deals_price;
	
// cart class 
$cart = $wps_deals_cart;
	
// currency error
$currency = $wps_deals_currency;
	
// get cart details
$cartdetails = $cart->get();
	
?>

<div class="deals-row">

	<div class="deals-col-12 deals-cart-details">

	<?php
		
		if( !empty( $cartdetails ) ) { //check cart details should not blank
			
			//current date time
			$today = wps_deals_current_date('Y-m-d H:i:s');
			
			$totalamount = isset($cartdetails['total']) ? $cartdetails['total'] : '';
			
			$totalqty = 0;
			
			/**
			 * wps_deals_cart_table_before hook
			 */
			do_action( 'wps_deals_cart_table_before', $cartdetails );
			
		?>
		<table class="table">
			<thead>
				<tr class="alternate">
					<?php 
						/**
						 * wps_deals_cart_table_header_before hook
						 */
						do_action( 'wps_deals_cart_table_header_before' );
					?>
					<th width="10%" class="deals-remove">&nbsp;</th>
					<th width="60%" class="deals-name"><?php _e('Product','wpsdeals');?></th>
					<?php 
						/**
						 * wps_deals_cart_table_header_product_after hook
						 */
						do_action( 'wps_deals_cart_table_header_product_after' );
					?>
					<th width="10%" class="deals-quantity"><?php _e('QTY','wpsdeals');?></th>
					<?php 
						/**
						 * wps_deals_cart_table_header_qty_after hook
						 */
						do_action( 'wps_deals_cart_table_header_qty_after' );
					?>
					<th width="20%" class="deals-subtotal"><?php _e('Price','wpsdeals');?></th>
					<?php 
						/**
						 * wps_deals_cart_table_header_after hook
						 */
						do_action( 'wps_deals_cart_table_header_after' );
					?>
				</tr>
			</thead>
			
			<tbody>
				
			<?php 	
				
				/**
				 * wps_deals_cart_table_content_before hook
				 */
				do_action( 'wps_deals_cart_table_content_before', $cartdetails );
				
					foreach ( $cartdetails['products'] as $item )	 {
									
						$error = '';
						$dealname = get_the_title($item['dealid']);
						
						//product price
						$productprice = $price->wps_deals_get_price($item['dealid']);
						
							$quantity = $item['quantity'];
						
						$totalqty =	( $totalqty + $quantity );
						
						//get the value of quantity availablity of stock
						$available = get_post_meta($item['dealid'],$prefix.'avail_total',true);
						
						//get the value of end date 
						$enddate = get_post_meta($item['dealid'],$prefix.'end_date',true);
						
						//get the value of end date 
						$startdate = get_post_meta($item['dealid'],$prefix.'start_date',true);
						
						if ( $enddate < $today ) { //check deal end date is greater then current date
							$error = __('No longer available.','wpsdeals');
						}else if ( $startdate > $today ) { //check deal start date for deal is started or not
							$error = __('Not started yet.','wpsdeals');
						}else if( $available != '' && $available < 1 ) { //check product availablity
							$error = __('Out of Stock.','wpsdeals');
						} else if ( $quantity > $available && $available != '' ) { //check inserted quantity and available 
							$error = sprintf( __('Only %1$s deal(s) are available.', 'wpsdeals' ), $available );
						}
			?>
						<tr class="deals-product-details">
							<?php 
								/**
								 * wps_deals_cart_table_deal_remove_before hook
								 */
								do_action( 'wps_deals_cart_table_deal_remove_before', $item['dealid'] );
							?>
							<td class="deals-remove">
								<a href="javascript:void(0);" class="deals-cart-item-remove" item-id="<?php echo $item['dealid'];?>" title="<?php _e('Remove Item','wpsdeals');?>"><img src="<?php echo WPS_DEALS_URL;?>includes/images/cross.gif" alt="<?php _e('Remove','wpsdeals');?>"/></a>
							</td>
							<?php 
								/**
								 * wps_deals_cart_table_deal_remove_after hook
								 */
								do_action( 'wps_deals_cart_table_deal_remove_after', $item['dealid'] );
							?>
							<td class="deals-name">
								<a href="<?php echo get_permalink($item['dealid']);?>" title="<?php echo $dealname;?>"><?php echo $dealname;?></a><br />
								<?php
									echo $wps_deals_model->wps_deals_get_bundled_deals_cart( $item['dealid'] );
								?>
								<span class="deals-checkout-error"><?php echo $error;?></span>
							</td>
							<?php 
								/**
								 * wps_deals_cart_table_deal_name_after hook
								 */
								do_action( 'wps_deals_cart_table_deal_name_after', $item['dealid'] );
							?>
							<td class="deals-quantity">
								<?php 
								
								if( (isset($wps_deals_options['item_quantities']) && !empty($wps_deals_options['item_quantities']) && $wps_deals_options['item_quantities'] == '1') ) { ?>
										<input type="hidden" class="deals-cart-item-qty-value" item-id="<?php echo $item['dealid'];?>" value="<?php echo $quantity;?>" size="1"/>																		
										<span><?php echo $quantity;?></span>
								<?php } else { ?>
										<input type="number" class="deals-cart-item-qty-value" item-id="<?php echo $item['dealid'];?>" value="<?php echo $quantity;?>" size="1"/>										
								<?php } ?>								
							</td>
							<?php 
								/**
								 * wps_deals_cart_table_deal_qty_after hook
								 */
								do_action( 'wps_deals_cart_table_deal_qty_after', $item['dealid'] );
							?>
							<td class="deals-subtotal">
								<?php 	
										//apply filter to modify cart deal price on checkout page
										$cartdealprice = apply_filters( 'wps_deals_checkout_price', $productprice, $item['dealid'] );
										$cartdealpricehtml = $price->get_display_price( $cartdealprice, $item['dealid'] );
										
										//apply filter to modify cart deal price html on checkout page
										echo apply_filters( 'wps_deals_checkout_price_html', $cartdealpricehtml, $item['dealid'] );
								?>
							</td>
							<?php 
								/**
								 * wps_deals_cart_table_deal_price_after hook
								 */
								do_action( 'wps_deals_cart_table_deal_price_after', $item['dealid'] );
							?>
						</tr>
			<?php
					} //end foreach to show cart items
			
				//do action to add someting before subtotal
				do_action( 'wps_deals_cart_table_content_subtotal_before', $cartdetails );
					
				$cartsubtotal	= $cart->show_subtotal();
				$carttotal 		= $cart->show_total();
			
				if( $cartsubtotal != $carttotal )	{ //check if cart subtotal and total are not same then show subtotal row
					?>	
						<tr class="deals-cart-subtotal-row alternate">
							<td colspan="3" class="subtotal"><strong><?php echo apply_filters( 'wps_deals_checkout_subtotal_label', __('Sub Total','wpsdeals'), $cartdetails );?></strong></td>
							<td class="deals-cart-item-qty deals-subtotal">
								<?php 
										//apply filter to modify cart subtotal on checkout page
										$cartsubtotal	 = apply_filters( 'wps_deals_checkout_subtotal', $cartsubtotal, $cartdetails );
										$displaysubtotal = apply_filters( 'wps_deals_checkout_subtotal_html', $currency->wps_deals_formatted_value( $cartsubtotal ), $cartdetails );
										echo $displaysubtotal;
								?>
							</td>
						</tr>
					<?php
				
				} //end if
				
				//Display Cart Fees Values, both positive and negative fees
				if( wps_deals_cart_has_fees() ) {  //cart has fees or not
				
					foreach( wps_deals_get_cart_fees() as $fee_key => $fee_val ) { 
					?>
						<tr id="deals_cart_fee_<?php echo $fee_key; ?>">
							<td colspan="3"><?php echo $fee_val['label']; ?></td>
							<td class="deals-subtotal"><?php echo $fee_val['display_amount']; ?></td>
						</tr>
					<?php
					} //endforeach
				} //endif
									
				/**
				 * wps_deals_cart_table_content_after hook
				 */
				do_action( 'wps_deals_cart_table_content_after', $cartdetails );
			?>
			</tbody>
			
			<tfoot>
					<?php 
						/**
						 * wps_deals_cart_table_footer_before hook
						 */
						do_action( 'wps_deals_cart_table_footer_before', $cartdetails );
					?>
					<tr class="alternate">
						<td class="total" colspan="3"><?php echo apply_filters( 'wps_deals_checkout_total_label', __('Total ','wpsdeals'), $cartdetails );?></td>
						<td class="deals-cart-item-qty deals_cart_total">
							<?php 
								//apply filter to modify cart subtotal on checkout page
								$carttotal = apply_filters( 'wps_deals_checkout_total', $carttotal, $cartdetails );
								$displaytotal = apply_filters( 'wps_deals_checkout_total_html', $currency->wps_deals_formatted_value( $carttotal ), $cartdetails );
								echo $displaytotal;
							?>
						</td>
					</tr>
					<?php 
						/**
						 * wps_deals_cart_table_footer_after hook
						 */
						do_action( 'wps_deals_cart_table_footer_after', $cartdetails );
					?>
		 	<tfoot>
		</table>
<?php
	
		/**
		 * wps_deals_cart_table_after hook
		 */
		do_action( 'wps_deals_cart_table_after', $cartdetails );
	
	} else {
		
		/**
		 * wps_deals_cart_empty hook
		 *
		 * @hooked wps_deals_empty_cart_message - 5
		 */
		do_action( 'wps_deals_cart_empty' );
	}
?>
	</div>
	
</div>