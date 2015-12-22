<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Currencies Class
 *
 * Handles all the different functionalities of currencies
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

class Wps_Deals_Currencies{
	
	public $current_currency,$currencies;
	
	public function __construct() {
		
		global $wps_deals_options;
		
		$this->current_currency = isset($wps_deals_options['currency']) ? $wps_deals_options['currency'] : 'USD';
		
 		//get decimal seperator from settings page
 		$decimal_sep = isset($wps_deals_options['decimal_seperator']) && !empty($wps_deals_options['decimal_seperator']) ? $wps_deals_options['decimal_seperator'] : '.';
 		
 		//get no of decimal places from settings page
 		$decimal_places = isset( $wps_deals_options['decimal_places'] ) ? $wps_deals_options['decimal_places'] : '2';
 		
 		//get value of thousand seperator from settings page
 		$thousand_sep = isset( $wps_deals_options['thounsands_seperator'] ) ? $wps_deals_options['thounsands_seperator'] : ',';
 		
 		$currency = isset($wps_deals_options['currency']) ? $wps_deals_options['currency'] : 'USD';
 		
 		$currency_symbol = $this->wps_deals_currency_symbol($currency);
 		
 		$currency_position = isset($wps_deals_options['currency_position']) ? $wps_deals_options['currency_position'] : 'before';
 		
		$this->currencies = array(	
								    'cr_symbol' 		=> $currency_symbol,
								    'cr_decimal_places' => $decimal_places,
								    'cr_thousands_sep' 	=> $thousand_sep,
								    'cr_decimal_sep' 	=> $decimal_sep,
								    'cr_position' 		=> $currency_position,
								);
	}
	
	/**
 	 * Returns currency symbol from value
 	 *
 	 * @package Social Deals Engine
	 * @since 1.0.0
 	 */
 	
 	public function wps_deals_currency_symbol( $currency = '' ) {
 		
 		switch( $currency ) {
 			
 			case 'USD' :
 			case 'AUD' :
			case 'CAD' :
			case 'HKD' :
			case 'MXN' :
			case 'SGD' :
						$currency_symbol = '&#36;';
 						break;
 			case "BRL" : 
 						$currency_symbol = 'R&#36;'; 
 						break;
 			case 'GBP' :
						$currency_symbol = '&pound;';
						break;
 			case 'EUR' :
						$currency_symbol = '&euro;';
						break;
			case 'JPY' : 
						$currency_symbol = '&yen;'; 
						break;
			case 'ZAR' : 
						$currency_symbol = 'R'; 
						break;
			case 'IDR' : 
						$currency_symbol = 'Rp'; 
						break;
			case 'HUF' :
						$currency_symbol = 'Ft';
						break;			
			default:
						$currency_symbol = $currency;
 						break;
 		}
 		
 		return apply_filters( 'wps_deals_currency_symbol', $currency_symbol, $currency );
 	}
	
	/**
	 * Formatting Price
	 *
	 * Handles to return price with proper format as per settings
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	public function wps_deals_formatted_value( $price, $currency='',$discount='') { //,$filterflag=true
		
		global $wpdb;
			
		$decimal_places = $this->currencies['cr_decimal_places']; 	//decimal places
		$decimal_sep 	= $this->currencies['cr_decimal_sep']; 		//decimal seperator
		$thousand_sep 	= $this->currencies['cr_thousands_sep']; 	//thousand seperator
		$position 		= $this->currencies['cr_position']; 		//position
		
		//check price is negative or positive
		$isnegative = ( $price < 0 ) ? true : false;
		if( $isnegative ) {
			//if price is negative then turn it to positive
			$price = ( $price * -1 );
		}
		
		if ( empty( $currency ) ) $currency = $this->current_currency;
		if ( empty( $price ) ) $price = 0.00;
		
		$currency_symbol = $this->currencies['cr_symbol'];
		
		if( !empty( $discount ) )	{
			$price = $price - $discount;		
		}
		
		//$price = !empty($filterflag) ? apply_filters('wps_deals_product_price',$price) : $price;
		
		// check price is intiger or not, if not then convert it to float
		// for taking care Notice: A non well formed numeric 
		$price = floatval($price);
		$decimal_places = intval($decimal_places);	
		
		$value = number_format($price,$decimal_places,$decimal_sep,$thousand_sep);
 		
 		if($position == 'before'){ //check if currency position is set before then show it to before currency value
 			
 			$price = $currency_symbol.' '.$value;
 			
 		} else {
 			//if currency position is set after then show it to after currency value
 			$price = $value.' '.$currency_symbol;
 		}
 		
 		//check if price is negative then append hyphen before price
 		if( $isnegative ) {
			//append minus sign before price
			$price = '-' . $price;
		}
		
		return $price; 
	}
}
?>