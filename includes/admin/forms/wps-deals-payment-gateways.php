<!-- beginning of the payment gateways settings meta box -->
<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Payment Gateway Tab
 *
 * The code for the plugins settings page payment gateways tab
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

global $wps_deals_payment_log;

		//get all pages					
		$get_pages = get_pages(); 
		$paymentgateways = wps_deals_get_payment_gateways();
?>
<div id="wps-deals-payments" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Payments Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
						<table class="form-table">
							<tbody>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_payment_gateways_settings_top');?>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[payment_gateways][]"><?php _e('Payment Gateways:', 'wpsdeals');?></label>
									</th>
									
									<td>
										<?php 
												foreach ($paymentgateways as $key => $value){ ?>
													<input type="checkbox" id="wps_deals_options[payment_gateways][<?php echo $key;?>]" name="wps_deals_options[payment_gateways][<?php echo $key;?>]" value="1" <?php if(isset($wps_deals_options['payment_gateways']) && array_key_exists($key,$wps_deals_options['payment_gateways'])) { echo 'checked="checked"';} ?>/>
													<label for="wps_deals_options[payment_gateways][<?php echo $key;?>]"><?php echo $value['admin_label'];?><br /></label>
										<?php	} ?><br />
										<span class="description"><?php _e( 'Choose one or more payment gateway(s) you want to use for the checkout.', 'wpsdeals' ); ?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[default_payment_gateway]"><?php _e('Default Payment Gateway:', 'wpsdeals');?></label>
									</th>
									
									<td>
										<select name="wps_deals_options[default_payment_gateway]" id="wps_deals_options[default_payment_gateway]">
										<?php 
												$defaultgateway = isset( $wps_deals_options['default_payment_gateway'] ) ? $wps_deals_options['default_payment_gateway'] : 'paypal';
												foreach ($paymentgateways as $key => $value){ ?>
													<option value="<?php echo $key;?>" <?php selected( $defaultgateway, $key, true );?>><?php echo $value['admin_label'];?></option>
										<?php	} ?>
										</select><br />										
										<span class="description"><?php _e( 'Choose default payment gateway which will be automatically selected on checkout page.', 'wpsdeals' ); ?></span>
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_payment_gateways_settings_before');?>
								
								<tr>
									<th colspan="2" valign="top" scope="row">
										<span class="wps-deals-settings-sep-first"><?php _e( 'Paypal Settings', 'wpsdeals' ); ?></span>
									</th>
								</tr>						
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[enable_debug]"><?php _e('Enable Debug Log:', 'wpsdeals');?></label>
									</th>
									<td>
										<input type="checkbox" id="wps_deals_options[enable_debug]" name="wps_deals_options[enable_debug]" value="1" <?php if(isset($wps_deals_options['enable_debug'])) { checked('1',$wps_deals_options['enable_debug']); }?>/><br />
										<span class="description"><?php echo sprintf( __( 'If checked, debug output will be written to log files. Log PayPal events, such as IPN requests, inside <code>'.WPS_DEALS_LOG_DIR.'%s</code>', 'wpsdeals' ), $wps_deals_payment_log->wps_deals_file_name( 'paypal' ) ); ?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[paypal_merchant_email]"><?php _e( 'Paypal Email Address/Secure Merchant ID:', 'wpsdeals' ); ?></label>
									</th>
									<td><input type="text" id="wps_deals_options[paypal_merchant_email]" name="wps_deals_options[paypal_merchant_email]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['paypal_merchant_email']);?>" class="large-text"/><br />
									<span class="description"><?php _e('Your PayPal email address (this is the account where the payments will go to).','wpsdeals');?></span>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[paypal_api_user]"><?php _e( 'API Username:', 'wpsdeals' );?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[paypal_api_user]" name="wps_deals_options[paypal_api_user]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['paypal_api_user']);?>" class="large-text"/><br />
										<span class="description"><?php _e('Enter your API username.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[paypal_api_pass]"><?php _e( 'API Password:', 'wpsdeals' );?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[paypal_api_pass]" name="wps_deals_options[paypal_api_pass]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['paypal_api_pass']);?>" class="large-text"/><br />
										<span class="description"><?php _e( 'Enter your API password.','wpsdeals' );?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[paypal_api_sign]"><?php _e( 'API Signature:', 'wpsdeals' );?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[paypal_api_sign]" name="wps_deals_options[paypal_api_sign]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['paypal_api_sign']);?>" class="large-text"/><br />
										<span class="description"><?php _e('Enter your API signature.','wpsdeals');?></span>
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_cheque_payment_gateways_settings_before');?>
								
								<tr>
									<th colspan="2" valign="top" scope="row">
										<span class="wps-deals-settings-sep-first"><?php _e( 'Cheque Payment Settings', 'wpsdeals' ); ?></span>
									</th>
								</tr>						
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[cheque_title]"><?php _e( 'Title:', 'wpsdeals' );?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[cheque_title]" name="wps_deals_options[cheque_title]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['cheque_title']);?>" class="large-text"/><br />
										<span class="description"><?php _e( 'Enter the title which the user sees during checkout.','wpsdeals' );?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[cheque_customer_msg]"><?php _e( 'Customer Message:', 'wpsdeals' );?></label>
									</th>
									<td>
										<textarea id="wps_deals_options[cheque_customer_msg]" rows="5" name="wps_deals_options[cheque_customer_msg]" class="large-text"><?php echo $model->wps_deals_escape_attr($wps_deals_options['cheque_customer_msg']);?></textarea><br />
										<span class="description"><?php _e( 'Let the customer know the payee and where they should be sending the cheque to and that their order won\'t be processed until you receive it.','wpsdeals' );?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[mark_order_complete]"><?php _e('Mark Order As Completed:', 'wpsdeals');?></label>
									</th>
									<td>
										<input type="checkbox" id="wps_deals_options[mark_order_complete]" name="wps_deals_options[mark_order_complete]" value="1" <?php if(isset($wps_deals_options['mark_order_complete'])) { checked('1',$wps_deals_options['mark_order_complete']); }?>/><br />
										<span class="description"><?php _e( 'Check this box if you want to mark the order as completed.', 'wpsdeals' ); ?></span>
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_payment_gateways_settings_after');?>
								
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
									</td>
								</tr>
							</tbody>
						 </table>
						 
				</div><!-- .inside -->
			</div><!-- #general -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-payments -->