<?php 

/**
 * Available & Bought template for the single deal.
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/avail-bought.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
if( $availablebought != 'on' ) :

?>

	<div class="deals-single-avail-bought-box deals-col-12">

		<div class="deals-single-avail-bought">
		
			<div class="deals-row">

			<?php 			
				/**
				 * wps_deals_available_bought hook
				 *
				 * @hooked wps_deals_single_available - 5
				 * @hooked wps_deals_single_bought - 10
				 */
				do_action( 'wps_deals_available_bought' );		
			?>
			
			</div>
		
		</div>
			
	</div>
		
<?php endif; ?>