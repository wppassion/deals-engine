<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Model Class
 *
 * Handles generic plugin functionality, mostly Social Media
 * realted for all different features of social media
 * like facebook,twitter,linkedin,google+
 * 
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Social_Model {
	
	public $model;
	
	public function __construct() {

		global $wps_deals_model;
		
		$this->model = $wps_deals_model;
		
	}
	/**
	 * Create User
	 *
	 * Function to add connected users to the WordPress users database
	 * and add the role subscriber
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */

	public function wps_deals_social_add_wp_user( $criteria ) {

		global $wp_version;

		$prefix = 'wps_user_';
		$username = $prefix . wp_rand(100, 9999999);
		while (username_exists($username)){ // avoid duplicate user name
			$username = $prefix . wp_rand(100, 9999999);
		}
		$name = $criteria['name'];
		$first_name = $criteria['first_name'];
		$last_name = $criteria['last_name'];
		$password = wp_generate_password(12, false);
		$email = $criteria['email'];
		$wp_id = 0;
		
		//create the WordPress user
		if ( version_compare($wp_version, '3.1', '<') ) {
			require_once( ABSPATH . WPINC . '/registration.php' );
		}
		
		//check user id is exist or not
		if ( email_exists($email) == false ) {
			
			$wp_id = wp_create_user( $username, $password, $email );
			
			if( !empty( $wp_id ) ) { //if user is created then update some data
				$role = 'subscriber';
				$user = new WP_User( $wp_id );
				$user->set_role( $role );
				wp_new_user_notification( $wp_id, $password );
			}
			
		} else {
			//get user from email
			$userdata = get_user_by( 'email', $email );
			
			if( !empty( $userdata ) ) { //check user is exit or not
				$wp_id = $userdata->ID;
			}			
		}
		return $wp_id;
	}
	
	/**
	 * Get Social Connected Users Count
	 * 
	 * Handles to return connected user counts
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_get_users( $args = array() ) {
		
		$userargs = array();
		$metausr1 = array();
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		if( isset( $args['network'] ) && !empty( $args['network'] ) ) { //check network is set or not
			$metausr1['key'] = $prefix.'social_user_connect_via';
			$metausr1['value'] = $args['network'];
		}
		
		if( !empty($metausr1) ) { //meta query
			$userargs['meta_query'] = array( $metausr1 );
		}
		
		//get users data
		$result = new WP_User_Query($userargs);
		
		if ( isset( $args['getcount'] ) && !empty( $args['getcount'] ) ) { //get count of users
			$users = $result->total_users;
		} else {
			//retrived data is in object format so assign that data to array for listing
			$users = $this->model->wps_deals_object_to_array( $users->results );
		}
		return $users;
	}
}
?>