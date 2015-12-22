<?php 

/**
 * Template Deal Details
 * 
 * Handles to show deal details
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/deal-details.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>	
	<div class="wps-deals-product-div row-fluid">
 		<?php 
 			//do action to show deal value / save price / discount
 			do_action( 'wps_deals_single_details' );
 		?>
 	</div>