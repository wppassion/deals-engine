<?php 

/**
 * Change Password Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/change-password.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message;

if ( $wps_deals_message->size( 'changeaccountdetail' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo '<div class="deals-multierror">';
	echo 	$wps_deals_message->output( 'changeaccountdetail' );
	echo '</div>';
}


$submit_label = __( 'Change Account Detail', 'wpsdeals' );
			
?>
	
<div class="deals-message deals-error deals-change-password-error"></div>
	
<form action="" method="POST">
	<div class="deals-change-password-wrapper deals-clearfix">
		<div class="deals-change-password-fields-container deals-fields-container">
				
			<?php
			if( !empty( $wps_deals_reset_key ) && !empty( $wps_deals_reset_login ) ) : ?>							
				<p class="deals-user-details">
					<?php echo __( 'Enter a new password below.', 'wpsdeals' ); ?>
				</p>				
			<?php endif; ?>
			
			<?php 
			global $current_user;
	      	$email=$current_user->user_email . "\n";
			$firstname=$current_user->first_name . "\n";
	      	$lastname=$current_user->last_name . "\n"; ?>
		
			<div class="deals-user-details deals-firstname">
				<p>
					<label for="deals_firstname"><?php _e( 'First name','wpsdeals' ); ?><span class="required">*</span></label>
					<input type="text" name="wps_deals_firstname" id="deals_firstname" class="deals-required-field" value="<?php if(isset($firstname)){ echo $firstname; } ?>">
				</p>
			</div>	
			
			<div class="deals-user-details deals-lastname">
				<p>
					<label for="deals_lastname"><?php _e( 'Last name','wpsdeals' ); ?><span class="required">*</span></label>
					<input type="text" name="wps_deals_lastname" id="deals_lastname" class="deals-required-field" value="<?php if(isset($lastname)){ echo $lastname; } ?>">
				</p>
			</div>
				
			<div class="deals-user-details deals-email-address">
				<p>
					<label for="deals_email_address"><?php _e( 'Email address','wpsdeals' ); ?><span class="required">*</span></label>
					<input type="text" name="wps_deals_email_address" id="deals_email_address" class="deals-required-field" value="<?php if(isset($email)){ echo $email; } ?>">
				</p>
			</div>
			
			<p><strong><?php echo __('Change Password', 'wpsdeals'); ?></strong></p>
			<div class="deals-user-details deals-current-password">
				<p>
					<label for="deals_current_password"><?php _e( 'Current password (leave blank to leave unchanged)','wpsdeals' ); ?></label>
					<input type="password" name="wps_deals_current_password" id="deals_current_password" class="deals-required-field">
				</p>
			</div>
				
			<div class="deals-user-details deals-new-password">
				<p>
					<label for="deals_new_password"><?php _e( 'New password (leave blank to leave unchanged)','wpsdeals' ); ?></label>
					<input type="password" name="wps_deals_new_password" id="deals_new_password" class="deals-required-field">
				</p>
			</div>
				
			<div class="deals-user-details deals-re-new-password">
				<p>
					<label for="deals_re_enter_password"><?php echo _e( 'Re-enter new password','wpsdeals' ); ?></label>
					<input type="password" name="wps_deals_re_enter_password" id="deals_re_enter_password" class="deals-required-field">
				</p>
			</div>
				
			<?php
			if( !empty( $wps_deals_reset_key ) && !empty( $wps_deals_reset_login ) ) :
				$submit_label = __( 'Reset Password', 'wpsdeals' ); ?>
				
			    <input type="hidden" name="wps_deals_reset_key" value="<?php echo $wps_deals_reset_key; ?>">
			    <input type="hidden" name="wps_deals_reset_login" value="<?php echo $wps_deals_reset_login; ?>">
			<?php endif; ?>
		</div>
	</div>
	
	<div class="deals-change-password-wrapper">
		<p class="deals-form-submit">
			<input type="submit" name="wps_deals_change_password" class="button deals-change-password-btn" value="<?php echo $submit_label; ?>">
		</p>
	</div>
		
</form>