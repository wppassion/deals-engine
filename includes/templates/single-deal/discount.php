<?php 

/**
 * Discount Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/discount.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-discount-single deals-col-4">

	<p class="deals-discount-title">
		<?php _e( 'Discount', 'wpsdeals' ); ?>
	</p>
	
	<p class="deals-discount">
		<span>
			<?php echo $discount; ?>
		</span>
	</p>
	
</div>