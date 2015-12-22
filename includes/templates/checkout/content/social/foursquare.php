<?php 

/**
 * Foursquare Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social/foursquare.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<a title="<?php _e( 'Connect with Foursquare', 'wpsdeals');?>" href="javascript:void(0);" class="deals-social-login-foursquare">
	<img src="<?php echo $fsiconurl;?>" alt="<?php _e( 'Foursquare', 'wpsdeals');?>" />
</a>