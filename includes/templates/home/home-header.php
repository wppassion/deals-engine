<?php
/**
 * Deals Listing Home Header Part
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-header.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>

<div class="wps-deals-header row-fluid clearfix">

	<?php	
		
		if( $loop->have_posts() ) {
			
			while ( $loop->have_posts() ) : $loop->the_post();
			 
				//do action to show home page header deal content
				do_action( 'wps_deals_home_header_content' );
		?>			
				
				<div class="span4">
				
					<?php
					
						//do action to show home page header right section
						do_action( 'wps_deals_home_header_right_top' );
					
					?>
					
					<div class="wps-deals-value-wrap row-fluid">
					
						<?php		
								//do action to show home page header right section
								do_action( 'wps_deals_home_header_right_center' );
						?>
				
					</div><!--.wps-deals-value-wrap-->
				
					<?php 
					
						//do action to show home page header right panel bottom
						do_action( 'wps_deals_home_header_right_bottom' );
						
					?>
						
				</div><!--span4-->
			 
			<?php 
					endwhile;
		}
		
		wp_reset_query();
	?>
	
</div><!--.row-fluid-->