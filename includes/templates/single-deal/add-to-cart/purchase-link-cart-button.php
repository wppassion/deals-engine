<?php 

/**
 * Direct Purchase Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/single-deal/add-to-cart/purchase-link-cart-button.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $addcartbtntext ) return;

?>
<div class="<?php echo $btncolor; ?> deals-button btn-big deals-col-12">

	<a href="<?php echo $purchaselink;?>" target="_blank">
		<?php echo apply_filters( 'wps_deals_add_to_cart_purchase_link_text', $addcartbtntext );?> 
	</a>
	
</div>