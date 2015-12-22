<?php 

/**
 * Template available copy box
 * 
 * Handles to show available deal and bought copy box
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-header/avail-bought/bought.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-product-div span7 wps-deals-product-bought">
	<img src="<?php echo WPS_DEALS_URL.'includes/images/man-icon.png';?>" alt="<?php _e('Bought','wpsdeals' );?>" />
	<p><?php echo apply_filters( 'wps_deals_bought_text',__( 'Bought: <span class="wps-deals-orange-font">'.$bought.'</span>','wpsdeals'), $bought) ;?></p>
</div>