<?php 

/**
 * Order Cancel Details Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/orders/order-cancel-details.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

?>

<p class="deals-order-cancelled">
	<?php 
 		echo apply_filters('wps_deals_cancel_order_message',__('Sorry, your order has been cancelled.','wpsdeals'));
 	?>
</p>