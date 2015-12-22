<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Linkedin Class
 * 
 * Handles all Linkedin functions
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if( !class_exists( 'Wps_Deals_Social_LinkedIn' ) ) {
	
	class Wps_Deals_Social_LinkedIn {
		
		public $linkedinconfig, $linkedin, $session;
		
		public function __construct() {
			
			global $wps_deals_session;
			
			$this->session	= $wps_deals_session;
		}
		
		/**
		 * Include LinkedIn Class
		 * 
		 * Handles to load Linkedin class
		 * 
		 * @package Social Deals Engine
	 	 * @since 1.0.0
		 */
		public function wps_deals_social_load_linkedin() {
			
			global $wps_deals_options;
			
			//linkedin declaration
			if( !empty( $wps_deals_options['enable_linkedin'] )
				&& !empty( $wps_deals_options['li_app_id'] ) && !empty( $wps_deals_options['li_app_secret'] ) ) {
				
				if( !class_exists( 'LinkedInOAuth2' ) ) {
					require_once( WPS_DEALS_SOCIAL_LIB_DIR . '/linkedin/LinkedIn.OAuth2.class.php' );
				}
				
				$call_back_url	= site_url().'/?wpsocialdeals=linkedin';
				
				//linkedin api configuration
				$this->linkedinconfig = array(
												'appKey'       => WPS_DEALS_LI_APP_ID,
												'appSecret'    => WPS_DEALS_LI_APP_SECRET,
												'callbackUrl'  => $call_back_url 
										 	);
				
				//Load linkedin outh2 class
				$this->linkedin = new LinkedInOAuth2();
				
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Linkedin Initialize
		 * 
		 * Handles LinkedIn Login Initialize
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_initialize_linkedin() {
			
			global $wps_deals_options;
			
			//check enable linkedin & linkedin application id & linkedin application secret are not empty
			if( !empty( $wps_deals_options['enable_linkedin'] ) && !empty( $wps_deals_options['li_app_id'] ) 
				&& !empty( $wps_deals_options['li_app_secret'] ) ) {
				
				//check $_GET['wpsocialdeals'] equals to linkedin
				if( isset( $_GET['wpsocialdeals'] ) && $_GET['wpsocialdeals'] == 'linkedin' ) {
					
					//load linkedin class
					$linkedin	= $this->wps_deals_social_load_linkedin();
					$config		= $this->linkedinconfig;
					
					//check linkedin loaded or not
					if( !$linkedin ) return false;
					
					//Get Access token
					$arr_access_token	= $this->linkedin->getAccessToken( $config['appKey'], $config['appSecret'], $config['callbackUrl']);
					
					// code will excute when user does connect with linked in
					if( !empty( $arr_access_token['access_token'] ) ) { // if user allows access to linkedin
						
						//Get User Profiles
						$resultdata	= $this->linkedin->getProfile();
						
						//set user data to sesssion for further use
				        $this->session->set( 'wps_deals_linkedin_user_cache', $resultdata );
				        
						// redirect the user back to the demo page
						wp_redirect( $_SERVER['PHP_SELF'] );
						exit;
						
					} else {
						
						// bad token access
						echo __( 'Access token retrieval failed', 'wpsdeals' );
					}
				}
			}
		}
		
		/**
		 * Get LinkedIn Auth URL
		 * 
		 * Handles to return linkedin auth url
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_social_linkedin_auth_url() {
			
			$scope	= array( 'r_emailaddress', 'r_basicprofile', 'rw_nus', 'r_network', 'r_contactinfo', 'r_fullprofile', 'w_messages' );
			
			//load linkedin class
			$linkedin = $this->wps_deals_social_load_linkedin();
			
			//check linkedin loaded or not
			if( !$linkedin ) return false;
			
			//Get Linkedin config
			$config	= $this->linkedinconfig;
			
			try {//Prepare login URL
				$preparedurl	= $this->linkedin->getAuthorizeUrl( $config['appKey'], $config['callbackUrl'], $scope );
			} catch( Exception $e ) {
				$preparedurl	= '';
	        }
	        
			return $preparedurl;
		}
		
		/**
		 * Get LinkedIn User Data
		 * 
		 * Function to get LinkedIn User Data
		 * 
		 * @package Social Deals Engine
		 * @since 1.0.0
		 */
		public function wps_deals_social_get_linkedin_user_data() {
			
			$usersession 		= $this->session->get( 'wps_deals_linkedin_user_cache' );
			$user_profile_data 	= !empty( $usersession ) ? $usersession : '';
			return $user_profile_data;
		}
	}
}
?>