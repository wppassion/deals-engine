<?php

/**
 * Title template for the top placed Deal on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/header/title.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<div class="deals-row">

	<header class="deals-col-12">
				
		<h2 class="deals-title" itemprop="name">
			<?php echo $dealtitle; ?>
		</h2>
		
	</header>
	
</div>