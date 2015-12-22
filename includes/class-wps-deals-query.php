<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Contains the query functions for Deals Engine which alter the front-end post queries and loops.
 * 
 * @package Social Deals Engine
 * @since 2.0.7
 */

if ( ! class_exists( 'Wps_Deals_Query' ) ) {
	
	/**
	 * Wps_Deals_Query Class
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.7
	 */
	class Wps_Deals_Query {
	
		/** @public array Query vars to add to wp */
		public $query_vars = array();	
	
		/**
		 * Constructor for the query class.
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.7
		 */
		public function __construct() {
			
			//initialize query variable
			$this->init_query_vars();				
		}
	
		/**
		 * Init query vars by loading options.
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.7
		 */
		public function init_query_vars() {
			
			global $wps_deals_options;
			
			$deals_thank_you_page	= !empty($wps_deals_options['deals_thank_you_page_endpoint']) ? $wps_deals_options['deals_thank_you_page_endpoint'] : 'social-deals-thank-you-page';
			$deals_cancel_page		= !empty($wps_deals_options['deals_cancel_page_endpoint']) ? $wps_deals_options['deals_cancel_page_endpoint'] : 'social-deals-cancel-page';
			$edit_account			= !empty($wps_deals_options['edit_account_endpoint']) ? $wps_deals_options['edit_account_endpoint'] : 'edit-account';
			$edit_address			= !empty($wps_deals_options['edit_address_endpoint']) ? $wps_deals_options['edit_address_endpoint'] : 'edit-address';
			$lost_password			= !empty($wps_deals_options['lost_password_endpoint']) ? $wps_deals_options['lost_password_endpoint'] : 'lost-password';
			$view_orders			= !empty($wps_deals_options['view_orders_endpoint']) ? $wps_deals_options['view_orders_endpoint'] : 'view-orders';
			$create_an_account		= !empty($wps_deals_options['create_an_account_endpoint']) ? $wps_deals_options['create_an_account_endpoint'] : 'create-an-account';
			
			// Query vars to add to WP
			$this->query_vars = apply_filters( 'wps_deals_query_args', array(
															// Checkout actions
															'social-deals-thank-you-page' 	=> $deals_thank_you_page,
															'social-deals-cancel-page'		=> $deals_cancel_page,	
															
															// My account actions	
															'edit-account'    				=> $edit_account,			
															'edit-address'      			=> $edit_address,
															'lost-password'     			=> $lost_password,
															'view-orders'   				=> $view_orders,
															'create-an-account' 			=> $create_an_account
														)
											);
		}
		
		/**
		 * Add endpoints for query vars
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.7
		 */
		public function add_endpoints() {
			foreach ( $this->query_vars as $key => $var )
				add_rewrite_endpoint( $var, EP_ROOT | EP_PAGES );
		}
	
		/**
		 * add_query_vars function.
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.7
		 */
		public function add_query_vars( $vars ) {
			
			foreach ( $this->query_vars as $key => $var ) {
				$vars[] = $key;
			}
			
			return $vars;
		}
	
		/**
		 * Get query vars
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.7
		 */
		public function get_query_vars() {
			
			return $this->query_vars;
		}
	
		/**
		 * Parse the request and look for query vars - endpoints may not be supported
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.7	
		 */
		public function parse_request() {
			
			global $wp;
	
			// Map query vars to their keys, or get them if endpoints are not supported
			foreach ( $this->query_vars as $key => $var ) {
				
				if ( isset( $_GET[ $var ] ) ) {
					$wp->query_vars[ $key ] = $_GET[ $var ];
				} elseif ( isset( $wp->query_vars[ $var ] ) ) {
					$wp->query_vars[ $key ] = $wp->query_vars[ $var ];
				}
			}
		}
		
		/**
		 * Adding Hooks		
		 *
		 * @package Social Deals Engine
		 * @since 2.0.7
		 */
		public function add_hooks() {
			
			//call to add_endpoints for rewriting query vars end points
			add_action( 'init', array( $this, 'add_endpoints' ) );	
	
			if ( ! is_admin() ) {
				
				//call to add_query_vars for adding quert vars
				add_filter( 'query_vars', array( $this, 'add_query_vars'), 0 );
				
				// call to parse_request for mapping query var to their keys
				add_action( 'parse_request', array( $this, 'parse_request'), 0 );			
			}				
		}
	}
}