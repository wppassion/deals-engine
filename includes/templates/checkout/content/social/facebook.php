<?php 

/**
 * Facebook Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social/facebook.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
?>

<a title="<?php _e( 'Connect with Facebook', 'wpsdeals');?>" href="javascript:void(0);" class="deals-social-login-facebook">
	<img src="<?php echo $fbiconurl;?>" alt="<?php _e( 'Facebook', 'wpsdeals');?>" />
</a>