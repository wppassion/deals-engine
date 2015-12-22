<?php

/**
 * Image template for the more Deals on the Deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/home-deals/more-deals/image.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<div class="deals-more-content-img">
	
	<a href="<?php echo $dealurl; ?>" title="<?php echo $dealtitle; ?>">
		<?php if(!empty($dealmainimg)) { ?>
			<img src="<?php echo $dealmainimg; ?>" alt="<?php echo $dealtitle; ?>">
		<?php } else {
			echo $dealimg ; 
		}?>
		
	</a>

</div>
