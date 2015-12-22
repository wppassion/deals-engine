<?php 

/**
 * You Save Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/save.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
?>

<div class="deals-save-single deals-col-4">

	<p class="deals-save-title">
		<?php echo apply_filters( 'wps_deals_save_text', __( 'You Save', 'wpsdeals' ) );?>
	</p>
	
	<p class="deals-save">
		<span>
			<?php echo $savingprice; ?>
		</span>
	</p>
	
</div>