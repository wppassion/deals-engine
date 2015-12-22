<?php 

/**
 * Terms and Conditions Templates
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/terms.php
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
		<input type="checkbox" id="deals_checkout_agree_terms" name="wps_deals_checkout_agree_terms" value="1"/>
		<a href="#DealsTerms">
			<?php echo $agreelabel;?>
		</a>
	</p>
	
</div>

<div id="DealsTerms" class="deals-modal">

	<div class="deals-modal-dialog">
	
		<div class="deals-modal-content">
	
			<div class="deals-modal-header">
				<a href="#close" class="<?php echo $btncolor; ?> deals-button deals-modal-close">X</a>
				<h3>
					<?php echo $agreelabel;?>
				</h3>
			</div>
			
			<div class="deals-modal-body">
				<?php echo wpautop( $termscontent );?>
			</div>
			
			<div class="deals-modal-footer">
			
				<a href="#close" class="<?php echo $btncolor; ?> deals-button">
					<?php _e( 'Close', 'wpsdeals' ); ?>
				</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>