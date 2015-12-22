<?php

/**
 * Add Social Settings General
 * 
 * Handles to add social settings
 * for general
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the general settings meta box -->
<div id="wps-deals-general" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'General Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before general settings
									do_action('wps_deals_social_general_before');
							?>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[login_heading]"><?php _e( 'Social Login Title:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[login_heading]" id="wps_deals_options[login_heading]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['login_heading'] ); ?>" class="large-text" /></br>
									<span class="description"><?php _e( 'Enter social login title.', 'wpsdeals' ); ?></span>
								</td>
							</tr> 
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[login_redirect_url]"><?php _e( 'Redirect URL:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[login_redirect_url]" id="wps_deals_options[login_redirect_url]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['login_redirect_url'] ); ?>" class="large-text" /></br>
									<span class="description"><?php _e( 'Enter a redirect URL for users after they login with social media. The URL must start with http://', 'wpsdeals' ); ?></span>
								</td>
							</tr> 
							
							<?php 
									//action to add settings after general settings
									do_action('wps_deals_social_general_after');
							?>
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
</div><!-- #wps-deals-general -->