<?php 

/**
 * Template Deal Expired
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/add-to-cart/expired.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
	
<div class="deals-product-btn deal-expired deals-row">
	<div class="deals-expired-single">
		<p class="deals-expired-text">		
			<?php echo apply_filters( 'wps_deals_expired_text', $expiredtext );?>
		</p>
	</div>
</div>