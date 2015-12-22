<?php
/**
 * Template Hooks
 * 
 * Handles to add all hooks of template
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $wps_deals_options, $detect_mobile;
	
	/* **************************************************************************
	   Global Page Hooks
	   ************************************************************************** */
	
	/**
	 * Content Wrappers
	 *
	 * @see wps_deals_output_content_wrapper()
	 * @see wps_deals_output_content_wrapper_end()
	 */
	add_action( 'wps_deals_before_main_content', 'wps_deals_output_content_wrapper', 10 );
	add_action( 'wps_deals_before_main_content', 'wps_deals_breadcrumbs', 20 );
	add_action( 'wps_deals_after_main_content', 'wps_deals_output_content_wrapper_end', 30 );
	
	//breadcrumbs values for the page related to theme
	add_action( 'wps_deals_theme_before_main_content', 'wps_deals_breadcrumbs', 20 );
	
	/**
	 * Deals Ordering
	 *
	 * @see wps_deals_result_count()
	 * @see wps_deals_ordering()
	 */
	add_action( 'wps_deals_before_archive_loop', 'wps_deals_result_count', 20 );
	add_action( 'wps_deals_before_archive_loop', 'wps_deals_ordering', 30 );

	
	/* **************************************************************************
	   Deals Home Page Hooks
	   ************************************************************************** */

	/**
	 * Page Content
	 *
	 * @see wps_deals_home_header()
	 * @see wps_deals_home_content()
	 */
	add_action( 'wps_deals_home_content', 'wps_deals_home_header', 5 );
	add_action( 'wps_deals_home_content', 'wps_deals_ordering', 10);
	add_action( 'wps_deals_home_content', 'wps_deals_home_content', 15 );
	add_action( 'wps_deals_home_header_shortcode', 'wps_deals_home_header', 5 );
	add_action( 'wps_deals_home_content_shortcode', 'wps_deals_ordering', 15);
	add_action( 'wps_deals_home_content_shortcode', 'wps_deals_home_content', 20 );
	
	/**
	 * Header Content
	 *
	 * @see wps_deals_home_header_title()
	 * @see wps_deals_home_header_left()
	 * @see wps_deals_home_header_right()
	 */
	add_action( 'wps_deals_home_header_data', 'wps_deals_home_header_left', 10 );
	add_action( 'wps_deals_home_header_data', 'wps_deals_home_header_right', 15 );
	
	/**
	 * Header Left
	 *
	 * @see wps_deals_home_header_title()
	 * @see wps_deals_home_header_image()
	 * @see wps_deals_home_header_excerpt()
	 */
	if( $detect_mobile->isMobile() && !$detect_mobile->isTablet() ){
		add_action( 'wps_deals_home_header_left_data', 'wps_deals_home_header_timer', 5 );
	}
	add_action( 'wps_deals_home_header_left_data', 'wps_deals_home_header_title', 10 );
	add_action( 'wps_deals_home_header_left_data', 'wps_deals_home_header_image', 15 );
	add_action( 'wps_deals_home_header_left_data', 'wps_deals_home_header_excerpt', 20 );
	
	/**
	 * Header Right
	 *
	 * @see wps_deals_home_header_timer()
	 * @see wps_deals_home_header_discount()
	 * @see wps_deals_home_header_value()
	 * @see wps_deals_home_header_save()
	 * @see wps_deals_home_header_rating()
	 * @see wps_deals_home_header_see_deals()
	 */
	if( $detect_mobile->isMobile() && !$detect_mobile->isTablet() ){
		
	} else {
		add_action( 'wps_deals_home_header_right_data', 'wps_deals_home_header_timer', 5 );
	}
	add_action( 'wps_deals_home_header_right_data', 'wps_deals_home_header_discount', 10 );
	add_action( 'wps_deals_home_header_right_data', 'wps_deals_home_header_value', 15 );
	add_action( 'wps_deals_home_header_right_data', 'wps_deals_home_header_save', 20 );
	add_action( 'wps_deals_home_header_right_data', 'wps_deals_home_header_rating', 25 );
	add_action( 'wps_deals_home_header_right_data', 'wps_deals_single_deal_avail_bought', 30 );
	add_action( 'wps_deals_home_header_right_data', 'wps_deals_home_header_see_deal', 35 );

	/**
	 * More Deals Template
	 *
	 * @see wps_deals_home_navigations()
	 * @see wps_deals_home_more_deal_active()
	 * @see wps_deals_home_more_deal_ending()
	 * @see wps_deals_home_more_deal_upcoming()
	 */
	add_action( 'wps_deals_home_more_deals', 'wps_deals_home_navigations', 5 );
	add_action( 'wps_deals_home_more_deals', 'wps_deals_home_more_deal_active', 20 );
	add_action( 'wps_deals_home_more_deals', 'wps_deals_home_more_deal_ending', 20 );
	add_action( 'wps_deals_home_more_deals', 'wps_deals_home_more_deal_upcoming', 20 );
	
	/**
	 * More Deals Content
	 *
	 * @see wps_deals_home_more_deals_discount()
	 * @see wps_deals_home_more_deals_image()
	 * @see wps_deals_home_more_deals_timer()
	 * @see wps_deals_home_more_deals_title()
	 * @see wps_deals_home_more_deals_price()
	 * @see wps_deals_home_more_deals_see_deal()
	 */
	add_action( 'wps_deals_home_more_deals_content', 'wps_deals_home_more_deals_discount', 5 );
	add_action( 'wps_deals_home_more_deals_content', 'wps_deals_home_more_deals_image', 10 );
	add_action( 'wps_deals_home_more_deals_content', 'wps_deals_home_more_deals_timer', 15 );
	add_action( 'wps_deals_home_more_deals_content', 'wps_deals_home_more_deals_title', 20 );
	add_action( 'wps_deals_home_more_deals_content', 'wps_deals_home_more_deals_see_deal', 25 );
	add_action( 'wps_deals_home_more_deals_content', 'wps_deals_home_more_deals_price', 30 );	

	
	/* **************************************************************************
	   Deals Archive Page Hooks
	   ************************************************************************** */
	   
	/**
	 * Deals Archive Template
	 *
	 * @see wps_deals_archive_deals_content()
	 */
	add_action( 'wps_deals_archive_deals', 'wps_deals_archive_deals_content', 10 );
	
	/**
	 * Archive descriptions
	 *	 
	 * @see wps_deals_archive_description_content()
	 */	
	add_action( 'wps_deals_archive_description', 'wps_deals_archive_description_content', 10 );
		
	
	/* **************************************************************************
	   Deals Single Page Hooks
	   ************************************************************************** */
	
	/**
	 * Single Content
	 *
	 * @see wps_deals_breadcrumbs()
	 * @see wps_deals_single_header_message()
	 * @see wps_deals_single_header_title()
	 * @see wps_deals_single_header_left()
	 * @see wps_deals_single_header_right()
	 */
	add_action( 'wps_deals_single_header_content', 'wps_deals_single_header_message', 10 );
	add_action( 'wps_deals_single_header_content', 'wps_deals_single_header_title', 20 );
	add_action( 'wps_deals_single_header_content', 'wps_deals_single_header_left', 30 );
	add_action( 'wps_deals_single_header_content', 'wps_deals_single_header_right', 35 );
	
	/**
	 * Header Left Content
	 *
	 * @see wps_deals_single_deal_price()
	 * @see wps_deals_single_dime_sale()
	 * @see wps_deals_single_add_to_cart()
	 * @see wps_deals_single_value()
	 * @see wps_deals_single_discount()
	 * @see wps_deals_single_save()
	 * @see wps_deals_single_deal_timer()
	 * @see wps_deals_single_deal_avail_bought()
	 * @see wps_deals_single_deal_ratings()
	 */
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_deal_price', 5 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_dime_sale', 10 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_add_to_cart', 15 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_value', 17 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_discount', 18 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_save', 19 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_deal_timer', 25 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_deal_avail_bought', 30 );
	add_action( 'wps_deals_single_header_left', 'wps_deals_single_deal_ratings', 35 );
	
	/**
	 * Purchase Buttons
	 *
	 * @see wps_deals_purchase_link_button()
	 * @see wps_deals_add_to_cart_button()
	 * @see wps_deals_buy_now_button()
	 */
	add_action( 'wps_deals_single_purchase_link', 'wps_deals_purchase_link_button', 5 );
	add_action( 'wps_deals_single_add_to_cart', 'wps_deals_add_to_cart_button', 5 );
	add_action( 'wps_deals_single_buy_now', 'wps_deals_buy_now_button', 5 );
	
	/**
	 * Deal Details ( Available & Bought )
	 *
	 * @see wps_deals_single_available()
	 * @see wps_deals_single_bought()
	 */
	add_action( 'wps_deals_available_bought', 'wps_deals_single_available', 5 );
	add_action( 'wps_deals_available_bought', 'wps_deals_single_bought', 10 );
	
	/**
	 * Header Right Content
	 *
	 * @see wps_deals_single_deal_img()
	 * @see wps_deals_social_buttons()
	 */
	add_action( 'wps_deals_single_header_right', 'wps_deals_single_deal_img', 10 );
	add_action( 'wps_deals_single_header_right', 'wps_deals_social_buttons', 20 );
	add_action( 'wps_deals_single_header_right', 'wps_deals_gallery_image', 10 );
	
	/**
	 * Social Sharing Buttons
	 *
	 * @see wps_deals_social_facebook()
	 * @see wps_deals_social_twitter()
	 * @see wps_deals_social_google()
	 */
	add_action( 'wps_deals_social_buttons', 'wps_deals_social_facebook', 10 );
	add_action( 'wps_deals_social_buttons', 'wps_deals_social_twitter', 15 );
	add_action( 'wps_deals_social_buttons', 'wps_deals_social_google', 20 );
	
	/**
	 * Deal Content
	 *
	 * @see wps_deals_single_description()
	 * @see wps_deals_single_business_info()
	 * @see wps_deals_single_terms_conditions()
	 */
	add_action( 'wps_deals_single_content', 'wps_deals_single_description', 10 );
	add_action( 'wps_deals_single_content', 'wps_deals_single_business_info', 20 );
	add_action( 'wps_deals_single_content', 'wps_deals_single_terms_conditions', 30 );
	
	/**
	 * Single Deal Footer Content
	 * 
	 * @see wps_deals_single_footer_add_to_cart()
	 */
	add_action( 'wps_deals_single_footer_content', 'wps_deals_single_footer_add_to_cart', 5 );
	add_action( 'wps_deals_single_footer_add_to_cart', 'wps_deals_single_add_to_cart', 5 );
	
	/* **************************************************************************
	   Deals Checkout Page Hooks
	   ************************************************************************** */
	
	/**
	 * Checkout Content
	 *
	 * @see wps_deals_checkout_header()
	 * @see wps_deals_checkout_content()
	 * @see wps_deals_checkout_footer()
	 */
	add_action( 'wps_deals_checkout_content', 'wps_deals_checkout_header', 5 );
	add_action( 'wps_deals_checkout_content', 'wps_deals_checkout_content', 10 );
	add_action( 'wps_deals_checkout_content', 'wps_deals_checkout_footer', 15 );
	
	/**
	 * Shopping Cart Content
	 *
	 * @see wps_deals_cart_details()
	 * @see wps_deals_cart_details()
	 * @see wps_deals_cart_action_buttons()
	 */
	add_action( 'wps_deals_checkout_header_content', 'wps_deals_cart_details', 5 );
	add_action( 'wps_deals_checkout_header_content_ajax', 'wps_deals_cart_details', 5 );
	add_action( 'wps_deals_checkout_header_content', 'wps_deals_cart_action_buttons', 10 );
	add_action( 'wps_deals_checkout_header_content_ajax', 'wps_deals_cart_action_buttons', 10 );
	
	/**
	 * Shopping Cart Buttons
	 *
	 * @see wps_deals_cart_update_button()
	 */
	add_action( 'wps_deals_cart_action_buttons', 'wps_deals_cart_update_button', 10 );
	
	//add action to show description in chekout page
	add_action( 'wps_deals_checkout_payment_combo_after', 'wps_deals_display_description', 5 );
		
	/**
	 * Social Login Buttons
	 *
	 * @see wps_deals_cart_social_login()
	 */
	add_action( 'wps_deals_checkout_middle_content', 'wps_deals_cart_social_login', 5 );
	
	/**
	 * Footer Content
	 *
	 * @see wps_deals_checkout_payment_gateways()
	 * @see wps_deals_checkout_user_form()
	 * @see wps_deals_cart_user_personal_details()
	 * @see wps_deals_cart_user_billing_details()
	 */
	add_action( 'wps_deals_checkout_footer_content', 'wps_deals_checkout_payment_gateways', 5 );
	add_action( 'wps_deals_checkout_footer_content', 'wps_deals_checkout_user_form', 10 );
	add_action( 'wps_deals_checkout_footer_content', 'wps_deals_cart_user_personal_details', 15 );
	add_action( 'wps_deals_checkout_footer_content', 'wps_deals_cart_user_billing_details', 20 );

	/**
	 * After Footer Content
	 *
	 * @see wps_deals_cart_agree_terms()
	 * @see wps_deals_checkout_order_total_button()
	 */
	add_action( 'wps_deals_checkout_footer_content_after', 'wps_deals_cart_agree_terms', 5 );
	add_action( 'wps_deals_checkout_footer_content_after', 'wps_deals_checkout_order_total_button', 10 );

	/**
	 * User Registration Content
	 *
	 * @see wps_deals_cart_user_reg_form()
	 * @see wps_deals_cart_user_login_form()
	 */
	add_action( 'wps_deals_cart_user_form_content', 'wps_deals_cart_user_reg_form', 5 );
	add_action( 'wps_deals_cart_user_form_content', 'wps_deals_cart_user_login_form', 10 );

	/**
	 * Empty Cart Message
	 *
	 * @see wps_deals_empty_cart_message()
	 */
	add_action( 'wps_deals_cart_empty', 'wps_deals_empty_cart_message', 5 );

	/**
	 * Order Total Buttons
	 *
	 * @see wps_deals_cart_order_total_footer()
	 * @see wps_deals_cart_place_order_button_footer()
	 */
	add_action( 'wps_deals_cart_footer_total_button', 'wps_deals_cart_order_total_footer', 5 );
	add_action( 'wps_deals_cart_footer_total_button', 'wps_deals_cart_place_order_button_footer', 10 );
	
	/**
	 * Social Login Buttons
	 *
	 * @see wps_deals_social_login_facebook() - 5
	 * @see wps_deals_social_login_twitter() - 10
	 * @see wps_deals_social_login_google() - 15
	 * @see wps_deals_social_login_linkedin() - 20
	 * @see wps_deals_social_login_yahoo() - 25
	 */
	$priority = 5;
	if( isset( $wps_deals_options['social_order'] ) && !empty( $wps_deals_options['social_order'] ) ) {
		$socialmedias = $wps_deals_options['social_order'];
	} else {
		$socialorders = wps_deals_social_networks();
		$socialmedias = array_keys ( $socialorders );
	}
	
	foreach (  $socialmedias as $social ) {
		add_action( 'wps_deals_checkout_social_login', 'wps_deals_social_login_'.$social , $priority );
		$priority += 5;
	}
	
	/**
	 * Social Login Buttons Shortcode
	 *
	 * @see wps_deals_social_login_shortcode()
	 */
	add_action( 'wps_deals_social_login_shortcode', 'wps_deals_social_login_shortcode', 10, 2 );
	
	//add action to add localize script for individual post data
	add_action( 'wps_deals_localize_map_script', 'wps_deals_localize_map_script' );
	
	/* **************************************************************************
	   Deals Order History Page Hooks
	   ************************************************************************** */
	
	//add_action to show cheque payment message content - 5
	/**
	 * Social Login Buttons Shortcode
	 *
	 * @see wps_deals_order_view_content_before()
	 */
	add_action( 'wps_deals_order_view_content_before', 'wps_deals_order_view_content_before', 5 );
	
	/**
	 * Order History page Content
	 *
	 * @see wps_deals_orders_content()
	 */
	add_action( 'wps_deals_orders_content', 'wps_deals_orders_content', 5 );
	
	//add_action to show ordered deals listing table
	add_action( 'wps_deals_orders_table'	, 'wps_deals_orders_listing_content', 5, 2 );
	
	//add_action to show orderes completed page content - 5
	add_action( 'wps_deals_orders_complete_content', 'wps_deals_orders_complete_content', 5 );
	
	//add_action to show orderes cancel page content - 5
	add_action( 'wps_deals_orders_cancel_content', 'wps_deals_orders_cancel_content'	, 5 );

	
	/********************** My Account Page Hooks **************************/
	
	//add action to show my account page address success message - 5
	//add action to show my account page top content - 10
	//add action to show my account page available downloads - 15
	//add action to show my account page recent orders - 20
	//add action to show my account page addresses - 25
	add_action( 'wps_deals_my_account_content', 'wps_deals_my_account_address_success_msg'	, 5  );
	add_action( 'wps_deals_my_account_content', 'wps_deals_my_account_top_content'			, 10 );
	add_action( 'wps_deals_my_account_content', 'wps_deals_my_account_available_downloads'	, 15 );
	add_action( 'wps_deals_my_account_content', 'wps_deals_my_account_recent_orders'		, 20 );
	add_action( 'wps_deals_my_account_content', 'wps_deals_my_account_addresses'			, 25 );
	
	//add action to display my account page billing address
	add_action( 'wps_deals_my_account_billing_address', 'wps_deals_my_account_billing_address', 10, 2 );
	
	//add action to display my account page address success message - 5
	//add action to display my account page login content - 10
	add_action( 'wps_deals_my_account_login_content', 'wps_deals_my_account_address_success_msg', 5  );
	add_action( 'wps_deals_my_account_login_content', 'wps_deals_my_account_login_content'		, 10 );
	
	//add action to display billing address
	add_action( 'wps_deals_display_address', 'wps_deals_display_address'				, 10 );
	
	//add action to edit address page - 5
	add_action( 'wps_deals_edit_address_content', 'wps_deals_edit_address_content'		, 5 );
	
	//add action to edit address page with display address - 5
	add_action( 'wps_deals_edit_address_page', 'wps_deals_my_account_addresses'			, 5 );
	
	//add action to edit billing address
	add_action( 'wps_deals_edit_billing_address', 'wps_deals_edit_billing_address'		, 10 );
	
	//add action to manage billing address
	add_action( 'wps_deals_manage_billing_address', 'wps_deals_cart_user_billing_details', 10 );
	
	//add action to create an acoount page - 5
	add_action( 'wps_deals_create_account_content', 'wps_deals_create_account_content', 5 );
	
	//add action to change password page - 5
	add_action( 'wps_deals_change_password_content', 'wps_deals_change_password_content', 5 );
	
	//add action to lost password page - 5
	add_action( 'wps_deals_lost_password_content', 'wps_deals_lost_password_content'	, 5 );
	
	//add action to display sidebar template - 10
	add_action( 'wps_deals_sidebar', 'wps_deals_get_sidebar', 10 );

?>