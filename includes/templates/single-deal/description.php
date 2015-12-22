<?php

/**
 * Single Deal Description Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/description.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div itemprop="description" class="deals-description">

	<?php the_content();?>
	
</div>