<?php
/**
 * Single Deal Description Template
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-content/description.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post;	

?>
<div itemprop="description" class="wps-deals-product-desc"><?php the_content();?></div><!--wps-deals-product-desc-->