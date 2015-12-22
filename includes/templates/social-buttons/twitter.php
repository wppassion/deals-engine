<?php

/**
 * Home page social button twitter
 * 
 * Handles to show twitter button
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/social-buttons/twitter.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>
<div class="wps-deals-connect-buttons twitter">
	<div data-id="wpsdealstwbutton_<?php echo $dealid;?>">
		<a href="http://twitter.com/share"  data-url="<?php echo $dealurl;?>"  class="twitter-share-button" data-text="<?php echo $dealtitle;?>" data-count="horizontal" data-via="<?php echo $twitteruser;?>"><?php _e( 'Tweet', 'wpsdeals' );?></a>
	</div>
</div>