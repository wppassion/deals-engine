<?php

/**
 * Ratings template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/ratings.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	
	
<div class="deals-rating">
		
	<div class="deals-rating-label">
			
		<p>
			<?php _e( 'Customer Rating', 'wpsdeals' );?>
		</p>
			
	</div>
		
	<div class="review-star wps-fbre-stars_<?php echo $rating; ?>stars">&nbsp;</div>
	
</div>