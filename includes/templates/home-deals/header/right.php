<?php

/**
 * Top Placed Deal Template Right
 * 
 * Adds all the Deal details for the top placed Deal.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/right.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-col-5 deals-details">
					
	<?php		
		/**
		 * wps_deals_change_password_top hook
		 *
		 * @hooked wps_deals_home_header_discount - 10
		 * @hooked wps_deals_home_header_value - 15
		 * @hooked wps_deals_home_header_save - 20
		 * @hooked wps_deals_home_header_rating - 25
		 * @hooked wps_deals_single_deal_avail_bought - 30
		 * @hooked wps_deals_home_header_see_deal - 35
		 */
		do_action( 'wps_deals_home_header_right_data' );
	?>
				
</div>