<?php 

/**
 * Template For Deal Discount
 * 
 * Handles to show deal discount
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/deal-discount.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deal-detail"><p><?php _e('Discount','wpsdeals');?><br/><?php echo $discount;?></p></div>