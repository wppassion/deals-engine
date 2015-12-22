<?php 

/**
 * Single Deal Template Right
 * 
 * Adds the Deal image and social sharing buttons.
 *
 * Override this template by copying it to yourtheme/deals-engine/single-deal/right.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-col-6 deal-image">
					
	<?php		
		/**
		 * wps_deals_single_header_right hook
		 *
		 * @hooked wps_deals_single_deal_img - 10
		 * @hooked wps_deals_social_buttons - 20
		 */
		do_action( 'wps_deals_single_header_right' );
	?>
				
</div>