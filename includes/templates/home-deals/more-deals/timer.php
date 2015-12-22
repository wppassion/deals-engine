<?php

/**
 * Timer template for the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/timer.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-timing deals-timer-home-list deals-end-timer deals-col-12"
		timer-year="<?php echo $year; ?>"
		timer-month="<?php echo $month; ?>"
		timer-day="<?php echo $day; ?>"
		timer-hours="<?php echo $hours; ?>"
		timer-minute="<?php echo $minute; ?>"
		timer-second="<?php echo $seconds; ?>">
		
	<span class="timer-icon">&nbsp;</span>

</div>