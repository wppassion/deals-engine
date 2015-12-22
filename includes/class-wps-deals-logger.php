<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Log Class
 *
 * Handles generic plugin functionality.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Payment_Log {
	
	private $_handles;

	/**
	 * Constructor for the logger.
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */
	public function __construct() {
		$this->_handles = array();
	}


	/**
	 * Destructor.
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */
	public function __destruct() {
		foreach ( $this->_handles as $handle )
	       @fclose( escapeshellarg( $handle ) );
	}


	/**
	 * Open log file for writing.
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */
	private function wps_deals_open( $handle ) {
		
		if ( isset( $this->_handles[ $handle ] ) )
			return true;

		if ( $this->_handles[ $handle ] = @fopen( WPS_DEALS_LOG_DIR . $this->wps_deals_file_name( $handle ), 'a' ) )
			return true;

		return false;
	}


	/**
	 * Add a log entry to chosen file.
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */
	public function wps_deals_add( $handle, $message ) {
		if ( $this->wps_deals_open( $handle ) && is_resource( $this->_handles[ $handle ] ) ) {
			$time = date_i18n( 'm-d-Y @ H:i:s -' ); //Grab Time
			@fwrite( $this->_handles[ $handle ], $time . " " . $message . "\n" );
		}
	}


	/**
	 * Clear entries from chosen file.
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */
	public function wps_deals_clear( $handle ) {

		if ( $this->wps_deals_open( $handle ) && is_resource( $this->_handles[ $handle ] ) )
			@ftruncate( $this->_handles[ $handle ], 0 );
	}


	/**
	 * file_name function.
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */
	public function wps_deals_file_name( $handle ) {
		return $handle . '-' . sanitize_file_name( wp_hash( $handle ) ) . '.txt';
	}
}
?>