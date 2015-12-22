<?php 

/**
 * Template available bought box
 * 
 * Handles to show available deal and bought copy box
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/avail-bought.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post;
	
	if( $availablebought != 'on' ) { ?>
				
		<div class="row-fluid <?php echo $availablebought;?>">
			<?php 
				
				//do action to show available and bought box
				do_action( 'wps_deals_available_bought' );
				
			?>
		</div>
		
<?php } ?>