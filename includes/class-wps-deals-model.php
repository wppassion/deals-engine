<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Model Class
 *
 * Handles generic plugin functionality.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Model {
	
	public $logs, $price;
	public function __construct() {
		
		global $wps_deals_logs, $wps_deals_price;
		
		$this->logs = $wps_deals_logs;
		$this->price = $wps_deals_price;
		
	}
	
	/**
	 * Get Deal Sales Data
	 * 
	 * Handles get all sales deals data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_data($args=array()) {
		
		$dealsargs = array('post_type' => WPS_DEALS_POST_TYPE, 'post_status' => 'publish');
		
		$dealsargs = wp_parse_args( $args, $dealsargs );
		
		//return only id
		if(isset($args['fields']) && !empty($args['fields'])) {
			$dealsargs['fields'] = $args['fields'];
		}
		
		//return by search
		if(isset($args['s']) && !empty($args['s'])) {
			$dealsargs['s'] = $args['s'];
		}
		
		//get particulate deal id data
		if(isset($args['p']) && !empty($args['p'])) {
			$dealsargs['p']	= $args['p'];
		}
		
		//return based on meta query
		if(isset($args['meta_query']) && !empty($args['meta_query'])) {
			$dealsargs['meta_query'] = $args['meta_query'];
		}
		
		//show how many per page records
		if(isset($args['posts_per_page']) && !empty($args['posts_per_page'])) {
			$dealsargs['posts_per_page'] = $args['posts_per_page'];
		} else {
			$dealsargs['posts_per_page'] = -1;
		}
		
		//show per page records
		if(isset($args['paged']) && !empty($args['paged'])) {
			$dealsargs['paged']	=	$args['paged'];
		}
		
		//get the data by year
		if(isset($args['year']) && !empty($args['year'])) {
			$dealsargs['year']	= $args['year'];	
		}
		
		//get the data by mont
		if(isset($args['monthnum']) && !empty($args['monthnum'])) {
			$dealsargs['monthnum']	= $args['monthnum'];	
		}
		
		//get the data by day
		if(isset($args['day']) && !empty($args['day'])) {
			$dealsargs['day']	= $args['day'];	
		}
		//get the data by hour
		if(isset($args['hour']) && !empty($args['hour'])) {
			$dealsargs['hour']	= $args['year'];	
		}
		
		//get order by records
		$dealsargs['order'] = 'DESC';
		$dealsargs['orderby'] = 'date';
		
		//fire query in to table for retriving data
		$result = new WP_Query( $dealsargs );
		
		if(isset($args['getcount']) && $args['getcount'] == '1') {
			$postslist = $result->post_count;	
		}  else {
			//retrived data is in object format so assign that data to array for listing
			$postslist = $this->wps_deals_object_to_array($result->posts);
			
			// if get list for deal sales list then return data with data and total array
		   if( isset($args['deals_reports_list_data']) && !empty($args['deals_reports_list_data']) ) {
		    
	    		$data_res = array();
		           
		    	$data_res['data']  = $postslist;
		    
		    	//To get total count of post using "found_posts" and for users "total_users" parameter
		    	$data_res['total'] = isset($result->found_posts) ? $result->found_posts : '';
		    
		    	return $data_res;
		   }
		}
		
		return $postslist;
	}
	
	/**
	 * Get Deal For Bundle
	 * 
	 * Handles get all sales deals data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_deal_bundles() {
		
		$bundle_deals	= array( '' => __('Select a Deal', 'wpsdeals') );
		$deals			= $this->wps_deals_get_data();
		
		if( !empty($deals) ) {
			foreach ( $deals as $deal ) {
				
				$key = $deal['ID'];
				$bundle_deals[$key] = $deal['post_title'];
			}
		}
		
		return $bundle_deals;
	}
	
	/**
	 * Get Deal Sales Data
	 * 
	 * Handles get all sales deals data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_sales( $args=array() ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$salesargs = array('post_type' => WPS_DEALS_SALES_POST_TYPE, 'post_status' => 'publish');
		
		$salesargs = wp_parse_args( $args, $salesargs );
		
		//return only id
		if(isset($args['fields']) && !empty($args['fields'])) {
			$salesargs['fields'] = $args['fields'];
		}
		
		//return by search
		if(isset($args['s']) && !empty($args['s'])) {
			$salesargs['s'] = $args['s'];
		}
		
		//return based on meta query 
		//this should be passed like array( array( 'key' => $key, 'value' => $value ) )
		if(isset($args['meta_query']) && !empty($args['meta_query'])) {
			$salesargs['meta_query'] = $args['meta_query'];
		}
		
		//this is for user is should not zero
		if(isset($args['author']) && !empty($args['author'])) {
			$salesargs['author'] = $args['author'];
		}
		
		 //for backend sales orders to allow guest users in list
		if( isset($args['author']) && empty($args['author']) ) {
			$salesargs['author'] = "'".$args['author']."'"; //when userid is zero need to add quot
		}
		
		//show how many per page records
		if(isset($args['posts_per_page']) && !empty($args['posts_per_page'])) {
			$salesargs['posts_per_page'] = $args['posts_per_page'];
		} else {
			$salesargs['posts_per_page'] = -1;
		}
		
		//show per page records
		if(isset($args['paged']) && !empty($args['paged'])) {
			$salesargs['paged']	=	$args['paged'];
		}
		
		//get particulate order id's order data
		if(isset($args['p']) && !empty($args['p'])) {
			$salesargs['p']	= $args['p'];
		}
		
		//get the data by year
		if(isset($args['year']) && !empty($args['year'])) {
			$salesargs['year']	= $args['year'];	
		}
		
		//get the data by mont
		if(isset($args['monthnum']) && !empty($args['monthnum'])) {
			$salesargs['monthnum']	= $args['monthnum'];	
		}
		
		//get the data by day
		if(isset($args['day']) && !empty($args['day'])) {
			$salesargs['day']	= $args['day'];	
		}
		//get the data by hour
		if(isset($args['hour']) && !empty($args['hour'])) {
			$salesargs['hour']	= $args['year'];	
		}
		
		// get start date and end date
	  	$salesargs['start_date'] = isset( $args['start_date'] ) ? $args['start_date'] : null;
	  	$salesargs['end_date']   = isset( $args['end_date'] )   ? $args['end_date']   : $salesargs['start_date'];
	  	
	  	if( !empty( $salesargs['start_date'] ) || !empty( $salesargs['end_date'] ) ) {
	  		
	  		// add date query filter to get sales by start date and end date
	  		$salesargs['date_query'] = array( 
    									'after' => $salesargs['start_date'],
	         							'before' => $salesargs['end_date'],
         								'inclusive'=> true	// start date inclusive, end date exclusive
           							);
  		}		  	
		
		//get order by records
		$salesargs['order']		= 'DESC';
		$salesargs['orderby']	= 'date';
		
		//return order
		if(isset($args['order']) && !empty($args['order'])) {
			$salesargs['order'] = $args['order'];
		}
		//return orderby
		if( isset( $args['orderby'] ) && !empty( $args['orderby'] ) ) {
			$salesargs['orderby'] = $args['orderby'];
		}
				
		// If seach is set
		if( isset( $args['s']) ) { 
			
			$search = trim( $args['s'] );
		
		  	$is_email = is_email( $search ) || strpos( $search, '@' ) !== false;			
			
			if ( $is_email ) { // if search by email
				
				// add meta query for email search
				$key = $prefix.'payment_user_email';
				$search_meta = array(
					'key'     => $key,
					'value'   => $search,
					'compare' => 'LIKE'
				);
								
				$salesargs['meta_query'][] = $search_meta;
				unset( $salesargs['s'] );
								
			} elseif ( is_numeric( $search ) ) { // if search by numeric value

				$post = get_post( $search );
				
				// if post type is wpsdealssales
				if( is_object( $post ) && $post->post_type == WPS_DEALS_SALES_POST_TYPE ) {
	
					$arr   = array();
					$arr[] = $search;
					$salesargs['post__in'] = $arr;
					unset( $salesargs['s'] );
				}
									
			} elseif ( '#' == substr( $search, 0, 1 ) ) { // if search by Deal id

				$salesargs['wpsdeals'] = str_replace( '#', '', $search );
				
				if( !empty( $salesargs['wpsdeals'] ) ) {
					
					$download_args = array(
						'post_parent'            => $salesargs['wpsdeals'],
						'log_type'               => 'sale',
						'post_status'            => array( 'publish' ),
						'nopaging'               => true,
						'no_found_rows'          => true,
						'update_post_term_cache' => false,
						'update_post_meta_cache' => false,
						'cache_results'          => false,
						'fields'                 => 'ids'
					);

					if ( is_array( $salesargs['wpsdeals'] ) ) {
						unset( $salesargs[ 'post_parent' ] );
						$salesargs[ 'post_parent__in' ] = $salesargs['wpsdeals'];
					}
								
					$sales = $this->logs->get_connected_logs( $download_args );
					
					if ( ! empty( $sales ) ) {
			
						$payments = array();
			
						foreach ( $sales as $sale ) {
							$payments[] = get_post_meta( $sale, $prefix.'log_payment_id', true );
						}
			
						$salesargs['post__in'] = $payments;
			
					} else {
			
						// Set post_parent to something crazy so it doesn't find anything
						$salesargs['post_parent'] = 999999999999999;			
					}
				
					unset( $salesargs['s'] );
				}	
			}
		} // end of search						
		
		//fire query in to table for retriving data
		$result = new WP_Query( $salesargs );				
		
		if( isset( $args['getcount'] ) && $args['getcount'] == '1' ) {
			$postslist = $result->post_count;
		}  else {
			
			//retrived data is in object format so assign that data to array for listing
			$postslist = $this->wps_deals_object_to_array($result->posts);
			
			// if get list for deal sales list then return data with data and total array
			if( isset($args['deals_list_data']) && !empty($args['deals_list_data']) ) {
				
				$data_res			= array();
				$data_res['data']	= $postslist;
				
				//To get total count of post using "found_posts" and for users "total_users" parameter
				$data_res['total']	= isset($result->found_posts) ? $result->found_posts : '';
				
				return $data_res;
			}
		}
		
		return $postslist;
	}
	
	/**
	 * Convert Object To Array
	 * 
	 * Converting Object Type Data To Array Type
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_object_to_array($result)
	{
	    $array = array();
	    foreach ($result as $key=>$value)
	    {	
	        if (is_object($value))
	        {
	            $array[$key]=$this->wps_deals_object_to_array($value);
	        } else {
	        	$array[$key]=$value;
	        }
	    }
	    return $array;
	}
	/**
	 * Escape Tags & Slashes
	 *
	 * Handles escapping the slashes and tags
	 *
	 * @package  Social Deals Engine
	 * @since 1.0.0
	 */
   
	public function wps_deals_escape_attr($data){
		return esc_attr(stripslashes($data));
	}
	
	/**
	 * Strip Slashes From Array
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
   
	public function wps_deals_escape_slashes_deep($data = array(),$flag=false){
			
		if($flag != true) {
			$data = $this->wps_deals_nohtml_kses($data);
		}
		$data = stripslashes_deep($data);
		return $data;
	}
	
	/**
	 * Strip Html Tags 
	 * 
	 * It will sanitize text input (strip html tags, and escape characters)
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_nohtml_kses($data = array()) {
		
		
		if ( is_array($data) ) {
			
			$data = array_map(array($this,'wps_deals_nohtml_kses'), $data);
			
		} elseif ( is_string( $data ) ) {
			
			$data = wp_filter_nohtml_kses($data);
		}
		
		return $data;
	}
 	/**
 	 * Returns value from paypal status
 	 *
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
 	public function wps_deals_paypal_status_to_value( $val ) {
 		
 		switch ( $val ) {
 			
 			case 'Pending' 		:
 									return 0;
				 					break;
 			case 'Completed'	:
	 								return 1;
	 								break;
	 		case 'Reversed'		:
	        case 'Chargeback'	:
 			case 'Refunded'		:
	 								return 2;
	 								break;
	 		case 'Denied'		:
	        case 'Expired'		:
	        case 'Failed'		:
	        case 'Voided'		:
 									return 3;
	 								break;
	 		case 'Cancelled' :
	 								return 4;
	 								break;
	 		case 'On-Hold'		:
	 								return 5;
	 								break;
	 		default: 
				 					return 0;
				 					break;
 		}
 		
 	}
 	
 	/**
 	 * Returns paypal status from value
 	 *
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
 	
 	public function wps_deals_paypal_value_to_status( $val ) {
 		
 		switch ($val) {
 			
 			case '0' :
						return __( 'Pending', 'wpsdeals' );
 						break;
 			case '1' :
						return __( 'Completed', 'wpsdeals' );
						break;
 			case '2' :
						return __( 'Refunded', 'wpsdeals' );
						break;
 			case '3' :
						return __( 'Failed', 'wpsdeals' );
						break;
 			case '4' :
						return __( 'Cancelled', 'wpsdeals' );
						break;
			case '5' :
						return __( 'On-Hold', 'wpsdeals' );
						break;
	 		default: 
	 					return __( 'Pending', 'wpsdeals' );
	 					break;
 		}
 	}
 	
 	/**
 	 * Returns slug from payment status value
 	 *
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
 	
 	public function wps_deals_payment_value_to_slug( $val ) {
 		
 		switch ( $val ) {
 			
 			case '0' :
						return 'pending';
 						break;
 			case '1' :
						return 'completed';
						break;
 			case '2' :
						return 'refunded';
						break;
 			case '3' :
						return 'failed';
						break;
 			case '4' :
						return 'cancelled';
						break;
			case '5' :
						return 'onhold';
						break;
			default: 
	 					return 'pending';
	 					break;
 		}
 	}
 	
 	/**
 	 * Bulk Delete Action
 	 * 
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
 	public function wps_deals_bulk_delete($args = array()) {
 		
 		global $wpdb;
		
		if(isset($args['id']) && !empty($args['id'])) { // check coupon sale id	
			
			
			$userdata = $this->wps_deals_get_ordered_user_details($args['id']);			
			
			if(isset($userdata['user_id']) ) {
				
					// Get Order Details
					$orderdata = $this->wps_deals_get_post_meta_ordered($args['id']);			
					
					// Get purchase details of user
					$previous_list = get_user_meta( $userdata['user_id'], 'wps_deal_purchase_detail', true );
					
					if(!empty($previous_list)) { // Check previously item is purchased
					
						foreach ( $orderdata['deals_details'] as $key => $deal ) {						
								if(($key = array_search($deal['deal_id'], $previous_list)) !== false) {
									//Remove from purchase list
			 						 unset($previous_list[$key]);
								}
						}				
										
					// Update purchase list
						update_user_meta( $userdata['user_id'], 'wps_deal_purchase_detail', $previous_list );
					}
					
					wp_delete_post( $args['id'] );
			}
			
		}
 	}
 	/**
 	 * Send Email to Buyer
 	 * 
 	 * Handles to sending email 
 	 * 
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
	
	public function wps_deals_buyer_mail($data = array()) {
		
		//get the all options values from settings page
		global $wps_deals_options;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//product data
		$productdata = isset( $data['order_details']['deals_details'] ) ? $data['order_details']['deals_details'] : array();
		
		//order amount
		$orderamount = isset( $data['order_details']['display_order_total'] ) ? $data['order_details']['display_order_total'] : '';
		
		//order subtotal
		$ordersubttotal = isset( $data['order_details']['display_order_subtotal'] ) ? $data['order_details']['display_order_subtotal'] : '';
		
		//payment method
		$payment_method = isset( $data['order_details']['payment_method'] ) ? $data['order_details']['payment_method'] : '';
		
		//checkout label
		$checkout_label = isset( $data['order_details']['checkout_label'] ) ? $data['order_details']['checkout_label'] : '';
		
		//order id 
		$orderid = isset( $data['order_details']['order_id'] ) ? $data['order_details']['order_id'] : '';
		
		$cheque_details = '';
		// Check payment method is cheque payment and not empty customer message from settings
		if( $payment_method == 'cheque' && !empty( $wps_deals_options['cheque_customer_msg'] ) ) {
			//cheuqe details
			$cheque_details = $wps_deals_options['cheque_customer_msg'];
		}
		
		$purchase_date = '';
		if( !empty( $orderid ) ) {
			//purchase date
			$purchase_date = get_the_time( get_option('date_format'), $orderid);
		} else {
			$purchase_date = date_i18n( get_option( 'date_format' ), time() );
		}
		//user data
		$userdata = isset( $data['user_data'] ) ? $data['user_data'] : '';
		
		//get user email template value from settings page
		$message = $wps_deals_options['buyer_email_body'];
		
		$product_details = '';
		
		$to = isset( $userdata['user_email'] ) ? $userdata['user_email'] : get_option('admin_email');
		$first_name = isset( $userdata['first_name'] ) ? $userdata['first_name'] : '';
		$last_name = isset( $userdata['last_name'] ) ? $userdata['last_name'] : '';
		$fullname = $first_name.' '.$last_name;
		$user_name = !empty($userdata['user_name']) ? $userdata['user_name'] : '';
		$from_name = get_bloginfo('name');
		$fromemail = !empty( $wps_deals_options['from_email'] ) ? $wps_deals_options['from_email'] : get_option('admin_email');
		
		//$subject = WPS_DEALS_BUYER_EMAIL_SUBJECT;
		$subject = $wps_deals_options['buyer_email_subject'];
		$headers = "From: $fromemail\r\n";
		$headers .= "Reply-To: ". $fromemail . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		
		$i = 1;
		
		$filesmeta = array();
		
		foreach ($productdata as $product) {
			
			$product_details .= "\n\n".$i.') '.get_the_title($product['deal_id']).' - '.$product['display_sale_price'].' x '.$product['deal_quantity'].' - '.$product['display_total'];
					
			//get files without href
			$filesmeta[$product['deal_id']] =  $this->wps_deals_purchase_download_links( $product, $userdata, $orderid, false );
			
			//get files with href to send to mail in 
			$files = $this->wps_deals_purchase_download_links( $product, $userdata, $orderid );
			
			//get deal type
			$dealtype = $this->wps_deals_get_deal_type( $product['deal_id'] );
			
			if( $dealtype == 'simple' ) { //check deal type is simple
				
				//get files list with specific deal id and order id
				$files = apply_filters( 'wps_deals_order_download_files', $files, $product['deal_id'], $orderid );
				
			} else if( $dealtype == 'bundle' ) { //check deal type is bundle
				
				$bundled_deals = $this->wps_deals_get_bundled_deals_list( $product['deal_id'] );
				if( !empty( $bundled_deals ) ) {
					
					$files .= '<ul>';
					
					foreach ( $bundled_deals as $bundled_deal ) {
						
						$files .= "<li>".get_the_title( $bundled_deal );
						
						if( !empty( $bundled_deal ) ) {
							
							//get files without href
							$bundle_product['deal_id'] = $bundled_deal;
							$filesmeta[$bundle_product['deal_id']] =  $this->wps_deals_purchase_download_links( $bundle_product, $userdata, $orderid, false );
							
							//get files with href to send to mail in 
							$bundlefiles = $this->wps_deals_purchase_download_links( array('deal_id' => $bundled_deal), $userdata, $orderid );
							
							$bundlefiles = apply_filters( 'wps_deals_order_download_files', $bundlefiles, $bundled_deal, $orderid );
							
							$files .= $bundlefiles;
						}
						
						$files .= "</li>";
					}
					
					$files .= "</ul>";
				}
				
				$files = apply_filters( 'wps_deals_order_bundles', $files, $product['deal_id'], $orderid );
				
				//update ordered bundle deals to metabox
				update_post_meta( $orderid, $prefix.'ordered_bundle_deals', $bundled_deals );
				
			} else {
				$files = false;
			}
			
			if( $files != false ) {
				$product_details .= $files;
			}
			
			//get purchase note value from post metabox	
			$purchasenote = get_post_meta($product['deal_id'], $prefix.'purchase_notes',true);
			// get purchase note after applying shortcode and filter
			$purchasenote = $this->wps_deals_get_purchase_notes( $purchasenote, $product['deal_id'], $orderid );			
			if(!empty($purchasenote)) { //check there is not empty purchase note then send it with mail to user
				$product_details .= "\n\n". __('Notes :','wpsdeals').' '.$purchasenote;
			}	
			
			$i++;
		}
		
		//update ordered files to metabox
		update_post_meta( $orderid, $prefix.'ordered_files', $filesmeta );
		
		if( isset( $data['email_template'] ) && !empty( $data['email_template'] ) ) {
			
			$email_template_option = $data['email_template'];
			$checkout_label = __( 'Sample Method', 'wpsdeals' );
			$product_details .= "\n\n".'1'.') '.__( 'Sample Deal Title', 'wpsdeals' ).' - '.html_entity_decode($ordersubttotal).' x '.'1'.' - '.html_entity_decode($ordersubttotal);
			$product_details .= "\n".sprintf( __( 'Download File %d :','wpsdeals' ), 1 ).'<a href="#">'. __( 'Sample File', 'wpsdeals') .'</a>';
			$product_details .= "\n\n". __('Notes : Purchase Notes','wpsdeals');
			
		} else if( isset( $wps_deals_options['email_template'] ) && !empty( $wps_deals_options['email_template'] ) ) {
			$email_template_option = $wps_deals_options['email_template'];
		} else {
			$email_template_option = 'default';
		}
		
		 //test email ordre id
		//check test email is set or not then do order id 100
		if( isset( $data['test_email'] ) && !empty( $data['test_email'] ) ) { $orderid = '100';	}
		
		$message = str_replace('{first_name}',$first_name,$message);
		$message = str_replace('{last_name}',$last_name,$message);
		$message = str_replace('{fullname}',$fullname,$message);
		$message = str_replace('{username}',$user_name,$message);
		$message = str_replace('{payment_method}', apply_filters( 'wps_deals_buyer_email_payment_method', $checkout_label ), $message);
		$message = str_replace('{sitename}',get_option('blogname'),$message);
		$message = str_replace('{purchase_date}',$purchase_date,$message);
		$message = str_replace('{product_details}',html_entity_decode($product_details),$message);
		$message = str_replace('{order_id}',$orderid,$message);
		$message = str_replace('{total}',html_entity_decode($orderamount),$message);
		$message = str_replace('{subtotal}',html_entity_decode($ordersubttotal),$message);
		
		//billing details formated
		$billingdetails = $this->wps_deals_email_billing_details( $data );
		
		//replace billing details
		$message = str_replace('{billing_details}', html_entity_decode( $billingdetails ), $message );
		
		$message = apply_filters('wps_deals_buyer_mail',$message,$data);
		$message = str_replace('{payment_gateway_description}',$cheque_details,$message);
		$message = nl2br($message);
		
		$html = '';
		$html .= '<html>
					<head>';
		$html = apply_filters( 'wps_deals_email_template_css_' . $email_template_option, $html );
		$html .= '</head>
					<body>';
		$html = apply_filters( 'wps_deals_email_template_' . $email_template_option, $html, $message, $orderid );
		$html .= '	</body>
				</html>';
		
		$html = apply_filters( 'wps_deals_buyer_email_html', $html, $message, $orderid );
		
		wp_mail( $to, $subject, $html, $headers );
		
	}
	/**
 	 * Send Email to Admin
 	 * 
 	 * Handles to sending email 
 	 * 
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
	public function wps_deals_seller_mail( $data = array() ) {
		
		//get the all options values from settings page
		global $wps_deals_options;
		
		//check seller notification is not disable
		if( empty( $wps_deals_options['disable_seller_notif'] ) ) {
		
			//product data
			$productdata = $data['order_details']['deals_details'];
			
			//payment method
			$payment_method = isset( $data['order_details']['admin_label'] ) ? $data['order_details']['admin_label'] : $data['order_details']['payment_method'];
			
			//user data
			$userdata = $data['user_data'];
			
			//order amount
			$orderamount = $data['order_details']['display_order_total'];
			
			//order subtotal
			$ordersubttotal = $data['order_details']['display_order_subtotal'];
			
			//get user email template value from settings page
			$message = $wps_deals_options['seller_email_body'];
			
			//order id 
			$orderid = $data['order_details']['order_id'];
			
			$purchase_date = get_the_time( get_option('date_format'), $orderid);
			
			$product_details = '';
			
			$to = $wps_deals_options['notif_email_address'];
			
			$first_name = $userdata['first_name'];
			$last_name = $userdata['last_name'];
			$user_name = $first_name.' '.$last_name;
			$user_email = $userdata['user_email'];
			
			//$subject = WPS_DEALS_SELLER_EMAIL_SUBJECT;
			$subject = $wps_deals_options['seller_email_subject'];
			
			$fromemail = !empty( $wps_deals_options['from_email'] ) ? $wps_deals_options['from_email'] : get_option('admin_email');
			
			$headers = 'From: '. $fromemail . "\r\n";
			$headers .= "Reply-To: ". $fromemail . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=utf-8\r\n";
			
			$i = 1;
			
			foreach ($productdata as $product) {
				
				$product_details .= "\n\n".$i.')'.get_the_title($product['deal_id']).' - '.$product['display_sale_price'].' x '.$product['deal_quantity'];
				$i++;
			}
			$message = str_replace('{username}',$user_name,$message);
			$message = str_replace('{email}',$user_email,$message);
			$message = str_replace('{product_details}',html_entity_decode($product_details),$message);
			$message = str_replace('{total}',html_entity_decode($orderamount),$message);
			$message = str_replace('{subtotal}',html_entity_decode($ordersubttotal),$message);
			$message = str_replace('{payment_method}',$payment_method,$message);
			$message = str_replace('{first_name}',$first_name,$message);
			$message = str_replace('{last_name}',$last_name,$message);
			$message = str_replace('{purchase_date}',$purchase_date,$message);
			$message = str_replace('{order_id}',$orderid,$message);
			
			//billing details formated
			$billingdetails = $this->wps_deals_email_billing_details( $data );
			//replace billing details
			$message = str_replace('{billing_details}', html_entity_decode( $billingdetails ), $message );
			
			$message = apply_filters('wps_deals_seller_mail',$message,$data);
			$message = nl2br($message); 
			
			wp_mail( $to, $subject, $message, $headers );
		
		} //end if disable seller notification
	}
	
	/**
 	 * Second to Time
 	 * 
 	 * Handles to return time from seconds of time
 	 * 
 	 * @package Social Deals Engine
 	 * @since 1.0.0
 	 */
	public function wps_deals_seconds_to_time($inputSeconds) {

	    $secondsInAMinute = 60;
	    $secondsInAnHour  = 60 * $secondsInAMinute;
	    $secondsInADay    = 24 * $secondsInAnHour;
	
	    // extract days
	    $days = floor($inputSeconds / $secondsInADay);
	
	    // extract hours
	    $hourSeconds = $inputSeconds % $secondsInADay;
	    $hours = floor($hourSeconds / $secondsInAnHour);
	
	    // extract minutes
	    $minuteSeconds = $hourSeconds % $secondsInAnHour;
	    $minutes = floor($minuteSeconds / $secondsInAMinute);
	
	    // extract the remaining seconds
	    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
	    $seconds = ceil($remainingSeconds);
	
	    if ($days < 10) { $days = '0'.$days; }
	    if ($minutes < 10) { $minutes = '0'.$minutes; }
	    if ($hours < 10) { $hours = '0'.$hours; }
	    if ($seconds < 10) { $seconds = '0'.$seconds; }
	    
	    $since = '';
	    $since .= $days <= 1 	? $days.__( ' day ','wpsdeals' ) 	: $days.__( ' days ','wpsdeals' );
	    $since .= $hours <= 1 	? $hours.__( ' hr ','wpsdeals' ) 	: $hours.__( ' hrs ','wpsdeals' );
	    $since .= $minutes <= 1 ? $minutes.__( ' min ','wpsdeals' )	: $minutes.__( ' mins ','wpsdeals' );
	    $since .= $seconds <= 1 ? $seconds.__( ' sec ','wpsdeals' ) 	: $seconds.__( ' secs ','wpsdeals' );
	    
	    // return the final array
	    /*$obj = array(
	        'd' => (int) $days,
	        'h' => (int) $hours,
	        'm' => (int) $minutes,
	        's' => (int) $seconds,
	    );*/
	    return $since;
	}
	
	/**
	 * Get Ordered Bundle Deals Meta
	 * 
	 * Handles to return ordered bundled deals
	 * data from meta
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_post_bundle_deals_ordered( $id ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$data = get_post_meta( $id, $prefix.'ordered_bundle_deals', true );
		return apply_filters( 'wps_deals_ordered_bundle_deals', $data );
	}
	
	/**
	 * Get Ordered Payment Meta
	 * 
	 * Handles to return ordered data from meta
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_post_meta_ordered($id) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$data = get_post_meta($id,$prefix.'order_details',true);
		return apply_filters('wps_deals_ordered_data',$data);
	}
	/**
	 * Get Ordered User Data
	 * 
	 * Handles to return ordered user data from meta
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_ordered_user_details($id) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$data = get_post_meta( $id, $prefix.'order_userdetails', true );
		
		return apply_filters('wps_deal_order_userdetails',$data);
	}
	/**
	 * Get Ordered IPN Data
	 * 
	 * Handles to return ordered IPN data from meta
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_ipn_data( $id ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$data = get_post_meta($id,$prefix.'order_ipn_data',true);
		return apply_filters('wps_deal_order_ipn_data',$data);
	}
	/**
	 * Get Ordered Payment Status
	 * 
	 * Handles to return ordered status from meta
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_ordered_payment_status( $id, $value = false ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$status = get_post_meta($id,$prefix.'payment_status',true);
		
		if( $value == true ) { //if want only status value
			$return = $status;	
		} else  { //if want status text
			$return = $this->wps_deals_paypal_value_to_status($status);	
		}
		
		return apply_filters('wps_deals_payment_status',$return );
	}
	/**
	 * Get Date Format
	 * 
	 * Handles to return formatted date which format is set in backend
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_date_format( $date, $time = false ) {
		
		$format = $time ? get_option( 'date_format' ).' '.get_option('time_format') : get_option('date_format');
		$date = date_i18n( $format, strtotime($date));
		return apply_filters('wps_deals_date_format',$date);
	}
	
	/**
	 * Complete Transaction
	 * 
	 * Handles to completed ordered when order total is zero
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_record_sales( $orderid ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//get already recorded sale or not
		$recordedsale = get_post_meta( $orderid, $prefix . 'recorded_sales', true );
		
		//check sales is already recorded or not
		if ( !empty( $recordedsale ) ) { return false; } //end if
		
		//order details
 		$orderdetails = $this->wps_deals_get_post_meta_ordered($orderid);
 		
 		//update data for deal bought + available & dimsale data
 		foreach ( $orderdetails['deals_details'] as $dealsold ) {
 			
 			//record sales data log
 			$this->wps_deals_record_sales_log( $dealsold['deal_id'], $orderid );
 			
 			//update value of bought copy of deal
 			$bought = get_post_meta( $dealsold['deal_id'], $prefix.'boughts', true);
 			update_post_meta( $dealsold['deal_id'], $prefix.'boughts', intval( $bought + $dealsold['deal_quantity'] ) );
 			
 			//update value of earning value
 			$earnings = get_post_meta( $dealsold['deal_id'], $prefix.'earnings', true);
 			$newearning = ( $earnings + ( $dealsold['deal_sale_price'] * $dealsold['deal_quantity'] ) );
 			update_post_meta( $dealsold['deal_id'], $prefix.'earnings', $newearning );
 			
 			//update value of available total copy of deal
 			$avail = get_post_meta( $dealsold['deal_id'], $prefix.'avail_total', true);
 			if ($avail > 0 || $avail != '') { //check available copy is not unlimitedand not equal to zero
 				update_post_meta( $dealsold['deal_id'], $prefix.'avail_total', intval( $avail - $dealsold['deal_quantity'] ) );	
 			}
 			
 			//increaseable price
 			$incprice = get_post_meta( $dealsold['deal_id'], $prefix.'inc_price', true);
 			
 			//increaseable ratio
 			$ratio = get_post_meta( $dealsold['deal_id'], $prefix.'inc_ratio', true);
 			
 			//if increseable price and increseable ration not empty
 			if( !empty( $incprice ) && !empty( $ratio ) ) {
 				
 				//when next price will increase
 				$lastless = get_post_meta( $dealsold['deal_id'], $prefix.'nxt_inc_period', true);
 				$saleqty = ( $lastless + $dealsold['deal_quantity'] );
				$incloop = intval( $saleqty / $ratio );
				$incless = ( $saleqty % $ratio );
				
 				if( $incloop > 0 ) { // check next loop is greater zero
 					
 					//do increment sale price as per dimsale
					for ( $i = 1; $i <= $incloop; $i++ ) {
						
						//sale price
 						$saleprice = $this->price->wps_deals_get_price( $dealsold['deal_id'] );
 						
 						//normal price
 						$normalprice = get_post_meta( $dealsold['deal_id'], $prefix.'normal_price', true);
 						
 						//increased price
 						$increprice = floatval( $saleprice + $incprice );
 						
 						//if sale price should be less or equal to normal price then only increase price
 						if( $increprice <= $normalprice ) {
 							
 							//update sale price
		 					update_post_meta( $dealsold['deal_id'], $prefix.'sale_price', $increprice );
		 					
 						} //end if to check incremental price should be less then normalprice
 						
					} //end for loop
					
 				} //end if incremental loop
 				
 				//update next increment period value
 				update_post_meta( $dealsold['deal_id'], $prefix.'nxt_inc_period', $incless );
 				
 			} //end if to check incremental price & ratio should not empty
 			
		} //end for each loop
		
		//update sales is recorded in database
		update_post_meta( $orderid, $prefix . 'recorded_sales', '1' );
	}
	
	/**
	 * Decrease Recorded Sales
	 * 
	 * Handles to decrease recorded sales
	 * 
	 * @package Social Deals Engine 
	 * @since 1.0.0
	 **/
	public function wps_deals_decrease_sales( $orderid ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//get already recorded sale or not
		$recordedsale = get_post_meta( $orderid, $prefix . 'recorded_sales', true );
		
		//check sales is already recorded or not
		if ( empty( $recordedsale ) ) { return false; } //end if
		
		//order details
 		$orderdetails = $this->wps_deals_get_post_meta_ordered($orderid);
 		
 		//update data for deal bought + available & dimsale data
 		foreach ( $orderdetails['deals_details'] as $dealsold ) {
 			
 			//update value of bought copy of deal
 			$bought = get_post_meta( $dealsold['deal_id'], $prefix.'boughts', true);
 			update_post_meta( $dealsold['deal_id'], $prefix.'boughts', intval( $bought - $dealsold['deal_quantity'] ) );
 			
 			//update value of earning value
 			$earnings = get_post_meta( $dealsold['deal_id'], $prefix.'earnings', true);
 			$newearning = ( $earnings - ( $dealsold['deal_sale_price'] * $dealsold['deal_quantity'] ) );
 			update_post_meta( $dealsold['deal_id'], $prefix.'earnings', $newearning );
 			
 			//update value of available total copy of deal
 			$avail = get_post_meta( $dealsold['deal_id'], $prefix.'avail_total', true);
 			if ( $avail != '' ) { //check available copy is not unlimitedand not equal to zero
 				update_post_meta( $dealsold['deal_id'], $prefix.'avail_total', intval( $avail + $dealsold['deal_quantity'] ) );	
 			}
 			
 		} //end foreach loop
 		
 		//delete post meta which is identify the sale is recorded
		delete_post_meta( $orderid, $prefix . 'recorded_sales' );
	}
	
	/**
	 * Get Download Links to Send
	 * 
	 * Handles to get download links which will send to user
	 * when user will pass $withlink = false then it will return 
	 * only file links not names and href
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_purchase_download_links( $purchasedata, $userdata, $orderid, $withlink = true ) {
		
		if(!empty($purchasedata)) { //check purchase data should not blank
			
			$files = $this->wps_deals_get_download_links($purchasedata,$userdata,$orderid);
			
			if($files != false) {
				
				$links = '';
				
				if( is_array( $files ) && $withlink == true ) { //check files are array and require with link then
					
					$download_file_cnt = 1; // counter used to display no of files
					
					foreach ( $files as $filekey => $file ) {
						
						//get the file name from its deal id and file key which will send to user
						$fname = $this->wps_deals_get_download_file_name( $purchasedata['deal_id'], $filekey );
						
						$links .= "\n".sprintf( __( 'Download File %d: ','wpsdeals' ), ( $download_file_cnt++ ) ).'<a href="'.$file.'">';
							$links .= $fname;
						$links .= '</a>';
					}
				} else {
					//return only links of file
					return $files;
				}
				
				return $links;
				
			} else {
				return $files;
			}
		}
	
	}
	/**
	 * Get Download Files Array
	 * 
	 * Handles to get download links which is uploaded to deal
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_download_files($dealid){
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$downloadfiles = get_post_meta( $dealid,$prefix.'upload_files',true );
		
		if(!empty($downloadfiles)) {
			
			$files = array();
			
			foreach( $downloadfiles as $key => $value ) {
				$files[ $key ] = $value;
			}
			
			return apply_filters( 'wps_deals_upload_files', $files );
		}
	}
	/**
	 * Get Download Files Array
	 * 
	 * Handles to get download links which is uploaded to deal
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_download_links($purchasedata,$userdata,$orderid){
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$downloadfiles = get_post_meta($purchasedata['deal_id'],$prefix.'upload_files',true);

		if(!empty($downloadfiles[0])) {
			
			$files = array();
			
			foreach( $downloadfiles as $key => $value ) {
				$files[ $key ] = $this->wps_deals_generate_download_file_url( $userdata['user_email'], $key, $purchasedata['deal_id'], $orderid );
			}
			
		} else {
			$files = false;
		}
		return apply_filters( 'wps_deals_get_download_links', $files, $purchasedata['deal_id'], $orderid );
	}
	
	/**
	 * Generate Download file url
	 * 
	 * Handles to generate download file url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_generate_download_file_url( $email, $filekey, $dealid,$orderid) {
	
		global $wps_deals_options;
	
		//if link expiration is not set or empty then it will be life time downloadable link will generated
		$date = '';
		
		//check link expiration is empty or not
		if( isset( $wps_deals_options['link_expiration'] ) && !empty( $wps_deals_options['link_expiration'] ) 
			&& is_numeric( $wps_deals_options['link_expiration'] ) ){
				
			$hours = absint($wps_deals_options['link_expiration']);
			$date = strtotime( '+' . $hours . 'hours' );
		}
		
		/*if( ! ( $date = strtotime( '+' . $hours . 'hours' ) ) )
			$date = 2147472000; // Highest possible date, January 19, 2038*/
		
		$params = array(
			'order_key' 	=> base64_encode($orderid),
			'email' 		=> rawurlencode( $email ),
			'file' 			=> $filekey,
			'deal_id' 		=> $dealid,
		);
		
		if( !empty( $date ) ) { //check date is empty or not
			$params['expire'] = rawurlencode( base64_encode( $date ) );
		}
		
		$params = apply_filters( 'wps_deals_download_file_url_args', $params, $dealid, $orderid );
	
		$download_url = add_query_arg( $params, home_url() );
	
		return $download_url;
	}
	
	/**
	 * Verify download link
	 * 
	 * Handles to verify download url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_verify_download_link( $dealid, $email, $expire, $file_key, $orderid ) {//$download, 
	
		$prefix = WPS_DEALS_META_PREFIX;
		
		$queryargs = array(	
							'p'					=>	$orderid,
 							'post_type'			=>	WPS_DEALS_SALES_POST_TYPE,
 							'meta_query'		=>	array( array( 'key' => $prefix.'payment_user_email', 'value' => $email ) )
						 );
						 
		$salesdata = $this->wps_deals_get_sales( $queryargs );
		
		if( $salesdata ) { //check order is stored or not
			
			foreach ( $salesdata as $order ) {
			
				$paymentstatus = $this->wps_deals_get_ordered_payment_status( $order['ID'], true );
			
				if( $paymentstatus != '1' ) {
					return false;
				}
					
				$dealsdata = $this->wps_deals_get_post_meta_ordered($order['ID']);
				$dealsdata = $dealsdata['deals_details'];
				
				if( $dealsdata ) {
					
					foreach ( $dealsdata as $key => $deal ) {
						
						$id			= isset( $deal ) ? $deal['deal_id'] : $dealsdata;
						//$dealtype	= $this->wps_deals_get_deal_type( $dealid );
						$dealtype	= $this->wps_deals_get_deal_type( $id );
						$dealbundle	= $this->wps_deals_get_bundled_deals_list( $id );
						
						if( $dealtype == 'bundle' ) {
							
							if( !in_array( $dealid, $dealbundle ) ) {
								continue;
							}
							
							$id = $dealid;
						} else if ( $id != $dealid  ) {
							
							continue;
						}
						
						// Check to see if the file download limit has been reached
						if ( $this->wps_deals_is_file_at_download_limit( $id, $order['ID'], $file_key ) )
							wp_die( apply_filters( 'wps_deals_download_limit_reached_text', __( '<strong>ERROR : </strong>Sorry but you have hit your download limit for this file.', 'wpsdeals' ) ), __( 'Download Error', 'wpsdeals' ) );
				
						// Make sure the link hasn't expired
						//check product type is simple then only it will be downloaded
						if ( time() < $expire || ( !isset( $expire ) || empty( $expire ) ) && ( $dealtype == 'simple' || $dealtype == 'bundle' ) ) { //check link is expired or not if empty expire then allow download life time
							return $order['ID'];
						}
						return false;
					}
				}
			}
			//return false;
			 
		} 
		//if order data not exist then return false
		return false;
	}
	
	/**
	 * Checks if a file is at its download limit
	 *
	 * This limit refers to the maximum number of times files connected to a product
	 * can be downloaded.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_is_file_at_download_limit( $deal_id = 0, $order_id = 0, $file_id = 0 ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$meta_query = array(
			'relation'	=> 'AND',
			array(
				'key' 	=> $prefix . 'log_file_id',
				'value' => (int) $file_id
			),
			array(
				'key' 	=> $prefix . 'log_payment_id',
				'value' => (int) $order_id
			)
		);
	
		$ret = false;
		$download_count = $this->logs->get_log_count( $deal_id, 'downloads', $meta_query );
		$download_limit = $this->wps_deals_get_file_download_limit( $deal_id );
		
		if ( ! empty( $download_limit ) ) {
			
			if ( $download_count >= $download_limit ) {
				$ret = true;
	
				// Check to make sure the limit isn't overwritten
				// A limit is overwritten when purchase receipt is resent
				$limit_override = $this->wps_deals_get_file_download_limit_override( $deal_id, $order_id );
	
				if ( ! empty( $limit_override ) && $download_count < $limit_override ) {
					$ret = false;
				}
			}
		}
		
		return (bool) apply_filters( 'wps_deals_is_file_at_download_limit', $ret, $deal_id, $order_id, $file_id );
	}
		
	/**
	 * Gets the file download file limit for a particular download
	 *
	 * This limit refers to the maximum number of times files connected to a product
	 * can be downloaded.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_get_file_download_limit( $deal_id = 0 ) {
		
		global $wps_deals_options;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//get download limit from metabox
		$limit = get_post_meta( $deal_id, $prefix.'download_limit', true );
		
		//if limit is not set in metabox then take it from settings
		$limit = isset( $limit ) && !empty( $limit ) ? $limit : $wps_deals_options['file_download_limit'];
		
		if ( $limit )
			return absint( $limit );
		return 0;
	}
	
	/**
	 * Gets the file download file limit override for a particular download
	 *
	 * The override allows the main file download limit to be bypassed
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	*/
	function wps_deals_get_file_download_limit_override( $deal_id = 0, $order_id = 0 ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$limit_override = get_post_meta( $deal_id, $prefix.'download_limit_override_' . $order_id, true );
		if ( $limit_override ) {
			return absint( $limit_override );
		}
		return 0;
	}
	
	/**
	 * Sets the file download file limit override for a particular download
	 *
	 * The override allows the main file download limit to be bypassed
	 * If no override is set yet, the override is set to the main limmit + 1
	 * If the override is already set, then it is simply incremented by 1
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_set_file_download_limit_override( $deal_id = 0, $order_id = 0 ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$override 	= $this->wps_deals_get_file_download_limit_override( $deal_id );
		$limit 		= $this->wps_deals_get_file_download_limit( $deal_id );
	
		if ( ! empty( $override ) ) {
			$override = $override += 1;
		} else {
			$override = $limit += 1;
		}
		update_post_meta( $download_id, $prefix.'download_limit_override_' . $order_id, $override );
	}
	
	/**
	 * Get File Name of deal
	 * 
	 * Handles to return file name from 
	 * file key and deal id
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_download_file_name( $dealid, $filekey ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$getfiles = $this->wps_deals_get_download_files( $dealid );
		$getnames = get_post_meta( $dealid, $prefix.'upload_files_name', true );
		
		$filename = '';
		
		if( is_array( $getnames ) ) { //check names of files is array or not
			
			if( isset( $getnames[$filekey] ) && !empty( $getnames[$filekey] ) ) {
				$filename = $getnames[$filekey];
			} else {
				if( isset( $getfiles[$filekey] ) ) {
					$splitname = pathinfo( $getfiles[$filekey] );
					$filename = $splitname['filename'];
				}				
			}
			
		}
		return apply_filters( 'wps_deals_file_name', $filename, $dealid, $filekey );
		
	}
	/**
	 * Get Ordered files list
	 * 
	 * Handles to get files list for 
	 * order id
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_ordered_file_list( $orderid ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//update ordered files to metabox
		$files = get_post_meta( $orderid,$prefix.'ordered_files', true );
		return apply_filters('wps_deals_ordered_files', $files );
	}
	/**
	 * Get Ordered deals bundle list
	 * 
	 * Handles to get deals bundle list for 
	 * order id
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_bundled_deals_list( $dealid ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//update bundled deals to metabox
		$deals = get_post_meta( $dealid, $prefix.'bundle_deals', true );
		return apply_filters('wps_deals_bundled_deals', $deals );
	}
	
	/**
	 * Get Ordered deals bundle list
	 * 
	 * Handles to get deals bundle list for 
	 * order id on cart detail page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_bundled_deals_cart( $dealid ) {
		
		$deal_type		= $this->wps_deals_get_deal_type( $dealid );
		$bundle_deals	= $this->wps_deals_get_bundled_deals_list( $dealid );
		
		$bundle_html = '';
		
		if( $deal_type == 'bundle' && !empty( $bundle_deals ) ) {
			
			$bundle_html = '<ul>';
			
			foreach ( $bundle_deals as $bundle_deal ) {
				
				if( !empty($bundle_deal) ) {
					
					$dealname = get_the_title( $bundle_deal );
					$bundle_html .= '<li><a href="'.get_permalink($bundle_deal).'" title="'.$dealname.'">'.$dealname.'</a></li>';
				}
			}
			
			$bundle_html .= '</ul>';
		}
		return apply_filters( 'wps_deals_get_bundled_deals_cart', $bundle_html );
	}
	
	/**
	 * Sales Count & Earning for individual post
	 * 
	 * Handles to get sales count 
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_post_sale_count_earning($postid) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$salescount = get_post_meta($postid,$prefix.'boughts',true);
		$salescount = $salescount > 0 ? $salescount : 0;
		$earning = get_post_meta($postid,$prefix.'earnings',true);
		$earning = $earning > 0 ? $earning : 0;
		$result = array( 'salescount' => $salescount, 'earnings' =>	$earning );
		return $result;
		
	}
	/**
	 * Sales Count & Earning for dashboard
	 * 
	 * Handles to get sales count & total earning
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_dashboard_sale_count_earning() {
		
		$prefix = WPS_DEALS_META_PREFIX;
		//meta query for payment status
		$payment_statusargs = array( array( 'key' => $prefix . 'payment_status', 'value' => '1' ) );
		
		$salescount = $this->wps_deals_get_sales( array( 'meta_query' => $payment_statusargs, 'getcount' => '1'	) );
		$salesdata 	= $this->wps_deals_get_sales( array( 'meta_query' => $payment_statusargs ) );
		
		$earning = 0;
		if(!empty($salesdata)) {
			
			foreach ($salesdata as $sale) {
				
				//get orderdetails
				$orderdetails = $this->wps_deals_get_post_meta_ordered($sale['ID']);
				$earning = $earning + $orderdetails['order_total'];
				
			}
		}
		$result = array( 'salescount' => $salescount, 'earnings' =>	$earning );
		return $result;
	}
	/**
	 * Sales count and Earning by date
	 * 
	 * Handles to get sales count & total earning by date
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_sale_count_earning_by_date( $day='', $month, $year='', $hour='' ){
		
		$prefix = WPS_DEALS_META_PREFIX;
		//meta query for payment status
		$payment_statusargs = array( array( 'key' => $prefix . 'payment_status', 'value' => '1' ) );
		
		$args = $argscount = array(	
									'year'				=>	$year,
									'monthnum'			=>	$month,
									'meta_query'		=>	$payment_statusargs
								 );
		
		if ( !empty( $day ) ) {
			$args['day'] = $day;
			$argscount['day'] = $day;
		}
	
		if ( !empty( $hour ) ) {
			$args['hour'] = $hour;
			$argscount['hour'] = $hour;
		}

		//get the data from sales
		$argscount['getcount'] = '1';
		$salescount	= $this->wps_deals_get_sales( $argscount );
		$salesdata 	= $this->wps_deals_get_sales( $args );
		
		$earnings = 0;
		
		if ( !empty($salesdata) ) { //check sales data
			
			foreach ($salesdata as $sale) {
			
				//get orderdetails
				$orderdetails = $this->wps_deals_get_post_meta_ordered($sale['ID']);
				$earnings = $earnings + $orderdetails['order_total'];
				
			}
		}
	
		$result = array( 'salescount' => $salescount, 'earnings' =>	$earnings );
		return $result;
	}
	/**
	 * Recent Dashboard Purchases
	 * 
	 * Handles to get recent purchases made for dashboard widget
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_recent_purchases() {
		
		$prefix = WPS_DEALS_META_PREFIX;
		//meta query for payment status
		$payment_statusargs = array( array( 'key' => $prefix . 'payment_status', 'value' => '1' ) );
		
		$args = array(
						'posts_per_page'	=>	'5',
						'meta_query'		=>	$payment_statusargs
					);
		$salesdata = $this->wps_deals_get_sales( $args );			
		
		$recentdata = array();
		
		foreach ($salesdata as $sale) {
			
			//recent order details
			$orderdetail = $this->wps_deals_get_post_meta_ordered($sale['ID']);
			
			//userdetails
			$userdetail = $this->wps_deals_get_ordered_user_details($sale['ID']);
			
			// get the value for the payment status from the post meta box
			$payment_status = $this->wps_deals_get_ordered_payment_status($sale['ID']);
			
			//ipn data
			$ipndata = $this->wps_deals_get_ipn_data( $sale['ID'] );
			$recentdata[$sale['ID']] = array_merge($sale,$orderdetail);
			$recentdata[$sale['ID']]['userdetails'] = $userdetail;
			$recentdata[$sale['ID']]['ipndata'] = $ipndata;
			$recentdata[$sale['ID']]['payment_status'] = $payment_status;
		}
		return $recentdata;
	}
	/**
	 * Sales Count & Earning for individual post
	 * 
	 * Handles to get sales count 
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_monthly_sales_earning($postid) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		//meta query for payment status
		$payment_statusargs = array( array( 'key' => $prefix . 'payment_status', 'value' => '1' ) );
		
		$salesdata = $this->wps_deals_get_sales( array(	'meta_query' => $payment_statusargs	) );
		$salescount = 0;
		$earning = 0;
		
		if(!empty($salesdata)) {
			foreach ($salesdata as $sale) {
				
				//get orderdetails
				$orderdetails = $this->wps_deals_get_post_meta_ordered($sale['ID']);
				
				foreach ($orderdetails['deals_details'] as $ordered) {
					
					if($ordered['deal_id'] == $postid) { //check currenct post is equal to loop id
						
						$salescount = $salescount + $ordered['deal_quantity'];
						$earning = $earning + ($ordered['deal_sale_price'] * $ordered['deal_quantity']);
							
					} else {
						continue;
					}
				}
			}
				
			$release_date 	= get_post_field( 'post_date', $postid );

			$diff 	= abs( time() - strtotime( $release_date ) );
		
			$years 	= floor( $diff / ( 365*60*60*24 ) );							// number of years since publication
			$months = floor( ( $diff - $years * 365*60*60*24 ) / ( 30*60*60*24 ) ); // number of months since publication
			
			if ( $months > 0 )
				$salescount = ( $salescount / $months );
			
			if ( $months > 0 )
				$earning = ( $earning / $months );
			
		}
		$result = array( 'salescount' => $salescount, 'earnings' =>	$earning );
		return $result;
	}
	/**
	 * Get Deal Customer Data
	 * 
	 * Handles get all customer deals data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_customers() {
		
		global $wpdb;

		$prefix = WPS_DEALS_META_PREFIX;
		
		$reports_customers = array();
		$customers    = $wpdb->get_col( "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE 1 = 1
										AND meta_key = '{$prefix}payment_user_email'");
		
		foreach ( $customers as $key => $customer ) {
		
			//meta query for payment status / user email
			$meta_query = array(
									array( 'key' => $prefix . 'payment_user_email', 'value' => $customer ), 
									array( 'key' => $prefix . 'payment_status', 'value' => '1' ) 
								);
			
			$salescount = $this->wps_deals_get_sales( array( 'meta_query' => $meta_query, 'getcount' => '1' ) );
			
			if($salescount > 0) { //check if user has purchase product successfully then return his email
				$reports_customers[$key] = $customer;
			} 
		}
		
		return $reports_customers;
	}
	/**
	 * Get Deal Total purchase of users
	 * 
	 * Handles get total purchase of users deals data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_purchase_total_of_user( $customer_email ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//meta query for payment status / user email
		$meta_query = array( 	
								array( 'key' => $prefix . 'payment_user_email', 'value' => $customer_email ), 
								array( 'key' => $prefix . 'payment_status', 'value' => '1' ) 
							);
		
		$salesdata 	= $this->wps_deals_get_sales( array( 'meta_query' => $meta_query ) );
		$salescount = $this->wps_deals_get_sales( array( 'meta_query' => $meta_query,'getcount' => '1') );
		$earning = 0;
		
		if(!empty($salesdata)) {
			foreach ($salesdata as $sales) {
				$orderdetails = $this->wps_deals_get_post_meta_ordered($sales['ID']);
				
				//foreach ($orderdetails['deals_details'] as $ordered) {
					$earning = $earning + $orderdetails['order_total'];
				//}
			}
		}
		$result = array( 'salescount' => $salescount, 'earnings' =>	$earning );
		return $result;
	}
	/**
	 * Return Month Name
	 * 
	 * Handles to return month name from number
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_month_num_to_name( $n ) {
		$timestamp = mktime( 0, 0, 0, $n, 1, 2005 );
	
		return date_i18n( "M", $timestamp );
	}
	
	/**
	 * Form Action
	 *
	 * Gets the form action from the added autoresponder form.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */		
	public function get_form_action( $form_code ) {
	
		$field = array();
		$arrayForm = array();
		$formcode = stripslashes( $form_code );
		$pattern = '/<form(.*?)>/s';
		preg_match_all( $pattern, $formcode, $matchesArray );
		if ( count( $matchesArray[0] ) > 0 ) {
			$actionarray = $this->get_match_data( $matchesArray[0][0], 'action' );
			$arrayForm['action'] = $actionarray[1][0];
			$methodarray = $this->get_match_data( $matchesArray[0][0], 'method' );
			$arrayForm['method'] = strtolower( $methodarray[1][0] );
		}
		return $arrayForm;
	}
	
	/**
	 * Hiden Fields
	 *
	 * Gets all the hidden fields from the entered form code.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	public function get_form_field( $form ) {

		 $hiddenElements = array();
	     $doc = new DOMDocument();
	     @$doc->loadHTML( $form );
	     
	     $xpath = new DOMXPath( $doc );
	  
	     // use xPATH for quering the hidden elements in a form passes as string $form  
	     $qry="//input[@type='hidden']";
	     $xData=$xpath->query( $qry );
	  
	     // loop throught all the data  
	     foreach( $xData as $value ) {  
	         // typecast the name and values as string to avoid xml object  
	         $eleName = (string) $value->getAttribute( 'name' );
	         $eleValue = (string) $value->getAttribute( 'value' );
	         $hiddenElements[$eleName] = $eleValue;
	     }
	     
	     $returnStr = array();
	     foreach( $hiddenElements as $key => $val ) {	     	
			$returnStr[$key] = $val;
		 } 
		 
     	return $returnStr;
	}
	/**
	 * Get Match Data
	 *
	 * Gets the correct values for the form action.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	public function get_match_data( $string, $value ) {
	
		$pattern = '/' . $value . '="(.*?)"/s';
		$pattern2 = '/' . $value . '=(.*?) /s';
		$pattern3 = '/' . $value . '=(.*?)>/s';
		$pattern4 = "/$value='(.*?)'/s";
		preg_match_all( $pattern, $string, $matcharray );
		if ( is_array( $matcharray ) && $matcharray[1][0] == "" ) {
			preg_match_all( $pattern2, $string, $matcharray );
		}
		if ( is_array( $matcharray ) && $matcharray[1][0] == "" ) {
			preg_match_all( $pattern3, $string, $matcharray );
		}
		if ( is_array( $matcharray ) && $matcharray[1][0] == "" ) {
			preg_match_all( $pattern4, $string, $matcharray );
		}
		return $matcharray;
	}
	/**
	 * Get Optin Form URL
	 * 
	 * Handles to return optin form redirect url
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function get_optin_url($useremail,$firstname,$allow_to_autorespon_user){
		
		global $wps_deals_options;
		
		$result = false;
		
		if( !empty( $wps_deals_options['optin_form'] ) ) {
				
			if( ( isset( $wps_deals_options['optin_form_front'] ) && !empty( $wps_deals_options['optin_form_front'] ) && !empty($allow_to_autorespon_user ) ) || ( !isset( $wps_deals_options['optin_form_front'] ) && empty( $wps_deals_options['optin_form_front'] ) ) && !empty( $useremail ) ) {
		
				$namefield = '';
				$queryargs = array();
				$formdata = $this->get_form_action( $wps_deals_options['auto_form'] );	
				
				if( isset( $formdata['action'] ) ) {
					$emailfield = $wps_deals_options['form_email_field'];
						
					if( !empty( $emailfield ) ) {
						$queryargs[$emailfield] = $useremail;
					} else {
						$queryargs[$emailfield] = 'email';
					}
						
					if( empty( $wps_deals_options['form_disabled_name'] ) ) {
						$namefield = $wps_deals_options['form_name_field'];
						$queryargs[$namefield] = $firstname;
					} 
					
					$auto_form_url  = '';
					$field_count = isset( $wps_deals_options['auto_form_field_count'] ) ? $wps_deals_options['auto_form_field_count'] : '';
					$auto_form_fields = $this->get_form_field( $wps_deals_options['auto_form'] );
					$queryargs = array_merge($queryargs,$auto_form_fields);
					$result = add_query_arg(array($queryargs),$formdata['action']);
								
				}
			}
		}// end code for autoresponder
		
		return $result;
	}
	/**
	 * Record Sales Log
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_record_sales_log( $deal_id, $order_id ) {
		
		$log_data = array(
			'post_parent' 	=> $deal_id,
			'log_type'		=> 'sales'
		);
	
		$log_meta = array(
			'payment_id'    => $order_id
		);
	
		$log_id = $this->logs->insert_logs( $log_data, $log_meta );
	}
	/**
	 * Delete log entries when deleting download product
	 *
	 * Removes all related log entries when a download is completely deleted.
	 *
	 * Does not run when a download is trashed
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_remove_logs_on_delete( $deal_id = 0 ) {
		
		if ( WPS_DEALS_POST_TYPE != get_post_type( $deal_id ) )
			return;
	
		// Remove all log entries related to this download
		$this->logs->delete_logs( $deal_id );
	}
	/**
	 * Send E-mail to user after editing the order
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_send_order_status_email($args = array()) {
		
		global $wps_deals_options;
		
		$date = get_the_time(get_option( 'date_format'), $args['order_id']);
		$orderdate = $this->wps_deals_get_date_format($date);
		
		$subject = isset($wps_deals_options['update_order_email_subject']) ? $wps_deals_options['update_order_email_subject'] : '';
		
		$message = isset($wps_deals_options['update_order_email']) ? $wps_deals_options['update_order_email'] : '';
		
		$message = str_replace( '{order_id}', $args['order_id'], $message );
		$message = str_replace( '{order_date}', $orderdate, $message );
		$message = str_replace( '{status}', $args['status'], $message );
		
		if(isset($args['appendcomment']) && !empty($args['appendcomment'])) {
			$message .= "\n\n".__( 'The comments for your order are','wpsdeals' )."\n\n".$args['comments']."\n\n";
		}
		
		$fromemail = !empty( $wps_deals_options['from_email'] ) ? $wps_deals_options['from_email'] : get_option('admin_email');
		
		$message = str_replace( '{status}', $args['status'], $message );
		$headers = 'From: ' . $fromemail . "\r\n";
		$headers .= "Reply-To: ". $fromemail . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";

		$message = nl2br($message);
		
		wp_mail($args['email'],$subject,$message,$headers);
	}
	
	/**
	 * Send Email to Admin
	 * 
	 * Handles to send email to admin when order
	 * status is updated
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_send_order_status_email_admin( $args = array() ) {
		
		global $wps_deals_options;
		
		$adminemail = isset( $wps_deals_options['notif_email_address'] ) && !empty( $wps_deals_options['notif_email_address'] ) 
						?	$wps_deals_options['notif_email_address'] : get_option( 'admin_email' );
		
		$fromemail = !empty( $wps_deals_options['from_email'] ) ? $wps_deals_options['from_email'] : get_option('admin_email');
						
		$headers = 'From: ' . $fromemail . "\r\n";
		$headers .= "Reply-To: ". $fromemail . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";

		$html = '';
		$html .= '<html><head>';
		$html .= '<style type="text/css">
						.wps-deals-purchase-child{ 
							background-color:#fff;
							margin:0 auto; 
							padding:15px;
						}
						.wps-deals-purchase-parent{ 
							border:1px solid #464646;
							background-color:#E6E6E6;
							width:60%;
							margin:0 auto; 
							padding:10px;
						}	';
		$html .= '</style></head>';
		$html .= '<body>';
		$html .= '<div class="wps-deals-purchase-parent"><div class="wps-deals-purchase-child">';
		$html .= nl2br($args['message']);
		$html .= '</div></div>';
		$html .= '</body></html>';
		
		wp_mail( $adminemail, $args['subject'],$html , $headers );
		
	}
	
	/**
	 * Return Social Sharing Buttons
	 * 
	 * Handles to return selected social sharing buttons
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_social_sharing_buttons() {
		
		//show social buttons
		
		global $wps_deals_options,$post;
		$twitter_user = isset($wps_deals_options['tw_user_name']) ? $wps_deals_options['tw_user_name'] : '';
		
		$html = '';
		$html .= '	<div class="wps-deals-connect row-fluid">';
		
		$html .= apply_filters('wps_deals_sharing_discount_buttons_before', '');
		
		//facebook button
		if( isset( $wps_deals_options['social_buttons'] ) && in_array('facebook',$wps_deals_options['social_buttons']))  {
			
			$html .= '	<div id="fb-root"></div>
							<div class="wps-deals-connect-buttons">';
			$html .= '			<div class="fb-like" id="wpsdealsfblikebutton_'.$post->ID.'" href="'.get_permalink().'" data-send="false" data-layout="button_count" data-width="100%" data-show-faces="false" data-font="arial">
								</div>';
			$html .= '		</div>';
		}
		
		//twitter button
		if( isset( $wps_deals_options['social_buttons'] ) && in_array('twitter',$wps_deals_options['social_buttons']) && !empty( $twitter_user )) {
			
			$html .= '	<div class="wps-deals-connect-buttons twitter">';
			$html .= '  	<div data-id="wpsdealstwbutton_'.$post->ID.'">
								<a href="http://twitter.com/share"  data-url="' . get_permalink() . '"  class="twitter-share-button" data-text="' . get_the_title($post->ID) . '" data-count="horizontal" data-via="' . $twitter_user . '">' . __( 'Tweet', 'wpsdeals' ) . '</a>
							</div>';
			$html .= '	</div>';
		}
		
		//google plus button
		if( isset( $wps_deals_options['social_buttons'] ) && in_array('google',$wps_deals_options['social_buttons'])) {	
					
			$html .= '	<div class="wps-deals-connect-buttons">';
			$html .= '<div class="wps-deals-gp-button">';
			$html .= '	<g:plusone href="' . get_permalink() . '" size="medium" annotation="bubble" callback="wps_deals_gp_' . $post->ID . '"></g:plusone></div>
								<script type="text/javascript">
									function wps_deals_gp_' . $post->ID . '(res){
										if(res.state == "on") {	
											var data = { 
															postid	: ' . $post->ID . ',
															action	: "deals_update_social_media_values",
															type	: "gp"
														};
									
											jQuery.post("'.admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ).'", data, function(response) {
												if(response != "") {
													window.location.reload();
												}
											});
										}
									}
								</script>';
			$html .= '</div>';
		}
		
		$html .= apply_filters('wps_deals_sharing_discount_buttons_after', '');
		
		$html .= ' </div>';
		
		return $html;
	}
	
	/**
	 * Check User is Verified or not
	 * 
	 * Handles to return user has purchased deal or not
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_verified_owner( $useremail, $dealid ) { //$userid,

		$prefix = WPS_DEALS_META_PREFIX;
		
		//meta query for payment status / user email
		$meta_query = array( 	
								array( 'key' => $prefix . 'payment_user_email', 'value' => $useremail ), 
								array( 'key' => $prefix . 'payment_status', 'value' => '1' ) 
							);
		
		$args = array( 'meta_query' => $meta_query ); //,
		
		$verifiedsales = $this->wps_deals_get_sales( $args );
		
		$return = false;

		if ( ! is_array( $dealid ) ) {
			$dealids = array( $dealid );
		}

		if ( !empty($verifiedsales) ) { //check sales data should not empty
			
			foreach ( $verifiedsales as $sale ) {

				$purchased = $this->wps_deals_get_post_meta_ordered( $sale['ID'] );
				
				if ( is_array( $purchased['deals_details'] ) ) { //check order data is array
					
					foreach ( $purchased['deals_details'] as $deal ) {
						
						if ( in_array( $deal['deal_id'], $dealids ) ) { //check user is purchased deal or not
							$return = true;
						}
					}
				}
			}
		}
		return $return;
	}
	
	/**
	 * Refund Procedure
	 * 
	 * Handles to do refund process for 
	 * paypal payment
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_refund_process( $orderid ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$orderdata = $this->wps_deals_get_post_meta_ordered( $orderid );
		
		$valstatus = $this->wps_deals_get_ordered_payment_status( $orderid, true );
		
		//if payment method should not be paypal & payment status is not completed then return
		if( ( $orderdata['payment_method'] != __( 'PayPal Standard','wpsdeals') && $orderdata['payment_method'] != 'paypal' ) && $valstatus != '1' ) return;
		
		$ipndata = $this->wps_deals_get_ipn_data( $orderid );
		
		if( isset( $ipndata['txn_id'] ) && !empty( $ipndata['txn_id'] ) ) { //if transaction id is set in database
		
			$transaction_id = urlencode( $ipndata['txn_id'] );
			$refundtype 	= urlencode( 'FULL' );
			$amount			= urlencode( $orderdata['order_total'] );
			$currency 		= urlencode( $orderdata['currency'] );
			
			$refundurl = '&TRANSACTIONID='.$transaction_id;
			$refundurl .= '&REFUNDTYPE='.$refundtype;
			$refundurl .= '&CURRENCYCODE='.$currency;
			$refundurl .= '&NOTE=';
			
			if( strtoupper( $refundtype ) == "PARTIAL") $refundurl = $refundurl.'&AMT='.$amount;
		
			$refundresult = $this->wps_deals_curl_refund_hash_call( 'RefundTransaction', $refundurl );
			
			if( !isset( $refundresult['error_no'] ) 
				&& isset( $refundresult['response']['REFUNDTRANSACTIONID'] ) && !empty( $refundresult['response']['REFUNDTRANSACTIONID'] ) ) {
				
				// update refund result to database
				update_post_meta( $orderid, $prefix.'refund_data', $refundresult );
				return true;
				
			} else {
				
				//refund fail
				return false;
			}

		}
		
	}
	
	/**
	 * CURL Call for 
	 * 
	 * Handles to call curl for refund procedure
	 * in paypal refund process
	 * 
	 * @package Social Deals Engine 
	 * @since 1.0.0
	 * 
	 */
	function wps_deals_curl_refund_hash_call( $methodName, $resstr ) {
		
		// form header string
		$refheader = $this->wps_deals_refund_header_string();
		
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, WPS_DEALS_PAYPAL_REFUND_URL);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
			
		$resstr = $refheader.$resstr;
		
	    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
	   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		/*if(USE_PROXY)
			curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT); */
	
		//check if version is included in $resstr else include the version.
		if( strlen( str_replace( 'VERSION=', '', strtoupper( $resstr ) ) ) == strlen( $resstr ) ) {
			
			$resstr = "&VERSION=" . urlencode( WPS_DEALS_PAYPAL_REFUND_VERSION ) . $resstr;	
			
		}
		
		$refundreq = "METHOD=".urlencode( $methodName ).$resstr;
		
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $refundreq );
	
		//getting response from server
		$response = curl_exec($ch);
		
		//convrting NVPResponse to an Associative Array
		$refresarray = $this->wps_deals_deformat_curl( $response );
		$refreqarray = $this->wps_deals_deformat_curl( $refundreq );
		
		$result = array( 'response' => $refresarray );
		
		if ( curl_errno( $ch ) ) {
			
			// moving to display page to display curl errors
			$result['error_no'] = curl_errno($ch) ;
			$result['error_msg'] = curl_error($ch);
				
		 } else {
			 //closing the curl
			curl_close($ch);
			
		 }	
		return $result;
	}
	
	/**
	 * Deformat CURL Response
	 * 
	 * Handles to deformating CURL response
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_deformat_curl( $resstr ) {
		
		$intial=0;
	 	$nvpArray = array();
	
	
		while(strlen($resstr)){
			
			//postion of Key
			$keypos= strpos($resstr,'=');
			
			//position of value
			$valuepos = strpos( $resstr,'&' ) ? strpos( $resstr,'&' ): strlen($resstr);
	
			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval = substr($resstr,$intial,$keypos);
			$valval = substr($resstr,$keypos+1,$valuepos-$keypos-1);
			
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$resstr = substr($resstr,$valuepos+1,strlen($resstr));
	     }
		return $nvpArray;
	}
	
	/**
	 * Get Header String for header
	 * 
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	function wps_deals_refund_header_string() {
		
		$refundheaderstr = '';
		
		/*if(defined('AUTH_MODE')) {
			//$AuthMode = "3TOKEN"; //Merchant's API 3-TOKEN Credential is required to make API Call.
			//$AuthMode = "FIRSTPARTY"; //Only merchant Email is required to make EC Calls.
			//$AuthMode = "THIRDPARTY";Partner's API Credential and Merchant Email as Subject are required.
			$AuthMode = "AUTH_MODE"; 
		} 
		else {
			
			if( WPS_DEALS_PAYPAL_API_USERNAME != '' && WPS_DEALS_PAYPAL_API_PASSWORD != '' && WPS_DEALS_PAYPAL_API_SIGNATURE != '' && (!empty($subject))) {
				$AuthMode = "THIRDPARTY";
			}
			
			else if((!empty( WPS_DEALS_PAYPAL_API_USERNAME )) && (!empty( WPS_DEALS_PAYPAL_API_PASSWORD )) && (!empty(WPS_DEALS_PAYPAL_API_SIGNATURE))) {
				$AuthMode = "3TOKEN";
			}
			
			elseif (!empty($AUTH_token) && !empty($AUTH_signature) && !empty($AUTH_timestamp)) {
				$AuthMode = "PERMISSION";
			}
		    elseif(!empty($subject)) {
				$AuthMode = "FIRSTPARTY";
			}
		}*/
		switch( '3TOKEN' ) {
			
			case "3TOKEN" : 
					//this is using for refund in plugin
					$refundheaderstr = "&PWD=".urlencode( WPS_DEALS_PAYPAL_API_PASSWORD )."&USER=".urlencode( WPS_DEALS_PAYPAL_API_USERNAME )."&SIGNATURE=".urlencode( WPS_DEALS_PAYPAL_API_SIGNATURE );
					break;
			/*case "FIRSTPARTY" :
					$refundheaderstr = "&SUBJECT=".urlencode( '' );
					break;
			case "THIRDPARTY" :
					$refundheaderstr = "&PWD=".urlencode( WPS_DEALS_PAYPAL_API_PASSWORD )."&USER=".urlencode( WPS_DEALS_PAYPAL_API_USERNAME )."&SIGNATURE=".urlencode( WPS_DEALS_PAYPAL_API_SIGNATURE )."&SUBJECT=".urlencode( '' );
					break;		
			case "PERMISSION" :
				    $refundheaderstr = formAutorization($AUTH_token,$AUTH_signature,$AUTH_timestamp);
				    break;*/
		}
			return $refundheaderstr;
	}
	
	/**
	 * Get All Deal Types
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_deal_types() {
		
		$deal_types = array(
								'simple' 	=> __( 'Simple deal', 'wpsdeals' ),
								'affiliate'	=> __( 'Affiliate deal', 'wpsdeals' ),
								'bundle'	=> __( 'Bundle deal', 'wpsdeals' )
							);
		return $deal_types;
	}
	
	/**
	 * Get Deal Type
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_deal_type( $post_id ) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$type = get_post_meta( $post_id, $prefix . 'type', true );
		
		if( empty($type) ) { // check type is empty
			$type = 'simple';
		}
		
		return $type;
	}
	
	/**
	 * Get Email Templates
	 * 
	 * Handles to get all email templates
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_email_get_templates() {
		
		$templates = array( 
								'' 			=> __( 'Default Template', 'wpsdeals' ),
								'plain' 	=> __( 'No template, plain text only', 'wpsdeals' )
							);
		
		return apply_filters( 'wps_deals_email_templates', $templates );
	}
	/**
	 * Return Billing Details
	 * 
	 * Handles to return billing details for email
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function wps_deals_email_billing_details( $data ) {
		
		$billingdetailsstr = '';
		
		if( isset( $data['order_details']['billing_details'] ) && !empty( $data['order_details']['billing_details'] ) ) {
			
			$billingdetails = $data['order_details']['billing_details'];
			
			//billingcountry 
			$billingcountry		= isset( $billingdetails['country'] ) ? wps_deals_get_country_name( $billingdetails['country'] ) : '';
			//billing state
			$billingstate		= isset( $billingdetails['state'] ) ? wps_deals_get_state_name ( $billingdetails['state'], $billingdetails['country'] ) : '';
			//billing company	
			$billingcompany		= isset( $billingdetails['company'] ) ? $billingdetails['company'] : '';
			//billing adddress
			$billingaddress1	= isset( $billingdetails['address1'] ) ? $billingdetails['address1'] : '';
			$billingaddress2	= isset( $billingdetails['address2'] ) ? $billingdetails['address2'] : '';
			//billing city
			$billingcity		= isset( $billingdetails['city'] ) ? $billingdetails['city'] : '';
			//billing postcode
			$billingpostcode	= isset( $billingdetails['postcode'] ) ? $billingdetails['postcode'] : '';
			//billing phone
			$billingphone		= isset( $billingdetails['phone'] ) ? $billingdetails['phone'] : '';
			
			$billingdetailsstr .= "\n" . sprintf( __( 'Address : %s','wpsdeals'),			$billingaddress1 ."\n".$billingaddress2 );
			$billingdetailsstr .= "\n" . sprintf( __( 'Company Name : %s','wpsdeals'),		$billingcompany );
			$billingdetailsstr .= "\n" . sprintf( __( 'Town / City : %s','wpsdeals'), 		$billingcity );
			$billingdetailsstr .= "\n" . sprintf( __( 'County / State : %s','wpsdeals'), 	wps_deals_get_state_name ( $billingstate, $billingdetails['country'] ) );
			$billingdetailsstr .= "\n" . sprintf( __( 'Zip / Postal Code : %s','wpsdeals'), $billingpostcode );
			$billingdetailsstr .= "\n" . sprintf( __( 'Country : %s','wpsdeals'), 			$billingcountry );
			$billingdetailsstr .= "\n" . sprintf( __( 'Phone : %s','wpsdeals'), 			$billingcountry );
			
		}  //end if to check order details contain billing details
		else {
			//$billingdetailsstr .= "\n" . __( 'N / A','wpsdeals');
		}
		
		return apply_filters( 'wps_deals_email_billing_details', $billingdetailsstr );
	}
	
	/**
	 * Send E-mail to user when user reset password
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_send_reset_password_email($args = array()) {
		
		global $wps_deals_options;
		
		$email_template_option = isset( $wps_deals_options['email_template'] ) && !empty( $wps_deals_options['email_template'] ) ? $wps_deals_options['email_template'] : 'default';
		
		$fromemail = !empty( $wps_deals_options['from_email'] ) ? $wps_deals_options['from_email'] : get_option('admin_email');
		
		$subject = isset($wps_deals_options['reset_password_email_subject']) ? $wps_deals_options['reset_password_email_subject'] : '';
		
		$message = isset($wps_deals_options['reset_password_email']) ? $wps_deals_options['reset_password_email'] : '';
		
		$lost_password_page = isset( $wps_deals_options['lost_password'] ) && !empty( $wps_deals_options['lost_password'] ) ? $wps_deals_options['lost_password'] : '';
		$reset_link = add_query_arg( array( 'wps_deal_user_key' => $args['user_key'], 'wps_deals_user_name' => $args['user_name'] ), get_permalink( $lost_password_page ) );
		
		$reset_link_html = '<a href="' . $reset_link . '">' . __( 'Click here to reset your password', 'wpsdeals' ) . '</a>';
						
		$message = str_replace( '{user_name}', $args['user_name'], $message );
		$message = str_replace( '{reset_link}', $reset_link_html, $message );
		
		$headers = 'From: ' . $fromemail . "\r\n";
		$headers .= "Reply-To: ". $fromemail . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";

		$message = nl2br($message);
		
		$html = '';
		$html .= '<html>
					<head>';
		$html = apply_filters( 'wps_deals_email_template_css_' . $email_template_option, $html );
		$html .= '</head>
					<body>';
		$html = apply_filters( 'wps_deals_email_template_' . $email_template_option, $html, $message, '' );
		$html .= '	</body>
				</html>';
		
		$html = apply_filters( 'wps_deals_buyer_email_html', $html, $message, '' );
		
		wp_mail( $args['user_email'], $subject, $html, $headers );
		
	}
	
	/**
	 * Returns an array of arguments for ordering
	 * deals based on the selected values
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_deals_ordering_args( $orderby = '', $order = '' ) {
		
		global $wps_deals_options;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		if ( ! $orderby ) {
			$orderby_value = isset( $_GET['dealsorderby'] ) ? $_GET['dealsorderby'] : apply_filters( 'wps_deals_default_deals_orderby', $wps_deals_options['default_deals_orderby'] );
			
			// Get order + orderby args from string
			$orderby_value	= explode( '-', $orderby_value );
			$orderby		= esc_attr( $orderby_value[0] );
			$order			= ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;
		}
		
		$orderby = strtolower( $orderby );
		$order   = strtoupper( $order );
		
		$args = array();
		
		// default - menu_order
		$args['orderby']  = 'menu_order title';
		$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
		$args['meta_key'] = '';
		
		switch ( $orderby ) {
			case 'date' :
				$args['orderby']  = 'date';
				$args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
			break;
			case 'price' :
				$args['orderby']  = 'meta_value_num';
				$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
				//$args['meta_key'] = $prefix . 'normal_price';
				//$args['meta_key'] = $prefix . 'sale_price';
				$args['meta_key'] = $prefix . 'price';
			break;
		}
		
		return apply_filters( 'wps_deals_get_deals_ordering_args_data', $args );
	}
	
	/**
	 * Returns Purchase notes of deal
	 * 
	 * Handle shortcode if any in purchase notes and 
	 * also use filter to modify purchase note
	 * 
	 * @package Social Deals Engine
	 * @since 2.1.3
	 */
	public function wps_deals_get_purchase_notes( $purchasenote, $deal_id, $order_id ) {
		
		global $wps_deals_order_id, $wps_deals_deal_id;
		
		$wps_deals_order_id = $order_id;
		$wps_deals_deal_id = $deal_id;
		
		return do_shortcode( nl2br( apply_filters( 'wps_deals_purchase_note', $purchasenote, $deal_id, $order_id ) ) );		
	}
	
	/**
	 * Check item is sold out
	 * 
	 * Handle to check deal is soldout or not based on purchase limit
	 * 
	 * @package Social Deals Engine
	 * @since 2.2.1
	 */
	public function wps_deals_check_item_is_sold_out( $post_id, $userid="" ) {
	
		global $user_ID;			
		$prefix = WPS_DEALS_META_PREFIX;
		$soldout = false;		
		if( !is_user_logged_in() ) // if guest user then return
			return $soldout;
		
		if( empty( $userid ) ) {
			$userid = $user_ID;
		}				
		
		// get purchase limit
		$purchase_limit = get_post_meta( $post_id, $prefix.'purchase_limit', true );
		
		if( $purchase_limit == "-1" ) { //if its set as -1 then its sold out
			$soldout = true;
		} elseif ( empty( $purchase_limit ) || $purchase_limit == '0' ) { // if its empty then unlimited purchases(not sold out)
			$soldout = false;
		} else { // have other value
			// Get User already purchase deal detail
			$user_purchased_detail = get_user_meta( $userid, $prefix.'purchase_detail', true );
			// check user purchased detail with purchase limit
			if( isset( $user_purchased_detail[$post_id] ) && $user_purchased_detail[$post_id]['total_purchase'] >= $purchase_limit )
				$soldout = true;
			else
				$soldout = false;
		}
		
		return $soldout;
	}
	
		
	 /**
	 * Display system info
	 *
	 * @since       2.2.6
	 * @access      public
	 * @return      string $return A string containing the info to output
	 */
	
	public function wps_deals_tools_sysinfo_display() {
		global $wpdb, $wps_deals_options, $wps_deals_model;
		
		if( !class_exists( 'Browser' ) )
		
			require_once WPS_DEALS_DIR . '/includes/libraries/browser.php';
	
		$browser = new Browser();
		
		// Get theme info
		if( get_bloginfo( 'version' ) < '2.5.4' ) {
			$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
			$theme      = $theme_data['Name'] ;
			$theme_version = $theme_data['Version'];
			if( is_child_theme() ) :
				$parent_theme = wp_get_theme( $active_theme->Template );
			endif;
		
		} else {
			$theme_data = wp_get_theme();
			$theme      = $theme_data->Name;
			$theme_version=$theme_data->Version;
		}
		
		// Try to identify the hosting provider
		$host = $wps_deals_model->wps_deals_get_host();
	
		$return  = '### Begin System Info ###' . "\n\n";
		
		// Start with the basics...
		$return .= '-- Site Info' . "\n\n";
		$return .= 'Site URL:                 ' . site_url() . "\n";
		$return .= 'Home URL:                 ' . home_url() . "\n";
		$return .= 'Multisite:                ' . ( is_multisite() ? 'Yes' : 'No' ) . "\n";
	
		
		// Can we determine the site's host?
		if( $host ) {
			$return .= "\n" . '-- Hosting Provider' . "\n\n";
			$return .= 'Host:                     ' . $host . "\n";
	
			$return  = apply_filters( 'wps_deals_sysinfo_after_host_info', $return );
		}
	
		// The local users' browser information, handled by the Browser class
		$return .= "\n" . '-- User Browser' . "\n\n";
		$return .= $browser;
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_user_browser', $return );
	
		// WordPress configuration
		$return .= "\n" . '-- WordPress Configuration' . "\n\n";
		$return .= 'Version:                  ' . get_bloginfo( 'version' ) . "\n";
		$return .= 'Language:                 ' . ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) . "\n";
		$return .= 'Permalink Structure:      ' . ( get_option( 'permalink_structure' ) ? get_option( 'permalink_structure' ) : 'Default' ) . "\n";
		$return .= 'Show On Front:            ' . get_option( 'show_on_front' ) . "\n";
	
		// Only show page specs if frontpage is set to 'page'
		if( get_option( 'show_on_front' ) == 'page' ) {
			$front_page_id = get_option( 'page_on_front' );
			$blog_page_id = get_option( 'page_for_posts' );
	
			$return .= 'Page On Front:            ' . ( $front_page_id != 0 ? get_the_title( $front_page_id ) . ' (#' . $front_page_id . ')' : 'Unset' ) . "\n";
			$return .= 'Page For Posts:           ' . ( $blog_page_id != 0 ? get_the_title( $blog_page_id ) . ' (#' . $blog_page_id . ')' : 'Unset' ) . "\n";
		}
	
		// Make sure wp_remote_post() is working
		$request['cmd'] = '_notify-validate';
	
		$params = array(
			'sslverify'     => false,
			'timeout'       => 60,
			'user-agent'    => 'WPS_DEALS_VERSION',
			'body'          => $request
		);
	
		$response = wp_remote_post( 'https://www.paypal.com/cgi-bin/webscr', $params );
	
		if( !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
			$WP_REMOTE_POST = 'wp_remote_post() works';
		} else {
			$WP_REMOTE_POST = 'wp_remote_post() does not work';
		}
	
		
		$return .= 'Remote Post:              ' . $WP_REMOTE_POST . "\n";
		$return .= 'Table Prefix:             ' . 'Length: ' . strlen( $wpdb->prefix ) . '   Status: ' . ( strlen( $wpdb->prefix ) > 16 ? 'ERROR: Too long' : 'Acceptable' ) . "\n";
		// Commented out per https://github.com/easydigitaldownloads/Easy-Digital-Downloads/issues/3475
		//$return .= 'Admin AJAX:               ' . ( edd_test_ajax_works() ? 'Accessible' : 'Inaccessible' ) . "\n";
		$return .= 'WP_DEBUG:                 ' . ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' : 'Disabled' : 'Not set' ) . "\n";
		$return .= 'Memory Limit:             ' . WP_MEMORY_LIMIT . "\n";
		$return .= 'Registered Post Stati:    ' . implode( ', ', get_post_stati() ) . "\n";
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_wordpress_config', $return );
	
		// Wordpress Theme Config
		$return .= "\n" . '-- WordPress Theme Config ' . "\n\n";
		$return .= 'Active Theme:             ' . $theme . "\n";
		$return .= 'Theme Version:		  ' . $theme_version. "\n";
		
		if(is_child_theme()){
			
			// Parent theme 
			$active_theme         = wp_get_theme();
			$parent_theme = isset($active_theme) ? wp_get_theme( $active_theme->Template ) : '';
			$return .= 'Child Theme:			' . 'Yes' . "\n"; 
			$return .= 'Parent Theme Name:		' . $parent_theme->Name . "\n";
			$return .= 'Parent Theme Version: 	' . $parent_theme->Version . "\n";
			
		}
		else{
			$return .= 'Child theme:	  	  ' . 'No'. "\n";
		}
		
		
		// WPS DEALS Confingration
		$return .= 	"\n". '-- Soical Deals Engine Configuration ' . "\n\n";
		$return .= 'Version:                  ' . WPS_DEALS_VERSION . "\n";
		$return .= 'Upgraded From:            ' . get_option( 'wps_deals_version_upgraded_from', 'None' ) . "\n";
		$return .= 'Test Mode:                ' . ( wps_deals_is_test_mode() ? "Enabled\n" : "Disabled\n" );
		$return .= 'Guest Checkout:           ' . ( ! wps_deals_is_guest_checkout() ? "Enabled\n" : "Disabled\n" );
		$return .= 'Currency Code:            ' . wps_deals_currency() . "\n";
		$return .= 'Currency Position:        ' . ( !empty($wps_deals_options['currency_position']) ? $wps_deals_options['currency_position'] : '') ."\n";
		$return .= 'Decimal Separator:        ' . $wps_deals_options['decimal_seperator']. "\n";
		$return .= 'Thousands Separator:      ' . $wps_deals_options['thounsands_seperator'] . "\n";
		$return .= 'Enabled Billing:          ' . ( wps_deals_is_billing_enabled() ? "Enabled\n" : "Disabled\n" );
		$return .= 'Chaching:                 ' . ( wps_deals_is_chaching() ? "Enabled\n" : "Disabled\n" );
		$return .= 'Twitter Bootstrap:        ' . ( wps_deals_is_twitter_bootstrap() ? "Disabled\n" : "Enabled\n" );
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_wps_deals_config', $return );
		
		// WPS DEALS Page Setting
		
		$return .= "\n" . '-- Social Deals Engine Page settings' . "\n\n";
		$return .= 'Deals Overview:	 	  ' . ( !empty( $wps_deals_options['deals_main_page'] ) ? "Valid\n" : "Invalid\n" );
		$return .= 'Deals Overview Page:      ' . ( !empty( $wps_deals_options['deals_main_page'] ) ? get_permalink( $wps_deals_options['deals_main_page'] ) . "\n" : "Unset\n" );
		$return .= 'Checkout:		  ' . ( !empty( $wps_deals_options['payment_checkout_page'] ) ? "Valid\n" : "Invalid\n" );
		$return .= 'Checkout Page:      	  ' . ( !empty( $wps_deals_options['payment_checkout_page'] ) ? get_permalink( $wps_deals_options['payment_checkout_page'] ) . "\n" : "Unset\n" );
		$return .= 'My Account:		  ' . ( !empty( $wps_deals_options['my_account_page'] ) ? "Valid\n" : "Invalid\n" );
		$return .= 'My Account Page:          ' . ( !empty( $wps_deals_options['my_account_page'] ) ? get_permalink( $wps_deals_options['my_account_page'] ) . "\n" : "Unset\n" );
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_wps_deals_page_setting', $return );
		
		// WPS Deals Gate way Configration
			
		$return .= "\n" . '-- Social Deals Engine Gateway Configration' . "\n\n";
		$return .= 'Enabled Gateway:		'. ( !empty($wps_deals_options['payment_gateways']['paypal'] )? 'Paypal Standards, ' : '').  ( !empty($wps_deals_options['payment_gateways']['cheque'] )? 'Cheque Payment, ' : '') .( !empty($wps_deals_options['payment_gateways']['testmode'] )? 'Test mode': ''). "\n"  ;
		$return .= 'Default Gateway:		'. ( !empty($wps_deals_options['default_payment_gateway'])? $wps_deals_options['default_payment_gateway'] : '');
		
		// WordPress active plugins
		$return .= "\n\n" . '-- WordPress Active Plugins' . "\n\n";
	
		$plugins = get_plugins();
		$active_plugins = get_option( 'active_plugins', array() );
	
		foreach( $plugins as $plugin_path => $plugin ) {
			if( !in_array( $plugin_path, $active_plugins ) )
				continue;
	
			$return .= $plugin['Name'] . '  :   ' . $plugin['Version'] . "\n";
		}
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_wordpress_plugins', $return );
	
		// WordPress inactive plugins
		$return .= "\n" . '-- WordPress Inactive Plugins' . "\n\n";
	
		foreach( $plugins as $plugin_path => $plugin ) {
			if( in_array( $plugin_path, $active_plugins ) )	
				continue;
	
			$return .= $plugin['Name'] . ': ' . $plugin['Version'] . "\n";
		}
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_wordpress_plugins_inactive', $return );
	
		// Server configuration (really just versioning)
		$return .= "\n" . '-- Webserver Configuration' . "\n\n";
		$return .= 'PHP Version:              ' . PHP_VERSION . "\n";
		$return .= 'MySQL Version:            ' . $wpdb->db_version() . "\n";
		$return .= 'Webserver Info:           ' . $_SERVER['SERVER_SOFTWARE'] . "\n";
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_webserver_config', $return );
	
		// PHP configs... now we're getting to the important stuff
		$return .= "\n" . '-- PHP Configuration' . "\n\n";
		$return .= 'Safe Mode:                ' . ( ini_get( 'safe_mode' ) ? 'Enabled' : 'Disabled' . "\n" );
		$return .= 'Memory Limit:             ' . ini_get( 'memory_limit' ) . "\n";
		$return .= 'Upload Max Size:          ' . ini_get( 'upload_max_filesize' ) . "\n";
		$return .= 'Post Max Size:            ' . ini_get( 'post_max_size' ) . "\n";
		$return .= 'Upload Max Filesize:      ' . ini_get( 'upload_max_filesize' ) . "\n";
		$return .= 'Time Limit:               ' . ini_get( 'max_execution_time' ) . "\n";
		$return .= 'Max Input Vars:           ' . ini_get( 'max_input_vars' ) . "\n";
		$return .= 'Display Errors:           ' . ( ini_get( 'display_errors' ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A' ) . "\n";
		$return  = apply_filters( 'wps_deals_sysinfo_after_php_config', $return );
	
		// PHP extensions and such
		$return .= "\n" . '-- PHP Extensions' . "\n\n";
		$return .= 'cURL:                     ' . ( function_exists( 'curl_init' ) ? 'Supported' : 'Not Supported' ) . "\n";
		$return .= 'fsockopen:                ' . ( function_exists( 'fsockopen' ) ? 'Supported' : 'Not Supported' ) . "\n";
		$return .= 'SOAP Client:              ' . ( class_exists( 'SoapClient' ) ? 'Installed' : 'Not Installed' ) . "\n";
		$return .= 'Suhosin:                  ' . ( extension_loaded( 'suhosin' ) ? 'Installed' : 'Not Installed' ) . "\n";
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_php_ext', $return );
	
		// Session stuff
		$return .= "\n" . '-- Session Configuration' . "\n\n";
		//$return .= 'WPS DEALS Use Sessions:         ' . ( defined( 'WPS_DEALS_USE_PHP_SESSIONS' ) && WPS_DEALS_USE_PHP_SESSIONS ? 'Enforced' : ( WPS_DEAlS()->session->use_php_sessions() ? 'Enabled' : 'Disabled' ) ) . "\n";
		$return .= 'Session:                  ' . ( isset( $_SESSION ) ? 'Enabled' : 'Disabled' ) . "\n";
	
		// The rest of this is only relevant is session is enabled
		if( isset( $_SESSION ) ) {
			$return .= 'Session Name:             ' . esc_html( ini_get( 'session.name' ) ) . "\n";
			$return .= 'Cookie Path:              ' . esc_html( ini_get( 'session.cookie_path' ) ) . "\n";
			$return .= 'Save Path:                ' . esc_html( ini_get( 'session.save_path' ) ) . "\n";
			$return .= 'Use Cookies:              ' . ( ini_get( 'session.use_cookies' ) ? 'On' : 'Off' ) . "\n";
			$return .= 'Use Only Cookies:         ' . ( ini_get( 'session.use_only_cookies' ) ? 'On' : 'Off' ) . "\n";
		}
	
		$return  = apply_filters( 'wps_deals_sysinfo_after_session_configs', $return );
	
		
		// Temaplates Overrides
			
		$return .= "\n" . '-- Templates ' . "\n\n";
		$return .= 'Overrides(Deals Engine):  ';
		$template_paths     = get_stylesheet_directory(). '/deals-engine/' ;
		if( file_exists($template_paths)){
			$return .= 'Yes';
		}
		else{
			$return .= "No";
		}
		
		$return .= "\n\n\n" . '### End System Info ###';
		
		return $return;
	}
	
	
	 /**
	 * Get host
	 *
	 * @since       2.2.6
	 * @access      public
	 * @return      string $return A string containing the info to output
	 */
	
	public function wps_deals_get_host() {
		$host = false;
	
		if( defined( 'WPE_APIKEY' ) ) {
			$host = 'WP Engine';
		} elseif( defined( 'PAGELYBIN' ) ) {
			$host = 'Pagely';
		} elseif( DB_HOST == 'localhost:/tmp/mysql5.sock' ) {
			$host = 'ICDSoft';
		} elseif( DB_HOST == 'mysqlv5' ) {
			$host = 'NetworkSolutions';
		} elseif( strpos( DB_HOST, 'ipagemysql.com' ) !== false ) {
			$host = 'iPage';
		} elseif( strpos( DB_HOST, 'ipowermysql.com' ) !== false ) {
			$host = 'IPower';
		} elseif( strpos( DB_HOST, '.gridserver.com' ) !== false ) {
			$host = 'MediaTemple Grid';
		} elseif( strpos( DB_HOST, '.pair.com' ) !== false ) {
			$host = 'pair Networks';
		} elseif( strpos( DB_HOST, '.stabletransit.com' ) !== false ) {
			$host = 'Rackspace Cloud';
		} elseif( strpos( DB_HOST, '.sysfix.eu' ) !== false ) {
			$host = 'SysFix.eu Power Hosting';
		} elseif( strpos( $_SERVER['SERVER_NAME'], 'Flywheel' ) !== false ) {
			$host = 'Flywheel';
		} else {
			// Adding a general fallback for data gathering
			$host = 'DBH: ' . DB_HOST . ', SRV: ' . $_SERVER['SERVER_NAME'];
		}
	
		return $host;
	}
}
?>