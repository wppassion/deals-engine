<?php
/**
 * Home header deal content
 * 
 * Handles to show home header deal content
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-header/header-content.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	
	<div class="span8">
	
		<div class="wps-deals-left-header">
			<h1><?php echo $dealtitle;?></h1>
		</div><!--wps-deals-left-header-->
		
		<div class="wps-deals-header-img">

			<div class="wps-deals-img-flag"><?php echo $price;?></div>
				<a href="<?php echo $dealurl;?>" title="<?php $dealtitle;?>">
					<img src="<?php echo $imgurl;?>" alt="<?php _e('Deal Image','wpsdeals');?>" />
				</a>
		</div><!--.wps-deals-header-img-->
			
		<div class="wps-deals-text">
			<p><?php echo $description;?></p>
		</div><!--wps-deals-text-->
		
	</div><!--span8-->