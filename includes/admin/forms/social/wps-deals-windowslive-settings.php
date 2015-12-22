<?php

/**
 * Add Social Settings Windows Live
 * 
 * Handles to add social settings
 * for windows live
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the windows live settings meta box -->
<div id="wps-deals-windowslive" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="windowslive" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- windows live settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Windows Live Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before windowslive settings
									do_action('wps_deals_social_windowslive_before');
							?>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_windowslive]"><?php _e( 'Enable Windows Live:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_windowslive]" name="wps_deals_options[enable_windowslive]" value="1" <?php if( isset( $wps_deals_options['enable_windowslive'] ) ) { checked( '1', $wps_deals_options['enable_windowslive'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable Windows Live for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'Windows Live App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><?php _e( 'Before you can start using Windows Live for the social checkout, you need to create a Google Project and get a Google Client ID. You can get a step by step tutorial on how to get a Google Client ID on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after windowslive desc settings
									do_action('wps_deals_social_windowslive_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[wl_client_id]"><?php _e( 'Windows Live Client ID:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[wl_client_id]" name="wps_deals_options[wl_client_id]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['wl_client_id'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[wl_client_secrets]"><?php _e( 'Windows Live Client Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[wl_client_secrets]" id="wps_deals_options[wl_client_secrets]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['wl_client_secrets'] ); ?>" class="large-text" />
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[windowslive_callback_url]"><?php _e( 'Windows Live Callback URL:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<code><strong><?php echo site_url();?></strong></code>
								</td>
							</tr> 
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[wl_icon_url]"><?php _e( 'Custom Windows Live Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[wl_icon_url]" id="wps_deals_wl_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['wl_icon_url'] ); ?>" class="wps-deals-img-upload-input" />
									<input type="button" name="wps_deals_wl_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own Windows Live Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$wliconurl = '';
										if( isset( $wps_deals_options['wl_icon_url'] ) && !empty( $wps_deals_options['wl_icon_url'] ) ) { 
											$wliconurl = '<img src="'.$wps_deals_options['wl_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $wliconurl;?></div>
								</td>
							</tr>
						
							<?php 
									//action to add settings after Windows Live settings
									do_action('wps_deals_social_windowslive_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #windowslive -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-windowslive -->