<?php 

/**
 * Recent Orders Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/recent-orders.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options;

?>

<div class="deals-recent-orders deals-clearfix">

	<h3><?php _e( 'Recent Orders', 'wpsdeals' );?> (<a href="<?php echo $vieworderspagelink; ?>"><?php _e( 'View all Orders', 'wpsdeals' ); ?></a>)</h3>
	
	<table id="deals-my-account-recent-orders" class="deals-orders-table">
		<thead>
				<tr class="deals-orders-row-head">
					<?php 
						/**
						 * wps_deals_my_account_recent_header_foot_before hook
						 */
						do_action( 'wps_deals_my_account_recent_header_foot_before' );
					?>
					<th><?php _e( 'Order ID', 'wpsdeals' );?></th>
					<th><?php _e( 'Date', 'wpsdeals' );?></th>
					<th><?php _e( 'Status', 'wpsdeals' );?></th>
					<th><?php _e( 'Total', 'wpsdeals' );?></th>
					<th><?php _e( 'Details', 'wpsdeals' );?></th>
					<?php 
						/**
						 * wps_deals_my_account_recent_header_foot_after hook
						 */
						do_action( 'wps_deals_my_account_recent_header_foot_after' );
					?>
				</tr>
		</thead>
		<tbody>
		<?php
			foreach ( $orderdata as $key => $order ) {
				
				//order view page url				
				$order_query = wps_deals_checkout_thank_you_url();
				$order_query = add_query_arg( array('order_id' => $order['order_id'] ), $order_query );
				
				//counter label for purchased deals
				$countlabel = $order['deal_count'] > 1 ? 'deals' : 'deal';
			
		?>
				<tr class="deals-orders-row-body">
					<?php 
						/**
						 * wps_deals_my_account_recent_details_before hook
						 */
						do_action( 'wps_deals_my_account_recent_details_before', $order['order_id'] );
					?>
					<td><?php echo $order['order_id']?></td>
					<td><?php echo $order['order_date'];?></td>
					<td><?php echo $order['payment_status'];?></td>
					<td><?php printf( __( '%s for %s %s', 'wpsdeals' ), $order['order_total'], $order['deal_count'], $countlabel );?></td>
					<?php
						/**
						 * wps_deals_my_account_recent_details_total_after hook
						 */
						do_action( 'wps_deals_my_account_recent_details_total_after', $order['order_id'] );
					?>
					<td><a href="<?php echo $order_query;?>"><?php _e( 'View Details', 'wpsdeals');?></a></td>
					<?php
						/**
						 * wps_deals_my_account_recent_details_after hook
						 */
						do_action( 'wps_deals_my_account_recent_details_after', $order['order_id'] );
					?>
				</tr>
		<?php		
			}
		?>
		</tbody>
		<tfoot>
				<tr class="deals-orders-row-foot">
					<?php 
						/**
						 * wps_deals_my_account_recent_header_foot_before hook
						 */
						do_action( 'wps_deals_my_account_recent_header_foot_before' );
					?>
					<th><?php _e( 'Order ID', 'wpsdeals' );?></th>
					<th><?php _e( 'Date', 'wpsdeals' );?></th>
					<th><?php _e( 'Status', 'wpsdeals' );?></th>
					<th><?php _e( 'Total', 'wpsdeals' );?></th>
					<th><?php _e( 'Details', 'wpsdeals' );?></th>
					<?php 
						/**
						 * wps_deals_my_account_recent_header_foot_after hook
						 */
						do_action( 'wps_deals_my_account_recent_header_foot_after' );
					?>
				</tr>
		</tfoot>
	</table>
</div>
