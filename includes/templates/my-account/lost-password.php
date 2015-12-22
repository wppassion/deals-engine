<?php 

/**
 * Lost Password Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/lost-password.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message;

if ( $wps_deals_message->size( 'lostpassword' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo $wps_deals_message->output( 'lostpassword' );
}

if ( $wps_deals_message->size( 'lostpasswordsuccess' ) > 0 ) {
	// if we need to display the error message, we will do it here
	echo $wps_deals_message->output( 'lostpasswordsuccess' );
}

?>
	
<div class="deals-message deals-error deals-lost-password-error"></div>
	
<form action="" method="POST">
	
	<div class="deals-reset-password-wrapper deals-clearfix">
		
		<div class="deals-reset-password-fields-container">
				
			<div class="deals-user-details lost-password-info">
				<p>
					<?php echo apply_filters( 'wps_deals_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'wpsdeals' ) ); ?>
				</p>
			</div>
				
			<div class="deals-user-details username-name">
				<p>
					<label for="deals_user_email"><?php echo _e( 'Username or email','wpsdeals' ); ?></label>
					<input type="text" name="wps_deals_user_email" id="deals_user_email" class="deals-required-field">
				</p>
			</div>
				
		</div>
			
	</div>
	
	<div class="deals-reset-password-wrapper">
		
		<p class="deals-form-submit">
			<input type="submit" name="wps_deals_reset_password" class="button deals-reset-password-btn" value="<?php _e( 'Reset Password', 'wpsdeals' ) ?>">
		</p>
			
	</div>
		
</form>