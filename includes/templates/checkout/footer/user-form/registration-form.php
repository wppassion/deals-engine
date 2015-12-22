<?php 

/**
 * Registration Form Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/user-form/registration-form.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options;

$optiontext = empty($wps_deals_options['disable_guest_checkout']) ? '(optional)' : '';

?>	

<div class="deals-registration-wrapper deals-clearfix">

	<span><?php _e('Already have an account?','wpsdeals');?>

		<?php echo apply_filters( 'wps_deals_cart_login_link','<a href="javascript:void(0);" class="deals-login-link">'.__('Login','wpsdeals').'</a>');?>
	</span>
	
	<div class="deals-registration-form checkout-fields-container">

		<h2>
			<?php echo apply_filters( 'wps_deals_cart_create_account_label', __('Create an account '.$optiontext,'wpsdeals'));?>
		</h2>
			
		<?php
			/**
			 * wps_deals_checkout_reg_form_before hook
			 */
			do_action( 'wps_deals_checkout_reg_form_before' );
		?>
					
		<div class="deals-user-details deals-username">
			<p>
				<label for="deals_cart_reg_user_name"><?php echo apply_filters( 'wps_deals_cart_username_label',__('Username','wpsdeals'));?></label>
				<input type="text" name="wps_deals_cart_reg_user_name" id="deals_cart_reg_user_name" class="deals-required-field">
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_cart_reg_form_username_after hook
			 */
			do_action( 'wps_deals_cart_reg_form_username_after' );
		?>

		<div class="deals-user-details deals-password">
			<p>
				<label for="deals_cart_reg_user_pass"><?php  echo apply_filters( 'wps_deals_cart_password_label', __('Password','wpsdeals'));?></label>
				<input type="password" name="wps_deals_cart_reg_user_pass" id="deals_cart_reg_user_pass" class="deals-required-field">
			</p>
		</div>

		<?php
			/**
			 * wps_deals_checkout_reg_form_pass_after hook
			 */
			do_action( 'wps_deals_checkout_reg_form_pass_after' );
		?>		

		<div class="deals-user-details deals-confirm-password">
			<p>
				<label for="deals_cart_reg_user_confirm_pass"><?php  echo apply_filters( 'wps_deals_cart_confirm_password_label',__('Confirm Password','wpsdeals'));?></label>
				<input type="password" name="wps_deals_cart_reg_user_confirm_pass" id="deals_cart_reg_user_confirm_pass" class="deals-required-field">
			</p>
		</div>

		<?php
			/**
			 * wps_deals_checkout_reg_form_after hook
			 */
			do_action( 'wps_deals_checkout_reg_form_after' );
		?>	

	</div>
	
</div>