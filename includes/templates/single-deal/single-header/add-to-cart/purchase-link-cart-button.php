<?php 

/**
 * Template For Add to cart
 * 
 * Handles to show buttons
 * when purchase link is inserted in metabox
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/add-to-cart/purchase-link-cart-button.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $addcartbtntext ) return;

?>
<a href="<?php echo $purchaselink;?>" target="_blank"><?php echo apply_filters( 'wps_deals_add_to_cart_purchase_link_text', $addcartbtntext.' '.$displayprice );?> </a>