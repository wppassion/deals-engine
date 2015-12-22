<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * System Info Tab
 *
 * The code for the plugins settings page general tab
 *
 * @package Social Deals Engine
 * @since 2.2.6
 */
	
?>
	<!-- beginning of the general settings meta box -->
<div id="wps-deals-import-export" class="post-box-container">
<div class="wrap">
		<div class="metabox-holder">
			<!-- Export box -->
			<div class="postbox"> 
				<h3><span><?php _e( 'Export Settings', 'wpsdeals' ); ?></span></h3>

				<div class="inside">

					<p><?php _e( 'Export the Socail Deals Engine Downloads settings for this site as a .json file. This allows you to easily import the configuration into another site.', 'wpsdeals' ); ?></p>
					
					<p><?php printf( __( 'To report export data, visit the <a href="%s">Reports</a> page.', 'wpsdeals' ), admin_url( 'edit.php?post_type=wpsdeals&page=wps-deals-reports' ) ); ?>
					
					<form method="post" action="<?php echo admin_url( 'edit.php?post_type=wpsdeals&page=wps-deals-tool' ); ?>">
						<p class="button_tools">
							<input type="hidden" value="wps_deals_export" name="wps_deals_export" />
								<input type="hidden" value="import-export" name="selected_tab" >
							<input type="submit" value="Export" name="export-submit" class="button button-primary" />
						</p>
					</form>
				
				</div><!-- .inside -->
				
			<!-- Import box -->
			</div><!-- .postbox -->
			<div class="postbox">
				<h3><span><?php _e( 'Import Settings', 'wpdeals' ); ?></span></h3>
				<div class="inside">

					<p><?php _e( 'Import the Social Deals Engine settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', 'wpsdeals' ); ?></p>
						
					<form method="post" enctype="multipart/form-data" action="<?php echo admin_url( 'edit.php?post_type=wpsdeals&page=wps-deals-tool' ); ?>" name="import_setting" id="import_setting">
						<p>
							<input type="file" name="import_file" id="import_file"/>
							<span id="error_msg_file"></span>
						</p>
						<p class="button_tools">
							<input type="hidden" value="wps_deals_import" name="wps_deals_import" />
							<input type="hidden"en" value="import-export" name="selected_tab" >
							<input type="submit" value="Import" name="import-submit" id="import_data"  class="button button-primary" />
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->
			<?php do_action( 'wps_deals_export_import_bottom' ); ?>
		</div><!-- .metabox-holder -->
	</div><!-- .wrap -->
</div>