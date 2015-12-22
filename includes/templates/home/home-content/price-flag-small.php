<?php
/**
 * Price Flag Small Template
 * 
 * Handles to show small price flag on 
 * deals image
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/home/home-content/price-flag-small.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
?>
<div class="wps-deals-img-flag-small">
	<?php echo $displayprice;?>
</div><!--.wps-deals-img-flag-small-->