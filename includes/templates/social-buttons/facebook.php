<?php

/**
 * Home page social button facebook
 * 
 * Handles to show facebook like button
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/social-buttons/facebook.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>
<div id="fb-root"></div>
<div class="wps-deals-connect-buttons">
	<div class="fb-like" id="wpsdealsfblikebutton_<?php echo $dealid;?>" href="<?php echo $dealurl;?>" data-send="false" data-layout="button_count" data-width="100%" data-show-faces="false" data-font="arial"></div>
</div>