<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Paypal Class
 * 
 * Handles all Paypal Functionalities
 * 
 * @package WPSocial Deals Engin
 * @since 1.0.0
 *
 */

class Wps_Deals_Paypal {
    
   var $last_error;                 // holds the last error encountered
   
   var $ipn_log;                    // bool: log IPN results to text file?
   
   var $ipn_log_file;               // filename of the IPN log
   var $ipn_response;               // holds the IPN response from paypal   
   var $ipn_data = array();         // array contains the POST values for IPN
   
   var $fields = array();           // array holds the fields to submit to paypal
 
   function Wps_Deals_Paypal() {
       
      // initialization constructor.  Called when class is created.
      
      global $wps_deals_options;
      
      $this->paypal_url = WPS_DEALS_PAYPAL_URL; // https://www.paypal.com/cgi-bin/webscr
      
      $this->last_error = '';
      
      $this->ipn_log_file =  WPS_DEALS_DIR.'/.ipn_results.log'; //full path of ipn log file.
      
      $debug_log = isset($wps_deals_options['enable_debug']) ? $wps_deals_options['enable_debug'] : '';
      
	      if($debug_log == '1') {
	      		
	      	$this->ipn_log = true; 
	      	
	      }else {
	      	
	      	$this->ipn_log = false; 
	      }
      $this->ipn_response = '';
     
      $this->add_field('rm','2');           // Return method = POST
      $this->add_field('cmd','_xclick'); 
      
   }
   
   /**
 	* Add Fields to Paypal Form
	* 
 	* Handles to add fields to paypal form
 	* 
	* @package WPSocial Deals Engin
 	* @since 1.0.0
 	*
 	*/
   
   function add_field($field, $value) {
            
      $this->fields["$field"] = $value;
   }
 
   /**
 	* Submit Paypal Form
	* 
 	* Handles to submit paypal form
 	* 
	* @package WPSocial Deals Engin
 	* @since 1.0.0
 	*
 	*/
   
    function submit_paypal_post() {
 
   ?>
   		<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html dir="LTR" lang="en">
		<head>
		<title><?php echo WPS_DEALS_PAYMENT_PAGE_TITLE; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<style type="text/css">
		body {background-color:#FFFFFF;}
		body, td, div {font-family: verdana, arial, sans-serif;}
		</style>
		</head>
		<body onload="return document.forms['paypal_form'].submit();">
		<table cellpadding="0" width="100%" height="100%" cellspacing="0" style="border:1px solid #003366;">
  			<tr><td align="middle" style="height:100%; vertical-align:middle;">
   				<div style="color:#003366"><h1><?php _e('Processing transaction','wpsdeals');?><img src="<?php echo WPS_DEALS_URL;?>includes/images/period_ani.gif" border="0" alt="" width="18" height="12"></h1></div>
			    <div style="margin:10px;padding:10px;"><?php _e('If this page appears for more than 5 seconds, please click the PayPal Checkout button to complete your order.','wpsdeals');?></div>
    			<div style="margin:10px;padding:10px;"><input type="image" src="<?php echo WPS_DEALS_URL;?>includes/images/button_ppcheckout.gif" alt="PayPal Checkout" style="border:0;" title=" PayPal Checkout " /></div>
  			</td></tr>      
		</table>
   <?php
      echo "<form method=\"post\" name=\"paypal_form\" ";
      echo "action=\"".$this->paypal_url."\">\n";

      foreach ($this->fields as $name => $value) {
         echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
      }
      echo "</form>\n";
      echo "</body></html>\n";
    
   }
   
   /**
 	* Validate IPN
	* 
 	* Handles to validate IPN of paypal
 	* 
	* @package WPSocial Deals Engin
 	* @since 1.0.0
 	*
 	*/
   
   function validate_ipn() {

      // parse the paypal URL
      $url_parsed=parse_url($this->paypal_url);        

      // generate the post string from the _POST vars aswell as load the
      // _POST vars into an arry so we can play with them from the calling
      // script.
      $post_string = '';    
      foreach ($_POST as $field=>$value) { 
         $this->ipn_data["$field"] = $value;
         $post_string .= $field.'='.urlencode(stripslashes($value)).'&'; 
      }
      $post_string.="cmd=_notify-validate"; // append ipn command

      // open the connection to paypal
      // $fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30);  old
      $fp = fsockopen('ssl://'.$url_parsed[host],"443",$err_num,$err_str,30); 
      
      if(!$fp) {
          
         // could not open the connection.  If loggin is on, the error message
         // will be in the log.
         $this->last_error = "fsockopen error no. $errnum: $errstr";
         $this->log_ipn_results(false);       
         return false;
         
      } else { 
 
         // Post the data back to paypal
         fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n"); 
         fputs($fp, "Host: $url_parsed[host]\r\n"); 
         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
         fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
         fputs($fp, "Connection: close\r\n\r\n"); 
         fputs($fp, $post_string . "\r\n\r\n"); 

         // loop through the response from the server and append to variable
         while(!feof($fp)) { 
            $this->ipn_response .= fgets($fp, 1024); 
         } 

         fclose($fp); // close connection

      }
      
      if (eregi("VERIFIED",$this->ipn_response)) {
  
         // Valid IPN transaction.
         $this->log_ipn_results(true);
         return true;       
         
      } else {
  
         // Invalid IPN transaction.  Check the log for details.
         $this->last_error = 'IPN Validation Failed.';
         $this->log_ipn_results(false);   
         return false;
       
      }
      
   }
   
   /**
 	* Log IPN Results
	* 
 	* Handles to ipn results ipn
 	* 
	* @package WPSocial Deals Engin
 	* @since 1.0.0
 	*
 	*/
   function log_ipn_results($success) {
    
		global $wps_deals_payment_log; 
   	 
		if (!$this->ipn_log) return;  // is logging turned off?
		
		// Timestamp
		$text = '['.date('m/d/Y g:i A').'] - '; 
		
		// Success or failure being logged?
		if ($success) $text .= "SUCCESS!\n";
		else $text .= 'FAIL: '.$this->last_error."\n";
		
		// Log the POST variables
		$text .= "IPN POST Vars from Paypal:\n";
		foreach ($this->ipn_data as $key=>$value) {
		 	$text .= "$key=$value, ";
		}
		
		// Log the response from the paypal server
		$text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;
		
		// Write to log
		$wps_deals_payment_log->wps_deals_add( 'paypal', $text );
		
		// Write to log
		/*$fp=fopen($this->ipn_log_file,'a');
		fwrite($fp, $text . "\n\n"); 
		
		fclose($fp);  // close file*/
   }
}
?>