<?php

/**
 * Default Log Views
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_log_default_views() {
	
	$logsviews = array(
		'downloads'		=> __( 'Downloads', 'wpsdeals' ),
		'sales'			=> __( 'Sales', 'wpsdeals' )
	);

	$views = apply_filters( 'wps_deals_log_views', $logsviews );

	return $views;
}

/**
 * Renders the Reports page views drop down
 *
 * @access      public
 * @since       1.3
 * @return      void
*/
function wps_deals_log_views() {
	
	global $wps_deals_model;
	
	//model class
	$model = $wps_deals_model;
	
	$views        = wps_deals_log_default_views();
	$current_view = isset( $_GET['view'] ) ? $_GET['view'] : 'downloads';
	?>
	<form id="wps-deals-logs-filter" method="GET" class="wpw-deals-form">
		<input type="hidden" name="post_type" value="<?php echo WPS_DEALS_POST_TYPE;?>"/>
		<input type="hidden" name="page" value="wps-deals-reports"/>
		<input type="hidden" name="tab" value="logs"/>
		<select class="wps-deals-logs-view" name="view">
			<!--<option value="-1"><?php _e( 'Log Type', 'wpsdeals' ); ?></option>-->
			<?php foreach ( $views as $view_id => $label ): ?>
				<option value="<?php echo $model->wps_deals_escape_attr( $view_id ); ?>" <?php selected( $view_id, $current_view ); ?>><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>

		<?php do_action( 'wps_deals_view_actions' ); ?>

		<?php submit_button( __( 'Apply', 'wpsdeals' ), 'secondary', 'submit', false ); ?>
	</form>
	<?php
}

?>