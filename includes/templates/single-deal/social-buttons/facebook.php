<?php

/**
 * Facebook Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/social-buttons/facebook.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>

<div id="fb-root"></div>
<div class="deals-facebook deals-col-4">

	<div class="fb-like" id="wpsdealsfblikebutton_<?php echo $dealid;?>" href="<?php echo $dealurl;?>" data-send="false" data-layout="button_count" data-width="100%" data-show-faces="false" data-font="arial">
	</div>
	
</div>