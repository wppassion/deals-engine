<?php 

/**
 * Template For Deal Discount
 * 
 * Handles to show deal discount
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/deal-save.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="deal-detail detail-last"><p><?php echo apply_filters( 'wps_deals_save_text', __('You Save','wpsdeals') );?><br/><?php echo $savingprice;?></p></div>