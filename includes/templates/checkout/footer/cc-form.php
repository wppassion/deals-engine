<?php 

/**
 * Credit Card Form Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/cc-form.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>
	
<div class="deals-credit-card-wrapper deals-clearfix">
			
	<h2><?php echo apply_filters( 'wps_deals_cc_info_title',__('Credit Card Info','wpsdeals'));?></h2>
			
	<?php if( is_ssl() ) : ?>
				
		<div id="deals_secure_site_wrapper">
			<span class="padlock"></span>
			<p><?php _e( 'This is a secure SSL encrypted payment.', 'wpsdeals' ); ?></p>
		</div>
				
	<?php endif; ?>
			
	<div id="deals_cc_number_wrap" class="deals-user-details deals-cc-number">
		<p>
			<label for="deals_card_number">
				<?php echo apply_filters( 'wps_deals_cc_number_label',__('Card Number','wpsdeals'));?>
				<span class="deals-cc-required">*</span>
				<span class="card-type"></span>
			</label>

			<input type="text" autocomplete="off" name="wps_deals_card_number" id="deals_card_number" class="deals-card-number deals-cart-text" placeholder="<?php _e( 'Card number', 'wpsdeals' ); ?>">
			
			<span class="deals-cc-description">
				<?php _e( 'The (typically) 16 digits on the front of your credit card.', 'wpsdeals' ); ?>
			</span>
		</p>		
	</div>
	
	<div id="deals_cc_cvc_wrap" class="deals-user-details deals-cc-cvc">
		<p>
			<label for="deals_card_cvc">
				<?php echo apply_filters( 'wps_deals_csv_number_label',__('CVC','wpsdeals'));?>
				<span class="deals-cc-required">*</span>
			</label>
			
			<input type="text" size="4" autocomplete="off" name="wps_deals_card_cvc" id="deals_card_cvc" class="deals-card-cvc deals-cart-text" placeholder="<?php _e( 'Security code', 'wpsdeals' ); ?>">
			
			<span class="deals-cc-description">
				<?php _e( 'The 3 digit (back) or 4 digit (front) value on your card.', 'wpsdeals' ); ?>
			</span>
		</p>
	</div>

	<div id="deals_cc_name_wrap" class="deals-user-details deals-cc-holder">
		<p>
			<label for="deals_card_name">
				<?php echo apply_filters( 'wps_deals_cc_name_label',__('Name on the Card','wpsdeals'));?>
				<span class="deals-cc-required">*</span>
			</label>

			<input type="text" autocomplete="off" name="wps_deals_card_name" id="deals_card_name" class="deals-card-name deals-cart-text" placeholder="<?php _e( 'Card name', 'wpsdeals' ); ?>">
			
			<span class="deals-cc-description">
				<?php _e( 'The name printed on the front of your credit card.', 'wpsdeals' ); ?>
			</span>
		</p>
	</div>
			
	<?php 
		/**
		 * wps_deals_before_cc_expiration hook
		 */
		do_action( 'wps_deals_before_cc_expiration' ); 
	?>
			
	<div id="deals_cc_expiration_wrap" class="deals-user-details card-expiration">
		<p>
			<label for="deals_card_exp_month">
				<?php echo apply_filters( 'wps_deals_cc_expire_label',__('Expiration (MM/YY)','wpsdeals'));?>
				<span class="deals-cc-required">*</span>
			</label>
			
			<select name="wps_deals_card_exp_month" id="deals_card_exp_month" class="deals-card-expiry-month deals-cc-select deals-cart-select">
				<?php for( $i = 1; $i <= 12; $i++ ) { echo '<option value="' . $i . '" '.selected( date('m'), sprintf ('%02d', $i ), false ).'>' . sprintf ('%02d', $i ) . '</option>'; } ?>
			</select>
			
			<span class="exp-divider"> / </span>
			<select name="wps_deals_card_exp_year" id="deals_card_exp_year" class="deals-card-expiry-year deals-cc-select deals-cart-select">
				<?php for( $i = date('Y'); $i <= date('Y') + 10; $i++ ) { echo '<option value="' . $i . '">' . substr( $i, 2 ) . '</option>'; } ?>
			</select>

			<span class="deals-cc-description">
				<?php _e( 'The date your credit card expires, typically on the front of the card.', 'wpsdeals' ); ?>
			</span>
		</p>
	</div>
			
	<?php 
		/**
		 * wps_deals_cc_expiration_after hook
		 */
		do_action( 'wps_deals_cc_expiration_after' ); 
	?>
			
</div>