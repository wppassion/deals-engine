<?php

/**
 * Home page header deal ending timer
 * 
 * Handles to make home page header timer
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-header/header-timer.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>	
<div class="wps-deals-right-header">
	<h2><?php echo apply_filters( 'wps_deals_timer_text', __('This deal will end in','wpsdeals') );?></h2>
</div><!--wps-deals-right-header-->
<div class="wps-deals-timing-front">
	<div align="center" class="wps-deals-time wps-deals-end-timer" 
		timer-year="<?php echo $year;?>"
		timer-month="<?php echo $month;?>"
		timer-day="<?php echo $day;?>"
		timer-hours="<?php echo $hours;?>"
		timer-minute="<?php echo $minute;?>"
		timer-second="<?php echo $seconds;?>">
		<span class="timer-icon-big"></span>
	</div><!--.wps-deals-end-time-->
</div><!--.wps-deals-timing-front-->