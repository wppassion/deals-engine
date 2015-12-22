<?php 

/**
 * My Account Login Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/login.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_message;

?>

<?php
	if ( $wps_deals_message->size( 'login' ) > 0 ) {
		// if we need to display the error message, we will do it here
		echo '<div class="deals-multierror">';
		echo 	$wps_deals_message->output( 'login' );
		echo '</div>';
	}
?>
	
<div class="deals-message deals-error deals-login-error"></div>
	
<form action="" method="post" enctype="multipart/form-data">
				
	<div class="deals-user-details deals-new-password">
		<p>
			<label for="deals_user_name"><?php _e( 'User Name', 'wpsdeals' ); ?></label>
			<input type="text" id="deals_user_name" name="wps_deals_user_name" class="deals-required-field">
		</p>
	</div>
		
	<div class="deals-user-details deals-new-password">
		<p>
			<label for="deals_user_pass"><?php _e( 'Password', 'wpsdeals' ); ?></label>
			<input type="password" id="deals_user_pass" name="wps_deals_user_pass" class="deals-required-field">
		</p>
	</div>
	
	<div class="deals-login-wrapper">
		<?php if( !empty( $registerlink ) ) { ?>
			<p class="deals-register"><a href="<?php echo $registerlink; ?>" class="deals-register-link"><?php _e( 'Register', 'wpsdeals' ); ?></a></p>
		<?php } ?>
		
		<p class="deals-form-submit">
			<input type="submit" class="button deals-login-submit-btn" name="wps_deals_login_submit" id="wps_deals_login_submit" value="<?php _e( 'Login', 'wpsdeals' ); ?>">
			<label for="deals_remember">
				<input type="checkbox" name="wps_deals_remember" id="deals_remember" value="1"><?php _e( 'Remember me', 'wpsdeals' ); ?>
			</label>
		</p>

		<p class="deals-lost-password">
			<a href="<?php echo $lostpasswordlink; ?>"><?php _e( 'Lost Password?', 'wpsdeals' ); ?></a>
		</p>

	</div>

</form>