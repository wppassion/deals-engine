<?php 

/**
 * Deal Value Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/value.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-value-single deals-col-4">

	<p class="deals-value-title">
		<?php echo apply_filters( 'wps_deals_value_text', __( 'Value', 'wpsdeals' ) ); ?>
	</p>
	
	<p class="deals-value">
		<span>
			<?php echo $price; ?>
		</span>
	</p>
	
</div>