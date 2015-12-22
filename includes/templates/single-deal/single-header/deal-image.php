<?php 

/**
 * Template Single Deal Image
 * 
 * Handles to show Single Deal Image
 * deal view page
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/deal-image.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="span6 wps-deals-desc-img">
	<div class="wps-deals-img-flag"><?php echo $price;?></div>
	<?php echo $dealimg;?>
</div><!--span6-->