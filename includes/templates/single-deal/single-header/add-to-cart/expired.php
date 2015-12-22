<?php 

/**
 * Template Deal Expired
 * 
 * Handles to show deal expired
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/add-to-cart/expired.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
	<div class="wps-deals-product-btn row-fluid">
		<div class="wps-deals-add-to-cart-button-end deals-end"><?php echo apply_filters( 'wps_deals_expired_text', $expiredtext );?></div>
	</div>