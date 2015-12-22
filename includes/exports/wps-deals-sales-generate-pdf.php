<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Export Deals Report Data
 *
 * Handles to generate deals report data to pdf
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_report_to_pdf() {
	
	global $wps_deals_model;
	
	//model class 
	$model = $wps_deals_model;
	
	if(isset($_POST['wps-deals-sales-report-pdf']) && !empty($_POST['wps-deals-sales-report-pdf'])) { //check post is set or not
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		require_once 'PDF/class-wps-deals-fpdf.php';
		require_once 'PDF/class-wps-deals-pdf.php';
		
		//if search is call then pass searching value to function for displaying searching values
		$args = array();
		
		//sorting as per payment status
		if(isset($_GET['payment_status'])) {
			$args['meta_query'] = array( array( 'key' => $prefix . 'payment_status', 'value' => $_GET['payment_status'] ) );
		}
		
		if(isset($_GET['userid'])){
			$args['author'] = $_GET['userid'];
		}
		
		//get deals sale data from database
		$data = $model->wps_deals_get_sales( $args );
		
		$columns = apply_filters('wps_deals_sales_pdf_column',
						array(
								array('name' => __('NO.','wpsdeals') 		, 'width' => 13), 
								array('name' => __('Order ID','wpsdeals') 	, 'width' => 18), 
								array('name' => __('User Name','wpsdeals') 	, 'width' => 30), //35
								array('name' => __('User Email','wpsdeals') , 'width' => 75), //80
								array('name' => __('Amount','wpsdeals') 	, 'width' => 25),
								array('name' => __('User','wpsdeals') 		, 'width' => 30),
								array('name' => __('Status','wpsdeals') 	, 'width' => 30),
								array('name' => __('Date/Time','wpsdeals') 	, 'width' => 60)
						));
		
		$pdf = new Wps_Deals_Pdf();
		$pdf->AddPage( 'L', 'A4' );
		
		// Auther name and Creater name
		$pdf->SetTitle( utf8_decode(__('WPSocial Deals Pdf Generate','wpsdeals')) );
		$pdf->SetAuthor( utf8_decode( __('Social Deals Engine','wpsdeals') ) );
		$pdf->SetCreator( utf8_decode( __('Social Deals Engine','wpsdeals') ) );
		
		$pdf->Image( WPS_DEALS_URL . 'includes/images/wps-logo.png', 256, 10 );
		
		// Set margine of pdf (float left, float top , float right)
		$pdf->SetMargins( 8, 8, 8 );
		$pdf->SetX( 8 );
		
		
		// Font size set
		$pdf->SetFont( 'Helvetica', '', 18 );
		$pdf->SetTextColor( 50, 50, 50 );
		$pdf->Ln(3);
		$pdf->Cell( 270, 5, utf8_decode( __( 'Deal Sales','wpsdeals' ) ), 0, 2, 'C', false );
		$pdf->SetFont( 'Helvetica', '', 12 );
		$pdf->SetFillColor( 238, 238, 238 );
		$pdf->Ln(4);
		
		if(!empty($data)) {
			
			//set width of columns
			$pdf->SetWidths( apply_filters('wps_deals_sales_pdf_columns_width',array( 13, 18, 30, 75, 25, 30, 30, 60 ) ) );
			
			// Table head Code
			foreach ($columns as $column) {
				// parameter : (height, width, string, border[0 - no border, 1 - frame], )

				$pdf->Cell( $column['width'], 8, utf8_decode($column['name']), 1, 0, 'C', true );
			}
			$pdf->Ln();	
			
			$no = 1;
			
			foreach ($data as $key => $value){
				
				//this line should be on start of loop
				$data[$key]	= apply_filters('wps_deals_sales_pdf_column_data',$value,$value['ID']);
				
				// get the value for the user details from the post meta box
				$userdetails = $model->wps_deals_get_ordered_user_details($value['ID']);
				
				// get the value for the order details from the post meta box
				$order_details = $model->wps_deals_get_post_meta_ordered($value['ID']);
				
				// get the value for the payment status from the post meta box
				$payment_status = $model->wps_deals_get_ordered_payment_status($value['ID']);
				
				$user_id = isset( $userdetails['user_id'] ) && !empty( $userdetails['user_id'] ) ? $userdetails['user_id'] : '0';
    	
		    	if ( is_numeric( $user_id ) ) { //check user id is numeric or not
		    		$userdata = get_userdata( $user_id ) ;
					$username = is_object( $userdata ) ? $userdetails['first_name'] : __( 'guest', 'wpsdeals' );
				} else { //else user is guest
					$username = __( 'guest', 'wpsdeals' );
				}
				
				$displayusername = isset($userdetails['first_name']) && !empty($userdetails['first_name']) ? $userdetails['first_name'].' '.$userdetails['last_name'] : $userdetails['user_name'];
				
				$data[$key]['user_details']		= !empty($userdetails) ? $userdetails : array();
				$data[$key]['useremail'] 		= isset($userdetails['user_email']) ? $userdetails['user_email'] : '';
				$data[$key]['payment_status']	= isset($payment_status) ? $payment_status : '';
				$data[$key]['amount']			= $order_details['display_order_total'];
				$data[$key]['date_time']		= $model->wps_deals_get_date_format($value['post_date'],true);
				$data[$key]['payment_method']	= isset( $order_details['admin_label'] ) ? $order_details['admin_label'] : $order_details['payment_method'];
				$data[$key]['user_id']			= $userdetails['user_id'];
				$data[$key]['user_name']		= $username;
				
				$generatedrow =  apply_filters( 'wps_deals_sales_pdf_generate_row_data',
												array( 
														$no,
														$data[$key]['ID'], 
														$displayusername, 
														$data[$key]['useremail'], 
														html_entity_decode($data[$key]['amount']), 
														$data[$key]['user_name'], 
														$data[$key]['payment_status'], 
														$data[$key]['date_time'] 
													)
												);
				//generate row
				$pdf->Row( $generatedrow );
				$no++;
			}
		} else {
			
			$pdf->SetWidths( array( 280 ) );
			$pdf->SetAligns('C');
			$title = utf8_decode( __('No Sales Data found.','wpsdeals') );
			$pdf->Row( array( $title ) );
		}
		
		$pdf->Output( 'wps-deals-sales-reports-' . wps_deals_current_date('d-m-Y') . '.pdf', 'D' );
	}
}
add_action('init','wps_deals_report_to_pdf');
?>