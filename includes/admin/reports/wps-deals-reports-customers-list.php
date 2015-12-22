<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Deal Customer List Page
 *
 * The html markup for the customer list
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
	
class Wps_Deals_Customer_List extends WP_List_Table {

	public $model,$currency,$render;
	
	function __construct(){
	
        global $wps_deals_model, $page,$wps_deals_currency,$wps_deals_render;
                
        //Set parent defaults
        parent::__construct( array(
							            'singular'  => 'Customer',     //singular name of the listed records
							            'plural'    => 'Customers',    //plural name of the listed records
							            'ajax'      => false        //does this table support ajax?
							        ) );   
		
		$this->model = $wps_deals_model;
		$this->currency = $wps_deals_currency;
		$this->render = $wps_deals_render;
		
    }
    
    /**
	 * Displaying Customers
	 *
	 * Does prepare the data for displaying the customers in the table.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function display_deals_customers() {
	
		//if search is call then pass searching value to function for displaying searching values
		$args = array();
		
		//get deals sale data from database
		$data = $this->model->wps_deals_get_customers( $args );
		
		foreach ($data as $key => $value){
			
			$value_id = isset( $value['ID'] ) ? $value['ID'] : '';
			//this line should be on start of loop
			$data[$key]	= apply_filters('wps_deals_reports_customers_column_data',$value,$value_id );
			
			$wp_user = get_user_by( 'email', $value );
			
			$item = array();
			if($wp_user) {
				$user_id = $wp_user->ID;
				$item['user_id'] = $user_id;
				$item['user_name'] = $wp_user->display_name;
			} else {
				$user_id = 0;
				$item['user_id'] = $user_id;
				$item['useremail'] = $value;
			}
			
			$purchases_args = array('useremail' => $value, 'getcount' => '1');
			$purchases_amount_data = $this->model->wps_deals_purchase_total_of_user($value);
			
			$data[$key] = array(
				'ID' 			=> $user_id,
				'name' 			=> $this->column_user($item),
				//'name' 			=> $wp_user ? $wp_user->display_name : __( 'Guest', 'wpsdeals' ),
				'email' 		=> $value,
				'num_purchases'	=> $purchases_amount_data['salescount'],
				'amount_spent'	=> $this->currency->wps_deals_formatted_value($purchases_amount_data['earnings'])
			);
		}
		
		return $data;
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
		
    	$userlink = add_query_arg(array('post_type' => WPS_DEALS_POST_TYPE,'page' => 'wps-deals-sales','userid' => $user), admin_url('edit.php'));
     	return '<a href="'.$userlink.'">'.$display_name.'</a>';
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
            case 'name' :
            case 'email' :
            case 'num_purchases' :
            case 'amount_spent' :
            	return $item[ $column_name ];
            default:
				$default_value = isset( $item[ $column_name ] ) ? $item[ $column_name ] : '';
    			return apply_filters( 'wps_deals_reports_customers_column_value', $default_value, $item, $column_name );            	
        }
    }
	
    /**
     * Display Columns
     *
     * Handles which columns to show in table
     * 
	 * @package Social Deals Engine
	 * @since 1.0.0
     */
	function get_columns(){
	
        $columns = array(
					            'name'					=>	__(	'Name', 'wpsdeals' ),
					            'email'					=>	__(	'Email', 'wpsdeals' ),
					            'num_purchases'			=>	__(	'Purchases', 'wpsdeals' ),
					            'amount_spent'			=>	__(	'Total Spent', 'wpsdeals' ),
					        );
        return apply_filters( 'wps_deals_reports_customers_column', $columns );
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
        								'name'	=>	array( 'name', true ),
        								'email'	=>	array( 'email', true ),
        								//'earnings'		=>	array( 'earnings', true ),
							        );
        return apply_filters( 'wps_deals_reports_customers_sortable_column', $sortable_columns );
    }
	
	function no_items() {
		//message to show when no records in database table
		_e( 'No customers data found.', 'wpsdeals' );
	}
	
	function prepare_items() {
        
		global $wps_deals_options;
        
		/**
         * First, lets decide how many records per page to show
         */
        $per_page = isset($wps_deals_options['per_page']) && !empty($wps_deals_options['per_page']) ? $wps_deals_options['per_page'] : '10';
        
        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        
        /**
         * REQUIRED. Finally, we build an array to be used by the class for column 
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);
        
         /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        //$this->process_bulk_action();
        
        /**
         * Instead of querying a database, we're going to fetch the example data
         * property we created for use in this plugin. This makes this example 
         * package slightly different than one you might build on your own. In 
         * this example, we'll be using array manipulation to sort and paginate 
         * our data. In a real-world implementation, you will probably want to 
         * use sort and pagination data to build a custom query instead, as you'll
         * be able to use your precisely-queried data immediately.
         */
		$data = $this->display_deals_customers();
		
        
        /**
         * This checks for sorting input and sorts the data in our array accordingly.
         * 
         * In a real-world situation involving a database, you would probably want 
         * to handle sorting by passing the 'orderby' and 'order' values directly 
         * to a custom query. The returned data will be pre-sorted, and this array
         * sorting technique would be unnecessary.
         */
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'ID'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
       
                
        /**
         * REQUIRED for pagination. Let's figure out what page the user is currently 
         * looking at. We'll need this later, so you should always include it in 
         * your own package classes.
         */
        $current_page = $this->get_pagenum();
        
        /**
         * REQUIRED for pagination. Let's check how many items are in our data array. 
         * In real-world use, this would be the total number of items in your database, 
         * without filtering. We'll need this later, so you should always include it 
         * in your own package classes.
         */
        $total_items = count($data);
        
        
        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to 
         */
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);        
        
        
        /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where 
         * it can be used by the rest of the class.
         */
        $this->items = $data;
        
        
        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
									            'total_items' => $total_items,                  //WE have to calculate the total number of items
									            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
									            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
									        ) );
    }
    
}

	//Create an instance of our package class...
	$DealsCustomersListTable = new Wps_Deals_Customer_List(); 
	
	//Fetch, prepare, sort, and filter our data...
	$DealsCustomersListTable->prepare_items();

		//add something before customer report
		do_action( 'wps_deals_customer_reports_before' );
			
	?>
	<form action="" method="POST">
		<?php
				//add something before export csv buton in customer report
				do_action( 'wps_deals_customer_reports_export_csv_btn_before' );
			
		?>
		<input type="submit" class="button" id="wps-deals-customer-report-exports" name="wps-deals-customer-report-exports" value="<?php _e('Export to CSV','wpsdeals');?>" />
		<?php
				//add something after export csv buton in customer report
				do_action( 'wps_deals_customer_reports_export_csv_btn_after' );
			
		?>
	</form>
	<!-- Now we can render the completed list table -->
	<?php 
		
		$DealsCustomersListTable->display(); 
		
		//add something after customer report
		do_action( 'wps_deals_customer_reports_after' );
?>