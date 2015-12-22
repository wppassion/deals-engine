<?php 

/**
 * Template For Left Deal
 * 
 * Handles to return design of deal left text
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/dim-sale.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( empty( $lefttext ) ) { //check deal left text 
	return;
}
?>
<div class="wps-deals-product-div wps-deals-dimesale-text row-fluid clearfix"><p><?php echo $lefttext;?></p></div>