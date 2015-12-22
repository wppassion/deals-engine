<?php 

/**
 * Template For Deals Lists Header
 * 
 * Handles to return design of deals listing
 * page header
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	//get header
	get_header( 'deals' );

	global $post,$wps_deals_options;
	
	// get the size for the design from the settings page
	$size = $wps_deals_options['deals_size'];

	while ( have_posts() ) : the_post(); ?>

		<div class="site-content" id="primary">
		
			<div itemscope itemtype="http://schema.org/Product" id="content" role="main">
			
				<article class="post-<?php echo $post->ID;?> page type-page status-publish hentry" id="post-<?php echo $post->ID;?>">
				
					<header class="entry-header">
						<h1 itemprop="name" class="entry-title"><?php echo get_the_title( $post->ID );?></h1>
					</header> 
					
					<div class="entry-content">
					
						<?php 
								//do action to add in top of single page
								do_action( 'wps_deals_single_top' );
						?>
					
						<div class="row-fluid <?php echo $size;?>">
						
							<?php 
								
									//do action to add deal single content
									do_action( 'wps_deal_single_content' );
							?>
							
						</div><!--.row-fluid-->
						
						<?php 
								//do action to add in top of single
								do_action( 'wps_deals_single_bottom' );
						?>
						
					</div><!--entry-content-->
					
				</article>
				
			</div><!--#content-->
			
		</div><!--site-content-->
	
<?php endwhile; // end of the loop.
	
	//wps_deals_sidebar action
	do_action('wps_deals_sidebar');
	
	//get footer
	get_footer( 'deals' ); 
	
?>