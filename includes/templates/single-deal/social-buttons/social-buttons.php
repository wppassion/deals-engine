<?php

/**
 * Social Button Template
 *
 * Displays all the activated social sharing buttons.
 * 
 * Override this template by copying it to yourtheme/deals-engine/social-buttons/social-buttons.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post;
?>

<div class="deals-connect deals-col-12">

	<?php 
		/**
		 * wps_deals_social_buttons hook (outputs the social sharing buttons)
		 *
		 * @hooked wps_deals_social_facebook - 10
		 * @hooked wps_deals_social_twitter - 15
		 * @hooked wps_deals_social_google - 20
		 */
		do_action( 'wps_deals_social_buttons' );
	?>	

</div>