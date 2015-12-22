<?php 

/**
 * Terms & Conditions Template.
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/terms.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options;

// get the color scheme from the settings
$button_color = $wps_deals_options['deals_btn_color'];
$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';

?>
<div class="deals-row">

	<p class="deals-terms deals-col-12">
		<a href="#DealsTerms">
			<?php _e( 'Terms & Conditions', 'wpsdeals' ); ?>
		</a>
	</p>
	
</div>

<div id="DealsTerms" class="deals-modal">

	<div class="deals-modal-dialog">
	
		<div class="deals-modal-content">
	
			<div class="deals-modal-header">
				<a href="#close" class="<?php echo $btncolor; ?> deals-button deals-modal-close">X</a>
				<h3>
					<?php _e( 'Terms & Conditions', 'wpsdeals' ); ?>
				</h3>
			</div>
			
			<div class="deals-modal-body">
				<?php echo wpautop( $termsconditions );?>
			</div>
			
			<div class="deals-modal-footer">
			
				<a href="#close" class="<?php echo $btncolor; ?> deals-button">
					<?php _e( 'Close', 'wpsdeals' ); ?>
				</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>