<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Deals Fess Class
 * 
 * Handles to adding arbitrary fees to the cart. Fees can be positive or negative (discounts)
 *
 * @package Social Deals Engine
 * @since 1.0.0
 **/
class Wps_Deals_Fees {
	
	public $session, $currency;
	
	public function __construct() {
		
		global $wps_deals_session, $wps_deals_currency;
		
		$this->session	= $wps_deals_session;
		$this->currency = $wps_deals_currency;
		
		//record the fees to payment details to database
		add_filter( 'wps_deals_update_cart_data', array( $this, 'store_order_fees' ) );
		
	}
	/**
	 * Add Fess to Cart Data
	 *
	 * Handles to add fees to cart data
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 **/
	public function add_fee( $amount = '', $label = '', $id = '' ) {
		
		$fees = $this->get_fees();

		$key = empty( $id ) ? sanitize_key( $label ) : sanitize_key( $id );

		//display amount of fees value
		$displayamt = $this->currency->wps_deals_formatted_value( $amount );
		
		$fees[ $key ] = array( 'amount' => $amount, 'display_amount' => $displayamt ,'label' => $label );

		$this->session->set( 'wps_deals_cart_fees', $fees );

		return $fees;
	}

	/**
	 * Remove Fess to Cart Data
	 *
	 * Handles to remove fees from cart data
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 **/
	public function remove_fee( $id = '' ) {
		
		$fees = $this->get_fees();

		if ( isset( $fees[ $id ] ) ) {
			unset( $fees[ $id ] );
		}
	
		$this->session->set( 'wps_deals_cart_fees', $fees );

		return $fees;
	}

	/**
	 * Check Cart Has Fees or not
	 *
	 * Handles to return the cart has fees or
	 * not if cart has fees then return it
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 **/
	public function has_fees() {
		
		//get cart fees
		$deals_fees = $this->get_fees();
		
		//check cart has fees and must be array
		$has_fees = !empty( $deals_fees ) && is_array( $deals_fees ) ? true : false;
		
		//return has fees value
		return $has_fees;
	}

	/**
	 * Get Fees From Cart Data
	 *
	 * Handles to get fees from cart data
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 **/
	public function get_fees() {
		
		//get cart fees
		$deals_fees = $this->session->get( 'wps_deals_cart_fees' );
		
		//check fees is set & not empty for cart
		$deals_fees = !empty( $deals_fees ) ? $deals_fees : array();
		
		//return cart fees
		return $deals_fees;
	}

	/**
	 * Get Fee From Cart Data For Particular ID
	 *
	 * Handles to get fees from cart data for
	 * particular id of fees
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 **/
	public function get_fee( $id = '' ) {
		
		//get cart fees
		$deals_fees = $this->get_fees();
		
		//check fee is set in cart or not
		if ( isset( $deals_fees[ $id ] ) ) {
			
			//return deals fees for particular id
			return $deals_fees[ $id ];
			
		}//end if to check fees is set or not for particular id
		
		//default return false
		return false;
	}

	/**
	 * Caclulate & Return Total Fees For Cart
	 *
	 * Handles to calculate & return total
	 * fees for cart data
	 * 
	 * @package Social Deals Engine
 	 * @since 1.0.0
	 **/
	public function total() {
		
		//get cart fees
		$deals_fees  = $this->get_fees();
		
		//initial value of total fees
		$fees_total = (float) 0.00;
		
		//check cart has fees or not
		if ( $this->has_fees() ) {
			
			//calculate total fees from set fees
			foreach ( $deals_fees as $fee ) {
				
				//add fee amount to total calculation
				$fees_total += $fee['amount'];
				
			} //end foreach loop to calculate total fees
			
		} //end if to check cart has fees or not
		
		//return total fees
		return $fees_total;
	}
	/**
	 * Record fees to purchase data
	 * 
	 * Handles to add fess to purchase data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	public function store_order_fees( $order_data ) {
		
		//check cart has fees or not
		if ( $this->has_fees() ) {
			
			//add fees to order data
			$order_data['fees'] = $this->get_fees();
			
			//set cart fees session to null
			$this->session->remove( 'wps_deals_cart_fees' );
			
		}//end if to check fees is set for cart or not
		
		//return order data with fees
		return $order_data;
	}
}
?>