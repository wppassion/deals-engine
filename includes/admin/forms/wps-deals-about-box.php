<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * About Box
 *
 * Show more information about the plugin, incl. support & docs links.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */	
 ?>

<!-- beginning of the about meta box -->
<div id="wps-deals-about" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="about" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<h3 class="hndle">
						<span style="vertical-align: top;"><?php esc_attr_e( 'WPSocial', 'wpsdeals' ); ?></span>
					</h3>									

					<div class="inside">

						<table class="form-table">
							<tr>
								<th>
									<?php _e( 'Plugin:', 'wpsdeals' ); ?>
								</th>
								<td>
									<a href="http://wpsocial.com/social-deals-engine-plugin-for-wordpress/" title="<?php _e( 'Social Deals Engine', 'wpsdeals' ); ?>" target="_blank"><?php _e( 'Social Deals Engine', 'wpsdeals' ); ?></a>
								</td>
							</tr>
									
							<tr>
								<th>
									<?php _e( 'Version:', 'wpsdeals' ); ?>
								</th>
								<td>
									<?php echo WPS_DEALS_VERSION; ?>
								</td>
							</tr>
									
							<tr>
								<th>
									<?php _e( 'Author:', 'wpsdeals' ); ?>
								</th>
								<td>
									<?php _e( 'WPSocial.com', 'wpsdeals' ); ?>
								</td>
							</tr>
							
							<tr>
								<th>
									<?php _e( 'Documentation:', 'wpsdeals' ); ?>
								</th>
								<td>
									<p><?php _e( 'Not quite sure how to use the plugin? Visit our Knowledge Base to learn how to use it properly.', 'wpsdeals' ); ?>	<a href="http://wpsocial.com/knowledgebase/social-deals-engine/" title="<?php _e( 'Social Deals Engine Docs', 'wpsdeals' ); ?>" target="_blank"><?php _e( 'Social Deals Engine Knowledge Base', 'wpsdeals' ); ?></a></p>
								</td>
							</tr>
						</table><!-- .form-table -->											

					</div><!-- .inside -->
									
			</div><!-- #about -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-about -->
<!-- end of the about meta box -->