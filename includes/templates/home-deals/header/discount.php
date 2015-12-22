<?php

/**
 * Discount template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/discount.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-dicount-box">

	<p class="deals-discount-title">
		<?php echo apply_filters( 'wps_deals_discount_text', __( 'Discount', 'wpsdeals' ) ); ?>
	</p>
	
	<p class="deals-discount">
		<span>
			<?php echo $discount;?>
		</span>
	</p>
	
</div>