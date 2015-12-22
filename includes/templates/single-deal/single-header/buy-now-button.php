<?php

/**
 * Template For Buy Now Button
 * 
 * Handles to show buy now button
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/buy-now-button.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<a href="<?php echo $payurl;?>" class="wps-deals-buy-now"><?php echo apply_filters( 'wps_deals_view_cart_text', $buynowtext . ' <span itemprop="price">' . $displayprice . '</span>', $buynowtext, $displayprice ) ;?></a>