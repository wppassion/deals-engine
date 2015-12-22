<?php
/**
 * Home More Deal Content Template
 * 
 * Handles to show home page more content
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post,$wps_deals_options;
	
	$category = isset( $category ) && !empty( $category ) ? $category : '';
	
?>
<div class="wps-deals-more row-fluid clearfix">

	<div class="wps-deals-wprapper">

		<?php
			
			//do action to load home content inner
			do_action( 'wps_deals_home_more_deals', $category );
			
		?>	
			
	</div><!--wps-deals-wprapper-->
	
</div><!--.row-fluid-->