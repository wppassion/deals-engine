<?php

	/**
	 * Add All Social Media Settings
	 * 
	 * Handles to add social media settings
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/

	global $wps_deals_options,$wps_deals_model;
	
	$model = $wps_deals_model;

	//Add General Settings
	include_once( 'wps-deals-general-settings.php');
	
	//Add Facebook Settings
	include_once( 'wps-deals-facebook-settings.php');
	
	//Add Google+ Settings
	include_once( 'wps-deals-gplus-settings.php');

	//Add Twitter Settings
	include_once( 'wps-deals-twiiter-settings.php');

	//Add LinkedIn Settings
	include_once( 'wps-deals-linkedin-settings.php');

	//Add Yahoo Settings
	include_once( 'wps-deals-yahoo-settings.php');

	//Add Foursquare Settings
	include_once( 'wps-deals-foursquare-settings.php');
	
	//Add Windows Live Settings
	include_once( 'wps-deals-windowslive-settings.php');

?>