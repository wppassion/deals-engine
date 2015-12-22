<?php
/**
 * Home Content Footer Timer
 * 
 * Handles to Show Active Deals
 * Template on home page
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/timer.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-timing wps-deals-timer-home-list wps-deals-end-timer"
		timer-year="<?php echo $year;?>"
		timer-month="<?php echo $month;?>"
		timer-day="<?php echo $day;?>"
		timer-hours="<?php echo $hours;?>"
		timer-minute="<?php echo $minute;?>"
		timer-second="<?php echo $seconds;?>">
	<span class="timer-icon"></span>
</div>