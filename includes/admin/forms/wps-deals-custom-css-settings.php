<!-- beginning of the misc settings meta box -->
<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Custom CSS Settings Tab
 *
 * The code for the plugins settings page cstom css
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>
<div id="wps-deals-custom-css" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Custom CSS', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
						<table class="form-table">											
							<tbody>
							
								<?php do_action('wps_deals_add_custom_css_before');?>
							
								<tr valign="top">
									<th scope="row">
										<label for="wps_deals_options[custom_css]"><?php _e( 'Custom CSS:', 'wpsdeals' ); ?></label>
									</th>
									<td>
										<textarea name="wps_deals_options[custom_css]" id="wps_deals_options[custom_css]" rows="20" class="large-text"><?php echo $model->wps_deals_escape_attr( $wps_deals_options['custom_css'] ); ?></textarea> 
										<span class="description"><?php _e( 'Here you can enter your custom css for the social deals engine. The css file will automatically be created and added to the header, when you save it.', 'wpsdeals' ); ?></span>   
									</td>
								</tr>
					
								<?php do_action('wps_deals_add_custom_css_after');?>
								
								<tr valign="top">
									<td colspan="2">
										<!-- submit button to save changes -->
										<input type="submit" value="<?php _e ( 'Save Custom CSS', 'wpsdeals' ); ?>" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary">
									</td>
								</tr>
								
							</tbody>
						</table>
					</div><!-- .inside -->
			</div><!-- #general -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-custom-css -->