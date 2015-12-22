<?php

/**
 * Navigation template for the more Deals (Active, Upcoming, Ending Soon).
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/navigation.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$deals_status = isset( $deals_status ) && !empty( $deals_status ) ? explode( ',', $deals_status ) : '';
$flag = 'active';

if( !empty($deals_status) && count($deals_status) > 1 ) { ?>

<div class="deals-navdeal">
	
	<?php if( in_array( 'active', $deals_status, true ) ) { ?>
		<span class="<?php echo !empty($flag) ? $flag : ''; ?> deals-active">
			<a href="javascript:void(0);">
				<?php echo apply_filters( 'wps_deals_home_active_tab_text', __( 'Active Deals', 'wpsdeals' ) ); ?>
			</a>
		</span>
	<?php $flag = '';
	} ?>
	
	<?php if( in_array( 'ending-soon', $deals_status, true ) ) { ?>
		<span class="<?php echo !empty($flag) ? $flag : ''; ?> deals-ending-soon">
			<a href="javascript:void(0);">
				<?php echo apply_filters( 'wps_deals_home_ending_tab_text', __( 'Ending Soon', 'wpsdeals' ) ); ?>
			</a>
		</span>
	<?php $flag = '';
	} ?>
	
	<?php if( in_array( 'upcoming', $deals_status, true ) ) { ?>
		<span class="<?php echo !empty($flag) ? $flag : ''; ?> deals-upcoming-soon">
			<a href="javascript:void(0);">
				<?php echo apply_filters( 'wps_deals_home_upcoming_tab_text', __( 'Upcoming Deals', 'wpsdeals' ) ); ?>
			</a>
		</span>
	<?php $flag = '';
	} ?>
	
</div>

<?php } ?>