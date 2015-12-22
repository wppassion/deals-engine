<?php
/**
 * Home Page Header See Deal Button
 *
 * Override this template by copying it to
 * yourtheme/deals-engine/buttons/deal-button-big.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post,$wps_deals_price;

//price class
$price = $wps_deals_price;

//product price
$productprice = $price->wps_deals_get_price($post->ID);

?>
<div class="wps-deals-btn-large row-fluid"><a href="<?php echo get_permalink($post->ID);?>"><?php echo apply_filters('wps_deals_see_deal_big_button', __('See Deal ','wpsdeals').$price->get_display_price( $productprice, $post->ID ) , $price->get_display_price( $productprice, $post->ID ) );?></a></div>