<?php

/**
 * Add Social Settings Yahoo
 * 
 * Handles to add social settings
 * for yahoo
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the yahoo settings meta box -->
<div id="wps-deals-yahoo" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="yahoo" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- yahoo settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Yahoo Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before yahoo settings
									do_action('wps_deals_social_yahoo_before');
							?>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_yahoo]"><?php _e( 'Enable Yahoo:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_yahoo]" name="wps_deals_options[enable_yahoo]" value="1" <?php if( isset( $wps_deals_options['enable_yahoo'] ) ) { checked( '1', $wps_deals_options['enable_yahoo'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable Yahoo for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'Yahoo App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><?php _e( 'Before you can start using Yahoo for the social checkout, you need to create a Yahoo Application. You can get a step by step tutorial on how to create it on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after yahoo desc settings
									do_action('wps_deals_social_yahoo_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[yh_consumer_key]"><?php _e( 'Yahoo Consumer Key:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[yh_consumer_key]" name="wps_deals_options[yh_consumer_key]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['yh_consumer_key'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[yh_consumer_secrets]"><?php _e( 'Yahoo Consumer Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[yh_consumer_secrets]" id="wps_deals_options[yh_consumer_secrets]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['yh_consumer_secrets'] ); ?>" class="large-text" />
								</td>
							</tr> 
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[yh_app_id]"><?php _e( 'Yahoo App Id:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[yh_app_id]" id="wps_deals_options[yh_app_id]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['yh_app_id'] ); ?>" class="large-text" />
								</td>
							</tr>
							
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[yahoo_callback_url]"><?php _e( 'Yahoo Home Page URL:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<code><strong><?php echo WPS_DEALS_YH_REDIRECT_URL;?></strong></code>
								</td>
							</tr> 
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[yh_icon_url]"><?php _e( 'Custom Yahoo Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[yh_icon_url]" id="wps_deals_yh_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['yh_icon_url'] ); ?>" class="wps-deals-img-upload-input" />
									<input type="button" name="wps_deals_yh_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own Yahoo Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$yhiconurl = '';
										if( isset( $wps_deals_options['yh_icon_url'] ) && !empty( $wps_deals_options['yh_icon_url'] ) ) { 
											$yhiconurl = '<img src="'.$wps_deals_options['yh_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $yhiconurl;?></div>
								</td>
							</tr>
						
							<?php 
									//action to add settings after yahoo settings
									do_action('wps_deals_social_yahoo_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #yahoo -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-yahoo -->