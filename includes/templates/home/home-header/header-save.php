<?php

/**
 * Home page header saving value box
 * 
 * Handles to show you save value box
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-header/header-save.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="wps-deals-save span6">
	<p class="deals-value-title"><?php echo apply_filters( 'wps_deals_save_text', __( 'You Save','wpsdeals' ) );?></p>
	<span><?php echo $savingprice;?></span>
</div>