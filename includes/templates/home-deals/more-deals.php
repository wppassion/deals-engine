<?php

/**
 * More Deals Template
 * 
 * This displays the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/home-content.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( isset( $category ) ) {
	
	$deals_data = array (
					'category' =>	$category
					);
} else {
	
	$deals_data = isset( $deals_status ) && !empty( $deals_status ) ?  array ( 'deals_status' =>	$deals_status ) : '';
}
	
?>

<div class="deals-more deals-row">

	<div class="deals-wprapper deals-col-12">

		<?php			
			/**
			 * wps_deals_change_password_top hook
			 *
			 * @hooked wps_deals_home_navigations - 5
			 * @hooked wps_deals_home_more_deal_active - 20
			 * @hooked wps_deals_home_more_deal_ending - 20
			 * @hooked wps_deals_home_more_deal_upcoming - 20
			 */
			do_action( 'wps_deals_home_more_deals', $deals_data );			
		?>	
			
	</div>
	
</div>