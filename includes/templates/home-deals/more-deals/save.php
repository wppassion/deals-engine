<?php

/**
 * You Save template for the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/save.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-more-save-box deals-col-4">

	<!--<p class="deals-more-save-title">
		<?php echo apply_filters( 'wps_deals_save_text', __( 'You Save', 'wpsdeals' ) ); ?>
	</p>-->
	
	<p class="deals-more-save">
		<span>
			<?php echo $savingprice; ?>
		</span>
	</p>
	
</div>