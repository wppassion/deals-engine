<?php 

/**
 * Create An Account Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/create-account.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message;

if ( $wps_deals_message->size( 'register' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo '<div class="deals-multierror">';
	echo 	$wps_deals_message->output( 'register' );
	echo '</div>';
}
	
?>

<div class="deals-message deals-error deals-register-error"></div>

<form action="" method="post" enctype="multipart/form-data" >
	
	<div class="deals-register-wrapper deals-row deals-clearfix">
	
		<div class="deals-fields-container deals-col-12">
				
			<?php
				/**
				 * wps_deals_reg_form_before hook
				 */
				do_action( 'wps_deals_reg_form_before' );
			?>
			
			<div class="deals-user-details deals-username">
				<p>
					<label for="deals_user_name"><?php _e( 'Username', 'wpsdeals' ); ?></label>
					<input type="text" id="deals_reg_user_name" name="wps_deals_reg_user_name" class="deals-required-field" value="<?php echo $wps_deals_reg_user_name; ?>">
				</p>
			</div>
			
			<?php
				/**
				 * wps_deals_reg_form_username_after hook
				 */
				do_action( 'wps_deals_reg_form_username_after' );
			?>
			
			<div class="deals-user-details deals-user-fname">
				<p>
					<label for="deals_reg_user_firstname"><?php _e( 'First Name', 'wpsdeals' ); ?></label>
					<input type="text" id="deals_reg_user_firstname" name="wps_deals_reg_user_firstname" class="deals-required-field" value="<?php echo $wps_deals_reg_user_firstname; ?>">
				</p>
			</div>
			
			<?php
				/**
				 * wps_deals_reg_form_first_name_after hook
				 */
				do_action( 'wps_deals_reg_form_first_name_after' );
			?>
			
			<div class="deals-user-details deals-user-lname">
				<p>
					<label for="deals_reg_user_lastname"><?php _e( 'Last Name', 'wpsdeals' ); ?></label>
					<input type="text" id="deals_reg_user_lastname" name="wps_deals_reg_user_lastname" class="deals-required-field" value="<?php echo $wps_deals_reg_user_lastname; ?>">
				</p>
			</div>
			
			<?php
				/**
				 * wps_deals_reg_form_last_name_after hook
				 */
				do_action( 'wps_deals_reg_form_last_name_after' );
			?>
			
			<div class="deals-user-details deals-user-email">
				<p>
					<label for="deals_reg_user_email"><?php _e( 'Email', 'wpsdeals' ); ?></label>
					<input type="text" id="deals_reg_user_email" name="wps_deals_reg_user_email" class="deals-required-field" value="<?php echo $wps_deals_reg_user_email; ?>">
				</p>
			</div>
			
			<?php
				/**
				 * wps_deals_reg_form_email_after hook
				 */
				do_action( 'wps_deals_reg_form_email_after' );
			?>
			
			<div class="deals-user-details deals-user-pw">
				<p>
					<label for="deals_reg_user_pass"><?php _e( 'Password', 'wpsdeals' ); ?></label>
					<input type="password" id="deals_reg_user_pass" name="wps_deals_reg_user_pass" class="deals-required-field">
				</p>
			</div>
			
			<?php
				/**
				 * wps_deals_reg_form_pass_after hook
				 */
				do_action( 'wps_deals_reg_form_pass_after' );
			?>
			
			<div class="deals-user-details deals-user-cpw">
				<p>
					<label for="deals_reg_user_confirm_pass"><?php _e( 'Confirm Password', 'wpsdeals' ); ?></label>
					<input type="password" id="deals_reg_user_confirm_pass" name="wps_deals_reg_user_confirm_pass" class="deals-required-field">
				</p>
			</div>
			
			<?php
				/**
				 * wps_deals_reg_form_after hook
				 */
				do_action( 'wps_deals_reg_form_after' );
			?>
		</div>
		
	</div>
	
	<div class="deals-register-wrapper">
	
		<p class="deals-form-submit">
			<input type="submit" class="button deals-register-button" name="wps_deals_register_submit" id="wps_deals_register_submit" value="<?php _e( 'Register', 'wpsdeals' ); ?>">
		</p>
		
		<p class="deals-login-link">
			<a href="<?php echo $loginlink; ?>"><?php _e( 'Login', 'wpsdeals' ); ?></a>
		</p>
		
	</div>
		
</form>