<?php
/**
 * Home Loop Template
 * 
 * Handles to Show Loop Deals
 * Template on home page
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/more-deals.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post,$wps_deals_price,$wps_deals_model;
	
	//model class
	$model = $wps_deals_model;
	
	//price class
	$price = $wps_deals_price;

	//$args is passed when template is call
	
	$i = 0;					
	$loop = null;
	$loop = new WP_Query();
	$loop->query( $args );
	
?>	
	<div class="wps-deals-list wps-deals-<?php echo $tab;?> row-fluid">
	
<?php	
		if( $loop->have_posts() ) {
			
			while ( $loop->have_posts() ) : $loop->the_post();
					
					$i++;
?>				
					<div class="span6 deals-box box-<?php echo $i;?>">
					
						<div class="wps-deal-contentdeal">
							
							<div class="wps-deals-sub-content">
							
								<?php 
								
									//do action to show home page more deal loop content
									do_action( 'wps_deals_home_more_deal_content' );
								
								?>
								
							</div><!--wps-deals-sub-content-->
						
							<div class="wps-deals-contentdeal-footer">
								<?php
								
									//do action to show home page more deal loop footer
									do_action( 'wps_deals_home_more_deal_footer' );
									
								?>
							</div><!--.wps-deals-contentdeal-footer-->
							
						</div><!--wps-deal-contentdeal-->
						
					</div><!--.span6-->
		<?php 
			
			endwhile;
			
		} else {
			
			//no deals found message
			wps_deals_get_template( 'home/home-content/home-no-deals.php' );
			
		}
		
		wp_reset_query();
?>	
	</div><!--.wps-deals-active-->