<?php

/**
 * Excerpt template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/excerpt.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<section>

	<div class="deals-excerpt" itemprop="description">
		<?php the_excerpt(); ?>
	</div>
		
</section>