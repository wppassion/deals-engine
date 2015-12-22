<?php
/**
 * No Deals Found Message For home
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/home-no-deals.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-no-deals"><?php echo apply_filters( 'wps_deals_home_no_deals_message',__( 'No deals found','wpsdeals' ) );?></div>