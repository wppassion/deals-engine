<?php
/**
 * Small "See Deal" Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/buttons/button-small.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="<?php echo $btncolor; ?> deals-button btn-small">

	<a href="<?php echo $dealurl; ?>">	
		<span>
			<?php echo apply_filters( 'wps_deals_see_deal_small_button_text', __( 'See Deal', 'wpsdeals' ) ); ?>
		</span>
	</a>
	
</div>