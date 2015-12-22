<?php

/**
 * Add Social Settings Twitter
 * 
 * Handles to add social settings
 * for twitter
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the twitter settings meta box -->
<div id="wps-deals-twitter" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="twitter" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- twitter settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Twitter Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before twitter settings
									do_action('wps_deals_social_twitter_before');
							?>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_twitter]"><?php _e( 'Enable Twitter:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_twitter]" name="wps_deals_options[enable_twitter]" value="1" <?php if( isset( $wps_deals_options['enable_twitter'] ) ) { checked( '1', $wps_deals_options['enable_twitter'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable Twitter for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'Twitter App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><?php _e( 'Before you can start using Twitter for the social checkout, you need to create a Twitter Application. You can get a step by step tutorial on how to create it on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after twitter desc settings
									do_action('wps_deals_social_twitter_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[tw_consumer_key]"><?php _e( 'Twitter Consumer Key:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[tw_consumer_key]" name="wps_deals_options[tw_consumer_key]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['tw_consumer_key'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[tw_consumer_secrets]"><?php _e( 'Twitter Consumer Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[tw_consumer_secrets]" id="wps_deals_options[tw_consumer_secrets]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['tw_consumer_secrets'] ); ?>" class="large-text" />
								</td>
							</tr> 
								
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[tw_icon_url]"><?php _e( 'Custom Twitter Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[tw_icon_url]" id="wps_deals_tw_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['tw_icon_url'] ); ?>" class="wps-deals-img-upload-input" />
									<input type="button" name="wps_deals_tw_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own Twitter Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$twiconurl = '';
										if( isset( $wps_deals_options['tw_icon_url'] ) && !empty( $wps_deals_options['tw_icon_url'] ) ) { 
											$twiconurl = '<img src="'.$wps_deals_options['tw_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $twiconurl;?></div>
								</td>
							</tr>
						
							<?php 
									//action to add settings after twitter settings
									do_action('wps_deals_social_twitter_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #twitter -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-twitter -->