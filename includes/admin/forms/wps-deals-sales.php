<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Deal Sales List Page
 *
 * The html markup for the product list
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */


if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
	
class Wps_Deals_Sales_List extends WP_List_Table {

	public $model,$currency,$render,$scripts,$per_page;
	
	function __construct(){
	
        global $wps_deals_model, $page,$wps_deals_currency,$wps_deals_render,$wps_deals_scripts;
                
        //Set parent defaults
        parent::__construct( array(
							            'singular'  => 'dealsale',
							            'plural'    => 'dealsales',
							            'ajax'      => false
							        ) );   
		
		$this->model 	= $wps_deals_model;
		$this->currency = $wps_deals_currency;
		$this->render 	= $wps_deals_render;
		$this->scripts 	= $wps_deals_scripts;
		$this->per_page	= apply_filters( 'wps_deals_sales_list_per_page', 10 ); // Per page
		
		wp_enqueue_script( 'wps-deals-popup-scripts' );		
    }
    
    /**
	 * Displaying Prodcuts
	 *
	 * Does prepare the data for displaying the products in the table.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function display_deals_sales() {		
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// Taking parameter
		$orderby 	= isset( $_GET['orderby'] )	? urldecode( $_GET['orderby'] )		: 'date';
		$order		= isset( $_GET['order'] )	? $_GET['order']                	: 'DESC';
		$search 	= isset( $_GET['s'] ) 		? sanitize_text_field( trim($_GET['s']) )	: null;
		
		$args = array(
						'posts_per_page'	=> $this->per_page,
						'page'				=> isset( $_GET['paged'] ) ? $_GET['paged'] : null,
						'orderby'			=> $orderby,
						'order'				=> $order,
						'offset'  			=> ( $this->get_pagenum() - 1 ) * $this->per_page,
						'deals_list_data'	=> true
					);
		
		if( isset( $_GET['payment_status'] ) ) { //filter by payment status
			
			$args['meta_query']	= array(
										array(
												'key'		=> $prefix . 'payment_status',
												'value'		=> $_GET['payment_status'],
												'compare'	=> '='
											)
									);
		}
		
		// If search is call then pass searching value to function for displaying searching values
		if( is_string( $search ) && !empty( $search ) ) {
			$args['s'] = $search;
		}				
		
		if(isset($_GET['userid'])){
			$args['author'] = $_GET['userid'];
		}
		
		if(isset($_GET['wps-deals-start-date'])){
			$args['start_date'] = $_GET['wps-deals-start-date']; 
		}
		
	  	if(isset($_GET['wps-deals-end-date'])){
			$args['end_date'] = $_GET['wps-deals-end-date'];
	  	}		  		  
		
		//get deals sale data from database
		$result_data = $this->model->wps_deals_get_sales( $args );
		
		foreach ($result_data['data'] as $key => $value) {
			
			//this line should be on start of loop
			$data[$key]	= apply_filters('wps_deals_sales_column_data',$value,$value['ID']);
			
			// get the value for the user details from the post meta box
			$userdetails = $this->model->wps_deals_get_ordered_user_details($value['ID']);
			
			// get the value for the order details from the post meta box
			$order_details = $this->model->wps_deals_get_post_meta_ordered($value['ID']);
			
			// get the value for the payment status from the post meta box
			$payment_status = $this->model->wps_deals_get_ordered_payment_status($value['ID']);
			
			//get the data for which deal is ordered
			$deal_ordered_data = $order_details['deals_details'];
			
			// get the value for the order ipn data from the post meta box
			$paypal_data = $this->model->wps_deals_get_ipn_data($value['ID']);
			
			//get value from status for payment
			$currency = isset($order_details['currency']) ? $order_details['currency'] : 'USD';
			
			$displayusername = isset($userdetails['first_name']) && !empty($userdetails['first_name']) ? $userdetails['first_name'].' '.$userdetails['last_name'] : $userdetails['user_name'];
			
			//popup data
			$popupdata = array();
			$popupdata 						= array_merge($value,$order_details);
			$popupdata['payment_status']	= $payment_status;
			$popupdata['ipndata']			= $paypal_data;
			$popupdata['userdetails']		= $userdetails;
			$popupdata['payment_method']	= isset( $order_details['admin_label'] ) ? $order_details['admin_label'] : $order_details['payment_method'];
			$popupdata['billing_details']	= isset( $order_details['billing_details'] ) ? $order_details['billing_details'] : array();
			
			$data[$key]['user_details']		= !empty($userdetails) ? $userdetails : array();
			$data[$key]['useremail'] 		= isset($userdetails['user_email']) ? $userdetails['user_email'] : '';
			$data[$key]['payment_status']	= isset($payment_status) ? $payment_status : '';
			$data[$key]['order_status']		= $this->model->wps_deals_paypal_status_to_value($payment_status);
			$data[$key]['amount']			= $order_details['display_order_total'];
			$data[$key]['date_time']		= $value['post_date'];
			$data[$key]['currency']			= $currency;
			$data[$key]['deals_data']		= $order_details;
			$data[$key]['order_ip']			= $order_details['order_ip'];
			$data[$key]['payment_method']	= isset( $order_details['admin_label'] ) ? $order_details['admin_label'] : $order_details['payment_method'];
			$data[$key]['user_id']			= $userdetails['user_id'];
			$data[$key]['user_name']		= $userdetails['user_name'];
			$data[$key]['showusername']		= $displayusername;
			$data[$key]['popupdata']		= $popupdata;
		}
		
		$result_arr['data']		= !empty($data)	? $data : array();
		$result_arr['total'] 	= isset($result_data['total']) ? $result_data['total'] 	: ''; // Total no of data
		
		return $result_arr;
	}
	
	/**
	 * Displaying Start Date & End Date Filter
	 * 
	 * Does prepare the frontaend for date filtration and search functionality
	 * 
	 * @package Social Deals Engine
	 * @since 2.1.5
	 */
	public function wps_deals_advanced_filters() {
		
		$start_date = isset( $_GET['wps-deals-start-date'] )  ? sanitize_text_field( $_GET['wps-deals-start-date'] ) : null;
		$end_date   = isset( $_GET['wps-deals-end-date'] )    ? sanitize_text_field( $_GET['wps-deals-end-date'] )   : null;?>
	  	
		<div id="wps-deals-sales-filters">
			<span id="wps-deals-sales-date-filters">
				<label for="wps_deals_start_date"><?php _e( 'Start Date:', 'wpsdeals' ); ?></label>
				<input type="text" id="wps_deals_start_date" name="wps-deals-start-date" class="wps_deals_datepicker" value="<?php echo $start_date; ?>" placeholder="mm/dd/yyyy"/>
				<label for="wps_delas_end_date"><?php _e( 'End Date:', 'wpsdeals' ); ?></label>
				<input type="text" id="wps_delas_end_date" name="wps-deals-end-date" class="wps_deals_datepicker" value="<?php echo $end_date; ?>" placeholder="mm/dd/yyyy"/>
				<input type="submit" class="button-secondary" value="<?php _e( 'Apply', 'wpsdeals' ); ?>"/>
			</span><?php 
			
			if( ! empty( $start_date ) || ! empty( $end_date ) ) {?>
				<a href="<?php echo admin_url( 'edit.php?post_type=wpsdeals&page=wps-deals-sales' ); ?>" class="button-secondary"><?php _e( 'Clear Filter', 'wpsdeals' ); ?></a><?php 
			}
			
			$this->search_box( __( 'Search', 'wpsdeals' ), 'wps-deals-sales' ); ?>
		</div><?php
	}
	
	/**
	 * Mange column data
	 * 
	 * Default Column for listing table
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function column_default( $item, $column_name ){
		
        switch( $column_name ){
            case 'ID':
            	return $item[ $column_name ];
            case 'amount' :
            	return $item[ $column_name ];
            case 'details' :
            	$deal_data = $item['deals_data'];
				$popupdetails = $this->render->wps_deals_get_order_popup_details($item['popupdata']);
	            $popupdetails .= '	<a href="#wps_deal_ordered_'.$item['ID'].'" rel="wps_deal_sale_view">'.__('View Details','wpsdeals').'</a>';
            	return $popupdetails;
            case 'payment_status' :
            	return $item[ $column_name ];
            case 'date_time' :
            	$datetime = $this->model->wps_deals_get_date_format($item[ $column_name ],true);
            	return $datetime;
            default:
        	  	$default_value = isset( $item[ $column_name ] ) ? $item[ $column_name ] : '';
    			return apply_filters( 'wps_deals_sales_column_value', $default_value, $item, $column_name );				
        }
    }
	
    /**
     * Manage User Column
     *
     * @package Social Deals Engine
     * @since 1.0.0
     */
    
    function column_user($item){
    	
    	$user_id = $item['user_id'];
    	$user = isset( $user_id ) && !empty( $user_id ) ? $user_id : $item['useremail'];
    	
    	if ( is_numeric( $user_id ) ) {
    		
    		$userdata = get_userdata( $user_id ) ;
			$display_name = is_object( $userdata ) ? $item['user_name'] : __( 'guest', 'wpsdeals' );
			
		} else {
			$display_name = __( 'guest', 'wpsdeals' );
		}
		
    	$userlink = add_query_arg(array('userid' => $user));
    	return '<a href="'.$userlink.'">'.$display_name.'</a>';
    }
   
    /**
     * Manage Edit/Delete Link
     * 
     * Does to show the edit and delete link below the column cell
     * function name should be column_{field name}
     * For ex. I want to put Edit/Delete link below the post title 
     * so i made its name is column_post_title
     * 
     * @package Social Deals Engine
     * @since 1.0.0
     */
    function column_user_details( $item ) {
    	
    	//to keep user on same page when the perform delete action or anyother action by link
    	$strstatus = '';
    	if(isset($_GET['payment_status'])) {
    		$strstatus = '&payment_status='.$_GET['payment_status'];
    	}
    	
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?post_type='.WPS_DEALS_POST_TYPE.'&page=%s&action=%s&order_id=%s">'.__('Edit', 'wpsdeals').'</a>','wps-deals-sales','editorder',$item['ID']),
        );
        
        $userdetails = '';
        if( !empty( $item['showusername'] ) ) {
	    	$userdetails .= $item['showusername'].'<br />';
        }
        if( !empty( $item['useremail'] ) ) {
	    	$userdetails .= '( <a href="mailto:'.$item['useremail'].'">'.$item['useremail'].'</a> )';
        }
    	if($item['order_status'] == '1') {
			$resendlink = add_query_arg(array('resend' => $item['ID']));
			$actions['resend'] = sprintf('<a href="?post_type='.WPS_DEALS_POST_TYPE.'&page=%s&action=%s&order_id=%d'.$strstatus.'" class="wps-deals-sales-resend">'.__('Resend Purchase Receipt', 'wpsdeals').'</a>',$_REQUEST['page'],'resend',$item['ID']);
		}
    	
		$actions['delete'] = sprintf('<a href="?post_type='.WPS_DEALS_POST_TYPE.'&page=%s&action=%s&dealsale[]=%s'.$strstatus.'" class="wps-deals-sales-delete">'.__('Delete', 'wpsdeals').'</a>',$_REQUEST['page'],'delete',$item['ID']);
		
        //Return the title contents	        
        return sprintf('%1$s %2$s',
            /*$1%s*/ $userdetails,
            /*$2%s*/ $this->row_actions( apply_filters( 'wps_deals_sales_action_links',$actions,$item['ID'] ) )
        );
    }
    
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }
    
	/**
	 * Display Columns
	 *
	 * Handles which columns to show in table
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_columns() {
		
		$columns = array(
						'cb'      			=>	'<input type="checkbox" />', //Render a checkbox instead of text
			            'ID'				=>	__( 'Order ID', 'wpsdeals' ),
			            'user_details'		=>	__(	'User Details', 'wpsdeals' ),
			            'amount'			=>	__(	'Amount', 'wpsdeals' ),
			            'details'			=>	__(	'Details', 'wpsdeals' ),
			            'user'				=>	__(	'User', 'wpsdeals' ),
			            'payment_status'	=>	__(	'Status', 'wpsdeals' ),
			            'date_time'			=>	__(	'Date/Time', 'wpsdeals' ),
			        );
		
		return apply_filters('wps_deals_sales_add_column',$columns);
    }
	
	/**
	 * Sortable Columns
	 *
	 * Handles soratable columns of the table
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_sortable_columns() {
		
		$sortable_columns = array(
									'ID'			=>	array( 'ID', true ),
						            'post_title'	=>	array( 'post_title', true ),
						            'date_time'		=>	array( 'date_time', true ),	
						            'amount'		=>	array( 'amount', true)
						        );
		
		return apply_filters('wps_deals_sales_add_sortable_column',$sortable_columns);
    }
	
    /**
	 * No Item Found Message
	 * 
	 * Handles to display no item found message
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function no_items() {
		
		//message to show when no records in database table
		_e( 'No deal sales found.', 'wpsdeals' );
	}
	
	/**
	 * Bulk actions field
	 * 
	 * Handles Bulk Action combo box values
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_bulk_actions() {
		
		//bulk action combo box parameter
		//if you want to add some more value to bulk action parameter then push key value set in below array
		$actions	= array(
							'delete'    => __('Delete','wpsdeals')
					);
		
		return apply_filters( 'wps_deals_sales_bulk_actions',$actions );
    }
    
	/**
	 * To make linked all links for sorting on top of the table
	 * 
	 * Get an associative array ( id => link ) with the list
	 * of views available on this table.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_views() {
		
		$prefix				= WPS_DEALS_META_PREFIX;
		$payment_status_key	= $prefix . 'payment_status';
		
		$allargs		= array( 'getcount' => 1 );
		$pendingargs 	= array( 'getcount' => 1, 'meta_query' => array( array( 'key' => $payment_status_key, 'value' => '0' ) ) );
		$completedargs 	= array( 'getcount' => 1, 'meta_query' => array( array( 'key' => $payment_status_key, 'value' => '1' ) ) );
		$failedargs 	= array( 'getcount' => 1, 'meta_query' => array( array( 'key' => $payment_status_key, 'value' => '3' ) ) );
		$refundedargs 	= array( 'getcount' => 1, 'meta_query' => array( array( 'key' => $payment_status_key, 'value' => '2' ) ) );
		$cancelledargs 	= array( 'getcount' => 1, 'meta_query' => array( array( 'key' => $payment_status_key, 'value' => '4' ) ) );
		$onholdargs 	= array( 'getcount' => 1, 'meta_query' => array( array( 'key' => $payment_status_key, 'value' => '5' ) ) );
		
		$allcount 		= ( $this->model->wps_deals_get_sales( $allargs ) );
		$pendingcount 	= ( $this->model->wps_deals_get_sales( $pendingargs ) );
		$completedcount = ( $this->model->wps_deals_get_sales( $completedargs ) );
		$cancelledcount = ( $this->model->wps_deals_get_sales( $cancelledargs ) );
		$failedcount 	= ( $this->model->wps_deals_get_sales( $failedargs ) );
		$refundcount 	= ( $this->model->wps_deals_get_sales( $refundedargs ) );
		$onholdcount 	= ( $this->model->wps_deals_get_sales( $onholdargs ) );
		
		//makr proper class to show this link is viewing currently
		$class_pending = $class_completed = $class_cancelled = $class_all = $class_failed = $class_refund = $class_onhold = ''; 
		
		if( ( isset( $_GET['payment_status'] ) && $_GET['payment_status'] == '0' ) ) { // pending payment status
			$class_pending = ' class="current" ';
		} elseif( isset( $_GET['payment_status'] ) && $_GET['payment_status'] == '1' ) { // completed payment status
			$class_completed = ' class="current" ';
		} elseif( isset( $_GET['payment_status'] ) && $_GET['payment_status'] == '4' ) { // cancelled payment status
			$class_cancelled = ' class="current" ';
		} elseif( isset( $_GET['payment_status'] ) && $_GET['payment_status'] == '3' ) { // failed payment status
			$class_failed = ' class="current" ';
		} elseif ( isset( $_GET['payment_status'] ) && $_GET['payment_status'] == '2' ) { //refund payment status
			$class_refund = ' class="current" ';
		}elseif ( isset( $_GET['payment_status'] ) && $_GET['payment_status'] == '5' ) { //on-hold payment status
			$class_onhold = ' class="current" ';
		} else { // all status list
			$class_all = ' class="current" ';
		}
		
		//make array to show links for sorting
		$views	= array( 
							'all' 		=>	sprintf('<a %s href="edit.php?post_type=%s&page=%s">'.__('All ','wpsdeals').'<span class="count">(%d)</span></a>', $class_all, WPS_DEALS_POST_TYPE, $_REQUEST['page'], $allcount ),
							'completed' =>	sprintf('<a %s href="edit.php?post_type=%s&page=%s&payment_status=%s">'.__('Completed ','wpsdeals').'<span class="count">(%d)</span></a>', $class_completed, WPS_DEALS_POST_TYPE, $_REQUEST['page'], '1',$completedcount ),
							'pending' 	=>	sprintf('<a %s href="edit.php?post_type=%s&page=%s&payment_status=%s">'.__('Pending ','wpsdeals').'<span class="count">(%d)</span></a>', $class_pending, WPS_DEALS_POST_TYPE, $_REQUEST['page'], '0', $pendingcount ),
							'cancelled' =>	sprintf('<a %s href="edit.php?post_type=%s&page=%s&payment_status=%s">'.__('Cancelled ','wpsdeals').'<span class="count">(%d)</span></a>', $class_cancelled, WPS_DEALS_POST_TYPE, $_REQUEST['page'], '4', $cancelledcount ),
							'failed' 	=>	sprintf('<a %s href="edit.php?post_type=%s&page=%s&payment_status=%s">'.__('Failed ','wpsdeals').'<span class="count">(%d)</span></a>', $class_failed, WPS_DEALS_POST_TYPE, $_REQUEST['page'],'3', $failedcount ),
							'refunded' 	=>	sprintf('<a %s href="edit.php?post_type=%s&page=%s&payment_status=%s">'.__('Refunded ','wpsdeals').'<span class="count">(%d)</span></a>', $class_refund, WPS_DEALS_POST_TYPE, $_REQUEST['page'], '2', $refundcount ),
							'onhold' 	=>	sprintf('<a %s href="edit.php?post_type=%s&page=%s&payment_status=%s">'.__('On-Hold ','wpsdeals').'<span class="count">(%d)</span></a>', $class_onhold, WPS_DEALS_POST_TYPE, $_REQUEST['page'], '5', $onholdcount )
						);
		return apply_filters( 'wps_deals_sales_views', $views );
	}
	
	function prepare_items() {
		
		global $wps_deals_options;
		
		// Get how many records per page to show
		$per_page		= $this->per_page;
		
		// Get All, Hidden, Sortable columns              
		$columns		= $this->get_columns();
		$hidden			= array();
		$sortable		= $this->get_sortable_columns();
		
		// Get final column header              
		$this->_column_headers = array($columns, $hidden, $sortable);
		
		// Get Data of particular page
		$data_res 	= $this->display_deals_sales();
		$data 		= $data_res['data'];		     		
		
		// Get current page number
		$current_page	= $this->get_pagenum();
		
		// Get total count
		$total_items	= $data_res['total'];
		
		// Get page items
		$this->items	= $data;
		
		// We also have to register our pagination options & calculations.
		$this->set_pagination_args( array(
										'total_items' => $total_items,
										'per_page'    => $per_page,
										'total_pages' => ceil($total_items/$per_page)
									) );
	}
}

//Create an instance of our package class...
$DealsSalesListTable = new Wps_Deals_Sales_List();
	
//Fetch, prepare, sort, and filter our data...
$DealsSalesListTable->prepare_items();
		
?>

<div class="wrap">
    
    <!-- wpsocial logo -->
	<img src="<?php echo WPS_DEALS_URL . 'includes/images/wps-logo.png'; ?>" class="wpsocial-logo deals-sales-logo" alt="<?php _e('WPSocial.com Logo','wpsdeals');?>" />
	
    <h2 class="wps-deals-settings-title">
    	<?php echo apply_filters( 'wps_deals_sales_page_title', __( 'Social Deals Engine - Sales', 'wpsdeals' ) ); ?>
    </h2>
    
    <?php 
    
    	//write some message before deals sales page listing
		do_action( 'wps_deals_sales_list_before' );
		
		if(isset($_GET['message']) && !empty($_GET['message']) ) { //check message
			
			if( $_GET['message'] == '1' ) { //check message
				
				echo '<div class="updated fade" id="message">
						<p><strong>'.__("Record (s) deleted successfully.",'wpsdeals').'</strong></p>
					</div>'; 
				
			} else if ($_GET['message'] == '2') { //resend purchase receipt
				
				echo '<div class="updated fade" id="message">
						<p><strong>'.__("The purchase receipt has been resent.",'wpsdeals').'</strong></p>
					</div>'; 
			} 
		}
		
		//add something before views link in deals sales page
		do_action( 'wps_deals_sales_views_before' );
		
    	//showing sorting links on the top of the list
    	$DealsSalesListTable->views(); 
    	
    	//add something after views link in deals sales page
		do_action( 'wps_deals_sales_views_after' );
    ?>

    <form action="" method="POST">
	    <?php 
    		//add something before generate pdf btn
    		do_action( 'wps_deals_sales_generate_pdf_btn_before' );
    	?>
		<input type="submit" class="button wps-deals-sales-generate-pdf-btn" id="wps-deals-sales-report-pdf" name="wps-deals-sales-report-pdf" value="<?php _e('Generate PDF', 'wpsdeals');?>" />
		<?php 
    		//add something after generate pdf btn
    		do_action( 'wps_deals_sales_generate_pdf_btn_after' );
    	?>
	</form>
    <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
    <form id="product-filter" method="get" class="wps-deals-form">
        
    	<!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <input type="hidden" name="post_type" value="<?php echo WPS_DEALS_POST_TYPE; ?>" />
		
        <!-- Search Title -->
        <?php //$DealsSalesListTable->search_box( __( 'Search', 'wpsdeals' ) ); ?>
        
         <?php 
    		//add something before sales page
    		do_action( 'wps_deals_sales_before' );
    	?>
        
    	<!-- Add start date and end date for filter -->
    	<?php $DealsSalesListTable->wps_deals_advanced_filters(); ?>
    	
        <!-- Now we can render the completed list table -->
        <?php $DealsSalesListTable->display(); ?>
        
        <?php 
    		//add something after sales page
    		do_action( 'wps_deals_sales_after' );
    	?>
    </form>
</div><!--wrap-->