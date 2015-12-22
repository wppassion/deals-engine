<?php
/**
 * Single Deal Content Template
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-content.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post;

	$prefix = WPS_DEALS_META_PREFIX;
	
	//get disable button value 
	$disable_button = get_post_meta($post->ID, $prefix.'disable_button_bottom', true);
	
	//today's date time
	$today = wps_deals_current_date('Y-m-d H:i:s');
	
	//get the value for start date & time of deals from the post meta box
	$startdate = get_post_meta($post->ID,$prefix.'start_date',true);
	
?>
<div class="row-fluid">
	<div class="wps-deals-product-content">
	
		<?php
			//do action to load middle content top
			do_action( 'wps_deals_single_middle_content_top' );
		
			if( $disable_button != 'on' && $startdate <= $today ) { //button is enable && deal start date should be less or equal to today
					
				?>
					<div class="row-fluid">
						<div class="span3 hidden-phone"></div>
							<div class="wps-deals-product-btn span6">
								<?php	
									//do action to show  single description
									//it will show only when bottom button of add to cart is enable
									do_action( 'wps_deals_single_middle_content_center' );
								?>		
							</div><!--wps-deals-product-btn-->
						<div class="span3"></div>
					</div><!--row-fluid-->
		<?php
			}
			
			//do action to load middle content top
			do_action( 'wps_deals_single_middle_content_bottom' );
		?>
		
		
	</div><!--wps-deals-product-content-->
</div><!--.row-fluid-->