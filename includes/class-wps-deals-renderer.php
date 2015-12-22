<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Renderer Class
 *
 * To handles some small HTML content for front end
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
class Wps_Deals_Renderer {

	public $model,$scripts,$currency,$cart,$price,$message;
	
	public function __construct() {
		
		global $wps_deals_model,$wps_deals_scripts,$wps_deals_currency,$wps_deals_cart,$wps_deals_price,$wps_deals_message;
		
		$this->model 	= $wps_deals_model;
		$this->scripts	= $wps_deals_scripts;
		$this->currency	= $wps_deals_currency;
		$this->cart		= $wps_deals_cart;
		$this->price	= $wps_deals_price;
		$this->message	= $wps_deals_message;		
	}
	
	/**
	 * Show Deals List
	 * 
	 * Handles to return list of deals for custom post type
	 *
	 * @package Social Deals Engine
     * @since 1.0.0
	 */
		
	/**
	 * Empty Cart Message
	 *
	 * This will return Empty cart message
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_empty_cart_message() {
	
		return apply_filters( 'wps_deals_empty_cart_message', '<div class="deals-col-12"><div class="deals-message deals-error">' . __( 'Your cart is empty.', 'wpsdeals' ).'</div></div>' );
	}
	
	/**
	 * Get Order detail popup details
	 * 
	 * Handles to get popup view order details
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_order_popup_details($data){
		
		ob_start();
		
		$displayusername = isset($data['userdetails']['first_name']) && !empty($data['userdetails']['first_name']) 
							? $data['userdetails']['first_name'].' '.$data['userdetails']['last_name'] : $data['userdetails']['user_name'];
		
		echo '<div id="wps_deal_ordered_'.$data['ID'].'" class="wps-deals-view-details-wrap">
								<div class="wps-deal-bill-title">'.__('Billing Details','wpsdeals').'</div>';
									
		echo  '<div class="wps-deals-view-bill-details">
							<table>
								<tbody>';
									do_action('wps_deals_sales_admin_header_row_before',$data['ID']);
		echo '						<tr>
										<td><strong>'.__('Purchase Date :','wpsdeals').'</strong></td>
										<td>'.$this->model->wps_deals_get_date_format($data[ 'post_date' ]).'</td>
									</tr>
									<tr>
										<td><strong>'.__('Purchase ID :','wpsdeals').'</strong></td>
										<td>'.$data['ID'].'</td>
									</tr>
									<tr>
										<td><strong>'.__('Buyer Name :','wpsdeals').'</strong></td>
										<td>'.$displayusername.'</td>
									</tr>
									<tr>
										<td><strong>'.__('Buyer Email :','wpsdeals').'</strong></td>
										<td>'.$data['userdetails']['user_email'].'</td>
									</tr>
									<tr>
										<td><strong>'.__('Payment Method :','wpsdeals').'</strong></td>
										<td>'.$data['payment_method'].'</td>
									</tr>
									<tr>
										<td><strong>'.__('Payment Status :','wpsdeals').'</strong></td>
										<td>'.$data['payment_status'].'</td>
									</tr>
									<tr>
										<td><strong>'.__('IP Address :','wpsdeals').'</strong></td>
										<td>'.$data['order_ip'].'</td>
									</tr>';
									do_action('wps_deals_sales_admin_header_row_after',$data['ID']);
		echo '					</tbody>
							</table>
						</div>';
		
		//do action to add some content before billing details
		do_action( 'wps_deals_sales_paymentdetails_before_billing', $data['ID'] );
		
		echo '		<div class="wps-deals-view-bill-details-wrap order-view-bill-details-left">';
		
		//billing details
		$billingdetails		= isset( $data['billing_details'] ) && !empty( $data['billing_details'] ) ? $data['billing_details'] : array() ;
		
		//check billing details is not empty
		if( !empty( $billingdetails ) ) {
		
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
			$billingpostcode		= isset( $billingdetails['postcode'] ) ? $billingdetails['postcode'] : '';
			//billing phone
			$billingphone		= isset( $billingdetails['phone'] ) ? $billingdetails['phone'] : '';
		
			echo '		<div class="wps-deals-view-bill-details order-view-bill-details">';
			
			echo '			<h3>'.__( 'Billing Details','wpsdeals' ).'</h3>
							<table>
								<tbody>';
							echo '<tr>
									<td><strong>'.__( 'Address :','wpsdeals' ).'</strong></td>
									<td>'.$billingaddress1.'<br />'.
											$billingaddress2.
									'</td>
								</tr>';
									
									//do action to add content after billing address
									do_action( 'wps_deals_order_view_billing_address_after', $data['ID'] );
							
							echo '<tr>
									<td><strong>'.__( 'Company Name :','wpsdeals' ).'</strong></td>
									<td>'.$billingcompany.'</td>
								</tr>';
							
									//do action to add content after billing company name
									do_action( 'wps_deals_order_view_billing_company_after', $data['ID'] );
							
							echo '<tr>
									<td><strong>'.__( 'Town / City :','wpsdeals').'</strong></td>
									<td>'.$billingcity.'</td>
								</tr>';
							
									//do action to add content after billing city
									do_action( 'wps_deals_order_view_billing_city_after', $data['ID'] );
							
							echo '<tr>
									<td><strong>'.__( 'County / State :','wpsdeals' ).'</strong></td>
									<td>'.$billingstate.'</td>
								</tr>';
								
									//do action to add content after billing county / state
									do_action( 'wps_deals_order_view_billing_county_after', $data['ID'] );
							
							echo '<tr>
									<td><strong>'.__( 'Zip / Postal Code :','wpsdeals').'</strong></td>
									<td>'.$billingpostcode.'</td>
								</tr>';
									
									//do action to add content after billing postcode
									do_action( 'wps_deals_order_view_billing_postcode_after', $data['ID'] );
									
							echo '<tr>
									<td><strong>'.__( 'Country :','wpsdeals' ).'</strong></td>
									<td>'.$billingcountry.'</td>
								</tr>';
									//do action to add content after billing country
									do_action( 'wps_deals_order_view_billing_country_after', $data['ID'] );
							
							echo '<tr>
									<td><strong>'.__( 'Phone :','wpsdeals').'</strong></td>
									<td>'.$billingphone.'</td>
								</tr>';
									//do action to add content after billing details after
									do_action( 'wps_deals_order_view_billing_after', $data['ID'] );
			echo '				</tbody>
							</table>
						</div><!--.wps-deals-view-bill-details-->';
			
		}
		
			//do action to add some content after billing details
			do_action( 'wps_deals_sales_paymentdetails_after_billing', $data['ID'] );
		
		echo '</div><!--.wps-deals-view-bill-details-wrap-->';
		
		//do action to add some content after billing details
		do_action( 'wps_deals_sales_paymentdetails_after_billing_content', $data['ID'] );
		
		if( $data['payment_method'] == __( 'PayPal Standard', 'wpsdeals' ) || $data['payment_method'] == 'paypal' ) { //check payment method
			
			echo '<div class="wps-deals-view-paypal-details">
					<img src="'.WPS_DEALS_URL.'includes/images/paypal_logo.gif" />
					<table class="wps-deals-view-paypal-txns" cellspacing="1" cellpadding="1" border="0">
						<tbody>
							<tr>
								<td class="wps-deals-txn-activity" colspan="7">'.__('Transaction Activity','wpsdeals').'</td>
							</tr>
							<tr class="wps-deals-txn-title">
								<td nowrap="nowrap">'.__('Date','wpsdeals').'</td>
								<td nowrap="nowrap">'.__('Name','wpsdeals').'</td>
								<td nowrap="nowrap">'.__('Payer Email','wpsdeals').'</td>
								<td nowrap="nowrap">'.__('Payment Status','wpsdeals').'</td>
								<td nowrap="nowrap">'.__('Gross','wpsdeals').'</td>
								<td nowrap="nowrap">'.__('Fee','wpsdeals').'</td>
								<td nowrap="nowrap">'.__('Net Amount','wpsdeals').'</td>
							</tr>';
							
							// get the value for the order ipn data from the post meta box
							$paypal_data = $data['ipndata'];
							
							if( !empty( $paypal_data ) ) {
								
								$pay_gross			= !empty( $paypal_data['mc_gross'] ) ? number_format( $paypal_data['mc_gross'], 2 ) : '0';
								$pay_fees			= !empty( $paypal_data['mc_fee'] ) ? number_format( $paypal_data['mc_fee'], 2 ) : '0';
								$net_amount			= number_format( ( $pay_gross - $pay_fees), 2 );
								$payment_date		= $this->model->wps_deals_get_date_format( $paypal_data['payment_date'] );
								$payment_currency	= isset( $paypal_data['mc_currency'] ) ? $paypal_data['mc_currency'] : '';
								
								$first_name			= isset( $paypal_data['first_name'] ) ? $paypal_data['first_name'] : '';
								$last_name			= isset( $paypal_data['last_name'] ) ? $paypal_data['last_name'] : '';
								$payer_email		= isset( $paypal_data['payer_email'] ) ? $paypal_data['payer_email'] : '';
								$payment_status		= isset( $paypal_data['payment_status'] ) ? $paypal_data['payment_status'] : '';
								
								echo '<tr class="wps-deals-txn-detail">
										<td nowrap="nowrap">'.$payment_date.'</td>
										<td nowrap="nowrap">'.$first_name.' '.$last_name.'</td>
										<td nowrap="nowrap">'.$payer_email.'</td>
										<td nowrap="nowrap">'.$payment_status.'</td>
										<td nowrap="nowrap">'.$this->currency->wps_deals_currency_symbol($payment_currency).' '.$pay_gross.'</td>
										<td nowrap="nowrap">'.$this->currency->wps_deals_currency_symbol($payment_currency).' '.$pay_fees.'</td>
										<td nowrap="nowrap">'.$this->currency->wps_deals_currency_symbol($payment_currency).' '.$net_amount.'</td>
									</tr>';
							} else {
								
								echo '<tr class="wps-deals-txn-detail">
												<td colspan="7">'.__('No PayPal Transaction Information Available','wpsdeals').'</td>
										  </tr>';
							}
							
			echo '		</tbody>
					</table>
				</div><!--wps-deals-view-paypal-details-->';
		}
		
		//add some content before payment details
		do_action('wps_deals_sales_paymentdetails_before_items',$data['ID']);
		
		echo '<div class="wps-deals-view-product-details">
					<div class="wps-deal-bill-title">'.__('Item Ordered','wpsdeals').'</div>
						<table class="widefat fixed">
							<tbody>
								<thead>
									<tr>';
										do_action('wps_deals_sales_order_deatails_header_before',$data['ID']);
							   echo    '<th>'.__('Name','wpsdeals').'</th>
										<th>'.__('Quantity','wpsdeals').'</th>
										<th>'.__('Price','wpsdeals').'</th>
										<th>'.__('Total','wpsdeals').'</th>';
							   			do_action('wps_deals_sales_order_deatail_header_after',$data['ID']);
								echo '</tr>
								</thead>';
					$alternate = '';
					
					foreach ( $data['deals_details'] as $deal ) {
						
						echo '<tr '.$alternate.'>';
								
								do_action('wps_deals_sales_order_details_data_before',$data['ID']);
								
								echo '<td>'.get_the_title($deal['deal_id']).'</td>
									
									<td>'.$deal['deal_quantity'].'</td>
									
									<td>'.$deal['display_price'].'</td>
									
									<td>'.$deal['display_total'].'</td>';
								
								do_action('wps_deals_sales_order_details_data_after',$data['ID']);	
								
						echo '</tr>';
						$alternate = $alternate ? '' : 'class="alternate"';
					}
					
					do_action('wps_deals_sales_popup_order_row_after',$data['ID']);
					
					echo '<tr class="alternate">
							
							<td colspan="2"></td>
							
							<td>'.__('Sub Total','wpsdeals').'</td>
							
							<td>'.$data['display_order_subtotal'].'</td>
							
						</tr>';
					
					do_action('wps_deals_sales_popup_order_row_after_subtotal',$data['ID']);
					
					//check fees is set in order data and not empty
					if( isset( $data['fees'] ) && !empty( $data['fees'] ) ) {
						
						foreach ( $data['fees'] as $fee_key => $fee_val ) {
							
							echo '<tr>
									<td colspan="2"></td>
									<td>'.$fee_val['label'].'</td>
								  	<td>'.$fee_val['display_amount'].'</td>
								  </tr>';
							
						} //end foreach loop
						
					} //end if to check there is fees is exist in order or not
					
					//do action to add something in backed order popup details after fees row
					do_action('wps_deals_sales_popup_order_row_after_fees',$data['ID']);
					
					echo '<tr class="alternate">
											
							<td colspan="2"></td>
							
							<td>'.__('Total','wpsdeals').'</td>
							
							<td>'.$data['display_order_total'].'</td>
							
						</tr>';
										
		echo '		</tbody>
				</table>';
					
		echo '	</div><!--wps-deals-view-product-details-->';
		
				//add some content after payment details
				do_action('wps_deals_sales_paymentdetails_after_items',$data['ID']);
						
		echo '		</div><!--.wps-deals-view-details-wrap-->';
		return ob_get_clean();
	}
	
	/**
	 * Cart Widget Content
	 * 
	 * Handles to get cart widget content
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 *
	 */
	public function wps_deals_cart_widget_content() {
		
		global $wps_deals_options;
		
		$cartdata = $this->cart->get();
		$cartproducts = $cartdata['products'];
		
		// get the color scheme from the settings
		$button_color = isset( $wps_deals_options['deals_btn_color'] ) ? $wps_deals_options['deals_btn_color'] : '';
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		$html = '';
		
		if( !empty( $cartproducts ) ) {
				
				$html .= '<ul class="wps-deals-latest-widget-cart-items table">';
				
				foreach( $cartproducts as $id => $deal ) {
					
					$dealprice = $this->price->wps_deals_get_price( $deal['dealid'] );
					$dealimage = get_the_post_thumbnail( $deal['dealid'], array( 100,100 ) );
					
					$html .= '<li>';					
					
					$html = 	apply_filters('wps_deals_latest_widget_data_before',$html);						
					$html .= '<a href="javascript:void(0);" class="deals-cart-item-remove-widget" title="'.__( 'Remove Item', 'wpsdeals' ).'" item-id="'.$deal['dealid'].'">' ;
					$html .= '<img src="' . WPS_DEALS_URL . 'includes/images/cross.gif" alt="'.__( 'Remove', 'wpsdeals' ).'"/></a>';
					$html .= '<a href="' . get_permalink( $deal['dealid'] ) . '">' . $dealimage . get_the_title( $deal['dealid'] ) . '</a>';
					$html .= '<span class="quantity">' . $deal['quantity'] . ' x <span class="amount">' . $this->price->get_display_price( $dealprice, $deal['dealid'] ) . '</span></span>';
					$html = 	apply_filters('wps_deals_latest_widget_data_before',$html);	
					$html .= '</li>';
				}
				
				$html .= '</ul>';
				
				$html .= '<p class="total">';
				$html = 	apply_filters( 'wps_deals_latest_widget_total_before', $html );	
				$html .= '	<strong>' . __( 'Subtotal:', 'wpsdeals' ) . '</strong>';
				$html .= '	<span class="amount">' . $this->currency->wps_deals_formatted_value( $cartdata['subtotal'] ) . '</span>';
				$html = 	apply_filters( 'wps_deals_latest_widget_total_after', $html );
				$html .= '</p>';
				
			} else {
				
				ob_start();
				$html .='<div class="deals-empty-cart"><div class="deals-message deals-error empty-cart-msg">';
				$html .= '<span>Your cart is empty.</span></div></div>';				
				$html .= ob_get_clean();							
			}
			
			//Get checkout page ID
			$payment_checkout_page	= isset( $wps_deals_options['payment_checkout_page'] ) ? $wps_deals_options['payment_checkout_page'] : '';
			
			// checkout link
			$html .= '	<div class="wps-deals-widget-shopping-link">
							<a href="' . get_permalink( $payment_checkout_page ) . '" class="' . $btncolor . ' deals-button btn-small deals-widget-view-cart">' . __( 'Checkout &rarr;', 'wpsdeals' ) . '</a>
						</div>';
			return $html;
	}
	
	/**
	 * Add Issue Refund Button
	 * 
	 * Handles to add refund button
	 * for paypal payment
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_paypal_refund_issue_button( $orderid ) {
		
		$orderdata = $this->model->wps_deals_get_post_meta_ordered( $orderid );
		$payment_status = $this->model->wps_deals_get_ordered_payment_status( $orderid, true );
		
		if( current_user_can( 'manage_options' ) && $payment_status == '1' &&
			( $orderdata['payment_method'] == __( 'PayPal Standard','wpsdeals') || $orderdata['payment_method'] == 'paypal' ) ) { //if status is completed and payment gateway is paypal standard
			
			$refundurl = add_query_arg( array( 'page' => 'wps-deals-sales', 'action' => 'refund', 'orderid' => $orderid ), admin_url( 'edit.php?post_type='.WPS_DEALS_POST_TYPE ) );
		
			echo '<a href="'.$refundurl.'" class="button-primary wps-deals-issue-refund" title="'.__( 'Issue Refund', 'wpsdeals' ).'">'.__( 'Issue Refund', 'wpsdeals' ).'</a>';
				
		} 
	}
	
	/**
	 * Display Multiple Deals from shortcode
	 * 
	 * Handles to display multiple deals from shortcode
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_multiple_deals( $atts ) {
		
		global $post, $wps_deals_options;
		
		extract( shortcode_atts( array(	
			'ids' => '',
			'disable_price' => '',
			'disable_timer' => '',
		), $atts ) );
				
		$html = '';
		
		if( !empty( $ids ) ) { // Check ids are not empty
		
			$ids = explode( ',', $ids );
			
			$prefix = WPS_DEALS_META_PREFIX;
			
			//current date and time
			$today = wps_deals_current_date('Y-m-d H:i:s');
			
			/* all active deals listing start */
			$dealsmetaquery = array( 
									
									array(		
												'key' => $prefix.'start_date',
												'value' => $today,
												'compare' => '<=',
												'type' => 'STRING'
										),
									array(
												'key' => $prefix.'end_date',
												'value' => $today,
												'compare' => '>=',
												'type' => 'STRING'
										)
								 );
			
			$argssrcd = array( 'post_type' => WPS_DEALS_POST_TYPE, 'post__in' => $ids, 'meta_query' => $dealsmetaquery, 'posts_per_page' => '-1' );
									
			ob_start();
			
			//active deals template
			wps_deals_get_template( 'home-deals/more-deals/more-deals.php', array( 'args' => $argssrcd, 'tab' => '', 'options' => array( 'disable_price' => $disable_price, 'disable_timer' => $disable_timer ) ) );
			
			$html .= ob_get_clean();
		
		}
		echo $html;
	}
	
	/**
	 * Deals Sales Contextual help
	 * 
	 * Add contextual help on deals sales page
	 * 
	 * @package Social Deals Engine
	 * @since 2.1.6
	 */
	function wps_deals_sales_contextual_help() {
	
		$screen = get_current_screen();
		
		if ( $screen->id != 'wpsdeals_page_wps-deals-sales' )
			return;
	
		$screen->set_help_sidebar(
			'<p><strong>' . sprintf( __( 'For more information:', 'wpsdeals' ) . '</strong></p>' .
			'<p>' . sprintf( __( 'Visit the <a href="%s" target="_blank">documentation</a> on the WPSocial Support website.', 'wpsdeals' ), esc_url( 'http://support.wpsocial.com/support/solutions/folders/231217' ) ) ) . '</p>'			
		);
	
		$screen->add_help_tab( array(
			'id'	    => 'wps-deals-sales-overview',
			'title'	    => __( 'Overview', 'wpsdeals' ),
			'content'	=>
				'<p>' . __( "This screen provides access to all of your store's transactions.", 'wpsdeals' ) . '</p>' . 
				'<p>' . __( 'Sales can be searched by email address, user name, or filtered by status (completed, pending, etc.)', 'wpsdeals' ) . '</p>' .
				'<p>' . __( 'You also have the option to bulk delete sales should you wish.', 'wpsdeals' ) . '</p>'
		) );
	
		$screen->add_help_tab( array(
			'id'	    => 'wps-deals-sales-search',
			'title'	    => __( 'Search Sales', 'wpsdeals' ),
			'content'	=>
				'<p>' . __( 'The deals sales can be searched in several different ways:', 'wpsdeals' ) . '</p>' .
				'<ul>
					<li>' . __( 'You can enter the customer\'s email address', 'wpsdeals' ) . '</li>
					<li>' . __( 'You can enter the customer\'s name', 'wpsdeals' ) . '</li>					
					<li>' . __( 'You can enter the Order ID', 'wpsdeals' ) . '</li>			
					<li>' . __( 'You can enter the Deal ID prefixed by \'#\'', 'wpsdeals' ) . '</li>
				</ul>'
		) );
	
		$screen->add_help_tab( array(
			'id'	    => 'wps-deals-sales-details',
			'title'	    => __( 'Sales Details', 'wpsdeals' ),
			'content'	=>
				'<p>' . __( 'Each sales can be further inspected by clicking the corresponding <em>View Details</em> link. This will provide more information including:', 'wpsdeals' ) . '</p>' . 
	
				'<ul>					
					<li><strong>Purchase Date</strong> - ' . __( 'The exact date and time the payment was completed.', 'wpsdeals' ) . '</li>					
					<li><strong>Name</strong> - ' . __( "The buyer's name.", 'wpsdeals' ) . '</li>
					<li><strong>Email</strong> - ' . __( "The buyer's email address.", 'wpsdeals' ) . '</li>					
					<li><strong>Payment Method</strong> - ' . __( 'The name of the payment gateway used to complete the payment.', 'wpsdeals' ) . '</li>
				</ul>'
		) );
	
		do_action( 'wps_deals_sales_contextual_help', $screen );
	}
}
?>