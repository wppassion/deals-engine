<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Handles generic Admin functionality and AJAX requests.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_AdminPages {
	
	public $model,$scripts,$currency,$price,$logs,$render;
	
	public function __construct() {		
	
		global  $wps_deals_model,$wps_deals_render,$wps_deals_scripts,
				$wps_deals_currency,$wps_deals_price,$wps_deals_logs,
				$wps_deals_message,$wps_deals_render;
				
		$this->model = $wps_deals_model;
		$this->scripts = $wps_deals_scripts;
		$this->currency = $wps_deals_currency;
		$this->price = $wps_deals_price;
		$this->logs = $wps_deals_logs;
		$this->message = $wps_deals_message;
		$this->render = $wps_deals_render;
		
	}
	
	/**
	 *  Register All need admin menu page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_admin_menu_pages(){
		
		$dealspageslug = 'edit.php?post_type='.WPS_DEALS_POST_TYPE;
		
		//do action to adding submenu page to plugin via other plugin
		do_action('wps_deals_add_submenu_page_before',$dealspageslug);
		
		//settings page
		$settings_page = add_submenu_page(  $dealspageslug, __( 'Social Deal Engine Settings', 'wpsdeals' ), __( 'Settings', 'wpsdeals' ), 'manage_options', 'wps-deals-settings', array($this,'wps_deals_settings_page' ) ); 
		
		//deal sales page
		$deal_sales_page = add_submenu_page( $dealspageslug , __( 'Deal Sales', 'wpsdeals'), __( 'Deal Sales', 'wpsdeals' ), 'manage_options', 'wps-deals-sales', array($this,'wps_deals_sales_page' ) );
		
		//reports page
		$reports_page = add_submenu_page( $dealspageslug , __( 'Reports', 'wpsdeals'), __( 'Reports', 'wpsdeals' ), 'manage_options', 'wps-deals-reports', array( $this,'wps_deals_reports_page' ) );
		
		//social login page
		$social_login = add_submenu_page( $dealspageslug , __( 'Social Login', 'wpsdeals'), __( 'Social Login', 'wpsdeals' ), 'manage_options', 'wps-deals-social', array( $this,'wps_deals_social_login_page' ) );				
		
		//do action to adding submenu page to plugin via other plugin
		do_action('wps_deals_add_submenu_page_after',$dealspageslug);
		
		//Tools page
		$tools = add_submenu_page( $dealspageslug , __( 'Tools', 'wpsdeals'), __( 'Tools', 'wpsdeals' ), 'manage_options', 'wps-deals-tool', array( $this,'wps_deals_tools_page' ) );				
		
		//extension page
		$social_addon = add_submenu_page( $dealspageslug , __( 'Extensions', 'wpsdeals'), __( 'Extensions', 'wpsdeals' ), 'manage_options', 'wps-deals-extensions', array( $this,'wps_deals_extensions_page' ) );
		
		//setting page metaboxes toggling script
		add_action( "admin_head-$settings_page", array( $this->scripts, 'wps_deals_settings_page_load_scripts' ) );
		add_action( "admin_print_scripts-$settings_page", array( $this->scripts, 'wps_deal_popup_scritps' ) );
		add_action( "admin_print_styles-$settings_page", array( $this->scripts, 'wps_deals_sales_styles' ) );
		add_action( "admin_head-$deal_sales_page", array( $this->scripts, 'wps_deals_sales_head_scripts' ) );
		add_action( "admin_print_scripts-$deal_sales_page", array( $this->scripts, 'wps_deal_popup_scritps' ) );
		add_action( "admin_print_styles-$deal_sales_page", array( $this->scripts, 'wps_deals_sales_styles' ) );
		add_action( "admin_head-$deal_sales_page", array( $this->scripts, 'wps_deals_order_detail_scripts' ) );
		add_action( "admin_print_scripts-$reports_page", array( $this->scripts, 'wps_deal_report_graph_scritps' ) );
		
		//script for social login page
		add_action( "admin_print_scripts-$social_login", array( $this->scripts, 'wps_deals_social_login_scripts' ) );
		add_action( "admin_print_scripts-$social_login", array( $this->scripts, 'wps_deals_sortable' ) );
		
		// add action to add popup html for email templates of purchase receipt
		add_action( "admin_footer-$settings_page", array( $this,'wps_deals_preview_purchse_receipt_popup' ) );
		
		//add action of system info 
		
	}
	
	/**
	 * Deal Sales Page
	 * 
	 * List of all sales deals
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function wps_deals_sales_page(){
		
		if ( isset($_GET['post_type']) && $_GET['post_type'] == WPS_DEALS_POST_TYPE
			&& (isset($_GET['action']) && $_GET['action'] == 'editorder')) {
			
			//deals order edit page
			include_once( WPS_DEALS_ADMIN . '/forms/wps-deals-edit-order.php');	
			
		} else {
			//deals sales page
			include_once( WPS_DEALS_ADMIN . '/forms/wps-deals-sales.php');			
		}
		
	}
	
	/**
	 * Reports Page
	 * 
	 * List of all Reports
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function wps_deals_reports_page(){
		
		include_once( WPS_DEALS_ADMIN . '/reports/wps-deals-reports.php');
	}
	
	/**
	 * Add Plugin Settings Page
	 * 
	 * Handles all plugin's settings
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_settings_page() {
		
		include_once( WPS_DEALS_ADMIN . '/forms/wps-deals-plugin-settings.php' );
	}
	
		/**
	 * Add extension page
	 * 
	 * Display 
	 * 
	 * @package Social Deals Engine
	 * @since 2.2.6
	 */
	public function wps_deals_tools_page() {

			include_once( WPS_DEALS_ADMIN . '/forms/wps-deals-tools.php' );
	}
	
	
	
	
	/**
	 * Add extension page
	 * 
	 * Display list of all extension of social deals engine
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_extensions_page() {
		
		include_once( WPS_DEALS_ADMIN . '/forms/wps-deals-extensions.php');
	}
	
	/**
	 * Register Settings 
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 * 
	 */
	public function wps_deals_admin_register_settings() {
		
		register_setting( 'wps_deals_plugin_options', 'wps_deals_options', array($this, 'wps_deals_validate_options') );
	}
	
	/**
	 * Validate Settings Options
	 * 
	 * Handle settings page values
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_validate_options($input) {
		
		global $wps_deals_options;
		
		// sanitize text input (strip html tags, and escape characters)
		$input['ending_deals_in'] 		= $this->model->wps_deals_escape_slashes_deep( $input['ending_deals_in'] );
		$input['upcoming_deals_in'] 	= $this->model->wps_deals_escape_slashes_deep( $input['upcoming_deals_in'] );
		$input['deals_per_page'] 		= $this->model->wps_deals_escape_slashes_deep( $input['deals_per_page'] );
		$input['tw_user_name'] 			= $this->model->wps_deals_escape_slashes_deep( $input['tw_user_name'] );
		$input['thounsands_seperator'] 	= $this->model->wps_deals_escape_slashes_deep( $input['thounsands_seperator'] );
		$input['decimal_seperator'] 	= $this->model->wps_deals_escape_slashes_deep( $input['decimal_seperator'] );
		$input['decimal_places'] 		= $this->model->wps_deals_escape_slashes_deep( $input['decimal_places'] );
		$input['paypal_merchant_email'] = $this->model->wps_deals_escape_slashes_deep( $input['paypal_merchant_email'] );
		$input['paypal_api_user'] 		= $this->model->wps_deals_escape_slashes_deep( $input['paypal_api_user'] );
		$input['paypal_api_pass'] 		= $this->model->wps_deals_escape_slashes_deep( $input['paypal_api_pass'] );
		$input['paypal_api_sign'] 		= $this->model->wps_deals_escape_slashes_deep( $input['paypal_api_sign'] );
		$input['cheque_title'] 			= $this->model->wps_deals_escape_slashes_deep( $input['cheque_title'] );
		$input['cheque_customer_msg'] 	= $this->model->wps_deals_escape_slashes_deep( $input['cheque_customer_msg'] );
		$input['from_email'] 			= $this->model->wps_deals_escape_slashes_deep( $input['from_email'], true );
		$input['buyer_email_subject'] 	= $this->model->wps_deals_escape_slashes_deep( $input['buyer_email_subject'] );
		$input['buyer_email_body'] 		= $this->model->wps_deals_escape_slashes_deep( $input['buyer_email_body'], true );
		$input['notif_email_address'] 	= $this->model->wps_deals_escape_slashes_deep( $input['notif_email_address'] );
		$input['seller_email_subject'] 	= $this->model->wps_deals_escape_slashes_deep( $input['seller_email_subject'] );
		$input['seller_email_body'] 	= $this->model->wps_deals_escape_slashes_deep( $input['seller_email_body'] );
		$input['thounsands_seperator'] 	= $this->model->wps_deals_escape_slashes_deep( $input['thounsands_seperator'] );
		$input['decimal_seperator'] 	= $this->model->wps_deals_escape_slashes_deep( $input['decimal_seperator'] );
		$input['decimal_places'] 		= $this->model->wps_deals_escape_slashes_deep( $input['decimal_places'] );
		$input['add_to_cart_text'] 		= $this->model->wps_deals_escape_slashes_deep( $input['add_to_cart_text'] );
		$input['file_download_limit'] 	= $this->model->wps_deals_escape_slashes_deep( $input['file_download_limit'] );
		$input['link_expiration'] 		= $this->model->wps_deals_escape_slashes_deep( $input['link_expiration'] );
		$input['per_page'] 				= $this->model->wps_deals_escape_slashes_deep( $input['per_page'] );
		$input['terms_label'] 			= $this->model->wps_deals_escape_slashes_deep( $input['terms_label'] );
		$input['terms_content'] 		= $this->model->wps_deals_escape_slashes_deep( $input['terms_content'], true );
		
		//social settings
		//facebook settings
		$input['fb_app_id']				= $this->model->wps_deals_escape_slashes_deep( $input['fb_app_id'] );
		$input['fb_app_secret']			= $this->model->wps_deals_escape_slashes_deep( $input['fb_app_secret'] );
		$input['fb_icon_url']			= $this->model->wps_deals_escape_slashes_deep( $input['fb_icon_url'] );
		$input['fb_redirect_url']		= $this->model->wps_deals_escape_slashes_deep( $input['fb_redirect_url'] );
		
		//googleplus settings
		$input['gplus_client_id']		= $this->model->wps_deals_escape_slashes_deep( $input['gplus_client_id'] );
		$input['gplus_client_secret']	= $this->model->wps_deals_escape_slashes_deep( $input['gplus_client_secret'] );
		$input['gplus_icon_url']		= $this->model->wps_deals_escape_slashes_deep( $input['gplus_icon_url'] );
		
		//twitter settings
		$input['tw_consumer_key']		= $this->model->wps_deals_escape_slashes_deep( $input['tw_consumer_key'] );
		$input['tw_consumer_secrets']	= $this->model->wps_deals_escape_slashes_deep( $input['tw_consumer_secrets'] );
		$input['tw_icon_url']			= $this->model->wps_deals_escape_slashes_deep( $input['tw_icon_url'] );
			
		//linkedin settings
		$input['li_app_id']				= $this->model->wps_deals_escape_slashes_deep( $input['li_app_id'] );
		$input['li_app_secret']			= $this->model->wps_deals_escape_slashes_deep( $input['li_app_secret'] );
		$input['li_icon_url']			= $this->model->wps_deals_escape_slashes_deep( $input['li_icon_url'] );
		
		//yahoo settings
		$input['yh_consumer_key']		= $this->model->wps_deals_escape_slashes_deep( $input['yh_consumer_key'] );
		$input['yh_consumer_secrets']	= $this->model->wps_deals_escape_slashes_deep( $input['yh_consumer_secrets'] );
		$input['yh_app_id']				= $this->model->wps_deals_escape_slashes_deep( $input['yh_app_id'] );
		$input['yh_icon_url']			= $this->model->wps_deals_escape_slashes_deep( $input['yh_icon_url'] );
		
		//foursquare settings
		$input['fs_client_id']			= $this->model->wps_deals_escape_slashes_deep( $input['fs_client_id'] );
		$input['fs_client_secrets']		= $this->model->wps_deals_escape_slashes_deep( $input['fs_client_secrets'] );
		$input['fs_icon_url']			= $this->model->wps_deals_escape_slashes_deep( $input['fs_icon_url'] );
		
		//windowslive settings
		$input['wl_client_id']			= $this->model->wps_deals_escape_slashes_deep( $input['wl_client_id'] );
		$input['wl_client_secrets']		= $this->model->wps_deals_escape_slashes_deep( $input['wl_client_secrets'] );
		$input['wl_icon_url']			= $this->model->wps_deals_escape_slashes_deep( $input['wl_icon_url'] );
		
		// Endpoints settings
		$input['deals_thank_you_page_endpoint'] 	= $this->model->wps_deals_escape_slashes_deep( trim( $input['deals_thank_you_page_endpoint'] ) );
		$input['deals_cancel_page_endpoint'] 		= $this->model->wps_deals_escape_slashes_deep( trim( $input['deals_cancel_page_endpoint'] ) );
		$input['edit_account_endpoint'] 			= $this->model->wps_deals_escape_slashes_deep( trim( $input['edit_account_endpoint'] ) );
		$input['edit_address_endpoint'] 			= $this->model->wps_deals_escape_slashes_deep( trim( $input['edit_address_endpoint'] ) );
		$input['lost_password_endpoint'] 			= $this->model->wps_deals_escape_slashes_deep( trim( $input['lost_password_endpoint'] ) );
		$input['view_orders_endpoint'] 				= $this->model->wps_deals_escape_slashes_deep( trim( $input['view_orders_endpoint'] ) );
		$input['create_an_account_endpoint'] 		= $this->model->wps_deals_escape_slashes_deep( trim( $input['create_an_account_endpoint'] ) );
		
		
		// writing the custom css to wps-deals-custom.css
		if( isset( $_POST['wps-deals-settings-submit'] ) && $_POST['wps-deals-settings-submit'] == __( 'Save Custom CSS', 'wpsdeals' ) ) {
			$input['custom_css'] = $this->model->wps_deals_escape_slashes_deep( $input['custom_css'] );
			$this->wps_deals_generate_custom_css( $input['custom_css'] );
		}
		
		//to save social login order which is draged in social login page
		if( isset( $wps_deals_options['social_order'] ) ) { //check if currently it is set in options or not
			$input['social_order'] = $this->model->wps_deals_escape_slashes_deep( $wps_deals_options['social_order'] );
		}
		
		//set session to set tab selected in settings page
		$selectedtab = isset( $input['selected_tab'] ) ? $input['selected_tab'] : '';
		$this->message->add_session( 'wps-deals-selected-tab', strtolower( $selectedtab ) );
	
		//filter to save all settings to database
		return apply_filters( 'wps_deals_save_settings', $input );
	}
	
	/**
	 * Custom CSS
	 *
	 * This will write the custom css entries to the wps-deals-custom.css file.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_generate_custom_css( $data ) {
	 
		$uploads = wp_upload_dir();
		$css_dir = WPS_DEALS_DIR . '/includes/css/'; // Shorten code, save 1 call
		
		/** Save on different directory if on multisite **/
		if(is_multisite()) {
			$aq_uploads_dir = trailingslashit($uploads['basedir']);
		} else {
			$aq_uploads_dir = $css_dir;
		}
		
		/** Capture CSS output **/
		ob_start();
		//require( $css_dir . 'c' );
		echo $data;
		$css = ob_get_clean();
		
		/** Write to options.css file **/
		WP_Filesystem();
		global $wp_filesystem;
		if ( ! $wp_filesystem->put_contents( $aq_uploads_dir . 'wps-deals-custom.css', $css, 0644) ) {
		    return true;
		}	
	}
	
	/**
	 * Quick Edit
	 * 
	 * Handles quick edit of deals
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 * 
	 */
	function wps_deals_quick_edit_values( $column_name, $post_type ) {

		global $wps_deals_options;
		
		$html = '';
		
		if( $post_type == WPS_DEALS_POST_TYPE ) {
			
			
			
			$prefix	= WPS_DEALS_META_PREFIX;
			
			static $wps_start_end_date = TRUE;
		    
			if ( $wps_start_end_date ) {
		        
		    	$wps_start_end_date = FALSE; 
				
		    	$html .= '<fieldset><div class="inline-edit-col"><h4>'.__('Deals Data', 'wpsdeals' ).'</h4></div></fieldset>';
		    	
		    	// deals start date		    	
		       	/*$html .='<fieldset class="inline-edit-col-left">
							<div class="inline-edit-col">
								<label>
									<span class="title checkbox-title wpsc-quick-edit">'.__('Start Date','wpsdeals').'</span>
									<span class="input-text-wrap"><input type="text" rel="dd-mm-yy" name="'.$prefix.'start_date" class="span_input wps_deals_quick_start_date wps_deals_quick_edit_datetime"/></span>
								</label>
							</div>
						</fieldset>';
		       	
				// deals end date
		       	$html .='<fieldset class="inline-edit-col-left">	
							<div class="inline-edit-col">
								<label>
									<span class="title checkbox-title wpsc-quick-edit">'.__('End Date','wpsdeals').'</span>
									<span class="input-text-wrap"><input type="text" rel="dd-mm-yy" name="'.$prefix.'end_date"  class="span_input wps_deals_quick_end_date wps_deals_quick_edit_datetime"/></span>
								</label>				
							</div>
				    	</fieldset>';*/
		    }
			
			$html .='<fieldset class="inline-edit-col-left">
					<div class="inline-edit-col">';
				
					switch($column_name){
					
						case "available"	: 
												$html .='<label><span class="title checkbox-title wpsc-quick-edit">'.__('Total Available Deals','wpsdeals').'</span>
														<span class="input-text-wrap"><input type="text" name="wps_deals_avail_total" class="span_input wps_deals_quick_avail_total"/></span>';
												break;
						
						case "normal_price"	: 
												$html .='<label><span class="title checkbox-title wpsc-quick-edit">'.__('Normal Price', 'wpsdeals' ) . ' ( '.$this->currency->wps_deals_currency_symbol($wps_deals_options['currency']).' )</span>
														<span class="input-text-wrap"><input type="text" name="wps_deals_normal_price" class="span_input wps_deals_quick_normal_price"/></span>';
												break;
						
						case "deal_price"	:  
												$html.='<label><span class="title checkbox-title wpsc-quick-edit">'.__('Deal Price', 'wpsdeals' ) . ' ( '.$this->currency->wps_deals_currency_symbol($wps_deals_options['currency']).' )</span>
														<span class="input-text-wrap"><input type="text" name="wps_deals_sale_price" class="span_input wps_deals_quick_sale_price"/></span>';
												break;
																
						case "featured_deal": 
												$html .='<label><span class="title checkbox-title wpsc-quick-edit">'.__('Featured Deal','wpsdeals').'</span>
															<span class="input-text-wrap"><input type="checkbox" name="wps_deals_featured_deal" class="span_checkbox wps_deals_quick_featured_deal" /></span>';
												break;
						default:	
						
		 
							
					}
						 
			$html .= '</div>
		    </fieldset>';
			echo $html;
		}
	}
	
	/**
	 * Quick Edit Save
	 * 
	 * Handles quick edit save meta boxes to database
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	function wps_deals_quick_save_post_data($post_id,$post1) { // For Quick Edit
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		if ($post1->post_type == 'revision') return; // Imp Line
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; //Imp Line When auto save run to prevent the post meta box data
		
		if(isset($post_id) && $post1->post_type == WPS_DEALS_POST_TYPE && (isset($_POST['post_ID']) && $_POST['post_ID'] == $post_id)) { //if isset post id is set and post type is deals post type and $_POST['post_ID'] is equal to meta box's post ID then update meta only
			  
			$available 		= isset($_POST['wps_deals_avail_total']) 	?	$_POST['wps_deals_avail_total'] 	: '';
			$normal_price 	= isset($_POST['wps_deals_normal_price']) 	?	$_POST['wps_deals_normal_price'] 	: '';
			$sale_price 	= isset($_POST['wps_deals_sale_price']) 	?	$_POST['wps_deals_sale_price'] 		: '';
			
			$featured_deal 	= isset($_POST['wps_deals_featured_deal']) 	?	'on' : '';
			 
			update_post_meta($post_id, $prefix.'avail_total', $available);  
			update_post_meta($post_id, $prefix.'normal_price', $normal_price);
			update_post_meta($post_id, $prefix.'sale_price', $sale_price);
			update_post_meta($post_id, $prefix.'featured_deal', $featured_deal);

			/*// Start Date		
			$start_date = isset($_POST[$prefix.'start_date']) ? $_POST[$prefix.'start_date'] : '';
			if(!empty($start_date)) {
				$start_date = strtotime( $this->model->wps_deals_escape_slashes_deep( $start_date ) );
				$start_date = date('Y-m-d H:i:s',$start_date);
			}
			update_post_meta( $post_id, $prefix.'start_date', $start_date );
			
			// End Date
			$end_date = isset($_POST[$prefix.'end_date'])	? $_POST[$prefix.'end_date'] : '';
			if(!empty($end_date)) {
				$end_date = strtotime( $this->model->wps_deals_escape_slashes_deep( $end_date ) );
				$end_date = date('Y-m-d H:i:s',$end_date);
			}
			update_post_meta( $post_id, $prefix.'end_date', $end_date );*/
		}
	}
	
	/**
	 * Custom column
	 *
	 * Handles the custom columns to deals listing page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_manage_custom_column($column_name,$post_id) {
		
		global $wpdb,$post;
		
		$prefix = WPS_DEALS_META_PREFIX;
		 
		switch ($column_name) {
				
				case 'normal_price' :
						
									$normal_price = get_post_meta( $post_id , $prefix.'normal_price' , true ); 
									echo $this->price->get_display_price( $normal_price, $post_id );
									echo '<div id="inline_' . $post->ID . '_normal_price" class="hidden">' . $normal_price . '</div>';
									break;
				
				case 'deal_price' :
									$deal_price = get_post_meta( $post_id , $prefix.'sale_price' , true );
									echo $this->price->get_display_price( $deal_price, $post_id );
									echo '<div id="inline_' . $post->ID . '_deal_price" class="hidden">' . $deal_price . '</div>';
									break;
						
				case 'featured_deal' :
									$featured_deal = get_post_meta( $post_id , $prefix.'featured_deal' , true );
									echo ( empty($featured_deal) ) ? __( 'No', 'wpsdeals' ) : __( 'Yes', 'wpsdeals' );
									echo '<div id="inline_' . $post->ID . '_featured_deal" class="hidden">' . $featured_deal . '</div>';
									break;
						
				case 'image':		
									$deal_main_image = get_post_meta( $post_id, $prefix . 'main_image', true );
									$deal_main_image['src'] = apply_filters( 'wps_deals_main_image_src', $deal_main_image['src'], $post_id );
									
									$deal_image = get_the_post_thumbnail( $post_id, array(50,50), array( 'alt' => __('Deal Image','wpsdeals'), 
																											'title'	=> trim( strip_tags( $post->post_title ) ) 
																										) );
		
									
									$thumb='';
									if(!empty( $deal_image )){
										$thumb=$deal_image;
									} elseif(!empty($deal_main_image['src'])){
										$thumb='<img src="'.$deal_main_image['src'].'" width="50" height="50" alt="'.__('Deal Image','wpsdeals').'" />';						
									}else {
										$thumb='<img src="'.WPS_DEALS_URL.'includes/images/no-image.gif'.'" alt="'.__('Deal Image','wpsdeals').'" />';							
									}
									echo $thumb;
									break;
						
				case 'available':
									$available = get_post_meta($post_id, $prefix.'avail_total' , true);
									/*if($available == '') { echo __('Unlimited','wpsdeals'); }
									else {	echo get_post_meta($post_id, $prefix.'avail_total' , true);}*/
									if ( $available == '' ) {
										_e('Unlimited','wpsdeals');
									} elseif ( intval( $available ) == 0 ) {
										_e('Out of Stock','wpsdeals');
									} else {
										echo $available;
									}
									echo '<div id="inline_' . $post->ID . '_avail_total" class="hidden">' . $available . '</div>';
									break;
				
				case 'sales'	:	
									$salescount = $this->model->wps_deals_get_post_sale_count_earning($post_id);
									echo $salescount['salescount'];
									break;
				case 'earnings'	:	
									$earnings = $this->model->wps_deals_get_post_sale_count_earning($post_id);
									echo $this->currency->wps_deals_formatted_value($earnings['earnings']);
									
									$start_date = get_post_meta( $post_id , $prefix.'start_date' , true );
									$start_date	= date('d-m-Y h:i a',strtotime($start_date));
							    	
									$end_date 	= get_post_meta( $post_id , $prefix.'end_date' , true );
							    	$end_date	= date('d-m-Y h:i a',strtotime($end_date));
							    	
							    	echo '<div id="inline_'.$post->ID.'_start_date" class="hidden">'.$start_date.'</div>';
							    	echo '<div id="inline_'.$post->ID.'_end_date" class="hidden">'.$end_date.'</div>';
									
									break;
									
			}
	}
	
	/**
	 * Add New Column to deals listing page
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function add_new_deals_columns($new_columns) {
 		
 		unset($new_columns[WPS_DEALS_POST_TAXONOMY]);
 		unset($new_columns['author']);
 		unset($new_columns['title']);
 		unset($new_columns['date']);
 		unset($new_columns['taxonomy-'.WPS_DEALS_POST_TAGS]);
 		unset($new_columns['taxonomy-'.WPS_DEALS_POST_TAXONOMY]);
 		
 		$new_columns['image'] 								= __('Image','wpsdeals');
 		$new_columns['title'] 								= _x('Title','column name','wpsdeals');
 		$new_columns['taxonomy-'.WPS_DEALS_POST_TAXONOMY] 	= __('Categories','wpsdeals');
 		$new_columns['normal_price'] 						= __('Normal Price','wpsdeals');
		$new_columns['deal_price']							= __('Sale Price','wpsdeals');
		$new_columns['available'] 							= __('Stock','wpsdeals');
		$new_columns['featured_deal']						= __('Featured','wpsdeals');
		$new_columns['sales'] 								= __('Sales','wpsdeals');
		$new_columns['earnings'] 							= __('Earnings','wpsdeals');
		$new_columns['date']								= _x('Date','column name','wpsdeals');
		return $new_columns;
	}
	
	/**
	* Display Delas ID
	* 
	* Handles to show Deals ID
	* 
	* @package Social Deals Engine
	* @since 1.0.0
	**/
	function wps_deals_row_actions($actions, $post ) {
		
		if ( $post->post_type == WPS_DEALS_POST_TYPE ) {
			
			return array_merge( array( 'id' => 'ID: ' . $post->ID ), $actions );
		}
		return $actions;
	}
	
	/**
	 * Sortable Columns
	 *
	 * Handles to register sortable column
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	// function for making sorting on custom fields start
	
	function wps_deals_register_column_sortable( $newcolumn ) {
		
		$newcolumn['available'] 	= 'available';
		$newcolumn['normal_price'] 	= 'normal_price';
		$newcolumn['deal_price'] 	= 'deal_price';
		$newcolumn['sales'] 		= 'sales';
		$newcolumn['earnings'] 		= 'earnings';
		
		return $newcolumn;
	}
	
	/**
	 * Sorting Columns
	 * 
	 * Handles to work with sortable column
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_sorting_column( $vars )
	{
	    if ( isset( $vars['orderby'] ) && 'available' == $vars['orderby'] ) {
	        
	    	$prefix = WPS_DEALS_META_PREFIX;
	    	
	    	$vars = array_merge( $vars, array(
	        
	            'meta_key' => $prefix . 'avail_total', //Custom field key
	            'orderby' => 'meta_value_num') //Custom field value (number)
	            
	        );
	    }
	    if ( isset( $vars['orderby'] ) && 'normal_price' == $vars['orderby'] ) {
	        
	    	$vars = array_merge( $vars, array(
	    	
	            'meta_key' => $prefix . 'normal_price', //Custom field key
	            'orderby' => 'meta_value_num') //Custom field value (number)
	            
	        );
	    }
	    if ( isset( $vars['orderby'] ) && 'deal_price' == $vars['orderby'] ) {
	        
	    	$vars = array_merge( $vars, array(
	        
	            'meta_key' => $prefix . 'sale_price', //Custom field key
	            'orderby' => 'meta_value_num') //Custom field value (number)
	            
	        );
	    }
	    return $vars;
	}
	
	/**
	 * Bulk Delete
	 * 
	 * Handles bulk delete functinalities of deals sales
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_sales_bulk_delete() {
		
		if( (isset( $_GET['action'] ) && $_GET['action'] == 'delete' || isset( $_GET['action2'] ) && $_GET['action2'] == 'delete') 
			&& (isset($_GET['page']) && $_GET['page'] == 'wps-deals-sales') ) { //check action and page
			
			$prefix = WPS_DEALS_META_PREFIX;
				
			//get bulk coupon array from $_GET
			$action_on_id = $_GET['dealsale'];
			
			if( count( $action_on_id ) > 0 ) { //check there is some checkboxes are checked or not 
				
				//if there is multiple checkboxes are checked then call delete in loop
				foreach ( $action_on_id as $salesid ) {
					
					//parameters for delete function
					$args = array (
										'id' => $salesid
									);
								
					//delete record from database
					$this->model->wps_deals_bulk_delete( $args );
					
					// delete related sales log entries
					$this->logs->delete_logs(
						null,
						'sales',
						array(
								array(
									'key'   => $prefix . 'log_payment_id',
									'value' => $salesid
								)
							)
						);
				} //end for loop
				
				//delete is succesfully done then redirect user to proper page
				$newstr = add_query_arg(array(	'page'				=> 'wps-deals-sales',
												'post_type'			=> WPS_DEALS_POST_TYPE,
												'message' 			=> '1' ,
												'action' 			=> false, 
												'dealsale' 			=> false, 
												'_wpnonce' 			=> false, 
												'_wp_http_referer' 	=> false, 
												'action2' 			=> false
											),admin_url( 'edit.php' ) );
				wp_redirect( $newstr ); 
				exit;
				
			} else {
				
				$newstr = add_query_arg(array(	'page'				=> 'wps-deals-sales',
												'post_type'			=> WPS_DEALS_POST_TYPE,
												'action' 			=> false, 
												'dealsale' 			=> false, 
												'_wpnonce' 			=> false, 
												'_wp_http_referer' 	=> false, 
												'action2' 			=> false
											), admin_url( 'edit.php' ) );
				//if there is no checboxes are checked then redirect to listing page
				wp_redirect( $newstr ); 
				exit;
				
			}			
		}
	}
	/**
	 * Resend Purchase Receipt to Buyer
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 * 
	 */
	public function wps_deals_resend_purchase_receipt() {
		
		//Resend Purchase Receipt to Buyer
		if( ( isset($_GET['page']) && $_GET['page'] == 'wps-deals-sales' ) 
			&& ( isset($_GET['post_type']) && $_GET['post_type'] == WPS_DEALS_POST_TYPE ) 
			&& ( isset($_GET['action']) && $_GET['action'] == 'resend') 
			&& ( isset($_GET['order_id']) && !empty($_GET['order_id'])) ) {
				
			//order id	
			$orderid = $_GET['order_id'];
					
			//order details
			$orderdetails = $this->model->wps_deals_get_post_meta_ordered($orderid);
	
			//user details
			$userdetails = $this->model->wps_deals_get_ordered_user_details($orderid);	
				
			$maildata = array();
			$maildata['user_data'] = $userdetails;
			$maildata['order_details'] = $orderdetails;
			
			//send email to user
			$this->model->wps_deals_buyer_mail($maildata);
			
			$newstr = add_query_arg(	array(	
											'page'		=> 'wps-deals-sales',
											'post_type'	=> WPS_DEALS_POST_TYPE,
											'message' 	=> '2' ,
											'action' 	=> false, 
											'order_id' 	=> false, 
											'_wpnonce' 	=> false, 
											'_wp_http_referer' => false,
										), admin_url( 'edit.php' ) ) ;
			wp_redirect( $newstr );
			exit; 
				
		}
	}
	/**
	 * Add Metabox for showing deals sales stats
	 * 
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_stats_metabox() {
		
		 add_meta_box(
			            'wps_deals_stats_meta',
			            __( 'Deal Stats', 'wpsdeals' ),
			            array($this, 'wps_deals_stats_metabox_details'),
			            WPS_DEALS_POST_TYPE,
			            'side','high'
			        );
		
		//Add meta box deals images
		add_meta_box( 'wps_deals_images', __( 'Deals Gallery', 'wpsdeals' ), 'Wps_Meta_Box_Deals_Images::output', WPS_DEALS_POST_TYPE, 'side', 'low' );
		
	}
	
	/**
	 * Deals Stats Show In Metabox
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_stats_metabox_details() {
		
		include_once( WPS_DEALS_META_DIR .'/wps-deals-stats.php');
		
	}
	
	/**
	 * Increment Price Meta Create
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_price_increment_meta( $post_id ) {
		
		global $post_type;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                // Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
		|| ( $post_type !=  WPS_DEALS_POST_TYPE ) )              // Check if current post type is supported.
		{
		  return $post_id;
		}
		
		if( !get_post_meta( $post_id, $prefix.'nxt_inc_period', true)) {
			add_post_meta( $post_id, $prefix.'nxt_inc_period', '0');
		}
		
	}
	
	/**
	 * Shortcode Popup Markup
	 * 
	 * @package WPSocila Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_shortcode_popup_button() {
		
		if( current_user_can( 'manage_options' ) || current_user_can( 'edit_posts' ) ) {
			add_filter( 'mce_external_plugins', array( $this, 'wps_deals_shortcode_popup_plugin' ) );
			add_filter( 'mce_buttons', array( $this, 'wps_deals_shortcode_popup_register_button' ) );
		}
		
	}
	
	/**
	 * Register Buttons
	 *
	 * Register the different content locker buttons for the editor
	 *
	 * @package WPSocila Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_shortcode_popup_register_button( $buttons ) {	
	
		global $typenow;
		
		if( $typenow != WPS_DEALS_POST_TYPE ) { 
	 		array_push( $buttons, "|", "wpsdealsengine" );
		}
	 	return $buttons;	 	
	}
	
	/**
	 * Editor Pop Up Script
	 *
	 * Adding the needed script for the pop up on the editor
	 *
	 * @package WPSocila Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_shortcode_popup_plugin( $plugin_array ) {
		
		global $typenow;
		
		if( $typenow != WPS_DEALS_POST_TYPE ) { 
			wp_enqueue_script( 'tinymce' );
			
			$plugin_array['wpsdealsengine'] = WPS_DEALS_URL . 'includes/js/wps-deals-buttons.js';
		}
		return $plugin_array;
	}
	
	/**
	 * Pop Up On Editor
	 *
	 * Includes the pop up on the WordPress editor
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_shortcode_popup() {
		
		include_once( WPS_DEALS_ADMIN . '/forms/wps-deals-admin-popup.php' );
	}
	
	/**
	 * Refund Order Payment
	 * 
	 * Handles to refund the payment
	 * of order to buyer
	 * 
	 * @package Social Deals Engine 
	 * @since 1.0.0
	 */
	public function wps_deals_refund_order_payment() {
		
		//check user can manage options and action should be refund orderid can not be empty
		if( current_user_can( 'manage_options' ) 
			&& isset( $_GET['action'] ) && !empty( $_GET['action'] ) && $_GET['action'] == 'refund' 
			&& isset( $_GET['orderid'] ) && !empty( $_GET['orderid'] ) ) { 
			
			$redirectarr = array( 
							'post_type'	=> WPS_DEALS_POST_TYPE,
							'page'		=>	'wps-deals-sales',
							'action'	=>	'editorder',
							'order_id'	=>	$_GET['orderid'] 
						);
				
			//if api username, api password or signature not set in settings then show error
			if( WPS_DEALS_PAYPAL_API_USERNAME == '' || WPS_DEALS_PAYPAL_API_PASSWORD == '' || WPS_DEALS_PAYPAL_API_SIGNATURE == '' ) {
				
				$redirect = array( 'refund'	=>	'apierror' );
				$redirecthere = array_merge( $redirectarr, $redirect );
				
				wp_redirect( add_query_arg( $redirecthere, admin_url('edit.php') ) );
				exit;
				
			}
				
			//proceed to refund
			$result = $this->model->wps_deals_refund_process( $_GET['orderid'] );
			
			if( $result == true ) { //if refund successfully proceed
				
				//return to deal sales page
				$redirect = array( 'refund'	=>	'success' );
				$redirecthere = array_merge( $redirectarr, $redirect );
				
				wp_redirect( add_query_arg( $redirecthere , admin_url('edit.php') ) );
				exit;
				
			} else {
				
				//return to edit order page with error
				$redirect = array( 'refund'	=>	'fail' );
				$redirecthere = array_merge( $redirectarr, $redirect );
			
				wp_redirect( add_query_arg( $redirecthere , admin_url('edit.php') ) );
				exit;	
			}
		}
		
	}
	
	/**
	 * Social Login Data
	 * 
	 * Handles to show social login data
	 * on the page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_login_page() {
		
		include_once( WPS_DEALS_ADMIN .'/forms/social/wps-deals-social-login-details.php');
		
	}
	
	/**
	 * AJAX Call
	 * 
	 * Handles to ajax call to store social count to the database
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.1
	 * 
	 */
	public function wps_deals_send_test_email() {
		
		global $current_user;
		
		$email_template = isset( $_POST['template'] ) && !empty( $_POST['template'] ) ? $_POST['template'] : 'default';
		
		$args = array( 
							'email_template' 	=> $email_template,
							'test_email'		=>	'1', //this is test email content
							'user_data'			=> array( 
															'user_email'	=> isset( $current_user->user_email ) ? $current_user->user_email : get_option('admin_email'),
															'first_name'	=> isset( $current_user->user_firstname ) ? $current_user->user_firstname : '',
															'last_name'		=> isset( $current_user->user_lastname ) ? $current_user->user_lastname : '',
															'user_name'		=> isset( $current_user->user_login ) ? $current_user->user_login : ''
														),
							'order_details'		=> array( 
															'display_order_total' 		=> $this->currency->wps_deals_formatted_value('10'),
															'display_order_subtotal' 	=> $this->currency->wps_deals_formatted_value('10'),
															//'order_id'					=> '100'
														)
						);
						
		$this->model->wps_deals_buyer_mail( $args );
		
		echo 'success';
		exit;
	}
	
	/**
	 * AJAX Call
	 * 
	 * Handles to ajax call to store social count to the database
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.1
	 * 
	 */
	public function wps_deals_preview_purchse_receipt_popup() {
		
		global $wps_deals_options, $current_user;
		
		//get user email template value from settings page
		$message = isset( $wps_deals_options['buyer_email_body'] ) ? $wps_deals_options['buyer_email_body'] : '';
		
		$first_name = isset( $current_user->user_firstname ) ? $current_user->user_firstname : '';
		$last_name = isset( $current_user->user_lastname ) ? $current_user->user_lastname : '';
		$fullname = $first_name.' '.$last_name;
		$user_name = isset( $current_user->user_login ) ? $current_user->user_login : '';
		$payment_method = __( 'Sample Method', 'wpsdeals' );
		$purchase_date = date_i18n( get_option( 'date_format' ), time() );
		$sampletitle = __( 'Sample Deal Title', 'wpsdeals' );
		$quantity = '1';
		$orderamount = $this->currency->wps_deals_formatted_value('10');
		$ordersubttotal = $this->currency->wps_deals_formatted_value('10');
		$product_details = "\n\n".'1'.') '.$sampletitle.' - '.$orderamount.' x '.$quantity.' - '.$orderamount;
		$product_details .= "\n".sprintf( __( 'Download File %d :','wpsdeals' ), 1 ).'<a href="#">'. __( 'Sample File', 'wpsdeals') .'</a>';
		$product_details .= "\n\n". __('Notes : Purchase Notes','wpsdeals');

		$message = str_replace('{first_name}',$first_name,$message);
		$message = str_replace('{last_name}',$last_name,$message);
		$message = str_replace('{fullname}',$fullname,$message);
		$message = str_replace('{username}',$user_name,$message);
		$message = str_replace('{payment_method}', apply_filters( 'wps_deals_buyer_email_payment_method', $payment_method ), $message);
		$message = str_replace('{sitename}',get_option('blogname'),$message);
		$message = str_replace('{purchase_date}',$purchase_date,$message);
		$message = str_replace('{product_details}',$product_details,$message);
		$message = str_replace('{order_id}','100',$message);
		$message = str_replace('{total}',html_entity_decode($orderamount),$message);
		$message = str_replace('{subtotal}',html_entity_decode($ordersubttotal),$message);
		$message = nl2br($message);
		
		// Get all email templates
		$email_templates = $this->model->wps_deals_email_get_templates();
		
		?>
		<div id="wps_deal_preview_purchase_receipt">
			<?php
				foreach ( $email_templates as $key => $option ) {
					$key = !empty( $key ) ? $key : 'default';
			?>
				<div class="wps-deals-preview-<?php echo $key; ?>-popup wps-deals-preview-popup">
					<?php
						$html = ''; 
						$html = apply_filters( 'wps_deals_email_template_css_' . $key, $html );
						$html = apply_filters( 'wps_deals_email_template_' . $key, $html, $message );
						$html .= '<div class="clear"></div>';
						echo $html;
					?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
	
	/**
	 * Change template design for default email template
	 *
	 * Handles to change template design for default email template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.1
	 * 
	 */
	public function wps_deals_email_template_default( $html, $message ) {
		
		$html .= '<div class="wps-deals-purchase-parent" style="border:1px solid #464646; background-color:#E6E6E6; width:60%; margin:0 auto; padding:10px;">';
		$html .= '	<div class="wps-deals-purchase-child" style="background-color:#fff; margin:0 auto; padding:15px;">';
		$html .= 		$message;
		$html .= '	</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	/**
	 * Change template design for plain email template
	 *
	 * Handles to change template design for plain email template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.1
	 * 
	 */
	public function wps_deals_email_template_plain( $html, $message ) {
		
		$html .= $message;
		
		return $html;
	}
	
	/**
	 * Add rating links to the admin footer
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_admin_footer_rate_us( $footer_text ) {
		global $typenow;
	
		if ( $typenow == WPS_DEALS_POST_TYPE ) {
			$rate_text = sprintf( __( 'Thank you for using <a href="%1$s" target="_blank">Social Deals Engine</a>! Please <a href="%2$s" target="_blank">rate us</a> on <a href="%2$s" target="_blank">WordPress.org</a>', 'wpsdeals' ),
				'http://wpsocial.com/deals-engine/',
				'https://wordpress.org/support/view/plugin-reviews/deals-engine'
			);
	
			return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
		} else {
			return $footer_text;
		}
	}
	
	/**
	 * Theme Support Admin Notice
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.6
	 */
	public function wps_deals_reset_admin_notices() {
		
		update_option( 'wpsdeals_admin_notices', array( 'theme_support' ) );
	}
	
	
	/**
	 * Add the "Deals Store" link in admin bar main menu
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.6
	 */
	public function wps_deals_admin_bar_menus( $wps_admin_bar ) {

		global $wps_deals_public;
		
		// Return if filter false
		if ( !apply_filters( 'wps_show_admin_bar_visit_deals_shop', true ) ) {
			return;	
		}
		
		// Returen if user is not admin or logged in
		if ( ! is_admin() || ! is_user_logged_in() ) {
			return;
		}

		// Show only when the user is a member of this site, or they're a super admin
		if ( ! is_user_member_of_blog() && ! is_super_admin() ) {
			return;
		}

		// Don't display when shop page is the same of the page on front
		if ( get_option( 'page_on_front' ) == wps_deals_get_page_id( 'shop_page' ) ) {
			return;
		}
		
		$page_url = $wps_deals_public->wps_get_page_permalink( 'shop_page' );
		
		if( !empty( $page_url ) ) {
		
			// Add an option to visit the store
			$wps_admin_bar->add_node( array(
				'parent' => 'site-name',
				'id'     => 'deals-store',
				'title'  => __( 'Deals Store', 'wpsdeals' ),
				'href'   => $wps_deals_public->wps_get_page_permalink( 'shop_page' )
			) );
		} // End of if condition
	}
	
	/**
	 * Systeminfo Download 
	 * 
	 * @package Social Deals Engine
	 * @since 2.2.6
	 */

	public function wps_deal_tools_sysinfo_download() {

		// Check button of system dowload info
		if(isset($_POST['wps-deal-download-sysinfo']) && isset($_POST['wps-deal-sysinfo']) && $_POST['wps-deal-sysinfo'] != '') {	
	
			// Genrate .txt file
			$data = $_POST['wps-deal-sysinfo'];
			$myfile = fopen("systeminfo.txt", "w");
		 	fwrite($myfile, $data);
		    fclose($myfile);
		
		    // save file
			header( 'Content-Type: text/plain' );
			header( 'Content-Disposition: attachment; filename="systeminfo.txt"' );
			header("Expires: 0");	
		 	readfile('systeminfo.txt');
	 		die();
		}
	}
		
	/**
	 * Process a settings export that generates a .json file of the shop settings
	 * @package Social Deals Engine
	 * @since 2.2.6
	 */
	public function wps_deals_process_settings_export() {
	
		// check export button is click or not
		if( empty( $_POST['wps_deals_export'] ) )
			return;
	
		global $wps_deals_options;
		
		// Getting value of stting(options)
		if(isset($wps_deals_options))
			$settings = $wps_deals_options;
		else 
			$setting=get_option('wps_deals_options');
		
		ignore_user_abort( true );
	
		// Genrate json file
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=wps_deals-settings-export-' . date( 'm-d-Y' ) . '.json' );
		header( "Expires: 0" );
	
		// Json encode 
		echo json_encode( $settings );
		exit;
	}
	
	
	/**
	 * Process a settings import from a json file
	 *
	 * @package Social Deals Engine
	 * @since 2.2.6
	 */
	public function wps_deals_process_settings_import() {
	
			global $wps_deals_model;
		if( empty( $_POST['wps_deals_import'] ) )
			return;
	
		$import_file = $_FILES['import_file']['tmp_name'];
	
		if( empty( $import_file ) ) {
			wp_die( __( 'Please upload a file to import', 'wpsdeals' ) );
			return false;
		}
	
		// Retrieve the settings from the file and convert the json object to an array
		$settings = $wps_deals_model->wps_deals_object_to_array( json_decode( file_get_contents( $import_file ) ) );
	
		// Update options
		update_option( 'wps_deals_options', $settings   );
		 
		// Redirect
		
		//set session to set tab selected in settings page
		$selectedtab = isset( $_POST['selected_tab'] ) ? $_POST['selected_tab'] : '';
		$this->message->add_session( 'wps-deals-selected-tab', strtolower( $selectedtab ) );
		wp_safe_redirect( admin_url( 'edit.php?post_type=wpsdeals&page=wps-deals-tool' ) ); exit;
	}
	
	/**
	 * Adding Hooks
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */

	public function add_hooks() {
		
		//add admin menu pages
		add_action ( 'admin_menu', array($this,'wps_deals_admin_menu_pages' ));
		
		//add register plugin settings
		add_action ( 'admin_init', array($this,'wps_deals_admin_register_settings') );
		
		//add new field to post listing page
		add_action('manage_'.WPS_DEALS_POST_TYPE.'_posts_custom_column', array($this,'wps_deals_manage_custom_column'), 10, 2);
		add_filter('manage_edit-'.WPS_DEALS_POST_TYPE.'_columns', array($this,'add_new_deals_columns'));
		
		//Add action for display deals id
		add_action( 'post_row_actions',array( $this, 'wps_deals_row_actions' ), 10 , 2 );
		
		// For Quick Edit
		add_action( 'save_post', array($this,'wps_deals_quick_save_post_data'),10,2);
		
		add_action('quick_edit_custom_box',  array($this,'wps_deals_quick_edit_values'), 10, 2);
		
		//add sortable column 
		add_filter( 'manage_edit-'.WPS_DEALS_POST_TYPE.'_sortable_columns', array($this,'wps_deals_register_column_sortable' ));
		add_filter( 'request', array($this,'wps_deals_sorting_column' ));
		
		//process bulk action deals sales
		add_action( 'admin_init', array($this, 'wps_deals_sales_bulk_delete') );
		
		//resend purchase receipt to buyer
		add_action( 'admin_init', array($this, 'wps_deals_resend_purchase_receipt') );
		
		//metabox for deals stats
		add_action( 'add_meta_boxes', array($this, 'wps_deals_stats_metabox') );
		
		//meta create for initial 
		add_action( 'save_post', array($this,'wps_deals_price_increment_meta'));
		
		// mark up for popup
		add_action( 'admin_footer-post.php', array( $this,'wps_deals_shortcode_popup' ) );
		add_action( 'admin_footer-post-new.php', array( $this,'wps_deals_shortcode_popup' ) );
		add_action( 'admin_init', array( $this, 'wps_deals_shortcode_popup_button' ) );
		
		//process refund payment of order
		add_action( 'admin_init', array($this, 'wps_deals_refund_order_payment') );
		
		//ajax call to send test email
		add_action( 'wp_ajax_deals_test_email', array($this, 'wps_deals_send_test_email'));
		add_action( 'wp_ajax_nopriv_deals_test_email',array( $this, 'wps_deals_send_test_email'));
		
		// add filter to change template design for default email template
		add_filter( 'wps_deals_email_template_default', array( $this, 'wps_deals_email_template_default' ), 10, 2 );

		// add filter to change template design for plain email template
		add_filter( 'wps_deals_email_template_plain', array( $this, 'wps_deals_email_template_plain' ), 10, 2 );

		//add issue refund button for paypal statndard
		add_action( 'wps_deals_edit_order_beside_submit', array( $this->render, 'wps_deals_paypal_refund_issue_button' ) );
		
		//add image size for deals engine
		add_image_size( 'wpsdeals-single', 400, 400, true );
		
		//add footer for deals engine
		add_filter( 'admin_footer_text', array( $this, 'wps_deals_admin_footer_rate_us' ) );
		
		//Reset admin notices for theme support
		add_action( 'wpsdeals_updated', array( $this, 'wps_deals_reset_admin_notices' ) );
		add_action( 'switch_theme', array( $this, 'wps_deals_reset_admin_notices' ) );
		
		// Add contextual help on deals sales page
		add_action( 'load-wpsdeals_page_wps-deals-sales', array( $this->render, 'wps_deals_sales_contextual_help') );
		
		// Display Deals Shop submenu in admin bar menu
		add_action( 'admin_bar_menu', array( $this, 'wps_deals_admin_bar_menus' ), 31 );
		
		// System info File Download 
		add_action( 'admin_init', array($this, 'wps_deal_tools_sysinfo_download'));
		
		// Export Setting Json file from Import/Export
		add_action( 'admin_init', array($this, 'wps_deals_process_settings_export' ));
		
		// Import setting by Json file from Import/Export
		add_action( 'admin_init', array($this, 'wps_deals_process_settings_import' ));
	}
}