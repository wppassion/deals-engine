<?php 

/**
 * Billing Details Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/billing-details.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//.deals-address-container need to add because country state ajax will work proper

?>

<div class="deals-billing-details-wrapper deals-clearfix deals-address-container">

	<div class="deals-billing-details checkout-fields-container">
		
		<h2><?php echo apply_filters( 'wps_deals_cart_billing_detail_title',__('Billing Details','wpsdeals'));?></h2>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_before hook
			 */
			do_action( 'wps_deals_checkout_billing_details_before' );
		?>
		
		<div class="deals-user-details deals-country">
			<p>
				<label for="deals_billing_details_country"><<?php echo apply_filters( 'wps_deals_billing_country_label',__( 'Country','wpsdeals' ) );?></p></label>
			
				<select name="wps_deals_billing_details[country]" id="deals_billing_details_country" class="deals-cart-select deals-required billing-country deals-country-combo">
					<option value=""><?php _e( 'Select your Country&hellip;', 'wpsdeals' );?></option>
					<?php
						foreach ( $countries as $coukey => $country ) {
					?>
							<option value="<?php echo $country['country_code'];?>" <?php selected( $usercountry, $country['country_code'], true);?>><?php echo $country['country_name']; ?></option>
					<?php
						}
					?>
				</select>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_country_after hook
			 */
			do_action( 'wps_deals_checkout_billing_details_country_after' );
		?>
		
		<div class="deals-user-details deals-company">
			<p>
				<label for="deals_billing_details_company"><?php echo apply_filters( 'wps_deals_billing_company_label',__( 'Company Name','wpsdeals' ) );?></label>
				
				<input type="text" name="wps_deals_billing_details[company]" id="deals_billing_details_company" value="<?php echo $usercompany;?>" class="deals-cart-text" placeholder="<?php _e( 'Company Name', 'wpsdeals' );?>"/>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_company_after hook
			 */
			do_action( 'wps_deals_checkout_billing_details_company_after' );
		?>
		
		<div class="deals-user-details deals-address">
			<p>
				<label for="deals_billing_details_address1"><?php echo apply_filters( 'wps_deals_billing_address_label',__( 'Address','wpsdeals' ) );?></label>

				<input type="text" name="wps_deals_billing_details[address1]" id="deals_billing_details_address1" value="<?php echo $useraddress1;?>" class="deals-cart-text deals-required" placeholder="<?php _e( 'Address Line 1', 'wpsdeals' );?>"/>
			</p>
			<p>
				<input type="text" name="wps_deals_billing_details[address2]" id="deals_billing_details_address2" value="<?php echo $useraddress2;?>" class="deals-cart-text" placeholder="<?php _e( 'Address Line 2 (optional)', 'wpsdeals' );?>"/>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_address_after hook
			 */
			do_action( 'wps_deals_checkout_billing_details_address_after' );
		?>
		
		<div class="deals-user-details deals-town">
			<p>
				<label for="deals_billing_details_city"><?php echo apply_filters( 'wps_deals_billing_city_label',__( 'Town / City','wpsdeals' ) );?></label>
				
				<input type="text" name="wps_deals_billing_details[city]" id="deals_billing_details_city" value="<?php echo $usercity;?>" class="deals-cart-text deals-required" placeholder="<?php _e( 'Town / City', 'wpsdeals' );?>"/>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_city_after hook
			 */
			do_action( 'wps_deals_checkout_billing_details_city_after' );
		?>
		
		<div class="deals-user-details deals-state">
			<p>
				<label for="deals_billing_details_state"><?php echo apply_filters( 'wps_deals_billing_state_label',__( 'County / State','wpsdeals' ) ); ?></label>

				<?php  //make state combo HTML as below to work country ajax proper from main plugin ?>
				<span class="deals-state-field">
				
					<?php 	//check states not empty
							if( !empty( $statelist ) &&  is_array( $statelist ) ) {
					?>			
								<select name="wps_deals_billing_details[state]" id="deals_billing_details_state" class="deals-cart-select deals-required billing-country deals-state-combo">
									<option value=""><?php _e( 'Select State / County&hellip;', 'wpsdeals' );?></option>
					<?php			foreach ( $statelist as $statekey => $state ) {
										echo '<option value="'.$statekey.'" '.selected( $userstate, $statekey, false ).'>'.$state.'</option>';
									} //end loop
					?>			</select>
					<?php	} else { ?>
								<input type="text" name="wps_deals_billing_details[state]" id="deals_billing_details_state" value="<?php echo $userstate;?>" class="deals-cart-text deals-required deals-state-combo" placeholder="<?php _e( 'State / County', 'wpsdeals' );?>"/>			
					<?php	}	?>
					
				</span>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_state_after hook
			 */
			do_action( 'wps_deals_checkout_billing_details_state_after' );
		?>
		
		<div class="deals-user-details deals-zip">
			<p>
				<label for="deals_billing_details_postcode"><?php echo apply_filters( 'wps_deals_billing_postcode_label',__( 'Zip / Postal Code','wpsdeals' ) ); ?></label>
				
				<input type="text" name="wps_deals_billing_details[postcode]" id="deals_billing_details_postcode" value="<?php echo $userpostcode;?>" class="deals-cart-text deals-required" placeholder="<?php _e( 'Postcode / Zip', 'wpsdeals' );?>"/>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_postcode_after hook
			 */
			do_action( 'wps_deals_checkout_billing_details_postcode_after' );
		?>
		<div class="deals-user-details deals-phone">
			<p>
				<label for="deals_billing_details_phone"><?php echo apply_filters( 'wps_deals_billing_phone_label',__( 'Phone','wpsdeals' ) );?></label>
				
				<input type="text" name="wps_deals_billing_details[phone]" id="deals_billing_details_phone" value="<?php echo $userphone;?>" class="deals-cart-text" placeholder="<?php _e( 'Phone', 'wpsdeals' );?>"/>
			</p>
		</div>
		
		<?php
			/**
			 * wps_deals_checkout_billing_details_before hook
			 */
			do_action( 'wps_deals_checkout_billing_details_before' );
		?>
		
	</div>
	
</div>