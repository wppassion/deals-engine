<?php
/**
 * Home header star ratings
 * 
 * Handles to show home
 * star ratings
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/ratings.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//if rating is empty then do not load its html
if( empty( $rating ) ) return;

?>
	<div class="wps-deals-rating row-fluid">
		<div class="wps-deals-rating-label"><?php apply_filters( 'wps_deals_rating_text', __('Customer Rating','wpsdeals'));?> </div>
		<div class="review-star wps-fbre-stars_<?php echo $rating;?>stars"></div>
	</div><!--.wps-deals-rating-->