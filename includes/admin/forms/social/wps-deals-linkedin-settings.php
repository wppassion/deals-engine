<?php

/**
 * Add linkedin Settings
 * 
 * Handles to add social settings
 * for linkedin.
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the linkedin settings meta box -->
<div id="wps-deals-linkedin" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="linkedin" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- linkedin settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'LinkedIn Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before linkedin settings
									do_action('wps_deals_social_linkedin_before');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_linkedin]"><?php _e( 'Enable LinkedIn:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_linkedin]" name="wps_deals_options[enable_linkedin]" value="1" <?php if( isset( $wps_deals_options['enable_linkedin'] ) ) { checked( '1', $wps_deals_options['enable_linkedin'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable LinkedIn for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'LinkedIn App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><?php _e( 'Before you can start using LinkedIn for the social checkout, you need to create a LinkedIn Application. You can get a step by step tutorial on how to create it on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after linkedin desc settings
									do_action('wps_deals_social_linkedin_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[li_app_id]"><?php _e( 'LinkedIn App ID/API Key:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[li_app_id]" name="wps_deals_options[li_app_id]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['li_app_id'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[li_app_secret]"><?php _e( 'LinkedIn App Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[li_app_secret]" id="wps_deals_options[li_app_secret]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['li_app_secret'] ); ?>" class="large-text" />
								</td>
							</tr> 
									
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[li_icon_url]"><?php _e( 'Custom LinkedIn Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[li_icon_url]" id="wps_deals_li_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['li_icon_url'] ); ?>" class="wps-deals-img-upload-input" />
									<input type="button" name="wps_deals_li_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own LinkedIn Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$liiconurl = '';
										if( isset( $wps_deals_options['li_icon_url'] ) && !empty( $wps_deals_options['li_icon_url'] ) ) { 
											$liiconurl = '<img src="'.$wps_deals_options['li_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $liiconurl;?></div>
								</td>
							</tr>
						
							<?php 
									//action to add settings after linkedin settings
									do_action('wps_deals_social_linkedin_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #linkedin -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-linkedin -->