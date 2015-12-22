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
<div id="wps-deals-general" class="post-box-container">
<?php
	global $wps_deals_model;
?>
	<form action="<?php echo esc_url( admin_url( 'edit.php?post_type=wpsdeals&page=wps-deals-tool' ) ); ?>" method="post" dir="ltr" >
		
		<textarea readonly="readonly" onclick="this.focus(); this.select()" id="system-info-textarea" name="wps-deal-sysinfo" title="<?php _e("To copy the system info, click below then press Ctrl + C (PC) or Cmd + C (Mac).", "wpsdeals"); ?>"><?php echo $wps_deals_model->wps_deals_tools_sysinfo_display(); ?></textarea>
		
		<p class="submit">
			<input type="submit" name="wps-deal-download-sysinfo" id="wps-deal-download-sysinfo" class="button button-primary" value="Dowload System Info File">
		</p>
	</form>
</div>
