<?php

/**
 * Add Social Settings Foursquare
 * 
 * Handles to add social settings
 * for foursquare
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the foursquare settings meta box -->
<div id="wps-deals-foursquare" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="foursquare" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- foursquare settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Foursquare Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before foursquare settings
									do_action('wps_deals_social_foursquare_before');
							?>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_foursquare]"><?php _e( 'Enable Foursquare:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_foursquare]" name="wps_deals_options[enable_foursquare]" value="1" <?php if( isset( $wps_deals_options['enable_foursquare'] ) ) { checked( '1', $wps_deals_options['enable_foursquare'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable Foursquare for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'Foursquare App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><?php _e( 'Before you can start using Foursquare for the social checkout, you need to create a Foursquare Application. You can get a step by step tutorial on how to create it on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after foursquare desc settings
									do_action('wps_deals_social_foursquare_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[fs_client_id]"><?php _e( 'Foursquare Client ID:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[fs_client_id]" name="wps_deals_options[fs_client_id]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fs_client_id'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[fs_client_secrets]"><?php _e( 'Foursquare Client Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[fs_client_secrets]" id="wps_deals_options[fs_client_secrets]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fs_client_secrets'] ); ?>" class="large-text" />
								</td>
							</tr> 
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[fs_icon_url]"><?php _e( 'Custom Foursquare Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[fs_icon_url]" id="wps_deals_fs_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fs_icon_url'] ); ?>" class="wps-deals-img-upload-input"/>
									<input type="button" name="wps_deals_fs_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own Foursquare Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$fsiconurl = '';
										if( isset( $wps_deals_options['fs_icon_url'] ) && !empty( $wps_deals_options['fs_icon_url'] ) ) { 
											$fsiconurl = '<img src="'.$wps_deals_options['fs_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $fsiconurl;?></div>
								</td>
							</tr>
						
							<?php 
									//action to add settings after foursquare settings
									do_action('wps_deals_social_foursquare_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #foursquare -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-foursquare -->