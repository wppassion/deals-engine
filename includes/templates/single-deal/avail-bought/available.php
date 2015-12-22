<?php 

/**
 * Available Deals Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/avail-bought/available.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-available-single deals-col-6">

	<p class="deals-available-title">
		<?php echo apply_filters( 'wps_deals_available_text', __( 'Available', 'wpsdeals' ) ) ;?>
	</p>
	
	<p class="deals-available">
		<span>
			<?php echo $available; ?>
		</span>
	</p>
	
</div>