<?php 

/**
 * Dime Sale Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/dime-sale.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( empty( $lefttext ) ) {
	return;
}

?>

<div class="deals-dime-sale-single deals-col-12">

	<p class="deals-dime-sale-title">
		<?php echo $lefttext; ?>
	</p>
	
</div>