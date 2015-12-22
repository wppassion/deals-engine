<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Deal Reports List Page
 *
 * The html markup for the product list
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

?>

<div class="wrap">
    
    <!-- wpsocial logo -->
	<img src="<?php echo WPS_DEALS_URL . 'includes/images/wps-logo.png'; ?>" class="wpsocial-logo deals-sales-logo" alt="<?php _e('WPSocial.com Logo','wpsdeals');?>" />
	
    <h2 class="wps-deals-settings-title">
    	<?php echo apply_filters( 'wps_deals_reports_title', __( 'Social Deals Engine - Reports', 'wpsdeals' ) ); ?>
    </h2>
    
		<?php 
		
			$deals_selected = '';
			$earnings_selected = '';
			$customer_selected = '';
			$logs_selected = '';
			
			$activetab = isset($_GET['tab']) ? $_GET['tab'] : 'deals';
			
			if($activetab == 'deals') { //sales tab is selected
				$deals_selected = 'wps-deals-nav-tab-active';
			} else if($activetab == 'earnings') { //earnings tab is created
				$earnings_selected = 'wps-deals-nav-tab-active';
			} else if($activetab == 'customers') { //customers tab is created
				$customer_selected = 'wps-deals-nav-tab-active';
			} else if ($activetab == 'logs') {
				$logs_selected = 'wps-deals-nav-tab-active';
			}
			
			$dealsurl = add_query_arg(array( 'post_type' => WPS_DEALS_POST_TYPE, 'page' => 'wps-deals-reports','tab' => 'deals'), admin_url('edit.php'));
			$earningurl = add_query_arg(array( 'post_type' => WPS_DEALS_POST_TYPE, 'page' => 'wps-deals-reports','tab' => 'earnings'), admin_url('edit.php'));
			$customerurl = add_query_arg(array( 'post_type' => WPS_DEALS_POST_TYPE, 'page' => 'wps-deals-reports','tab' => 'customers'), admin_url('edit.php'));
			$logsurl = add_query_arg(array( 'post_type' => WPS_DEALS_POST_TYPE, 'page' => 'wps-deals-reports', 'tab' => 'logs'), admin_url('edit.php'));
			
			
		?>
		
	<!-- beginning of the section -->
	<div class="content wps-deals-content-section wps-deals-reports-content">
	
		<h2 class="wps-deals-nav-tab-wrapper wps-deals-reports-h2">
			<?php 
					//do action to add tab before all tabs
					do_action('wps_deals_reports_add_tab_before');
			?>
	        
			<a class="wps-deals-nav-tab <?php echo $deals_selected;?>" href="<?php echo $dealsurl;?>"><?php _e('Deals','wpsdeals');?></a>
	        <a class="wps-deals-nav-tab <?php echo $earnings_selected;?>" href="<?php echo $earningurl;?>"><?php _e('Earnings','wpsdeals');?></a>
	        <a class="wps-deals-nav-tab <?php echo $customer_selected;?>" href="<?php echo $customerurl;?>"><?php _e('Customers','wpsdeals');?></a>
	        <a class="wps-deals-nav-tab <?php echo $logs_selected;?>" href="<?php echo $logsurl;?>"><?php _e('Logs','wpsdeals');?></a>
	        	        
	        <?php 
	        		//do action to add tab before all tabs
	        		do_action('wps_deals_reports_add_tab_after');
	        ?>
	    </h2><!--nav-tab-wrapper-->
	    
	    <!--beginning of tabs panels-->
		 <div class="wps-deals-content">
		 	<?php 
		 			//do action to add tab data before all tab data
		 			do_action( 'wps_deals_reports_add_tab_data_before');
		 			
		 			//do action to add tab data
		 			echo '<div class="wps-deals-tab-content" id="'.$activetab.'">';
		 				do_action( 'wps_deals_report_view_'.$activetab);
		 			echo '</div>';
		 			
		 			//do action to add tab data after all tab data
		 			do_action('wps_deals_reports_add_tab_data_after');
		 	?>
		 <!--end of tabs panels-->
		 </div>	
	</div><!--.content wps-deals-content-section-->
	<!--end of the section -->
</div>