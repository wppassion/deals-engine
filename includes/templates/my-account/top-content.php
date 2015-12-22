<?php 

/**
 * My Account Top Content Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/top-content.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//$changepasswordlinkhtml = '<a href="' . $changepasswordlink . '">' . __( 'change your password', 'wpsdeals' ) . '</a>';
	$changepasswordlinkhtml = '<a href="' . $changepasswordlink . '">' . __( 'edit your password and account details', 'wpsdeals' ) . '</a>';
?>	

<p class="deals-account-top deals-clearfix">

	<?php
		printf(
			__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'wpsdeals' ) . ' ',
			$username,
			wp_logout_url( get_permalink( wps_deals_get_page_id( 'my_account_page' ) ) )
		);
	
		printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and %s.', 'wpsdeals' ),
			$changepasswordlinkhtml
		);
	?>
	
</p>