<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Social Class
 *
 * Handles to control all social media
 * related functionlities
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Social_Public {
	
	public $socialmodel,$model,$cart,$session;
	public $facebook,$twitter,$linkedin,$yahoo,$foursquare,$windowslive;
	
	public function __construct() {
		
		global $wps_deals_social_model,$wps_deals_model,
				$wps_deals_cart,$wps_deals_session,
				$wps_deals_social_facebook,$wps_deals_social_twitter,
				$wps_deals_social_google,$wps_deals_social_linkedin,
				$wps_deals_social_yahoo,$wps_deals_social_foursquare,
				$wps_deals_social_windowslive;
		
		$this->socialmodel	= $wps_deals_social_model;
		$this->model		= $wps_deals_model;
		$this->cart			= $wps_deals_cart;
		$this->session		= $wps_deals_session;
		
		//social objects
		$this->facebook		= $wps_deals_social_facebook;
		$this->twitter		= $wps_deals_social_twitter;
		$this->google		= $wps_deals_social_google;
		$this->linkedin		= $wps_deals_social_linkedin;
		$this->yahoo		= $wps_deals_social_yahoo;
		$this->foursquare	= $wps_deals_social_foursquare;
		$this->windowslive	= $wps_deals_social_windowslive;
		
	}
	
	/**
	 * AJAX Call
	 * 
	 * Handles to Call ajax for register user
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_login() {
		
		global $wps_deals_options;
		
		$type = $_POST['type'];
		$result = array();
		$data = array();
		$usercreated = 0;
		
		//created user who will connect via facebook
		if( $type == 'facebook' ) {
			
			$userid = $this->facebook->wps_deals_social_get_fb_user();
			
			//if user id is null then return
			if( empty( $userid ) ) return;
			
			$userdata = $this->facebook->wps_deals_social_get_fb_userdata( $userid );
			
			//check permission data user given to application
			$permData = $this->facebook->wps_deals_check_fb_app_permission( 'publish_stream' );
		
			if( empty( $permData ) ) { //if user not give the permission to api and user type is facebook then it will redirected
				
				$redirect_url = $wps_deals_options['fb_redirect_url'];
				$result['redirect'] = $redirect_url;
				echo json_encode( $result );
				//do exit to get proper result
				exit;
			}
			
			//check facebook user data is not empty
			if( !empty( $userdata ) && isset( $userdata['email'] ) ) { //check isset user email from facebook
				
				$data['first_name'] = $userdata['first_name'];
				$data['last_name'] = $userdata['last_name'];
				$data['name'] = $userdata['name'];
				$data['email'] = $userdata['email'];
				$data['type'] = $type;
				$data['all'] = $userdata;
				$data['link'] = $userdata['link'];
				$data['id']	= $userdata['id'];
				
				//create user
				$usercreated = $this->wps_deals_social_create_user( $data );
				
				//check user is created or not
				if( $usercreated ) {
					$result['success'] = '1';
				}
			}
		} else if( $type == 'googleplus' ) { //check type is googleplus
			
			$gp_userdata = $this->google->wps_deals_social_get_google_user_data();
			
			//check google user data is not empty
			if( !empty( $gp_userdata ) ) {
				
				$data['first_name'] = $gp_userdata['name']['givenName'];
				$data['last_name'] = $gp_userdata['name']['familyName'];
				$data['name'] = $gp_userdata['displayName'];
				$data['email'] = $gp_userdata['email'];
				$data['type'] = $type;
				$data['all'] = $gp_userdata;
				$data['link'] = $gp_userdata['url'];
				$data['id']	= $gp_userdata['id'];
				
				//create user
				$usercreated = $this->wps_deals_social_create_user( $data );
				
				//check user is created or not
				if( $usercreated ) {
					$result['success'] = '1';
				}
			}
		} else if( $type == 'linkedin' ) { //check type is linkedin
			
			$li_userdata = $this->linkedin->wps_deals_social_get_linkedin_user_data();
			
			//check user data is set and user id of linkedin is set and not empty
			if( !empty( $li_userdata ) && isset( $li_userdata['id'] ) && !empty( $li_userdata['id'] ) ) {
				
				$data['first_name']	= $li_userdata['firstName'];
				$data['last_name']	= $li_userdata['lastName'];
				$data['name']		= $li_userdata['firstName'].' '.$li_userdata['lastName'];
				$data['email']		= $li_userdata['emailAddress'];
				$data['type']		= $type;
				$data['all']		= $li_userdata;
				$data['link']		= $li_userdata['publicProfileUrl'];
				$data['id']			= $li_userdata['id'];
				
				//create user
				$usercreated = $this->wps_deals_social_create_user( $data );
				
				//check user is created or not
				if( $usercreated ) {
					$result['success'] = '1';
				}
			}
			
		} else if( $type == 'yahoo' ) { //check type is yahoo
			
			$yh_userdata = $this->yahoo->wps_deals_social_get_yahoo_user_data();
			
			//check yahoo user data is not empty
			if( !empty( $yh_userdata ) ) {
				
				$email		= '';
				$last_email	= '';
				
				if( isset( $yh_userdata->emails ) && !empty( $yh_userdata->emails ) && is_array( $yh_userdata->emails ) ) {
					foreach ( $yh_userdata->emails as $key => $value ) {
						$last_email	= isset( $value->handle ) ? $value->handle : '';
						if( isset($value->primary) && $value->primary ) {
							$email	= $value->handle;
						}
					}
					
					if( empty( $email ) ) {
						$email	= $last_email;
					}
				}
				
				$data['first_name'] = $yh_userdata->givenName;
				$data['last_name'] = $yh_userdata->familyName;
				$data['name'] = $yh_userdata->givenName.' '.$yh_userdata->familyName;
				$data['email'] = $email;
				$data['type'] = $type;
				$data['all'] = $yh_userdata;
				$data['link'] = $yh_userdata->profileUrl;
				$data['id']	= $yh_userdata->guid;
				
				//create user
				$usercreated = $this->wps_deals_social_create_user( $data );
				
				//check user is created or not
				if( $usercreated ) {
					$result['success'] = '1';
				}
			}
			
		} else if( $type == 'foursquare' ) { //check type is four squere
			
			$fs_userdata = $this->foursquare->wps_deals_social_get_foursquare_user_data();
			
			//check foursquare user data is not empty
			if( !empty( $fs_userdata ) ) {
				
				$data['first_name'] = $fs_userdata->firstName;
				$data['last_name'] = $fs_userdata->lastName;
				$data['name'] = $fs_userdata->firstName.' '.$fs_userdata->lastName;
				$data['email'] = $fs_userdata->contact->email;
				$data['type'] = $type;
				$data['all'] = $fs_userdata;
				$data['link'] = 'https://foursquare.com/user/' . $fs_userdata->id;
				$data['id']	= $fs_userdata->id;
				
				//create user
				$usercreated = $this->wps_deals_social_create_user( $data );
				
				//check user is created or not
				if( $usercreated ) {
					$result['success'] = '1';
				}
			}
			
		} else if( $type == 'windowslive' ) { //check type is windowslive
			
			$wl_userdata = $this->windowslive->wps_deals_social_get_windowslive_user_data();
			
			//check windowslive user data is not empty
			if( !empty( $wl_userdata ) ) {
				
				$wlemail = isset( $wl_userdata->emails->preferred ) ? $wl_userdata->emails->preferred
							: $wl_userdata->emails->account;
				
				$data['first_name'] = $wl_userdata->first_name;
				$data['last_name'] = $wl_userdata->last_name;
				$data['name'] = $wl_userdata->name;
				$data['email'] = $wlemail;
				$data['type'] = $type;
				$data['all'] = $wl_userdata;
				$data['link'] = $wl_userdata->link;
				$data['id']	= $wl_userdata->id;
				
				//create user
				$usercreated = $this->wps_deals_social_create_user( $data );
				
				//check user is created or not
				if( $usercreated ) {
					$result['success'] = '1';
				}
			}
			
		}
		
		//do action when user successfully created
		do_action( 'wps_deals_social_create_user_after', $type, $usercreated );
		
		echo json_encode( $result );
		//do exit to get proper result
		exit;
		
	}
	
	/**
	 * Add User
	 * 
	 * Handles to Add user to wordpress database
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_create_user( $userdata ) {
		
		// register a new WordPress user
		$wp_user_data = array();
		$wp_user_data['name'] = $userdata['name'];
		$wp_user_data['first_name'] = $userdata['first_name'];
		$wp_user_data['last_name'] = $userdata['last_name'];
		$wp_user_data['email'] = $userdata['email'];
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$wp_id = $this->socialmodel->wps_deals_social_add_wp_user( $wp_user_data );
		
		if( $wp_id > 0 ) { //check wordpress user id is greater then zero
			
			update_user_meta( $wp_id, $prefix . 'social_data', $userdata['all'] );
			update_user_meta( $wp_id, $prefix . 'social_user_connect_via', $userdata['type'] );
			update_user_meta( $wp_id, $prefix . 'social_identifier', $userdata['id'] );
			
			$wpuserdetails = array ( 	
										'ID'			=>	$wp_id, 
										'user_url'		=>	$userdata['link'], 
										'first_name'	=>  $userdata['first_name'],
										'last_name'		=>	$userdata['last_name'],
										'nickname'		=>	$userdata['name'],
										'user_url'		=>	$userdata['link'],
										'display_name'	=>	$userdata['name']
									);
			
			wp_update_user( $wpuserdetails );
			
			//make user logged in
			wp_set_auth_cookie( $wp_id, false );
			return $wp_id;
		
		}
		return false;
	}
	
	/**
	 * Load Login Page For Social
	 * 
	 * Handles to load login page for social
	 * when no email address found
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_login_redirect() {
		
		global $wps_deals_options;
		
		$socialtype = isset( $_GET['dealsnetwork'] ) ? $_GET['dealsnetwork'] : '';
		
		//get all social networks
		$allsocialtypes = wps_deals_social_networks();
		
		if( !is_user_logged_in() && isset( $_GET['wps_deals_social_login'] ) 
			&& !empty( $socialtype ) && array_key_exists( $socialtype, $allsocialtypes ) ) {
		
			//check if session is set and !empty then it will take get_permalink url
			$redirect_url = $this->session->get( 'wps_deals_stcd_redirect_url' );
			$redirect_url = !empty( $redirect_url ) ? $redirect_url	: wps_deals_get_current_page_url();
			
			//get cart details
			$cartdetails = $this->cart->get();
				
			$data = array();
			
			//wordpress error class		
			$errors = new WP_Error();
			  		
	  		switch ( $socialtype ) {
	  			
	  			case 'twitter'	:
							//get twitter user data
							$tw_userdata = $this->twitter->wps_deals_social_get_twitter_user_data();
							//check user id is set or not for twitter
							if( !empty( $tw_userdata ) && isset( $tw_userdata->id ) && !empty( $tw_userdata->id ) ) {
								
								$data['first_name'] = $tw_userdata->name;
								$data['last_name'] = '';
								$data['name'] = $tw_userdata->screen_name; //display name of user
								$data['type'] = 'twitter';
								$data['all'] = $tw_userdata;
								$data['link'] = 'https://twitter.com/' . $tw_userdata->screen_name;
								$data['id']	= $tw_userdata->id;
							}
							break;
	  			
	  		}
			
	  		//if cart is empty or user is not logged in social media
	  		//and accessing the url then send back user to checkout page
	  		if( /*empty( $cartdetails ) || */!isset( $data['id'] ) || empty( $data['id'] ) ) {
	  			
	  			$redirect_url = $this->session->get( 'wps_deals_stcd_redirect_url' );
	  			if( !empty( $redirect_url ) ) {
	  				$this->session->remove( 'wps_deals_stcd_redirect_url' );
	  			}
				wp_redirect( $redirect_url );
				exit;
	  			//send user to checkout page
				//wps_deals_send_on_checkout_page();
				
	  		}
	  		
			//when user will click submit button of custom login
			//check user clicks submit button of registration page and get parameter should be valid param
			if( ( isset( $_POST['wps-deals-submit'] ) && !empty( $_POST['wps-deals-submit'] ) 
					&& $_POST['wps-deals-submit'] == __( 'Register', 'wpsdeals' ) ) ) {  
				
				$loginurl = wp_login_url();
					
				if( isset( $_POST['wps_deals_social_email'] ) ) { //check email is set or not
				  
					$socialemail = $_POST['wps_deals_social_email'];
				  
					  if ( empty( $socialemail ) ) { //if email is empty
						$errors->add( 'empty_email', __( '<strong>ERROR :</strong> Enter your email address.', 'wpsdeals' ) );
					  } elseif ( !is_email( $socialemail ) ) { //if email is not valid
						$errors->add( 'invalid_email', __('<strong>ERROR :</strong> The email address did not validate.', 'wpsdeals' ) );
						$socialemail = '';
					  } elseif ( email_exists( $socialemail ) ) {//if email is exist or not
					  	
						$errors->add('email_exists', __('<strong>ERROR :</strong> Email already exists, If you have an account login first.', 'wpsdeals' ) );
					  }
					  
					if ( $errors->get_error_code() == '' ) { //
					  	
			  		 	if( !empty( $data ) ) { //check user data is not empty
							
			  		 		$data['email'] = $socialemail;
			  		 		
			  		 		//create user
							$usercreated = $this->wps_deals_social_create_user( $data );
							//check shortcode redirect url is set and not empty then make it blank
							$redirect_url = $this->session->get( 'wps_deals_stcd_redirect_url' );
							if( !empty( $redirect_url ) ) {
				  				$this->session->remove( 'wps_deals_stcd_redirect_url' );
				  			}
							wp_redirect( $redirect_url );
							exit;
							//send user to checkout page
							//wps_deals_send_on_checkout_page();
							
						} 
				  	}
			  	}
			}
			
			//redirect user to custom registration form
			if( isset( $_GET['wps_deals_social_login'] ) && !empty( $_GET['wps_deals_social_login'] ) ) {
			
				$prefix = WPS_DEALS_META_PREFIX;
				
				//login call back url after registration
				/*$callbackurl = wp_login_url();
				$callbackurl = add_query_arg('wps_deals_social_login_done', 1, $callbackurl);*/
				$socialemail = isset( $_POST['wps_deals_social_email'] ) ? $_POST['wps_deals_social_email'] : '';
			
		  		//check the user who is going to connect with site
				//it is alreay exist with same data or not 
				//if user is exist then simply make that user logged in
				$metaquery = array(
									array( 
											'key'	=>	$prefix . 'social_user_connect_via', 
											'value'	=>	$data['type'] 
										),
									array( 
											'key'	=>	$prefix . 'social_identifier', 
											'value'	=>	$data['id']
										)
								);
								
				$getusers = get_users( array( 'meta_query' => $metaquery ) );
				$wpuser = array_shift( $getusers ); //getting users 
				
				//check user is exist or not conected with same metabox
				if( !empty( $wpuser ) ) {
					
					//make user logged in
					wp_set_auth_cookie( $wpuser->ID, false );
					
					//check shortcode redirect url is set and not empty then make it blank
					$redirect_url = $this->session->get( 'wps_deals_stcd_redirect_url' );
					if( !empty( $redirect_url ) ) {
		  				$this->session->remove( 'wps_deals_stcd_redirect_url' );
		  			}
		  			
					wp_redirect( $redirect_url );
					exit;
					//send user to checkout page
					//wps_deals_send_on_checkout_page();
					
				} else {
					
					//if user is not exist then show register user form
					
					login_header(__('Registration Form', 'wpsdeals') , '<p class="message register">' . __('Please enter your email address to compelete registeration.', 'wpsdeals' ) . '</p>', $errors );
					
					?>
						<form name="registerform" id="registerform" action="" method="post">
							  <p>
								  <label for="wcsl_email"><?php _e( 'E-mail', 'wpsdeals' ); ?><br />
								  <input type="text" name="wps_deals_social_email" id="wps_deals_social_email" class="input" value="<?php echo $this->model->wps_deals_escape_attr( $socialemail ); ?>" size="25" tabindex="20" /></label>
							  </p>
							  <p id="reg_passmail">
							  	<?php _e( 'Username and Password will be sent to your email.', 'wpsdeals' ); ?>
							  </p>
							  <br class="clear" />
							  <p class="submit"><input type="submit" name="wps-deals-submit" id="wps-deals-submit" class="button-primary" value="<?php _e( 'Register', 'wpsdeals' ); ?>" tabindex="100" /></p>
						</form>
					<?php
					
					login_footer('user_login');
					exit;
				}
			}
		}
	}
	
	/**
	 * Adding Hooks
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		//AJAX Call to Login Via Social Media
		add_action( 'wp_ajax_wps_deals_social_login', array( $this, 'wps_deals_social_login' ) );
		add_action( 'wp_ajax_nopriv_wps_deals_social_login', array( $this, 'wps_deals_social_login' ) );
		
		//add action for twitter initialize data
		add_action( 'init', array( $this->twitter, 'wps_deals_initialize_twitter') );
		
		//add action google plus initialize data
		add_action( 'init', array( $this->google, 'wps_deals_initialize_google' ) );
		
		// add action for linkedin initialize data
		add_action( 'init', array( $this->linkedin, 'wps_deals_initialize_linkedin' ) );
		
		//add action yahoo initialize data
		add_action( 'init', array( $this->yahoo, 'wps_deals_initialize_yahoo') );
		
		//add action for foursquare initialize data
		add_action( 'init', array( $this->foursquare, 'wps_deals_initialize_foursquare' ) );
		
		//add action for windowslive initialize data
		add_action( 'init', array( $this->windowslive, 'wps_deals_initialize_windowslive' ) );
		
		//add action to load login page
		add_action( 'login_init', array( $this, 'wps_deals_social_login_redirect' ) );
		
	}
	
}
?>