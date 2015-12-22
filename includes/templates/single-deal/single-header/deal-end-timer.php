<?php 

/**
 * Template Single Deal Timer
 * 
 * Handles to show single deal timer
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/deal-end-timer.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

	<div class="wps-deals-product-div wps-deals-view-timing row-fluid">
	
		<?php if( $startdate <= $today || $startdate >= $today ) { //check deal is active or upcoming
			
				if( $startdate >= $today ) { //check deal is upcoming
		?>			<span><?php echo apply_filters( 'wps_deals_upcoming_timer_text',__('This deal will start in','wpsdeals') );?></span><br/>
		<?php 	} else { //else consider as active ?>
					<span><?php echo apply_filters( 'wps_deals_timer_text', __('This deal will end in','wpsdeals') );?></span><br/>
		<?php	} ?>
				
			<div class="wps-deals-header-timing">
				<div align="center" class="wps-deals-time wps-deals-end-timer"
					timer-year="<?php echo $year;?>"
					timer-month="<?php echo $month;?>"
					timer-day="<?php echo $day;?>"
					timer-hours="<?php echo $hours;?>"
					timer-minute="<?php echo $minute;?>"
					timer-second="<?php echo $seconds;?>">
					<span class="timer-icon-big"></span>
				</div>
			</div>
	<?php 
			}
	?>
	
	</div>