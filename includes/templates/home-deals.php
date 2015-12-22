<?php 
/**
 * Template for displaying Home deal archives
 *
 * Handles to return design of deals home page  
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	//get header
	get_header( 'deals' );

	global $post,$wps_deals_options;
	
	//get deal width
	$size = $wps_deals_options['deals_size'];
	
?>

	<div class="site-content" id="primary">
	
		<div id="content" role="main">
		
			<article class="post-<?php echo $post->ID;?> page type-page status-publish hentry" id="post-<?php echo $post->ID;?>">
			
				<header class="entry-header">
					<h1 class="entry-title"><?php echo get_the_title( $post->ID );?></h1>
				</header> 
				
				<div class="entry-content">
				
					<?php 
							//do action to add in top of home page
							do_action( 'wps_deals_home_top');
					?>
					
					<div class="wps-deals-front <?php echo $size;?> row-fluid">
								
						<?php 	
							//do action to add before home header
							do_action( 'wps_deals_home_content' );
						?>
						
					</div><!--.wps-deals-front-->
				
					<?php 
							//do action to add after home page container
							do_action( 'wps_deals_home_bottom');
					?>
					
				</div><!--entry-content-->
				
			</article>
						
		</div><!--#content-->
		
	</div><!--site-content-->
<?php

	//register sidebar with following action
	do_action( 'wps_deals_sidebar' );
	
	//get footer
	get_footer( 'deals' ); 
	
?>