<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Dashboard Widgets
 * 
 * Register the dashboard widgets
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_register_dashboard_sales_widgets() {
	
	if(current_user_can('manage_options')) { //if user is admin user then only show dashboard widget	
		wp_add_dashboard_widget( 'wps_deals_sales_dashboard_widget', __('Social Deals Sales Summary', 'wpsdeals'), 'wps_deals_sales_summary_widget' );
	}
}
add_action('wp_dashboard_setup', 'wps_deals_register_dashboard_sales_widgets' );


function wps_deals_sales_summary_widget() {
	
	global $wps_deals_model,$wps_deals_currency,$wps_deals_render;
	
	//Model class
	$model = $wps_deals_model;
	
	//Currency Class
	$currency = $wps_deals_currency;
	
	//Render Class
	$render = $wps_deals_render;
	
	//total sales and earnings
	$totalsales = $model->wps_deals_get_dashboard_sale_count_earning();
	
	//current month sales and earnings
	$currentmonth = $model->wps_deals_get_sale_count_earning_by_date('', wps_deals_current_date( 'n' ), wps_deals_current_date( 'Y' ) );
	
	$previous_month   = wps_deals_current_date( 'n' ) == 1 ? 12 : wps_deals_current_date( 'n' ) - 1;
	$previous_year    = $previous_month == 12 ? wps_deals_current_date( 'Y' ) - 1 : wps_deals_current_date( 'Y' );
	
	//last month sales and earnings
	$lastmonth = $model->wps_deals_get_sale_count_earning_by_date('', $previous_month, $previous_year );
	
	//recent purchases
	$recentpurchases = $model->wps_deals_get_recent_purchases();
	
	wp_enqueue_script( 'wps-deals-popup-scripts' );
	wp_enqueue_style( 'wps-deals-sales-styles' );
	
	?>
	
	<div class="wps-deals-dashboard-widget-wrap">
	
		<div class="wps-deals-dashboard-full">
		
			<div class="wps-deals-dashboard-left-first">
				<p class="widget-title">
					<?php _e('Current Month','wpsdeals');?>
				</p>
					<table>
						<tbody>
							<tr>
								<td class="widget-value"><?php echo $currency->wps_deals_formatted_value($currentmonth['earnings']);?></td>
								<td class="widget-label"><?php _e('Earnings','wpsdeals');?></td>
							</tr>
							<tr>
								<td class="widget-value"><?php echo $currentmonth['salescount'];?></td>
								<td class="widget-label"><?php echo _n('Sale','Sales',$currentmonth['salescount'],'wpsdeals');?></td>
							</tr>
						</tbody>
					</table>
			</div><!--.wps-deals-dashboard-left-->
			
			<div class="wps-deals-dashboard-right">
				<p class="widget-title">
					<?php _e('Totals','wpsdeals');?>
				</p>
					<table>
						<tbody>
							<tr>
								<td class="widget-value"><?php echo $currency->wps_deals_formatted_value($totalsales['earnings']);?></td>
								<td class="widget-label"><?php _e('Total Earnings','wpsdeals');?></td>
							</tr>
							
							<tr>
								
								<td class="widget-value"><?php echo $totalsales['salescount'];?></td>
								<td class="widget-label"><?php _e('Total Sales','wpsdeals');?></td>
							</tr>
						</tbody>
					</table>
			</div><!--.wps-deals-dashboard-right-->
			
		</div><!--.wps-deals-dashboard-full-->
		
		<div class="wps-deals-dashboard-middle">
			<p class="widget-title">
				<?php _e('Last Month','wpsdeals');?>
			</p>
				<table>
					<tbody>
						<tr>
							<td class="widget-label"><?php _e('Earnings','wpsdeals');?></td>
							<td class="widget-value"><?php echo $currency->wps_deals_formatted_value($lastmonth['earnings']);?></td>
						</tr>
						<tr>
							<td class="widget-label"><?php echo _n('Sale','Sales',$lastmonth['salescount'],'wpsdeals');?></td>
							<td class="widget-value"><?php echo $lastmonth['salescount'];?></td>
						</tr>
					</tbody>
				</table>
		</div><!--.wps-deals-dashboard-middle-->
		<?php if(!empty($recentpurchases)) { //check recent purchases not empty ?>
		<div class="wps-deals-dashboard-middle dashboard-last">
			<p class="widget-title">
				<?php _e('Recent Purchases','wpsdeals');?>
			</p>
				<table>
					<tbody>
						<?php foreach ($recentpurchases as $key => $recent) { 
								
							$popup = $render->wps_deals_get_order_popup_details($recent);
						?>
							<tr>
								<td>
									<?php
										echo $recent['userdetails']['first_name'].' '.$recent['userdetails']['last_name'];
										echo !empty( $recent['userdetails']['user_email'] ) ? ' - ('.$recent['userdetails']['user_email'].') - ' : ' - ';
									?>
									</td>
								<td class="widget-value"><?php echo $recent['display_order_total'];?></td>
								<td><?php echo ' - '.$popup;?><a href="#wps_deal_ordered_<?php echo $key;?>" rel="wps_deal_sale_view"><?php _e('View Details','wpsdeals');?></a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
		</div><!--.wps-deals-dashboard-middle-->
		<?php } ?>
	</div><!--.wps-deals-dashboard-widget-wrap-->
	
<?php
	
}

?>