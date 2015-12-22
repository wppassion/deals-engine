<?php

/**
 * Top Placed Deal Template
 *
 * This displays all the info for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/home-header.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>

<div class="deals-header deals-row deals-clearfix" itemscope itemtype="http://schema.org/Product">

	<?php	
	
		if( $loop->have_posts() ) {
			
			while( $loop->have_posts() ) : $loop->the_post();
				echo '<div class="wps_home_deals">';
				/**
				 * wps_deals_change_password_top hook
				 *
				 * @hooked wps_deals_home_header_left - 10
				 * @hooked wps_deals_home_header_right - 15
				 */
				do_action( 'wps_deals_home_header_data' );
				echo '</div>';
			endwhile;
		}
		
		wp_reset_query();
	?>
	
</div>