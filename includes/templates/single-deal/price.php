<?php 

/**
 * Price Template
 *
 * Override this template by copying it to yourtheme/deals-engine/single-deal/price.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-price-single deals-col-12" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="deals-price">
		<span itemprop="price">
			<?php echo $dealprice; ?>
		</span>
	</p>
	
	<link itemprop="availability" href="http://schema.org/InStock" />
	
</div>