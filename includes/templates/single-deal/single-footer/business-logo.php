<?php 

/**
 * Template Business Logo
 * 
 * Handles to show business logo
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-footer/business-logo.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="span6">
	<img src="<?php echo $imgurl;?>" alt="<?php _e('Logo','wpsdeals');?>" />
</div>