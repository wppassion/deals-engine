<?php 

/**
 * Template available copy box
 * 
 * Handles to show available deal and bought copy box
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/avail-bought/available.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-product-div span5 wps-deals-product-available">
	<?php echo apply_filters( 'wps_deals_available_text', __('Available <br/> <span class="wps-deals-orange-font">'.$available.'</span>','wpsdeals'), $available );?>
</div>