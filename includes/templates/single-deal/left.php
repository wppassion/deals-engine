<?php 

/**
 * Single Deal Template Left
 * 
 * Adds all the Deal details.
 *
 * Override this template by copying it to yourtheme/deals-engine/single-deal/left.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-col-6 deal-details">

	<div class="deals-row">
				
		<?php					
			/**
			 * wps_deals_single_header_left hook
			 *
			 * @hooked wps_deals_single_deal_price - 5
			 * @hooked wps_deals_single_dime_sale - 10
			 * @hooked wps_deals_single_add_to_cart - 15
			 * @hooked wps_deals_single_value - 17
			 * @hooked wps_deals_single_discount - 18
			 * @hooked wps_deals_single_save - 19
			 * @hooked wps_deals_single_deal_timer - 25
			 * @hooked wps_deals_single_deal_avail_bought - 30
			 * @hooked wps_deals_single_deal_ratings - 35
			 */
			do_action( 'wps_deals_single_header_left' );					
		?>
		
	</div>
			
</div>