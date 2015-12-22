<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * WPS Deals Tools Page
 *
 * Handle to Display tools page
 *
 * @package Social Deals Engine
 * @since 2.2.6
 */

			

 ?>
<div class="wrap">

	<?php
		global $wpdb, $wps_deals_message; // call globals to use them in this page
				
	?>
	<!-- wpsocial logo -->
	<img src="<?php echo WPS_DEALS_URL . 'includes/images/wps-logo.png'; ?>" class="wpsocial-logo" alt="WPSocial.com Logo" />
	
	<!-- plugin name -->
	<h2 class="wps-deals-settings-title"><?php _e( 'Social Deals Engine - Tools', 'wpsdeals' ); ?></h2><br />

	<!-- settings reset -->
	
	<?php
	
		  // By default tab
		  $selected_tab = 'system-info';
	
		//message for selected tab & print message
		$message= $wps_deals_message;

		if(!isset($message))
			$message->add_session( 'wps-deals-selected-tab', strtolower( 'system-info' ) );
	
			
		if( isset($message) && $message->size( 'wps-deals-selected-tab' ) >= 1 ) { //make tab selected 
				$selected_tab = $message->messages[1]['text'];
			
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'The settings have been Imported.', 'wpsdeals') . '</strong></p></div>'; 
		
		}
		
		switch( $selected_tab ) {
				
			case 'system-info' : 
				$system_info_tab = ' nav-tab-active';
				$system_info_content = ' wps-deals-selected-tab';
			break;
			
			case 'import-export' : 
				$import_export_info_tab = ' nav-tab-active';
				$import_export_info_content = ' wps-deals-selected-tab';
			break;
			
		}
	?>
	
	<!-- beginning of the left meta box section -->
		<div class="content wps-deals-content-section">
		
			<h2 class="nav-tab-wrapper wps-deals-h2">
				<?php 
			
				do_action('wps_deals_add_tools_tab_before',$selected_tab); ?>
		        <a class="nav-tab<?php if(isset($system_info_tab)) echo $system_info_tab;  ?>" href="#wps-deals-tab-system-info"><?php _e('System Info','wpsdeals');?></a>
		         <a class="nav-tab<?php if(isset($import_export_info_tab)){ echo $import_export_info_tab; } ?>"  href="#wps-deals-tab-import-export"><?php _e('Import/Export','wpsdeals');?></a>
		       
		        <?php do_action('wps_deals_add_tools_tab_after',$selected_tab); ?>
		    </h2><!--nav-tab-wrapper-->
		    
		    <!--beginning of tabs panels-->
			 <div class="wps-deals-content">
			 	<?php do_action('wps_deals_add_tools_tab_data_before',$selected_tab); ?>

			 		<div class="wps-deals-tab-content<?php  if(isset($system_info_content)) echo $system_info_content; ?>" id="wps-deals-tab-system-info"> 
					<?php   
				 		// System Info
				 		require_once( WPS_DEALS_ADMIN . '/forms/wps-deals-system-info.php' ); 
					?>
					</div>
					<div class="wps-deals-tab-content<?php if(isset($import_export_info_content)) echo $import_export_info_content; ?>" id="wps-deals-tab-import-export"> 
					<?php   
				 		// Import / Export	
				 		require_once( WPS_DEALS_ADMIN . '/forms/wps-deals-import-export.php' ); 
					?>
					</div>
			 <?php do_action('wps_deals_add_tools_tab_data_after',$selected_tab); ?>
			 <!--end of tabs panels-->
			 </div>
		<!--end of the left meta box section -->
		</div><!--.content wps-deals-content-section-->
	
<!--end .wrap-->
</div>