<?php
/**
 * Logs Functions
 *
 * @package     Social Deals Engine
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Downloads Logs
 *
 * @package     Social Deals Engine
 * @since       1.0.0
 */
function wps_deals_logs_view_downloads() {
	
	include( WPS_DEALS_ADMIN . '/logs/class-wps-deals-downloads-logs-list.php' );
}
add_action( 'wps_deals_logs_view_downloads', 'wps_deals_logs_view_downloads' );

/**
 * Sales Logs
 *
 * @package     Social Deals Engine
 * @since       1.0.0
 */
function wps_deals_logs_view_sales() {
	
	include( WPS_DEALS_ADMIN . '/logs/class-wps-deals-sales-logs-list.php' );
}
add_action( 'wps_deals_logs_view_sales', 'wps_deals_logs_view_sales' );
?>