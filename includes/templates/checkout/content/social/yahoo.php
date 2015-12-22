<?php 

/**
 * Yahoo Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social/yahoo.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<a title="<?php _e( 'Connect with Yahoo', 'wpsdeals');?>" href="javascript:void(0);" class="deals-social-login-yahoo">
	<img src="<?php echo $yhiconurl;?>" alt="<?php _e( 'Yahoo', 'wpsdeals');?>" />
</a>