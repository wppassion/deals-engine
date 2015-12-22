<?php

/**
 * Rating Template
 *
 * Does display the average rating (from Social Review Engine) for this Deal.
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/ratings.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// if rating is empty then do not load its html
if( empty( $rating ) ) return;

?>
	
<div class="deals-rating deals-col-12">
	
	<div class="deals-rating-label">
		<?php apply_filters( 'wps_deals_rating_text', __( 'Customer Rating', 'wpsdeals' ) ); ?>
	</div>
		
	<div class="review-star wps-fbre-stars_<?php echo $rating;?>stars"></div>
		
</div>