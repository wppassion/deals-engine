<?php 

/**
 * Login Form Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/user-form/login-form.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-login-form-wrapper deals-clearfix">

	<div class="deals-login-form checkout-fields-container">
	
		<h2><?php echo apply_filters( 'wps_deals_cart_login_account_label', __('Login to your account?','wpsdeals'));?></h2>
		
		<?php
			/**
			 * wps_deals_checkout_login_form_before hook
			 */
			do_action( 'wps_deals_checkout_login_form_before' );
		?>
		
		<div class="deals-user-details deals-username">
			<p>
				<label for="deals_cart_login_user_name">
					<?php echo apply_filters( 'wps_deals_cart_username_label',__('Username','wpsdeals'));?>
				</label>
				
				<input type="text" name="wps_deals_cart_login_user_name" id="deals_cart_login_user_name" class="deals-required-field">
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_login_form_username_after hook
			 */
			do_action( 'wps_deals_checkout_login_form_username_after' );
		?>	
		
		<div class="deals-user-details deals-password">
			<p>
				<label for="deals_cart_login_user_pass">
					<?php echo apply_filters( 'wps_deals_cart_password_label', __('Password','wpsdeals'));?>
				</label>
				
				<input type="password" name="wps_deals_cart_login_user_pass" id="deals_cart_login_user_pass" class="deals-required-field">
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_login_form_after hook
			 */
			do_action( 'wps_deals_checkout_login_form_after' );
		?>
		
	</div>
	
	<p>
		<?php _e('Need to create an account? ','wpsdeals' );?>
			
		<a href="javascript:void(0);" class="deals-class-reg-link">
			<?php _e('Register or checkout as a guest.','wpsdeals');?>
		</a>
	</p>
			
</div>