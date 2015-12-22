<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page
 *
 * The code for the plugins main settings page
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
 ?>
<div class="wrap">

	<?php
		global $wpdb, $wps_deals_model, $wps_deals_scripts, $wps_deals_message; // call globals to use them in this page
		
		// model class
		$model = $wps_deals_model; 
		
		// message class
		$message = $wps_deals_message;
		
	?>
	<!-- wpsocial logo -->
	<img src="<?php echo WPS_DEALS_URL . 'includes/images/wps-logo.png'; ?>" class="wpsocial-logo" alt="WPSocial.com Logo" />
	<!-- plugin name -->
	<h2 class="wps-deals-settings-title"><?php _e( 'Social Deals Engine - Settings', 'wpsdeals' ); ?></h2><br />
	<!-- settings reset -->
	<?php
	if(isset($_POST['wps_deals_reset_settings']) && $_POST['wps_deals_reset_settings'] == __( 'Reset All Settings', 'wpsdeals' )) {
		
		wps_deals_default_settings(); // set default settings
		
		//reseting facebook fan page posting setting session
		echo '<div id="message" class="updated fade"><p><strong>' . __( 'All Settings Reset Successfully.', 'wpsdeals') . '</strong></p></div>'; 
		
		//do selected tab for general
		$message->add_session( 'wps-deals-selected-tab', strtolower( 'General' ) );
		
		// Need to rewrite endpoints when settings changed
		wps_deals_rewrite_endpoints();
		
	} else if(isset($_GET['settings-updated']) && !empty($_GET['settings-updated'])) { //check settings updated or not
		
		//reseting facebook fan page posting setting session
		echo '<div id="message" class="updated fade"><p><strong>' . __( 'Changes Saved.', 'wpsdeals') . '</strong></p></div>'; 
		
		// Need to rewrite endpoints when settings changed
		wps_deals_rewrite_endpoints();
		
	} ?>
	
	<!--plugin reset settings button-->
	<form action="" method="POST" id="wps-deals-reset-settings-form">
		<div>
			<input type="submit" class="button-primary" name="wps_deals_reset_settings" id="wps_deals_reset_settings" value="<?php _e( 'Reset All Settings', 'wpsdeals' )?>" />
		</div>
	</form>	
	
	<form action="options.php" method="POST" id="wps-deals-settings-form">

	<?php
	    settings_fields( 'wps_deals_plugin_options' );
	    //$wps_deals_options = get_option('wps_deals_options');
	    global $wps_deals_options;
	    
	    $general_tab = $payments_tab = $emails_tab = $misc_tab = $customcss_tab = $social_tab = $extension_tab = '';
		$general_content = $payments_content = $emails_content = $misc_content = $customcss_content = $social_content = $extension_content = '';
		$selected_tab = 'general';
		
		if( $message->size( 'wps-deals-selected-tab' ) > 0 ) { //make tab selected 
			//$selected_tab = $message->output( 'poster-selected-tab' );
			$selected_tab = $message->messages[0]['text'];
			
		}
		
		switch( $selected_tab ) {
				
			case 'payments' : 
							$payments_tab = ' nav-tab-active';
							$payments_content = ' wps-deals-selected-tab';
							break;
			case 'emails' : 
							$emails_tab = ' nav-tab-active';
							$emails_content = ' wps-deals-selected-tab';
							break;
							
			case 'misc' : 
							$misc_tab = ' nav-tab-active';
							$misc_content = ' wps-deals-selected-tab';
							break;
							
			case 'css' : 
							$customcss_tab = ' nav-tab-active';
							$customcss_content = ' wps-deals-selected-tab';
							break;
			case 'general' : 
							$general_tab = ' nav-tab-active';
							$general_content = ' wps-deals-selected-tab';
							break;
			case 'social' : 
							$social_tab = ' nav-tab-active';
							$social_content = ' wps-deals-selected-tab';
							break;
			case 'extension' : 
							$extension_tab = ' nav-tab-active';
							$extension_content = ' wps-deals-selected-tab';
							break;
		}
	?>
	
		<!-- beginning of the left meta box section -->
		<div class="content wps-deals-content-section">
		
			<h2 class="nav-tab-wrapper wps-deals-h2">
				<?php do_action('wps_deals_add_settings_tab_before',$selected_tab); ?>
		        <a class="nav-tab<?php echo $general_tab; ?>" href="#wps-deals-tab-general"><?php _e('General','wpsdeals');?></a>
		        <a class="nav-tab<?php echo $payments_tab; ?>" href="#wps-deals-tab-payments"><?php _e('Payment Gateways','wpsdeals');?></a>
		        <a class="nav-tab<?php echo $emails_tab; ?>" href="#wps-deals-tab-emails"><?php _e('Emails','wpsdeals');?></a>
		        <?php 
		        		if( has_action( 'wps_deals_add_extension_settings' ) ) { //check extenstion settings action is called or not
		        ?>
		        			<a class="nav-tab<?php echo $extension_tab; ?>" href="#wps-deals-tab-extension"><?php _e('Extensions','wpsdeals');?></a>
		        <?php 
		        		} 
		        ?>
		        <a class="nav-tab<?php echo $misc_tab; ?>" href="#wps-deals-tab-misc"><?php _e('Misc','wpsdeals');?></a>
		        <a class="nav-tab<?php echo $customcss_tab; ?>" href="#wps-deals-tab-css"><?php _e('CSS','wpsdeals');?></a>
		        <a class="nav-tab<?php echo $social_tab; ?>" href="#wps-deals-tab-social"><?php _e('Social Login','wpsdeals');?></a>
		        <?php do_action('wps_deals_add_settings_tab_after',$selected_tab); ?>
		    </h2><!--nav-tab-wrapper-->
		    <input type="hidden" id="wps_deals_selected_tab" name="wps_deals_options[selected_tab]" value="<?php echo $selected_tab;?>"/>
		    <!--beginning of tabs panels-->
			 <div class="wps-deals-content">
			 	<?php do_action('wps_deals_add_settings_tab_data_before',$selected_tab); ?>
			 	<div class="wps-deals-tab-content<?php echo $general_content; ?>" id="wps-deals-tab-general"> 
				
					<?php 
						// About
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-about-box.php' );
					?>
				 	<?php   
				 		// General
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-general-settings.php' ); 
					?>
					<?php 
						// Feed
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-feed.php' );
					?>
			 	</div>
			 	<div class="wps-deals-tab-content<?php echo $payments_content; ?>" id="wps-deals-tab-payments"> 
			 		<?php   
				 		// Payment Gateways
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-payment-gateways.php' ); 
					?>
			 	</div>
			 	
			 	<div class="wps-deals-tab-content<?php echo $emails_content; ?>" id="wps-deals-tab-emails"> 
			 		<?php   
				 		// Emails
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-emails-settings.php' ); 
					?>
			 	</div>
			 	<?php if( has_action( 'wps_deals_add_extension_settings' ) ) { ?>
			 	<div class="wps-deals-tab-content<?php echo $extension_content; ?>" id="wps-deals-tab-extension"> 
			 		<?php   
				 		// Extention
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-extension-settings.php' );
					?>
			 	</div>
			 	<?php } ?>
			 	<div class="wps-deals-tab-content<?php echo $misc_content; ?>" id="wps-deals-tab-misc"> 
			 		<?php   
				 		// Misc
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-misc-settings.php' ); 
					?>
			 	</div>
			 	<div class="wps-deals-tab-content<?php echo $customcss_content; ?>" id="wps-deals-tab-css"> 
			 		<?php   
				 		// Custom CSS
						require( WPS_DEALS_ADMIN . '/forms/wps-deals-custom-css-settings.php' ); 
					?>
			 	</div>
			 	<div class="wps-deals-tab-content<?php echo $social_content; ?>" id="wps-deals-tab-social"> 
			 		<?php   
				 		// Social Media
						require( WPS_DEALS_ADMIN . '/forms/social/wps-deals-social-settings.php' ); 
					?>
			 	</div>
			 	<?php do_action('wps_deals_add_settings_tab_data_after',$selected_tab); ?>
			 <!--end of tabs panels-->
			 </div>
		<!--end of the left meta box section -->
		</div><!--.content wps-deals-content-section-->
	</form>
<!--end .wrap-->
</div>