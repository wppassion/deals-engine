<?php
/**
 * Deals Home page Navigation Template
 * 
 * Handles to show home page 
 * navigation
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/home-navigation.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="wps-deals-navdeal">
	<span class="active wps-deals-active"><a href="javascript:void(0);"><?php echo apply_filters( 'wps_deals_home_active_tab_text', __('Active Deals','wpsdeals'));?></a></span>
	<span class="wps-deals-ending-soon"><a href="javascript:void(0);"><?php echo apply_filters( 'wps_deals_home_ending_tab_text',__('Ending Soon','wpsdeals'));?></a></span>
	<span class="wps-deals-upcoming-soon"><a href="javascript:void(0);"><?php echo apply_filters( 'wps_deals_home_upcoming_tab_text', __('Upcoming Deals','wpsdeals'));?></a></span>
</div><!--wps-deals-navdeal-->