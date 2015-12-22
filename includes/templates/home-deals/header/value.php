<?php

/**
 * Deal value template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/value.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	
	
<div class="deals-value-box deals-col-6">

	<p class="deals-value-title">
		<?php echo apply_filters( 'wps_deals_value_text', __( 'Deal Value', 'wpsdeals' ) );?>
	</p>
	
	<p class="deals-value">
		<span>
			<?php echo $normalprice;?>
		</span>
	</p>
	
</div>