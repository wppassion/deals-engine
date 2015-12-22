<?php
/**
 * Home Deal Saving Price
 * 
 * Handles to Show Saving Price
 * Home page loop content
 * 
 * Override this template by copying it to
 * yourtheme/deals-engine/home/home-content/deal-save.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-sub-footer-last">
	<span><?php echo apply_filters( 'wps_deals_save_text',__('You Save','wpsdeals'));?></span>
	<div><?php echo $savingprice;?></div>
</div><!--.wps-deals-sub-footer-last-->