<?php 
/**
 * Template for Header Left Part 
 *
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/header-left.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="span6 clearfix">
	<?php
		//do action to add single deal module
		do_action( 'wps_deals_single_header_left' );
	?>
</div><!--.span6-->