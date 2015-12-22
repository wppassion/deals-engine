<?php

/**
 * Ordered Deals Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/orders/orders.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $current_user,$wps_deals_model,$wps_deals_currency,$wps_deals_options,$wps_deals_render,$wps_deals_scripts;

?>

<div class="deals-container deals-sales deals-orders">

<?php				
	if ( is_user_logged_in() ) { //check user is logged in or not
		
		$perpage = isset($wps_deals_options['per_page']) ? $wps_deals_options['per_page'] : '10';
			
		//model class
		$model = $wps_deals_model;
			
		//currency class
		$currency = $wps_deals_currency;
			
		//render class
		$render = $wps_deals_render;
			
		// creating new array for all sold deals count
		$argscount = array(
							'author' 	=>	$current_user->ID,
							'getcount'	=>	'1'
							);
			
		//getting all sold deals count
		$datacount = $model->wps_deals_get_sales($argscount);
			
		// start paging
		$paging = new Wps_Deals_Pagination_Public();
				
		$paging->items( $datacount ); 
		$paging->limit( $perpage ); // limit entries per page
			
		if( isset( $_POST['paging'] ) ) {
			$paging->currentPage( $_POST['paging'] ); // gets and validates the current page
		}
			
		$paging->calculate(); // calculates what to show
		$paging->parameterName( 'paging' );
			
		// setting the limit to start
		$limit_start = ( $paging->page - 1 ) * $paging->limit;
			
		if(isset($_POST['paging'])) { 
				
			//ajax call pagination
			$argsdata = array(
								'author' 			=>	$current_user->ID,
								'posts_per_page' 	=>	$perpage,
								'paged'				=>	$_POST['paging']
							);
				
		} else {
			//on page load 
			$argsdata = array(
								'author' 			=>	$current_user->ID,
								'posts_per_page' 	=>	$perpage,
								'paged'				=>	'1'
							);
		}
	
		//filter for meta_query
		$meta_query = apply_filters( 'wps_deals_get_sales_meta_query', '' );
		$argsdata['meta_query'] = $meta_query;
		
		$ordereddeals = $model->wps_deals_get_sales($argsdata);
			
		if( !empty( $ordereddeals ) ) { //check orderdetails are not empty
				
			//do action add something before orders pagination befoer
			//do_action( 'wps_deals_orders_pagination_before', $ordereddeals );
				
			/**
			 * wps_deals_orders_table_before hook
			 */
			do_action( 'wps_deals_orders_table_before', $ordereddeals );
						
			/**
			 * wps_deals_orders_table hook
			 */
			do_action( 'wps_deals_orders_table', $ordereddeals, $paging );
		
			/**
			 * wps_deals_orders_table_after hook
			 */	
			do_action( 'wps_deals_orders_table_after', $ordereddeals );
			
		} else { //if user did not purchased any deals
	?>
				
			<p><?php _e( 'You have not purchased any deals yet.','wpsdeals' );?></p>
				
	<?php
			
		} //end else
			
	} else { //if user is not logged in
			
	?>
		<p><?php _e( 'You need to be logged in to your account to see your purchase history.', 'wpsdeals' );?></p>
			
<?php
		
	} //end else user is not logged in
?>
</div>