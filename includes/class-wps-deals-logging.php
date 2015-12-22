<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Logging Class
 *
 * Handles all the different functionalities of logs
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Logging {
	
	public function __construct(){
		
		// Create the log post type
		add_action( 'init', array( $this, 'register_post_type' ), -1 );

		// Create types taxonomy and default types
		add_action( 'init', array( $this, 'register_taxonomy' ), -1 );
		
	}
	/**
	 * Registers the deals log Post Type
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 */

	public function register_post_type() {
	
		//register deals logs post type
		$log_args = array(
							'labels'			=> array( 'name' => __( 'Logs', 'wpsdeals' ) ),
							'public'			=> false,
							'query_var'			=> false,
							'rewrite'			=> false,
							'capability_type'	=> 'post',
							'supports'			=> array( 'title', 'editor' ),
							'can_export'		=> true
						);
		register_post_type( WPS_DEALS_LOGS_POST_TYPE, $log_args );
	}
	
	/**
	 * Registers the Type Taxonomy
	 *
	 * The Type taxonomy is used to determine the type of log entry
	 *
	 * @package Social Deals Engine
 	 * @since 1.0.0
	*/
	function register_taxonomy() {
		register_taxonomy( WPS_DEALS_LOGS_TAXONOMY, WPS_DEALS_LOGS_POST_TYPE, array( 'public' => false ) );

		$types = $this->get_log_types();

		foreach ( $types as $type ) {
			if( ! term_exists( $type, WPS_DEALS_LOGS_TAXONOMY ) ) {
				wp_insert_term( $type, WPS_DEALS_LOGS_TAXONOMY );
			}
		}
	}
	
	/**
	 * Log types
	 *
	 * Sets up the default log types and allows for new ones to be created
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function get_log_types() {
		
		$types = array('downloads','sales');

		return apply_filters( 'wps_deals_log_types', $types );
	}
	/**
	 * Check if a log type is valid
	 *
	 * Checks to see if the specified type is in the registered list of types
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function valid_logs_type( $type ) {
		return in_array( $type, $this->get_log_types() );
	}
	
	/**
	 * Create new log entry
	 *
	 * This is just a simple and fast way to log something. Use $this->insert_logs()
	 * if you need to store custom meta data
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function add( $title = '', $message = '', $parent = 0, $type = null ) {
		
		$log_data = array(
			'post_title' 	=> $title,
			'post_content'	=> $message,
			'post_parent'	=> $parent,
			'log_type'		=> $type
		);

		return $this->insert_logs( $log_data );
	}
	/**
	 * Easily retrieves log items for a particular object ID
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function get_logs( $object_id = 0, $type = null, $paged = null ) {
		return $this->get_connected_logs( array( 'post_parent' => $object_id, 'paged' => $paged, 'log_type' => $type ) );
	}
	/**
	 * Stores a log entry
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function insert_logs( $log_data = array(), $log_meta = array() ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$defaults = array(
			'post_type' 	=> WPS_DEALS_LOGS_POST_TYPE,
			'post_status'	=> 'publish',
			'post_parent'	=> 0,
			'post_content'	=> '',
			'log_type'		=> false
		);

		$args = wp_parse_args( $log_data, $defaults );

		do_action( 'wps_deals_insert_logs_before' );

		// Store the log entry
		$log_id = wp_insert_post( $args );

		// Set the log type, if any
		if ( $log_data['log_type'] && $this->valid_logs_type( $log_data['log_type'] ) ) {
			wp_set_object_terms( $log_id, $log_data['log_type'], WPS_DEALS_LOGS_TAXONOMY, false );
		}

		// Set log meta, if any
		if ( $log_id && ! empty( $log_meta ) ) {
			foreach ( (array) $log_meta as $key => $meta ) {
				update_post_meta( $log_id, $prefix.'log_' . sanitize_key( $key ), $meta );
			}
		}

		do_action( 'wps_deals_insert_logs_after', $log_id );

		return $log_id;
	}
	/**
	 * Update and existing log item
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function update_logs( $log_data = array(), $log_meta = array() ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		do_action( 'wps_deal_update_logs_before', $log_id, $log_data, $log_meta );

		$defaults = array(
			'post_type' 	=> WPS_DEALS_LOGS_POST_TYPE,
			'post_status'	=> 'publish',
			'post_parent'	=> 0
		);

		$args = wp_parse_args( $log_data, $defaults );

		// Store the log entry
		$log_id = wp_update_post( $args );

		if ( $log_id && ! empty( $log_meta ) ) {
			foreach ( (array) $log_meta as $key => $meta ) {
				if ( ! empty( $meta ) )
					update_post_meta( $log_id, $prefix.'log_' . sanitize_key( $key ), $meta );
			}
		}

		do_action( 'wps_deal_update_logs_after', $log_id, $log_data, $log_meta );
	}
	/**
	 * Retrieve all connected logs
	 *
	 * Used for retrieving logs related to particular items, such as a specific purchase.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_connected_logs( $args = array() ) {
		
		$defaults = array(
			'post_type'      => WPS_DEALS_LOGS_POST_TYPE,
			'posts_per_page' => 20,
			'post_status'    => 'publish',
			//'paged'          => get_query_var( 'paged' ),
			'log_type'       => false
		);

		$query_args = wp_parse_args( $args, $defaults );

		if ( $query_args['log_type'] && $this->valid_logs_type( $query_args['log_type'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' 	=> WPS_DEALS_LOGS_TAXONOMY,
					'field'		=> 'slug',
					'terms'		=> $query_args['log_type']
				)
			);
		}

		$logs = get_posts( $query_args );

		if ( $logs )
			return $logs;

		// No logs found
		return false;
	}

	/**
	 * Retrieves number of log entries connected to particular object ID
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_log_count( $object_id = 0, $type = null, $meta_query = null ) {
		
		$query_args = array(
			'post_parent' 	=> $object_id,
			'post_type'		=> WPS_DEALS_LOGS_POST_TYPE,
			'posts_per_page'=> -1,
			'post_status'	=> 'publish'
		);

		if ( ! empty( $type ) && $this->valid_logs_type( $type ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' 	=> WPS_DEALS_LOGS_TAXONOMY,
					'field'		=> 'slug',
					'terms'		=> $type
				)
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query_args['meta_query'] = $meta_query;
		}
		
		$logs = new WP_Query( $query_args );

		return (int) $logs->post_count;
	}
	/**
	 * Delete log entries connected to particular object ID
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function delete_logs( $object_id = 0, $type = null, $meta_query = null  ) {
		
		$query_args = array(
			'post_parent' 	=> $object_id,
			'post_type'		=> WPS_DEALS_LOGS_POST_TYPE,
			'posts_per_page'=> -1,
			'post_status'	=> 'publish',
			'fields'        => 'ids'
		);

		if ( ! empty( $type ) && $this->valid_logs_type( $type ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' 	=> WPS_DEALS_LOGS_TAXONOMY,
					'field'		=> 'slug',
					'terms'		=> $type,
				)
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query_args['meta_query'] = $meta_query;
		}

		$logs = get_posts( $query_args );

		if ( $logs ) {
			foreach ( $logs as $log ) {
				wp_delete_post( $log, true );
			}
		}
	}
}
/**
 * Record a log entry
 *
 * This is just a simple wrapper function for the log class add() function
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_record_log( $title = '', $message = '', $parent = 0, $type = null ) {
	$logs = new Wps_Deals_Logging();
	$log = $logs->add( $title, $message, $parent, $type );
	return $log;
}
?>