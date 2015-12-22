<?php
/**
 * Social Login Data
 * 
 * Handles to show social login data
 * on the page
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

	global $wps_deals_social_model,$wps_deals_options;
	
	//social model class
	$socialmodel = $wps_deals_social_model;
?>

<div class="wrap">
	<!-- wpsocial logo -->
	<img src="<?php echo WPS_DEALS_URL . 'includes/images/wps-logo.png'; ?>" class="wpsocial-logo" alt="WPSocial.com Logo" />
	<!-- plugin name -->
	<h2 class="wps-deals-settings-title"><?php _e( 'Social Deals Engine - Social Login', 'wpsdeals' ); ?></h2><br />

	<?php
		//save order of social networks
		if( isset( $_POST['wps-deals-settings-social-submit'] ) && $_POST['wps-deals-settings-social-submit'] == __('Save Changes','wpsdeals') ) {
			
			$wps_deals_options['social_order'] = $_POST['social_order'];
			update_option( 'wps_deals_options', $wps_deals_options );
			
			echo '<div id="message" class="updated fade below-h2">
						<p><strong>'.__( 'Changes Saved.','wpsdeals').'</strong></p>
				  </div>';
		}
	?>
	
	<form action="" method="POST">
		
	<?php  
				//do action to add social table before
				do_action( 'wps_deals_social_table_before' );
		?>
		
		<h3><?php _e( 'Drag to Chage Order', 'wpsdeals' );?></h3>
		
		<table class="wps-deals-sortable widefat">
			<thead>
				<tr>
					<th width="1%"></th>
					<th width="1%" class="wps-deals-social-none"><?php _e('Chage Order', 'wpsdeals'); ?></th>
					<?php
							//do action to add header before
							do_action( 'wps_deals_social_table_header_before' );
					?>
					<th><?php _e( 'Network', 'wpsdeals');?></th>
					<?php
							//do action to add social table header network after
							do_action( 'wps_deals_social_table_header_network_after' );
					?>
					<th><?php _e( 'Register Count', 'wpsdeals');?></th>
					<?php
							//do action to add social table header after
							do_action( 'wps_deals_social_table_header_after' );
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					//do action to add social table content before
					do_action( 'wps_deals_social_table_content_before' );
					
					//get all social networks
					$allnetworks = wps_deals_get_sorted_social_network();
					
					//register user count
					$regusers = array();
					
					foreach ( $allnetworks as $key => $value ) {
						
						$countargs = array( 
											'getcount' =>	'1',
											'network'	=>	$key 
										  );
						$regusers[$key]['count'] = $socialmodel->wps_deals_social_get_users( $countargs );
						$regusers[$key]['label'] = $value;
				?>
						<tr>
							<?php
								//do action to add social table data before
								do_action( 'wps_deals_social_table_data_before', $key, $value );
							?>
							<td><img src="<?php echo WPS_DEALS_SOCIAL_URL.'/images/backend/'.$key.'.png';?>" alt="<?php echo $value;?>" /></td>
							<td width="1%" class="wps-deals-social-none">
								<input type="hidden" name="social_order[]" value="<?php echo $key;?>" />
							</td>
							<?php
								//do action to add social icon after
								do_action( 'wps_deals_social_table_data_icon_after', $key, $value );
							?>
							<td><?php echo $value;?></td>
							<?php
								//do action to add social table data network
								do_action( 'wps_deals_social_table_data_network_after', $key, $value );
							?>
							<td><?php echo $regusers[$key]['count'];?></td>
							<?php
								//do action to add social table data reg count after
								do_action( 'wps_deals_social_table_data_reg_count_after', $key, $value );
							?>
						</tr>
			<?php	
					}
					
					//do action to add social table content after
					do_action( 'wps_deals_social_table_content_after' );
			?>
			</tbody>
			<tfoot>
				<tr>
					<th width="1%"></th>
					<th width="1%" class="wps-deals-social-none"><?php _e('Chage Order', 'wpsdeals'); ?></th>
					<?php
							//do action to add footer before
							do_action( 'wps_deals_social_table_footer_before' );
					?>
					<th><?php _e( 'Network', 'wpsdeals');?></th>
					<?php
							//do action to add social table footer network after
							do_action( 'wps_deals_social_table_foooter_network_after' );
					?>
					<th><?php _e( 'Register Count', 'wpsdeals');?></th>
					<?php
							//do action to add social table footer after
							do_action( 'wps_deals_social_table_footer_after' );
					?>
				</tr>
			</tfoot>
		</table>
		
		<?php
				//do action to add social table after
				do_action( 'wps_deals_social_data_table_after' );
		?>		
		<input type="submit" id="wps-deals-settings-social-submit" name="wps-deals-settings-social-submit" class="wps-deals-social-submit button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
	</form>
	<?php
		$colors = array(
						'facebook'		=>	'A200C2',
						'twitter'		=>	'46c0FB',
						'googleplus'	=>	'0083A8',
						'linkedin'		=>	'4E6CF7',
						'yahoo'			=>	'4863AE'
					);
		//applying filter for chart color
		$colors = apply_filters( 'wps_deals_social_chart_colors', $colors );
		
		foreach( $regusers as $key => $val ){
			if( $val['count']== 0 ){
				unset( $regusers[$key] );
				unset( $colors[$key] );
			}
		}
	?>
	<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback( WpsDealsDrawChart );

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function WpsDealsDrawChart() {

      	<?php
      		$datarows = '';
      		foreach( $regusers as $key => $val ){
				$count = $val['count'];
				$datarows .= "['".$val['label']."', $count], ";
			}
			$datarows = trim( $datarows, ',');
      	?>
      	
	        // Create the data table.
	        var deals_social_data = new google.visualization.DataTable();
	        deals_social_data.addColumn('string', 'Topping');
	        deals_social_data.addColumn('number', 'Slices');
	        deals_social_data.addRows([<?php echo $datarows;?>]);
	
	        // Set chart options
	        var deals_social_chart_options = {
	        				'title':'<?php _e('Social Networks Register Percentage', 'wpsdeals'); ?>',
	                       	'width':650,
	                       	'height':450
	        			};
	
	        // Instantiate and draw our chart, passing in some options.
	        var deals_social_chart = new google.visualization.PieChart(document.getElementById('wps_deals_social_chart_element'));
	        deals_social_chart.draw(deals_social_data, deals_social_chart_options );
      }
    </script>
	<div id="wps_deals_social_chart_element" class="wps-deals-social-chart-container"></div><!--.wps-deals-social-chart-container-->
	
</div><!--wrap-->