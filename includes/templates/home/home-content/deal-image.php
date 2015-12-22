<?php
/**
 * Price Flag Small Template
 * 
 * Handles to show small price flag on 
 * deals image
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/deal-image.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="wps-deal-home-content-img">
	<a href="<?php echo $dealurl;?>" title="<?php echo $dealtitle;?>">
		<img src="<?php echo $dealimg;?>" alt="<?php _e('Deal Image','wpsdeals');?>" />
	</a>
</div><!--.wps-deal-home-content-img-->