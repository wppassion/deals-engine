<?php 

/**
 * Template Single Deal
 * 
 * Handles to show single deal page
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	global $post,$wps_deals_options,$wps_deals_message;
	
	//message class
	$message = $wps_deals_message;
	
	if ( $message->size( 'error' ) > 0 ) {
		// if we need to display the error message, we will do it here
		echo $message->output( 'error' );
	}
?>
<div class="wps-deals-desc row-fluid">
	<?php 
	
		//do action to show header content in single page
		do_action( 'wps_deals_single_header_content' );
	?>
</div><!--wps-deals-desc-->