<?php

/**
 * Timer template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/timer.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>		

<div class="deals-timer">

	<h2>
		<?php echo apply_filters( 'wps_deals_timer_text', __('This deal will end in','wpsdeals') );?>
	</h2>
	
</div>
	
<div class="deals-timing-front">

	<div class="deals-time deals-end-timer" 
		timer-year="<?php echo $year;?>"
		timer-month="<?php echo $month;?>"
		timer-day="<?php echo $day;?>"
		timer-hours="<?php echo $hours;?>"
		timer-minute="<?php echo $minute;?>"
		timer-second="<?php echo $seconds;?>">
		
		<span class="timer-icon-big"></span>
	</div>
	
</div>