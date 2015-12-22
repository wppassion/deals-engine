<?php 

/**
 * Template Business Title
 * 
 * Handles to show business title
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-footer/business-title.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( empty( $businesstitle ) ) return;

?>

<p class="wps-deals-business-title span12"><?php echo $businesstitle;?></p>