<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Social File
 * 
 * Handles load all social related files
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

global $wps_deals_social_model,$wps_deals_social_facebook,
	$wps_deals_social_twitter,$wps_deals_social_google,
	$wps_deals_social_linkedin,$wps_deals_social_foursquare,
	$wps_deals_social_yahoo,$wps_deals_social_windowslive,
	$wps_deals_social_public;

//Social Model Class for handling all social media functionality
require_once( WPS_DEALS_SOCIAL_DIR .'/class-wps-deal-social-model.php');
$wps_deals_social_model = new Wps_Deals_Social_Model();

//Social Media Facebook Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/facebook.php');
$wps_deals_social_facebook = new Wps_Deals_Social_Facebook();

//Social Media Twitter Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/twitter.php');
$wps_deals_social_twitter = new Wps_Deals_Social_Twitter();

//Social Media Google Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/google.php');
$wps_deals_social_google = new Wps_Deals_Social_Google();

//Social Media Linkedin Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/linkedin.php');
$wps_deals_social_linkedin = new Wps_Deals_Social_LinkedIn();

//Social Media Yahoo Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/yahoo.php');
$wps_deals_social_yahoo = new Wps_Deals_Social_Yahoo();

//Social Media Foursquare Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/foursquare.php');
$wps_deals_social_foursquare = new Wps_Deals_Social_Foursquare();

//Social Media Windows Live Class for social login
require_once( WPS_DEALS_SOCIAL_LIB_DIR .'/windowslive.php');
$wps_deals_social_windowslive = new Wps_Deals_Social_Windows_Live();

//Social Class for handling all social functionalities
require_once( WPS_DEALS_SOCIAL_DIR .'/class-wps-deals-social-public.php');
$wps_deals_social_public = new Wps_Deals_Social_Public();
$wps_deals_social_public->add_hooks();