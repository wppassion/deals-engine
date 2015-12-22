<?php

/**
 * Loop template for the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/more-deals.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $wps_deals_options, $wps_deals_by_category_shortcode_atts;
	
	// get the columns value
	$columns = $wps_deals_options['deals_columns'];
	
	$cols = '2';
	
	if( $columns == 'deals-col-4' ) {
		$cols = '3';
	}
	
	if( $columns == 'deals-col-3' ) {
		$cols = '4';
	}
	
	$loop = null;
	$loop = new WP_Query();
	$loop->query( $args );
	
?>	

<div id="deals-<?php echo $tab;?>" class="deals-list deals-<?php echo $tab;?> deals-row">	
<input type="hidden" id="wps_deals_by_category_shortcode_atts" data-shortcode-atts="<?php echo json_encode( $wps_deals_by_category_shortcode_atts ); ?>" />
<?php	
	$i = 0;
	if( $loop->have_posts() ) {
	
		/**
		 * wps_deals_before_archive_loop hook
		 *
		 * @hooked wps_deals_count - 20
		 * @hooked wps_deals_ordering - 30
		 */
		do_action( 'wps_deals_before_home_loop' );
?>

	<div class="deals-home-list">
	
	<?php /** Start of paging **/
		
		// create pagination object
		$paging = new Wps_Deals_Pagination_Public('wps_home_deals_ajax_pagination');
		
		// Get per page from settings
		$deals_per_page = $wps_deals_options['deals_per_page'];
		$perpage = isset( $deals_per_page ) ? $deals_per_page : -1;
				
		$paging->items( $loop->found_posts ); // set total founded deals
		$paging->limit( $perpage ); // limit entries per page
			
		// check paging is passed into post. if yes then set it to current page
		if( isset( $_POST['paging'] ) ) {
			$paging->currentPage( $_POST['paging'] ); // gets and validates the current page
		}
			
		$paging->calculate(); // calculates what to show
		$paging->parameterName( 'paging' );		
		$paging->className = "page-numbers"; // define main class
		
		/** End of paging **/ 

		while( $loop->have_posts() ) : $loop->the_post(); $i++; ?>
					
			<div class="<?php echo $columns; ?>">
					
				<div class="deals-more-content deals-col-12">
							
					<?php 					
						/**
						 * wps_deals_home_more_deals_content hook
						 *
						 * @hooked wps_deals_home_more_deals_discount - 5
						 * @hooked wps_deals_home_more_deals_image - 10
						 * @hooked wps_deals_home_more_deals_timer - 15
						 * @hooked wps_deals_home_more_deals_title - 20
						 * @hooked wps_deals_home_more_deals_price - 25
						 * @hooked wps_deals_home_more_deals_see_deal - 30
						 */
						
						$options	= isset( $options ) ? $options : array();
						do_action( 'wps_deals_home_more_deals_content', $options );
					?>
								
				</div>
						
			</div>
			
			<?php			
				if( $i == $cols ) {
					echo '<div class="deals-clearfix">&nbsp;</div>';
					$i = 0;
				}			
			?>
			
		<?php endwhile; ?>
		
	</div>
		
	<?php
		/**
		 * wps_deals_after_archive_loop hook
		 */
		do_action( 'wps_deals_after_archive_loop' );	
	?>
		
	<?php if( $loop->max_num_pages > 1 ) : ?>
	
		<div class="deals-clearfix">&nbsp;</div>
		
		<nav class="deals-pagination pagination-centered pagination-<?php echo $btncolor; ?> deals-col-12" role="navigation">
			
			<?php echo $paging->getOutput(); ?>
			
			<span class="deals-pagination-loader">
				<img src="<?php echo WPS_DEALS_URL;?>includes/images/cart-loader.gif">
			</span>
		</nav>
		
	<?php
		endif;
			
	} else {
			
		// loads the no deals found message template
		wps_deals_get_template( 'global/no-deals.php' );			
	}
		
	wp_reset_query();
?>	

</div>