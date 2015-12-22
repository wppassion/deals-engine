<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

	$salespagelink = add_query_arg(array('post_type' => WPS_DEALS_POST_TYPE,'page' => 'wps-deals-sales'),admin_url('edit.php'));
	
	$prefix = WPS_DEALS_META_PREFIX;
	
?>
<div class="wrap">
		
<?php
	
	//refund transaction message when refund successful
	if( isset( $_GET['refund'] ) && !empty( $_GET['refund'] ) && $_GET['refund']  == 'success' ) {
		
		$orderid = $_GET['order_id'];
		$editorderlink = add_query_arg(array( 'post_type' => WPS_DEALS_POST_TYPE, 'page' => 'wps-deals-sales', 'action' => 'editorder', 'order_id' => $orderid ),admin_url('edit.php'));
		
		$refundhtml = '<div class="updated fade refund-success" id="message">
							<p><strong>'.sprintf( __( 'Payment refunded successfully for Order ID # %d','wpsdeals' ), $orderid ) .'</strong></p>
							<p><strong>'.__( 'What happens next?','wpsdeals' ). '</strong></p>
							<ul>
								<li><a href="'.$salespagelink.'">'.__( 'Go to Deal Sales','wpsdeals').'</a></li>
								<li><a href="'.$editorderlink.'">'.sprintf( __( 'Go to Edit Order ID # %d','wpsdeals'), $orderid ).'</a></li>
							</ul>		
						</div>';
		
		//apply filter to change refund success message html
		echo apply_filters( 'wps_deals_refund_success_message_html',$refundhtml, $orderid ); 
		
	} else {

?>

		<!-- wpsocial logo -->
		<img src="<?php echo WPS_DEALS_URL . 'includes/images/wps-logo.png';?>" class="wpsocial-logo deals-sales-logo" alt="<?php _e('WPSocial.com Logo','wpsdeals');?>" />
		
		<h2 class="wps-deals-settings-title"><?php _e( 'Edit Sale', 'wpsdeals' );?>
		
		<a href="<?php echo $salespagelink;?>" title="<?php _e( 'Go Back to Deals Sales', 'wpsdeals' );?>" class="add-new-h2 sales-edit-button"><?php _e('Go Back','wpsdeals');?></a></h2>
		
<?php
		
		//if refund failure
		if( isset( $_GET['refund'] ) && $_GET['refund']  == 'fail' ) { //refund failure
			
			$orderid = $_GET['order_id'];
			
			echo '<div class="error" id="message">
						<p><strong>'.sprintf( __( 'Payment refund process fail for Order ID # %d','wpsdeals' ), $orderid ) .'</strong></p>
					</div>'; 
			
		} else if( isset( $_GET['refund'] ) && $_GET['refund'] == 'apierror' ) { //refund api error
			
			echo '<div class="error" id="message">
						<p><strong>'.__( 'Please Enter Paypal API User Name,Password and Signature in settings page to proceed refund.','wpsdeals' ).'</strong></p>
					</div>';
		}

	if(isset($_GET['action']) && $_GET['action'] == 'editorder' && isset($_GET['order_id']) && !empty($_GET['order_id'])) { //check order id is set or not
		
		//order id
		$orderid = $_GET['order_id'];
		
		global $wps_deals_model;
		
		//model class
		$model = $wps_deals_model;
		
		//order data 
		$orderdata = $model->wps_deals_get_post_meta_ordered($orderid);
		
		//get payment status
		$payment_status = $model->wps_deals_get_ordered_payment_status( $orderid , true );
		
		//user data 
		$userdata = $model->wps_deals_get_ordered_user_details($orderid);
		$useremail = isset($userdata['user_email']) ? $userdata['user_email'] : '';
		$userid = isset($userdata['user_id']) ? $userdata['user_id'] : '';
		
		if(isset($_POST['wps-deals-order-edit-submit']) && !empty($_POST['wps-deals-order-edit-submit']) 
			&& $_POST['wps-deals-order-edit-submit'] == __('Update Order','wpsdeals')) {

			$useremail	= isset($_POST['wps-deals-edit-order-email']) && !empty($_POST['wps-deals-edit-order-email']) 
							? $_POST['wps-deals-edit-order-email'] : '';
				
			// update the value for the user email to post meta
			update_post_meta( $orderid, $prefix.'payment_user_email', $useremail);
			
			$userdata['user_email'] = $useremail;
			
			//update userdata to database
			update_post_meta( $orderid, $prefix.'order_userdetails', $userdata );
			
			/*//update payment status
			update_post_meta($orderid, $prefix.'payment_status',$_POST['wps-deals-edit-order-payment-status']);*/
			
			//update tracking data
			$newstatus = $_POST['wps-deals-edit-order-payment-status'];
			
			//update payment status
			wps_deals_update_payment_status( $newstatus, $orderid );
			
			//get order track data
			$track = get_post_meta( $orderid, $prefix.'order_track', true );
			
			//check stored status and new status are not same
			//or order payment not is set and not empty
			if( ( $payment_status != $_POST['wps-deals-edit-order-payment-status'] ) 
					|| ( isset( $_POST['wps-deals-edit-order-payment-note'] ) 
						&& !empty( $_POST['wps-deals-edit-order-payment-note'] ) )
				 ) { //check payment note is not blank and payment status is changed
				
				$comments = '';
				if( !empty( $_POST['wps-deals-edit-order-payment-note'] ) ) { //order update comment
					$comments .= $_POST['wps-deals-edit-order-payment-note'];
				}
				//if notify custom is checked then send email to user
				$args = array();
				
				if( isset( $_POST['wps-deals-order-edit-notify'] ) && !empty( $_POST['wps-deals-order-edit-notify'] ) ) {
					
					$args['order_id']	= $orderid; //order id
					$args['email'] 		= $_POST['wps-deals-edit-order-email']; //order user email id
					
					if ( isset( $_POST['wps-deals-order-edit-append-comment'] ) && !empty( $_POST['wps-deals-order-edit-append-comment'] ) ) {
						
						$args['comments'] 		= $comments;
						$args['appendcomment']  = '1';
						
					} //end if to check append comment is set or not
					
					//send notification to customer
					$args['status'] = $model->wps_deals_paypal_value_to_status( $newstatus );
					$model->wps_deals_send_order_status_email( $args );
					
				}//check notify customer checkbox is checked or not
				
				//update order track to database
				$notify = isset( $_POST['wps-deals-order-edit-notify'] ) && !empty( $_POST['wps-deals-order-edit-notify'] ) ? '1' : '0';
				$track = array(
								'date'				=>	wps_deals_current_date('Y-m-d H:i:s'),
								'notify'			=>	$notify,
								'payment_status'	=>	$newstatus,
								'comments'			=>	$comments,
								'orderid'			=>	$orderid
							);

				//update order tracking data
				wps_deals_update_order_track( $track );
				
			} //check payment status is changed or not & payment note is not empty
			
			//call some action to update data to database
			do_action( 'wps_deals_edit_order_update', $_POST, $orderid );
			
		} //end if to check update order button is clicked or not
		
?>
<div id="wps-deals-sales" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="order" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Order Detail', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					<form method="POST" action="">
				
						<table class="form-table wps-deals-edit-sale">
							<tbody>
								<?php 
										//add something before order edit table
										do_action('wps_deals_edit_order_before',$orderid); 
								?>
								<tr>
									<th><?php _e( 'Order ID :' ,'wpsdeals');?></th>
									<td><?php echo $orderid;?>
										<input type="hidden" name="wps-deals-edit-order-id" id="wps-deals-edit-order-id" value="<?php echo $orderid;?>" /></td>
								</tr>
							
								<tr>
									<th><?php _e( 'Buyer\'s Email :' ,'wpsdeals');?></th>
									<td><input type="text" name="wps-deals-edit-order-email" id="wps-deals-edit-order-email" value="<?php echo $useremail;?>" class="large-text" /></td>
								</tr>
							
								<tr>
									<th><?php _e( 'Buyer\'s User ID :' ,'wpsdeals');?></th>
									<td><?php echo $userid;?></td>
								</tr>
							
								<tr>
									<th><?php _e( 'Deals Purchased :' ,'wpsdeals');?></th>
									<td>
									
								<?php foreach ($orderdata['deals_details'] as $key => $deal) { ?>
										<strong><?php echo get_the_title($deal['deal_id']);?></strong><br />
								<?php } ?>
									</td>
								</tr>
								<?php 
								
									$tracks = get_post_meta($orderid, $prefix.'order_track',true);
									if(isset($tracks) && !empty($tracks)) { ?>
												<tr>
													<td colspan="2">
														<table class="status-table" cellspacing="0" cellpadding="5" border="1">
															<tbody>
																<tr>
																	<th class="date"><?php _e('Date Added', 'wpsdeals' );?></th>
																	<th class="customer-notify"><?php _e('Customer Notified', 'wpsdeals' );?></th>
																	<th class="status"><?php _e('Status', 'wpsdeals' );?></th>
																	<th class="comments"><?php _e('Comments', 'wpsdeals' );?></th>
																</tr>
																<?php 
																
																foreach ($tracks as $track) { 
																	
																	$date = $model->wps_deals_get_date_format($track['date'],true);
																	$notified = $track['notify'];
																	$comments = $track['comments'];
																	$editstatus = $track['status'];
																	
																?>
																
																		<tr>
																			<td><?php echo $date;?></td>
																			<td>
																				<?php	if($notified == '1') { ?>
																							<img src="<?php echo WPS_DEALS_URL . 'includes/images/tick.gif';?>"/>		
																				<?php 	} else{ ?>
																							<img src="<?php echo WPS_DEALS_URL . 'includes/images/cross.gif';?>"/>
																				<?php 	} ?>
																			</td>
																			<td><?php echo $model->wps_deals_paypal_value_to_status($editstatus);?></td>
																			<td><?php echo $comments;?></td>
																		</tr>
																
																<?php }	?>
															</tbody>
														</table>
													</td>
												</tr>
									<?php } ?>
								<tr>
									<th><?php _e( 'Payment Note :' ,'wpsdeals');?></th>
									<td><textarea name="wps-deals-edit-order-payment-note" id="wps-deals-edit-order-payment-note" rows="5" class="large-text"></textarea></td>
								</tr>
								<tr>
									<th><?php _e( 'Payment Status :' ,'wpsdeals');?></th>
									<td>
										<select name="wps-deals-edit-order-payment-status" id="wps-deals-edit-order-payment-status">
									<?php 
										//get all payment status
										$statuses = wps_deals_get_payment_statuses();
										//get payment status
										$payment_status = $model->wps_deals_get_ordered_payment_status( $orderid , true );
										
											foreach ($statuses as $val => $status) { ?>
												<option value="<?php echo $val;?>" <?php selected( $val, $payment_status, true);?>><?php echo $status;?></option>
									<?php	} ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="wps-deals-order-edit-notify" id="wps-deals-order-edit-notify" class="order-edit-check"/>
										<label for="wps-deals-order-edit-notify"><strong><?php _e('Notify Customer','wpsdeals');?></strong></label>
									</td>
									<td>
										<input type="checkbox" name="wps-deals-order-edit-append-comment" id="wps-deals-order-edit-append-comment" class="order-edit-check"/>
										<label for="wps-deals-order-edit-append-comment"><strong><?php _e('Append Comments to status notification email','wpsdeals');?></strong></label>
									</td>
								</tr>
								<?php
										//add something after order edit table
										do_action('wps_deals_edit_order_after',$orderid); 
								?>
								<tr>
									<td><input type="submit" class="button-primary" name="wps-deals-order-edit-submit" id="wps-deals-order-edit-submit" value="<?php _e('Update Order','wpsdeals');?>" /></td>
									<td><?php do_action( 'wps_deals_edit_order_beside_submit', $orderid );?></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div><!-- .inside -->
			</div><!-- #general -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-general -->
		</div><!--wrap-->
<?php		
	} //end if to check action is editorder & order_id is set or not
	
} //end else to check if it is refund process or not
?>