<?php 

/**
 * Google plus Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social/googleplus.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<a title="<?php _e( 'Connect with Google+', 'wpsdeals');?>" href="javascript:void(0);" class="deals-social-login-gplus">
	<img src="<?php echo $gpiconurl;?>" alt="<?php _e( 'Google+', 'wpsdeals');?>" />
</a>