<?php

/**
 * Price template for the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/price.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<div class="deals-more-price-box">

	<p class="deals-more-price">
		<del>
			<?php echo $normalprice; ?>
		</del>
	</p>
	
	<p class="deals-more-price-special">
		<span><?php echo $specialprice; ?></span>
	</p>
	
</div>