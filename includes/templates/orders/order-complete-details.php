<?php 

/**
 * Order Complete Details Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/orders/order-complete-details.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

global $wps_deals_model,$wps_deals_options,$current_user,$wps_deals_session;

//model class
$model = $wps_deals_model;

//session class
$session = $wps_deals_session;

$prefix = WPS_DEALS_META_PREFIX;

$orderargs = array();

//check user is logged in or not if user is logged in then use url's order id
if( is_user_logged_in() ) {
		
	$order_id = isset( $_GET['order_id'] ) ?  $_GET['order_id'] : '';
	$orderargs = array( 'author' => $current_user->ID, 'p' => $order_id );
		
} else { //guest order data

	$order_id = $session->get( 'wps_deals_last_ordered_id' );
	$order_id = !empty( $order_id ) ? $order_id : '0';
	$orderargs = array( 'author' => '0', 'p' => $order_id );

}

//get user's orders data
$salesdata = $model->wps_deals_get_sales( $orderargs );
$salesdata = array_shift( $salesdata );

//check sales data is not empty for particular user and order id
if( !empty( $salesdata ) && !empty( $order_id ) ) {

	// get the value for the user details from the post meta box
	$userdetails = $model->wps_deals_get_ordered_user_details( $order_id );
	
	// get the value for the order details from the post meta box
	$order_details = $model->wps_deals_get_post_meta_ordered( $order_id );
	
	// get the value for the payment status from the post meta box
	$payment_status = $model->wps_deals_get_ordered_payment_status( $order_id );
	
	//payment status value
	$payment_status_val = $model->wps_deals_get_ordered_payment_status( $order_id, true );

	//get order date for payment
	$orderddate = $model->wps_deals_get_date_format( $salesdata['post_date'] );
	
	//get ordered files
	$orderedfiles = $model->wps_deals_get_ordered_file_list( $order_id );
	
	/**
	 * wps_deals_order_view_content_before hook
	 */
	do_action( 'wps_deals_order_view_content_before', $order_id );
	
	?>
		<table id="deals-purchase-receipt">
			<thead>
				<tr>
					<th><strong><?php _e( 'Purchase ID', 'wpsdeals' ); ?>:</strong></th>
					<th><?php echo $order_id; ?></th>
				</tr>
			</thead>
		
			<tbody>
				<?php 
					/**
					 * wps_deals_order_view_row_before hook
					 */
					do_action( 'wps_deals_order_view_row_before', $order_id );
				?>
				<tr>
					<td><strong><?php _e( 'Purchase Date', 'wpsdeals' ); ?>:</strong></td>
					<td><?php echo $orderddate; ?></td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_purchase_date_after hook
					 */
					do_action( 'wps_deals_order_view_purchase_date_after', $order_id );
				?>
				<tr>
					<td><strong><?php _e( 'Email', 'wpsdeals' ); ?>:</strong></td>
					<td><?php echo $userdetails['user_email']; ?></td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_email_after hook
					 */
					do_action( 'wps_deals_order_view_email_after', $order_id );
				?>
				<tr>
					<td><strong><?php _e( 'Total Price', 'wpsdeals' ); ?>:</strong></td>
					<td>
						<?php echo $order_details['display_order_total']; ?>
					</td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_total_after hook
					 */
					do_action( 'wps_deals_order_view_total_after', $order_id );
				?>
				<tr>
					<td><strong><?php _e( 'Payment Method', 'wpsdeals' ); ?>:</strong></td>
					<td><?php 
							$payment_method = isset( $order_details['checkout_label'] ) ? $order_details['checkout_label'] : $order_details['admin_label'];
							echo apply_filters( 'wps_deals_order_view_payment_method',$payment_method  ); 
						?>
					</td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_paymethod_after hook
					 */
					do_action( 'wps_deals_order_view_paymethod_after', $order_id );
				?>
				<tr>
					<td class="wps-deals-payment-status"><strong><?php _e( 'Payment Status', 'wpsdeals' ); ?>:</strong></td>
					<td class="wps-deals-payment-status <?php echo strtolower( $payment_status ); ?>"><?php echo $payment_status; ?></td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_paystatus_after hook
					 */
					do_action( 'wps_deals_order_view_paystatus_after', $order_id );
				?>
				<tr>
					<td><strong><?php _e( 'IP Address', 'wpsdeals' ); ?>:</strong></td>
					<td><?php echo $order_details['order_ip']; ?></td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_ipaddress_after hook
					 */
					do_action( 'wps_deals_order_view_ipaddress_after', $order_id );
				?>
			</tbody>
		</table>
		
		<?php
			/**
			 * wps_deals_order_view_purchased_deals_before hook
			 */
			do_action( 'wps_deals_order_view_purchased_deals_before',$order_id );
		?>
		
		<h3><?php echo apply_filters( 'wps_deals_payment_receipt_products_title', __( 'Purchased Deals', 'wpsdeals' ) ); ?></h3>
		
		<table id="deals-purchase-receipt-products">
			<thead>
				<?php 
					/**
					 * wps_deals_order_view_details_before hook
					 */
					do_action( 'wps_deals_order_view_details_before' );
				?>
				<th width="55%"><?php _e( 'Name', 'wpsdeals' ); ?></th>
				<th width="15%"><?php _e( 'Quantity', 'wpsdeals' ); ?></th>
				<th width="15%"><?php _e( 'Price', 'wpsdeals' ); ?></th>
				<th width="15%"><?php _e( 'Total', 'wpsdeals' ); ?></th>
				<?php 
					/**
					 * wps_deals_order_view_details_after hook
					 */
					do_action( 'wps_deals_order_view_details_after' );
				?>
			</thead>
		
			<tbody>
			
			<?php			
				/**
				 * wps_deals_order_view_details_row_before hook
				 */
				do_action( 'wps_deals_order_view_details_row_before', $order_id );
				
				foreach ( $order_details['deals_details'] as $product ) { ?>
			
					<?php 
						/**
						 * wps_deals_order_view_details_row_loop_before hook
						 */
						do_action( 'wps_deals_order_view_details_row_loop_before', $product, $order_id );
					?>
				<tr>
					<?php 
						/**
						 * wps_deals_order_view_details_name_before hook
						 */
						do_action( 'wps_deals_order_view_details_name_before', $product, $order_id );
					?>
					<td>
						<div class="deals-purchase-receipt-product-name">
						<?php 
								$deal = get_post( $product['deal_id'] );
								
								if( !empty( $deal ) ) {
						?>
									<a href="<?php echo get_permalink($product['deal_id']);?>" title="<?php echo $product['deal_title'];?>">
										<?php echo $product['deal_title']; ?>
									</a>
						<?php	} else { 
									echo $product['deal_title']; 
								} 
						?>
						</div>						
						<?php
							if( $payment_status_val == "1" ) {
								
								//get purchase note value from post metabox	
								$purchasenote = get_post_meta( $product['deal_id'], $prefix.'purchase_notes',true ); 								
								if( !empty( $purchasenote ) ) {  // if payment status is completed and not empty purchase note	
																		
									// get purchase note after applying shortcode and filter
									$purchasenote = $model->wps_deals_get_purchase_notes( $purchasenote, $product['deal_id'], $order_id );									
									echo "<div class='deals-purchase-receipt-product-notes'>" . $purchasenote . "</div>";
								}
							}
						?>																																			
						<?php
						
							//get deal type
							$dealtype = $model->wps_deals_get_deal_type( $product['deal_id'] );
							
							if( $dealtype == 'simple' ) { //check deal type is simple
								
								$downloadfiles	= '';
								
								if( $payment_status_val == '1' ) {
									
									//get files with href to send to mail in 
									$downloadfiles = nl2br( $model->wps_deals_purchase_download_links( $product, $userdetails, $order_id ) );
								}
								
								echo apply_filters( 'wps_deals_order_download_files', $downloadfiles, $product['deal_id'], $order_id );
								
							} else if( $dealtype == 'bundle' ) { //check deal type is bundle
								
								//Initilize download files
								$downloadfiles	= '';
								
								$bundled_deals = $model->wps_deals_get_bundled_deals_list( $product['deal_id'] );
								
								if( !empty( $bundled_deals ) ) {
									
									$downloadfiles .= '<ul>';
									
									foreach ( $bundled_deals as $bundled_deal ) {
										
										$downloadfiles .= "<li>".get_the_title( $bundled_deal );
										
										if( !empty( $bundled_deal ) ) {
											
											//get files with href to send to mail in 
											$bundlefiles = $model->wps_deals_purchase_download_links( array('deal_id' => $bundled_deal), $userdetails, $order_id );
											
											$bundlefiles = apply_filters( 'wps_deals_order_download_files', $bundlefiles, $bundled_deal, $order_id );
											
											$downloadfiles .= $bundlefiles;
										}
										
										$downloadfiles .= "</li>";
									}
									
									$downloadfiles .= "</ul>";
								}
								
								echo apply_filters( 'wps_deals_order_bundles', nl2br( $downloadfiles ), $product['deal_id'], $orderid );
								
							} //end if deal type
						?>
					</td>
					<?php 
						/**
						 * wps_deals_order_view_details_name_after hook
						 */
						do_action( 'wps_deals_order_view_details_name_after', $product, $order_id );
					?>	
					<td>
						<?php echo $product['deal_quantity']; ?>
					</td>
					<?php 
						/**
						 * wps_deals_order_view_details_qty_after hook
						 */
						do_action( 'wps_deals_order_view_details_qty_after', $product, $order_id );
					?>	
					<td>
						<?php echo $product['display_price']; ?>
					</td>
					<?php 
						/**
						 * wps_deals_order_view_details_price_after hook
						 */
						do_action( 'wps_deals_order_view_details_price_after', $product, $order_id );
					?>	
					<td>
						<?php echo $product['display_total']; ?>
					</td>
					<?php 
						/**
						 * wps_deals_order_view_details_total_after hook
						 */
						do_action( 'wps_deals_order_view_details_total_after', $product, $order_id );
					?>	
					
					<?php //do_action('wps_deals_popup_ordered_items_front_data_after',$product); ?>
				</tr>
					<?php 
						/**
						 * wps_deals_order_view_details_row_loop_after hook
						 */
						do_action( 'wps_deals_order_view_details_row_loop_after', $product, $order_id );
				}
					//do action to add row in view order item details row after loop
					do_action( 'wps_deals_order_view_details_row_after', $order_id );
				?>
				
			</tbody>
		
			<tfoot>
				<?php 
					/**
					 * wps_deals_order_view_footer_row_before hook
					 */
					do_action( 'wps_deals_order_view_footer_row_before', $order_id );
				?>
				<tr>
					<td></td>
					<td  colspan="2"><?php _e('Sub Total','wpsdeals');?></td>
					<td><?php echo $order_details['display_order_subtotal'];?></td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_details_subtotal_after hook
					 */
					do_action('wps_deals_order_view_details_subtotal_after',$order_id);
				
				//check fees is set in order data and not empty
				if( isset( $order_details['fees'] ) && !empty( $order_details['fees'] ) ) {
				
					foreach ( $order_details['fees'] as $fee_key => $fee_val ) {
						?> 
						 <tr>
							<td></td>
							<td colspan="2"><?php echo $fee_val['label'];?></td>
						  	<td><?php echo $fee_val['display_amount'];?></td>
						  </tr>
						<?php 
					} //end foreach loop
						
				} //end if to check there is fees is exist in order or not
				
					/**
					 * wps_deals_order_view_details_fees_after hook
					 */
					do_action('wps_deals_order_view_details_fees_after',$order_id);
				?>
				<tr>
					<td></td>
					<td colspan="2"><?php _e('Total','wpsdeals');?></td>
					<td><?php echo $order_details['display_order_total'];?></td>
				</tr>
				<?php 
					/**
					 * wps_deals_order_view_footer_row_after hook
					 */
					do_action('wps_deals_order_view_footer_row_after',$order_id);
				?>
			</tfoot>
		
		</table>
<?php		

		/**
		 * wps_deals_order_view_ordered_deals_after hook
		 */
		do_action( 'wps_deals_order_view_ordered_deals_after', $order_id );
		
		//billing details
		$billingdetails		= isset( $order_details['billing_details'] ) ? $order_details['billing_details'] : array();

		// check billing details not empty
		if( !empty( $billingdetails ) ) { 
			
			//billingcountry 
			$billingcountry		= isset( $billingdetails['country'] ) ? wps_deals_get_country_name( $billingdetails['country'] ) : '';
			//billing state
			$billingstate		= isset( $billingdetails['state'] ) ? wps_deals_get_state_name ( $billingdetails['state'], $billingdetails['country'] ) : '';
			//billing company	
			$billingcompany		= isset( $billingdetails['company'] ) ? $billingdetails['company'] : '';
			//billing adddress
			$billingaddress1	= isset( $billingdetails['address1'] ) ? $billingdetails['address1'] : '';
			$billingaddress2	= isset( $billingdetails['address2'] ) ? $billingdetails['address2'] : '';
			//billing city
			$billingcity		= isset( $billingdetails['city'] ) ? $billingdetails['city'] : '';
			//billing postcode
			$billingpostcode		= isset( $billingdetails['postcode'] ) ? $billingdetails['postcode'] : '';
			//billing phone
			$billingphone		= isset( $billingdetails['phone'] ) ? $billingdetails['phone'] : '';
?>			

		<div class="deals-view-billing-details">
			<h3><?php _e( 'Billing Details','wpsdeals' );?></h3>
			<table>
				<tbody>
					<tr>
						<td><strong><?php _e( 'Address :','wpsdeals' );?></strong></td>
						<td><?php echo $billingaddress1.'<br />'.
										$billingaddress2;?>
						</td>
					</tr>
					<?php
						/**
						 * wps_deals_order_view_billing_address_after hook
						 */
						do_action( 'wps_deals_order_view_billing_address_after', $order_id );
							
						if( !empty( $billingcompany ) ) {
					?>
					<tr>
						<td><strong><?php _e( 'Company Name :','wpsdeals' );?></strong></td>
						<td><?php echo $billingcompany;?></td>
					</tr>
					<?php
						}
						/**
						 * wps_deals_order_view_billing_company_after hook
						 */
						do_action( 'wps_deals_order_view_billing_company_after', $order_id );
					?>
					<tr>
						<td><strong><?php _e( 'Town / City :','wpsdeals');?></strong></td>
						<td><?php echo $billingcity;?></td>
					</tr>
					<?php
						/**
						 * wps_deals_order_view_billing_city_after hook
						 */
						do_action( 'wps_deals_order_view_billing_city_after', $order_id );
					?>
					<tr>
						<td><strong><?php _e( 'County / State :','wpsdeals' );?></strong></td>
						<td><?php echo $billingstate;?></td>
					</tr>
					<?php
						/**
						 * wps_deals_order_view_billing_county_after hook
						 */
						do_action( 'wps_deals_order_view_billing_county_after', $order_id );
					?>
					<tr>
						<td><strong><?php _e( 'Zip / Postal Code :','wpsdeals');?></strong></td>
						<td><?php echo $billingpostcode;?></td>
					</tr>
					<?php
						/**
						 * wps_deals_order_view_billing_postcode_after hook
						 */
						do_action( 'wps_deals_order_view_billing_postcode_after', $order_id );
					?>
					<tr>
						<td><strong><?php _e( 'Country :','wpsdeals' );?></strong></td>
						<td><?php echo $billingcountry;?></td>
					</tr>
					<?php
						/**
						 * wps_deals_order_view_billing_country_after hook
						 */
						do_action( 'wps_deals_order_view_billing_country_after', $order_id );
					?>
					<tr>
						<td><strong><?php _e( 'Phone :','wpsdeals');?></strong></td>
						<td><?php echo $billingphone;?></td>
					</tr>
					<?php
						/**
						 * wps_deals_order_view_billing_after hook
						 */
						do_action( 'wps_deals_order_view_billing_after', $order_id );
					?>
				 </tbody>
			</table>
		</div>
<?php
		} //check billing details should not empty
		
		/**
		 * wps_deals_order_view_content_after hook
		 */
		do_action('wps_deals_order_view_content_after',$order_id);

} else {
	
	echo apply_filters( 'wps_deals_success_order_message','<p>' . __( 'Thank you for your purchase! Your order has been completed successfully. You will receive an email from us within a few minutes containing the download link(s) from your purchased deal(s) as well as all the payment information for your records.', 'wpsdeals' ) . '</p>');
}
//}
?>