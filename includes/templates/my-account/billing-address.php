<?php 

/**
 * Billing Address Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/billing-address.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="deals-billing-address">

	<h3>
		<?php echo $billingtitle; ?>
		<?php if( !empty( $editlink ) ) { ?>
			<a href="<?php echo $editlink; ?>" class="deals-edit-address-link"><?php _e( 'Edit','wpsdeals' );?></a>
		<?php } ?>
	</h3>
	
	<table>
	
		<tbody>
			<?php if( !empty( $billingalldata ) ) { //check billing data ?>
				<tr>
					<td><strong><?php _e( 'Address :','wpsdeals' );?></strong></td>
					<td><?php echo $billingaddress1 . '<br />' . $billingaddress2; ?>
					</td>
				</tr>
				<?php
						/**
						 * wps_deals_my_account_billing_address_after hook
						 */
						do_action( 'wps_deals_my_account_billing_address_after' );
						
					if( !empty( $billingcompany ) ) {
				?>
				<tr>
					<td><strong><?php _e( 'Company Name :','wpsdeals' );?></strong></td>
					<td><?php echo $billingcompany; ?></td>
				</tr>
				<?php
					}
						/**
						 * wps_deals_my_account_billing_company_after hook
						 */
						do_action( 'wps_deals_my_account_billing_company_after' );
				?>
				<tr>
					<td><strong><?php _e( 'Town / City :','wpsdeals');?></strong></td>
					<td><?php echo $billingcity;?></td>
				</tr>
				<?php
						/**
						 * wps_deals_my_account_billing_city_after hook
						 */
						do_action( 'wps_deals_my_account_billing_city_after' );
				?>
				<tr>
					<td><strong><?php _e( 'County / State :','wpsdeals' );?></strong></td>
					<td><?php echo $billingstate;?></td>
				</tr>
				<?php
						/**
						 * wps_deals_my_account_billing_county_after hook
						 */
						do_action( 'wps_deals_my_account_billing_county_after' );
				?>
				<tr>
					<td><strong><?php _e( 'Zip / Postal Code :','wpsdeals');?></strong></td>
					<td><?php echo $billingpostcode;?></td>
				</tr>
				<?php
						/**
						 * wps_deals_my_account_billing_postcode_after hook
						 */
						do_action( 'wps_deals_my_account_billing_postcode_after' );
				?>
				<tr>
					<td><strong><?php _e( 'Country :','wpsdeals' );?></strong></td>
					<td><?php echo $billingcountry;?></td>
				</tr>
				<?php
						/**
						 * wps_deals_my_account_billing_country_after hook
						 */
						do_action( 'wps_deals_my_account_billing_country_after' );
						
					if( !empty( $billingphone ) ) {
				?>
				<tr>
					<td><strong><?php _e( 'Phone :','wpsdeals');?></strong></td>
					<td><?php echo $billingphone;?></td>
				</tr>
				<?php
					}
						/**
						 * wps_deals_my_account_billing_after hook
						 */
						do_action( 'wps_deals_my_account_billing_after' );
			} else {	
					// show a message when the user did not enter any kind of billing address
				?>
				<tr>
					<td colspan="2"><?php _e( 'You have not set up this type of address yet.', 'wpsdeals' );?></td>
				</tr>
			<?php } ?>
				
		 </tbody>
		 
	</table>
	
</div>