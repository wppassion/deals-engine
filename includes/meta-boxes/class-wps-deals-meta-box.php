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
class Wps_Deals_Meta_Box {
	
	public $model,$scripts,$currency,$price,$logs,$render;
	
	public function __construct() {		
	
		global $wps_deals_model,$wps_deals_render,$wps_deals_scripts,
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
	
	/*
	 * Add metaboxes
	 *
	 * @package Social Deals Engine 
	 * @since 1.0.0
	 */
	function wps_deals_add_meta_box() {
		
		// Check for which post type we need to add the meta box
		$pages = wps_deals_get_meta_pages();
		
		// Loop through array	
		foreach ( $pages as $page ) {
			add_meta_box( 'wps_deals_meta', __( 'Social Deals Engine', 'wpsdeals'), array($this, 'wps_deals_meta_box_show'), $page, 'normal', 'high' );	
		}
		
	}
	
	/**
	 * Display Meta Box
	 * 
	 * Handles to display meta box
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_meta_box_show() {
		
		global $wps_deals_options,$post;
		
		$currencysymbol = isset($wps_deals_options['currency']) ? $wps_deals_options['currency'] : 'USD';
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//var_dump($this->_fields);
		wp_nonce_field( WPS_DEALS_BASENAME, 'at_wps_deals_meta_box_nonce' );
		//adding tab in meta box via addTabs Function
		
		//get stored type in metabox
		$deal_stored_type = get_post_meta( $post->ID, $prefix . 'type', true );
		$deal_stored_type = isset( $deal_stored_type ) && !empty( $deal_stored_type ) ? $deal_stored_type : 'simple';
		
		$deal_types = apply_filters( 'wps_deals_types', $this->model->wps_deals_get_deal_types() , $deal_stored_type );
		
		$get_bundle_deals = $this->model->wps_deals_get_deal_bundles();
		
		// Purchase Button Behaviour Options
		$purchase_button_behaviour_options = array();		
		$purchase_button_behaviour_options['add_to_cart'] = __('Add To Cart','wpsdeals');				
		
		// check paypal is enabled, if yes then add buy now option
		if( isset( $wps_deals_options['payment_gateways']['paypal'] ) && !empty( $wps_deals_options['payment_gateways']['paypal'] ) )
			$purchase_button_behaviour_options['direct'] =  __('Buy Now','wpsdeals');

		
	?>
		<div class="wps-deals-metabox-tabs-div">
			
			<span class="wps-deals-metabox-type-box"> &mdash;
				<?php do_action('wps_deals_type_before'); ?>
				<label for="<?php echo $prefix . 'type';?>">
					<select id="wps_deals_type" name="<?php echo $prefix . 'type';?>">
						<optgroup label="<?php echo __( 'Deal Type', 'wpsdeals' );?>">
						<?php
							foreach ( $deal_types as $key => $type ) {
						?>
								<option value="<?php echo $key;?>" <?php selected( $key, $deal_stored_type, true );?>>
									<?php echo $type;?>
								</option>
						<?php
							}
						?>
						</optgroup>
					</select>
				</label>
				
				<?php do_action('wps_deals_type_after'); ?>
			</span>
			
			<ul class="metabox-tabs" id="metabox-tabs">
		
				<li class="active general"><a class="active" href="javascript:void(null);"><?php _e('General','wpsdeals') ?></a></li>
				<li class="bundle"><a href="javascript:void(null);"><?php _e('Bundle','wpsdeals') ?></a></li>
				<li class="upload"><a href="javascript:void(null);"><?php _e('Uploads','wpsdeals') ?></a></li>
				<li class="purchase"><a href="javascript:void(null);"><?php _e('Purchase','wpsdeals') ?></a></li>
				
				<?php do_action('wps_deals_tabs_after'); ?>
			
			</ul>
			
			<div id="general_content" class="general">
					
				<?php 
				
					wps_deals_tab_content_begin();
					
						do_action('wps_deals_general_tab_content_before');
								
							// deal main image
							wps_deals_add_image( array( 'id' => $prefix . 'main_image', 'name'=> __( 'Deal Main Image:', 'wpsdeals' ), 'desc' => __( 'Upload the main image for the deal. This is the image which is being used on the deals overview page. This image should have a width of around 600px, depending on your theme and it looks best, if the image is rectangular. Please just make sure, that all the images you\'re using for the different deals, do have the same size in width and height.', 'wpsdeals' ) ) );
						
						do_action('wps_deals_main_image_after');
						
							// deal page image
							//wps_deals_add_image( array( 'id' => $prefix . 'page_image', 'name'=> __( 'Deal Page Image:', 'wpsdeals' ), 'desc' => __( 'Upload the deal page image here. This is the image which is being used on the deal\'s page. This image should have a width of around 400px, depending on your theme and it looks best, if the image has a square format.', 'wpsdeals' ) ) );
						
						//do_action('wps_deals_page_image_after');
						
							// select deal being show on home page or not
							wps_deals_add_select( array( 'id' => $prefix . 'show_on_home', 'options' => array('0' => __('No','wpsdeals'), '1' => __('Yes','wpsdeals')), 'name'=> __( 'Display on Deals Home Page:', 'wpsdeals' ), 'std'=> array( '' ), 'desc' => __( 'Select if this deal should be displayed on the deals home page.', 'wpsdeals' ) ) );
						
						do_action('wps_deals_show_on_home_after');
						
							// Featured Deal
							wps_deals_add_checkbox( array( 'id' => $prefix . 'featured_deal', 'name'=> __( 'Featured Deal:', 'wpsdeals' ), 'desc' => __( 'Check this box if you want to make this deal as a featured deal.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_featured_deal_after');
						
							//deal start date time
							wps_deals_add_datetime( array( 'id' => $prefix . 'start_date', 'name' => __('Start Date: ', 'wpsdeals'),'std' => array(''),'desc' => __('Choose a start date for this deal.', 'wpsdeals'),'format'=>'dd-mm-yy' ) );
						
						do_action('wps_deals_start_date_after');
						
							//deal end date time
							wps_deals_add_datetime( array( 'id' => $prefix . 'end_date', 'name' => __('End Date: ', 'wpsdeals'),'std' => array(''),'desc' => __('Choose an end date for this deal.', 'wpsdeals'),'format'=>'dd-mm-yy' ) );
					
						do_action('wps_deals_start_date_after');
						
						echo '</tbody>
							<tbody id="wps_deals_avail_total_wrapper">';
						
							// total available deals
							wps_deals_add_text( array( 'id' => $prefix . 'avail_total', 'name'=> __( 'Total Available Deals:', 'wpsdeals' ), 'desc' => __( 'Enter the amount of available deals. Leave it empty for unlimited purchases.', 'wpsdeals' ) ) );
						
						echo '</tbody>
							<tbody>';
							
						do_action('wps_deals_avail_total_after');
						
							// deal normal price
							wps_deals_add_text( array( 'id' => $prefix . 'normal_price', 'name'=> __( 'Normal Price', 'wpsdeals' ) . ' ( '. $this->currency->wps_deals_currency_symbol($currencysymbol) . ' ): ', 'desc' => __( 'Enter the normal price of the product/service.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_normal_price_after');
						
							// deal sale price
							wps_deals_add_text( array( 'id' => $prefix . 'sale_price', 'name'=> __( 'Deal Price', 'wpsdeals' ) . ' ( ' . $this->currency->wps_deals_currency_symbol($currencysymbol) . ' ) : ', 'desc' => __( 'Enter the special deal price for the product/service.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_sale_price_after');
						
						echo '</tbody>
							<tbody id="wps_deals_inc_price_wrapper">';
						
							// deal increase price
							wps_deals_add_text( array( 'id' => $prefix . 'inc_price', 'name'=> __( 'Increase Price', 'wpsdeals' ) . ' ( '. $this->currency->wps_deals_currency_symbol($currencysymbol) . ' ): ', 'desc' => __( 'If you want to use the deals as dimesale, then you can enter the price for which it should increase here.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_inc_price_after');
						
							// deal increase ratio
							wps_deals_add_text( array( 'id' => $prefix . 'inc_ratio', 'name'=> __( 'Increase Price Ratio:', 'wpsdeals' ), 'desc' => __( 'If you want to use the deals as dimesale, then you can enter the amount of sales after which the price should increase here.', 'wpsdeals' ) ) );
							
						echo '</tbody>
							<tbody>';
							
						do_action('wps_deals_inc_ratio_after');
						
						echo '</tbody>
							<tbody id="wps_deals_purchase_link_wrapper">';
						
							// purchase link
							wps_deals_add_text( array( 'id' => $prefix . 'purchase_link', 'name'=> __( 'Purchase Link:', 'wpsdeals' ), 'desc' => __( 'If this is an affiliate or CPA deal, then you can enter the URL to that deal here. If an URL is entered, then the product won\'t be added to the cart.', 'wpsdeals' ) ) );
						
						echo '</tbody>
							<tbody>';
						
						do_action('wps_deals_purchase_link_after');	
						
						echo '</tbody>
							<tbody id="wps_deals_behavior_wrapper">';
							
							// select purchase behaviour buttton
							wps_deals_add_select( array( 'id' => $prefix . 'behavior', 'class' => 'wps-deals-behavior', 'options' => $purchase_button_behaviour_options, 'name'=> __( 'Purchase Button Behavior:', 'wpsdeals' ), 'std'=> array( '' ), 'desc' => __( 'Select the purchase button behavior.', 'wpsdeals' ) ) );
						
						echo '</tbody>
							<tbody>';
							
						do_action('wps_deals_behavior_after');
						
						echo '</tbody>
							<tbody id="wps_deals_buy_now_wrapper">';
						
							// buy now text
							wps_deals_add_text( array( 'id' => $prefix . 'buy_now', 'class' => 'wps-deals-buy-now', 'name'=> __( 'Buy Now Text:', 'wpsdeals' ), 'desc' => __( 'Here you can enter a custom "Buy Now" text, which will be displayed on the button.', 'wpsdeals' ) ) );
							
						echo '</tbody>
							<tbody>';
								
						do_action('wps_deals_buy_now_after');
						
						echo '</tbody>
							<tbody id="wps_deals_add_to_cart_wrapper">';
						
							// add to cart text
							wps_deals_add_text( array( 'id' => $prefix . 'add_to_cart', 'class' => 'wps-deals-add-to-cart', 'name'=> __( 'Add To Cart Button Text:', 'wpsdeals' ), 'desc' => __( 'Here you can enter a custom "Add To Cart" text, which will be displayed on the button. Leave it empty to use the one from the settings page.', 'wpsdeals' ) ) );
							
						echo '</tbody>
							<tbody>';
								
						do_action('wps_deals_add_to_cart_after');
						
							// show add to cart button and of content
							wps_deals_add_checkbox( array( 'id' => $prefix . 'disable_button_bottom', 'name'=> __( 'Disable Purchase Button After Content:', 'wpsdeals' ), 'desc' => __( 'Check this box to disable the purchase button after the deals content.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_disable_button_bottom_after');
						
						echo '</tbody>
							<tbody id="wps_deals_available_bought_wrapper">';
						
							// display available and bought
							wps_deals_add_checkbox( array( 'id' => $prefix . 'available_bought', 'name'=> __( 'Disable Available & Bought Box:', 'wpsdeals' ), 'desc' => __( 'Check this box, if you don\'t want to show the available and bought box for this deal. This option will only work, if you haven\'t disabled these boxes within the settings page.', 'wpsdeals' ) ) );
							
						echo '</tbody>
							<tbody>';
						
							// display limit purchase per user
							wps_deals_add_text( array( 'id' => $prefix . 'purchase_limit', 'name'=> __( 'Purchase Limit:', 'wpsdeals' ), 'desc' => __( 'Leave blank or set to 0 for unlimited, set to -1 to mark a product as sold out. Purchase limit will be applied per user.', 'wpsdeals' ) ) );
														
						echo '</tbody>
							<tbody>';
						
								
						do_action('wps_deals_available_bought_after');
						
							// business title
							wps_deals_add_text( array( 'id' => $prefix . 'business_title', 'name'=> __( 'Business Title:', 'wpsdeals' ), 'desc' => __( 'Enter a title about the business. This will appear above the business information related to this deal. Leave it blank if you don\'t want to use it.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_business_title_after');
						
							// business logo
							wps_deals_add_image( array( 'id' => $prefix . 'business_logo', 'name'=> __( 'Business Logo:', 'wpsdeals' ), 'desc' => __( 'Upload the business logo related to this deal. Leave it blank if you don\'t want to use it.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_business_logo_after');
						
							// business address
							wps_deals_add_textarea( array( 'id' => $prefix . 'business_address', 'name'=> __( 'Business Address:', 'wpsdeals' ), 'desc' => __( 'Enter the adress of the business related to this deal. Leave it blank if you don\'t want to use it.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_business_address_after');
						
							// business website url
							wps_deals_add_text( array( 'id' => $prefix . 'bus_web_url', 'name'=> __( 'Business Website URL:', 'wpsdeals' ), 'desc' => __( 'Enter the URL of the business which provides this deal. The URL must start with http://', 'wpsdeals' ) ) );
							
						do_action('wps_deals_bus_web_url_after');
						
							$googlelocations = array( 
											'0'	=>	array( 'id' => $prefix .'gmap_address', 'type' => 'text', 'name'=> __( 'Address:', 'wpsdeals' ), 'desc' => __( 'Enter the complete address which will be used for the Google Map. Leave it blank if you don\'t want to show a Google Map.', 'wpsdeals' ) ),
											'1'	=>	array( 'id' => $prefix. 'gmap_popup_width','type' => 'text', 'name'=> __( 'Popup Width:', 'wpsdeals' ), 'desc' => __( 'Enter a max width for the Google Map popup window. Please enter only a numeric value (eg.50).', 'wpsdeals' ) ),
											'2'	=>	array( 'id' => $prefix. 'gmap_popup_content','type' => 'textarea', 'name'=> __( 'Popup Content:', 'wpsdeals' ), 'desc' => __( 'Here you can enter custom content for the Google Map popup window. If you leave that empty, the address will be displayed.', 'wpsdeals' ) )
											//'2'	=>	array( 'id' => $prefix. 'gmap_popup_content','type' => 'editor', 'name'=> __( 'Popup Content:', 'wpsdeals' ), 'desc' => __( 'Here you can enter custom content for the Google Map popup window. If you leave that empty, the address will be displayed.', 'wpsdeals' ) )
										);
						
							// deal address
							wps_deals_add_repeater_block(  array( 'id' => $prefix. 'google_map', 'name' => __( 'Google Map:', 'wpsdeals' ), 'desc' => __( 'If the Deal has more than one location, then you can add all the locations within this option.', 'wpsdeals' ), 'fields' => $googlelocations ) );
						
						do_action('wps_deals_google_map_after');
						
							// terms & conditions
							wps_deals_add_textarea( array( 'id' => $prefix . 'terms_conditions', 'name'=> __( 'Terms & Conditions:', 'wpsdeals' ), 'desc' => __( 'Enter terms & conditions for this deal here.', 'wpsdeals' ) ) );
						
						do_action('wps_deals_terms_conditions_after');
						
						do_action('wps_deals_general_tab_content_after');
				
					wps_deals_tab_content_end();		
				?>
				
			</div>
			
			
			<div id="bundle_content" class="bundle">
				<?php 
				
					wps_deals_tab_content_begin();
					
						do_action('wps_deals_bundle_tab_content_before');
						
						wps_deals_add_bundel( array( 'id' => $prefix. 'bundle_deals', 'options' => $get_bundle_deals, 'name'=> __( 'Deals:', 'wpsdeals' ) ) );
						
						do_action('wps_deals_bundle_files_after');
						
					wps_deals_tab_content_end();		
				?>
			</div>
			
			<div id="upload_content" class="upload">
			
				<?php 
					
					wps_deals_tab_content_begin();
					
						do_action('wps_deals_upload_tab_content_before');
						
						//file uploader
							wps_deals_add_fileadvanced( array( 'id' => $prefix. 'upload_files', 'name'=> __( 'Upload Files:', 'wpsdeals' ) ) );
						
						do_action('wps_deals_upload_files_after');
						
							//download limit
							wps_deals_add_text( array( 'id' => $prefix . 'download_limit', 'name'=> __( 'File Download Limit: ', 'wpsdeals' ), 'desc' => __( 'The maximum number of times a buyer can download each file. Leave blank for unlimited.', 'wpsdeals' ) ) );
							
						do_action('wps_deals_download_limit_after');
						
						do_action('wps_deals_upload_tab_content_after');
				
					wps_deals_tab_content_end();		
				?>
					
			</div>
			
			<div id="purchase_content" class="purchase">

				<?php 
				
					wps_deals_tab_content_begin();
					
						do_action('wps_deals_purchase_tab_content_before');
						
							//purchase notes
							wps_deals_add_textarea( array( 'id' => $prefix . 'purchase_notes', 'name'=> __( 'Purchase Notes:', 'wpsdeals' ), 'desc' => __( 'Special notes or instructions for this deal. These notes will be added to the purchase receipt.', 'wpsdeals' ) ) );
	
						do_action('wps_deals_purchase_notes_after');
						
						do_action('wps_deals_purchase_tab_content_after');
				
					wps_deals_tab_content_end();		
				?>
				
			</div>
			
			<?php do_action('wps_deals_tabs_content_after'); ?>
			
		</div>
		
	<?php
	
	}
	
	/*
	 * Save meta
	 *
	 * @package Social Deals Engine 
	 * @since 1.0.0
	 */
	function wps_deals_save_meta( $post_id ) {
		
		global $post_type;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$post_type_object = get_post_type_object( $post_type );
		
		// Check for which post type we need to add the meta box
		$pages = wps_deals_get_meta_pages();

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                // Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
		|| ( ! in_array( $post_type, $pages ) )              // Check if current post type is supported.
		|| ( ! check_admin_referer( WPS_DEALS_BASENAME, 'at_wps_deals_meta_box_nonce') )      // Check nonce - Security
		|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )       // Check permission
		{
		  return $post_id;
		}
		
		// Deal Type
		update_post_meta( $post_id, $prefix.'type', $_POST[$prefix.'type'] );
		
		// Display on Home Page
		update_post_meta( $post_id, $prefix.'show_on_home', $_POST[$prefix.'show_on_home'] );
		
		// Featured Deal
		$featured_deal = isset( $_POST[$prefix.'featured_deal'] ) ? 'on' : '';
		update_post_meta( $post_id, $prefix.'featured_deal', $this->model->wps_deals_escape_slashes_deep( $featured_deal ) );
		
		//Update deal main image
		update_post_meta( $post_id, $prefix.'main_image', $_POST[$prefix.'main_image'] );
		
		// Start Date
		$start_date = $_POST[$prefix.'start_date'];
		if(!empty($start_date)) {
			$start_date = strtotime( $this->model->wps_deals_escape_slashes_deep( $start_date ) );
			$start_date = date('Y-m-d H:i:s',$start_date);
		}
		update_post_meta( $post_id, $prefix.'start_date', $start_date );
		
		// End Date
		$end_date = $_POST[$prefix.'end_date'];
		if(!empty($end_date)) {
			$end_date = strtotime( $this->model->wps_deals_escape_slashes_deep( $end_date ) );
			$end_date = date('Y-m-d H:i:s',$end_date);
		}
		update_post_meta( $post_id, $prefix.'end_date', $end_date );
		
		// Total Available Deals
		update_post_meta( $post_id, $prefix.'avail_total', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'avail_total'] ) );
		
		// Normal Price
		update_post_meta( $post_id, $prefix.'normal_price', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'normal_price'] ) );
		
		// Deal Sale Price
		update_post_meta( $post_id, $prefix.'sale_price', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'sale_price'] ) );
		
		// Deal Price ( If slae_price is blank then it's take normal_price as price )
		if( isset($_POST[$prefix.'sale_price'] ) && !empty($_POST[$prefix.'sale_price']) ) {
			update_post_meta( $post_id, $prefix.'price', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'sale_price'] ) );
		} else {
			update_post_meta( $post_id, $prefix.'price', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'normal_price'] ) );
		}
		
		// Increase Price
		update_post_meta( $post_id, $prefix.'inc_price', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'inc_price'] ) );
		
		// Increase Price Ratio
		update_post_meta( $post_id, $prefix.'inc_ratio', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'inc_ratio'] ) );
		
		// Add to Cart Button after Content
		$disable_button = isset( $_POST[$prefix.'disable_button_bottom'] ) ? 'on' : '';
		update_post_meta( $post_id, $prefix.'disable_button_bottom', $this->model->wps_deals_escape_slashes_deep( $disable_button ) );
		
		// Purchase Link
		update_post_meta( $post_id, $prefix.'purchase_link', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'purchase_link'] ) );
		
		// Purchase Behaviour Button
		update_post_meta( $post_id, $prefix.'behavior', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'behavior'] ) );
		
		// Buy Now Text
		update_post_meta( $post_id, $prefix.'buy_now', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'buy_now'] ) );
		
		// Add To Cart Text
		update_post_meta( $post_id, $prefix.'add_to_cart', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'add_to_cart'] ) );
		
		// Available & Bought Box
		$availble_bought = isset( $_POST[ $prefix.'available_bought' ] ) ? 'on' : '';
		update_post_meta( $post_id, $prefix.'available_bought', $this->model->wps_deals_escape_slashes_deep( $availble_bought ) );
		
		// Purchase Limit		
		update_post_meta( $post_id, $prefix.'purchase_limit', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'purchase_limit'] ) );
				
		// Business Title
		update_post_meta( $post_id, $prefix.'business_title', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'business_title'] ) );
		
		// Business Logo
		update_post_meta( $post_id, $prefix.'business_logo', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'business_logo'] ) );
		
		// Business Address
		update_post_meta( $post_id, $prefix.'business_address', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'business_address'] ) );
		
		// Business Website URL
		update_post_meta( $post_id, $prefix.'bus_web_url', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'bus_web_url'] ) );
		
		//google Map 
		$googlemap = array();
		if( isset( $_POST[$prefix.'gmap_address'] ) ) {
			
			$gmapaddress = $_POST[$prefix.'gmap_address'];
			$gmappopupwidth = $_POST[$prefix.'gmap_popup_width'];
			$gmappopupcontent = $_POST[$prefix.'gmap_popup_content'];
			
			for ( $i = 0; $i < count( $gmapaddress ); $i++ ){
				
				if( !empty( $gmapaddress[$i] ) || !empty( $gmappopupwidth[$i]) || !empty( $gmappopupcontent[$i]) ) { //if location or map link is not empty then
					$googlemap[$i][$prefix.'gmap_address'] = $this->model->wps_deals_escape_slashes_deep( $gmapaddress[$i] );
					$googlemap[$i][$prefix.'gmap_popup_width'] = $this->model->wps_deals_escape_slashes_deep( $gmappopupwidth[$i] );
					$googlemap[$i][$prefix.'gmap_popup_content'] = $this->model->wps_deals_escape_slashes_deep( $gmappopupcontent[$i] );
				}
			}
		}
		
		//update google map
		update_post_meta( $post_id, $prefix.'google_map', array_values($googlemap) );
		 
		// Terms & Conditions
		update_post_meta( $post_id, $prefix.'terms_conditions', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'terms_conditions'] ) );
		
		// File Download Limit
		update_post_meta( $post_id, $prefix.'download_limit', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'download_limit'] ) );
		
		// Deals Bundle 
		update_post_meta( $post_id, $prefix. 'bundle_deals', $_POST[$prefix. 'bundle_deals'] );
		
		// Upload Files
		update_post_meta( $post_id, $prefix.'upload_files', $_POST[$prefix.'upload_files'] );
		update_post_meta( $post_id, $prefix.'upload_files_name', $_POST[$prefix.'upload_files_name'] );
		
		// Purchase Notes
		update_post_meta( $post_id, $prefix.'purchase_notes', $this->model->wps_deals_escape_slashes_deep( $_POST[$prefix.'purchase_notes'] ) );
		
		//deals meta images 
		$attachment_ids = isset( $_POST['wps_deals_image_gallery'] ) ? array_filter( explode( ',', sanitize_text_field( $_POST['wps_deals_image_gallery'] ) ) ) : array();
		update_post_meta( $post_id, $prefix . 'image_gallery', implode( ',', $attachment_ids ) );
		
		//do action to save the metabox data
		do_action( 'wps_deals_save_meta', $post_id );
				
	}
	
	/**
	 * Ajax callback for deleting files.
	 * 
	 * Modified from a function used by "Verve Meta Boxes" plugin ( http://goo.gl/aw64H )
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_delete_file() {
    
		// If data is not set, die.
		if ( ! isset( $_POST['data'] ) )
			die();
		  
		list($nonce, $post_id, $key, $attach_id) = explode('|', $_POST['data']);
		
		if ( ! wp_verify_nonce( $nonce, 'at_ajax_delete' ) )
			die( '1' );
			
		$saved = get_post_meta( $post_id,$key, true );

		$index = array_search( $attach_id, $saved );    
		foreach( $saved as $k => $value ) {
			if ( $value == $attach_id )
				unset( $saved[$k] );
		}
		
		if( count( $saved ) > 0 ){
			update_post_meta( $post_id, $key,$saved );
			die('0');
		}
		  
		die( '0' );  
	}
	
	/**
	 * Adding Hooks
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		add_action( 'add_meta_boxes', array( $this, 'wps_deals_add_meta_box' ) );
		
		add_action( 'save_post', array( $this, 'wps_deals_save_meta' ) );
			
		// Delete all attachments when delete custom post type.
		add_action( 'wp_ajax_atm_delete_file', array( $this, 'wps_deals_delete_file' ) );
		
	}
	 
}
?>