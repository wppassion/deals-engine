<?php

/**
 * You Save template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/save.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<div class="deals-save-box deals-col-6">

	<p class="deals-save-title">
		<?php echo apply_filters( 'wps_deals_save_text', __( 'You Save', 'wpsdeals' ) ); ?>
	</p>
	
	<p class="deals-save">
		<span>
			<?php echo $savingprice;?>
		</span>
	</p>
	
</div>