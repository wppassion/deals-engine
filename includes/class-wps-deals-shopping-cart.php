<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shopping Cart Class
 * 
 * Handles all functionalities of shopping cart
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

class Wps_Deals_Shopping_Cart {
	
	public $price,$session;
	
	public function __construct() {
		
		global $wps_deals_price, $wps_deals_session;
		
		$this->price	= $wps_deals_price;
		$this->session	= $wps_deals_session;
		
	}
	
	/**
	 * Get Cart Products Details
	 * 
	 * Handles to get details of currently added product into the cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function getproduct() {
		
		$this->calculate();
		//get cart data from session
		$cartsession	= $this->session->get( 'deals-cart' );
		//get cart data from session
		$cartdata		= isset( $cartsession['products'] ) ? $cartsession['products'] : false;
		return $cartdata;
	}
	
	/**
	 * Get Cart Details
	 * 
	 * Handles to get details of currently added product into the cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function get() {
		
		$this->calculate();
		//get cart data from session
		$cartdata	= $this->session->get( 'deals-cart' );
		//return cart data
		return $cartdata;
	}
	
	/**
	 * Add Product to Cart Details
	 * 
	 * Handles to add products to cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function add($args=array()) {
		
		$dealid = $args['dealid'];
		$qty = $args['quantity'];
		
		//get cart data
		$getcart = $this->getproduct();
		
		$alldatacart = $this->get();
		
		//check cart is not empty then append cart data
		$add = !empty($getcart) && $getcart != false ? $getcart : array();
		
		//total price
		$totalprice = isset($alldatacart['total']) ? $alldatacart['total'] : 0;
		
		//subtotal price
		$subtotal = isset($alldatacart['subtotal']) ? $alldatacart['subtotal'] : 0;
		//sale price
		$sale_price = $this->price->wps_deals_get_price($dealid);
		
		if($this->item_in_cart($dealid) != true) { //check deal id is exist or not
		
			$add[$dealid]	=	array(
												'dealid'	=>	$dealid,
												'quantity'	=>	$qty
											);
			
			$totalprice = $totalprice + ($sale_price * $qty);
			$subtotal = $subtotal + ($sale_price * $qty);
			
		} else {
			//if item is exist in cart then update quantity in cart
			$existdata = array();
			$existdata['dealid'] =	$getcart[$dealid]['dealid'];
			$existdata['quantity']	=	($getcart[$dealid]['quantity'] + $qty);
			
			$totalprice = $totalprice + ($sale_price * $existdata['quantity']);
			$subtotal = $subtotal + ($sale_price * $existdata['quantity']);
			
			$add[$dealid]	=	$existdata;
		}
		
		$alldatacart['total'] 		= $totalprice;
		$alldatacart['subtotal']	= $subtotal;
		$alldatacart['products']	= $add;
		
		$this->modifysession($alldatacart); 
		return true;
		
	}
	
	/**
	 * Update Cart Quantity
	 * 
	 * Handles to update product quantity to cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function update($args=array()) {
		
		//get cart data
		$cartdata = $this->get();
			
		$products = $cartdata['products'];
		
		$updated = array();
		
		$i = 0;
		$totalprice = 0;
		$subtotal = 0;
		
		foreach ($products as $key => $value) {

			$sale_price = $this->price->wps_deals_get_price($value['dealid']);
		
			$quantity = isset($args['quantity']) ? $args['quantity'] : array();
			$qty = isset($quantity[$i]) ? $quantity[$i] : $products[$key]['quantity'];//
			
		
			$updated[$key] = array( 
										'dealid' => $value['dealid'],
										'quantity' => $qty
									);
			if(empty($updated[$key]['quantity'])) {
				unset($updated[$key]);
			}
			$subtotal = $subtotal + ($sale_price * $qty);
			$i++;
		}
		
		$totalprice				= $subtotal;
		$cartdata['products']	= $updated;
		$cartdata['subtotal']	= $subtotal;
		$cartdata['total']		= $totalprice;
		
		$this->modifysession($cartdata); 
		
		return true;						
	}
	
	/**
	 * Remove Product From Cart
	 * 
	 * Handles to remove product quantity to cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function remove($id) {
		
		global $user_ID;
		
		//get cart data
		$getcart = $this->get();
		
		if(!empty($id)) {						
				
			//$_SESSION['deals-cart']['products'] = $getcart['products'];
			
			// set removed cart contents
			$this->session->set( 'wps_deals_removed_cart_contents', $getcart['products'][$id] );
									
			//unset($_SESSION['deals-cart']['products'][$id]);
			//get cart data
			unset($getcart['products'][$id]);
		}
		
		if( empty( $getcart['products'] ) ) {
			//unset($_SESSION['deals-cart']);
			$this->session->remove( 'deals-cart' );
		} else {
			//$_SESSION['deals-cart']['products'] = $getcart['products'];	
			$this->session->set( 'deals-cart', $getcart );
			//update cart
			$this->update();
		}
		
		
		return true;
		
	}
	
	public function restore_cart_item( $id ) {
		
		if( !empty( $id ) ) {
			
			//get cart data
			$getcart = $this->get();
			
			// get removed cart contents
			$removed_item = $this->session->get( 'wps_deals_removed_cart_contents' );
			
			if( !empty( $removed_item) ) {
			
				// update item in cart
				$getcart['products'][$removed_item['dealid']] = $removed_item;
			
				// update cart
				$this->session->set( 'deals-cart', $getcart );
				
				// remove removed cart contents from session
				$this->session->remove( 'wps_deals_removed_cart_contents' );
			}			
		}
	}
	
	/**
	 * Empty Cart
	 * 
	 * Handles to remove product quantity to cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function cartempty() {
		
		//remove all item from cart
		//unset($_SESSION['deals-cart']);
		$this->session->remove( 'deals-cart' );
		return true;
		
	}
	
	/**
	 * Check product in Cart
	 * 
	 * Handles to check product is in cart or not
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function item_in_cart($id) {
		
		//get cart data
		$indata = $this->getproduct();
		$result = false;
		
		if(!empty($indata) && array_key_exists($id,$indata)) { //check item is already in cart or not
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
	
	/**
	 * Calculate Sub Total of Cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 * 
	 */
	public function calculate() {
		
		//$cartdata = $this->get();
		//$cartdata = isset($_SESSION['deals-cart']) ? $_SESSION['deals-cart'] : false;
		$cartdata	= $this->session->get( 'deals-cart' );
		
		if(!empty($cartdata)) {
			
			$products = isset( $cartdata['products'] ) && !empty( $cartdata['products'] ) ? $cartdata['products'] : array();
			$subtotal = 0;
			$total = 0;
			
			foreach ($products as $key => $value) {
			
				$sale_price = $this->price->wps_deals_get_price( $value['dealid'] );
				$subtotal 	= $subtotal + ( $sale_price * $value['quantity'] );
			}
			//get applied fees in cart
			$fees     				= wps_deals_get_cart_fee_total();
			$cartdata['subtotal'] 	= $subtotal;
			$cartdata['total']		= $subtotal + $fees;
			$this->modifysession( $cartdata );
		}
		return $cartdata;
	}
	
	/**
	 * Calculate Sub Total Of Cart
	 * 
	 * Handles to show Sub Total of Product in Cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function show_subtotal() {
		
		$cartdata = $this->get();
		$subtotal = $cartdata['subtotal'];
		return $subtotal;
	}
	
	/**
	 * Calculate Sub Total Of Cart
	 * 
	 * Handles to show Sub Total of Product in Cart
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function show_total() {
		
		$cartdata 	= $this->get();
		$total 		= $cartdata['total'];
		return $total;
	}
	/**
	 * Modify Session
	 * 
	 * Handles to overwrite session
	 * This is called from add(),update(),calculate() and from discount and tax addons
	 */
	public function modifysession( $cartdata ) {
		
		//$_SESSION['deals-cart'] = apply_filters( 'wps_deals_cart_session_update', $cartdata );
		$sessiondata = apply_filters( 'wps_deals_cart_session_update', $cartdata );
		$this->session->set( 'deals-cart', $sessiondata );
		
	}
}