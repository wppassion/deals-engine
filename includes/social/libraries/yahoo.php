<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Yahoo Class
 *
 * Handles all yahoo functions 
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
if( !class_exists( 'Wps_Deals_Social_Yahoo' ) ) {
	
	class Wps_Deals_Social_Yahoo {
		
		var $yahoo, $session;
		
		public function __construct() {
			
			global $wps_deals_session;
			
			$this->session	= $wps_deals_session;
		}
		
		/**
		 * Include Yahoo Class
		 * 
		 * Handles to load yahoo class
		 * 
		 * @package Social Deals Engine
	 	 * @since 1.0.0
		 */
		public function wps_deals_social_load_yahoo() {
			
			global $wps_deals_options;
			
			//yahoo declaration
			if( !empty( $wps_deals_options['enable_yahoo'] ) && 
				!empty( $wps_deals_options['yh_consumer_key'] ) && !empty( $wps_deals_options['yh_consumer_secrets'] ) 
				&& !empty( $wps_deals_options['yh_app_id'] ) ) {
			
				if( !class_exists( 'OAuthToken' ) ) { // loads the OAuthToken class
					require_once ( WPS_DEALS_SOCIAL_LIB_DIR . '/yahoo/OAuth/OAuth.php' ); 
				}
				// Require Yahoo! PHP5 SDK libraries
				if( !class_exists( 'YahooOAuthApplication' ) ) {
					require_once ( WPS_DEALS_SOCIAL_LIB_DIR . '/yahoo/Yahoo/YahooOAuthApplication.class.php' ); 
				}
				
				// Yahoo Object
				$this->yahoo = new YahooOAuthApplication( WPS_DEALS_YH_CONSUMER_KEY, WPS_DEALS_YH_CONSUMER_SECRET, WPS_DEALS_YH_APP_ID, WPS_DEALS_YH_REDIRECT_URL );
			
				return true;	
			
			} else {
				
				return false;
			}
			
		}
		
		/**
		 * Initializes Yahoo API
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_initialize_yahoo() {
			
			
			//check yahoo is enable,consumer key not empty,consumer secrets not empty and app id should not empty
			if ( isset( $_GET['openid_mode'] ) && $_GET['openid_mode'] == 'id_res' 
				 && isset( $_GET['wpsocialdeals'] ) && $_GET['wpsocialdeals'] == 'yahoo' ) {
				
				//load yahoo class
				$yahoo = $this->wps_deals_social_load_yahoo();
				
				//check yahoo class is loaded or not
				if( !$yahoo ) return false; 
					
			 	$request_token = new YahooOAuthRequestToken( $_GET['openid_oauth_request_token'],'' );
		    
			    // exchange request token for access token
			    $this->yahoo->token = $this->yahoo->getAccessToken( $request_token );
			
			    // store access token for later use
			    $yahoo_access_token = $this->yahoo->token->to_string();
			    
			    //check yahoo oauth access token is set or not
				 if ( !empty( $yahoo_access_token ) ) {
		        	 
				 	// if session is still present ( not expired),then restore access token from session
	        		$this->yahoo->token = YahooOAuthAccessToken::from_string( $yahoo_access_token );
	        		
	        		$user_data = $this->yahoo->getProfile();
	        		
					if( isset( $user_data->profile ) && !empty( $user_data->profile ) ) {
						//set user data to session
						$this->session->set( 'wps_deals_yahoo_user_cache', $user_data->profile );
					}
			    }
			    
			}
		}
		
		/**
		 * Get auth url for yahoo
		 *
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */	
		public function wps_deals_social_get_yahoo_auth_url () {
			
			//load yahoo class
			$yahoo = $this->wps_deals_social_load_yahoo();
			
			//check yahoo is loaded or not
			if( !$yahoo ) return false;
			
			$url = $this->yahoo->getOpenIDUrl( $this->yahoo->callback_url );
			return $url;
		}
		 
		/**
		 * Get Yahoo user's Data
		 * 
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */		
		public function wps_deals_social_get_yahoo_user_data() {
			
			$usersession 		= $this->session->get( 'wps_deals_yahoo_user_cache' );
			$user_profile_data 	= !empty( $usersession ) ? $usersession : '';
			return $user_profile_data;
			
		}
	}
	
}
?>