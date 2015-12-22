<?php
/**
 * Downloads Log View Class
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Load WP_List_Table if not loaded
if( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
class Wps_Deals_Downloads_Logs_List extends WP_List_Table {

	public $logs,$model;
	
	public $file_search = false;
	
	function __construct(){
	    
		global $wps_deals_logs,$wps_deals_model;
		
		$this->logs = $wps_deals_logs;
		$this->model = $wps_deals_model;
		
        //Set parent defaults
        parent::__construct( array(
							            'singular'  => 'deallog',     //singular name of the listed records
							            'plural'    => 'deallogs',    //plural name of the listed records
							            'ajax'      => false        //does this table support ajax?
							        ) );
		add_action( 'wps_deals_view_actions', array( $this, 'wps_deals_downloads_filter' ) );		
    }
    /**
	 * Displaying Prodcuts
	 *
	 * Does prepare the data for displaying the products in the table.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function display_deals_logs() {
	
		$prefix = WPS_DEALS_META_PREFIX;
		
		$logs_data = array();

		$paged    = $this->get_paged();
		
		$download = empty( $_GET['s'] ) ? $this->get_sorted_deals() : null;
		
		$log_query = array(
			'post_parent' => $download,
			'log_type'    => 'downloads',
			//'paged'       => $paged,
			'meta_query'  => $this->get_meta_query()
		);
		
		$logsdata = $this->logs->get_connected_logs( $log_query );
		
		if ( $logsdata ) {
			foreach ( $logsdata as $log ) {
				
				$user_info 	= get_post_meta( $log->ID, $prefix.'log_user_info', true );
				$payment_id = get_post_meta( $log->ID, $prefix.'log_payment_id', true );
				$ip 		= get_post_meta( $log->ID, $prefix.'log_ip', true );
				
				$user_id 	= isset( $user_info['id']) ? $user_info['id'] : 0;
				$user_data 	= get_userdata( $user_id );
				$files 		= $this->model->wps_deals_get_download_files( $log->post_parent );
				$file_id 	= (int) get_post_meta( $log->ID, $prefix.'log_file_id', true );
				$file_id 	= $file_id !== false ? $file_id : 0;
				$file_name 	= isset( $files[ $file_id ] ) ? $files[ $file_id ] : null;
				$date		= $this->model->wps_deals_get_date_format($log->post_date,true);

				if ( ( $this->file_search ) || ! $this->file_search ) { // && strpos( strtolower( $file_name ), strtolower( $this->get_search() ) ) !== false
					$logs_data[] = array(
											'ID' 		=> $log->ID,
											'deals'		=> $log->post_parent,
											'order_id'	=> $payment_id,
											'user_id'	=> $user_data ? $user_data->ID : $user_info['email'],
											'user_name'	=> $user_data ? $user_data->display_name : $user_info['email'],
											'file'		=> $file_name,
											'ipaddress'	=> $ip,
											'date'		=> $date
										);
				}
			}
		}
		
		return $logs_data;
	}
	
	/**
	 * Gets the meta query for the log query
	 *
	 * This is used to return log entries that match our search query, user query, or download query
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_meta_query() {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$user = $this->get_filtered_user();

		$meta_query = array();

		if ( $user ) {
			// Show only logs from a specific user
			$meta_query[] = array(
				'key'   => $prefix.'log_user_id',
				'value' => $user
			);
		}

		$search = $this->get_search();

		if ( $search ) {
			if ( filter_var( $search, FILTER_VALIDATE_IP ) ) {
				// This is an IP address search
				$key     = $prefix.'log_ip';
				$compare = '=';
			} else if ( is_email( $search ) ) {
				// This is an email search. We use this to ensure it works for guest users and logged-in users
				$key     = $prefix.'log_user_info';
				$compare = 'LIKE';
			} else {
				// Look for a user
				$key = $prefix.'log_user_id';
				$compare = 'LIKE';

				if ( ! is_numeric( $search ) ) {
					// Searching for user by username
					$user = get_user_by( 'login', $search );

					if ( $user ) {
						// Found one, set meta value to user's ID
						$search = $user->ID;
					} else {
						// No user found so let's do a real search query
						$users = new WP_User_Query( array(
							'search'         => $search,
							'search_columns' => array( 'user_url', 'user_nicename' ),
							'number'         => 1,
							'fields'         => 'ids'
						) );

						$found_user = $users->get_results();

						if ( $found_user ) {
							$search = $found_user[0];
						} else {
							// No users were found so let's look for file names instead
							$this->file_search = true;
						}
					}
				}
			}

			if ( ! $this->file_search ) {
				// Meta query only works for non file name searche
				$meta_query[] = array(
					'key'     => $key,
					'value'   => $search,
					'compare' => $compare
				);
			}
		}
		
		return $meta_query;
	}
	/**
	 * Sets up the downloads filter
	 *
	 * @access      private
	 * @since       1.4
	 * @return      void
	 */
	function wps_deals_downloads_filter() {
		
		$dealsdownload = get_posts( array(
											'post_type'      => WPS_DEALS_POST_TYPE,
											'post_status'    => 'any',
											'posts_per_page' => -1,
											'orderby'        => 'title',
											'order'          => 'ASC',
											'fields'         => 'ids',
											'update_post_meta_cache' => false,
											'update_post_term_cache' => false
										) 
									);
		
		if ( $dealsdownload ) {
			echo '<select name="deals" class="wps-deals-downloads-filter">';
				echo '<option value="0">' . __( 'All', 'wpsdeals'  ) . '</option>';
				foreach ( $dealsdownload as $deal ) {
					echo '<option value="' . $deal . '"' . selected( $deal, $this->get_sorted_deals() ) . '>' . esc_html( get_the_title( $deal ) ) . '</option>';
				}
			echo '</select>';
		}
	}
	
	/**
	 * Retrieve the current page number
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_paged() {
		return isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : '1';
	}
	
	/**
	 * Retrieves the ID of the download we're filtering logs by
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_sorted_deals() {
		return ! empty( $_GET['deals'] ) ? absint( $_GET['deals'] ) : false;
	}
	
	/**
	 * Retrieves the search query string
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_search() {
		return ! empty( $_GET['s'] ) ? urldecode( trim( $_GET['s'] ) ) : false;
	}
	
	/**
	 * Retrieves the user we are filtering logs by, if any
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function get_filtered_user() {
		return isset( $_GET['user_id'] ) ? absint( $_GET['user_id'] ) : false;
	}
	/**
	 * 
	 * Default Column for downloads list table
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	function column_default( $item, $column_name ){
		
        switch ( $column_name ){
			case 'deals' :
				return '<a href="' . add_query_arg( 'deals', $item[ $column_name ] ) . '" >' . get_the_title( $item[ $column_name ] ) . '</a>';
			case 'user_id' :
				return '<a href="' . add_query_arg( 'user_id', $item[ $column_name ] ) . '">' . $item[ 'user_name' ] . '</a>';
			default:
				$default_value = isset( $item[ $column_name ] ) ? $item[ $column_name ] : '';
    			return apply_filters( 'wps_deals_download_logs_column_value', $default_value, $item, $column_name );				
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
        						'ID'			=>	__(	'Log ID', 'wpsdeals' ),
        						'deals'			=>	__( 'Social Deal', 'wpsdeals' ),
        						'user_id'		=>	__( 'User', 'wpsdeals' ),
        						'order_id'		=>	__( 'Order ID', 'wpsdeals' ),
        						'file'			=>	__( 'File', 'wpsdeals' ),
        						'ipaddress'		=>	__( 'IP Address', 'wpsdeals' ),
        						'date'			=>	__(	'Date', 'wpsdeals' )
					     );
        return apply_filters( 'wps_deals_downloads_logs_column', $columns );
    }
    /**
	 * Outputs the log filters filter
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function bulk_actions() {
		// These aren't really bulk actions but this outputs the markup in the right place
		wps_deals_log_views();
	}
   /**
     * Sortable Columns
     *
     * Handles soratable columns of the table
     * 
	 * @package Social Deals Engine
	 * @since 1.0.0
     */
	/* function get_sortable_columns() {
		
        $sortable_columns = array(
        								
							      );
        return apply_filters('wps_deals_downloads_logs_sortable_column',$sortable_columns);
    }*/
    
    function no_items() {
		//message to show when no records in database table
		_e( 'No download logs found.', 'wpsdeals' );
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
		$data = $this->display_deals_logs();
		
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

$logs_table = new Wps_Deals_Downloads_Logs_List();
$logs_table->prepare_items();

?>
<div class="wrap wps-deals-form">
	<?php 
			//add something befoer downloads logs
			do_action( 'wps_deals_logs_downloads_before' ); 
	?>
	
	<form id="wps-deals-logs-filter" method="GET" action="edit.php" class="wps-deals-form">
		<input type="hidden" name="post_type" value="<?php echo WPS_DEALS_POST_TYPE;?>" />
		<input type="hidden" name="page" value="wps-deals-reports" />
		<input type="hidden" name="tab" value="logs" />
		<?php
			//add something before download logs list before
			do_action( 'wps_deals_download_logs_list_before' );
			
			//display search box
			$logs_table->search_box( __( 'Search', 'wpsdeals' ), 'wps-deals-downloads-logs' );
			
			//add something before search box
			do_action( 'wps_deals_download_logs_search_after' );
			
			//display log data
			$logs_table->display();
			
			//add something after listing table
			do_action( 'wps_deals_download_logs_list_after' );
		?>
	</form>
	<?php 
			//add something after downloads logs
			do_action( 'wps_deals_logs_downloads_after' ); 
	?>
</div>