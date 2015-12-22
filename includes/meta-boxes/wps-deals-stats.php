<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

	global $wps_deals_model,$wps_deals_currency,$post;
	
	//model class
	$model = $wps_deals_model;
	
	//currency class
	$currency = $wps_deals_currency;
	
	//$dealsales = '0';
	$dealsales = $model->wps_deals_get_post_sale_count_earning($post->ID);
	$earning = '0';
	//$earning = $model->wps_deals_get_earnings();
	
	$html = '';
	$html .= '<table class="form-table wps-deals-stat-table">';
	$html .= '	<tbody>';
	$html .= '		<tr>
						<th scope="row">'.__('Sales : ','wpsdeals').'</th>
						<td>'.$dealsales['salescount'].'</td>
					</tr>';
	$html .= '		<tr>
						<th scope="row">'.__('Earnings : ','wpsdeals').'</th>
						<td>'.$currency->wps_deals_formatted_value($dealsales['earnings']).'</td>
					</tr>';
	$html .= '	</tbody>';
	$html .= '</table>';
	
	echo $html;
?>