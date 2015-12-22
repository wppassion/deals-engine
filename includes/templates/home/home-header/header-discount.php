<?php

/**
 * Home page Header discount
 * 
 * Handles to make home page header 
 * discount content
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-header/header-discount.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-dicount">
	<p class="deals-value-title"><?php echo apply_filters( 'wps_deals_discount_text', __( 'Discount','wpsdeals' ) ); ?></p>
	<span><?php echo $discount;?></span>
</div>