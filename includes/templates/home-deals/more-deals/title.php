<?php

/**
 * Title template for the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/title.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<h3 class="deals-more-title">

	<a href="<?php echo $deallink; ?>">
		<?php echo $dealtitle; ?>
	</a>
	
</h3>