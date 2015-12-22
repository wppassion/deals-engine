<!-- beginning of the misc settings meta box -->
<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Misc Settings Tab
 *
 * The code for the plugins settings page misc tab
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>
<div id="wps-deals-misc" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- misc settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Misc Settings', 'wpsdeals' ); ?></span>
					</h3>
					
					<div class="inside">
						
					<table class="form-table">
						<tbody>
						
							<tr>
								<th colspan="2" valign="top" scope="row">
									<span class="wps-deals-settings-sep-first"><?php _e( 'Misc Settings', 'wpsdeals' ); ?></span>
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</th>
							</tr>
							
							<?php do_action('wps_deals_add_misc_settings_before');?>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[add_to_cart_text]"><?php _e( 'Add to Cart Text:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[add_to_cart_text]" name="wps_deals_options[add_to_cart_text]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['add_to_cart_text']);?>" class="regular-text"/><br />
									<span class="description"><?php _e('Enter the text which will be displayed on the add to cart button.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[file_download_limit]"><?php _e( 'File Download Limit:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[file_download_limit]" name="wps_deals_options[file_download_limit]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['file_download_limit']);?>" class="small-text"/><br />
									<span class="description"><?php _e('The maximum number of times a file can be downloaded for each purchase. Can be customized for each deal.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[link_expiration]"><?php _e( 'Download Link Expiration:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[link_expiration]" name="wps_deals_options[link_expiration]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['link_expiration']);?>" class="small-text"/><br />
									<span class="description"><?php _e('How long should the download links be valid for? Enter a time in hours. Leave it blank to use NO time limit.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[per_page]"><?php _e( 'Sales Per Page:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[per_page]" name="wps_deals_options[per_page]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['per_page']);?>" class="small-text"/><br />
									<span class="description"><?php _e('Page limit for front side order sales page and backend deals sales page. Default is 10.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[show_login_register]"><?php _e( 'Show Register / Login Form?:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[show_login_register]" id="wps_deals_options[show_login_register]" value="1" <?php if ( isset( $wps_deals_options['show_login_register'] ) ) { checked( '1', $wps_deals_options['show_login_register'] ); } ?> /><br />
									<span class="description"><?php _e( 'Displays the registration and login forms on the checkout page for non-logged-in users.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[disable_guest_checkout]"><?php _e( 'Disable Guest Checkout:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[disable_guest_checkout]" id="wps_deals_options[disable_guest_checkout]" value="1" <?php if ( isset( $wps_deals_options['disable_guest_checkout'] ) ) { checked( '1', $wps_deals_options['disable_guest_checkout'] ); } ?> /><br />
									<span class="description"><?php _e( 'If checked, users need an account to be able to purchase your deals.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[redirect_to_checkout]"><?php _e( 'Redirect to Checkout:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[redirect_to_checkout]" id="wps_deals_options[redirect_to_checkout]" value="1" <?php if ( isset( $wps_deals_options['redirect_to_checkout'] ) ) { checked( '1', $wps_deals_options['redirect_to_checkout'] ); } ?> /><br />
									<span class="description"><?php _e( 'If checked, the user will be redirected to the checkout page after he added an deal to the cart.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[force_ssl_checkout]"><?php _e( 'Force Secure Checkout:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[force_ssl_checkout]" id="wps_deals_options[force_ssl_checkout]" class="wps_deals_force_ssl_setting" value="1" <?php if ( isset( $wps_deals_options['force_ssl_checkout'] ) ) { checked( '1', $wps_deals_options['force_ssl_checkout'] ); } ?> /><br />
									<span class="description"><?php _e( 'If checked, force SSL (HTTPS) on the checkout page (an SSL certificate is required).', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							<?php
								//check force_ssl_chekckout is enable or not
								if( isset( $wps_deals_options['force_ssl_checkout'] ) && !empty( $wps_deals_options['force_ssl_checkout'] ) ) {
									$unforcedisplay = 'style="display:table-row;"';
								} else {
									$unforcedisplay = 'style="display:none;"';
								}
							?>
							<tr <?php echo $unforcedisplay;?>>
								<th scope="row">
									<label for="wps_deals_options[unforce_ssl_checkout]"><?php _e( 'Un-force Secure Checkout:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[unforce_ssl_checkout]" id="wps_deals_options[unforce_ssl_checkout]" value="1" <?php if ( isset( $wps_deals_options['unforce_ssl_checkout'] ) ) { checked( '1', $wps_deals_options['unforce_ssl_checkout'] ); } ?> /><br />
									<span class="description"><?php _e( 'If checked, Un-force HTTPS when leaving the checkout.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_billing]"><?php _e( 'Enable Billing:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[enable_billing]" id="wps_deals_options[enable_billing]" value="1" <?php if ( isset( $wps_deals_options['enable_billing'] ) ) { checked( '1', $wps_deals_options['enable_billing'] ); } ?> /><br />
									<span class="description"><?php _e( 'If checked, the user needs to fill up billing details on the checkout page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[item_quantities]"><?php _e( 'Disable Item Quantities:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="wps_deals_options[item_quantities]" name="wps_deals_options[item_quantities]" value="1" <?php if(isset($wps_deals_options['item_quantities'])) { checked('1',$wps_deals_options['item_quantities']); }?>/><br />
									<span class="description"><?php _e(' Disable item quantities to be changed at checkout.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[purchase_limit_label]"><?php _e( 'Purchase Limit Button Label:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[purchase_limit_label]" name="wps_deals_options[purchase_limit_label]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['purchase_limit_label']);?>" class="regular-text" /><br />
									<span class="description"><?php _e('Enter the text you want to use for the button on sold out items','wpsdeals');?></span>
								</td>
							</tr>
							
							<?php 
									//add some settings before agreement settings
									do_action('wps_deals_add_misc_settings_agreement_before');
							?>
							
							<tr>
								<th colspan="2" valign="top" scope="row">
									<span class="wps-deals-settings-sep-first"><?php _e( 'Terms of Agreement Settings', 'wpsdeals' ); ?></span>
								</th>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_terms]"><?php _e( 'Agree to Terms:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[enable_terms]" id="wps_deals_options[enable_terms]" value="1" <?php if ( isset( $wps_deals_options['enable_terms'] ) ) { checked( '1', $wps_deals_options['enable_terms'] ); } ?> /><br />
									<span class="description"><?php _e( 'Check this to show an "Agree To Terms" check box on the checkout page, which users must agree to before they can complete a purchase.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[terms_label]"><?php _e( 'Agree to Terms Label:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[terms_label]" id="wps_deals_options[terms_label]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['terms_label']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Label shown next to the "Agree To Terms" check box.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[terms_content]"><?php _e( 'Agreement Content:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<?php 
											$settings = array( 'textarea_name' => 'wps_deals_options[terms_content]' );
											wp_editor($wps_deals_options['terms_content'],'wps_deals_options_terms_content',$settings);
									?><br />
									<span class="description"><?php _e( 'If Agree to Terms is checked, enter the agreement terms here.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
													
							<?php do_action('wps_deals_add_misc_settings_after');?>
							
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