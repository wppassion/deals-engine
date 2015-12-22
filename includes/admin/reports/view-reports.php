<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * View Reports Data
 *
 * Handlse to view all reports tab data
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

/**
 * View Sales Reports
 * 
 * Handles to view sales reports data
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_view_report_deals() {

	include( WPS_DEALS_ADMIN . '/reports/wps-deals-reports-list.php' );
}

add_action( 'wps_deals_report_view_deals','wps_deals_view_report_deals' );

/**
 * View Customers Reports
 * 
 * Handles to view customers reports data
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_view_report_customers() {

	include( WPS_DEALS_ADMIN . '/reports/wps-deals-reports-customers-list.php' );
}

add_action( 'wps_deals_report_view_customers','wps_deals_view_report_customers' );

/**
 * View Earnings Reports
 * 
 * Handles to view earnings reports data
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_view_report_earnings() {

	//include earning graph file
	include( WPS_DEALS_ADMIN . '/reports/wps-deals-reports-earnings.php' );
	wps_deals_reports_graph();
}

add_action( 'wps_deals_report_view_earnings','wps_deals_view_report_earnings' );

/**
 * View Logs Reports
 * 
 * Handles to view logs data
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_view_logs(){
	
	//include logs file
	include( WPS_DEALS_ADMIN . '/logs/wps-deals-logs.php' );
	
	$current_view = 'downloads';
	$log_views    = wps_deals_log_default_views();

	if ( isset( $_GET[ 'view' ] ) && array_key_exists( $_GET[ 'view' ], $log_views ) )
		$current_view = $_GET[ 'view' ];
	
	do_action( 'wps_deals_logs_view_' . $current_view );
	
}
add_action( 'wps_deals_report_view_logs','wps_deals_view_logs' );

?>