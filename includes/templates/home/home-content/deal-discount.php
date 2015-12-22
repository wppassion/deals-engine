<?php
/**
 * Home Deal Discount
 * 
 * Handles to Show Deal Discount
 * Value for home page loop content
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/deal-discount.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="wps-deals-sub-footer">
	<span><?php echo apply_filters( 'wps_deals_discount_text',__('Discount','wpsdeals'));?></span>
	<div><?php echo $discount;?></div>
</div><!--.wps-deals-sub-footer-->