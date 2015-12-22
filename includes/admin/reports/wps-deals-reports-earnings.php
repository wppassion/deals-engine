<?php
/**
 * Graphing Functions
 *
 * @package     Social Deals Engine
 * @subpackage  Graphing Functions
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Show report graphs
 *
 * @access      public
 * @since       1.0.0
 * @return      void
*/

function wps_deals_reports_graph() {
	
	global $wps_deals_model, $wps_deals_currency;
	
	$model = $wps_deals_model;
	$currency = $wps_deals_currency;
	
	// Retrieve the queried dates
	$dates = wps_deals_get_report_dates();

	// Determine graph options
	switch( $dates['range'] ) :
		case 'today' :
			$time_format 	= '%d/%b';
			$tick_size		= 'hour';
			$day_by_day		= true;
			break;
		case 'last_year' :
			$time_format 	= '%b';
			$tick_size		= 'month';
			$day_by_day		= false;
			break;
		case 'this_year' :
			$time_format 	= '%b';
			$tick_size		= 'month';
			$day_by_day		= false;
			break;
		case 'last_quarter' :
			$time_format	= '%b';
			$tick_size		= 'month';
			$day_by_day 	= false;
			break;
		case 'this_quarter' :
			$time_format	= '%b';
			$tick_size		= 'month';
			$day_by_day 	= false;
			break;
		case 'other' :
			if( ( $dates['m_end'] - $dates['m_start'] ) >= 2 ) {
				$time_format	= '%b';
				$tick_size		= 'month';
				$day_by_day 	= false;
			} else {
				$time_format 	= '%d/%b';
				$tick_size		= 'day';
				$day_by_day 	= true;
			}
			break;
		default:
			$time_format 	= '%d/%b'; 	// Show days by default
			$tick_size		= 'day'; 	// Default graph interval
			$day_by_day 	= true;
			break;
	endswitch;

	$time_format 	= apply_filters( 'wps_deals_graph_timeformat', $time_format );
	$tick_size 		= apply_filters( 'wps_deals_graph_ticksize', $tick_size );
	$totals 		= (float) 0.00; // Total earnings for time period shown
	$sales_totals   = 0;            // Total sales for time period shown

	ob_start(); ?>
	<script type="text/javascript">
	   jQuery( document ).ready( function($) {
	   		$.plot(
	   			$("#wps_deals_monthly_stats"),
	   			[{
   					data: [
	   					<?php

	   					if( $dates['range'] == 'today' ) {
	   						// Hour by hour
	   						$hour  = 1;
	   						$month = wps_deals_current_date( 'n' );
							while ( $hour <= 23 ) :
								$sales_array = $model->wps_deals_get_sale_count_earning_by_date( $dates['day'], $month, $dates['year'], $hour );
								$sales = $sales_array['salescount'];
								$sales_totals += $sales;
								$date = mktime( $hour, 0, 0, $month, $dates['day'], $dates['year'] ); ?>
								[<?php echo $date * 1000; ?>, <?php echo $sales; ?>],
								<?php
								$hour++;
							endwhile;

	   					} elseif( $dates['range'] == 'this_week' || $dates['range'] == 'last_week'  ) {

							//Day by day
							$day     = $dates['day'];
							$day_end = $dates['day_end'];
	   						$month   = $dates['m_start'];
							while ( $day <= $day_end ) :
								$sales_array = $model->wps_deals_get_sale_count_earning_by_date( $day, $month, $dates['year'] );
								$sales = $sales_array['salescount'];
								$sales_totals += $sales;
								$date = mktime( 0, 0, 0, $month, $day, $dates['year'] ); ?>
								[<?php echo $date * 1000; ?>, <?php echo $sales; ?>],
								<?php
								$day++;
							endwhile;

	   					} else {

	   						$i = $dates['m_start'];
							while ( $i <= $dates['m_end'] ) :
								if ( $day_by_day ) :
									$num_of_days 	= cal_days_in_month( CAL_GREGORIAN, $i, $dates['year'] );
									$d 				= 1;
									while ( $d <= $num_of_days ) :
										$sales_array = $model->wps_deals_get_sale_count_earning_by_date( $d, $i, $dates['year'] );
										$sales = $sales_array['salescount'];
										$sales_totals += $sales;
										$date = mktime( 0, 0, 0, $i, $d, $dates['year'] ); ?>
										[<?php echo $date * 1000; ?>, <?php echo $sales; ?>],
									<?php
									$d++;
									endwhile;
								else :
									$date = mktime( 0, 0, 0, $i, 1, $dates['year'] );
									$sales_data = $model->wps_deals_get_sale_count_earning_by_date( null, $i, $dates['year'] );
									$sales = $sales_data['salescount'];
									$sales_totals += $sales;
									?>
									[<?php echo $date * 1000; ?>, <?php echo $sales_data['salescount']; ?>],
								<?php
								endif;
								$i++;
							endwhile;

	   					}

	   					?>,
	   				],
	   				yaxis: 2,
   					label: "<?php _e( 'Sales', 'wpsdeals' ); ?>",
   					id: 'sales'
   				},
   				{
   					data: [
	   					<?php

	   					if( $dates['range'] == 'today' ) {

	   						// Hour by hour
	   						$hour  = 1;
	   						$month = wps_deals_current_date( 'n' );
							while ( $hour <= 23 ) :
								$earnings_array = $model->wps_deals_get_sale_count_earning_by_date( $dates['day'], $month, $dates['year'], $hour );
								$earnings = $earnings_array['earnings'];
								$totals += $earnings;
								$date = mktime( $hour, 0, 0, $month, $dates['day'], $dates['year'] ); ?>
								[<?php echo $date * 1000; ?>, <?php echo $earnings; ?>],
								<?php
								$hour++;
							endwhile;

						} elseif( $dates['range'] == 'this_week' || $dates['range'] == 'last_week' ) {

							//Day by day
							$day     = $dates['day'];
							$day_end = $dates['day_end'];
	   						$month   = $dates['m_start'];
							while ( $day <= $day_end ) :
								$earnings_array = $model->wps_deals_get_sale_count_earning_by_date( $day, $month, $dates['year'] );
								$earnings = $earnings_array['earnings'];
								$totals += $earnings;
								$date = mktime( 0, 0, 0, $month, $day, $dates['year'] ); ?>
								[<?php echo $date * 1000; ?>, <?php echo $earnings; ?>],
								<?php
								$day++;
							endwhile;

	   					} else {
							
		   					$i = $dates['m_start'];
							while ( $i <= $dates['m_end'] ) :
								if ( $day_by_day ) :
									$num_of_days 	= cal_days_in_month( CAL_GREGORIAN, $i, $dates['year'] );
									$d 				= 1;
									while ( $d <= $num_of_days ) :
										$date = mktime( 0, 0, 0, $i, $d, $dates['year'] );
										$earnings_array = $model->wps_deals_get_sale_count_earning_by_date( $d, $i, $dates['year'] );
										$earnings = $earnings_array['earnings'];
										$totals += $earnings; ?>
										[<?php echo $date * 1000; ?>, <?php echo $earnings ?>],
									<?php $d++; endwhile;
								else :
									$date = mktime( 0, 0, 0, $i, 1, $dates['year'] );
									$earnings_array = $model->wps_deals_get_sale_count_earning_by_date( null, $i, $dates['year'] );
									$earnings = $earnings_array['earnings'];
									$totals += $earnings;
									?>
									[<?php echo $date * 1000; ?>, <?php echo $earnings; ?>],
								<?php
								endif;
								$i++;
							endwhile;

						}

	   					?>
	   				],
   					label: "<?php _e( 'Earnings', 'wpsdeals' ); ?>",
   					id: 'earnings'
	   			}],
	   		{
               	series: {
                   lines: { show: true },
                   points: { show: true }
            	},
            	grid: {
           			show: true,
					aboveData: false,
					color: '#ccc',
					backgroundColor: '#fff',
					borderWidth: 2,
					borderColor: '#ccc',
					clickable: false,
					hoverable: true
           		},
            	xaxis: {
	   				mode: "time",
	   				timeFormat: "<?php echo $time_format; ?>",
	   				minTickSize: [1, "<?php echo $tick_size; ?>"]
   				},
   				yaxis: [
   					{ min: 0, tickSize: 1, tickDecimals: 2 },
   					{ min: 0, tickDecimals: 0 }
   				]

            });

	   		function wps_deals_flot_tooltip(x, y, contents) {
		        $('<div id="wps-deals-flot-tooltip">' + contents + '</div>').css( {
		            position: 'absolute',
		            display: 'none',
		            top: y + 5,
		            left: x + 5,
		            border: '1px solid #fdd',
		            padding: '2px',
		            'background-color': '#fee',
		            opacity: 0.80
		        }).appendTo("body").fadeIn(200);
		    }

		    var previousPoint = null;
		    $("#wps_deals_monthly_stats").bind("plothover", function (event, pos, item) {
		        $("#x").text(pos.x.toFixed(2));
		        $("#y").text(pos.y.toFixed(2));
	            if (item) {
	                if (previousPoint != item.dataIndex) {
	                    previousPoint = item.dataIndex;
	                    $("#wps-deals-flot-tooltip").remove();
	                    var x = item.datapoint[0].toFixed(2),
	                        y = item.datapoint[1].toFixed(2);
	                    if( item.series.id == 'earnings' ) {
	                    	if( wps_deals_vars.currency_pos == 'before' ) {
								wps_deals_flot_tooltip( item.pageX, item.pageY, item.series.label + ' ' + wps_deals_vars.currency + y );
	                    	} else {
								wps_deals_flot_tooltip( item.pageX, item.pageY, item.series.label + ' ' + y + wps_deals_vars.currency );
	                    	}
	                    } else {
		                    wps_deals_flot_tooltip( item.pageX, item.pageY, item.series.label + ' ' + y.replace( '.00', '' ) );
	                    }
	                }
	            } else {
	                $("#wps-deals-flot-tooltip").remove();
	                previousPoint = null;
	            }
		    });
	   });
    </script>
	<?php 
	
	    //add something before earning report graph 
		do_action( 'wps_deals_earning_reports_graph_before' );
	?>
	<div class="metabox-holder wps-deals-metabox-holder">
		<div class="postbox">
			<h3><span><?php _e('Earnings', 'wpsdeals'); ?></span></h3>

			<div class="inside">
				<?php wps_deals_reports_graph_controls();?>
				<div id="wps_deals_monthly_stats"></div>
				<p id="wps_deals_graph_totals"><strong><?php _e( 'Total earnings for period shown: ', 'wpsdeals' ); echo $currency->wps_deals_formatted_value( $totals ); ?></strong></p>
				<p id="wps_deals_graph_totals"><strong><?php _e( 'Total sales for period shown: ', 'wpsdeals' ); echo $sales_totals; ?></strong></p>
			</div>
		</div>
	</div>
	<?php
	
		//add something after earning report graph 
		do_action( 'wps_deals_earning_reports_graph_after' );
		
	echo ob_get_clean();
}


/**
 * Show report graph date filters
 *
 * @access      public
 * @since       1.3
 * @return      void
*/

function wps_deals_reports_graph_controls() {
	
	global $wps_deals_model;
	
	$model = $wps_deals_model;
	
	$date_options = apply_filters( 'wps_deals_report_date_options', array(
		'today' 	    => __( 'Today', 'wpsdeals' ),
		'this_week' 	=> __( 'This Week', 'wpsdeals' ),
		'last_week' 	=> __( 'Last Week', 'wpsdeals' ),
		'this_month' 	=> __( 'This Month', 'wpsdeals' ),
		'last_month' 	=> __( 'Last Month', 'wpsdeals' ),
		'this_quarter'	=> __( 'This Quarter', 'wpsdeals' ),
		'last_quarter'	=> __( 'Last Quarter', 'wpsdeals' ),
		'this_year'		=> __( 'This Year', 'wpsdeals' ),
		'last_year'		=> __( 'Last Year', 'wpsdeals' ),
		'other'			=> __( 'Custom', 'wpsdeals' )
	) );

	$dates = wps_deals_get_report_dates();

	$display = $dates['range'] == 'other' ? '' : 'style="display:none;"';

	$view = isset( $_GET['tab'] ) ? $_GET['tab'] : 'earnings';

	?>
	<form id="wps-deals-garphs-filter" method="get" class="wps-deals-form">
		<div class="tablenav top">
			<div class="alignleft actions">

		       	<input type="hidden" name="post_type" value="<?php echo WPS_DEALS_POST_TYPE; ?>"/>
		       	<input type="hidden" name="page" value="wps-deals-reports"/>
		       	<input type="hidden" name="tab" value="<?php echo $view; ?>"/>

		       	<select id="wps-deals-graphs-date-options" name="range">
		       		<?php
		       		foreach ( $date_options as $key => $option ) {
		       			echo '<option value="' . esc_attr( $key ) . '" ' . selected( $key, $dates['range'] ) . '>' . esc_html( $option ) . '</option>';
		       		}
		       		?>
		       	</select>

		       	<div id="wps-deals-date-range-options" <?php echo $display; ?>>
					<span><?php _e( 'From', 'wpsdeals' ); ?>&nbsp;</span>
			       	<select id="wps-deals-graphs-month-start" name="m_start">
			       		<?php for ( $i = 1; $i <= 12; $i++ ) : ?>
			       			<option value="<?php echo absint( $i ); ?>" <?php selected( $i, $dates['m_start'] ); ?>><?php echo $model->wps_deals_month_num_to_name( $i ); ?></option>
				       	<?php endfor; ?>
			       	</select>
			       	<span><?php _e( 'To', 'wpsdeals' ); ?>&nbsp;</span>
			       	<select id="wps-deals-graphs-month-start" name="m_end">
			       		<?php for ( $i = 1; $i <= 12; $i++ ) : ?>
			       			<option value="<?php echo absint( $i ); ?>" <?php selected( $i, $dates['m_end'] ); ?>><?php echo $model->wps_deals_month_num_to_name( $i ); ?></option>
				       	<?php endfor; ?>
			       	</select>
			       	<select id="wps-deals-graphs-year" name="year">
			       		<?php for ( $i = 2007; $i <= $dates['year_end']; $i++ ) : ?>
			       			<option value="<?php echo absint( $i ); ?>" <?php selected( $i, $dates['year'] ); ?>><?php echo $i; ?></option>
				       	<?php endfor; ?>
			       	</select>
			    </div>

			    <input type="hidden" name="wps_deals_action" value="filter_reports" />
		       	<input type="submit" class="button button-secondary" value="<?php _e( 'Filter', 'wpsdeals' ); ?>"/>
			</div>
		</div>
	</form>
	<?php
}


/**
 * Sets up the dates used to filter graph data
 *
 * Date sent via $_GET is read first and then modified (if needed) to match the selected date-range (if any)
 *
 * @access      public
 * @since       1.0.0
 * @return      void
*/

function wps_deals_get_report_dates() {
	$dates = array();

	$dates['range']		= isset( $_GET['range'] )	? $_GET['range']	: 'this_month';
	$dates['day']		= isset( $_GET['day'] ) 	? $_GET['day'] 		: null;
	$dates['m_start'] 	= isset( $_GET['m_start'] ) ? $_GET['m_start'] 	: 1;
	$dates['m_end']		= isset( $_GET['m_end'] ) 	? $_GET['m_end'] 	: 12;
	$dates['year'] 		= isset( $_GET['year'] ) 	? $_GET['year'] 	: wps_deals_current_date( 'Y' );
	$dates['year_end']	= wps_deals_current_date( 'Y' );

	// Modify dates based on predefined ranges
	switch( $dates['range'] ) :

		case 'this_month' :

			$dates['m_start'] 	= wps_deals_current_date( 'n' );
			$dates['m_end']		= wps_deals_current_date( 'n' );
			$dates['year']		= wps_deals_current_date( 'Y' );

			break;

		case 'last_month' :
			if( $dates['m_start'] == 12 ) {
				$dates['m_start'] = 12;
				$dates['m_end']	  = 12;
				$dates['year']    = wps_deals_current_date( 'Y' ) - 1;
				$dates['year_end']= wps_deals_current_date( 'Y' ) - 1;
			} else {
				$dates['m_start'] = wps_deals_current_date( 'n' ) - 1;
				$dates['m_end']	  = wps_deals_current_date( 'n' ) - 1;
				$dates['year']    = wps_deals_current_date( 'Y' );
			}


			break;

		case 'today' :

			$dates['day']		= wps_deals_current_date( 'd' );
			$dates['m_start'] 	= wps_deals_current_date( 'n' );
			$dates['m_end']		= wps_deals_current_date( 'n' );
			$dates['year']		= wps_deals_current_date( 'Y' );

			break;

		case 'this_week' :

			$dates['day']       = date( 'd', wps_deals_current_time() - ( wps_deals_current_date( 'w' ) - 1 ) *60*60*24 );
			$dates['day_end']   = $dates['day'] + 6;
			$dates['m_start'] 	= wps_deals_current_date( 'n' );
			$dates['m_end']		= wps_deals_current_date( 'n' );
			$dates['year']		= wps_deals_current_date( 'Y' );
			break;

		case 'last_week' :

			$dates['day']       = date( 'd', wps_deals_current_time() - ( wps_deals_current_date( 'w' ) - 1 ) *60*60*24 ) - 6;
			$dates['day_end']   = $dates['day'] + 6;
			$dates['m_start'] 	= wps_deals_current_date( 'n' );
			$dates['m_end']		= wps_deals_current_date( 'n' );
			$dates['year']		= wps_deals_current_date( 'Y' );
			break;

		case 'this_quarter' :

			$month_now = wps_deals_current_date( 'n' );

			if ( $month_now <= 3 ) {

				$dates['m_start'] 	= 1;
				$dates['m_end']		= 3;
				$dates['year']		= wps_deals_current_date( 'Y' );

			} else if ( $month_now <= 6 ) {

				$dates['m_start'] 	= 4;
				$dates['m_end']		= 6;
				$dates['year']		= wps_deals_current_date( 'Y' );

			} else if ( $month_now <= 9 ) {

				$dates['m_start'] 	= 7;
				$dates['m_end']		= 9;
				$dates['year']		= wps_deals_current_date( 'Y' );

			} else {

				$dates['m_start'] 	= 10;
				$dates['m_end']		= 12;
				$dates['year']		= wps_deals_current_date( 'Y' );

			}

			break;

		case 'last_quarter' :

			$month_now = wps_deals_current_date( 'n' );

			if ( $month_now <= 3 ) {

				$dates['m_start'] 	= 10;
				$dates['m_end']		= 12;
				$dates['year']		= wps_deals_current_date( 'Y' ) - 1; // Previous year

			} else if ( $month_now <= 6 ) {

				$dates['m_start'] 	= 1;
				$dates['m_end']		= 3;
				$dates['year']		= wps_deals_current_date( 'Y' );

			} else if ( $month_now <= 9 ) {

				$dates['m_start'] 	= 4;
				$dates['m_end']		= 6;
				$dates['year']		= wps_deals_current_date( 'Y' );

			} else {

				$dates['m_start'] 	= 7;
				$dates['m_end']		= 9;
				$dates['year']		= wps_deals_current_date( 'Y' );

			}

			break;

		case 'this_year' :

			$dates['m_start'] 	= 1;
			$dates['m_end']		= 12;
			$dates['year']		= wps_deals_current_date( 'Y' );

			break;

		case 'last_year' :

			$dates['m_start'] 	= 1;
			$dates['m_end']		= 12;
			$dates['year']		= wps_deals_current_date( 'Y' ) - 1;

			break;

	endswitch;

	return apply_filters( 'wps_deals_report_dates', $dates );
}


/**
 * Grabs all of the selected date info and then redirects appropriately
 *
 * @access      public
 * @since       1.0.0
 * @return      void
*/

function wps_deals_parse_report_dates( $data ) {
	$dates = wps_deals_get_report_dates();
	
	$view = isset( $_GET['tab'] ) ? $_GET['tab'] : 'earnings';
	
	wp_redirect( add_query_arg( $dates, admin_url( 'edit.php?post_type='.WPS_DEALS_POST_TYPE.'&page=wps-deals-reports&tab=' . $view ) ) ); 
	exit;
}
add_action( 'wps_deals_filter_reports', 'wps_deals_parse_report_dates' );