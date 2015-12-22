<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Cheuqe Payment
 * 
 * Handles functionalities about payment
 * all gateways
 * 
 * @package Social Deals Engine
 * @since 1.0.1
 */

function wps_deals_process_cheque( $cartdetails, $postdata ) {
	
	global $wps_deals_paypal,$wps_deals_price,$wps_deals_options,
			$wps_deals_currency,$wps_deals_model,$wps_deals_message;
	
	//price class
	$price = $wps_deals_price;
	
	//model class
	$model = $wps_deals_model;
	
	//paypal class
	$paypal = $wps_deals_paypal;
	
	//currency class
	$currency = $wps_deals_currency;
	
	//message class
	$message = $wps_deals_message;
	
	//payment method
	$method	= $postdata['wps_deals_payment_gateways'];
	
	// Check Mark Order As Completed from payment gateways settings
	if( isset( $wps_deals_options['mark_order_complete'] ) && $wps_deals_options['mark_order_complete'] == '1' ) {
		$payment_status = '1'; //completed
	} else {
		$payment_status = '5'; //on-hold by default
	}
	
	$purchasedata = array();
	$purchasedata['user_info'] = array( 
										'first_name' => $postdata['wps_deals_cart_user_first_name'],
										'last_name' => $postdata['wps_deals_cart_user_last_name'],
										'user_name' => $postdata['user_name'],
										'user_email' => $postdata['wps_deals_cart_user_email'],
									  );
	$purchasedata['post_data'] 		= $postdata;
	$purchasedata['cartdata'] 		= $cartdetails;
	$purchasedata['payment_status'] = $payment_status;
	
	$salesid = wps_deals_insert_payment_data($purchasedata);
	
	if(!empty($salesid)) {
		
	 	//empty cart
	 	wps_deals_empty_cart();
	 	
	 	//send to success page
	 	$queryurl = array( 'order_id' => $salesid );
	 	wps_deals_send_on_success_page( $queryurl );
	 	
	} else {
		
		$errormsg = __( 'Payment creation failed while processing a purchase by cheque, Please try again after sometime.', 'wpsdeals' );
		
		//error to show on checkout page
		$message->add_session( 'error', $errormsg, 'error' );
		
		//return to checkout page
		wps_deals_send_on_checkout_page();
		
	}
}
add_action( 'wps_deals_gateway_cheque', 'wps_deals_process_cheque', 10, 2);
?>