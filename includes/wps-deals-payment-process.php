<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Process Order
 *
 * Handle process of order
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_payment_process() {
	
	global $wps_deals_cart,$wps_deals_message,$current_user,$wps_deals_options;
	
	//cart class
	$cart = $wps_deals_cart;
	
	//message class
	$message = $wps_deals_message;
	
	//get cart data
	$cartdata = $cart->get();
		
	if(isset($_POST['wps_deals_submit_payment']) && !empty($_POST['wps_deals_submit_payment'])
		 && $_POST['wps_deals_submit_payment'] == __('Deals Purchase','wpsdeals')) { //check payment button click for checkout button
		
		 //validate nonce for security purpose
		// $noncevalidate = wps_deals_payment_nonce_valid($_POST['wps_deals_payment_nonce']);		
		 if( is_user_logged_in() 
		 	&& isset($_POST['wps_deals_cart_login_user_name']) && !empty($_POST['wps_deals_cart_login_user_name'])
		 	&& isset($_POST['wps_deals_cart_login_user_pass']) && !empty($_POST['wps_deals_cart_login_user_pass'])) { 
		 	//when user will try to purchase with login form then select his email from database		
		 	$_POST['wps_deals_cart_user_email']	 = $current_user->user_email;
		 	$_POST['wps_deals_cart_user_first_name'] = $current_user->first_name;
		 	$_POST['wps_deals_cart_user_last_name']	= $current_user->last_name;
		 } else {
		 	$_POST['wps_deals_cart_user_email']	 = $_POST['wps_deals_cart_user_email'];
		 	
		 }
		
		//payment gateway
		$validgateway = wps_deals_valid_gateway();
		
		
		//valid order data
		$validatedata = wps_deals_order_data_validate();
		
		//user details 
		$uservalid = wps_deals_valid_user_data();
		
		//valid billing details
		$userbilling	= wps_deals_valid_billing_data();
		
		//check user can purchase deal
		$user_can_purchase = wps_deals_valid_purchase_limit();
		
		$agreeterms = true;
		
		 //terms and conditions
		if( !empty($wps_deals_options['enable_terms'])) {
			$terms = isset( $_POST['wps_deals_checkout_agree_terms'] ) ? $_POST['wps_deals_checkout_agree_terms'] : '';
			$agreeterms = wps_deals_payment_agree_to_terms( $terms );
		}		 
	
		// !$noncevalidate ||
		if( empty( $cartdata['products'] ) || !$validatedata || !$uservalid || !$validgateway || !$agreeterms || !$userbilling || !$user_can_purchase ) { //check some data valid or not
			//redirect to checkout page
			 
			wps_deals_send_on_checkout_page();
			 
		} 
		 
		//get the value of user login name 		 
		if(is_user_logged_in()) { 
			//if user is logged in then stored display name
			$_POST['user_name'] = $current_user->display_name;
													
		} else {
			//do concat first name and last name of from posted data
			$_POST['user_name'] = 'guest';
		 
		} 
	 
		$gateway = isset( $_POST['wps_deals_payment_gateways'] ) ? $_POST['wps_deals_payment_gateways'] : '';
		
		//Pst data
		$post_data	= $_POST;
		
		// Allow themes and plugins to hook before the gateway
		do_action( 'wps_deals_checkout_before_gateway', $post_data, $cartdata );
		
		if ( $cartdata['total'] <= '0' ) {  //if cart total is empty call test mode
			
			$gateway									= 'testmode';
			$post_data['wps_deals_payment_gateways']	= 'testmode';
			//$post_data['wps_deals_payment_gateways']	= 'free';
		}
		
		// Send info to the gateway for payment processing
		wps_deals_send_to_gateway( $gateway, $cartdata, $post_data );
		exit;
	}
	
		
}
add_action( 'init', 'wps_deals_payment_process');

/**
 * Validate Order Details
 *
 * @return unknown
 */
function wps_deals_order_data_validate() {
	
	global $wps_deals_cart,$wps_deals_message;
	
	$prefix = WPS_DEALS_META_PREFIX;
	
	$cart = $wps_deals_cart;
	
	$message = $wps_deals_message;
	
	//get cart products
	$cartproducts = $cart->getproduct();
	
	$error = false;
	$errormsg = '';
	
	//get today's date & time
	$today = wps_deals_current_date();
	
	//validation code
	//checking is there error occuered before proceed for storing data in data base
	if( !empty( $cartproducts ) ) {
		foreach( $cartproducts as $dealid => $dealdata ) {
			
			//get the data by deal id
			$getdeal = get_post( $dealid );
			
			//get the value for available deals from post meta
			$available = get_post_meta($dealid,$prefix.'avail_total',true);
			
			//get the value for start date
			$startdate = get_post_meta($dealid,$prefix.'start_date',true);
			
			//get the value for end date
			$enddate = get_post_meta($dealid,$prefix.'end_date',true);
			
			if($startdate <= $today && $enddate >= $today) { //check deal start date and end date not greater then today
				
				if($available < 1 && $available != '') {
					$error = true;
				} else if ($dealdata['quantity'] > $available && $available != '') { //check use entered copy is not more then stock
					$error = true;
				}
				
			} else if ($startdate > $today) { //check deal is not started yet
				$error = true;
			} else if ($enddate < $today) { //check deal is ended or not \
				$error = true;
			}
		}
	} else {
		
		$error	= true;
	}
	 
	 if( $error ) {// if error set
	 	
	 	//if there is any error occured then show error
		$errormsg = __('<strong>ERROR : </strong>Please see errors below.</span>','wpsdeals');
		$message->add_session( 'error', $errormsg, 'error' );
		return false;
		
	} else {
		return true;
	}
}
/**
 * User data validate
 * 
 * Handles to call user details validate
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_valid_user_data() {
	
	global $wps_deals_message;
	
	$message = $wps_deals_message;
	
	$error = false;
	
	//if email id is empty
	if( isset($_POST['wps_deals_cart_user_email']) && empty($_POST['wps_deals_cart_user_email'] ) ) {
		$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>Please enter email.</span>','wpsdeals'),'multierror');
		$error = true;
	} else if ( !empty($_POST['wps_deals_cart_user_email']) && !is_email($_POST['wps_deals_cart_user_email']) ) {
		//if email id is not valid
		$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>Invalid email entered.</span>','wpsdeals'),'multierror');		
		$error = true;
	}
	
	if( !empty( $_POST['wps_deals_cart_reg_user_name'] ) ) { //check if user is create new  account then only validate first name last name
	
		//firstname validation
		if( isset( $_POST['wps_deals_cart_user_first_name'] ) && empty( $_POST['wps_deals_cart_user_first_name'] ) ) {
			$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>Please enter first name.</span>','wpsdeals'),'multierror');
			$error = true;
		}
		//lastname validation
		if( isset( $_POST['wps_deals_cart_user_last_name'] ) && empty( $_POST['wps_deals_cart_user_last_name'] ) ) {
			$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>Please enter last name.</span>','wpsdeals'),'multierror');
			$error = true;
		}
		
	}
	if( $error == true ) {
		return  false;
	} else {
		return true;
	}
}
/**
 * Gateway Validate
 * 
 * Handles to call user details validate
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_valid_gateway() {
	
	global $wps_deals_message, $wps_deals_cart;
	
	$message = $wps_deals_message;
	
	//Get cart
	$cart			= $wps_deals_cart;
	
	//Get cart total
	$cart_total		= $cart->show_total();
	
	if ( !empty( $_POST['wps_deals_payment_gateways'] ) ) {

		$gateway = sanitize_text_field( $_POST['wps_deals_payment_gateways'] );

		if ( wps_deals_is_gateway_active( $gateway ) ) {
			return true;
		} else {
			$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>Invalid email entered.</span>','wpsdeals'),'multierror');
			return false;
		}

	} else if( $cart_total <= 0 ) {
		
		return true;
		
	} else {
		$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>No payment gateway selected.</span>','wpsdeals'),'multierror');
		return false;
	}
	
	return true;
}

/**
 * Payment Terms Validate
 * 
 * Handles to call validating agree terms and conditions
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_payment_agree_to_terms($agree) {
	
	global $wps_deals_message;
	
	//message class object
	$message = $wps_deals_message;
		
	// Validate agree to terms
	if ( !isset( $agree ) || $agree != '1' ) {
	
		$message->add_session( 'cartuser', __('<span><strong>ERROR : </strong>You must agree to the terms of purchase.</span>','wpsdeals'),'multierror');
		return false;
	}
	return true;
}
/**
 * Validate Billing Details
 * 
 * Handles to call validatin billing details
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_valid_billing_data() {
	
	global $wps_deals_message;
	
	//message class object
	$message = $wps_deals_message;
	
	$error = false;
	
	//cehck billing details set on checkout page or not
	if( isset( $_POST['wps_deals_billing_details'] ) && !empty( $_POST['wps_deals_billing_details'] ) ) {
		
		//billing data 
		$billingdata = $_POST['wps_deals_billing_details'];
		
		//check billing country
		if( isset( $billingdata['country'] ) && empty( $billingdata['country'] ) ) {
			$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>Please select billing country.</span>','wpsdeals' ),'multierror');
			$error = true;
		}
		//check billing address
		if( isset( $billingdata['address1'] ) && empty( $billingdata['address1'] ) ) {
			$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>Please enter billing address.</span>','wpsdeals' ),'multierror');
			$error = true;
		}
		//check billing city / town
		if( isset( $billingdata['city'] ) && empty( $billingdata['city'] ) ) {
			$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>Please enter billing town / city.</span>','wpsdeals' ),'multierror');
			$error = true;
		}
		//check billing state / county
		if( isset( $billingdata['state'] ) && empty( $billingdata['state'] ) ) {
			$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>Please enter billing state / county.</span>','wpsdeals' ),'multierror');
			$error = true;
		}
		//check billing postcode
		if( isset( $billingdata['postcode'] ) && empty( $billingdata['postcode'] ) ) {
			$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>Please enter billing postcode.</span>','wpsdeals' ),'multierror');
			$error = true;
		}
		//check billing phone
		/*if( isset( $billingdata['phone'] ) && empty( $billingdata['phone'] ) ) {
			$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>Please enter billing phone number.</span>','wpsdeals' ),'multierror');
			$error = true;
		}*/
	}
	
	//check error is occured or not
	if( $error == true ) { return  false; } else { return true; }

}

function wps_deals_valid_purchase_limit() {
	
	global $wps_deals_model, $wps_deals_message, $wps_deals_cart, $user_ID;
	$prefix = WPS_DEALS_META_PREFIX;
	
	$error = false;	
	/*if( !is_user_logged_in() )
		return $error;*/
		
	//message class object
	$message = $wps_deals_message;	
		
	//Get cart
	$cart = $wps_deals_cart;
	
	//get cart data
	$cartdata = $cart->get();		
	
	// Get User already purchase deal detail
	$user_purchased_detail = get_user_meta( $user_ID, $prefix.'purchase_detail', true );
	
	if( !empty( $cartdata['products'] ) ) {

		foreach ( $cartdata['products'] as $deal_id => $deal_data ) {
			
			// get purchase limit
			$purchase_limit = get_post_meta( $deal_id, $prefix.'purchase_limit', true );
			
			if( $purchase_limit == "-1" ) {
				$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>One or more of the products in your cart is sold out!.</span>','wpsdeals' ),'multierror');
				$error = true;
			} else if( isset( $purchase_limit ) && !empty( $purchase_limit ) ) {
				
				$user_total_purchase = isset( $user_purchased_detail[$deal_id]['total_purchase'] ) ? $user_purchased_detail[$deal_id]['total_purchase'] : 0;
				$quantity = isset( $deal_data['quantity'] ) ? $deal_data['quantity'] : 1;
				$total_quantity = $user_total_purchase + $quantity;
				
				if( $total_quantity > $purchase_limit ) {
					$message->add_session( 'cartuser', __( '<span><strong>ERROR : </strong>One or more of the products in your cart is sold out!.</span>','wpsdeals' ),'multierror');
					$error = true;
				}
			}		
		}
	}
	
	//check error is occured or not
	if( $error == true ) { return  false; } else { return true; }		
}
?>