<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Export Deals Report Data
 *
 * Handles to export deals report data to csv
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_report_to_csv() {
	
	global $wps_deals_model,$wps_deals_currency;
	
	//model class 
	$model = $wps_deals_model;
	
	//currency class
	$currency = $wps_deals_currency;
	
	//export deals report to CSV file
	if(isset($_POST['wps-deals-report-exports']) && !empty($_POST['wps-deals-report-exports'])) { //check post is set or not

		$exports = '';
		
		//get deals sale data from database
		$data = $model->wps_deals_get_data();
		
		$columns = apply_filters('wps_deals_exports_sales_report_columns',
					array(	__( 'Deals', 'wpsdeals' ),
					     	__(	'Sales', 'wpsdeals' ),
					        __(	'Earnings', 'wpsdeals' ),
					        __(	'Monthly Average Sales', 'wpsdeals' ),
					        __(	'Monthly Average Earnings', 'wpsdeals' ),
					     ));
				
        // Put the name of all fields
		foreach ($columns as $column) {
			
			$exports .= '"'.$column.'",';
			
		}
		$exports .="\n";
		
		foreach ($data as $key => $value){
			
			//this line should be on start of loop
			$data[$key]	= apply_filters('wps_deals_export_sales_report_column_data',$value,$value['ID']);
			
			$sales_data = $model->wps_deals_get_post_sale_count_earning($value['ID']);
			$monthly_sales_data = $model->wps_deals_get_monthly_sales_earning($value['ID']);
			
			$exports .= '"'.$value['post_title'].'",';
			$exports .= '"'.$sales_data['salescount'].'",';
			$exports .= '"'.html_entity_decode($currency->wps_deals_formatted_value($sales_data['earnings'])).'",';
			$exports .= '"'.number_format( $monthly_sales_data['salescount'], 2 ).'",';
			$exports .= '"'.html_entity_decode($currency->wps_deals_formatted_value($monthly_sales_data['earnings'])).'",';
			
			$exports .="\n";
			
		}
		
		// Output to browser with appropriate mime type, you choose ;)
		header("Content-type: text/x-csv");
		header("Content-Disposition: attachment; filename=wps-deals-sales-report-".wps_deals_current_date('d-m-Y').".csv");
		echo $exports;
		exit;
		
	}
	
	//export customer report to CSV file
	if(isset($_POST['wps-deals-customer-report-exports']) && !empty($_POST['wps-deals-customer-report-exports'])) { //check post is set or not
		
		$exports = '';
		
		//get deals sale data from database
		$data = $model->wps_deals_get_customers();
		
		$columns = apply_filters('wps_deals_exports_customers_columns',
					array(	__( 'Name', 'wpsdeals' ),
					     	__(	'Email', 'wpsdeals' ),
					        __(	'Purchases', 'wpsdeals' ),
					        __(	'Total Spent', 'wpsdeals' ),
					     ));
				
        // Put the name of all fields
		foreach ($columns as $column) {
			
			$exports .= '"'.$column.'",';
			
			
		}
		$exports .="\n";
		
		foreach ($data as $key => $value){
			
			$value_id = isset( $value['ID'] ) ? $value['ID'] : '';
			//this line should be on start of loop
			$data[$key]	= apply_filters('wps_deals_exports_customers_report_column_data',$value, $value_id );
			
			$wp_user = get_user_by( 'email', $value );
			
			$item = array();
			if($wp_user) {
				$user_id = $wp_user->ID;
				$item['user_id'] = $user_id;
				$item['user_name'] = $wp_user->display_name;
			} else {
				$user_id = 0;
				$item['useremail'] = $value;
			}
			
			$purchases_args = array( 'useremail' => $value, 'getcount' => '1' );
			$purchases_amount_data = $model->wps_deals_purchase_total_of_user($value);
			
			
			$exports .= '"'.( $wp_user ? $wp_user->display_name : __( 'guest', 'wpsdeals' ) ).'",';
			$exports .= '"'.$value.'",';
			$exports .= '"'.html_entity_decode($purchases_amount_data['salescount']).'",';
			$exports .= '"'.html_entity_decode($currency->wps_deals_formatted_value($purchases_amount_data['earnings'])).'",';
			
			$exports .="\n";
		}
		
		// Output to browser with appropriate mime type, you choose ;)
		header("Content-type: text/x-csv");
		header("Content-Disposition: attachment; filename=wps-deals-customers-report-".wps_deals_current_date('d-m-Y').".csv");
		echo $exports;
		exit;
		
	}
	
	
}
add_action('init','wps_deals_report_to_csv');
?>