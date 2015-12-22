<?php 

/**
 * Timer Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/timer.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-single-timing deals-col-12">

	<div class="deals-single-timer">
	
		<?php if( $startdate <= $today || $startdate >= $today ) { // check if the deal is active or upcoming
				
				if( $startdate >= $today ) { // check if this deal is upcoming			
		?>			
					<p class="deals-start-title">
						<span>
							<?php echo apply_filters( 'wps_deals_upcoming_timer_text', __( 'This deal will start in', 'wpsdeals' )  );?>
						</span>
					</p>
					
		<?php 	} else { // else consider as active ?>
						
					<p class="deals-remaining-title">
						<span>
							<?php echo apply_filters( 'wps_deals_timer_text', __( 'Time remaining', 'wpsdeals' ) ); ?>
						</span>
					</p>
					
		<?php	} ?>

		<div class="deals-timing deals-timer-single deals-end-timer"
			timer-year="<?php echo $year; ?>"
			timer-month="<?php echo $month; ?>"
			timer-day="<?php echo $day; ?>"
			timer-hours="<?php echo $hours; ?>"
			timer-minute="<?php echo $minute; ?>"
			timer-second="<?php echo $seconds; ?>">

			<span class="timer-icon-big"></span>
		</div>

		<?php 
			}
		?>

	</div>
	
</div>