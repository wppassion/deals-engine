<?php

/**
 * Image template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/image.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	
		
<div class="deals-img">

	<div class="deals-img-flag-big" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	
		<span itemprop="price"><?php echo $price; ?></span>
		<link itemprop="availability" href="http://schema.org/InStock" />
		
	</div>

	<a href="<?php echo $dealurl; ?>" title="<?php echo $dealtitle; ?>">
		<?php if(!empty($dealimgurl)){ ?>
			<img src="<?php echo $dealimgurl; ?>" alt="<?php echo $dealtitle; ?>" title="<?php echo $dealtitle; ?>" width="100%">
		<?php } else {
			echo $dealimg;
		}
		?>
	</a>	
</div>