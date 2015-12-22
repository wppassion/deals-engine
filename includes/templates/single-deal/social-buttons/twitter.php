<?php

/**
 * Twitter Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/social-buttons/twitter.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>

<div class="deals-twitter deals-col-4" style="width:auto;">

	<div data-id="wpsdealstwbutton_<?php echo $dealid;?>">
	
		<a href="http://twitter.com/share"  data-url="<?php echo $dealurl;?>"  class="twitter-share-button" data-text="<?php echo $dealtitle;?>" data-count="horizontal" data-via="<?php echo $twitteruser;?>"><?php _e( 'Tweet', 'wpsdeals' );?></a>
		
	</div>
	
</div>