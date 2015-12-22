<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortcodes Class
 *
 * Handles shortcodes functionality of plugin
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Shortcodes {
	
	public $model,$scripts,$render,$cart,$currency,$message,$session;
	
	function __construct(){
		
		global $wps_deals_model,$wps_deals_scripts,$wps_deals_render,$wps_deals_cart,
				$wps_deals_currency,$wps_deals_message,$wps_deals_session;
		
		$this->model	= $wps_deals_model;
		$this->scripts	= $wps_deals_scripts;
		$this->render	= $wps_deals_render;
		$this->cart		= $wps_deals_cart;
		$this->currency = $wps_deals_currency;
		$this->message	= $wps_deals_message;
		$this->session	= $wps_deals_session;
	}
	
	/**
	 * Get All Deals Data
	 * 
	 * Handles to getting all deals data on the viewing page
	 * whereever user put shortcode
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0 
	 */
	public function wps_deals_all( $content ) {
				
		ob_start();
		
		echo do_shortcode('[wps_home_deals]');
		echo do_shortcode('[wps_deals_by_status active="true" ending_sooon="true" upcoming="true"]');
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Get Home Page Deals Data
	 * 
	 * Handles to getting all deals data on the viewing page
	 * whereever user put shortcode
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0 
	 */
	public function wps_home_deals( $atts, $content) {
						
		global $wps_deals_options;

		// get deal size
		$deal_size = $wps_deals_options['deals_size'];
		
		
		// Getting attributes of shortcode
		extract( shortcode_atts( array(	
	    	'num_deals'		=> 1,
		), $atts ) );
		
		$args = array(
				'num_deals' => $num_deals,
			);
	
		$args = apply_filters( 'wps_home_deals', $args );
		
		ob_start();
		?>
		<div class="deals-container deals-clearfix">
			<div class="deals-home <?php echo $deal_size; ?>">
				<?php do_action( 'wps_deals_home_header_shortcode', $args ); ?>
			</div>
		</div>
		<?php $content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Get Deals Data by Status
	 * 
	 * Handles Deals Data by Status Like
	 * Active, Ending Soon and Upcoming
	 * 
	 * @package Social Deals Engine
	 * @since 2.1.6
	 */
	public function wps_deals_by_status( $atts, $content ) {
		
		global $wps_deals_options;
	
		// get deal size
		$deal_size = $wps_deals_options['deals_size'];
		
		// shortcode attributes
		extract( shortcode_atts( array(	
	    	'active'		=> false,
	    	'ending_sooon'	=> false,
	    	'upcoming'		=> false
		), $atts ) );
		
		$deals_status_data = '';
		if ( $active == 'true' ) {
			
			$deals_status_data[] = 'active';
		} 
		if ( $ending_sooon  == 'true' ) {
			
			$deals_status_data[] = 'ending-soon';
		}
		if ( $upcoming  == 'true' ) {
			
			$deals_status_data[] = 'upcoming';
		}
		
		$deals_status = !empty( $deals_status_data ) ? implode( ',',$deals_status_data ) : ' ';
		
		ob_start();
		?>
		<div class="deals-container deals-clearfix">
			<div class="deals-home <?php echo $deal_size; ?>">
				<?php do_action( 'wps_deals_home_content_shortcode', $deals_status ); ?>
			</div>
		</div>
		<?php $content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Checkout Page
	 * 
	 * Handles to show details of cart to user
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_checkout($content) {
		
		global $wp;
		
		ob_start();
		
		
		
		//if query vars is social deals thankyou page
		if(isset($wp->query_vars['social-deals-thank-you-page'])) {
			
			//load thank you page
			wps_deals_get_template( 'order-complete.php' );
		} 
		
		//if query vars is social deals cancel page
		else if(isset($wp->query_vars['social-deals-cancel-page'])) {
			
			//load cancel page
			wps_deals_get_template( 'order-cancel.php' );
		}
		
		else { // social deals checkout page
			
			//do action for add checkout page
			echo '<div class="wps-deals-cart-wrap">';
			do_action( 'wps_deals_checkout_content' );
			echo '</div>';	
		}
		
		$content .= ob_get_clean();
		return $content;
	}
	
	/**
	 * Order Completed
	 * 
	 * Handles to show messsage order is completed successfully
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_order_complete( $content ) {
		
		ob_start();
		
		wps_deals_get_template( 'order-complete.php' );
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Order Cancelled
	 * 
	 * Handles to show messsage order will cancelled
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_order_cancelled( $content ) {
		
		ob_start();
		
		wps_deals_get_template( 'order-cancel.php' );
		
		$content .= ob_get_clean();
		
		return $content;	
	}
	
	/**
	 * Orders Details
	 * 
	 * Handles to show details of orders placed by users
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_orders( $content ) {
		
		ob_start();

		wps_deals_get_template( 'ordered-deals.php' );
		
		$content .= ob_get_clean();

		return $content;
	}
	
	
	/**
	 * Deals By Category
	 * 
	 * Handles to show deals by category
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_by_category( $atts, $content ) {
		
		global $wps_deals_by_category_shortcode_atts;
		
		extract( shortcode_atts( array(	
	    	'category'	=>	''
		), $atts ) );
		
		ob_start();
		
		// assign shortcode attributes to global variable so we can access shortcode attributes when
		// ajax pagination is called
		$wps_deals_by_category_shortcode_atts['category'] = $category;
		
		//do action to load home content by category
		do_action( 'wps_deals_home_content_shortcode', $category );
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Show All Social Login Buttons
	 * 
	 * Handles to show all social login buttons on the viewing page
	 * whereever user put shortcode
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.1
	 */
	public function wps_deals_social_login( $atts, $content ) {
		
		global $wps_deals_options;
		
		extract( shortcode_atts( array(	
			'title'			=>	'',
	    	'redirect_url'	=>	''
		), $atts ) );
		
		if( !is_home() && is_singular() ) {
		
			//check user is not logged in and social login is enable or not for any one service
			if( !is_user_logged_in() && wps_deals_enable_social_login() ) {
				
				// get redirect url from settings
				$defaulturl = isset( $wps_deals_options['login_redirect_url'] ) && !empty( $wps_deals_options['login_redirect_url'] ) 
									? $wps_deals_options['login_redirect_url'] : wps_deals_get_current_page_url();
				
				//redirect url for shortcode
				$defaulturl = isset( $redirect_url ) && !empty( $redirect_url ) ? $redirect_url : $defaulturl; 
				
				//session create for redirect url
				$this->session->set( 'wps_deals_stcd_redirect_url', $defaulturl );
				
				ob_start();
				//do action to add social login buttons
				do_action( 'wps_deals_social_login_shortcode', $title, $redirect_url );
				$content .= ob_get_clean();
			}
		}
		
		return $content;
	}
	
	/**
	 * Get Single Deal Data
	 * 
	 * Handles to getting single deal data on the viewing page
	 * whereever user put shortcode
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0 
	 */	
	public function wps_deals_single( $atts, $content ) {
		
		global $post, $wps_deals_options;
		
		// get the size for the design from the settings page
		$size = $wps_deals_options['deals_size'];
		
		extract( shortcode_atts( array(	
			'id'	=>	'',
		), $atts ) );
		
		if( !empty( $id ) ) { // Check deal id is not empty from shortcode
			
			ob_start();
			
			// get the size
			$deal_size = isset( $wps_deals_options['deals_size_single'] ) ? $wps_deals_options['deals_size_single'] : '';

			// Add query for display single deal wherever user put single deal id in shortcode
			$args = array( 'post_type' => WPS_DEALS_POST_TYPE, 'post__in' => array( $id ), 'posts_per_page' => '1' );
			
			// The Query
			$the_query = new WP_Query( $args );
		
			// The Loop
			if ( $the_query->have_posts() ) {
				
				while ( $the_query->have_posts() ) {
					
					$the_query->the_post();
					
					$prefix = WPS_DEALS_META_PREFIX;

					//today's date time
					$today	= wps_deals_current_date();
							
					// get the end date & time
					$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
					
					// get the value for the amount of available deals
					$available = get_post_meta( $post->ID, $prefix . 'avail_total', true );
					
					$expired = '';
					
					if( ( !empty( $enddate ) && $enddate <= $today ) || $available == '0' ) {
						$expired = ' deal-expired';
					}
						
					//do action to add localize script for individual post data
					do_action( 'wps_deals_localize_map_script' );
					
					//do action to add in top of single page
					do_action( 'wps_deals_single_top' );
						
					/**
					 * wps_deals_before_single_deal_content hook
					 */
					do_action( 'wps_deals_before_single_deal_content' );
						
					?>
					<div class=" <?php echo $deal_size; ?>">
						
						<div class="deals-container deals-clearfix">
					
							<div id="sde" class="deals-single deals-row<?php echo $expired; ?>">
											
								<?php 
									/**
									 * wps_deals_single_header_content hook
									 *
									 * @hooked wps_deals_breadcrumbs - 5
									 * @hooked wps_deals_single_header_message - 10
									 * @hooked wps_deals_single_header_title - 20
									 * @hooked wps_deals_single_header_left - 30
									 * @hooked wps_deals_single_header_right - 35
									 */
									do_action( 'wps_deals_single_header_content' );
								?>
																
							</div>
							
							<?php
								/**
								 * wps_deals_single_content hook
								 *
								 * @hooked wps_deals_single_description - 10
								 * @hooked wps_deals_single_business_info - 20
								 * @hooked wps_deals_single_terms_conditions - 30
								 */
								do_action( 'wps_deals_single_content' );
								
								/**
								 * wps_deals_single_content hook
								 *
								 * @hooked wps_deals_single_description - 10
								 * @hooked wps_deals_single_business_info - 20
								 * @hooked wps_deals_single_terms_conditions - 30
								 */
								do_action( 'wps_deals_single_footer_content' );
							?>
						</div>

					</div><!-- .deal size -->											
						<?php
							/**
							 * wps_deals_after_single_deal_content hook
							 */
							do_action( 'wps_deals_after_single_deal_content' );
						?>

						<meta itemprop="url" content="<?php the_permalink(); ?>" />								
						
					<?php
				}
				wp_reset_query();
			}
			
			$content .= ob_get_clean();
			
		}
		return $content;
	}
	
	/**
	 * Get Multiple Deal Data
	 * 
	 * Handles to getting multiple deal data on the viewing page
	 * whereever user put shortcode
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0 
	 */
	public function wps_deals_multiple( $atts, $content ) {
		
		ob_start();
		
		$this->render->wps_deals_multiple_deals( $atts );
		
		$content .= ob_get_clean();
		
		return $content;		
	}
	
	/**
	 * My Account Page
	 * 
	 * Handles to show my account page for
	 * deals
	 * 
	 * @package Social Deals engine
	 * @since 1.0.0
	 **/
	public function wps_deals_my_account( $atts, $content ) {

		global $wp , $wps_deals_options;				
		 
		ob_start();
		
		if ( ! is_user_logged_in() ) { //if user is not logged in
			
			//if query vars is lost password
			if( isset($wp->query_vars['lost-password']) ) {
			
				//load lost password page
				wps_deals_get_template( 'lost-password.php' );
				
			}
			
			//if query var is create an account
			else if( isset($wp->query_vars['create-an-account']) ) {
				
				//load create an account page
				wps_deals_get_template( 'create-account.php' );	
			} 
						
			else {

				wps_deals_get_template( 'my-account.php' );

			}
			
		} else { //if user is logged in
			
			if( isset($wp->query_vars['edit-account'] ) ) {
				
				//load change password page
				wps_deals_get_template( 'change-password.php' );
								
			} 
					
			//if query vars is edit address
			else if( isset($wp->query_vars['edit-address']) ) {
				
				//load edit address page
				wps_deals_get_template( 'edit-address.php' );
			}

			//if query vars is view orders
			else if( isset($wp->query_vars['view-orders']) ) {
				
				//load ordered deals page
				wps_deals_get_template( 'ordered-deals.php' );
			}		
			
			else {
				
				//load my account page
				wps_deals_get_template( 'my-account.php' );	
			}
		}		
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Create an Account Page
	 * 
	 * Handles to show create an account page for
	 * deals
	 * 
	 * @package Social Deals engine
	 * @since 1.0.0
	 **/
	public function wps_deals_create_account( $atts, $content ) {

		ob_start();
		
		wps_deals_get_template( 'create-account.php' );
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Edit Address Page
	 * 
	 * Handles to edit my address page for
	 * deals
	 * 
	 * @package Social Deals engine
	 * @since 1.0.0
	 **/
	public function wps_deals_edit_address( $atts, $content ) {

		ob_start();
		
		wps_deals_get_template( 'edit-address.php' );
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Change Password Page
	 * 
	 * Handles to change password page for
	 * deals
	 * 
	 * @package Social Deals engine
	 * @since 1.0.0
	 **/
	public function wps_deals_change_password( $atts, $content ) {

		ob_start();
		
		wps_deals_get_template( 'change-password.php' );
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Lost Password Page
	 * 
	 * Handles to lost password page for
	 * deals
	 * 
	 * @package Social Deals engine
	 * @since 1.0.0
	 **/
	public function wps_deals_lost_password( $atts, $content ) {

		ob_start();

		wps_deals_get_template( 'lost-password.php' );
		
		$content .= ob_get_clean();
		
		return $content;
	}
	
	/**
	 * Adding Hooks
	 *
	 * Adding proper hoocks for the shortcodes.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		//add shortcode to show list of deals on the page
		add_shortcode( 'wps_deals', array( $this, 'wps_deals_all' ) );
		
		//add shortcode to show list of home deals on the page
		add_shortcode( 'wps_home_deals', array( $this, 'wps_home_deals' ) );
		
		//add shortcode to show list of deals by status on the page
		add_shortcode( 'wps_deals_by_status', array( $this, 'wps_deals_by_status' ) );
		
		//add shortcode for showing shopping cart details
		add_shortcode( 'wps_deals_checkout', array( $this, 'wps_deals_checkout' ) );
		
		// Commented because now we have removed pages and shortcodes
		//add shortcode for order complete
		//add_shortcode( 'wps_deals_order_complete', array( $this, 'wps_deals_order_complete' ) );
		
		//add shortcode for order cancelled
		//add_shortcode( 'wps_deals_order_cancel', array( $this, 'wps_deals_order_cancelled' ) );
		 		
		//add shortcode for order details
		//add_shortcode( 'wps_deals_orders', array( $this, 'wps_deals_orders' ) );
		
		//add shortcode to show list of deals on the page/post by category
		add_shortcode( 'wps_deals_by_category', array( $this, 'wps_deals_by_category' ) );
		
		//add shortcode to show all social login buttons
		add_shortcode( 'wps_deals_social_login', array( $this, 'wps_deals_social_login' ) );
		
		//add shortcode to show single deal on the shortcode page
		add_shortcode( 'wps_deals_by_id', array( $this, 'wps_deals_single' ) );
		
		//add shortcode to show multiple deal on the shortcode page
		add_shortcode( 'wps_deals_by_ids', array( $this, 'wps_deals_multiple' ) );
		
		//add shortcode to show my account on the shortcode page
		add_shortcode( 'wps_deals_my_account', array( $this, 'wps_deals_my_account' ) );
		
		// Commented because now we have removed pages and shortcodes
		/*//add shortcode to show create an account on the shortcode page
		add_shortcode( 'wps_deals_create_account', array( $this, 'wps_deals_create_account' ) );
		
		//add shortcode to edit my address on the shortcode page
		add_shortcode( 'wps_deals_edit_address', array( $this, 'wps_deals_edit_address' ) );
		
		//add shortcode to change password on the shortcode page
		add_shortcode( 'wps_deals_change_password', array( $this, 'wps_deals_change_password' ) );
		
		//add shortcode to lost password on the shortcode page
		add_shortcode( 'wps_deals_lost_password', array( $this, 'wps_deals_lost_password' ) );	*/	
	}
}