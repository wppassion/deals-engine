<?php
/**
 * The template for displaying product content in the footer.php template
 * 
 * Override this template by copying it to yourtheme/deals-engine/content-single-deal.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

	<div class="wps-bottom-add-to-cart-button deals-row">
		<div class="deals-product-btn wps-bottom-add-to-cart-button-inner">
			<?php
			
			/**
			 * wps_deals_single_footer_content hook
			 */
			do_action( 'wps_deals_single_footer_add_to_cart' );
			?>
		</div>
	</div>