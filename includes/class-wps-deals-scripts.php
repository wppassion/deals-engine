<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Scripts {
	
	public $currency;
	
	public function __construct() {
		
		global $wps_deals_currency;
		
		$this->currency = $wps_deals_currency;
		
	}
	
	/**
	 * Enqueue Styles
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_admin_styles() {
		
		wp_register_style( 'wps-deals-chosen-styles', WPS_DEALS_URL . 'includes/css/chosen/chosen.css', array(), WPS_DEALS_VERSION );
		wp_enqueue_style( 'wps-deals-chosen-styles' );
		
		wp_register_style( 'wps-deals-admin-styles', WPS_DEALS_URL . 'includes/css/wps-deals-admin.css', array(), WPS_DEALS_VERSION );
		wp_enqueue_style( 'wps-deals-admin-styles' );
		
		wp_register_style( 'wps-deals-chosen-custom-styles', WPS_DEALS_URL . 'includes/css/chosen/chosen-custom.css', array(), WPS_DEALS_VERSION );
		wp_enqueue_style( 'wps-deals-chosen-custom-styles' );
		
	}
	
	/**
	 * Enqueue Scripts for backend
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_admin_scripts() {
		
		global $wp_version, $wps_deals_options;
		
		wp_register_script( 'wps-deals-chosen-scripts', WPS_DEALS_URL . 'includes/js/chosen/chosen.jquery.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
		wp_enqueue_script( 'wps-deals-chosen-scripts' );
		
		wp_register_script( 'wps-deals-admin-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-admin.js', array( 'jquery','jquery-ui-datepicker', 'jquery-ui-sortable' ) , WPS_DEALS_VERSION, true );
		wp_enqueue_script( 'wps-deals-admin-scripts' );
		
		//when user will not insert paypal api user name / password / signature
		$paypalapi = '';
		if( WPS_DEALS_PAYPAL_API_USERNAME == '' || WPS_DEALS_PAYPAL_API_PASSWORD == '' || WPS_DEALS_PAYPAL_API_SIGNATURE == '' ) {
			$paypalapi = '1';
		}
		
		//localize script
		$newui = $wp_version >= '3.5' ? '1' : '0'; //check wp version for showing media uploader
		wp_localize_script( 'wps-deals-admin-scripts', 'WpsDealsSettings', array( 
																					'new_media_ui'		=>	$newui,
																					'issue_refund_msg'	=>	__( 'Are you sure want to refund this order payment?', 'wpsdeals' ),
																					'paypalapi'			=>	$paypalapi,
																					'paypalapierror'	=>	__( 'Please Enter Paypal API User Name,Password and Signature in settings page to proceed refund.', 'wpsdeals' ),
																					'testemailsuccess'	=>	__( 'Test email has been sent successfully.', 'wpsdeals' ),
																					'testemailerror'	=>	__( 'Test email could not sent.', 'wpsdeals' ),
																					'deal_price_less_than_normal_price_error'  => __( 'Please enter a value less than the regular price.', 'wpsdeals' ),
																					'decimal_seperator' => $wps_deals_options['decimal_seperator'],
																					'deal_price_numeric_error' => __( 'Please enter in monetory decimal(.) format without thousand separators and currency symbols.', 'wpsdeals' ),
																				));
		wp_enqueue_media();
		
		wp_register_script('wps-deals-admin-livequery-script', WPS_DEALS_URL.'includes/js/wps-deals-livequery.js',array('jquery'), WPS_DEALS_VERSION, true );
		wp_enqueue_script('wps-deals-admin-livequery-script');
	}
	
	/**
	 * Enqueue Scripts 
	 * 
	 * Load Javascript for settings page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_settings_page_scripts($hook_suffix) {

		$hook_common = array( 'wpsdeals_page_wps-deals-settings', 'wpsdeals_page_wps-deals-sales' );
		
		// settings page
		if ( in_array($hook_suffix, $hook_common) ) {
				// loads the required scripts for the meta boxes
				wp_enqueue_script( 'common' );
				wp_enqueue_script( 'wp-lists' );
				wp_enqueue_script( 'postbox' );
		}
		
		// include css for deals sales start date and end date filter
		if( $hook_suffix == 'wpsdeals_page_wps-deals-sales' ) {
	   		// enqueue date-time-picker css
	   		wp_enqueue_style( 'wps-deals-sales-date-css', WPS_DEALS_META_URL.'/css/datetimepicker/date-time-picker.css', array(), WPS_DEALS_VERSION );
	  	}
	}
	
	/**
	 * Loading Additional Java Script
	 *
	 * Loads the JavaScript required for toggling the meta boxes on the theme settings page.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_settings_page_load_scripts( $hook_suffix ) { 
		?>				
			<script type="text/javascript">
				//<![CDATA[
				jQuery(document).ready( function($) {
					$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
					postboxes.add_postbox_toggles( 'wpsdeals_page_wps-deals-settings' );
				});
				//]]>
			</script>
		<?php
		
	 	if( !isset( $_GET['action'] ) ) { //prevent deal order edit page
	 	//Test preview for email template from email settings
	?>	
		<script type="text/javascript">

			//<![CDATA[
			jQuery(document).ready(function(){
				
			   	jQuery('a[rel^="wps_deal_preview_purchase_receipt"]').prettyPhoto({
			   		social_tools:"",
			   		default_width:1000,
			   		theme:"facebook", /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			   		changepicturecallback: function(){
						jQuery('#wps_deal_preview_purchase_receipt').hide();
			   			jQuery('.pp_content_container .pp_content').css('height', 'auto');
			   			jQuery('.pp_content_container .pp_content').css('padding-bottom', '35px');
			   			var email_template = jQuery('.wps-deals-email-template').val();
						jQuery('.wps-deals-preview-popup').hide();
						if( email_template != '' ) {
							jQuery('.wps-deals-preview-'+email_template+'-popup').show();
						} else {
							jQuery('.wps-deals-preview-default-popup').show();
						}
			   		}
			   	});
			});
			//]]>
		</script>
	<?php
	
	 	}

	}
	
	/**
	 * Loading Additional Java Script
	 *
	 * Loads the JavaScript required for deal sale popup 
	 * prettyphoto
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */

	 function wps_deals_sales_head_scripts() { 
		
	 	if( !isset( $_GET['action'] ) ) { //prevent deal order edit page
	 	
	?>	
		<script type="text/javascript">

			//<![CDATA[
			jQuery(document).ready(function(){
				 
			   	jQuery('a[rel^="wps_deal_sale_view"]').prettyPhoto({
			   		social_tools:"",
			   		default_width:1000,
			   		theme:"facebook" /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			   	});
			});
			//]]>
		</script>
	<?php
	
	 	}

	}
	/**
	 * Loading Additional Java Script
	 *
	 * Loads the JavaScript required for toggling the order detail on the edit order page.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_order_detail_scripts( $hook_suffix ) { 
		?>				
			<script type="text/javascript">
				//<![CDATA[
				jQuery(document).ready( function($) {
					$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
					postboxes.add_postbox_toggles( 'wpsdeals_page_wps-deals-sales' );
				});
				//]]>
			</script>
		<?php
	}
	/**
	 * Enqueue Script for admin deal sales page
	 * 
	 * Handles script which is enqueue in deals sales page
	 * pretty photo jquery
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deal_popup_scritps() {
		
		wp_register_script( 'wps-deals-popup-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-prettyphoto.js', array('jquery'), WPS_DEALS_VERSION, true );
	}
	
	/**
	 * Enqueue Styles
	 *
	 * Loads the css file for the deals sales page
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	public function wps_deals_sales_styles() {

		wp_register_style( 'wps-deals-sales-styles', WPS_DEALS_URL . 'includes/css/wps-deals-prettyphoto.css', array(), WPS_DEALS_VERSION );
		wp_enqueue_style( 'wps-deals-sales-styles' );
	}
	
	/**
	 * Enqueue Scripts for frontside
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_front_scripts() {

		global $post,$wps_deals_options;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//check site is running on SSL or not
		$urlsuffix = is_ssl() ? 'https://' : 'http://'; 
		
		$disableguest = !empty( $wps_deals_options['disable_guest_checkout'] ) ? '1' : '0';
		$enableterms = !empty( $wps_deals_options['enable_terms'] ) ? '1' : '0';
		
		//register credit card validator script
		wp_register_script( 'wps-deals-credit-card-validator-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-credit-card-validator.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
		
		//countdown timer script
		wp_register_script( 'wps-deals-countdown-timer-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-countdown.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
		//timer localization variables for timer labels
		wp_localize_script( 'wps-deals-countdown-timer-scripts', 'Wps_Deals_Timer', array(
																					'days'		=>	__( 'days', 'wpsdeals' ),
																					'hours'		=>	__( 'hrs', 'wpsdeals' ),
																					'minutes'	=>	__( 'mins', 'wpsdeals' ),
																					'seconds'	=>	__( 'secs', 'wpsdeals' ),
																					'today'		=>	wps_deals_current_date( 'F d, Y H:i:s' ) //date('F d, Y H:i:s', time())
																				));
		//do not include this script in footer otherwise timer countdown will disabled
		wp_register_script( 'wps-deals-front-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-front.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
		wp_enqueue_script( 'wps-deals-front-scripts' );
		
		wp_register_script( 'twitter-bootstrap', WPS_DEALS_URL . 'includes/js/bootstrap.js', array( 'jquery' ), '2.3.1', true );
		if( empty( $wps_deals_options['disable_twitter_bootstrap'] ) ) {
			wp_enqueue_script( 'twitter-bootstrap' );
		}
		
		if(isset($wps_deals_options['enable_lightbox'])) {
			//deals gallery images js
			wp_register_script( 'wps-deals-gallery-image-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-gallery-prettyPhoto.js', array('jquery'), WPS_DEALS_VERSION, true );
			wp_enqueue_script( 'wps-deals-gallery-image-scripts' );
		}
		
		//get caching is on site or not
		$caching = isset( $wps_deals_options['caching'] ) && !empty( $wps_deals_options['caching'] ) ? '1' : '';
		
		//generic localize script
		wp_localize_script( 'wps-deals-front-scripts', 'Wps_Deals', array(  'ajaxurl' 					=>	admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																			'disableguest'				=>	$disableguest,
																			'cart_email_blank'			=>	__( '<span><strong>ERROR : </strong>Please enter valid email.</span>','wpsdeals' ),
																			'cart_email_invalid'		=>	__( '<span><strong>ERROR : </strong>Invalid email entered.</span>','wpsdeals' ),
																			'cart_login_user_pass_blank'=> 	__( '<span><strong>ERROR : </strong>Please enter username and password.</span>','wpsdeals' ),
																			'cart_login_user_blank'		=> 	__( '<span><strong>ERROR : </strong>Please enter valid username.</span>','wpsdeals' ),
																			'cart_login_pass_blank'		=> 	__( '<span><strong>ERROR : </strong>Please enter correct password.</span>','wpsdeals' ),
																			'cart_must_reg'				=> 	__( '<span><strong>ERROR : </strong>You must register or login to complete your purchase.</span>','wpsdeals' ),
																			'cart_reg_pass_blank'		=> 	__( '<span><strong>ERROR : </strong>Please enter password.</span>','wpsdeals' ),
																			'cart_reg_conf_pass_blank'	=> 	__( '<span><strong>ERROR : </strong>Please enter confirm password.</span>','wpsdeals' ),
																			'cart_reg_same_pass'		=> 	__( '<span><strong>ERROR : </strong>Password and confirm password must be same.</span>','wpsdeals' ),
																			'cart_reg_user_blank'		=> 	__( '<span><strong>ERROR : </strong>Please enter user name.</span>','wpsdeals' ),
																			'cart_firstname_blank'		=> 	__( '<span><strong>ERROR : </strong>Please enter first name.</span>','wpsdeals' ),
																			'cart_lastname_blank'		=> 	__( '<span><strong>ERROR : </strong>Please enter last name.</span>','wpsdeals' ),
																			'agree_terms'				=> 	__( '<span><strong>ERROR : </strong>You must agree to the terms of purchase.</span>','wpsdeals'),
																			'enableterms'				=>	$enableterms,
																			'no_payment_selected'		=>	__( '<span><strong>ERROR : </strong>No payment gateway selected.</span>','wpsdeals' ),
																			'caching'					=>	$caching
																			/*
																			'card_no_empty'				=>	__( '<span><strong>ERROR : </strong>Please enter valid credit card number.</span>','wpsdeals' ),
																			'card_cvc_empty'			=>	__( '<span><strong>ERROR : </strong>Please enter valid credit card security code.</span>','wpsdeals' ),
																			'card_name_empty'			=>	__( '<span><strong>ERROR : </strong>Please enter valid credit card name.</span>','wpsdeals' ),
																			'card_exp_month_empty'		=>	__( '<span><strong>ERROR : </strong>Please choose credit card expiry month.</span>','wpsdeals' ),
																			'card_exp_date_empty'		=>	__( '<span><strong>ERROR : </strong>Please choose credit card expiry year.</span>','wpsdeals' ),
																			*/
																		) );

		//get billing is enable or not
		$enablebilling = isset( $wps_deals_options['enable_billing'] ) && !empty( $wps_deals_options['enable_billing'] ) ?	'1'	:	'0';

		//billing details locatize script
		wp_localize_script( 'wps-deals-front-scripts', 'Wps_Deals_Billing',	array(
																					'enable'			=>	$enablebilling,
																					'country'			=>	__( '<span><strong>ERROR : </strong>Please select billing country.</span>','wpsdeals' ),
																					'address'			=>	__( '<span><strong>ERROR : </strong>Please enter billing address.</span>','wpsdeals' ),
																					'city'				=>	__( '<span><strong>ERROR : </strong>Please enter billing town / city.</span>','wpsdeals' ),
																					'state'				=>	__( '<span><strong>ERROR : </strong>Please enter billing state / county.</span>','wpsdeals' ),
																					'postcode'			=>	__( '<span><strong>ERROR : </strong>Please enter billing postcode.</span>','wpsdeals' ),
																					//'phone'			=>	__( '<span><strong>ERROR : </strong>Please enter billing phone number.</span>','wpsdeals' ),
																					'firstname'			=>	__( '<span><strong>ERROR : </strong>Please enter first name.</span>','wpsdeals' ),
																					'lastname'			=>	__( '<span><strong>ERROR : </strong>Please enter last name.</span>','wpsdeals' ),
																					'email'				=>	__( '<span><strong>ERROR : </strong>Please enter valid email address.</span>','wpsdeals' ),
																					'currentpassword'	=>	__( '<span><strong>ERROR : </strong>Please enter current password.</span>','wpsdeals' ),
																					'password1'			=>	__( '<span><strong>ERROR : </strong>Please enter new password.</span>','wpsdeals' ),
																					'password2'			=>	__( '<span><strong>ERROR : </strong>Please enter re-enter new password.</span>','wpsdeals' ),
																					'comparepassword'	=>	__( '<span><strong>ERROR : </strong>Passwords do not match.</span>','wpsdeals' ),
																					'usernameemail'		=>	__( '<span><strong>ERROR : </strong>Please enter username or e-mail address.</span>','wpsdeals' ),
																					'loginusername'		=>	__( '<span><strong>ERROR : </strong>Please enter your username.</span>','wpsdeals' ),
																					'loginpassword'		=>	__( '<span><strong>ERROR : </strong>Please enter your password.</span>','wpsdeals' ),
																			));
		
		if( is_singular() ) { //check current page is not home page
			
			// register google Map Js files 
			wp_register_script( 'wps-deals-google-map', $urlsuffix.'maps.google.com/maps/api/js?sensor=false', array(), WPS_DEALS_VERSION, true );
			wp_register_script( 'wps-deals-map-script', WPS_DEALS_URL . 'includes/js/wps-deals-map.js', array(), WPS_DEALS_VERSION, true );	
			
			//do action to add localize script for individual post data
			do_action( 'wps_deals_localize_map_script' );
			
		}
		
		//control the facebook buttons to set cookie for ajax call
		//facebook button
		if( !empty( $wps_deals_options['social_buttons'] ) ) {
			
			//check facebook like button is emable or facebook social login enable or not
			if( ( in_array('facebook',$wps_deals_options['social_buttons'] ) 
				|| ( !empty( $wps_deals_options['enable_facebook'] ) && WPS_DEALS_FB_APP_ID != '' && WPS_DEALS_FB_APP_SECRET != '' ) ) )  {
				
				wp_deregister_script( 'facebook' );
				wp_register_script( 'facebook', $urlsuffix.'connect.facebook.net/'.$wps_deals_options['fb_language'].'/all.js#xfbml=1&appId='.WPS_DEALS_FB_APP_ID, false, WPS_DEALS_VERSION, true );
								
			}
			//twitter button
			if(in_array('twitter',$wps_deals_options['social_buttons'])) {
				
				wp_deregister_script( 'twitter' );
				wp_register_script( 'twitter', $urlsuffix.'platform.twitter.com/widgets.js',array( 'jquery' ), WPS_DEALS_VERSION, true );
				
			}
			
			//google plus button
			if(in_array('google',$wps_deals_options['social_buttons'])) {
				
				wp_deregister_script('google');
				wp_register_script( 'google', $urlsuffix.'apis.google.com/js/plusone.js',array( 'jquery' ), WPS_DEALS_VERSION, true );
				
			}
		}
		
		//Social Media Scripts
		//register social media script
		
		//if there is no authentication data entered in settings page then so error
		$fberror = $twerror = $gperror = $lierror = $yherror = $wlerror = '';
		if( WPS_DEALS_FB_APP_ID == '' 		|| WPS_DEALS_FB_APP_SECRET == '' ) { $fberror = '1'; }
		if( WPS_DEALS_TW_CONSUMER_KEY == '' || WPS_DEALS_TW_CONSUMER_SECRET == '' ) { $twerror = '1' ; }
		if( WPS_DEALS_GP_CLIENT_ID == '' 	|| WPS_DEALS_GP_CLIENT_SECRET == '' ) { $gperror = '1'; }
		if( WPS_DEALS_LI_APP_ID == '' 		|| WPS_DEALS_LI_APP_SECRET == '' ) { $lierror = '1'; }
		if( WPS_DEALS_YH_CONSUMER_KEY == '' || WPS_DEALS_YH_CONSUMER_SECRET == '' || WPS_DEALS_YH_APP_ID == '' ) { $yherror = '1'; }
		if( WPS_DEALS_WL_CLIENT_ID == '' 	|| WPS_DEALS_WL_CLIENT_SECRET == '' ) { $wlerror = '1'; }
		
		//get login url
		$twitterloginurl = wp_login_url();//site_url('wp-login.php');
		$twitterloginurl = add_query_arg( array( 'wps_deals_social_login'	=> 1,
												 'dealsnetwork'				=> 'twitter' )
										, $twitterloginurl );
		
		wp_register_script( 'wps-deals-social-front-scripts', WPS_DEALS_SOCIAL_URL . '/js/wps-deals-social-front.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
		wp_localize_script( 'wps-deals-social-front-scripts', 'WpsDealsSocial', array( 
																						'ajaxurl'					=>	admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																						'fberror'					=>	$fberror,
																						'gperror'					=>	$gperror,
																						'twerror'					=>	$twerror,
																						'lierror'					=>	$lierror,
																						'yherror'					=>	$yherror,
																						'wlerror'					=>	$wlerror,
																						'urlerror'					=>	__( 'Improper CallBack URL.', 'wpsdeals' ),
																						'fberrormsg'				=>	__( 'Please enter Facebook API Key & Secret in settings page.', 'wpsdeals' ),
																						'twerrormsg'				=>	__( 'Please enter Twitter Consumer Key & Secret in settings page.', 'wpsdeals' ),
																						'gperrormsg'				=>	__( 'Please enter Google+ Client ID & Secret in settings page.', 'wpsdeals' ),
																						'lierrormsg'				=>	__( 'Please enter LinkedIn API Key & Secret in settings page.', 'wpsdeals' ),
																						'yherrormsg'				=>	__( 'Please enter Yahoo API Consumer Key, Secret & App Id in settings page.', 'wpsdeals' ),
																						'wlerrormsg'				=>	__( 'Please enter Windows Live Client ID & Client Secret in settings page.', 'wpsdeals' ),
																						'socialtwitterloginredirect'=>	$twitterloginurl
																					) );
		//if facebook application id & application secret are not empty
		if( !empty( $wps_deals_options['enable_facebook'] ) && WPS_DEALS_FB_APP_ID != '' && WPS_DEALS_FB_APP_SECRET != '' ) {
			
			wp_register_script( 'wps-deals-social-fbinit', WPS_DEALS_SOCIAL_URL . '/js/wps-deals-social-fbinit.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
			wp_localize_script( 'wps-deals-social-fbinit', 'WpsDealsFbInit', array( 'app_id' => WPS_DEALS_FB_APP_ID ) );
		}
		
	}
	
	/**
	 * Enqueue Styles
	 *
	 * Loads the css file for the front end.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	public function wps_deals_front_end_print_styles() {
	
		global $wps_deals_options;

		wp_register_style( 'twitter-bootstrap', WPS_DEALS_URL . 'includes/css/bootstrap.css', array(), WPS_DEALS_VERSION );
		if( empty( $wps_deals_options['disable_twitter_bootstrap'] ) ) {
			wp_enqueue_style( 'twitter-bootstrap' );
		}
		
		wp_register_style( 'wps-deals-front-styles', WPS_DEALS_URL . 'includes/css/wps-deals-front.css', array(), WPS_DEALS_VERSION );
		wp_enqueue_style( 'wps-deals-front-styles' );
		
		wp_register_style( 'wps-deals-custom', WPS_DEALS_URL . 'includes/css/wps-deals-custom.css', array(), WPS_DEALS_VERSION );
		
		// only register the custom css if the admin has added some entries to it
		if( !empty( $wps_deals_options['custom_css'] ) ) {
			wp_enqueue_style( 'wps-deals-custom' );
		}
		
		//deals gallery image css
		wp_register_style( 'wps-deals-gallery-image-styles', WPS_DEALS_URL . 'includes/css/wps-deals-gallery-prettyPhoto.css', array(), WPS_DEALS_VERSION );
		wp_enqueue_style( 'wps-deals-gallery-image-styles' );
	}
	
	/**
	 * Enqueue Script for admin deal reports page
	 * 
	 * Handles script which is enqueue in deals reports page
	 * pretty photo jquery
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deal_report_graph_scritps() {
		
		global $post,$wps_deals_options;
		
		wp_register_script( 'wps-deals-graph-scripts', WPS_DEALS_URL . 'includes/js/wps-deals-graph.js', array(), WPS_DEALS_VERSION, true );
		wp_enqueue_script( 'wps-deals-graph-scripts' );
		wp_localize_script( 'wps-deals-graph-scripts', 'wps_deals_vars', array(
	        'post_id' 			=> isset( $post->ID ) ? $post->ID : null,
	        'currency'			=> $this->currency->wps_deals_currency_symbol($wps_deals_options['currency']),
	        'currency_pos'		=> isset( $wps_deals_options['currency_position'] ) ? $wps_deals_options['currency_position'] : 'before',
	    ));
	}
	
	/**
	 * Enqueue style for meta box page
	 * 
	 * Handles style which is enqueue in deals meta box page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_metabox_styles() {
		
		// Enqueue Meta Box Style
		wp_enqueue_style( 'wps-deals-meta-box', WPS_DEALS_META_URL . '/css/meta-box.css', array(), WPS_DEALS_VERSION );
  
		// Enqueue select2 library, use proper version.
		//wp_enqueue_style( 'wps-multiselect-select2-css', WPS_DEALS_META_URL . '/js/select2/select2.css', array(), null );
		
		// Enqueue for datepicker
		wp_enqueue_style( 'wps-deals-meta-jquery-ui-css', WPS_DEALS_META_URL.'/css/datetimepicker/date-time-picker.css', array(), WPS_DEALS_VERSION );
		
		// Enqueu built-in style for color picker.
		if( wp_style_is( 'wp-color-picker', 'registered' ) ) { //since WordPress 3.5
			wp_enqueue_style( 'wp-color-picker' );
		} else {
			wp_enqueue_style( 'farbtastic' );
		}
		
	}
	
	/**
	 * Enqueue script for meta box page
	 * 
	 * Handles script which is enqueue in deals meta box page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_metabox_scripts() {
		
		global $wp_version;
		
		// Enqueue Meta Box Scripts
		wp_enqueue_script( 'wps-deals-meta-box', WPS_DEALS_META_URL . '/js/meta-box.js', array( 'jquery' ), WPS_DEALS_VERSION, true );
		
		//localize script
		$newui = $wp_version >= '3.5' ? '1' : '0'; //check wp version for showing media uploader
		wp_localize_script( 'wps-deals-meta-box','WpsDeals',array(	'new_media_ui'	=>	$newui,
																	'one_file_min'	=>  __('You must have at least one file.','wpsdeals' ),
																	'one_deal_min'	=>  __('You must have at least one deal.','wpsdeals' )));

		// Enqueue for  image or file uploader
		wp_enqueue_script( 'media-upload' );
		add_thickbox();
		wp_enqueue_script( 'jquery-ui-sortable' );
		
		// Enqueue JQuery select2 library, use proper version.
		//wp_enqueue_script( 'wps-multiselect-select2-js', WPS_DEALS_META_URL . '/js/select2/select2.js', array( 'jquery' ), false, true );
		
		// Enqueue for datepicker
		wp_enqueue_script( array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider' ) );
		
		wp_deregister_script( 'datepicker-slider' );
		wp_register_script('datepicker-slider', WPS_DEALS_META_URL.'/js/datetimepicker/jquery-ui-slider-Access.js', array(), WPS_DEALS_VERSION, true );
		wp_enqueue_script( 'datepicker-slider' );
		
		wp_deregister_script( 'timepicker-addon' );
		wp_register_script('timepicker-addon',WPS_DEALS_META_URL.'/js/datetimepicker/jquery-date-timepicker-addon.js',array('datepicker-slider'), WPS_DEALS_VERSION, true);
		wp_enqueue_script('timepicker-addon');
							
		// Enqueu built-in script for color picker.
		if( wp_script_is( 'wp-color-picker', 'registered' ) ) { //since WordPress 3.5
			wp_enqueue_script( 'wp-color-picker' );
		} else {
			wp_enqueue_script( 'farbtastic' );
		}
		
	}
	
	/**
	 * Register and Enqueue Script For
	 * Chart
	 * 
	 * Handles to load chart scipts
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_login_scripts() {
		
		//check site is running on SSL or not
		$urlsuffix = is_ssl() ? 'https://' : 'http://'; 
		
		wp_register_script( 'google-jsapi', $urlsuffix.'www.google.com/jsapi', array('jquery'), WPS_DEALS_VERSION, false); // in header
		wp_enqueue_script( 'google-jsapi' );
	}
	/**
	 * Register and Enqueue Script For
	 * Sortable
	 * 
	 * Handles to load sortable script
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_sortable() {
		
		wp_register_script( 'wps-deals-sortable', WPS_DEALS_URL . 'includes/js/wps-deals-sortable.js', array( 'jquery', 'jquery-ui-sortable' ) , WPS_DEALS_VERSION, true );
		wp_enqueue_script( 'wps-deals-sortable' );
	}
	
	/**
	 * Add Faceook Root Div
	 * 
	 * Handles to add facebook root
	 * div to page
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function wps_deals_fb_root() {
	
		echo '<div id="fb-root"></div>';
	}
	
	/**
	 * Add admin notice to deals plugin
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.6
	 */
	public function wps_deals_add_notices() {
		
		global $wps_deals_options;
		
		//Get notices field
		$notices = get_option( 'wpsdeals_admin_notices', array() );
		
		if ( ! empty( $_GET['hide_sde_theme_support_notice'] ) ) {//hide notice is true
			$notices = array_diff( $notices, array( 'theme_support' ) );
			update_option( 'wpsdeals_admin_notices', $notices );
		}
		
		//Get notices field
		$notices	= get_option( 'wpsdeals_admin_notices', array() );
		
		if ( in_array( 'theme_support', $notices ) && ! current_theme_supports( 'wpsdeals' ) ) {
			
			$template = get_option( 'template' );
			
			if ( ! in_array( $template, wps_deals_get_core_supported_themes() ) ) {
				wp_enqueue_style( 'wps-deals-activation', WPS_DEALS_URL . 'includes/css/wps-deals-activation.css', array(), WPS_DEALS_VERSION );
				add_action( 'admin_notices', array( $this, 'wps_deals_theme_check_notice' ) );
			}
		}
	}
	
	/**
	 * Add Theme Support Admin Notice
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.6
	 */
	public function wps_deals_theme_check_notice() {
		
		include_once( WPS_DEALS_ADMIN . '/forms/html-notice-theme-support.php' );
	}
	
	/**
	 * Adding Hooks
	 *
	 * Adding proper hoocks for the scripts.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		//add styles for admin
		add_action('admin_print_styles', array($this, 'wps_deals_admin_styles'));
		add_action('admin_enqueue_scripts', array($this, 'wps_deals_admin_scripts'));
		
		//add styles for front end
		add_action( 'wp_print_styles', array( $this, 'wps_deals_front_end_print_styles' ) );
		
		//settings page script
		add_action( 'admin_enqueue_scripts', array( $this, 'wps_deals_settings_page_scripts' ) );
		
		//script for front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wps_deals_front_scripts' ) );
		
		//script for dashboard page
		add_action( 'admin_print_scripts-index.php', array( $this, 'wps_deal_popup_scritps' ) );
		add_action( 'admin_head-index.php', array( $this, 'wps_deals_sales_head_scripts' ) );
		add_action( 'admin_print_styles-index.php', array( $this, 'wps_deals_sales_styles' ) );
	
		//add styles for metaboxes
		add_action( 'admin_print_styles-post.php', array($this, 'wps_deals_metabox_styles') );
		add_action( 'admin_print_styles-edit.php', array($this, 'wps_deals_metabox_styles') );
		add_action( 'admin_print_styles-post-new.php', array($this, 'wps_deals_metabox_styles') );
		
		//add styles for metaboxes
		add_action( 'admin_print_scripts-post.php', array($this, 'wps_deals_metabox_scripts') );
		add_action( 'admin_print_scripts-edit.php', array($this, 'wps_deals_metabox_scripts') );
		add_action( 'admin_print_scripts-post-new.php', array($this, 'wps_deals_metabox_scripts') );
		
		 //add facebook root div
		add_action( 'wp_footer', array( $this, 'wps_deals_fb_root' ) );
		
		//Add notices for deals plugin
		add_action( 'admin_print_styles', array( $this, 'wps_deals_add_notices' ) );
	}
}
?>