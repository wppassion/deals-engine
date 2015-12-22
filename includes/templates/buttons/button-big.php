<?php
/**
 * Big "See Deal" Button Template
 *
 * This is being displayd on the top placed deal on the deals home page.
 *
 * Override this template by copying it to yourtheme/deals-engine/buttons/button-big.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="<?php echo $btncolor; ?> deals-button btn-big deals-col-12">

	<a href="<?php echo $dealurl; ?>">	
		<span>
			<?php echo apply_filters( 'wps_deals_see_deal_big_button', __( 'See Deal ', 'wpsdeals') ); ?>
		</span>
	</a>
	
</div>