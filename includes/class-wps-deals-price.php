<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Price Class
 *
 * Handles all the different functionalities related prices
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

class Wps_Deals_Price{
	
	
	public $currency;
	
	public function __construct() {
		
		global $wps_deals_currency;
		
		$this->currency = $wps_deals_currency;
		
		
	}
	/**
	 * Get Price
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_price($dealid) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$normalprice = get_post_meta( $dealid, $prefix.'normal_price', true );
		$saleprice = get_post_meta( $dealid, $prefix.'sale_price', true );
		
		$price = 0;
		if( $saleprice !== '' ) {
			$price = $saleprice;
		} else {
			$price = $normalprice;
		}
		return apply_filters( 'wps_deals_sale_price', $price, $dealid );
	}
	
	/**
	 * Get Saving Price
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_savingprice($dealid) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$normalprice = get_post_meta( $dealid, $prefix.'normal_price', true );
		$saleprice = $this->wps_deals_get_price( $dealid );
		
		if( $normalprice !== '' && $saleprice !== '' ) {
			$save_price = ( $normalprice - $saleprice );
		} else {
			$save_price = '0.00';
		}
		$yousave = $this->get_display_price( $save_price, $dealid );
		return $yousave;
	}
	
	/**
	 * Get Discount Percentage
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	public function wps_deals_get_discount($dealid) {
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$normalprice = get_post_meta( $dealid, $prefix.'normal_price', true );
		$saleprice = $this->wps_deals_get_price( $dealid );//get_post_meta($dealid,$prefix.'sale_price',true);
		
		if( !empty( $normalprice ) && $saleprice !== '' ) {
			$save_price = ( $normalprice - $saleprice );
			$save_percent = ( $save_price * 100 ) / $normalprice;
			$save_percent = round( $save_percent );
			$discount = $save_percent.'%';
		} else {
			$discount = '0%';
		}
		
		return $discount;
	}
	
	/**
	 * Display Price 
	 * 
	 * Handles to return display price
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 * 
	 */
	public function get_display_price( $price, $dealid = '', $currency='' ){
		
		//apply filter to show price which will show in browser
		$price = apply_filters('wps_deals_product_price', $price, $dealid );
		
		//filter to change price with taxes
		$dis_price = $this->currency->wps_deals_formatted_value($price,$currency);
		return $dis_price;
	}

}
?>