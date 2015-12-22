<?php 

/**
 * Bought Deals Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/avail-bought/bought.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-bought-single deals-col-6">

	<p class="deals-bought-title">
		<?php echo apply_filters( 'wps_deals_bought_text', __( 'Bought', 'wpsdeals' ) ) ;?>
	</p>
	
	<p class="deals-bought">
		<span>
			<?php echo $bought; ?>
		</span> 
	</p>
	
</div>