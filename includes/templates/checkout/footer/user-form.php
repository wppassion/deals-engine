<?php 

/**
 * User Login Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/user-form.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-user-form">

	<?php	
		/**
		 * wps_deals_cart_user_form_content hook
		 *
		 * @hooked wps_deals_cart_user_reg_form - 5
		 * @hooked wps_deals_cart_user_login_form - 10
		 */
		do_action( 'wps_deals_cart_user_form_content' );
	?>			
	
</div>