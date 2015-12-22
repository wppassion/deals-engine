<?php

/**
 * Home page header deal value
 * 
 * Handles to show home page deal value box
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-header/header-value.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
	<div class="wps-deals-value span6">
		<p class="deals-value-title"><?php echo apply_filters( 'wps_deals_value_text', __( 'Deal Value','wpsdeals' ) );?></p>
		<span><?php echo $normalprice;?></span>
	</div>