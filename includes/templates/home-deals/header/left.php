<?php

/**
 * Top Placed Deal Template Left
 * 
 * Adds the Deal title, image and excerpt for the top placed Deal.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home/header/left.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-col-7 deals-desc">
				
	<?php					
		/**
		 * wps_deals_change_password_top hook
		 *
		 * @hooked wps_deals_home_header_title - 10
		 * @hooked wps_deals_home_header_image - 15
		 * @hooked wps_deals_home_header_excerpt - 20
		 */
		do_action( 'wps_deals_home_header_left_data' );					
	?>
			
</div>