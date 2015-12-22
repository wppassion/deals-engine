<?php 

/**
 * Template For Deals Lists Header
 * 
 * Handles to return design of deals listing
 * page header
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout-deals.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//get header
	get_header( 'deals' );
?>

	<div class="site-content" id="primary">
	
		<div id="content" role="main">
		
			<article class="post-<?php echo $post->ID;?> page type-page status-publish hentry" id="post-<?php echo $post->ID;?>">
			
				<header class="entry-header">
					<h1 class="entry-title"><?php echo get_the_title( $post->ID );?></h1>
				</header> 
				
				<div class="entry-content">
				
					<?php
						//do action for add checkout page top
						do_action( 'wps_deals_checkout_top' );
					?>		
				
					<div class="row-fluid">
				
						<div class="wps-deals-cart-wrap row-fluid clearfix">
					
							<?php
								//do action for add checkout page
								do_action( 'wps_deals_checkout_content' );
							?>
						
						</div><!--wps-deals-cart-wrap-->
						
					</div><!--row-fluid-->
					
					<?php
						//do action for add checkout page top
						do_action( 'wps_deals_checkout_bottom' );
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