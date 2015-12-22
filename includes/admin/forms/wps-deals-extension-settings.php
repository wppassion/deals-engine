<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Extension Tab
 *
 * The code for the plugins settings page extension tab
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>
<!-- beginning of the extension settings meta box -->
<div id="wps-deals-extensions" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Extensions Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
						<table class="form-table">
							<tbody>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
									</td>
								</tr>
								
								<?php do_action('wps_deals_add_extension_settings');?>
								
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
</div><!-- #wps-deals-extensions -->