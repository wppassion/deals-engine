<?php 

/**
 * Template For Deal Value
 * 
 * Handles to show deal value
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/deal-value.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="deal-detail"><p><?php echo apply_filters( 'wps_deals_value_text', __('Value','wpsdeals') );?><br/><?php echo $price;?></p></div>