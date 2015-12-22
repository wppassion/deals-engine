<?php 

/**
 * Linkedin Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social/linkedin.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<a title="<?php _e( 'Connect with LinkedIn', 'wpsdeals');?>" href="javascript:void(0);" class="deals-social-login-linkedin">
	<img src="<?php echo $liiconurl;?>" alt="<?php _e( 'LinkedIn', 'wpsdeals');?>" />
</a>