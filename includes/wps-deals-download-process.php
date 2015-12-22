<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Process Download
 *
 * Handles the file download process
 * 
 * @package Social Deals Engine
 * @since 1.0.0
*/

/**
 * Process to Download
 * 
 * Hanldes to download file from link
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

function wps_deals_process_download() {
	
	global $wps_deals_model,$current_user;
	
	//model class
	$model = $wps_deals_model;
	
	$args = apply_filters( 'wps_deals_process_download_args', array(
		'orderid'	=> ( isset( $_GET['order_key'] ) )	? base64_decode( $_GET['order_key'] )				: false,
		'dealid' 	=> ( isset( $_GET['deal_id'] ) )	? (int) $_GET['deal_id']							: '',
		'email'    	=> ( isset( $_GET['email'] ) )		? rawurldecode( $_GET['email'] )					: '',
		'expire'   	=> ( isset( $_GET['expire'] ) )		? base64_decode( rawurldecode( $_GET['expire'] ) )	: '',
		'file_key' 	=> ( isset( $_GET['file'] ) )		? (int) $_GET['file']								: '',
		
	) );
	
	if( $args['orderid'] === '' || $args['email'] === '' || $args['file_key'] === '') //check download,email,file key should not blank
		return false;
	
	 extract( $args );
	
	//check deal is exist or not
	$dealsdata = get_post( $dealid );

	if( empty( $dealsdata ) ) { //check deal is exist or not
		$error_message = __('<strong>ERROR : </strong>You can not download this file because the deal is no more available.','wpsdeals');
		wp_die( apply_filters( 'wps_deals_deny_download_message', $error_message ), __('Deal is no more available', 'wpsdeals') );
	}
	
	$verify = $model->wps_deals_verify_download_link( $dealid, $email, $expire, $file_key, $orderid );
	
	// Defaulting this to true for now because the method below doesn't work well
	$has_access = apply_filters( 'wps_deals_file_download_has_access', true, $verify, $args );
	
	
	
	if( $verify && $has_access ) { //check validation is success
		
		do_action( 'wps_deals_process_verified_download', $dealid, $email );

		// Payment has been verified, setup the download
		$downloadfiles = $model->wps_deals_get_download_files( $dealid );

		$request_file = apply_filters( 'wps_deals_requested_file', $downloadfiles[ $file_key ] );

		$user_info = array();
		$user_info['email'] = $email;
		if ( is_user_logged_in() ) {
			
			global $user_ID;
			$user_data 			= get_userdata( $user_ID );
			$user_info['id'] 	= $user_ID;
			$user_info['name'] 	= $user_data->display_name;
		}

		wps_deals_record_download_in_log( $dealid, $file_key, $user_info, wps_deals_getip(), $verify );

		$extension = wps_deals_get_file_extension( $request_file );
		$ctype     = wps_deals_get_file_ctype( $extension );
		
		if( function_exists( 'get_magic_quotes_runtime' ) && get_magic_quotes_runtime() ) {
			set_magic_quotes_runtime(0);
		}

		@session_write_close();
		if( function_exists( 'apache_setenv' ) ) @apache_setenv('no-gzip', 1);
		@ini_set( 'zlib.output_compression', 'Off' );

		nocache_headers();
		header("Robots: none");
		header("Content-Type: " . $ctype . "");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=\"" . apply_filters( 'wps_deals_requested_file_name', basename( $request_file ) ) . "\";");
		header("Content-Transfer-Encoding: binary");

		if( strpos( $request_file, 'http://' ) === false && strpos( $request_file, 'https://' ) === false && strpos( $request_file, 'ftp://' ) === false ) {

			// This is an absolute path

			$request_file = realpath( $request_file );
			if( file_exists( $request_file ) ) {
				if( $size = @filesize( $request_file ) ) header("Content-Length: ".$size);
				@wps_deals_readfile_chunked( $request_file );
			} else {
				wp_die( __('<strong>ERROR : </strong>Sorry but this file does not exist.', 'wpsdeals'), __('Download Error', 'wpsdeals') );
			}

		} else if( strpos( $request_file, WP_CONTENT_URL ) !== false) {

			// This is a local file given by URL
			$upload_dir = wp_upload_dir();

			$request_file = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $request_file );
			$request_file = realpath( $request_file );

			if( file_exists( $request_file ) ) {
				if( $size = @filesize( $request_file ) ) header("Content-Length: ".$size);
				@wps_deals_readfile_chunked( $request_file );
			} else {
				wp_die( __('<strong>ERROR : </strong>Sorry but this file does not exist.', 'wpsdeals'), __('Download Error', 'wpsdeals') );
			}

		} else {
			// This is a remote file
			header("Location: " . $request_file);
		}

		exit;
		
	} else {
		
		$error_message = __('<strong>ERROR : </strong>You do not have permission to download this file.','wpsdeals');
		wp_die( apply_filters( 'wps_deals_deny_download_message', $error_message ), __('Purchase Verification Failed', 'wpsdeals') );
		
	}
	
	
}

add_action( 'init', 'wps_deals_process_download');

function wps_deals_record_download_in_log( $deals_id, $file_id, $user_info, $ip, $payment_id ) {
	
	global $wps_deals_logs;

	$log_data = array(
		'post_parent'	=> $deals_id,
		'log_type'		=> 'downloads'
	);

	$userid = (int) isset( $user_info['id'] ) ? $user_info['id'] : 0;
	
	$log_meta = array(
		'user_info'	=> $user_info,
		'user_id'	=> $userid,
		'file_id'	=> (int) $file_id,
		'ip'		=> $ip,
		'payment_id'=> $payment_id
	);

	$log_id = $wps_deals_logs->insert_logs( $log_data, $log_meta );
}
?>