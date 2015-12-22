<?php 

/**
 * Checkout Personal Details Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/personal-details.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $current_user;

//get the user email address from site
if(is_user_logged_in()) { //check user is logged in to site		
	$useremail = $current_user->user_email;
	$firstname = $current_user->user_firstname;
	$lastname = $current_user->user_lastname;		
} else { 		
	$useremail = '';
	$firstname = '';
	$lastname = '';		
}

?>

<div class="deals-guest-wrapper deals-clearfix">

	<div class="deals-guest-details checkout-fields-container">
	
		<h2><?php echo apply_filters( 'wps_deals_cart_personal_detail_title',__('Personal Details','wpsdeals'));?></h2>
		
		<?php
			/**
			 * wps_deals_checkout_personal_details_before hook
			 */
			do_action( 'wps_deals_checkout_personal_details_before' );
		?>
		
		<div class="deals-user-details deals-email">
			<p>
				<label for="deals_cart_user_email">
					<?php echo apply_filters( 'wps_deals_cart_email_label',__('Email Address','wpsdeals'));?>
				</label>
				
				<input type="text" name="wps_deals_cart_user_email" id="deals_cart_user_email" value="<?php echo $useremail;?>"  class="deals-required-field"/>
			</p>
		</div>

		<?php
			/**
			 * wps_deals_checkout_personal_details_email_after hook
			 */
			do_action( 'wps_deals_checkout_personal_details_email_after' );
		?>
		
		<div class="deals-user-details deals-fname">
			<p>
				<label for="deals_cart_user_first_name">
					<?php echo apply_filters( 'wps_deals_cart_firstname_label', __('First Name','wpsdeals'));?>
				</label>
			
				<input type="text" name="wps_deals_cart_user_first_name" id="deals_cart_user_first_name" value="<?php echo $firstname;?>" class="deals-required-field"/>
			</p>
		</div>

		
		<?php
			/**
			 * wps_deals_checkout_personal_details_firstname_after hook
			 */
			do_action( 'wps_deals_checkout_personal_details_firstname_after' );
		?>
		
		<div class="deals-user-details deals-lname">
			<p>
				<label for="deals_cart_user_last_name">
					<?php echo apply_filters( 'wps_deals_cart_lastname_label',__('Last Name','wpsdeals'));?>
				</label>
				
				<input type="text" name="wps_deals_cart_user_last_name" id="deals_cart_user_last_name" value="<?php echo $lastname;?>" class="deals-required-field"/>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_personal_details_after hook
			 */
			do_action( 'wps_deals_checkout_personal_details_after' );
		?>
		
	</div>
	
</div>