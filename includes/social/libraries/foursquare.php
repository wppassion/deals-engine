<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Foursquare Class
 *
 * Handles all Foursquare functions 
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
if( !class_exists( 'Wps_Deals_Social_Foursquare' ) ) {
	
	class Wps_Deals_Social_Foursquare{

		var $foursquare, $session;
		
		public function __construct(){
			
			global $wps_deals_session;
			$this->session = $wps_deals_session;
		}
		/**
		 * Load Foursquare Class
		 * 
		 * Handles to load foursquare social api class
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_social_load_foursquare() {
			
			global $wps_deals_options;
			
			//foursquare declaration
			if( !empty( $wps_deals_options['enable_foursquare'] ) 
				&& !empty( $wps_deals_options['fs_client_id'] ) && !empty( $wps_deals_options['fs_client_secrets'] ) ) {
			
				if( !class_exists( 'socialmedia_oauth_connect' ) ) {
					require_once ( WPS_DEALS_SOCIAL_LIB_DIR . '/foursquare/socialmedia_oauth_connect.php' );
				}
				
				// Foursquare Object
				$this->foursquare 				 = new socialmedia_oauth_connect();
				$this->foursquare->provider		 = "Foursquare";
				$this->foursquare->client_id 	 = WPS_DEALS_FS_CLIENT_ID;
				$this->foursquare->client_secret = WPS_DEALS_FS_CLIENT_SECRET;
				$this->foursquare->scope		 = "";
				$this->foursquare->redirect_uri	 = WPS_DEALS_FS_REDIRECT_URL;
				$this->foursquare->Initialize();
				
				return true;
				
			} else {
				
				return false;
			}
			
		}
		/**
		 * Initializes Foursquare API
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		function wps_deals_initialize_foursquare() {
			
			//check code is set and wpsocial is set and it is foursuqare then execute code
			if ( isset( $_GET['code'] ) && !empty($_GET['code'] ) 
				&& isset( $_GET['wpsocialdeals'] ) && $_GET['wpsocialdeals'] == 'foursquare' ) {
			
				//load foursquare class	
			    $foursquare = $this->wps_deals_social_load_foursquare();
			
				//check foursquare class is loaded or not
				if( !$foursquare ) return false;
					
				$this->foursquare->code = $_GET['code'];
				$user_profile_data = json_decode( $this->foursquare->getUserProfile() );
				
				if( isset( $user_profile_data->response ) && isset( $user_profile_data->response->user ) 
					&& !empty( $user_profile_data->response->user ) ) {
				
					//set user cache data to session
					$this->session->set( 'wps_deals_foursquare_user_cache', $user_profile_data->response->user );
				}
			}
		}
		/**
		 * Get auth url for foursquare
		 *
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */	
		public function wps_deals_social_get_foursquare_auth_url () {
			
			//load foursquare class
			$foursquare = $this->wps_deals_social_load_foursquare();
			
			$url = '';
			
			//check foursquare class is loaded or not
			if( !$foursquare ) return false;
			
				$url = $this->foursquare->Authorize();
				
			return $url;
		}	
		
		/**
		 * Get Foursquare user's Data
		 * 
		 * @param Social Deals Engine
		 * @since 1.0.0
		 */		
		public function wps_deals_social_get_foursquare_user_data() {
		
			$usersession 		= $this->session->get( 'wps_deals_foursquare_user_cache' );
			$user_profile_data 	= !empty( $usersession ) ? $usersession : '';
			return $user_profile_data;
		}
	}
}
?>