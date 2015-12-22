<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Windows Live Class
 * 
 * Handles all windows live functions
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if( !class_exists( 'Wps_Deals_Social_Windows_Live' ) ) {
	
	class Wps_Deals_Social_Windows_Live {
		
		public $session;
		
		public function __construct() {
			
			global $wps_deals_session;
			
			$this->session	= $wps_deals_session;
		}
		
		/**
		 * Initialize Some User Data
		 * 
		 * Handles to initialize some
		 * data for windowslive
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_initialize_windowslive() {
			
			global $wps_deals_options;
			
			//check windows live client id and secret are not empty
			if( !empty( $wps_deals_options['wl_client_id'] ) && !empty( $wps_deals_options['wl_client_secrets'] ) ) {
				
				//check $_GET['code'] is set and not empty and
				//$_GET['wpsocialdeals'] is set and equals to windowslive
				if( isset( $_GET['code'] ) && !empty( $_GET['code'] )
					&& isset( $_GET['wpsocialdeals'] ) && $_GET['wpsocialdeals'] == 'windowslive' ) {
					
					$access_token_url = 'https://login.live.com/oauth20_token.srf';
		    		
					$postdata = 'code='.$_REQUEST['code'].'&client_id='.WPS_DEALS_WL_CLIENT_ID.'&client_secret='.WPS_DEALS_WL_CLIENT_SECRET.
								'&redirect_uri='.WPS_DEALS_WL_REDIRECT_URL.'&grant_type=authorization_code';
					
					$data = $this->wps_deals_social_get_data_from_url( $access_token_url , $postdata, true );
					
					if( !empty( $data->access_token ) ) {//If access tocken not found
						
						// Set the session access token
						$this->session->set( 'wps_deals_windowslive_access_token', $data->access_token );
						
						$accessurl = 'https://apis.live.net/v5.0/me?access_token=' . $data->access_token;
						
						//get user data from access token
						$userdata = $this->wps_deals_social_get_data_from_url( $accessurl );
						
						// Set the session access token
						$this->session->set( 'wps_deals_windowslive_user_cache', $userdata );
					}
				}
			}
		}
		
		/**
		 * Get auth url for windows live
		 * 
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_social_get_windowslive_auth_url () {
			
			$wlauthurl = add_query_arg( array(
												'client_id'		=>	WPS_DEALS_WL_CLIENT_ID,
												'scope'			=>	'wl.basic+wl.emails',
												'response_type'	=>	'code',
												'redirect_uri'	=>	WPS_DEALS_WL_REDIRECT_URL
											),
										'https://login.live.com/oauth20_authorize.srf' );
			return $wlauthurl;
		}
		
		/**
		 * Get Data From URL
		 * 
		 * Handels to return data from url
		 * via calling CURL
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_social_get_data_from_url( $url, $data = array(), $post = false ) {
			
			$ch = curl_init();
			
			// Set the cURL URL
			curl_setopt($ch, CURLOPT_URL, $url );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			
			//IF NEED TO POST SOME FIELD && $data SHOULD NOT BE EMPTY
			if( $post == TRUE && !empty( $data ) ) {
				
				curl_setopt( $ch, CURLOPT_POST, TRUE );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
				
			}
			
			$data = curl_exec($ch);
			
			// Close the cURL connection
			curl_close($ch);
			
			// Decode the JSON request and remove the access token from it
			$data = json_decode( $data );
			
			return $data;
		}
		
		/**
		 * Get User Data
		 * 
		 * Handles to return user windows live
		 * account details
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_social_get_windowslive_user_data() {
			
			$usersession 		= $this->session->get( 'wps_deals_windowslive_user_cache' );
			$user_profile_data 	= !empty( $usersession ) ? $usersession : '';
			return $user_profile_data;
		}
	}
}
?>