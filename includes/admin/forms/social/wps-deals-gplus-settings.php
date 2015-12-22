<?php

/**
 * Add Social Settings google+
 * 
 * Handles to add social settings
 * for google+
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the google+ settings meta box -->
<div id="wps-deals-gplus" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="gplus" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- google+ settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Google+ Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before gplus settings
									do_action('wps_deals_social_gplus_before');
							?>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_gplus]"><?php _e( 'Enable Google+:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_gplus]" name="wps_deals_options[enable_gplus]" value="1" <?php if( isset( $wps_deals_options['enable_gplus'] ) ) { checked( '1', $wps_deals_options['enable_gplus'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable Google+ for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'Google+ App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><?php _e( 'Before you can start using Google+ for the social checkout, you need to create a Google Project and get a Google Client ID. You can get a step by step tutorial on how to get a Google Client ID on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after google+ desc settings
									do_action('wps_deals_social_gplus_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[gplus_client_id]"><?php _e( 'Google+ Client ID:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[gplus_client_id]" name="wps_deals_options[gplus_client_id]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['gplus_client_id'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[gplus_client_secret]"><?php _e( 'Google+ Client Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[gplus_client_secret]" id="wps_deals_options[gplus_client_secret]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['gplus_client_secret'] ); ?>" class="large-text" />
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[gplus_callback_url]"><?php _e( 'Google+ Callback URL:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<code><strong><?php echo WPS_DEALS_GP_REDIRECT_URL;?></strong></code>
								</td>
							</tr> 
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[gplus_icon_url]"><?php _e( 'Custom Google+ Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[gplus_icon_url]" id="wps_deals_gplus_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['gplus_icon_url'] ); ?>" class="wps-deals-img-upload-input" />
									<input type="button" name="wps_deals_gplus_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own Google+ Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$gpiconurl = '';
										if( isset( $wps_deals_options['gplus_icon_url'] ) && !empty( $wps_deals_options['gplus_icon_url'] ) ) { 
											$gpiconurl = '<img src="'.$wps_deals_options['gplus_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $gpiconurl;?></div>
								</td>
							</tr>
						
							<?php 
									//action to add settings after google+ settings
									do_action('wps_deals_social_gplus_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #gplus -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-gplus -->