<?php

/**
 * Orederd Deals Listing Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/orders/orders-listing/orders-listing.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

global $wps_deals_model, $wps_deals_options;

//model class
$model = $wps_deals_model;

?>
<div style="position:relative">
<table class="deals-ordered-table">
	<thead>
		<tr class="deals-ordered-row-head">
			<?php 
				/**
				 * wps_deals_orders_header_before hook
				 */
				do_action( 'wps_deals_orders_header_before' );
			?>
		
			<th><?php _e('Order ID','wpsdeals');?></th>
			<th><?php _e('Order Date','wpsdeals');?></th>
			<th><?php _e('Status','wpsdeals');?></th>
			<th><?php _e('Order Amount','wpsdeals');?></th>
			<th><?php _e('Details','wpsdeals');?></th>
			
			<?php 
				/**
				 * wps_deals_orders_header_after hook
				 */
				do_action( 'wps_deals_orders_header_after' );
			?>
		</tr>
	</thead>
	
	<tbody>
	<?php
		foreach ( $ordereddeals as $order ) {
			
			$details = $model->wps_deals_get_post_meta_ordered( $order['ID'] );
			$payment_status = $model->wps_deals_get_ordered_payment_status($order['ID']);
			$userdetails = $model->wps_deals_get_ordered_user_details($order['ID']);
			$orderddate = $model->wps_deals_get_date_format($order['post_date']);
			$ipndata = $model->wps_deals_get_ipn_data($order['ID']);
			$ordertotal = $details['display_order_total'];
	?>			
		<tr class="deals-ordered-row-body">
			<?php 
				/**
				 * wps_deals_orders_row_before hook
				 */
				do_action( 'wps_deals_orders_row_before', $order['ID'] ); 
			?>
			
			<td><?php echo $order['ID'];?></td>
			<td><?php echo $orderddate;?></td>
			<td><?php echo $payment_status;?></td>
			<td><?php echo $ordertotal;?></td>
			
			<?php
				//order view page url
				$order_query = wps_deals_checkout_thank_you_url();				
				$order_query = add_query_arg( array('order_id' => $order['ID'] ), $order_query );
			?>
			
			<td><a href="<?php echo $order_query; ?>" title="<?php _e('View Details','wpsdeals');?>"><?php _e('View Details','wpsdeals');?></a></td>
			
			<?php 
				/**
				 * wps_deals_orders_row_after hook
				 */
				do_action( 'wps_deals_orders_row_after', $order['ID'] ); 
			?>
		</tr>
<?php	} ?>
	</tbody>
	
	<tfoot>
		<tr class="deals-ordered-row-foot">
			<?php 
				/**
				 * wps_deals_orders_footer_before hook
				 */
				do_action('wps_deals_orders_footer_before');
			?>
			
			<th><?php _e('Order ID','wpsdeals');?></th>
			<th><?php _e('Order Date','wpsdeals');?></th>
			<th><?php _e('Status','wpsdeals');?></th>
			<th><?php _e('Order Amount','wpsdeals');?></th>
			<th><?php _e('Details','wpsdeals');?></th>
			
			<?php 
				/**
				 * wps_deals_orders_footer_after hook
				 */
				do_action('wps_deals_orders_footer_after');
			?>
		</tr>
	</tfoot>
	
</table>

	<div class="deals-sales-loader" >
		<img src="<?php echo WPS_DEALS_URL;?>includes/images/cart-loader.gif">
	</div>	
</div>
<div class="deals-clearfix">&nbsp;</div>
<nav class="deals-pagination pagination-centered deals-col-12" role="navigation">
	<?php echo $paging->getOutput(); ?>	
</nav>
