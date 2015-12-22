<?php

/**
 * Buy Now Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/buy-now-button.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wps_deals_options;


?>


<!--<div class="<?php //echo $btncolor; ?> deals-button btn-big deals-col-12">
-->
	<a href="<?php echo $payurl; ?>" class="wps-deals-buy-now <?php echo $btncolor; ?> deals-button btn-big deals-col-12 ">
		<?php echo apply_filters( 'wps_deals_view_cart_text', $buynowtext, $buynowtext, $displayprice ) ;?>
	</a>
	
<!--</div>-->