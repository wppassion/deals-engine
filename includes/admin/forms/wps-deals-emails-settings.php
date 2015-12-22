<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Email Tab
 *
 * The code for the plugins settings page email tab
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

// Enqueue for preview purchase receipt
wp_enqueue_script( 'wps-deals-popup-scripts' );

?>
<!-- beginning of the email settings meta box -->
<div id="wps-deals-emails" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Emails Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
						<table class="form-table">
							<tbody>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_email_settings_before');?>
									
								<tr valign="top">
									<th scope="row"><label for="wps_deals_options[email_template]"><?php _e( 'Email Template:', 'wpsdeals' ); ?></label></th>
									<td>
										<select id="wps_deals_options[email_template]" name="wps_deals_options[email_template]" class="wps-deals-email-template">
											<?php   												
												$email_templates = $model->wps_deals_email_get_templates();
												
												foreach ( $email_templates as $key => $option ) {											
													?>
													<option value="<?php echo $key; ?>" <?php selected( isset($wps_deals_options['email_template']) ? $wps_deals_options['email_template'] : '', $key ); ?>>
														<?php esc_html_e( $option ); ?>
													</option>
													<?php
												}															
											?> 														
										</select><br />
										<span class="description"><?php _e( 'Choose a template and Choose "Preview Purchase Receipt" to see the email template.', 'wpsdeals' ); ?></span>
									</td>
								</tr>
									
								<tr valign="top">
									<th scope="row"></th>
									<td>							
										<a class="button wps-deals-preview-purchase-receipt" href="#wps_deal_preview_purchase_receipt" rel="wps_deal_preview_purchase_receipt"><?php _e( 'Preview Purchase Receipt', 'wpsdeals' ); ?></a>
										<a class="button wps-deals-send-test-email" href="javascript:void(0);"><?php _e( 'Send Test Email', 'wpsdeals' ); ?></a>
										<img class="wps-deals-loader" src="<?php echo WPS_DEALS_URL ?>includes/images/cart-loader.gif" alt="<?php _e( 'Loading...', 'wpsdeals' ) ?>" />
										<span class="wps-deals-send-email-msg"></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[from_email]"><?php _e( 'From Email Address:', 'wpsdeals' ); ?></label>
									</th>
									<td><input type="text" id="wps_deals_options[from_email]" name="wps_deals_options[from_email]" value="<?php echo $wps_deals_options['from_email'];?>" class="large-text" /><br />
										<span class="description"><?php _e('Ex: Your Name &lt;sales@your-domain.com&gt; This is the email address that will be used to send the email to the buyer.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[buyer_email_subject]"><?php _e( 'Email Subject:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[buyer_email_subject]" name="wps_deals_options[buyer_email_subject]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['buyer_email_subject'] );?>" class="large-text" /><br />
										<span class="description"><?php _e('This is the subject of the email that will be sent to the buyer.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[buyer_email_body]"><?php _e( 'Purchase Receipt:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<?php 
												$settings = array( 'textarea_name' => 'wps_deals_options[buyer_email_body]' );
												wp_editor($wps_deals_options['buyer_email_body'],'wps_deals_options_buyer_email_body',$settings);
										?><br />
										<?php 
												$buyeremail_desc = 'This is the body of the email that will be sent to the buyer. Do not change the email tags (text within the braces { })<br />
												<code>{first_name}</code> - displays the buyer\'s first name<br />
												<code>{last_name}</code> - displays the buyer\'s last name<br />
												<code>{fullname}</code> - displays the buyer\'s first and last name<br />
												<code>{username}</code> - displays the buyer\'s username on the site, if they registered an account<br />
												<code>{product_details}</code> - displays the details for each product for this purchase<br />
												<code>{payment_method}</code> - displays the payment method the buyer used for this purchase<br />
												<code>{purchase_date}</code> - displays the date on which the purchase was made<br />
												<code>{order_id}</code> - displays the Order ID of this purchase<br />
												<code>{sitename}</code> - displays the name of your site<br />
												<code>{subtotal}</code> - displays the subtotal amount of this purchase<br />
												<code>{total}</code> - displays the total amount of this purchase<br />
												<code>{payment_gateway_description}</code> - displays the buyer\'s payment gateway details<br />
												<code>{billing_details}</code> - displays the buyer\'s billing details';
												$buyeremail_desc = apply_filters( 'wps_deals_buyer_email_body_desc', $buyeremail_desc );
										?>		
										<span class="description"><?php _e($buyeremail_desc,'wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[notif_email_address]"><?php _e( 'Notification Email Address:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<textarea id="wps_deals_options[notif_email_address]" name="wps_deals_options[notif_email_address]" class="large-text" rows="5"><?php echo $model->wps_deals_escape_attr($wps_deals_options['notif_email_address']);?></textarea><br />
										<span class="description"><?php _e('This is the email address(es) where the admin(s) will be notified of product sales. Separate multiple recipients by a comma.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[disable_seller_notif]"><?php _e( 'Disable Admin Notifications:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<input type="checkbox" id="wps_deals_options[disable_seller_notif]" name="wps_deals_options[disable_seller_notif]" value="1" <?php if(isset($wps_deals_options['disable_seller_notif'])) { checked('1',$wps_deals_options['disable_seller_notif']); }?>/><br />
										<span class="description"><?php _e( 'Check this box if you do not want to receive emails when new sales are made.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[seller_email_subject]"><?php _e( 'Notification Email Subject:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[seller_email_subject]" name="wps_deals_options[seller_email_subject]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['seller_email_subject'] );?>" class="large-text" /><br />
										<span class="description"><?php _e('This is the subject of the email that will be sent to the admin(s) for record.','wpsdeals');?></span>
									</td>
								</tr>
								
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[seller_email_body]"><?php _e( 'Notification Email Body:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<textarea id="wps_deals_options[seller_email_body]" name="wps_deals_options[seller_email_body]" rows="7" class="large-text"><?php echo $model->wps_deals_escape_attr($wps_deals_options['seller_email_body'])?></textarea>
										<?php 
												$selleremail_desc = 'This is the body of the email that will be sent to the seller. Do not change the email tags (text within the braces { })<br />
												<code>{first_name}</code> - displays the buyer\'s first name<br />
												<code>{last_name}</code> - displays the buyer\'s last name<br />
												<code>{username}</code> - displays the buyer\'s username on the site, if they registered an account<br />
												<code>{email}</code> - displays the buyer\'s email<br />
												<code>{product_details}</code> - displays the details for each product for this purchase<br />
												<code>{payment_method}</code> - displays the payment method the buyer used for this purchase<br />
												<code>{purchase_date}</code> - displays the date on which the purchase was made<br />
												<code>{order_id}</code> - displays the Order ID of this purchase<br />
												<code>{subtotal}</code> - displays the subtotal amount of this purchase<br />
												<code>{total}</code> - displays the total amount of this purchase<br />
												<code>{billing_details}</code> - displays the buyer\'s billing details';
												$selleremail_desc = apply_filters('wps_deals_seller_email_body_desc',$selleremail_desc);
										?><br />
										<span class="description"><?php _e($selleremail_desc,'wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[update_order_email_subject]"><?php _e( 'Update Order Email Subject:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[update_order_email_subject]" name="wps_deals_options[update_order_email_subject]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['update_order_email_subject'] );?>" class="large-text" /><br />
										<span class="description"><?php _e('This is the subject of the email that will be sent to the buyer when an order will be updated from the backend.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[update_order_email]"><?php _e( 'Update Order Email Body:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<textarea id="wps_deals_options[update_order_email]" name="wps_deals_options[update_order_email]" rows="7" class="large-text"><?php echo $model->wps_deals_escape_attr($wps_deals_options['update_order_email'])?></textarea>
										<?php 
												$update_order_desc = 'This is the body of the email that will be sent to the buyer when the admin updated the order. Do not change the email tags (text within the braces { })<br />
																			<code>{order_id}</code> - displays the Order ID<br />
																			<code>{order_date}</code> - displays the Order Date<br />
																			<code>{status}</code> - displays the Order Status';
												
												$update_order_desc = apply_filters('wps_deals_update_order_email_desc',$update_order_desc);
										?><br />
										<span class="description"><?php _e($update_order_desc,'wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[reset_password_email_subject]"><?php _e( 'Reset Password Email Subject:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<input type="text" id="wps_deals_options[reset_password_email_subject]" name="wps_deals_options[reset_password_email_subject]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['reset_password_email_subject'] );?>" class="large-text" /><br />
										<span class="description"><?php _e('This is the subject of the email that will be sent to the user when user reset the password.','wpsdeals');?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="wps_deals_options[reset_password_email]"><?php _e( 'Reset Password Email Body:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<?php 
												$settings = array( 'textarea_name' => 'wps_deals_options[reset_password_email]' );
												wp_editor($wps_deals_options['reset_password_email'],'wps_deals_options_reset_password_email',$settings);
										?><br />
										<?php 
												$reset_password_desc = 'This is the body of the email that will be sent to the user when user reset the password. Do not change the email tags (text within the braces { })<br />
																			<code>{reset_link}</code> - displays reset link for reset user password.<br />
																			<code>{user_name}</code> - displays user name.';
												
												$reset_password_desc = apply_filters('wps_deals_reset_password_email_desc',$reset_password_desc);
										?>
										<span class="description"><?php _e($reset_password_desc,'wpsdeals');?></span>
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_email_settings_after');?>
								
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
</div><!-- #wps-deals-emails -->