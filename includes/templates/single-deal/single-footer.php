<?php 

/**
 * Template Terms & Conditions
 * 
 * Handles to show terms & conditions
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-footer.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
	<div class="wps-deals-product-terms row-fluid">
		
		<?php 
			//do action for single footer content top
			do_action( 'wps_deals_single_footer_top' );
		?>
		
	<div class="wps-deals-address row-fluid">
	
		<?php 
			//do action fo show footer middle content before
			do_action( 'wps_deals_single_footer_middle_content_before' );
		?>
		
		<div class="wps-deals-business-address span6">
			
			<?php 
					//do action for show single footer middle content
					do_action( 'wps_deals_single_footer_middle_content_center' );
			?>
		</div><!-- .wps-deals-business-address -->
		
		<?php 
			//do action fo show footer middle content after
			do_action( 'wps_deals_single_footer_middle_content_after' );
		?>
		
	</div><!-- .wps-deals-address -->
	
	<?php 
		//do action fo show footer content before container
		do_action( 'wps_deals_single_footer_bottom' );
	?>
	
</div><!-- .wps-deals-product-terms-->