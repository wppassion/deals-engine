<?php 

/**
 * Windows Live Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social/windowslive.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	
?>

<a title="<?php _e( 'Connect with Windows Live', 'wpsdeals');?>" href="javascript:void(0);" class="deals-social-login-windowslive">
	<img src="<?php echo $wliconurl;?>" alt="<?php _e( 'Windows Live', 'wpsdeals');?>" />
</a>