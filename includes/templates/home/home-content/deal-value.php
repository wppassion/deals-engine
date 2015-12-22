<?php
/**
 * Home Deal Normal Price
 * 
 * Handles to Show Deal Normal Price
 * 
 * Override this template by copying it to
 * yourtheme/deals-engine/home/home-content/deal-value.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-sub-footer">
	<span><?php echo apply_filters( 'wps_deals_value_text', __('Deal Value','wpsdeals'));?></span>
	<div><?php echo $normalprice;?></div>
</div><!--.wps-deals-sub-footer-->