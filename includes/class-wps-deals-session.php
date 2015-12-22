<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Deals Session Class
 * 
 * Handles to controll all deals engine sessions
 *
 * @package Social Deals Engine
 * @since 1.0.0
 **/
class Wps_Deals_Session {
	
	/**
	 * Holds Session data
	 **/
	private $session = array();
	
	public function __construct() {
		
		//sesion start
		add_action( 'init', array( $this, 'start_session' ) );
		
		//check session is empty or not
		if ( empty( $this->session ) ) {
			//set default session for deals engine when class session is empty
			add_action( 'plugins_loaded', array( $this, 'session_load' ), -1 );
		} else {
			//set default session for deals engine when class session is empty
			add_action( 'init', array( $this, 'session_load' ), -1 );
		}
	}
	
	/**
	 * Session Start
	 * 
	 * Handles to start the session
	 * if it is not already started
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function start_session() {
		
		//check session is already started or not
		if( !session_id() ) { 
			session_start();
		}
	}
	
	/**
	 * Load Session Initial
	 * 
	 * Handles to load initial
	 * session
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function session_load() {
		
		//check default session of deals engine is set or not
		$this->session = isset( $_SESSION ) ? $_SESSION : array();
		
		//return session array
		return $this->session;
	}
	/**
	 * Get Session Variable
	 * 
	 * Handles to get session variable from its
	 * key value
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function get( $key ) {
		
		//sanitize the key value
		$key = sanitize_key( $key );
		
		//get session for particular key
		$deal_session = isset( $this->session[ $key ] ) ? $this->session[ $key ] : false;
		
		//return found session data
		return $deal_session;
		
	}
	/**
	 * Set a Session Variable
	 *
	 * 
	 * Handles to set session variable from its
	 * key value
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function set( $key, $value ) {
		
		//sanitize the key value
		$key = sanitize_key( $key );
		
		//check value is set then overwrite the value of the data
		$this->session[ $key ] = $value;
		
		//set session
		$_SESSION = $this->session;

		//return set session key
		return $this->session[ $key ];
	}
	/**
	 * Remove a Session Variable
	 *
	 * Handles to set session variable from its
	 * key value
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function remove( $key ) {

		//sanitize the key value
		$key = sanitize_key( $key );
		
		//check key is set in session or not
		if( isset( $this->session[ $key ] ) ) {
			unset( $this->session[ $key ] );
		}

		//set session
		$_SESSION = $this->session;

		//return set session key
		return $this->session;
	}
}
?>