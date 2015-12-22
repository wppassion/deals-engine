<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Payment Paypal
 * 
 * Handles functionalities about payment
 * all gateways
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_process_payment_paypal( $cartdetails, $postdata ) {
	
	global $wps_deals_paypal,$wps_deals_price,$wps_deals_options,
			$wps_deals_currency,$wps_deals_model;
	
	//price class
	$price = $wps_deals_price;
	
	//model class
	$model = $wps_deals_model;
	
	//paypal class
	$paypal = $wps_deals_paypal;
	
	//currency class
	$currency = $wps_deals_currency;
	
	//get payment gateways
	//$paymentgateways = wps_deals_get_payment_gateways();
	
	//payment method
	//$method	= isset( $postdata['wps_deals_payment_gateways'] ) ? $postdata['wps_deals_payment_gateways'] : 'paypal';
	
	$purchasedata = array();
	$purchasedata['user_info'] = array( 
										'first_name' => $postdata['wps_deals_cart_user_first_name'],
										'last_name' => $postdata['wps_deals_cart_user_last_name'],
										'user_name' => $postdata['user_name'],
										'user_email' => $postdata['wps_deals_cart_user_email'],
									  );
	//$purchasedata['payment_method'] = $method;
	//$purchasedata['admin_label'] 	= $paymentgateways[$method]['admin_label'];
	//$purchasedata['checkout_label'] = $paymentgateways[$method]['checkout_label'];
	$purchasedata['post_data'] = $postdata;
	$purchasedata['cartdata'] = $cartdetails;
	$payment_status['payment_status'] = '0';
	
	$salesid = wps_deals_insert_payment_data($purchasedata);
	
	$cancelurl = wps_deals_checkout_cancel_url();
	$thankyouurl = wps_deals_checkout_thank_you_url();	
	//$cancelurl = isset($wps_deals_options['payment_cancel_page']) ? get_permalink($wps_deals_options['payment_cancel_page']) : '';
	//$thankyouurl = isset($wps_deals_options['payment_thankyou_page']) ? get_permalink($wps_deals_options['payment_thankyou_page']) : '';
	
	$cancelurl = add_query_arg( array( 'wps_deals_cancel_order' => '1', 'order_id' => $salesid ), $cancelurl );
	
	$thankyouargs = array();
	//check user is logged in or not
	if( is_user_logged_in() ) { $thankyouargs['order_id'] = $salesid; }
	
	$thankyouurl = add_query_arg( $thankyouargs, $thankyouurl );
	
	if(!empty($salesid)) {
		
		//get order deals
		$orderdetailsall = $model->wps_deals_get_post_meta_ordered($salesid);
		$orderdetails = $orderdetailsall['deals_details'];
		
		//get the merchant id from settings page
		$merchantid = $wps_deals_options['paypal_merchant_email'];
		
		//make notify url when payapl ipn is going to validate
		//$notifyurl = add_query_arg(array( 'dealslistner' => 'paypalipn','order_id' => $salesid),home_url());
		
		$notifyurl = trailingslashit( home_url() ).'?dealslistner=paypalipn';
		
		$paypal->add_field('business',$merchantid);
		$paypal->add_field('return', $thankyouurl);
		$paypal->add_field('cancel_return',$cancelurl );
		$paypal->add_field('notify_url', $notifyurl);
		$paypal->add_field('first_name', $purchasedata['user_info']['first_name'] );
		$paypal->add_field('last_name', $purchasedata['user_info']['last_name'] );
		$paypal->add_field('currency_code', $wps_deals_options['currency']);
		$paypal->add_field('cmd', '_ext-enter');//
		$paypal->add_field('custom', $salesid);//
		$paypal->add_field('rm', '2');
		$paypal->add_field('redirect_cmd', '_cart');
		$paypal->add_field('upload', count($orderdetails));
		
		$i = 1;
		
		//made proper data format for sending into paypal
		foreach ( $orderdetails as $order ) {
		
			$dealid = $order['deal_id'];
			
			//get deal title
			$dealtitle =  get_the_title($order['deal_id']);
			
			//append item name to string which will send into paypal
			//$item_name .= $dealtitle.',';
			$item_name = $dealtitle;
			
			//get deal price
			$dealprice = $order['deal_sale_price'];
			
			//get deal quantity
			$dealqty = $order['deal_quantity'];
			
			$paypal->add_field( 'item_name_'.$i, $item_name );
			$paypal->add_field( 'amount_'.$i, $dealprice );
			$paypal->add_field( 'quantity_'.$i, $dealqty );
			$i++;
		}
		
		//do action to add field to paypal form
		do_action( 'wps_deals_add_paypal_field', $salesid );
		
		 //add fee amount to paypal
       $discounted_amount = 0.00;
       	//check fees is set or not in order meta
        if( isset( $orderdetailsall['fees']  ) && !empty( $orderdetailsall['fees'] ) ) {
       	 	$i = empty( $i ) ? 1 : $i;
	        foreach( $orderdetailsall['fees'] as $fee_val ) {
	        	
	        	//check fees amount is greated then 0
	        	if( floatval( $fee_val['amount'] ) > '0' ) {
		        	// this is a positive fee
		        	$paypal->add_field( 'item_name_'.$i, $fee_val['label'] );
		        	$paypal->add_field( 'quantity_'.$i, '1' );
		        	$paypal->add_field( 'amount_'.$i, $fee_val['amount'] );
		        	$i++;
				} else {
					// This is a negative fee (discount)
					$discounted_amount += abs( $fee_val['amount'] );
				} //end else
	        } //end foreach loop
	    } //end if
	    
	    $discount_count = '0';
	    //check discounted amount should not empty then add discount amount as per fees
	    if( !empty( $discounted_amount ) ) {
	    	$discount_count = '1'; //initial discount count
	    	$paypal->add_field( 'discount_amount_'.$discount_count, $discounted_amount );
		} //end if to check discount amount
	    
	    //do action to add discount field into paypal fields
		do_action( 'wps_deals_paypal_disocunt_field', $discount_count, $salesid );
		
		//empty cart
	 	wps_deals_empty_cart();
		// submit the fields to paypal
		$paypal->submit_paypal_post(); 
		exit;
		
	} else {
		
		//return to checkout page
		wps_deals_send_on_checkout_page();
	}
}
add_action( 'wps_deals_gateway_paypal', 'wps_deals_process_payment_paypal', 10, 2);

/**
 * Paypal payment validate
 * 
 * Handles to validate paypal payment
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
 
function wps_deals_paypal_verfication() {
	
	global $wps_deals_paypal,$wps_deals_model;
	
	$prefix = WPS_DEALS_META_PREFIX;
		
	//paypal class
	$paypal = $wps_deals_paypal;
	
	//model class
	$model = $wps_deals_model;
	
	if( isset( $_GET['dealslistner'] ) && $_GET['dealslistner'] == 'paypalipn' ) { //check listner value
		
		if( $paypal->validate_ipn() ) { //check validate ipn
			
			//status of paypal transaction
			$status = $paypal->ipn_data['payment_status'];
			
			//get order id
			$orderid = $_POST['custom'];
			
			// update the value for the paypal data to the post meta box
		 	update_post_meta( $orderid, $prefix.'order_ipn_data', $paypal->ipn_data ); // ipn data
			
		 	/************** Code For Buy Now Start ( Signle Purchase ) **************/
		 	
		 	// get the value of payment user email from the post meta
		 	$payment_user_email = get_post_meta( $orderid, $prefix.'payment_user_email', true ); // ipn data
		 	
		 	if( empty( $payment_user_email ) ) {
		 		
		 		$user_email = isset( $paypal->ipn_data['payer_email'] ) ? $paypal->ipn_data['payer_email'] : '';
		 		
				$ordered_deal_userdetails = array(
													'user_id'		=>	'0',
													'user_name'		=>	'',
													'user_email'	=>	$user_email,
													'first_name'	=>	isset( $paypal->ipn_data['first_name'] ) ? $paypal->ipn_data['first_name'] : __( 'Guest', 'wpsdeals' ),
													'last_name'		=>	isset( $paypal->ipn_data['last_name'] ) ? $paypal->ipn_data['last_name'] : ''
												);
				
				// update the value for the user details to the post meta box
				update_post_meta( $orderid, $prefix.'order_userdetails', $ordered_deal_userdetails );
			
				// update the value for the user email to post meta
				update_post_meta( $orderid, $prefix.'payment_user_email', $user_email );
			
		 	}
		 	
		 	/************** Code For Buy Now End ( Signle Purchase ) **************/
		 	
		 	//update payment status
		 	$payment_status = $model->wps_deals_paypal_status_to_value( $status );
		 	
			//order details
			$orderdata = $model->wps_deals_get_post_meta_ordered( $orderid );
			
			//user details
			$userdetails = $model->wps_deals_get_ordered_user_details( $orderid );
			
			switch ( $status ) {
				
				case 'Completed'	: 
										
										//update payments status
										wps_deals_update_payment_status( $payment_status, $orderid );
										
										//order tracking data update
										$trackargs = array( 'orderid' => $orderid, 'payment_status' => $payment_status, 'notify' => '1' );
										wps_deals_update_order_track( $trackargs );
										break;
				case 'Reversed'		:
	            case 'Chargeback'	:
		            					$args = array();
										$args['order_id'] = $orderid;
										$args['email'] = $userdetails['user_email'];
										$args['status'] = $status;
										
										//send email to buyer		
										$model->wps_deals_send_order_status_email( $args );
										
										$adminargs = array( 
															'subject'	=>	sprintf( __( 'Payment for order %s refunded/reversed', 'wpsdeals' ), $orderid ),
															'message'	=>	sprintf( __( 'Order %s has been marked as refunded - PayPal reason code: %s', 'wpsdeals' ), $orderid, $_POST['reason_code']),
														);
										
										//send email to admin
										$model->wps_deals_send_order_status_email_admin( $adminargs );
						
										//update payment status
										wps_deals_update_payment_status( $payment_status, $orderid );
										
										//order tracking data update
										$trackargs = array( 'orderid' => $orderid, 'payment_status' => $payment_status, 'notify' => '1' );
										wps_deals_update_order_track( $trackargs );
										break;
				case 'Refunded'	:
									if( $orderdata['order_total'] == ( $_POST['mc_gross'] * -1 ) ) {
										
										$args = array();
										$args['order_id'] = $orderid;
										$args['email'] = $userdetails['user_email'];
										$args['status'] = $status;
										
										//send email to buyer		
										$model->wps_deals_send_order_status_email( $args );
										
										$adminargs = array( 
																'subject'	=>	sprintf( __( 'Payment for order %s refunded/reversed', 'wpsdeals' ), $orderid ),
																'message'	=>	sprintf( __( 'Order %s has been marked as refunded - PayPal reason code: %s', 'wpsdeals' ), $orderid, $_POST['reason_code']),
															);
										
										//send email to admin
										$model->wps_deals_send_order_status_email_admin( $adminargs );
						
										//update payment status
										wps_deals_update_payment_status( $payment_status, $orderid );
										//order tracking data update
										$trackargs = array( 'orderid' => $orderid, 'payment_status' => $payment_status, 'notify' => '1' );
										wps_deals_update_order_track( $trackargs );
									}
									break;
				default 		:
									//update payment status
						            wps_deals_update_payment_status( $payment_status, $orderid );
						            //order tracking data update
						            $trackargs = array( 'orderid' => $orderid, 'payment_status' => $payment_status, 'notify' => '0' );
									wps_deals_update_order_track( $trackargs );
						            break;
			}
			//do action when paypal ipn is being verified
			do_action( 'wps_deals_verify_paypal_ipn',$orderid );
			
		} //end if to check ipn data is valid or not
		
	} //end if to check ipnlistner is set and it must be 'paypalipn'
	
}
add_action( 'init', 'wps_deals_paypal_verfication', 100 );

/**
 * Direct Buy with Paypal
 * 
 * Handles to direct buy with paypal
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
 
function wps_deals_paypal_buy_now() {
	
	global $wps_deals_price,$current_user,$wps_deals_options;
	
	// Check payment mode directly Buy Now
	if( /*is_user_logged_in() 
		&& */isset( $_GET['dealsaction'] ) && $_GET['dealsaction'] == 'buynow' 
		&& isset( $_GET['dealid'] ) && !empty( $_GET['dealid'] ) ) {
			
		// deal id
		$dealid = $_GET['dealid'];
			
		// deal price
		$productprice = $wps_deals_price->wps_deals_get_price( $dealid );
			
		$cartdetails = array(
									'total' 	=> $productprice,
									'subtotal' 	=> $productprice,
									'products' 	=> array(
															$dealid => array(
																				'dealid' => $dealid,
																				'quantity' => '1'
																			)
														)
								);
		$postdata = array(
							'wps_deals_cart_user_first_name'=> $current_user->first_name,
							'wps_deals_cart_user_last_name' => $current_user->last_name,
							'wps_deals_cart_user_email' 	=> $current_user->user_email,
							'user_name' 					=> $current_user->display_name
						);
		// Test mode enable & buy now selected
		if($wps_deals_options['default_payment_gateway']=='testmode') {
			wps_deals_process_testmode( $cartdetails, $postdata );
		}
		else {				
			wps_deals_process_payment_paypal( $cartdetails, $postdata );
		}
			
	}
	
}
add_action( 'init', 'wps_deals_paypal_buy_now' );
?>