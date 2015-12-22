<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Twitter Class
 *
 * Handles all twitter functions 
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
if( !class_exists( 'Wps_Deals_Social_Twitter' ) ) {
	
	class Wps_Deals_Social_Twitter {
		
		var $twitter, $session;
		
		public function __construct(){
			
			global $wps_deals_session;
			
			$this->session	= $wps_deals_session;
		}
		
		/**
		 * Include Twitter Class
		 * 
		 * Handles to load twitter class
		 * 
		 * @package Social Deals Engine
	 	 * @since 1.0.0
		 */
		public function wps_deals_social_load_twitter() {
			
			global $wps_deals_options;
			
			//twitter declaration
			if( !empty( $wps_deals_options['enable_twitter'] ) 
				&& !empty( $wps_deals_options['tw_consumer_key'] ) && !empty( $wps_deals_options['tw_consumer_secrets'] ) ) {
			
				if( !class_exists( 'TwitterOAuth' ) ) { // loads the Twitter class
					require_once ( WPS_DEALS_SOCIAL_LIB_DIR . '/twitter/twitteroauth.php' ); 
				}
				
				// Twitter Object
				$this->twitter = new TwitterOAuth( WPS_DEALS_TW_CONSUMER_KEY, WPS_DEALS_TW_CONSUMER_SECRET );
				
				return true;
				
			} else {
	 		
				return false;
			}	
			
		}
		
		/**
		 * Initializes Twitter API
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		function wps_deals_initialize_twitter() {
			
			//get oauthtoken value for twitter
			$oauthtoken = $this->session->get( 'wps_deals_twt_oauth_token' );
			
			//when user is going to logged in in twitter and verified successfully session will create
			if ( isset( $_REQUEST['oauth_verifier'] ) && isset( $oauthtoken )  
				&& isset( $_REQUEST['oauth_token'] ) && ( $oauthtoken ==  $_REQUEST['oauth_token'] ) ) {
			
				
				//load twitter class
				$twitter = $this->wps_deals_social_load_twitter();
			
				//check twitter class is loaded or not
				if( !$twitter ) return false;
					
				$this->twitter = new TwitterOAuth( WPS_DEALS_TW_CONSUMER_KEY, WPS_DEALS_TW_CONSUMER_SECRET, $this->session->get( 'wps_deals_twt_oauth_token' ), $this->session->get( 'wps_deals_twt_oauth_token_secret' ) );
				
				// Request access tokens from twitter
				$wps_deals_tw_access_token = $this->twitter->getAccessToken($_REQUEST['oauth_verifier']);
				
				//session create for access token & secrets		
				$this->session->set( 'wps_deals_twt_oauth_token', $wps_deals_tw_access_token['oauth_token'] );
				$this->session->set( 'wps_deals_twt_oauth_token_secret', $wps_deals_tw_access_token['oauth_token_secret'] );
				
				//session for verifier
				$usercache = array();
				$usercache['verifier'] = $_REQUEST['oauth_verifier'];
				$this->session->set( 'wps_deals_twt_user_cache', $usercache );
				
				//getting user data from twitter
				$response = $this->twitter->get( 'account/verify_credentials' );
				
				//if user data get successfully
				if ( $response->id_str ) {
					//all data will assign to a session
					$userdata = $this->session->get( 'wps_deals_twt_user_cache' );
					$userdata['user'] = $response;
					//set user data to session
					$this->session->set( 'wps_deals_twt_user_cache', $userdata );
				}
			}
		}
		
		/**
		 * Get auth url for twitter
		 *
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */	
		public function wps_deals_social_get_twitter_auth_url () {
			
			// Save temporary credentials to session.
			// Get temporary credentials.
			global $post;
			
			//load twitter class
			$twitter = $this->wps_deals_social_load_twitter();
			
			//check twitter class is loaded or not
			if( !$twitter ) return false;
			
			$request_token = $this->twitter->getRequestToken( wps_deals_get_current_page_url() ); // get_permalink( $post->ID )
		
			// If last connection failed don't display authorization link. 
			switch( $this->twitter->http_code ) { //
				
			  case 200:
				    	// Build authorize URL and redirect user to Twitter. 
				    	// Save temporary credentials to session.
				    	$this->session->set( 'wps_deals_twt_oauth_token', $request_token['oauth_token'] );
				    	$this->session->set( 'wps_deals_twt_oauth_token_secret', $request_token['oauth_token_secret'] );
				    	
				    	$token = $request_token['oauth_token'];
						$url = $this->twitter->getAuthorizeURL( $token );
						
				    	break;
			  default:
					    // Show notification if something went wrong.
					    $url = '';
			}		
			return $url;
		}	
		
		/**
		 * Get Twitter user's Data
		 * 
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */		
		public function wps_deals_social_get_twitter_user_data() {
		
			$usersession 		= $this->session->get( 'wps_deals_twt_user_cache' );
			$user_profile_data 	= !empty( $usersession['user'] ) ? $usersession['user'] : '';
			return $user_profile_data;
			
		}
	}
	
}
?>