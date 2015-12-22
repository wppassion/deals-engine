<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Misc Functions
 *
 * @package Social Deals Engine
 * @since 1.0.0
 *
 */  

	/**
	 * Get Currencies
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_currency_data() {
		 
		return array_unique( 
				apply_filters( 'wps_deals_currency_data',
					array(	
						'USD'	=> __( 'US Dollars (&#36;)', 'wpsdeals' ),
						'GBP'	=> __( 'Pounds Sterling (&pound;)', 'wpsdeals' ),
						'EUR'	=> __( 'Euros (&euro;)', 'wpsdeals' ),
						'AUD' 	=> __( 'Australian Dollars (&#36;)', 'wpsdeals' ),
						'BRL' 	=> __( 'Brazilian Real (R&#36;)', 'wpsdeals' ),
						'BGN'	=> __( 'Bulgarian Lev', 'wpsdeals' ),
						'CAD' 	=> __( 'Canadian Dollars (&#36;)', 'wpsdeals' ),
						'CZK' 	=> __( 'Czech Koruna', 'wpsdeals' ),
						'DKK'	=> __( 'Danish Krone', 'wpsdeals' ),
						'HKD' 	=> __( 'Hong Kong Dollar (&#36;)', 'wpsdeals' ),
						'HUF' 	=> __( 'Hungarian Forint (Ft)', 'wpsdeals' ),
						'RIAL' 	=> __( 'Iranian Rial', 'wpsdeals' ),
						'ILS' 	=> __( 'Israeli Shekel', 'wpsdeals' ),
						'JPY' 	=> __( 'Japanese Yen (&yen;)', 'wpsdeals' ),
						'MYR' 	=> __( 'Malaysian Ringgits', 'wpsdeals' ),
						'MXN' 	=> __( 'Mexican Peso (&#36;)', 'wpsdeals' ),
						'NZD' 	=> __( 'New Zealand Dollar (&#36;)', 'wpsdeals' ),
						'NOK' 	=> __( 'Norwegian Krone', 'wpsdeals' ),
						'PHP' 	=> __( 'Philippine Pesos', 'wpsdeals' ),
						'PLN' 	=> __( 'Polish Zloty', 'wpsdeals' ),
						'SGD' 	=> __( 'Singapore Dollar (&#36;)', 'wpsdeals' ),
						'ZAR'	=> __( 'South African Rand (R)', 'wpsdeals' ),
						'SEK' 	=> __( 'Swedish Krona', 'wpsdeals' ),
						'CHF' 	=> __( 'Swiss Franc', 'wpsdeals' ),
						'TWD' 	=> __( 'Taiwan New Dollars', 'wpsdeals' ),
						'THB' 	=> __( 'Thai Baht', 'wpsdeals' ),
						'INR' 	=> __( 'Indian Rupee', 'wpsdeals' ),
						'TRY' 	=> __( 'Turkish Lira', 'wpsdeals' ),
						'IDR' 	=> __( 'Indonesia Rupiah (Rp)', 'wpsdeals' ),
						'AED'	=> __( 'Dirham - United Arab Emirates', 'wpsdeals' ),
						'LKR'	=> __( 'Sri Lankan rupee', 'wpsdeals' ),
						'BDT'	=> __( 'Bangladeshi Taka', 'wpsdeals' ),
						'CLP'	=> __( 'Chilean Peso', 'wpsdeals' ),
						'CNY'	=> __( 'Chinese Yuan', 'wpsdeals' ),
						'COP'	=> __( 'Colombian Peso', 'wpsdeals' ),
						'DOP'	=> __( 'Dominican Peso', 'wpsdeals' ),
						'HRK'	=> __( 'Croatia kuna', 'wpsdeals' ),
						'ISK'	=> __( 'Icelandic krona', 'wpsdeals' ),
						'NPR'	=> __( 'Nepali Rupee', 'wpsdeals' ),
						'KIP'	=> __( 'Lao Kip', 'wpsdeals' ),
						'JOD'	=> __( 'Jordanian Dinar (JOD)', 'wpsdeals' ),
						'DT'	=> __( 'Dinars Tunisien (DT)', 'wpsdeals' ),
			  		 )));
	}
	
	/**
	 * Get Currencies
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_update_countries() {
		
		$countries	= get_option( 'wps_deals_countries' );
		
		if( empty( $countries ) ) {
			
			$wps_deal_countries = wps_deals_get_allowed_countries();
			
			//store all countries to option
			update_option( 'wps_deals_countries', serialize( $wps_deal_countries ) );
		}
	}
	/**
	 * Initialize some needed variables
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_initialize() {
		
		global $wps_deals_options;
		
		//facebook app data
		$fb_app_id = isset( $wps_deals_options['fb_app_id'] ) ? $wps_deals_options['fb_app_id'] : '';
		$fb_app_secret = isset( $wps_deals_options['fb_app_secret'] ) ? $wps_deals_options['fb_app_secret'] : '';
		
		//googleplus app data
		$gp_client_id = isset( $wps_deals_options['gplus_client_id'] ) ? $wps_deals_options['gplus_client_id'] : '';
		$gp_client_secret = isset( $wps_deals_options['gplus_client_secret'] ) ? $wps_deals_options['gplus_client_secret'] : '';
		
		//twitter app data
		$tw_consumer_key = isset( $wps_deals_options['tw_consumer_key'] ) ? $wps_deals_options['tw_consumer_key'] : '';
		$tw_consumer_secrets = isset( $wps_deals_options['tw_consumer_secrets'] ) ? $wps_deals_options['tw_consumer_secrets'] : '';
		
		//linkedin app data
		$li_client_id = isset( $wps_deals_options['li_app_id'] ) ? $wps_deals_options['li_app_id'] : '';
		$li_client_secret = isset( $wps_deals_options['li_app_secret'] ) ? $wps_deals_options['li_app_secret'] : '';
		
		//yahoo app data
		$yh_consumer_key = isset( $wps_deals_options['yh_consumer_key'] ) ? $wps_deals_options['yh_consumer_key'] : '';
		$yh_consumer_secrets = isset( $wps_deals_options['yh_consumer_secrets'] ) ? $wps_deals_options['yh_consumer_secrets'] : '';
		$yh_app_id = isset( $wps_deals_options['yh_app_id'] ) ? $wps_deals_options['yh_app_id'] : '';
		
		//foursquare app data
		$fs_client_id = isset( $wps_deals_options['fs_client_id'] ) ? $wps_deals_options['fs_client_id'] : '';
		$fs_client_secrets = isset( $wps_deals_options['fs_client_secrets'] ) ? $wps_deals_options['fs_client_secrets'] : '';
		
		//windowslive app data
		$wl_client_id = isset( $wps_deals_options['wl_client_id'] ) ? $wps_deals_options['wl_client_id'] : '';
		$wl_client_secrets = isset( $wps_deals_options['wl_client_secrets'] ) ? $wps_deals_options['wl_client_secrets'] : '';
			
		$paypalapiuser = isset( $wps_deals_options['paypal_api_user'] ) ? $wps_deals_options['paypal_api_user'] : '';
		$paypalapipass = isset( $wps_deals_options['paypal_api_pass'] ) ? $wps_deals_options['paypal_api_pass'] : '';
		$paypalapisign = isset( $wps_deals_options['paypal_api_sign'] ) ? $wps_deals_options['paypal_api_sign'] : '';
			
		if(isset($wps_deals_options['enable_testmode']) && !empty($wps_deals_options['enable_testmode'])) {
			$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			$paypalrefundurl = 'https://api-3t.sandbox.paypal.com/nvp';
		} else {
			$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
			$paypalrefundurl = 'https://api-3t.paypal.com/nvp';
		}
		
		//if(isset($wps_deals_options['buyer_email_subject']) && !empty($wps_deals_options['buyer_email_subject'])) { //check user email subject
			$buyer_email_subject = isset($wps_deals_options['buyer_email_subject']) ? $wps_deals_options['buyer_email_subject'] : '';
		/*} else {
			$buyer_email_subject = __( 'Purchase Receipt', 'wpsdeals' );
		}*/
		//if(isset($wps_deals_options['seller_email_subject']) && !empty($wps_deals_options['seller_email_subject'])) { //check admin email subject
			$seller_email_subject = isset($wps_deals_options['seller_email_subject']) ? $wps_deals_options['seller_email_subject'] : '';
		//} else {
		//	$seller_email_subject = __( 'New Deal Purchase', 'wpsdeals' );
		//}
		
		if(!defined( 'WPS_DEALS_PAYPAL_URL' )) { //check paypal url is set or not
			define( 'WPS_DEALS_PAYPAL_URL', $paypal_url );
		}
		
		if( !defined( 'WPS_DEALS_BUYER_EMAIL_SUBJECT' )) {
			define( 'WPS_DEALS_BUYER_EMAIL_SUBJECT',$buyer_email_subject ); // buyer email subject
		}
		if( !defined( 'WPS_DEALS_SELLER_EMAIL_SUBJECT' )) {
			define( 'WPS_DEALS_SELLER_EMAIL_SUBJECT',$seller_email_subject ); // seller email subject
		}
		
		
		if( !defined( 'WPS_DEALS_PAYPAL_API_USERNAME' )) {
			define( 'WPS_DEALS_PAYPAL_API_USERNAME', $paypalapiuser ); //paypal api username
		}
		if( !defined( 'WPS_DEALS_PAYPAL_API_PASSWORD' )) {
			define( 'WPS_DEALS_PAYPAL_API_PASSWORD', $paypalapipass ); //paypal api password
		}
		if( !defined( 'WPS_DEALS_PAYPAL_API_SIGNATURE' )) {
			define( 'WPS_DEALS_PAYPAL_API_SIGNATURE', $paypalapisign ); //paypal api signature
		}
		if( !defined( 'WPS_DEALS_PAYPAL_REFUND_URL') ) {
			define('WPS_DEALS_PAYPAL_REFUND_URL',$paypalrefundurl ); //paypal refund url
		}
		/**
		# Version: this is the API version in the request.
		# It is a mandatory parameter for each API request.
		# The only supported value at this time is 2.3
		*/
		if( !defined( 'WPS_DEALS_PAYPAL_REFUND_VERSION') ) {
			define( 'WPS_DEALS_PAYPAL_REFUND_VERSION', '65.1' );
		}
		
		/**
		 * Social Media Application Settings
		 */
		if( !defined( 'WPS_DEALS_FB_APP_ID' ) ){
			define( 'WPS_DEALS_FB_APP_ID', $fb_app_id );
		}
		if( !defined( 'WPS_DEALS_FB_APP_SECRET' ) ){
			define( 'WPS_DEALS_FB_APP_SECRET', $fb_app_secret );
		}
		
		//For GooglePlus Data
		if( !defined( 'WPS_DEALS_GP_CLIENT_ID' ) ){
			define( 'WPS_DEALS_GP_CLIENT_ID', $gp_client_id );
		}
		if( !defined( 'WPS_DEALS_GP_CLIENT_SECRET' ) ){
			define( 'WPS_DEALS_GP_CLIENT_SECRET', $gp_client_secret );
		}
		if( !defined( 'WPS_DEALS_GP_REDIRECT_URL' ) ) {
			$googleurl = add_query_arg( 'wpsocialdeals', 'google', site_url() );
			define( 'WPS_DEALS_GP_REDIRECT_URL', $googleurl );
		}
		//For Twitter Data
		if( !defined( 'WPS_DEALS_TW_CONSUMER_KEY' ) ) {
			define( 'WPS_DEALS_TW_CONSUMER_KEY', $tw_consumer_key );
		}
		if( !defined( 'WPS_DEALS_TW_CONSUMER_SECRET' ) ) {
			define( 'WPS_DEALS_TW_CONSUMER_SECRET', $tw_consumer_secrets );
		}
		//For Linkedin data
		if( !defined( 'WPS_DEALS_LI_APP_ID' ) ) {	
			define( 'WPS_DEALS_LI_APP_ID', $li_client_id );	
		}
		if( !defined( 'WPS_DEALS_LI_APP_SECRET' ) ) {	
			define( 'WPS_DEALS_LI_APP_SECRET', $li_client_secret );	
		}
	
		// For LinkedIn Port http / https
		if( !defined( 'LINKEDIN_PORT_HTTP' ) ) { //http port value
		 	define( 'LINKEDIN_PORT_HTTP', '80' );
		}
		if( !defined( 'LINKEDIN_PORT_HTTP_SSL' ) ) { //ssl port value
		  	define( 'LINKEDIN_PORT_HTTP_SSL', '443' );
		}
		
		//For Yahoo data
		if( !defined( 'WPS_DEALS_YH_CONSUMER_KEY' ) ) {
			define( 'WPS_DEALS_YH_CONSUMER_KEY', $yh_consumer_key );
		}
		if( !defined( 'WPS_DEALS_YH_CONSUMER_SECRET' ) ) {
			define( 'WPS_DEALS_YH_CONSUMER_SECRET', $yh_consumer_secrets );
		}
		if( !defined( 'WPS_DEALS_YH_APP_ID' ) ) {
			define( 'WPS_DEALS_YH_APP_ID', $yh_app_id );
		}
		if( !defined( 'WPS_DEALS_YH_REDIRECT_URL' ) ) {
			$yahoourl = add_query_arg( 'wpsocialdeals', 'yahoo', site_url() );
			define( 'WPS_DEALS_YH_REDIRECT_URL', $yahoourl );
		}
		
		//For foursquare data
		if( !defined( 'WPS_DEALS_FS_CLIENT_ID' ) ) {
			define( 'WPS_DEALS_FS_CLIENT_ID', $fs_client_id );
		}
		if( !defined( 'WPS_DEALS_FS_CLIENT_SECRET' ) ) {
			define( 'WPS_DEALS_FS_CLIENT_SECRET', $fs_client_secrets );
		}
		if( !defined( 'WPS_DEALS_FS_REDIRECT_URL' ) ) {
			$fsredirecturl = add_query_arg( 'wpsocialdeals', 'foursquare', site_url() );
			define( 'WPS_DEALS_FS_REDIRECT_URL', $fsredirecturl );
		}
		
		//For Windows Live Data
		if( !defined( 'WPS_DEALS_WL_CLIENT_ID' ) ){
			define( 'WPS_DEALS_WL_CLIENT_ID', $wl_client_id );
		}
		if( !defined( 'WPS_DEALS_WL_CLIENT_SECRET' ) ){
			define( 'WPS_DEALS_WL_CLIENT_SECRET', $wl_client_secrets );
		}
		if( !defined( 'WPS_DEALS_WL_REDIRECT_URL' ) ) {
			$windowsliveurl = add_query_arg( 'wpsocialdeals', 'windowslive', site_url() );
			define( 'WPS_DEALS_WL_REDIRECT_URL', $windowsliveurl );
		}
	}
	
	/**
	 * Get Settings From Option Page
	 * 
	 * Handles to return all settings value
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_get_settings() {
		
		
		$settings = is_array(get_option('wps_deals_options')) 	? get_option('wps_deals_options') 	: array();
		
		return apply_filters( 'wps_deals_get_settings', $settings );
	}
	
	/**
	 * Rewrite End-points
	 * Need to flush when rewrite end-points
	 * 
	 * @package Social Deals Engine
	 * @since 2.2.4
	 */
	function wps_deals_rewrite_endpoints() {
		
		global $wps_deals_query;
		
		// Re-add endpoints and flush rules
		$wps_deals_query->init_query_vars();
		$wps_deals_query->add_endpoints();
		
		
		flush_rewrite_rules();
		
	}

	/**
	 * Send to Success Page
	 * 
	 * Handles to return success page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_success_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		//get url of thank you page
		$sendsuccess = wps_deals_checkout_thank_you_url();
		
		//check user is logged in or not if user is not logged in then unset order_id
		if( !is_user_logged_in() && isset( $queryarg['order_id'] ) ) {
			unset( $queryarg['order_id'] );
		}
		
		//success page url
		$sendsuccessurl = add_query_arg( $queryarg, $sendsuccess );
		
		wp_redirect( apply_filters( 'wps_deals_success_page_redirect', $sendsuccessurl, $queryarg ) );
		exit;
	}
	/**
	 * Send to Cancel Page
	 * 
	 * Handles to return cancel page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_cancel_page( $queryarg = array() ) {				
		
		//get url of cancel page
		$sendcancel = wps_deals_checkout_cancel_url();
	
		$sendcancelurl = add_query_arg( $queryarg, $sendcancel );
		
		wp_redirect( apply_filters( 'wps_deals_cancel_page_redirect', $sendcancelurl, $queryarg ) );
		exit;
	}
	/**
	 * Send to Checkout Page
	 * 
	 * Handles to return checkout page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_checkout_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		$sendcheckout = get_permalink($options['payment_checkout_page']);
	
		$sendcheckouturl = add_query_arg( $queryarg, $sendcheckout );
		
		wp_redirect( apply_filters( 'wps_deals_checkout_page_redirect', $sendcheckouturl, $queryarg ) );
		exit;
	}
	/**
	 * Send to My Account Page
	 * 
	 * Handles to return my account page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_my_account_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		$sendmyaccount = get_permalink($options['my_account_page']);
		
		$sendmyaccounturl = add_query_arg( $queryarg, $sendmyaccount );
		 
		wp_redirect( apply_filters( 'wps_deals_my_account_page_redirect', $sendmyaccounturl, $queryarg ) );
		exit;
	}
	/**
	 * Send to Create An Account Page
	 * 
	 * Handles to return create an account page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_create_account_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		$sendcreateaccount = get_permalink($options['create_account_page']);
	
		$sendcreateaccounturl = add_query_arg( $queryarg, $sendcreateaccount );
		
		wp_redirect( apply_filters( 'wps_deals_create_account_page_redirect', $sendcreateaccounturl, $queryarg ) );
		exit;
	}
	/**
	 * Send to Edit Address Page
	 * 
	 * Handles to return edit address page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_edit_adderess_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		// Get edit address page url
		$sendeditaddress = wps_deals_edit_address_url();
	
		$sendeditaddressurl = add_query_arg( $queryarg, $sendeditaddress );
		
		wp_redirect( apply_filters( 'wps_deals_edit_address_page_redirect', $sendeditaddressurl, $queryarg ) );
		exit;
	}
	/**
	 * Send to Change Password Page
	 * 
	 * Handles to return change password page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_change_password_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		$sendchangepassword = get_permalink($options['edit_account_endpoint']);
	
		$sendchangepasswordurl = add_query_arg( $queryarg, $sendchangepassword );
		
		wp_redirect( apply_filters( 'wps_deals_change_password_page_redirect', $sendchangepasswordurl, $queryarg ) );
		exit;
	}
	/**
	 * Send to Lost Password Page
	 * 
	 * Handles to return lost password page url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_send_on_lost_password_page( $queryarg = array() ) {
		
		$options = wps_deals_get_settings();
		
		// Take lost password page slug for get link
		$lost_pass_slug = isset($options['lost_password_endpoint']) ? $options['lost_password_endpoint'] : 'lost-password';
		
		$sendlostpassword = get_permalink($lost_pass_slug);

		$sendlostpasswordurl = add_query_arg( $queryarg, $sendlostpassword );
		
		wp_redirect( apply_filters( 'wps_deals_lost_password_page_redirect', $sendlostpasswordurl, $queryarg ) );
		exit;
	}
	/**
 	 * Return Value of IP address
 	 * 
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
	function wps_deals_getip()
	 { 
	     if (isset($_SERVER)) {
	     	
	         if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
	            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	         } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
	               $realip = $_SERVER["HTTP_CLIENT_IP"];
	         } else {
	              $realip =$_SERVER["REMOTE_ADDR"];
	         }
	         
	     }  else {
	          if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
	               $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	           } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
	               $realip = getenv( 'HTTP_CLIENT_IP' );
	           } else {
	              $realip = getenv( 'REMOTE_ADDR' );
	          }
	     }
	    return apply_filters( 'wps_deals_getip', $realip );
	 }
	 /**
	  * Get payment Gateways
	  * 
	  * Handles to return all payment gateways
	  * 
	  * @package Social Deals Engine
	  * @since 1.0.0
	  */
	 function wps_deals_get_payment_gateways() {
	 	
	 	global $wps_deals_options;
	 	
	 	$cheque_title = isset( $wps_deals_options['cheque_title'] ) && !empty( $wps_deals_options['cheque_title'] ) ? $wps_deals_options['cheque_title'] : __( 'Cheque Payment','wpsdeals');
	 	
	 	$gateways = array(
							'paypal'	=>	array( 'admin_label' => __( 'PayPal Standard','wpsdeals'), 'checkout_label' => __( 'PayPal','wpsdeals') ),
							'cheque'	=>	array( 'admin_label' => $cheque_title, 'checkout_label' => $cheque_title ),
							'testmode'	=>	array( 'admin_label' => __( 'Test Mode','wpsdeals'), 'checkout_label' => __( 'Test Mode','wpsdeals') ),
						);
		$gateways = apply_filters('wps_deals_add_more_payment_gateways',$gateways);
		
		return $gateways;
	 }
	 /**
	  * Get enabled payment gateways
	  * 
	  * Handles to return activated payment gateways
	  * 
	  * @package Social Deals Engine
	  * @since 1.0.0
	  */
	 function wps_deals_get_enabled_gateways(){
	 	
	 	global $wps_deals_options;
	 	$gateways = wps_deals_get_payment_gateways();
		$enabled_gateways = isset( $wps_deals_options['payment_gateways'] ) ? $wps_deals_options['payment_gateways'] : false;
	
		$gateway_list = array();
		if(!empty($enabled_gateways)) {
			foreach( $gateways as $key => $gateway ){
				if( array_key_exists( $key, $enabled_gateways ) && isset( $gateway['checkout_label'] ) ) { //check gateway is exist or not
					$gateway_list[ $key ] = $gateway;
				}
		 	}
		}
		return apply_filters( 'wps_deals_enabled_payment_gateways', $gateway_list);
	 	
	 }
	/** Get Payment Statuses
 	 *
 	 * Retrieves all available statuses for payments
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_get_payment_statuses() {
		
		$payment_statuses = array(
			'0'		=> __( 'Pending', 'wpsdeals' ),
			'1'		=> __( 'Completed', 'wpsdeals' ),
			'2'		=> __( 'Refunded', 'wpsdeals' ),
			'3'		=> __( 'Failed', 'wpsdeals' ),
			'4'		=> __( 'Cancelled', 'wpsdeals' ),
			'5'		=> __( 'On-Hold', 'wpsdeals' )
		);

		return apply_filters( 'wps_deals_payment_statuses', $payment_statuses );
	}
	/**
	 * All Social Deals Networks
	 * 
	 * Handles to return all social networks
	 * names
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_networks() {
		
		$socialnetworks = array( 
									'facebook'		=>	__( 'Facebook', 'wpsdeals' ),
									'twitter'		=>	__( 'Twitter', 'wpsdeals' ),
									'googleplus'	=>	__( 'Google+', 'wpsdeals' ),
									'linkedin'		=>	__( 'LinkedIn', 'wpsdeals' ),
									'yahoo'			=>	__(	'Yahoo', 'wpsdeals'),
									'foursquare'	=>	__(	'Foursquare', 'wpsdeals'),
									'windowslive'	=>	__(	'Windows Live', 'wpsdeals')
								);
		return apply_filters( 'wps_deals_social_networks', $socialnetworks );
		
	}
	
	/**
	 * Get Social Network Sorted List
	 * as per saved in options
	 * 
	 * Handles to return social networks sorted
	 * array to list in page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_get_sorted_social_network() {
		
		global $wps_deals_options;
		
		$socials = wps_deals_social_networks();
		
		if( !isset( $wps_deals_options['social_order'] ) || empty( $wps_deals_options['social_order'] )){
			return $socials;
		}
		
		$sorted_socials = $wps_deals_options['social_order'];
		
		$return = array();
		
		for( $i = 0; $i < count( $socials ); $i++ ){
			$return[$sorted_socials[$i]] = $socials[$sorted_socials[$i]];
		}
		return apply_filters( 'wps_deals_sorted_social_network', $return );
	}
	
	/**
	 * Check Anyone Social Login is Enable or not
	 * 
	 * Handles to check anyone social login is enable or not
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_enable_social_login() {
		
		global $wps_deals_options;
		
		$enablesocial = false;
		
		//check if any one social button is enable or not
		if( !empty( $wps_deals_options['enable_facebook'] ) || !empty( $wps_deals_options['enable_gplus'] ) 
			|| !empty( $wps_deals_options['enable_twitter'] ) || !empty( $wps_deals_options['enable_linkedin'] )
			|| !empty( $wps_deals_options['enable_yahoo'] ) || !empty( $wps_deals_options['enable_foursquare'] )
			|| !empty( $wps_deals_options['enable_windowslive'] ) ) {
			//enable social login box
			$enablesocial = true;	
		}
		
		return apply_filters( 'wps_deals_enable_social_login', $enablesocial );
	}
	
	/**
	 * Load Checkout Credit Card Form
	 * 
	 * Handles to show checkout credit card form
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_cc_form() {
		
		//load facebook button template
		wps_deals_get_template( 'checkout/checkout-footer/cc-form.php' );
		
	}
	/**
 	* Get All Capabilities
 	* 
 	* Handles to return all required capabilites 
 	* for social deals engine plugin
 	*
 	* @package Social Deals Engine
 	* @since 1.0.0
 	*/
	function wps_deals_get_capabilities() {
		
		$capabilities = array();
	
		$capability_types = array( WPS_DEALS_POST_TYPE, WPS_DEALS_SALES_POST_TYPE );
	
		foreach( $capability_types as $capability_type ) {
	
			$capabilities[ $capability_type ] = array(
	
				// Post type
				"edit_{$capability_type}",
				"read_{$capability_type}",
				"delete_{$capability_type}",
				"edit_{$capability_type}s",
				"edit_others_{$capability_type}s",
				"publish_{$capability_type}s",
				"read_private_{$capability_type}s",
				"delete_{$capability_type}s",
				"delete_private_{$capability_type}s",
				"delete_published_{$capability_type}s",
				"delete_others_{$capability_type}s",
				"edit_private_{$capability_type}s",
				"edit_published_{$capability_type}s",
	
				// Terms
				"manage_{$capability_type}_terms",
				"edit_{$capability_type}_terms",
				"delete_{$capability_type}_terms",
				"assign_{$capability_type}_terms"
			);
		}
		return apply_filters( 'wps_deals_get_capabilities', $capabilities );
	}
	/**
	 * Assign Capabilities To Roles
	 *
	 * Handles to assign needed capabilites to 
	 * administrator roles
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_add_capabilities() {
		
		global $wp_roles;
	
		//check WP_Roles class is exist or not
		if ( class_exists('WP_Roles') )
			if ( ! isset( $wp_roles ) )
				$wp_roles = new WP_Roles();
	
		// check $wp_roles is object or not
		if ( is_object( $wp_roles ) ) {
	
			//get all assigning capabilities of deals engine
			$capabilities = wps_deals_get_capabilities();
	
			foreach( $capabilities as $cap_group ) {
				foreach( $cap_group as $cap ) {
					//assign some capability to administrator for deals engine
					$wp_roles->add_cap( 'administrator', $cap );
				}//for each for adding cap
			} //for each for capablities
			
		} //end if to check $wp_roles
	}
	/**
	 * Remove Capabilities
	 * 
	 * Handles to remove capabilities when 
	 * plugin is getting reset
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_remove_capabilities() {
		
		global $wp_roles;
	
		//check WP_Roles class is exist or not
		if ( class_exists('WP_Roles') )
			if ( ! isset( $wp_roles ) )
				$wp_roles = new WP_Roles();
	
		// check $wp_roles is object or not
		if ( is_object( $wp_roles ) ) {
	
			//get all assigning capabilities of deals engine
			$capabilities = wps_deals_get_capabilities();
	
			foreach( $capabilities as $cap_group ) {
				foreach( $cap_group as $cap ) {
					//remove added capability to administrator for deals engine
					$wp_roles->remove_cap( 'administrator', $cap );
				}//for each for removing cap
			} //for each for capablities
			
		} //end if to check $wp_roles
	}

	/**
	 * Deals page IDs
	 * 
	 * Handles to return page id from settings
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_get_page_id( $page ) {
		
		$wps_deals_options = wps_deals_get_settings();
		
		$pageid = !empty( $page ) && isset( $wps_deals_options[$page] ) && !empty( $wps_deals_options[$page] ) ? $wps_deals_options[$page] : '-1';
		
		return apply_filters ( 'wps_deals_get_page_id', $pageid );
	}
		
	/**
	 * Current Page URL
	 *
	 * Handles to return current page URL
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_get_current_page_url(){
		
		$curent_page_url = is_ssl() ? 'https://' : 'http://';
		
		//check server port is not 80
		if ( $_SERVER["SERVER_PORT"] != "80" ) {
			$curent_page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$curent_page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		$curent_page_url = remove_query_arg( array( 'oauth_token', 'oauth_verifier' ), $curent_page_url );
		
		return apply_filters( 'wps_deals_get_current_page_url', $curent_page_url );
	}
	
	/**
	 * Check the current page is checkout page
	 * 
	 * Handles to check the current page is 
	 * checkout page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_is_checkout() {
		return ( is_page( wps_deals_get_page_id( 'payment_checkout_page' ) ) )  ? true : false;
	}
	
	/**
	 * Check the current page is my account page
	 * 
	 * Handles to check the current page is 
	 * my account page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_is_account() {
		//check current page is my account page 
		//or edit address or view order or change password or lost password page
		if( is_page( wps_deals_get_page_id( 'my_account_page' ) ) 
			|| is_page( wps_deals_get_page_id( 'edit_adderess' ) ) 
			|| is_page( wps_deals_get_page_id( 'ordered_page' ) ) 
			|| is_page( wps_deals_get_page_id( 'edit_account_endpoint' ) )
			|| is_page( wps_deals_get_page_id( 'lost_password' ) ) 
			|| apply_filters( 'wps_deals_is_account_page', false ) ) {
			
			//return true	
			return true;
		} else {
			//return false
			return false;
		}
	}
	
	/**
	 * Get the current date from timezone
	 * 
	 * Handles to get current date
	 * acording to timezone setting
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_current_date( $format = 'Y-m-d H:i:s' ) { 
		
		if( !empty($format) ) {
			
			$date_time = date( $format, current_time('timestamp') );
		} else {
			
			$date_time = date( 'Y-m-d H:i:s', current_time('timestamp') );
		}
		
		return apply_filters( 'wps_deals_current_date', $date_time );
	}
	
	/**
	 * Get the current timestamp from timezone
	 * 
	 * Handles to get current timestamp
	 * acording to timezone setting
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_current_time() {
		
		$current_time	= current_time('timestamp');
		return apply_filters( 'wps_deals_current_time', $current_time );
	}
	/**
	 * Check if cart has fees applied
	 *
	 * Handles to check has fees in cart or not
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_has_fees() {
		
		global $wps_deals_fees;
		
		return apply_filters( 'wps_deals_cart_has_fees', $wps_deals_fees->has_fees() );
	}
	/**
	 * Get Fees From Cart
	 *
	 * Handles to return fees of cart data
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_get_cart_fees() {
		
		global $wps_deals_fees;
		
		return apply_filters( 'wps_deals_get_cart_fees', $wps_deals_fees->get_fees() );
	}
	/**
	 * Get Fee From Particular ID From Cart
	 *
	 * Handles to return fee from particular ID 
	 * of cart data
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_get_cart_fee( $id = '' ) {
		
		global $wps_deals_fees;
		
		return apply_filters( 'wps_deals_get_cart_fee', $wps_deals_fees->get_fee( $id ) );
	}
	/**
	 * Get Total Fees From Cart
	 *
	 * Handles to return total fees
	 * from cart data
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_get_cart_fee_total() {
		
		global $wps_deals_fees;
		
		return apply_filters( 'wps_deals_get_cart_fee_total', $wps_deals_fees->total() );
	}
	/**
	 * Return the fees for the purchase
	 *
	 * Handles to return purchase fees from order
	 * data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_get_order_fees( $order_data = false ) {
		
		if ( ! $order_data ) //when order data is set or not
			return false;
	
		$fees = array();
		$order_fees = isset( $order_data['fees'] ) ? $order_data['fees'] : false;
	
		//check fees is not empty in order data
		if ( !empty( $order_fees ) ) {
			//make array to return fees details
			foreach ( $order_fees as $fee_id => $fee ) {
				$fees[] = array(
						'id'     			=> $fee_id,
						'amount' 			=> $fee['amount'],
						'display_amount'	=> $fee['display_amount'],
						'label'  			=> $fee['label']
					);
			}
		}
	
		return apply_filters( 'wps_deals_get_order_fees', $fees );
	}
	
	/**
	 * Deals Core Supported Themes
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.6
	 */
	function wps_deals_get_core_supported_themes() {
		
		return apply_filters( 'wps_deals_get_core_supported_themes', array(
																		'twentyfifteen', 
																		'twentyfourteen',
																		'twentythirteen',
																		'twentytwelve',
																		'twentyeleven',
																		'twentyten'
																	)
															);
	}
		
	/**
	 * Get endpoint URL
	 *
	 * Gets the URL for an endpoint, which varies depending on permalink settings.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_get_endpoint_url( $endpoint, $permalink = '', $value = '') {
		
		if ( ! $permalink )
			$permalink = get_permalink();
			
		if ( get_option( 'permalink_structure' ) ) { // if premalink structure is available
			if ( strstr( $permalink, '?' ) ) {
				$query_string = '?' . parse_url( $permalink, PHP_URL_QUERY );
				$permalink    = current( explode( '?', $permalink ) );
			} else {
				$query_string = '';
			}
			$url = trailingslashit( $permalink ) . $endpoint . '/' . $value . $query_string;
		} else {
			$url = add_query_arg( $endpoint, $value, $permalink );
		}
		
		return apply_filters( 'wps_deals_get_endpoint_url', $url);
	}
	
	/**
	 * Get the link to create ana account page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_create_account_url() {	

		global $wps_deals_options;	
		
		$create_account_endpoint = !empty($wps_deals_options['create_an_account_endpoint']) ? $wps_deals_options['create_an_account_endpoint'] : 'create-an-account';
		
		$create_account_url = wps_deals_get_endpoint_url( $create_account_endpoint , get_permalink( wps_deals_get_page_id( 'my_account_page' ) ) );
				
		return apply_filters( 'wps_deals_create_account_url', $create_account_url );
	}
	
	/**
	 * Get the link to the change password page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_change_password_url() {
		
		global $wps_deals_options;
		
		$edit_acc_endpoint = !empty($wps_deals_options['edit_account_endpoint']) ? $wps_deals_options['edit_account_endpoint'] : 'edit-account';
		
		$change_password_url = wps_deals_get_endpoint_url( $edit_acc_endpoint , get_permalink( wps_deals_get_page_id( 'my_account_page' ) ) );
		
		return apply_filters( 'wps_deals_change_password_url', $change_password_url);
	}
	
	/**
	 * Get the link to view orders page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_view_orders_url() {
		
		global $wps_deals_options;
		
		$view_orders_endpoint = !empty($wps_deals_options['view_orders_endpoint']) ? $wps_deals_options['view_orders_endpoint'] : 'view-orders';
		
		$view_orders_url = wps_deals_get_endpoint_url( $view_orders_endpoint , get_permalink( wps_deals_get_page_id( 'my_account_page' ) ) );
		
		return apply_filters( 'wps_deals_view_orders_url', $view_orders_url);
	}
	
	/**
	 * Get the link to lost password page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_lost_password_url() {
		
		global $wps_deals_options;	
		
		$lost_password_endpoint = !empty($wps_deals_options['lost_password_endpoint']) ? $wps_deals_options['lost_password_endpoint'] : 'lost-password';
		
		$lost_password_url = wps_deals_get_endpoint_url( $lost_password_endpoint , get_permalink( wps_deals_get_page_id( 'my_account_page' ) ) );
		
		return apply_filters( 'wps_deals_lost_password_url', $lost_password_url);
	}
	
	/**
	 * Get the link to edit address page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_edit_address_url() {
		
		global $wps_deals_options;	
		
		$edit_address_endpoint = !empty($wps_deals_options['edit_address_endpoint']) ? $wps_deals_options['edit_address_endpoint'] : 'edit-address';
		
		$edit_address_url = wps_deals_get_endpoint_url( $edit_address_endpoint , get_permalink( wps_deals_get_page_id( 'my_account_page' ) ) );
		
		return apply_filters( 'wps_deals_edit_address_url', $edit_address_url);
	}
	
	/**
	 * Get the link to Social deals checkout thank you page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_checkout_thank_you_url() {		
		
		global $wps_deals_options;	
		
		$deals_thank_you_page_endpoint = !empty($wps_deals_options['deals_thank_you_page_endpoint']) ? $wps_deals_options['deals_thank_you_page_endpoint'] : 'social-deals-thank-you-page';
		
		$checkout_thank_you_url = wps_deals_get_endpoint_url( $deals_thank_you_page_endpoint , get_permalink( wps_deals_get_page_id( 'payment_checkout_page' ) ) );
				
		return apply_filters( 'wps_deals_checkout_thank_you_url', $checkout_thank_you_url);
	}
	
	/**
	 * Get the link to Social deals checkout cancel page
	 *
	 * @package Social Deals Engine
	 * @since 2.0.7
	 * @return string
	 */
	function wps_deals_checkout_cancel_url() {		
		
		global $wps_deals_options;	
		
		$deals_cancel_page_endpoint = !empty($wps_deals_options['deals_cancel_page_endpoint']) ? $wps_deals_options['deals_cancel_page_endpoint'] : 'social-deals-cancel-page';
		
		$checkout_cancel_url = wps_deals_get_endpoint_url( $deals_cancel_page_endpoint , get_permalink( wps_deals_get_page_id( 'payment_checkout_page' ) ) );
				
		return apply_filters( 'wps_deals_checkout_cancel_url', $checkout_cancel_url);
	}
	
	/**
	 * Get the undo url
	 *
	 * @package Social Deals Engine
	 * @since 2.1.9
	 * @return string
	 */
	function wps_deals_get_undo_url( $dealid ) {
		
		$query_arg = array(
			'undo_item' => $dealid
		);
		
		// get checkout page url
		$chekout_page_url = get_permalink( wps_deals_get_page_id( 'payment_checkout_page' ) );
		// make undo url
		$undo_url = add_query_arg( $query_arg, $chekout_page_url );
		
		return apply_filters( 'wps_deals_undo_url', wp_nonce_url( $undo_url, 'social-deals-cart' ) );
	}

	/**
	 * Fix active class in wp_list_pages for deals shop page.
	 *	 
	 * @package Social Deals Engine
	 * @since 2.1.0
	 * @param string $pages
	 * @return string
	 */
	function wps_deals_list_pages( $pages ) {	          		
		
		$shop_page = 'page-item-' . wps_deals_get_page_id('shop_page'); // find shop_page_id through deals options

		if (is_page( wps_deals_get_page_id( 'shop_page' ) ) || is_post_type_archive( WPS_DEALS_POST_TYPE ))
			$pages = str_replace($shop_page, $shop_page . ' current_page_item', $pages); // add current_page_item class to shop page    	
		return $pages;
	}
	add_filter( 'wp_list_pages', 'wps_deals_list_pages' );
	
	
	
	/**
	 * Is Test Mode
	 *
	 * @since 2.2.6
	 * @return bool $ret True if return mode is enabled, false otherwise
	 */
	function wps_deals_is_test_mode() {
		global $wps_deals_options;
		
		$ret = !empty($wps_deals_options['enable_testmode']) ? '1' : '0' ;
		return (bool) apply_filters( 'wps_deals_is_test_mode', $ret );
	}
	
	
	
	/**
	 * Is chaching
	 *
	 * @since 2.2.6
	 * @return bool $ret True if return mode is enabled, false otherwise
	 */
	function wps_deals_is_chaching() {
		global $wps_deals_options;
		$ret = !empty($wps_deals_options['caching']) ? '1' : '0';
		return (bool) apply_filters( 'wps_deals_is_chaching', $ret );
	}

	
	/**
	 *Twitter bootstrip
	 *
	 * @since 2.2.6
	 * @return bool $ret True if return mode is enabled, false otherwise
	 */
	function wps_deals_is_twitter_bootstrap() {
		global $wps_deals_options;
		
		$ret = !empty($wps_deals_options['disable_twitter_bootstrap']) ? '1' : '0';
		return (bool) apply_filters( 'wps_deals_is_twitter_bootstrap', $ret );
	}
	
	
	/**
	 *Enabled Billing
	 *
	 * @since 2.2.6
	 * @return bool $ret True if billing  is enabled, false otherwise
	 */
	function wps_deals_is_billing_enabled() {
		global $wps_deals_options;
		
		$ret = !empty($wps_deals_options['enable_billing']) ? '1' : '0';
		return (bool) apply_filters( 'wps_deals_is_billing_enabled', $ret );
	}

	
	

	/**
	 * Is Guest Checkout
	 *
	 * @since 2.2.6
	 * @return bool $ret True if guest checkout is enabled, false otherwise
	 */
	function wps_deals_is_guest_checkout() {
		global $wps_deals_options;
		
		$ret = !empty($wps_deals_options['disable_guest_checkout']) ? '1' : '0';
		return (bool) apply_filters( 'wps_deals_is_guest_checkout', $ret );
	}
	
	/**
	 * Is Guest Checkout
	 *
	 * @since 2.5.6
	 * @return bool $ret True if guest checkout is enabled, false otherwise
	 */
	function wps_deals_currency() {
		global $wps_deals_options;
		
		$ret = !empty($wps_deals_options['currency']) ? $wps_deals_options['currency'] : '';
		return apply_filters( 'wps_deals_currency', $ret );
	}

?>