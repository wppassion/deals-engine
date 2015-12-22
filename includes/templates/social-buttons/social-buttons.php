<?php

/**
 * Home page header saving value box
 * 
 * Handles to show you save value box
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/social-buttons/social-buttons.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post;
?>
<div class="wps-deals-connect-home row-fluid">

	<div class="wps-deals-connect row-fluid">
		<?php 
			
			//do action to load social buttons
			do_action( 'wps_deals_social_buttons' );
		?>
	
	</div><!--wps-deals-connect-->

</div><!--.wps-deals-connect-home-->