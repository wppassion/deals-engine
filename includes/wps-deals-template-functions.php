<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Templates Functions
 *
 * Handles to manage templates of plugin
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 *
 */ 


/**
 * Returns the path to the Deals templates directory
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_templates_dir() {
	
	return apply_filters( 'wps_deals_template_dir', WPS_DEALS_DIR . '/includes/templates/' );
	
}
/**
 * Get template part.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */ 
function wps_deals_get_template_part( $slug, $name='' ) {
	
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/deals-engine/slug-name.php
	if ( $name )
		$template = locate_template( array ( $slug.'-'.$name.'.php', wps_deals_get_templates_dir().$slug.'-'.$name.'.php' ) );

	// Get default slug-name.php
	if ( !$template && $name && file_exists( wps_deals_get_templates_dir().$slug.'-'.$name.'.php' ) )
		$template = wps_deals_get_templates_dir().$slug.'-'.$name.'.php';

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/deals-engine/slug.php
	if ( !$template )
		$template = locate_template( array ( $slug.'.php', wps_deals_get_templates_dir().$slug.'.php' ) );

	if ( $template )
		load_template( $template, false );
}


/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 * 
 */
function wps_deals_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	
	if ( ! $template_path ) $template_path = WPS_DEALS_BASENAME . '/';//wps_deals_get_templates_dir();
	if ( ! $default_path ) $default_path = wps_deals_get_templates_dir();
	
	// Look within passed path within the theme - this is priority
	
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);
	
	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters('wps_deals_locate_template', $template, $template_name, $template_path);
}

/**
 * Get other templates (e.g. deals attributes) passing attributes and including the file.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 * 
 */

function wps_deals_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	
	if ( $args && is_array($args) )
		extract( $args );

	$located = wps_deals_locate_template( $template_name, $template_path, $default_path );
	
	do_action( 'wps_deals_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'wps_deals_after_template_part', $template_name, $template_path, $located, $args );
}


/* **************************************************************************
   Global Templates
   ************************************************************************** */
   
if ( ! function_exists( 'wps_deals_output_content_wrapper' ) ) {

	/**
	 * Loads the start of the page wrapper.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_output_content_wrapper() {
	
		// get the template
		wps_deals_get_template( 'global/wrapper-start.php' );
	}
}

if ( ! function_exists( 'wps_deals_output_content_wrapper_end' ) ) {

	/**
	 * Loads the end of the page wrapper.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_output_content_wrapper_end() {
		
		// get the template
		wps_deals_get_template( 'global/wrapper-end.php' );
	}
}

if( !function_exists( 'wps_deals_breadcrumbs' ) ){

	/**
	 * Loads the breadcrumb template.
	 * 
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_breadcrumbs() {
		
		global $wps_deals_options;
		
		// if enable breadcrumb is checked
		if(isset($wps_deals_options['enable_breadcrumb']) && !empty($wps_deals_options['enable_breadcrumb']) && $wps_deals_options['enable_breadcrumb'] == '1') {
			// get the template
			wps_deals_get_template( 'global/breadcrumb.php' );	
		}		
	}	
}

if ( ! function_exists( 'wps_deals_result_count' ) ) {

	/**
	 * Output the result count text (Showing x - x of x results).
	 *
	 * @access public
	 * @subpackage	Loop
	 * @return void
	 */
	function wps_deals_result_count() {
	
		global $wps_deals_options, $wps_deals_model;
		
		// get today's date and time
		$today = wps_deals_current_date();
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$order_args = $wps_deals_model->wps_deals_get_deals_ordering_args();
		
		// get the page limit from the plugin settings, so we know how many deals to display
		$pagelimit = isset( $wps_deals_options['deals_per_page'] ) ? $wps_deals_options['deals_per_page'] : -1;
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		if( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else{
			$paged = 1;
		}
		
		// get the taxonomy slug
		$slug = get_query_var( WPS_DEALS_POST_TAXONOMY );
		$tags_slug = get_query_var( WPS_DEALS_POST_TAGS );		
		
		if( !empty( $slug ) ) {

			// set the deal home page args
			$_homeargs = array( 
								'post_type' => WPS_DEALS_POST_TYPE,
								'post_status' => 'publish',
								'paged' => $paged,
								'posts_per_page' => $pagelimit,
								'tax_query' => array(
												array(
													'taxonomy' => WPS_DEALS_POST_TAXONOMY,
													'field' => 'slug',
													'terms' => $slug
												)
											)
								);
								
		} else if(!empty( $tags_slug )) {
			// set the deal home page args
			$_homeargs = array( 
								'post_type' => WPS_DEALS_POST_TYPE,
								'post_status' => 'publish',
								'posts_per_page' => $pagelimit,
								'paged' => $paged,
								'tax_query' => array(
												array(
													'taxonomy' => WPS_DEALS_POST_TAGS,
													'field' => 'slug',
													'terms' => $tags_slug
												)
											)
								);
			
		} else {
		
			// set the deal home page args
			$_homeargs = array( 
								'post_type' => WPS_DEALS_POST_TYPE,
								'post_status' => 'publish' ,
								'posts_per_page' => $pagelimit,
								'paged' => $paged,
								'cat' => -0
							);
		}				
		
		$homeargs = array_merge( $_homeargs, $order_args );
		
		// set the active deals query for the home page
		$activemetaquery = array( 
									array (
											'key' => $prefix.'start_date',
											'value' => $today,
											'compare' => '<=',
											'type' => 'STRING'
											),
									array (
											'key' => $prefix.'end_date',
											'value' => $today,
											'compare' => '>=',
											'type' => 'STRING'
											)
									);
		
		// merge and set the args
		$activeargs = array_merge( $homeargs, array( 'meta_query' => $activemetaquery ) );
		
		// apply filter for add archive page argument if any
		$activeargs	= apply_filters( 'wps_deals_add_archive_page_args', $activeargs );
		
		// set the args, which we will pass to the template
		$args = array( 
						'args' => $activeargs,
					);
	
		wps_deals_get_template( 'global/result-count.php', $args );
	}
}

if( !function_exists( 'wps_deals_ordering' ) ) {

	/**
	 * Loads the order deals by template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_ordering() {
		
		global $wps_deals_options;
		
		// check if we need to display the order by drop down
		if( isset( $wps_deals_options['enable_deals_orderby'] ) && !empty( $wps_deals_options['enable_deals_orderby'] ) ) {
			
			$orderby = isset( $_GET['dealsorderby'] ) ? $_GET['dealsorderby'] : apply_filters( 'wps_deals_default_deals_orderby', $wps_deals_options['default_deals_orderby'] );
			
			// set the args, which we will pass to the template
			$args = array( 
						'orderby' => $orderby
					);
			
			// get the template
			wps_deals_get_template( 'global/orderby.php', $args );
		}
	}
}

if( ! function_exists( 'wps_deals_get_sidebar' ) ) {

	/**
	 * Loads the sidebar template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_get_sidebar() {
		
		// get the template
		wps_deals_get_template( 'global/sidebar.php' );
	}
}


/* **************************************************************************
   Helper Functions
   ************************************************************************** */
   
if( ! function_exists( 'wps_deals_is_active' ) ) {

	/**
	 * wps_deals_show_the_page_title function.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_is_active() {

		global $wps_deals_options, $wps_deals_model;
		
		// get today's date and time
		$today = wps_deals_current_date();
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$order_args = $wps_deals_model->wps_deals_get_deals_ordering_args();
		
		// get the page limit from the plugin settings, so we know how many deals to display
		$pagelimit = isset( $wps_deals_options['deals_per_page'] ) ? $wps_deals_options['deals_per_page'] : -1;
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		if( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else{
			$paged = 1;
		}
		
		// set the deal home page args
		$_homeargs = array( 
							'post_type' => WPS_DEALS_POST_TYPE,
							'post_status' => 'publish' ,
							'posts_per_page' => $pagelimit,
							'paged' => $paged,
							'cat' => -0
						);
		
		$homeargs = array_merge( $_homeargs, $order_args );
		
		// set the active deals query for the home page
		$activemetaquery = array( 
									array (
											'key' => $prefix.'start_date',
											'value' => $today,
											'compare' => '<=',
											'type' => 'STRING'
											),
									array (
											'key' => $prefix.'end_date',
											'value' => $today,
											'compare' => '>=',
											'type' => 'STRING'
											)
									);
		
		// merge and set the args
		$activeargs = array_merge( $homeargs, array( 'meta_query' => $activemetaquery ) );
	
		// check if the category id is set
		if( isset( $category ) && !empty( $category ) ) { 
			$activeargs[WPS_DEALS_POST_TAXONOMY] = $category;
		}
		
		// set the args, which we will pass to the template
		$args = array( 
						'args' => $activeargs,
						'tab' => 'active',
						'btncolor' => $btncolor
					);
		
		return $activeargs;
	}
}
   
if( ! function_exists( 'wps_deals_page_title' ) ) {

	/**
	 * wps_deals_page_title function.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_page_title( $echo = true ) {

		if( is_search() ) {
			$page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'wpsdeals' ), get_search_query() );

			if( get_query_var( 'paged' ) )
				$page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'wpsdeals' ), get_query_var( 'paged' ) );

		} elseif( is_tax() ) {

			$page_title = single_term_title( "", false );

		} else {

			$shop_page_id = wps_deals_get_page_id( 'deals_main_page' );
			$page_title   = get_the_title( $shop_page_id );
		}

		$page_title = apply_filters( 'wps_deals_page_title', $page_title );

		if ( $echo )
	    	echo $page_title;
	    else
	    	return $page_title;
	}
}

if( ! function_exists( 'wps_deals_show_the_page_title' ) ) {

	/**
	 * wps_deals_show_the_page_title function.
	 *
	 * @package Social Deals Engine
	 * @since 2.0.0
	 */
	function wps_deals_show_the_page_title() {

		global $wps_deals_options;
		
		return true;
	}
}

add_filter( 'wps_deals_show_page_title', 'wps_deals_show_the_page_title' );

/* **************************************************************************
   Message Templates
   ************************************************************************** */

if( !function_exists( 'wps_deals_single_header_message' ) ){

	/**
	 * Loads the single header message template (added item successfully).
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_header_message() {
	
		global $wps_deals_options;
		
		//Get payment checkout page
		$payment_checkout_page	= isset( $wps_deals_options['payment_checkout_page'] ) ? $wps_deals_options['payment_checkout_page'] : '';
		
		// get the checkout url 
		$checkouturl = get_permalink( $payment_checkout_page );
		
		// set the args, which we will pass to the template
		$args = array( 
						'checkouturl' => $checkouturl,
					);
		
		// get the template
		wps_deals_get_template( 'notices/success.php', $args );
	}	
}

if( !function_exists( 'wps_deals_empty_cart_message' ) ) {
	
	/**
	 * Loads the empty cart message template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_empty_cart_message() {
		
		global $wps_deals_message, $wps_deals_session, $wps_deals_options;
				
		$undo = false;		
		$undo_url = '';
		$dealid = '';
		
		// check if undo is set in messages
		if ( $wps_deals_message->size( 'undo' ) > 0 ) {			
			$undo = true;
			$removed_cart_item = $wps_deals_session->get('wps_deals_removed_cart_contents');
			$dealid = $removed_cart_item['dealid'];
			$undo_url = wps_deals_get_undo_url( $dealid );
		}				
		
		$deals_shop_page = isset($wps_deals_options['shop_page'] ) ? $wps_deals_options['shop_page'] : '' ;
		
		$deals_shop_url = get_permalink($deals_shop_page);
		
		$args = array(
			'undo' => $undo,
			'dealid' => $dealid,
			'undo_url' => $undo_url,
			'deals_shop_url'=>$deals_shop_url
		);
		
		// get the template
		wps_deals_get_template( 'notices/empty-cart.php', $args );		
	}
}


/* **************************************************************************
   Deals Home Page Templates
   ************************************************************************** */

if( !function_exists( 'wps_deals_home_header' ) ) {
	
	/**
	 * Loads the header deal template.
	 *
	 * This displays the deals at the top of the deals home page
	 * but only if the displaying on the home page option is set
	 * to yes within the meta box settings.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_header( $args = array() ) {
	
		global $wps_deals_options;
		
		// get the todays date and time
		$today	= wps_deals_current_date();
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// Get argument
		$num_deals = isset($args['num_deals']) ? $args['num_deals'] : -1;
		
		// set the meta_query args
		$home_meta_args = array( 
								array ( 	
										'key' => $prefix . 'show_on_home',
										'value' => '1',
										'compare' => '=',
										'type' => 'STRING'
										),
								array (
										'key' => $prefix . 'start_date',
										'value' => $today,
										'compare' => '<=',
										'type' => 'STRING'
										),
								array (
										'key' => $prefix . 'end_date',
										'value' => $today,
										'compare' => '>=',
										'type' => 'STRING'
										)
								);
								
		// get the orderby value from the settings
		$orderby = ( isset( $wps_deals_options['deals_home'] ) && !empty( $wps_deals_options['deals_home'] ) ) ? $wps_deals_options['deals_home'] : 'rand';	
							
		// set the query args
		$home_deal = array( 
							'post_type' => WPS_DEALS_POST_TYPE, 
							'post_status' => 'publish' , 
							'posts_per_page' => $num_deals, 
							'meta_query' => $home_meta_args,
							'order' => 'DESC',
							'orderby' => $orderby
							);
		 
		// create the loop	
		$loop_home = null;
		$loop_home = new WP_Query();
		$loop_home->query( $home_deal );
		 
		// set the args, which we will pass to the template
		$args = array( 
						'loop' => $loop_home
					);
		
					
		// get the template
		wps_deals_get_template( 'home-deals/header.php', $args );	
	}	
}

if( !function_exists( 'wps_deals_home_header_left' ) ) {

	/**
	 * Loads the left header template (Title, Image, Excerpt).
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_left() {
	
		// get the template
		wps_deals_get_template( '/home-deals/header/left.php' );
	}
}

if( !function_exists( 'wps_deals_home_header_right' ) ) {

	/**
	 * * Loads the right header template (Deal Info).
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_right() {
	
		// get the template
		wps_deals_get_template( '/home-deals/header/right.php' );
	}
}

if( !function_exists( 'wps_deals_home_header_title' ) ) {
	
	/**
	 * Loads the title template (header deal).
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_title() {
		
		global $post;
		
		// set the args, which we will pass to the template
		$args = array( 
						'dealtitle' => get_the_title( $post->ID )
					);
		
		// get the template
		wps_deals_get_template( 'home-deals/header/title.php', $args );		
	}
}

if( !function_exists( 'wps_deals_home_header_image' ) ) {
	
	/**
	 * Loads the image template (header deal).
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_image() {
	
		global $post,$wps_deals_price;
		$dealimg = $image_url = '';
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the product price
		$productprice = $wps_deals_price->wps_deals_get_price( $post->ID );
		
		// get the image
		$deal_main_image = get_post_meta( $post->ID, $prefix . 'main_image', true );
		
		// add filter to change deal main image of deal by third party plugin
		$deal_main_image['src'] = apply_filters( 'wps_deals_main_image_src', $deal_main_image['src'], $post->ID );

		// get main deal image
		$dealimage = get_the_post_thumbnail( $post->ID, 'wpsdeals-single', array( 	
																					'alt' => trim( strip_tags( $post->post_title ) ), 
																					'title'	=> trim( strip_tags( $post->post_title ) ) 
																					) );
		
		// add filter to change feature image of deal by third party plugin
		$dealimage = apply_filters( 'wps_deals_feature_image_src', $dealimage, $post->ID );
				
		if( !empty( $deal_main_image['src'])){
			$image_url=$deal_main_image['src'];
		} elseif ( !empty( $dealimage ) ) {
			$dealimg= $dealimage;
		} else {
			//no image
			$image_url=apply_filters( 'wps_deals_default_img_src', WPS_DEALS_URL.'includes/images/deals-no-image-big.jpg' );
		}
		
		// set the args for the home deal, which we will pass to the template
		$args = array( 
						'dealtitle' => get_the_title( $post->ID ),
						'dealimgurl' => $image_url,
						'dealimg'	=>	$dealimg,
						'price' => $wps_deals_price->get_display_price( $productprice, $post->ID ),
						'dealurl' => get_permalink( $post->ID )
					);
		
		// get the template
		wps_deals_get_template( '/home-deals/header/image.php' , $args );
	}
}

if( !function_exists( 'wps_deals_home_header_excerpt' ) ) {
	
	/**
	 * Loads the content (excerpt) template (header deal).
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_excerpt() {
		
		// get the template
		wps_deals_get_template( 'home-deals/header/excerpt.php' );		
	}
}

if( !function_exists( 'wps_deals_home_header_timer' ) ) {

	/**
	 * Loads the timer template (header deal).
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_header_timer() {
		
		global $post,$wps_deals_model;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the end date
		$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
		
		if( !empty( $enddate ) ) { //check deal end date 
			
			$timerargs = array();
			
			$enddate = strtotime( $enddate );
			$timerargs['year'] = date( 'Y', $enddate );
			$timerargs['month'] = date( 'm', $enddate );
			$timerargs['day'] = date( 'd', $enddate );
			$timerargs['hours'] = date( 'H', $enddate );
			$timerargs['minute'] = date( 'i', $enddate );
			$timerargs['seconds'] = date( 's', $enddate );	

			// counter timer script
			wp_enqueue_script( 'wps-deals-countdown-timer-scripts' );
			
			// get the template
			wps_deals_get_template( 'home-deals/header/timer.php', $timerargs );
		}	
	}
}

if( !function_exists( 'wps_deals_home_header_discount' ) ) {

	/**
	 * Loads the discount template (header deal).
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_discount() {
		
		global $post,$wps_deals_price;
		
		// get the discount 
		$discount = $wps_deals_price->wps_deals_get_discount( $post->ID );
		
		if(!empty($discount) && $discount != '0%') {
			
			// set the args, which we will pass to the template
			$args = array( 
							'discount' => $discount
						);
			
			// get the template
			wps_deals_get_template( 'home-deals/header/discount.php', $args );		
		
		}
	}
}

if( !function_exists( 'wps_deals_home_header_value' ) ) {
	
	/**
	 * Loads the value template (header deal).
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_value() {
		
		global $post,$wps_deals_price;
	
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the normal price
		$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
		
		// get the displaying price
		$displaynormalprice = $wps_deals_price->get_display_price( $normalprice, $post->ID );
		
		if ( $normalprice !== '' ) {
			
			// set the args, which we will pass to the template
			$args = array( 
							'normalprice' => $displaynormalprice
						);
			
			// get the template
			wps_deals_get_template( 'home-deals/header/value.php', $args );		
		}
	}
}

if( !function_exists( 'wps_deals_home_header_save' ) ) {

	/**
	 * Loads the saving template (header deal).
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_save() {
		
		global $post,$wps_deals_price;
	
		// get the saving value
		$yousave = $wps_deals_price->wps_deals_get_savingprice( $post->ID );
		
		// get the discount 
		$discount = $wps_deals_price->wps_deals_get_discount( $post->ID );
		
		if(!empty($discount) && $discount != '0%') {
		
			// set the args, which we will pass to the template
			$args = array( 
							'savingprice' => $yousave
						);
			
			// get the template
			wps_deals_get_template( 'home-deals/header/save.php', $args );		
		
		}
	}
}

if( !function_exists( 'wps_deals_home_header_rating' ) ) {

	/**
	 * Loads the rating template.
	 *
	 * Supports on the social review engine from wpsocial.com
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_header_rating() {
		
		// check if the social review engine plugin is activated
		if( class_exists( 'Wps_Fbre_Model' ) ) { 
	
			global $wps_fbre_model,$post;
			
			// get the average rating
			$rating = round( $wps_fbre_model->wps_fbre_post_average_ratings( $args = array( 'post_id' => $post->ID ) ) );
			
			// set the args, which we will pass to the template
			$args = array( 
							'rating' => $rating
						);
		
			// get the template
			wps_deals_get_template( 'home-deals/header/ratings.php', $args );
		}
	}
}

if( !function_exists( 'wps_deals_home_header_see_deal' ) ) {

	/**
	 * Loads the deals 'see deal' big button template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_header_see_deal() {
	
		global $post,$wps_deals_options,$wps_deals_price;
	
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$disable_price	= ( isset( $options['disable_price'] ) && $options['disable_price'] == 'true' ) ? true : false;
		
		if( !$disable_price ) {		
		
			// get the value for the normal price
			$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
			
			// get the normal price
			$displaynormalprice = $wps_deals_price->get_display_price( $normalprice, $post->ID );
			
			// get the display price
			$dealprice = $wps_deals_price->wps_deals_get_price( $post->ID );
			
			$displayprice = $wps_deals_price->get_display_price( $dealprice, $post->ID );
			
			if ( $normalprice !== '' || $dealprice !== '' ) {
				
				// set the args, which we will pass to the template
				$args = array( 
								'dealurl' => get_permalink( $post->ID ),
								'btncolor' => $btncolor
							);
				
				// get the template
				wps_deals_get_template( 'buttons/button-big.php', $args );
			}
		}
	}
}


/* **************************************************************************
   More Deals Templates (Deals Home Page)
   ************************************************************************** */

if( !function_exists( 'wps_deals_home_content' ) ) {

	/**
	 * Loads the more deals content template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_content( $deals_data = '' ) {
	
		$deals_status = isset( $deals_data ) ? explode( ',',$deals_data ) : '';
		
		if( array_intersect($deals_status, array('active', 'upcoming', 'ending-soon') ) ) {
			
			// set the args for the home deal, which we will pass to the template
			$args = array(
							'deals_status'	=> $deals_data
			);
			
		} else {
			
			// set the args for the home deal, which we will pass to the template
			$args = array( 
							'category'	=> $deals_data
						);
		}

		// get the template
		wps_deals_get_template( 'home-deals/more-deals.php', $args );			
	}
}
   
if( !function_exists( 'wps_deals_home_navigations' ) ) {

	/**
	 * Loads the deals navigation template (Active, Ending Soon, Upcoming).
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_navigations( $deals_data ) {
	
		global $wps_deals_options;
		
		//check disable more deals is set or not
		if( empty( $wps_deals_options['disable_more_deals'] ) ) {			
					
			// get the template
			wps_deals_get_template( 'home-deals/more-deals/navigation.php', $deals_data );
		}
	}
}   

if( !function_exists( 'wps_deals_home_more_deal_active' ) ) {

	/**
	 * Loads the more active deals template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_more_deal_active( $deals_data ) {
		
		if( isset( $deals_data['deals_status'] ) ) {
			
			$deals_status = explode( ',', $deals_data['deals_status'] );
			
			if( !in_array('active', $deals_status, true) ) {
				
				return;
			}
		}
		
		$category = isset($deals_data['category']) ? $deals_data['category'] : '';
		
		global $wps_deals_options, $wps_deals_model;
		
		// get today's date and time
		$today = wps_deals_current_date();
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$order_args = $wps_deals_model->wps_deals_get_deals_ordering_args();
		
		// get the page limit from the plugin settings, so we know how many deals to display
		$pagelimit = isset( $wps_deals_options['deals_per_page'] ) ? $wps_deals_options['deals_per_page'] : -1;
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';			
		
		// get current page value
		if( isset( $_POST['paging'] ) ) {
			$paged = $_POST['paging'];
		} else {
			$paged = '1';			
		}
		
		// set the deal home page args
		$_homeargs = array( 
							'post_type' => WPS_DEALS_POST_TYPE,
							'post_status' => 'publish' ,
							'posts_per_page' => $pagelimit,
							'paged' => $paged,
							'cat' => -0
						);
		
		$homeargs = array_merge( $_homeargs, $order_args );
		
		// set the active deals query for the home page
		$activemetaquery = array( 
									array (
											'key' => $prefix.'start_date',
											'value' => $today,
											'compare' => '<=',
											'type' => 'STRING'
											),
									array (
											'key' => $prefix.'end_date',
											'value' => $today,
											'compare' => '>=',
											'type' => 'STRING'
											)
									);
		
		// merge and set the args
		$activeargs = array_merge( $homeargs, array( 'meta_query' => $activemetaquery ) );
	
		// check if the category id is set
		if( isset( $category ) && !empty( $category ) ) { 
			$activeargs[WPS_DEALS_POST_TAXONOMY] = $category;
		}
		
		// counter timer script
		wp_enqueue_script( 'wps-deals-countdown-timer-scripts' );
		
		// set the args, which we will pass to the template
		$args = array( 
						'args' => $activeargs,
						'tab' => 'active',
						'btncolor' => $btncolor
					);
		
		//active deals template
		wps_deals_get_template( 'home-deals/more-deals/more-deals.php', $args );
	}
}

if( !function_exists( 'wps_deals_home_more_deal_ending' ) ) {

	/**
	 * Loads the "Ending Soon" content.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_more_deal_ending( $deals_data ) {
		
		if( isset( $deals_data['deals_status'] ) ) {
			
			$deals_status = explode( ',', $deals_data['deals_status'] );
			
			if( !in_array('ending-soon', $deals_status, true) ) {
				
				return;
			}
		}
		
		$category = isset($deals_data['category']) ? $deals_data['category'] : '';
		
		global $wps_deals_options, $wps_deals_model;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get today's date and time
		$today = wps_deals_current_date();
		
		// get the page limit from the plugin settings page
		$pagelimit = isset( $wps_deals_options['deals_per_page'] ) ? $wps_deals_options['deals_per_page'] : -1;
		
		$order_args = $wps_deals_model->wps_deals_get_deals_ordering_args();
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';		
		
		// get current page value
		if( isset( $_POST['paging'] ) ) {
			$paged = $_POST['paging'];
		} else {
			$paged = '1';			
		}
		
		// set the home page args
		$_homeargs = array(  
							'post_type' => WPS_DEALS_POST_TYPE, 
							'post_status' => 'publish' , 
							'posts_per_page' => $pagelimit,
							'paged' => $paged,
							'cat' => -0 
						);
		
		$homeargs = array_merge( $_homeargs, $order_args );
		
		// get the ending deals amount in days from the settings page
		$ending_days = $wps_deals_options['ending_deals_in'];
		$ending_deals_days = date( 'Y-m-d H:i:s', strtotime( '+' . $ending_days . ' days' ) );
			
		// set the meta query
		$endmetaquery = array( 
								array ( 	
										'key' => $prefix . 'end_date',
										'value' => $ending_deals_days,
										'compare' => '<=',
										'type' => 'STRING'
										),
								array ( 	
										'key' => $prefix . 'start_date',
										'value' => $today,
										'compare' => '<=',
										'type' => 'STRING'
										),
								array ( 	
										'key' => $prefix . 'end_date',
										'value' => $today,
										'compare' => '>=',
										'type' => 'STRING'
										)
						 );
					
		// merge arrays and set the args
		$argsend = array_merge( $homeargs, array( 'meta_query'	=> $endmetaquery ) );
					
		// check if the category id is set
		if( isset( $category ) && !empty( $category ) ) { //check category id is set or not
			$args_end[WPS_DEALS_POST_TAXONOMY] = $category;
		}
		
		// set the args, which we will pass to the template
		$args = array( 
						'args' => $argsend,
						'tab' => 'ending-soon',
						'btncolor' => $btncolor
					);
					
		// get the template
		wps_deals_get_template( 'home-deals/more-deals/more-deals.php', $args );
	}
}

if( !function_exists( 'wps_deals_home_more_deal_upcoming' ) ) {

	/**
	 * Loads the "Upcoming" content.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_home_more_deal_upcoming( $deals_data ) {
		
		if( isset( $deals_data['deals_status'] ) ) {
			
			$deals_status = explode( ',', $deals_data['deals_status'] );
			
			if( !in_array('upcoming', $deals_status, true) ) {
				
				return;
			}
		}
		
		$category = isset($deals_data['category']) ? $deals_data['category'] : '';
		
		global $wps_deals_options, $wps_deals_model;
		
		// get today's date and time
		$today	= wps_deals_current_date();
		
		$prefix = WPS_DEALS_META_PREFIX;	
		
		// get the page limit from the plugin settings page
		$pagelimit = isset( $wps_deals_options['deals_per_page'] ) ? $wps_deals_options['deals_per_page'] : -1;
		
		$order_args = $wps_deals_model->wps_deals_get_deals_ordering_args();
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';				
		
		// get current page value
		if( isset( $_POST['paging'] ) ) {
			$paged = $_POST['paging'];
		} else {
			$paged = '1';			
		}
		
		// set the home page args
		$_homeargs = array(  
							'post_type' => WPS_DEALS_POST_TYPE, 
							'post_status' => 'publish' , 
							'posts_per_page' => $pagelimit,
							'paged' => $paged,
							'cat' => -0  
						);
		
		$homeargs = array_merge( $_homeargs, $order_args );
		
		// get the upcoming deals amount in days from the settings page
		$upcoming_days = $wps_deals_options['upcoming_deals_in'];
		$upcoming_deal_days = date( 'Y-m-d H:i:s', strtotime( '+' . $upcoming_days . ' days' ) );
		
		// set the meta query args
		$upcomingmetaquery = array( 
									array ( 	
											'key' => $prefix . 'start_date',
											'value' => $upcoming_deal_days,
											'compare' => '<=',
											'type' => 'STRING'
											),
									array(		
											'key' => $prefix . 'start_date',
											'value' => $today,
											'compare' => '>',
											'type' => 'STRING'
										)
								 );
		
		// merge arrays and set the args
		$argsupcoming = array_merge( $homeargs, array( 'meta_query' => $upcomingmetaquery ) );
		
		// check if the category id is set	
		if( isset( $category ) && !empty( $category ) ) { 
			$argsupcoming[WPS_DEALS_POST_TAXONOMY] = $category;
		}
			
		// set the args, which we will pass to the template
		$args = array( 
						'args' => $argsupcoming,
						'tab' => 'upcoming-soon',
						'btncolor' => $btncolor
					);
		
		// get the template
		wps_deals_get_template( 'home-deals/more-deals/more-deals.php', $args );
	}
}

if( !function_exists( 'wps_deals_home_more_deals_discount' ) ) {

	/**
	 * Loads the discount value template for the more deals on the deals home page.
	 *  
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_more_deals_discount() {
		
		global $post,$wps_deals_price;
		
		// get the discount
		$discount = $wps_deals_price->wps_deals_get_discount( $post->ID );
		
		if(!empty($discount) && $discount != '0%') {
			// set the args, which we will pass to the template
			$args = array( 
							'discount' => $discount
						);
			
			// get the template
			wps_deals_get_template( 'home-deals/more-deals/discount.php', $args );
		}
	}
}

if( !function_exists( 'wps_deals_home_more_deals_image' ) ) {

	/**
	 * Loads the image template for the more deals on the deals home page.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	function wps_deals_home_more_deals_image() {
		
		global $post;
		$prefix = WPS_DEALS_META_PREFIX; 
		$dealmainimg = $dealimg = '';
		
		// get main deal image
		$dealimage = get_the_post_thumbnail( $post->ID, 'wpsdeals-single', array( 	
																					'alt' => trim( strip_tags( $post->post_title ) ), 
																					'title'	=> trim( strip_tags( $post->post_title ) ) 
																					) );
																					
		// add filter to change feature image of deal by third party plugin
		$dealimage = apply_filters( 'wps_deals_feature_image_src', $dealimage, $post->ID );
		
		// get main deal image
		$deal_main_image = get_post_meta( $post->ID, $prefix . 'main_image', true );
		 
		// add filter to change deal main image of deal by third party plugin
		$deal_main_image['src'] = apply_filters( 'wps_deals_main_image_src', $deal_main_image['src'], $post->ID );
				
		if( !empty( $deal_main_image['src'])){
			$dealmainimg=$deal_main_image['src'];
		} elseif ( !empty( $dealimage ) ) {
			$dealimg= $dealimage;
		} else {
			//no images
			$dealmainimg=apply_filters( 'wps_deals_default_img_src', WPS_DEALS_URL.'includes/images/deals-no-image-big.jpg' );
		}
		
		// set the args, which we will pass to the template
		$args = array( 
						'dealmainimg'=>$dealmainimg,
						'dealimg' => $dealimg,
						'dealurl' => get_permalink( $post->ID ),
						'dealtitle' => get_the_title( $post->ID )
					);
		
		// get the template
		wps_deals_get_template( 'home-deals/more-deals/image.php', $args );
	}
}

if( !function_exists( 'wps_deals_home_more_deals_timer' ) ) {
	
	/**
	 * Loads the timer template for the more deals on the deals home page.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_more_deals_timer( $options = array() ) {
		
		global $post;
	
		$prefix = WPS_DEALS_META_PREFIX;
		
		$disable_timer	= ( isset( $options['disable_timer'] ) && $options['disable_timer'] == 'true' ) ? true : false;
		
		if( !$disable_timer ) {
			
			// get the value for the deal end date from the post meta box
			$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
			
			if( !empty( $enddate ) ) {
			
				// counter timer script
				wp_enqueue_script( 'wps-deals-countdown-timer-scripts' );
			
				// set the args, which we will pass to the template
				$args = array( 
								'year' => date( 'Y', strtotime( $enddate ) ),
								'month' => date( 'm', strtotime( $enddate ) ),
								'day' => date( 'd', strtotime( $enddate ) ),
								'hours' => date( 'H', strtotime( $enddate ) ),
								'minute' => date( 'i', strtotime( $enddate ) ),
								'seconds' => date( 's', strtotime( $enddate ) )
							);
			
				// get the template
				wps_deals_get_template( 'home-deals/more-deals/timer.php', $args );		
			}
		
		}
	}
}

if( !function_exists( 'wps_deals_home_more_deals_title' ) ) {
	
	/**
	 * Loads the deal value template for the more deals on the deals home page.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_more_deals_title() {
		
		global $post;
		
		// set the args, which we will pass to the template
		$args = array( 
						'dealtitle' => get_the_title( $post->ID ),
						'deallink' => get_permalink( $post->ID )
					);
		
		// get the template
		wps_deals_get_template( 'home-deals/more-deals/title.php', $args );
	}
}

if( !function_exists( 'wps_deals_home_more_deals_price' ) ) {

	/**
	 * Loads the price template for the more deals on the deals home page.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_home_more_deals_price( $options = array() ) {
		
		global $post,$wps_deals_price;
	
		$prefix = WPS_DEALS_META_PREFIX;
		
		$disable_price	= ( isset( $options['disable_price'] ) && $options['disable_price'] == 'true' ) ? true : false;
		
		if( !$disable_price ) {		
		
			// get the value for the normal price
			$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
			
			// get the normal price
			$displaynormalprice = $wps_deals_price->get_display_price( $normalprice, $post->ID );
			
			// get the display price
			$dealprice = $wps_deals_price->wps_deals_get_price( $post->ID );
			
			$displayprice = $wps_deals_price->get_display_price( $dealprice, $post->ID );
			
			if ( $normalprice !== '' || $dealprice !== '' ) {
				
				// set the args, which we will pass to the template
				$args = array( 
								'specialprice' => $displayprice,
								'normalprice' => $displaynormalprice
							);
				
				// get the template
				wps_deals_get_template( 'home-deals/more-deals/price.php', $args );
			}
		}
	}
}

if( !function_exists( 'wps_deals_home_more_deals_see_deal' ) ) {
	
	/**
	 * Loads the "See Deal" button for more deals on the deals home page.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	
	function wps_deals_home_more_deals_see_deal() {
		
		global $post,$wps_deals_options,$wps_deals_price;
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$disable_price	= ( isset( $options['disable_price'] ) && $options['disable_price'] == 'true' ) ? true : false;
		
		if( !$disable_price ) {						
				
			// set the args, which we will pass to the template
			$args = array( 
							'dealurl' => get_permalink( $post->ID ),
							'btncolor' => $btncolor
						);
			
			// get the template
			wps_deals_get_template( 'buttons/button-small.php', $args );
		}		
	}
}


/* **************************************************************************
   Deals Archive Templates
   ************************************************************************** */
   
if( !function_exists( 'wps_deals_archive_deals_content' ) ) {

	/**
	 * Loads the Deals archive template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */	
	function wps_deals_archive_deals_content() {
		
		global $wps_deals_options, $wps_deals_model, $post;
		
		// get today's date and time
		$today = wps_deals_current_date();
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$order_args = $wps_deals_model->wps_deals_get_deals_ordering_args();
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		// get the page limit from the plugin settings, so we know how many deals to display
		$pagelimit = isset( $wps_deals_options['deals_per_page'] ) ? $wps_deals_options['deals_per_page'] : -1;
		
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
		// get the taxonomy slug
		$slug = get_query_var( WPS_DEALS_POST_TAXONOMY );
		$tags_slug = get_query_var( WPS_DEALS_POST_TAGS );		
		
		if( !empty( $slug ) ) {

			// set the deal home page args
			$_homeargs = array( 
								'post_type' => WPS_DEALS_POST_TYPE,
								'post_status' => 'publish',
								'paged' => $paged,
								'tax_query' => array(
												array(
													'taxonomy' => WPS_DEALS_POST_TAXONOMY,
													'field' => 'slug',
													'terms' => $slug
												)
											)
								);
								
		} else if(!empty( $tags_slug )) {
			// set the deal home page args
			$_homeargs = array( 
								'post_type' => WPS_DEALS_POST_TYPE,
								'post_status' => 'publish',
								'paged' => $paged,
								'tax_query' => array(
												array(
													'taxonomy' => WPS_DEALS_POST_TAGS,
													'field' => 'slug',
													'terms' => $tags_slug
												)
											)
								);
			
		} else {
		
			// set the deal home page args
			$_homeargs = array( 
								'post_type' => WPS_DEALS_POST_TYPE,
								'post_status' => 'publish',
								'paged' => $paged
								);
		}
		
		$homeargs = array_merge( $_homeargs, $order_args );
		
		// set the active deals query for the home page
		$activemetaquery = array( 
									array (
											'key' => $prefix.'start_date',
											'value' => $today,
											'compare' => '<=',
											'type' => 'STRING'
											),
									array (
											'key' => $prefix.'end_date',
											'value' => $today,
											'compare' => '>=',
											'type' => 'STRING'
											)
									);
									
		// merge and set the args
		$activeargs = array_merge( $homeargs, array( 'meta_query' => $activemetaquery ) );
		
		// apply filter for add archive page argument if any
		$activeargs	= apply_filters( 'wps_deals_add_archive_page_args', $activeargs );
		
		// counter timer script
		wp_enqueue_script( 'wps-deals-countdown-timer-scripts' );
		
		// set the args, which we will pass to the template
		$args = array( 
						'args' => $activeargs,
						'btncolor' => $btncolor
					);
		
		// get the template
		wps_deals_get_template( 'archive/archive-deals.php', $args );
	}
}

if ( ! function_exists( 'wps_deals_archive_description_content' ) ) {

	/**
	 * Show a shop page description on deals archives
	 *
	 * @access public	 
	 * @package Social Deals Engine
	 * @subpackage	Archives
	 * @since 2.1.0
	 * @return void
	 */
	function wps_deals_archive_description_content() {
		if ( is_post_type_archive( WPS_DEALS_POST_TYPE ) && get_query_var( 'paged' ) == 0 ) {
			$shop_page   = get_post( wps_deals_get_page_id( 'shop_page' ) );
			if ( $shop_page ) {
				$description = do_shortcode( $shop_page->post_content );
				if ( $description ) {
					echo '<div class="page-description deals-col-12">' . $description . '</div>';
				}
			}
		}
	}
}


/* **************************************************************************
   Social Sharing Button Templates
   ************************************************************************** */
   
if( !function_exists( 'wps_deals_social_buttons' ) ) {

	/**
	 * Loads the deals social buttons template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_buttons() {
		
		// get the template
		wps_deals_get_template( 'single-deal/social-buttons/social-buttons.php' );		
	}
}
    
if( !function_exists( 'wps_deals_social_facebook' ) ) {

	/**
	 * Loads the social sharing Facebook button.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_facebook() {
		
		global $post,$wps_deals_options;
		
		// first we need to check if the Facebook button is enabled
		if( isset( $wps_deals_options['social_buttons'] ) && in_array( 'facebook', $wps_deals_options['social_buttons'] ) ) {
			
			// enqueue the Facebook script
			wp_enqueue_script( 'facebook' );
			
			// set the args, which we will pass to the template
			$args = array( 
							'dealurl' => get_permalink( $post->ID ),
							'dealid' => $post->ID
						);
						
			// get the template		
			wps_deals_get_template( 'single-deal/social-buttons/facebook.php', $args );
		}
	}	
}

if( !function_exists( 'wps_deals_social_twitter' ) ) {

	/**
	 * Loads the social sharing Twitter button.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_twitter() {
		
		global $post,$wps_deals_options;
		
		// first we need to check if the Twitter button is enabled
		if( isset( $wps_deals_options['social_buttons'] ) && in_array( 'twitter', $wps_deals_options['social_buttons'] ) ) {
			
			$twitteruser = isset( $wps_deals_options['tw_user_name'] ) ? $wps_deals_options['tw_user_name'] : '';
			
			// set the args, which we will pass to the template 
			$args = array( 
							'dealurl' => get_permalink( $post->ID ), 
							'dealid' => $post->ID,
							'dealtitle' => get_the_title( $post->ID ),
							'twitteruser' => $twitteruser
						 );
			
			// enqueue the Twitter script
			wp_enqueue_script( 'twitter' );

			// get the template
			wps_deals_get_template( 'single-deal/social-buttons/twitter.php', $args );
		}
	}	
}

if( !function_exists( 'wps_deals_social_google' ) ) {
	
	/**
	 * Loads the social sharing Google Plus button.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_google() {
		
		global $post,$wps_deals_options;
		
		// first we need to check if the Google Plus button is enabled
		if( isset( $wps_deals_options['social_buttons'] ) && in_array( 'google', $wps_deals_options['social_buttons'] ) ) {

			// set the args, which we will pass to the template
			$args = array( 
							'dealurl' => get_permalink( $post->ID ), 
							'dealid' => $post->ID
						);

			// enqueue the Google Plus script
			wp_enqueue_script( 'google' );
			
			// get the template
			wps_deals_get_template( 'single-deal/social-buttons/google.php', $args );
		}
	}	
}


/* **************************************************************************
   Single Deal Page Templatess
   ************************************************************************** */

if( !function_exists( 'wps_deals_single_header_title' ) ){

	/**
	 * Loads the Deal title template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_header_title() {
	
		// get the template
		wps_deals_get_template( 'single-deal/title.php' );
	}	
}

if( !function_exists( 'wps_deals_single_header_left' ) ){

	/**
	 * Loads the left header template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_header_left() {
	
		// get the template
		wps_deals_get_template( 'single-deal/left.php' );
	}	
}

if( !function_exists( 'wps_deals_single_deal_price' ) ) {
		
	/**
	 * Loads the price template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_deal_price() {
		
		global $post,$wps_deals_price;
			
		// get the product price
		$productprice = $wps_deals_price->wps_deals_get_price( $post->ID );
		
		//if (!empty($productprice)) {		
		if ($productprice !== '' ) {
		
			// get the displaying price
			$displayprice = $wps_deals_price->get_display_price( $productprice, $post->ID );
			
			// set the args, which we will pass to the template
			$args = array( 
							'dealprice' => $displayprice,
						);
			
			// get the template
			wps_deals_get_template( 'single-deal/price.php', $args );		
		}
	}
}

if( !function_exists( 'wps_deals_single_dime_sale' ) ) {
	
	/**
	 * Loads the dime sale template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_dime_sale() {
		
		global $post,$wps_deals_model;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the deal type
		$wps_deal_type = $wps_deals_model->wps_deals_get_deal_type( $post->ID );
		
		if( $wps_deal_type != 'affiliate' )	{
				
			// get today's date and time
			$today = wps_deals_current_date();
			
			// get the amount of available deals
			$available = get_post_meta( $post->ID, $prefix . 'avail_total', true );
			
			// get the start date & time
			$startdate = get_post_meta( $post->ID,$prefix.'start_date', true );
			
			// get the end date & time
			$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
			
			// when deal expired
			$dealexpired = false;
		
			// check if we have some available deals
			if( $available == '' ) {
			
			} elseif ( $available == '0' ) { 
				$dealexpired = true; 
			} else {
			
			}
			
			// get the dime sale ratio
			$dimsaleratio = get_post_meta( $post->ID, $prefix . 'inc_ratio', true );
			
			// get the dime sale price 
			$dimsaleprice = get_post_meta( $post->ID, $prefix . 'inc_price', true );
			
			// get dime sale is activated
			$dimsaleamt = get_post_meta( $post->ID, $prefix . 'nxt_inc_period', true );
		
			$lefttext = '';
			
			if( !empty( $dimsaleprice ) && !empty( $dimsaleratio ) ) {
				// calculate how many copies are left for the same price
				$leftcopies = ( $dimsaleratio - $dimsaleamt );
				$lefttext = apply_filters( 'wps_deals_dim_sale_text', sprintf( __( 'Only %1$s left at this price', 'wpsdeals' ), $leftcopies ) ); 
			}
			
			// check if the deal is active and still available
			if( $enddate >= $today && $startdate <= $today && $dealexpired != true ) {
			
				// set the args, which we will pass to the template
				$args = array( 
								'lefttext' => $lefttext
							);
				
				// get the template
				wps_deals_get_template( 'single-deal/dime-sale.php', $args );
			}
		}	
	}	
}

if( !function_exists( 'wps_deals_single_add_to_cart' ) ) {
	
	/**
	 * Loads Single Deal Add to Cart Button Template
	 * 
	 * Handles to load add to cart button template
	 * on single deal page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_add_to_cart() {
		
		global $post,$wps_deals_price;
		
		$prefix = WPS_DEALS_META_PREFIX;			
				
		//today's date time
		//$today = date('Y-m-d H:i:s');
		$today	= wps_deals_current_date();
		
		//get the value for available deals from the post meta box
		$available = get_post_meta($post->ID,$prefix.'avail_total',true);
		
		//get the value for start date & time of deals from the post meta box
		$startdate = get_post_meta($post->ID,$prefix.'start_date',true);
		
		//get the value for end date & time of deals from the post meta box
		$enddate = get_post_meta($post->ID,$prefix.'end_date',true);
		
		//when deal expired
		$dealexpired = false;
		
		if ( ( !empty( $enddate ) && $enddate <= $today )  || $available == '0' ) {
			//$availdeals =  __('Out of Stock','wpsdeals');
			$dealexpired = true;
		}
		
		// check if the deals is still active
		if( $enddate >= $today && $startdate <= $today && $dealexpired != true ) {
			
			// get the template
			wps_deals_get_template( 'single-deal/add-to-cart.php' );
			
		} else if ( $dealexpired == true ) {  // if deal is expired or sold out			
			
			wps_deals_single_deal_expired();			
		} 		
	}
}

if( !function_exists( 'wps_deals_single_value' ) ) {
		
	/**
	 * Loads the normal price template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_value() {
		
		global $post,$wps_deals_price;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the normal price
		$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
		
		if( $normalprice !== '' && !empty( $normalprice ) ) {
		
			// get the displaying price
			$displayprice = $wps_deals_price->get_display_price( $normalprice, $post->ID );
			
			if ($displayprice) {
				
				// set the args, which we will pass to the template
				$args = array( 
								'price' => $displayprice
							);
				
				// get the template
				wps_deals_get_template( 'single-deal/value.php', $args );
			
			}
		}
	}
}

if( !function_exists( 'wps_deals_single_discount' ) ) {
		
	/**
	 * Loads the discount template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_discount() {
		
		global $post,$wps_deals_price;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the discount 
		$discount = $wps_deals_price->wps_deals_get_discount( $post->ID );
		
		//get the normal price
		$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
		
		if( $normalprice !== '' && !empty( $normalprice ) ) {
		
			// set the args, which we will pass to the template
			$args = array( 
							'discount' => $discount
						);
			
			// get the template
			wps_deals_get_template( 'single-deal/discount.php', $args );		
		}
	}
}

if( !function_exists( 'wps_deals_single_save' ) ) {
		
	/**
	 * Loads the deal saving template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_save() {
		
		global $post,$wps_deals_price;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the saving value
		$yousave = $wps_deals_price->wps_deals_get_savingprice( $post->ID );	
		
		//get the normal price
		$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
		
		if( $normalprice !== '' && !empty( $normalprice ) ) {
		
			// set the args, which we will pass to the template
			$args = array( 
							'savingprice' => $yousave
						);
			
			// get the template
			wps_deals_get_template( 'single-deal/save.php', $args );			
		}	
	}
}

if( !function_exists( 'wps_deals_single_deal_timer' ) ) {
	
	/**
	 * Loads timer template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_deal_timer() {
		
		global $post,$wps_deals_model;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get today's date and time
		$today = wps_deals_current_date();
		
		// get the start date & time
		$startdate = get_post_meta( $post->ID, $prefix . 'start_date', true );
		
		// get the end date & time
		$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
		
		// check if the deal is still active
		if( $enddate >= $today ) { 
		
			// enqueue the timer script
			wp_enqueue_script( 'wps-deals-countdown-timer-scripts' );
			
			// check that the start or end date ar not empty
			if( !empty( $startdate ) || !empty( $enddate ) ) { 
				// check if the start date is in the future
				if( $startdate >= $today ) {
					$counterdate = $startdate;
				} else {
					$counterdate = $enddate;
				}
			}
			
			// set the args, which we will pass to the template
			$args = array( 
							'startdate' => $startdate, 
							'enddate' => $enddate,
							'today' => $today,
							'year' => date( 'Y', strtotime( $counterdate ) ),
							'month' => date( 'm', strtotime( $counterdate ) ),
							'day' => date( 'd', strtotime( $counterdate ) ),
							'hours' => date( 'H', strtotime( $counterdate ) ),
							'minute' => date( 'i', strtotime( $counterdate ) ),
							'seconds' => date( 's', strtotime( $counterdate ) )
						);
			
			// get the template
			wps_deals_get_template( 'single-deal/timer.php', $args );
		}		
	}	
}

if( !function_exists( 'wps_deals_single_deal_avail_bought' ) ) {
	
	/**
	 * Loads the aviavle & bought template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_deal_avail_bought() {
		
		global $post,$wps_deals_model;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// Get deal type
		$wps_deal_type = $wps_deals_model->wps_deals_get_deal_type( $post->ID );
		
		// check if it's not an affiliate deal
		if( $wps_deal_type != 'affiliate' )	{
				
			// get today's date and time
			$today	= wps_deals_current_date();
			
			// get the end date & time
			$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
			
			// get the available_bought value
			$available_bought = get_post_meta( $post->ID, $prefix . 'available_bought', true );
			
			// check if the deal is still active
			if( $enddate >= $today ) { 
			
				// set the args, which we will pass to the template
				$args = array( 
								'availablebought' => $available_bought
							);
					
				// get the template
				wps_deals_get_template( 'single-deal/avail-bought.php', $args );				
			}
		}
	}	
}

if( !function_exists( 'wps_deals_single_available' ) ) {
		
	/**
	 * Loads the available box template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_available() {
		
		global $post;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the value for the amount of available deals
		$available = get_post_meta( $post->ID, $prefix . 'avail_total', true );
		
		// when deal expired
		$dealexpired = false;
		
		if( $available == '' ) {
			$available =  __( 'Unlimited', 'wpsdeals' );
		} elseif( intval( $available ) == 0 ) {
			$available =  __( 'Deal Sold Out', 'wpsdeals' );
			$dealexpired = true;
		}
		
		// set the args, which we will pass to the template
		$args = array( 
						'available' => $available
					);
		 
		// get the template
		wps_deals_get_template( 'single-deal/avail-bought/available.php', $args );		
	}
}

if( !function_exists( 'wps_deals_single_bought' ) ) {
		
	/**
	 * Loads the bought box template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_bought() {
		
		global $post;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the value for bought deals
		$boughts = get_post_meta( $post->ID, $prefix . 'boughts', true );
		
		$boughts = apply_filters( 'wps_deals_bought_value', $boughts, $post->ID );
		
		$bought = isset( $boughts ) && !empty( $boughts ) ? $boughts : '0';
		
		// set the args, which we will pass to the template
		$args = array( 
						'post_id' => $post->ID,
						'bought' => $bought
					);
		
		// get the template
		wps_deals_get_template( 'single-deal/avail-bought/bought.php', $args );
	}
}

if( !function_exists( 'wps_deals_single_header_right' ) ){

	/**
	 * Loads the right header template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_header_right() {
	
		// get the template
		wps_deals_get_template( 'single-deal/right.php' );
	}	
}

if( !function_exists( 'wps_deals_single_deal_img' ) ) { 
	
	/**
	 * Loads the image template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_deal_img() {
		
		global $post;
		$prefix = WPS_DEALS_META_PREFIX; 
		$deals_single_img = $deals_no_img_src = '';
		$deals_main_img_src = array();
		
		// get main deal image
		$deal_main_image = get_post_meta( $post->ID, $prefix . 'main_image', true );
		
		// add filter to change deal main image of deal by third party plugin
		$deal_main_image['src'] = apply_filters( 'wps_deals_main_image_src', $deal_main_image['src'], $post->ID );
		
		//get single deal image
		$deal_single_image = get_the_post_thumbnail( $post->ID, 'wpsdeals-single', array( 	
																					'alt' => trim( strip_tags( $post->post_title ) ), 
																					'title'	=> trim( strip_tags( $post->post_title ) ) 
																					) );
		 
		// add filter to change feature image of deal by third party plugin
		$deal_single_image = apply_filters( 'wps_deals_feature_image_src', $deal_single_image, $post->ID );
		
		if ( !empty($deal_main_image['src'] ) ) {
			$deals_main_img_src=$deal_main_image['src'];
		}
		elseif( !empty( $deal_single_image ) ){
			$deals_single_img=$deal_single_image;
		} else {
			$deals_no_img_src=apply_filters( 'wps_deals_default_img_src', WPS_DEALS_URL.'includes/images/deals-no-image-big.jpg' );
		}
		
		// set the args, which we will pass to the template
		$args = array( 
						'dealimg' 	=> $deals_single_img,
						'dealimgsrc'=> $deals_main_img_src,
						'dealnoimgsrc'=> $deals_no_img_src,
						'dealurl'	=> get_post_thumbnail_id( $post->ID,'wpsdeals-single' )
					);
					
		// get the template
		wps_deals_get_template( 'single-deal/image.php', $args ); 
	}
}

if( !function_exists( 'wps_deals_gallery_image' ) ) { 
	
	/**
	 * Loads the image template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_gallery_image() {
		
		global $post;

		$prefix = WPS_DEALS_META_PREFIX;
		
		// get main deal image
		$deal_gallery_ids = get_post_meta( $post->ID, $prefix . 'image_gallery', true );
		$deal_gallery_ids = trim($deal_gallery_ids);
		$deal_gallery_ids = !empty($deal_gallery_ids) ? explode(',', $deal_gallery_ids) : array();
		
		// add filter to change deal main image of deal by third party plugin
		$deal_gallery_ids = apply_filters( 'wps_deals_gallery_images', $deal_gallery_ids, $post->ID );
		
		// set the args, which we will pass to the template
		$args = array( 
						'deal_gallery_ids' => $deal_gallery_ids,
					);
		
		// get the template
		wps_deals_get_template( 'single-deal/gallery.php', $args );
	}
}

if( !function_exists( 'wps_deals_single_description' ) ){

	/**
	 * Loads the deal description template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_description() {
	
		// get the template
		wps_deals_get_template( 'single-deal/description.php' );
	}	
}







if( !function_exists( 'wps_deals_single_deal_expired' ) ) {
	
	/**
	 * Loads Single Deal Expired Template
	 * 
	 * Handles to load single deal expired
	 * template
	 *  
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_deal_expired() {
		
		global $post;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		//today's date time
		$today	= wps_deals_current_date();
		
		//get the value for available deals from the post meta box
		$available = get_post_meta($post->ID,$prefix.'avail_total',true);
		
		//get the value for start date & time of deals from the post meta box
		$startdate = get_post_meta($post->ID,$prefix.'start_date',true);
		
		//get the value for end date & time of deals from the post meta box
		$enddate = get_post_meta($post->ID,$prefix.'end_date',true);
		
		//when deal expired
		$dealexpired = false;
	
		//expired label
		$expiredtext = __( 'Deal expired', 'wpsdeals' );
		
		if ( $available == '' ) {
			//$availdeals =  __('Unlimited','wpsdeals');
		} elseif ( intval( $available ) == 0  && $enddate >= $today) { // deal out of stock
			$expiredtext = __( 'Deal Sold Out', 'wpsdeals' );
			$dealexpired = true;
		} else {
			//nothing to do
		}
		
		if( $enddate <= $today || $dealexpired == true ) {
			
			//deal expired template
			wps_deals_get_template( 'single-deal/add-to-cart/expired.php', array( 'expiredtext' => $expiredtext ) );
		}
		
	}
	
}





if( !function_exists( 'wps_deals_single_deal_ratings' ) ) { 
	
	/**
	 * Loads the ratings template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_deal_ratings() {
		
		if( class_exists( 'Wps_Fbre_Model' ) ) { // check if the social review engine plugin is activated
			
			global $post,$wps_fbre_model;
			
			$rating = round( $wps_fbre_model->wps_fbre_post_average_ratings( $args = array( 'post_id' => $post->ID ) ) );
		
			//ratings template
			wps_deals_get_template( 'single-deal/ratings.php', array( 'rating' => $rating ) );
		}
		
	}
}



   


if( !function_exists( 'wps_deals_purchase_link_button' ) ) {

	/**
	 * Loads the purchase button template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_purchase_link_button() {
		
		global $post,$wps_deals_price,$wps_deals_options,$wps_deals_model;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the purchase link for affiliate products 
		$purchaselink = get_post_meta($post->ID,$prefix.'purchase_link',true);
		
		// get the product price
		$productprice = $wps_deals_price->wps_deals_get_price( $post->ID );
		
		// get the display price
		$displayprice = $wps_deals_price->get_display_price( $productprice, $post->ID  );
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		// get the add to cart button text
		$addtocart_post = get_post_meta( $post->ID, $prefix . 'add_to_cart', true );
		if( !empty( $addtocart_post ) ) {
			$addcartbtntext = $addtocart_post;
		} else {
			$addcartbtntext = isset( $wps_deals_options['add_to_cart_text'] ) && !empty( $wps_deals_options['add_to_cart_text'] ) ? $wps_deals_options['add_to_cart_text'] : __( 'Add to Cart', 'wpsdeals' );
		}
		
		if( !empty( $purchaselink ) ) {
		
			$args = array( 
						'addcartbtntext' =>	$addcartbtntext, 
						'displayprice' => $displayprice, 
						'purchaselink' => $purchaselink, 
						'btncolor' => $btncolor
					);
					
			wps_deals_get_template( 'single-deal/add-to-cart/purchase-link-cart-button.php', $args );			
		}
	}
}

if( !function_exists( 'wps_deals_add_to_cart_button' ) ) {
	
	/**
	 * Loads the add to cart button template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_add_to_cart_button() {
		
		global $post,$wps_deals_options,$wps_deals_price,$wps_deals_model,$wps_deals_cart,$user_ID;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the color scheme from the settings
		$button_color = isset( $wps_deals_options['deals_btn_color'] ) ? $wps_deals_options['deals_btn_color'] : '';
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		// get the product price
		$productprice = $wps_deals_price->wps_deals_get_price( $post->ID );
		
		//get the display price
		$displayprice = $wps_deals_price->get_display_price( $productprice, $post->ID );
		
		//Get checkout page id
		$payment_checkout_page	= isset( $wps_deals_options['payment_checkout_page'] ) ? $wps_deals_options['payment_checkout_page'] : '';
		
		// get the checkout url 
		$checkouturl = get_permalink( $payment_checkout_page );
		
		// get the purchase link for affiliate products 
		$purchaselink = get_post_meta( $post->ID, $prefix . 'purchase_link', true );
		
		// get the add to cart button text
		$addtocart_post = get_post_meta( $post->ID, $prefix . 'add_to_cart', true );
		
		if( !empty( $addtocart_post ) ) {	
			$addcartbtntext = $addtocart_post;
		} else { 
			$addcartbtntext = isset( $wps_deals_options['add_to_cart_text'] ) && !empty($wps_deals_options['add_to_cart_text']) 
								? $wps_deals_options['add_to_cart_text'] : __( 'Add to Cart', 'wpsdeals' );
		}
		
		//get the current product is in cart or not
		$incart = $wps_deals_cart->item_in_cart($post->ID);
				
		$soldout = $wps_deals_model->wps_deals_check_item_is_sold_out( $post->ID, $user_ID );
		$soldout_btn_label = isset( $wps_deals_options['purchase_limit_label'] ) ? $wps_deals_options['purchase_limit_label'] : __( 'Sold Out', 'wpsdeals' );
					
		$args = array( 
						'addcartbtntext' =>	$addcartbtntext, 
						'displayprice' => $displayprice, 
						'dealid' => $post->ID, 
						'checkouturl' => $checkouturl ,
						'btncolor' => $btncolor,						
						'incart' => $incart,
						'soldout' => $soldout,
						'soldout_btn_label' => $soldout_btn_label
					);
			
		// get the template
		wps_deals_get_template( 'single-deal/add-to-cart/add-to-cart-button.php', $args );		
	}
}

if( !function_exists( 'wps_deals_buy_now_button' ) ) {
	
	/**
	 * Loads the buy now button template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_buy_now_button() {
		
		global $post,$wps_deals_options,$wps_deals_price;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		$dealurl = get_permalink( $post->ID );
			
		// get the product price 
		$productprice = $wps_deals_price->wps_deals_get_price( $post->ID );
			
		//get the display price
		$displayprice = $wps_deals_price->get_display_price( $productprice,$post->ID );
		
		// get the buy now button text
		$buynowtext = get_post_meta( $post->ID, $prefix .'buy_now', true );
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		// Check user is not logged in and disable guest checkout from misc settings
		if( !is_user_logged_in() && !empty( $wps_deals_options['disable_guest_checkout'] ) ) {
			if( isset( $wps_deals_options['create_account_page'] ) && !empty( $wps_deals_options['create_account_page'] ) ) { // Check create an account page id is not empty
				$create_account_page_id = wps_deals_get_page_id( 'create_account_page');
				$payurl = get_permalink( $create_account_page_id );
			} else {
				$payurl = wp_login_url( $dealurl );
			}
		} else {
			$payurl = add_query_arg( array( 'dealsaction' => 'buynow', 'dealid' => $post->ID ), $dealurl );	
		}
		
		
		
	
		
		
		$args = array( 
						'payurl' => $payurl, 
						'displayprice' => $displayprice, 
						'dealid' => $post->ID, 
						'buynowtext' => !empty( $buynowtext ) ? $buynowtext : __( 'Buy Now', 'wpsdeals' ),
						'btncolor' => $btncolor
					);
			
		// get the template
		wps_deals_get_template( 'single-deal/buy-now-button.php', $args );		
	}
}


/* **************************************************************************
   Single Deal Business Info Templates
   ************************************************************************** */

if( !function_exists( 'wps_deals_single_business_info' ) ) {
		
	/**
	 * Loads the business info template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_business_info() {
		
		global $post, $address;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the business title
		$businesstitle = get_post_meta( $post->ID, $prefix . 'business_title', true );
		
		// get the google map values
		
		$google_map = get_post_meta( $post->ID, $prefix.'google_map', true );
		
	
 		if( !empty($google_map) ) {
			foreach ( $google_map as $key => $value ) {
				$gmap_address 	= $value[$prefix.'gmap_address'];
				$address 		= str_replace("'", "&prime;",$gmap_address);
			}
 		}
		
		/*$gmapaddress = get_post_meta( $post->ID, $prefix.'address', true );
		$address = str_replace( "'", "&prime;", $gmapaddress );*/
		
		// check if address is set
		if( !empty( $address ) ) {
			
			// enqueue the needed scripts for the map
			wp_enqueue_script('wps-deals-google-map');
			wp_enqueue_script('wps-deals-map-script');
		}
		
		// get the business logo
		$business_logo = get_post_meta( $post->ID, $prefix . 'business_logo', true );
		
		// get the business address
		$business_address = get_post_meta( $post->ID, $prefix . 'business_address', true );
		
		// get the the business URL
		$business_url = get_post_meta( $post->ID, $prefix . 'bus_web_url', true );
	
		// check if the business title is set
		//if( !empty( $businesstitle ) ) { 
		
			// set the args, which we will pass to the template
			$args = array( 
							'businesstitle' => $businesstitle,
							'imgurl' => $business_logo['src'],
							'address' => $business_address,
							'businesslink' => $business_url,
							'mapaddpress' => $address
						);
						
			wps_deals_get_template( 'single-deal/business-info.php', $args );
		//}
	}
}

if( !function_exists( 'wps_deals_single_footer_add_to_cart' ) ) {
	
	/**
	 * Loads footer add to cart button
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_footer_add_to_cart() {
		
		global $wps_deals_options;
		
		if( !empty($wps_deals_options['enable_bottom_button']) && $wps_deals_options['enable_bottom_button'] == '1' ) {
			
			// get the template
			wps_deals_get_template( 'single-deal/footer.php' );
		}
	}
	
}

if( !function_exists( 'wps_deals_single_terms_conditions' ) ) {
		
	/**
	 * Loads the Terms & Condition template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_single_terms_conditions() {
		
		global $post;
	
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the value for the terms and conditions
		$termsconditions = get_post_meta( $post->ID, $prefix . 'terms_conditions', true );
		
		// check terms and conditions
		if( !empty( $termsconditions ) ) {
			
			// set the args, which we will pass to the template
			$args = array( 
							'termsconditions' => $termsconditions
						);
			
			// get the template
			wps_deals_get_template( 'single-deal/terms.php', $args );			
		}
	}
}

/* **************************************************************************
   Checkout Page Templates
   ************************************************************************** */

if( !function_exists( 'wps_deals_checkout_header' ) ) {
	
	/**
	 * Loads the checkout header template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_checkout_header() {
		
		// enqueue the credit card validator script
		wp_enqueue_script( 'wps-deals-credit-card-validator-scripts' );
		
		// get the template
		wps_deals_get_template( 'checkout/header.php' );
	}	
}

if( !function_exists( 'wps_deals_checkout_content' ) ) {
	
	/**
	 * Loads the checkout content template.
	 *
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_checkout_content() {
		
		// get the template
		wps_deals_get_template( 'checkout/content.php' );
	}	
}

if( !function_exists( 'wps_deals_checkout_footer' ) ) {

	/**
	 * Loads the checkout footer template.
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_checkout_footer() {
		
		$paymentgatway = wps_deals_get_enabled_gateways();
		
		// check if a payment gateway is enabled
		if( !empty( $paymentgatway )  ) {
			
			// get the template
			wps_deals_get_template( 'checkout/footer.php' );
			
		} else {
		
			// get the template
			wps_deals_get_template( 'checkout/footer/no-payment-gatway.php' );
		}
	}
}

if( !function_exists( 'wps_deals_cart_details' ) ) {
	
	/**
	 * Loads Checkout Cart Details Template
	 * 
	 * Handles to load checkout cart details
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_details() {
		
		//cart details table template
		wps_deals_get_template( 'checkout/header/cart-details.php' );
		
	}
}

if( !function_exists( 'wps_deals_cart_action_buttons' ) ) {
	
	/**
	 * Loads Cart Actions Buttons Template
	 * 
	 * Handles to load cart action buttons
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_action_buttons() {
		
		//cart actions buttons template
		wps_deals_get_template( 'checkout/header/cart-action-buttons.php' );
		
	}
}

if( !function_exists( 'wps_deals_cart_update_button' ) ) {
	
	/**
	 * Loads Cart Update Button Template
	 * 
	 * Handles to load update cart button
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_update_button() {
		
		global $wps_deals_options;
		
		// check item quantities is set, if yes then no need to display update cart button
		if(isset($wps_deals_options['item_quantities']) && !empty($wps_deals_options['item_quantities']) && $wps_deals_options['item_quantities'] == '1') {
			return;
		} else {
			//cart update button template
			wps_deals_get_template( 'checkout/header/cart-action-buttons/cart-update-button.php' );
		}
		
	}
}

if( !function_exists( 'wps_deals_display_description' ) ) {
	
	/**
	 * Loads Cheque Payment Description Template
	 * 
	 * Handles to load cheque payment description
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_display_description() {
		
		global $wps_deals_options;
		
		//get enable payment methods
		$enablepayments = wps_deals_get_enabled_gateways();
		$defaultgateway = $wps_deals_options['default_payment_gateway'];
		
		//check only banktransfer is enable only one payment gateway
		//if banktransfer is selected in default gateway
		if( array_key_exists( 'cheque', $enablepayments ) && 
			( count( $enablepayments ) == 1 || $defaultgateway == 'cheque' ) ) {
			$enablebankdesc = ' wps-deals-payment-description-show';
		} else {
			$enablebankdesc = ' wps-deals-payment-description-none';
		}
		
		$cheque_customer_msg = isset( $wps_deals_options['cheque_customer_msg'] ) ? $wps_deals_options['cheque_customer_msg'] : '';
		
		if( !empty( $cheque_customer_msg ) ) {
			//cheque description template
			wps_deals_get_template( 'checkout/footer/cheque-payment-description.php', array( 	'description' 	=> nl2br( $cheque_customer_msg ),
																										'enablebankdesc'=> $enablebankdesc ) );
		}
		
	}
}

if( !function_exists( 'wps_deals_cart_social_login' ) ) {
	
	/**
	 * Loads Checkout Social Login Buttons Template
	 * 
	 * Handles to load checkout social login buttons
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_social_login() {
		
		global $wps_deals_options, $wps_deals_session;
		
		//check user is not logged in and social login is enable or not for any one service
		if( !is_user_logged_in() && wps_deals_enable_social_login() ) {
			
			// get redirect url from settings
			$defaulturl = isset( $wps_deals_options['login_redirect_url'] ) && !empty( $wps_deals_options['login_redirect_url'] ) 
								? $wps_deals_options['login_redirect_url'] : wps_deals_get_current_page_url();
			
			//redirect url for shortcode
			$defaulturl = isset( $redirect_url ) && !empty( $redirect_url ) ? $redirect_url : $defaulturl; 
			
			//session create for redirect url
			$wps_deals_session->set( 'wps_deals_stcd_redirect_url', $defaulturl );
			
			// get title from settings
			$login_heading = isset( $wps_deals_options['login_heading'] ) ? $wps_deals_options['login_heading'] : __( 'Login with Social Media', 'wpsdeals' );
			
			// get redirect url from settings
			$login_redirect_url = isset( $wps_deals_options['login_redirect_url'] ) ? $wps_deals_options['login_redirect_url'] : '';
			
			//load social login buttons template
			wps_deals_get_template( 'checkout/content/social.php', array( 	'title' 			=> $login_heading,
																					'login_redirect_url'=> $login_redirect_url
																					) );
			
			//enqueue social front script
			wp_enqueue_script( 'wps-deals-social-front-scripts' );
		}
	}
}

if( !function_exists( 'wps_deals_social_login_shortcode' ) ) {
	
	/**
	 * Loads Shortcode Social Login Buttons Template
	 * 
	 * Handles to load shortcode social login buttons
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_shortcode( $title = '', $redirect_url = '' ) {
		
		global $wps_deals_options;
		
		// get title from settings
		$login_heading = isset( $wps_deals_options['login_heading'] ) ? $wps_deals_options['login_heading'] : __( 'Login with Social Media', 'wpsdeals' );
		$login_heading = !empty( $title ) ? $title : $login_heading; // check title first from shortcode
		
		// get redirect url from settings
		$login_redirect_url = isset( $wps_deals_options['login_redirect_url'] ) ? $wps_deals_options['login_redirect_url'] : '';
		$login_redirect_url = !empty( $redirect_url ) ? $redirect_url : $login_redirect_url; // check redirect url first from shortcode
		
		//load social login buttons template
		wps_deals_get_template( 'checkout/content/social.php', array( 	'title' 			=> $login_heading,
																				'login_redirect_url'=> $login_redirect_url
																				) );
		
		//enqueue social front script
		wp_enqueue_script( 'wps-deals-social-front-scripts' );
	}
}

if( !function_exists( 'wps_deals_checkout_payment_gateways' ) ) {
	
	/**
	 * Loads Checkout Payment Gateways Template
	 * 
	 * Handles to load checkout payment gateway 
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_checkout_payment_gateways() {
		
		global $wps_deals_options, $wps_deals_cart;
		
		//Get cart
		$cart			= $wps_deals_cart;
		
		//Get cart total
		$cart_total		= $cart->show_total();
		
		if( $cart_total > 0 ) {
			
			$paymentgatway	= wps_deals_get_enabled_gateways();
			
			//check default gateway is set or not and it is enabled or not
			if( isset( $wps_deals_options['default_payment_gateway'] ) 
				&& array_key_exists( $wps_deals_options['default_payment_gateway'], $paymentgatway ) ) {
				$defaultgatway = $wps_deals_options['default_payment_gateway'];
			} else {
				$defaultgatway = 'paypal';
			}
			
			//payment gateway template
			wps_deals_get_template( 'checkout/footer/payment-gateway.php', array( 'paymentgatway' => $paymentgatway, 'defaultgatway' => $defaultgatway ));
		}
	}
	
}
if( !function_exists( 'wps_deals_checkout_user_form' ) ) {
	
	/**
	 * Loads Checkout User Register & Login Form Template
	 * 
	 * Handles to load checkout user register & login form
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_checkout_user_form() {

		global $wps_deals_options;
				
		if(!is_user_logged_in() && (!empty($wps_deals_options['show_login_register']) || !empty($wps_deals_options['disable_guest_checkout']))) { //check user is not logged in and show login and register option is selected from backend
			
			//load user form template
			wps_deals_get_template( 'checkout/footer/user-form.php' );
					
		}
	}
}

if( !function_exists( 'wps_deals_cart_user_reg_form' ) ) {
	
	/**
	 * Loads Cart User Register Form Template
	 * 
	 * Handles to load user register form
	 * on single deal page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_user_reg_form() {

		//registration form template
		wps_deals_get_template( 'checkout/footer/user-form/registration-form.php' );
		
	}
	
}

if( !function_exists( 'wps_deals_cart_user_login_form' ) ) {
	
	/**
	 * Loads Cart User Login Form Template
	 * 
	 * Handles to load user login form
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_user_login_form() {

		//login form template
		wps_deals_get_template( 'checkout/footer/user-form/login-form.php' );
		
	}
	
}

if( !function_exists( 'wps_deals_cart_user_personal_details' ) ) {
	
	/**
	 * Loads Cart User Personal Details Template
	 * 
	 * Handles to load user personal details
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_user_personal_details() {
		
		//personal details template
		wps_deals_get_template( 'checkout/footer/personal-details.php' );
		
	}
}
if( !function_exists( 'wps_deals_cart_user_billing_details' ) ) {
	
	/**
	 * Loads Cart User Billing Details Template
	 * 
	 * Handles to load user billing details
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_user_billing_details() {
		
		global $current_user, $wps_deals_options;
		
		//check billing is enable from settings page
		if( isset( $wps_deals_options['enable_billing'] ) && !empty( $wps_deals_options['enable_billing'] ) ) {
		
			$prefix = WPS_DEALS_META_PREFIX;
			
			//get user billing data saved
			$userbillingdata	=	get_user_meta( $current_user->ID, $prefix.'billing_details', true );
			
			//get user country from saved
			$usercountry		=	isset( $userbillingdata['country'] ) ? $userbillingdata['country'] : '';
			//get user company name
			$usercompany		=	isset( $userbillingdata['company'] ) ? $userbillingdata['company'] : '';
			//get user address1 
			$useraddress1		=	isset( $userbillingdata['address1'] ) ? $userbillingdata['address1'] : '';
			//get user address2 
			$useraddress2		=	isset( $userbillingdata['address2'] ) ? $userbillingdata['address2'] : '';
			//get user city or town
			$usercity			=	isset( $userbillingdata['city'] ) ? $userbillingdata['city'] : '';
			//get user state or county
			$userstate			=	isset( $userbillingdata['state'] ) ? $userbillingdata['state'] : '';
			//get user post code
			$userpostcode		=	isset( $userbillingdata['postcode'] ) ? $userbillingdata['postcode'] : '';
			//get user phone
			$userphone			=	isset( $userbillingdata['phone'] ) ? $userbillingdata['phone'] : '';
			
			//get statelist from country
			$statesfrom =  wps_deals_get_states_from_country( $usercountry );
			$states = !empty( $statesfrom ) ? $statesfrom : '';
			
			//data pased to template
			$billingargs = array( 
									'countries'		=>	wps_deals_get_country_list(),
									'usercountry'	=>	$usercountry,
									'usercompany'	=>	$usercompany,
									'useraddress1'	=>	$useraddress1,
									'useraddress2'	=>	$useraddress2,
									'usercity'		=>	$usercity,
									'userstate'		=>	$userstate,
									'userpostcode'	=>	$userpostcode,
									'userphone'		=>	$userphone,
									'statelist'		=>	$states
								);
			
			//billing details template
			wps_deals_get_template( 'checkout/footer/billing-details.php', $billingargs );
			
		} //end if to check enable billing or not
	}
}
if( !function_exists( 'wps_deals_cart_agree_terms' ) ) {
	
	/**
	 * Loads Cart Agree Terms & Conditions Template
	 * 
	 * Handles to load agree terms & conditions
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_agree_terms() {

		global $wps_deals_options;
		
		if( !empty( $wps_deals_options['enable_terms'] ) ) { //check if agree terms is enabled from backend
		
			$agreelabel = isset($wps_deals_options['terms_label']) && !empty($wps_deals_options['terms_label']) ? $wps_deals_options['terms_label'] : '';
			
			 $args = array( 
				 			'termscontent'	=>	wpautop( $wps_deals_options['terms_content'] ),
				 			'agreelabel' 	=>	$agreelabel
			 			 );
			 			 
			//terms and conditions template
			wps_deals_get_template( 'checkout/footer/terms.php', $args );
		}
	}
}
if( !function_exists( 'wps_deals_checkout_order_total_button' ) ) {
	
	/**
	 * Loads Checkout Order Total & Place Your Order Button  Template
	 * 
	 * Handles to load checkout order total & 
	 * place your order button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_checkout_order_total_button() {
		
		//cart button and total template
		wps_deals_get_template( 'checkout/footer/order-total-button.php' );
		
	}
}



if( !function_exists( 'wps_deals_cart_order_total_footer' ) ) {
	
	/**
	 * Loads Cart Order Total In Footer Template
	 * 
	 * Handles to load cart order total in footer
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_order_total_footer() {
		
		//cart order total template
		wps_deals_get_template( 'checkout/footer/order-total-button/order-total.php' );
		
	}
}


if( !function_exists( 'wps_deals_cart_place_order_button_footer' ) ) {
	
	/**
	 * Loads Cart Place Your Order Button Template
	 * 
	 * Handles to load cart place 
	 * your order button in footer template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_cart_place_order_button_footer() {
		
		//cart place your order button template
		wps_deals_get_template( 'checkout/footer/order-total-button/place-your-order-button.php' );
		
	}
}

if( !function_exists( 'wps_deals_social_login_facebook' ) ) {
	
	/**
	 * Loads Checkout Social Login Facebook Template
	 * 
	 * Handles to load checkout social login 
	 * facebook button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_facebook() {
		
		global $wps_deals_options;	
		
		// check facebook is enable
		if( !empty( $wps_deals_options['enable_facebook'] ) ) {
		
	
			$fbimgurl = isset( $wps_deals_options['fb_icon_url'] ) && !empty( $wps_deals_options['fb_icon_url'] ) 
						? $wps_deals_options['fb_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/facebook.png';
				
			//load facebook button template
			wps_deals_get_template( 'checkout/content/social/facebook.php', array( 'fbiconurl' => $fbimgurl ) );

			//enqueue Facebook scripts
			wp_enqueue_script( 'facebook' );
			wp_enqueue_script( 'wps-deals-social-fbinit' );

		}
		
	}	
}

if( !function_exists( 'wps_deals_social_login_twitter' ) ) {
	
	/**
	 * Loads Checkout Social Login Twitter Template
	 * 
	 * Handles to load social login 
	 * twitter button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_twitter() {
		
		global $wps_deals_options,$wps_deals_social_twitter;	
		
		//social twitter class
		$socialtwitter = $wps_deals_social_twitter;
		
		// check twitter is enable
		if( !empty( $wps_deals_options['enable_twitter'] ) ) {
			
			$twimgurl = isset( $wps_deals_options['tw_icon_url'] ) && !empty( $wps_deals_options['tw_icon_url'] ) 
						? $wps_deals_options['tw_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/twitter.png';
			
			//load twitter button template
			wps_deals_get_template( 'checkout/content/social/twitter.php', array( 'twiconurl' => $twimgurl ) );
			
			if ( WPS_DEALS_TW_CONSUMER_KEY != '' && WPS_DEALS_TW_CONSUMER_SECRET != '' ) {
				
				?>
					<input type="hidden" class="wps-deals-social-tw-redirect-url" id="wps_deals_social_tw_redirect_url" name="wps_deals_social_tw_redirect_url" value="<?php echo $socialtwitter->wps_deals_social_get_twitter_auth_url();?>" />
				<?php
			
			}
		
		}
	}	
}

if( !function_exists( 'wps_deals_social_login_googleplus' ) ) {
	
	/**
	 * Loads Checkout Social Login Google+ Template
	 * 
	 * Handles to load social login google+ button
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_googleplus() {
		
		global $wps_deals_options,$wps_deals_social_google;	
		
		//social google class
		$socialgoogle = $wps_deals_social_google;
		
		// check google plus is enable
		if( !empty( $wps_deals_options['enable_gplus'] ) ) {
			
			$gpimgurl = isset( $wps_deals_options['gplus_icon_url'] ) && !empty( $wps_deals_options['gplus_icon_url'] ) 
						? $wps_deals_options['gplus_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/google_plus.png';
			
			//load googleplus button template
			wps_deals_get_template( 'checkout/content/social/googleplus.php', array( 'gpiconurl' => $gpimgurl ) );
			
			if( WPS_DEALS_GP_CLIENT_ID != '' && WPS_DEALS_GP_CLIENT_SECRET != '' ) {
				
				?>
					<input type="hidden" class="wps-deals-social-gp-redirect-url" id="wps_deals_social_gp_redirect_url" name="wps_deals_social_gp_redirect_url" value="<?php echo $socialgoogle->wps_deals_social_get_google_auth_url();?>"/>							
				<?php
			}
		} 
	}	
}

if( !function_exists( 'wps_deals_social_login_linkedin' ) ) {
	
	/**
	 * Loads Checkout Social Login LinkedIn Template
	 * 
	 * Handles to load social login 
	 * linkedin button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_linkedin() {
		
		global $wps_deals_options,$wps_deals_social_linkedin;	
		
		//social linkedin class
		$sociallinkedin = $wps_deals_social_linkedin;
		
		// check linkedin is enable
		if( !empty( $wps_deals_options['enable_linkedin'] ) ) {
			
			$liimgurl = isset( $wps_deals_options['li_icon_url'] ) && !empty( $wps_deals_options['li_icon_url'] ) 
						? $wps_deals_options['li_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/linkedin.png';
			//load linkedin button template
			wps_deals_get_template( 'checkout/content/social/linkedin.php', array( 'liiconurl' => $liimgurl ) );
			
			if( WPS_DEALS_LI_APP_ID != '' && WPS_DEALS_LI_APP_SECRET != '' ) {
				
				?>
					<input type="hidden" class="wps-deals-social-li-redirect-url" id="wps_deals_social_li_redirect_url" name="wps_deals_social_li_redirect_url" value="<?php echo $sociallinkedin->wps_deals_social_linkedin_auth_url();?>"/>						
				<?php
			}
		}
	}	
}

if( !function_exists( 'wps_deals_social_login_yahoo' ) ) {
	
	/**
	 * Loads Checkout Social Login Yahoo Template
	 * 
	 * Handles to load social login 
	 * yahoo button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_yahoo() {
		
		global $wps_deals_options,$wps_deals_social_yahoo;	
		
		//social yahoo class
		$socialyahoo = $wps_deals_social_yahoo;
		
		// check yahoo is enable
		if( !empty( $wps_deals_options['enable_yahoo'] ) ) {

			$yhimgurl = isset( $wps_deals_options['yh_icon_url'] ) && !empty( $wps_deals_options['yh_icon_url'] ) 
						? $wps_deals_options['yh_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/yahoo.png';
			
			//load yahoo button template
			wps_deals_get_template( 'checkout/content/social/yahoo.php', array( 'yhiconurl' => $yhimgurl ) );
			
			if( WPS_DEALS_YH_CONSUMER_KEY != '' && WPS_DEALS_YH_CONSUMER_SECRET != '' && WPS_DEALS_YH_APP_ID != '' ) {
				
				?>
					<input type="hidden" class="wps-deals-social-yh-redirect-url" id="wps_deals_social_yh_redirect_url" name="wps_deals_social_yh_redirect_url" value="<?php echo $socialyahoo->wps_deals_social_get_yahoo_auth_url();?>"/>						
				<?php
			}
		}
	}	
}

if( !function_exists( 'wps_deals_social_login_foursquare' ) ) {
	
	/**
	 * Loads Checkout Social Login Yahoo Template
	 * 
	 * Handles to load social login 
	 * foursquare button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_foursquare() {
		
		global $wps_deals_options,$wps_deals_social_foursquare;	
		
		//social foursquare class
		$socialfoursquare = $wps_deals_social_foursquare;
		
		// check foursquare is enable
		if( !empty( $wps_deals_options['enable_foursquare'] ) ) {

			$fsimgurl = isset( $wps_deals_options['fs_icon_url'] ) && !empty( $wps_deals_options['fs_icon_url'] ) 
						? $wps_deals_options['fs_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/foursquare.png';
			
			//load foursquare button template
			wps_deals_get_template( 'checkout/content/social/foursquare.php', array( 'fsiconurl' => $fsimgurl ) );
			
			if( WPS_DEALS_FS_CLIENT_ID != '' && WPS_DEALS_FS_CLIENT_SECRET != '' ) {
				
				?>
					<input type="hidden" class="wps-deals-social-fs-redirect-url" id="wps_deals_social_fs_redirect_url" name="wps_deals_social_fs_redirect_url" value="<?php echo $socialfoursquare->wps_deals_social_get_foursquare_auth_url();?>"/>						
				<?php
			}
		}
	}	
}
if( !function_exists( 'wps_deals_social_login_windowslive' ) ) {
	
	/**
	 * Loads Checkout Social Login Windows Live Template
	 * 
	 * Handles to load checkout social login 
	 * facebook button template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_social_login_windowslive() {
		
		global $wps_deals_options,$wps_deals_social_windowslive;	
		
		//windows live class
		$socialwindowslive = $wps_deals_social_windowslive;
		
		
		// check windowslive is enable
		if( !empty( $wps_deals_options['enable_windowslive'] ) ) {
		
	
			$wlimgurl = isset( $wps_deals_options['wl_icon_url'] ) && !empty( $wps_deals_options['wl_icon_url'] ) 
						? $wps_deals_options['wl_icon_url'] : WPS_DEALS_SOCIAL_URL.'/images/windowslive.png';
				
			//load windowslive button template
			wps_deals_get_template( 'checkout/content/social/windowslive.php', array( 'wliconurl' => $wlimgurl ) );

			if( WPS_DEALS_WL_CLIENT_ID != '' && WPS_DEALS_WL_CLIENT_SECRET != '' ) {
				
				?>
					<input type="hidden" class="wps-deals-social-wl-redirect-url" id="wps_deals_social_wl_redirect_url" name="wps_deals_social_wl_redirect_url" value="<?php echo $socialwindowslive->wps_deals_social_get_windowslive_auth_url();?>"/>						
				<?php
			}
			
		}
		
	}
}
if( !function_exists( 'wps_deals_localize_map_script' ) ) {
	
	/**
	 * Add Localize Script for Individual Post Data
	 * 
	 * Handles to add localize script for individual post data
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_localize_map_script() {
		
		global $post;
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// get the value for the google map address from the post meta box
		$google_map = get_post_meta( $post->ID, $prefix.'google_map', true );
 		
		$googlemaps = array();
		
		for ( $i = 0; $i < count( $google_map ); $i++ ){
				
			if(!empty( $google_map[$i][$prefix.'gmap_address'] )){	
						
				$gmap_address = !empty( $google_map[$i][$prefix.'gmap_address'] ) ? $google_map[$i][$prefix.'gmap_address'] : '';	
				
				$googlemap=array();
				
				$googlemap['gmap_address'] = str_replace("'", "&prime;", $gmap_address );

				$googlemap['gmap_popup_width'] = !empty( $google_map[$i][$prefix.'gmap_popup_width'] ) ? $google_map[$i][$prefix.'gmap_popup_width'] : '220';
	
				if (!empty($google_map[$i][$prefix.'gmap_popup_content'])) {
					$googlemap['gmap_popup_content'] =  '<div class="wps-deals-gmap-popup-content">'.$google_map[$i][$prefix.'gmap_popup_content'].'</div>';
				} else {
					$googlemap['gmap_popup_content'] = $googlemap['gmap_address'];
				}
				
				$googlemaps[] = $googlemap;
			}
		}
		 
		$map_settings=array( 
						'URL'		=> WPS_DEALS_URL,
						'locations'	=> $googlemaps
						);
			
		wp_localize_script( 'wps-deals-map-script', 'Wps_Deals_Map', $map_settings );
	}
}

/*************************** Orders Deals Page Template ******************************/

if( !function_exists( 'wps_deals_order_view_content_before' ) ) {

	/**
	 * Loads Cheque Payment Message Template 
	 * 
	 * Handles to show cheque payment message content
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.1
	 */
	function wps_deals_order_view_content_before( $order_id ) {
		
		global $wps_deals_model, $wps_deals_options;
		
		// get the value for the order details from the post meta box
		$order_details = $wps_deals_model->wps_deals_get_post_meta_ordered( $order_id );
		
		$payment_method = isset( $order_details['payment_method'] ) ? $order_details['payment_method'] : '';
	
		// Check payment method is cheque payment and not empty customer message from settings
		if( $payment_method == 'cheque' && isset( $wps_deals_options['cheque_customer_msg'] )
			 && !empty( $wps_deals_options['cheque_customer_msg'] ) ) {
		
			//cheque payment message details template
			wps_deals_get_template( 'orders/order-cheque-payment-message.php', array( 'cheque_customer_msg' => nl2br( $wps_deals_options['cheque_customer_msg'] ) ) );
		
		}
	}
}
if( !function_exists( 'wps_deals_orders_content' ) ) {

	/**
	 * Loads Orders Template 
	 * 
	 * Handles to load orders template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_orders_content() {
		
		//order details template
		wps_deals_get_template( 'orders/orders.php' );
	}
}
if( !function_exists( 'wps_deals_orders_listing_content' ) ) {

	/**
	 * Loads Orders Listing Table Template 
	 * 
	 * Handles to load orders listing table template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_orders_listing_content( $ordereddeals, $paging ) {
		
		//order details template
		wps_deals_get_template( 'orders/orders-listing/orders-listing.php', array(	'ordereddeals'	=> $ordereddeals, 
																					'paging'		=> $paging ) );
	}
}
if( !function_exists( 'wps_deals_orders_complete_content' ) ) {

	/**
	 * Loads Orders Complete Template
	 * 
	 * Handles to load orders complete 
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_orders_complete_content() {
		
		//order complete details template
		wps_deals_get_template( 'orders/order-complete-details.php' );
	}
}
if( !function_exists( 'wps_deals_orders_cancel_content' ) ) {

	/**
	 * Loads Orders Cancel Template
	 * 
	 * Handles to load orders cancel 
	 * template
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 */
	function wps_deals_orders_cancel_content() {
		
		//order cancel template
		wps_deals_get_template( 'orders/order-cancel-details.php' );
	}
}

/*************************** My Account Page Template ******************************/
/**
 * My Account Template Functions
 * 
 * Handles to show my account page content
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
if( !function_exists( 'wps_deals_my_account_address_success_msg' ) ) {
	/**
	 * My Account Address Success Message
	 * 
	 * Handles to show my account page address success message
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_address_success_msg() {
		
		global $wps_deals_message;
		
		$success_message = '';
		if ( $wps_deals_message->size( 'my_account_msg' ) > 0 ) {
			// if we need to display the error message, we will do it here
			$success_message = $wps_deals_message->output( 'my_account_msg' );
		}
	
		//load my account page address success message template
		wps_deals_get_template( 'my-account/address-success-message.php', array( 'success_message' => $success_message ) );
		
	}
}
if( !function_exists( 'wps_deals_my_account_top_content' ) ) {
	/**
	 * My Account Top Content
	 * 
	 * Handles to show my account page top content
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_top_content() {
		
		global $current_user, $wps_deals_options;	
		
		//get change password page url
		$changepasswordlink = wps_deals_change_password_url();
		
		//load my account page top content template
		wps_deals_get_template( 'my-account/top-content.php', array( 'username' => $current_user->display_name, 'changepasswordlink' => $changepasswordlink ) );
		
	}
}
if( !function_exists( 'wps_deals_my_account_available_downloads' ) ) {
	/**
	 * My Account Available Downloads
	 * 
	 * Handles to show my account page available downloads
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_available_downloads() {
		
		global $current_user, $wps_deals_model;
		
		//model class
		$model = $wps_deals_model;
		
		///get recent 5 orders
		$orders = $model->wps_deals_get_sales( array( 'author' => $current_user->ID, 'posts_per_page' => '5' ) );
		
		//if orders are not empty then show recent orders
		if( !empty( $orders ) ) {
			
			$downloadfiles = array();
				
			foreach ( $orders as $key => $order ) {
				
				//get ordered files
				$orderedfiles = $model->wps_deals_get_ordered_file_list( $order['ID'] );
				
				// get the value for the order details from the post meta box
				$order_details = $model->wps_deals_get_post_meta_ordered( $order['ID'] );
				
				//payment status value
				$payment_status_val = $model->wps_deals_get_ordered_payment_status( $order['ID'], true );

				foreach ( $order_details['deals_details'] as $product ) {
					
					//check payment status is completed and order download files should not empty
					if( $payment_status_val == '1' 
						&& !empty( $orderedfiles[$product['deal_id']] ) && is_array( $orderedfiles[$product['deal_id']] ) ) {
						
						foreach ( $orderedfiles[$product['deal_id']] as $key => $file ) {
							
							//get file name from deal id and file key
							$filename = $model->wps_deals_get_download_file_name( $product['deal_id'], $key );
							
							if( !empty( $filename ) ) { // check file name is exist or not
								
								//make file display to user
								$filename = sprintf( __( '%s - %s','wpsdeals' ), get_the_title( $product['deal_id'] ), $filename );
								$downloadfiles[] = '<a href="'.$file.'" target="_blank">'.$filename.'</a>';
								
							}
						}
					}
				}
				
			} //orders loop end
			
			if( !empty( $downloadfiles ) ) {
				
				//load my account page available downloads template
				wps_deals_get_template( 'my-account/available-downloads.php', array( 'downloadfiles' => $downloadfiles )  );
			}
		}
	}
}
if( !function_exists( 'wps_deals_my_account_recent_orders' ) ) {
	/**
	 * My Account Recent Orders
	 * 
	 * Handles to show my account page top content
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_recent_orders() {
		
		global $current_user, $wps_deals_model;
		//model class
		$model = $wps_deals_model;
		
		//filter for meta_query
		$meta_query = apply_filters( 'wps_deals_get_sales_meta_query', '' );
		
		//get recent 5 orders
		$orders = $model->wps_deals_get_sales( array( 'author' => $current_user->ID, 'posts_per_page' => '5', 'meta_query' => $meta_query ) );
		
		//if orders are not empty then show recent orders
		if( !empty( $orders ) ) {
			
			//collect order data to single array
			$orderdata = array();
			
			$downloadfiles = array();
				
			foreach ( $orders as $key => $order ) {
				
				//order ID
				$orderdata[$key]['order_id']		=	$order['ID'];
				//ordered date
				$orderdata[$key]['order_date']		=	$model->wps_deals_get_date_format( $order['post_date'] );
				//payment status
				$orderdata[$key]['payment_status']	=	$model->wps_deals_get_ordered_payment_status( $order['ID'] );
				//ordered deal details
				$orderdetails						=	$model->wps_deals_get_post_meta_ordered( $order['ID'] );
				//order total
				$orderdata[$key]['order_total']		=	$orderdetails['display_order_total'];
				//order deal count
				$orderdata[$key]['deal_count']		=	count( $orderdetails['deals_details'] );
								
			} //orders loop end
								
			//get view orders page url
			$vieworderspagelink = wps_deals_view_orders_url();
			
			//load my account page recent orders template
			wps_deals_get_template( 'my-account/recent-orders.php', array( 'orderdata' => $orderdata , 'vieworderspagelink' => $vieworderspagelink)  );
		}
		
	}
}
if( !function_exists( 'wps_deals_my_account_addresses' ) ) {
	/**
	 * My Account My Addresses
	 * 
	 * Handles to show my account page my addresses
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_addresses( $currentpage = '' ) {
		
		global $wps_deals_options;
		
		$billingargs = array();
		$my_account_addresses = array();
		
		//check billing is enable from settings page
		if( isset( $wps_deals_options['enable_billing'] ) && !empty( $wps_deals_options['enable_billing'] ) ) {
		
			$my_account_addresses['billing'] = __( 'Billing Details', 'wpsdeals' );
										
		} //end if to check enable billing or not
		
		$my_account_addresses = apply_filters( 'wps_deals_my_account_addresses', $my_account_addresses );
		
		$address_title = '';
		if( !empty( $my_account_addresses ) && count( $my_account_addresses ) > 1 ) {
			$address_title = __( 'My Addresses', 'wpsdeals' );
		} else if( !empty( $my_account_addresses ) ) {
			$address_title = __( 'My Address', 'wpsdeals' );
		}
		$billingargs['address_title'] =	$address_title;
		$billingargs['my_account_addresses'] = $my_account_addresses;
		
		if( !empty( $currentpage ) && $currentpage == 'edit_address' ) { // Check current page is edit address page
			$billingargs['emptymessage'] = __( 'This feature is not available.', 'wpsdeals' );
		}
		//load my account page my addresses template
		wps_deals_get_template( 'my-account/my-addresses.php', $billingargs );
		
	}
}
if( !function_exists( 'wps_deals_my_account_billing_address' ) ) {
	/**
	 * My Account Billing Address
	 * 
	 * Handles to show my account billing address
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_billing_address( $key, $title ) {
			
		global $current_user, $wps_deals_options;
		
		//check billing is enable from settings page
		if( isset( $wps_deals_options['enable_billing'] ) && !empty( $wps_deals_options['enable_billing'] ) ) {
		
			$prefix = WPS_DEALS_META_PREFIX;
			
			//get user billing data saved
			$userbillingdata	=	get_user_meta( $current_user->ID, $prefix.'billing_details', true );
			
			//get user country from saved
			$usercountry		=	isset( $userbillingdata['country'] ) ? wps_deals_get_country_name( $userbillingdata['country'] ) : '';
			//get user state or county
			$userstate			=	isset( $userbillingdata['state'] ) ? wps_deals_get_state_name ( $userbillingdata['state'], $userbillingdata['country'] ) : '';
			//get user company name
			$usercompany		=	isset( $userbillingdata['company'] ) ? $userbillingdata['company'] : '';
			//get user address1 
			$useraddress1		=	isset( $userbillingdata['address1'] ) ? $userbillingdata['address1'] : '';
			//get user address2 
			$useraddress2		=	isset( $userbillingdata['address2'] ) ? $userbillingdata['address2'] : '';
			//get user city or town
			$usercity			=	isset( $userbillingdata['city'] ) ? $userbillingdata['city'] : '';
			//get user post code
			$userpostcode		=	isset( $userbillingdata['postcode'] ) ? $userbillingdata['postcode'] : '';
			//get user phone
			$userphone			=	isset( $userbillingdata['phone'] ) ? $userbillingdata['phone'] : '';
			
			//data pased to template
			$billingargs = array( 
									'billingkey'		=>	$key,
									'billingtitle'		=>	$title,
									'billingcountry'	=>	$usercountry,
									'billingstate'		=>	$userstate,
									'billingcompany'	=>	$usercompany,
									'billingaddress1'	=>	$useraddress1,
									'billingaddress2'	=>	$useraddress2,
									'billingcity'		=>	$usercity,
									'billingpostcode'	=>	$userpostcode,
									'billingphone'		=>	$userphone,
									'billingalldata'	=>	$userbillingdata
								);
			
			//billing details template
			do_action( 'wps_deals_display_address', $billingargs );
			
		} //end if to check enable billing or not
		
	}
}
if( !function_exists( 'wps_deals_my_account_login_content' ) ) {
	/**
	 * My Account Login Content
	 * 
	 * Handles to show my account login content
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_my_account_login_content() {
		
		global $wps_deals_options;
		
		$registerlink = '';		
		
		//get lost password page url
		$lostpasswordlink =  wps_deals_lost_password_url();
		
		$users_can_register = get_option( 'users_can_register' );
		
		if( $users_can_register == '1' ) { //Check user can register			
			
			//get create an account page url
			$registerlink = wps_deals_create_account_url();
		}
		//load login template
		wps_deals_get_template( 'my-account/login.php', array( 'lostpasswordlink' => $lostpasswordlink, 'registerlink' => $registerlink ) );
	}
}	
if( !function_exists( 'wps_deals_display_address' ) ) {
	/**
	 * Display Billing Address
	 * 
	 * Handles to show billing address
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_display_address( $billingargs ) {
		
		global $wps_deals_options;
		
		$address_key = isset( $billingargs['billingkey'] ) ? $billingargs['billingkey'] : '';
		
		//get edit address page url
		$editlinkurl = wps_deals_edit_address_url();		
		
		$editlink = add_query_arg( array( 'wps_deals_address' => $address_key ), $editlinkurl );
		
		$billingargs['editlink'] = $editlink;
		
		//load billing addresses template
		wps_deals_get_template( 'my-account/billing-address.php', $billingargs );
	}
}
if( !function_exists( 'wps_deals_edit_address_content' ) ) {
	/**
	 * Edit Billing Address
	 * 
	 * Handles to edit billing address
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_edit_address_content() {
		
		if( isset( $_GET['wps_deals_address'] ) && !empty( $_GET['wps_deals_address'] ) ) {
		
			do_action( 'wps_deals_edit_' . $_GET['wps_deals_address'] . '_address' );
			
		} else {
			
			do_action( 'wps_deals_edit_address_page', 'edit_address' );
		}
	}
}

if( !function_exists( 'wps_deals_edit_billing_address' ) ) {
	/**
	 * Edit Billing Address
	 * 
	 * Handles to edit billing address
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_edit_billing_address() {
		
		//load edit billing addresses template
		wps_deals_get_template( 'my-account/edit-billing-address.php' );
	}
}

if( !function_exists( 'wps_deals_create_account_content' ) ) {
	/**
	 * Create An Account Page
	 * 
	 * Handles to show create an account page
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_create_account_content() {
		
		global $wps_deals_options;
		
		$my_account_page = isset( $wps_deals_options['my_account_page'] ) && !empty( $wps_deals_options['my_account_page'] ) ? $wps_deals_options['my_account_page'] : ''; 
		
		$loginlink = get_permalink( $my_account_page );
		
		$wps_deals_reg_user_name = isset( $_POST['wps_deals_reg_user_name'] ) ? $_POST['wps_deals_reg_user_name'] : '';
		$wps_deals_reg_user_firstname = isset( $_POST['wps_deals_reg_user_firstname'] ) ? $_POST['wps_deals_reg_user_firstname'] : '';
		$wps_deals_reg_user_lastname = isset( $_POST['wps_deals_reg_user_lastname'] ) ? $_POST['wps_deals_reg_user_lastname'] : '';
		$wps_deals_reg_user_email = isset( $_POST['wps_deals_reg_user_email'] ) ? $_POST['wps_deals_reg_user_email'] : '';
		
		//load create an account template
		wps_deals_get_template( 'my-account/create-account.php', array( 
																			'loginlink' 					=> $loginlink,
																			'wps_deals_reg_user_name' 		=> $wps_deals_reg_user_name,
																			'wps_deals_reg_user_firstname' 	=> $wps_deals_reg_user_firstname,
																			'wps_deals_reg_user_lastname' 	=> $wps_deals_reg_user_lastname,
																			'wps_deals_reg_user_email' 		=> $wps_deals_reg_user_email,
																		 ) );
	}
}

if( !function_exists( 'wps_deals_change_password_content' ) ) {
	/**
	 * Change Address Page
	 * 
	 * Handles to show change address
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_change_password_content() {
		
		//load change password template
		wps_deals_get_template( 'my-account/change-password.php' );
	}
}

if( !function_exists( 'wps_deals_lost_password_content' ) ) {
	/**
	 * Lost Address Page
	 * 
	 * Handles to show lost address
	 * 
	 * @package Social Deals Engine
	 * @since 1.0.0
	 **/
	function wps_deals_lost_password_content() {
		
		global $wpdb, $wps_deals_message;
		
		$password_form = '';
		$error 	= false;
		
		if( isset( $_GET['wps_deal_user_key'] ) && !empty( $_GET['wps_deal_user_key'] )
			&& isset( $_GET['wps_deals_user_name'] ) && !empty( $_GET['wps_deals_user_name'] ) ) {
			
			$key 	= $_GET['wps_deal_user_key'];
			$login 	= $_GET['wps_deals_user_name'];
			
			$key = preg_replace( '/[^a-z0-9]/i', '', $key );
	
			if ( empty( $key ) || ! is_string( $key ) ) {
				
				$wps_deals_message->add( 'lostpassword', __( '<span><strong>ERROR : </strong>Invalid key.', 'wpsdeals' ), 'error' );
				$error = true;
			}
	
			if ( empty( $login ) || ! is_string( $login ) ) {
				
				$wps_deals_message->add( 'lostpassword', __( '<span><strong>ERROR : </strong>Invalid key.', 'wpsdeals' ), 'error' );
				$error = true;
			}
	
			$user = $wpdb->get_row( "SELECT * FROM $wpdb->users WHERE user_activation_key = '{$key}' AND user_login = '{$login}'" );
	 
			if ( empty( $user ) ) {
				
				$wps_deals_message->add( 'lostpassword', __( '<span><strong>ERROR : </strong>Invalid key.', 'wpsdeals' ), 'error' );
				$error = true;
			}
			
			if( !$error ) {
				$password_form = 'reset';
			}
			
		}
		
		if( !empty( $password_form ) ) {
			
			$user_args = array(
									'wps_deals_reset_key' 	=> $key,
									'wps_deals_reset_login' => $login,
								);
			
			//load change password template
			wps_deals_get_template( 'my-account/change-password.php', $user_args );
			
		} else {
			//load lost password template
			wps_deals_get_template( 'my-account/lost-password.php' );
		}
	}
	
	if( !function_exists( 'deals_content' ) ) {
		
		/**
		 * Output Deals content.
		 * 
		 * This function is only used in the optional 'deals-engine.php' template
		 * which people can add to their themes to add basic deals support
		 * without hooks or modifying core templates.
		 * 
		 * @package Social Deals Engine
		 * @since 2.0.6
		 **/
		function deals_content() {
			
			global $wps_deals_options;
			
			// get deal size
			$deal_size = $wps_deals_options['deals_size_archive'];
			
			if ( is_single() && get_post_type() == WPS_DEALS_POST_TYPE ) {
				
				//do_action( 'wps_deals_before_main_content' );
				do_action( 'wps_deals_theme_before_main_content' );
				
				if ( have_posts() ) {
					
					while ( have_posts() ) {
						
						the_post();
						wps_deals_get_template( 'content-single-deal.php' );
						comments_template( '', true );
						
					}
				}
				
				//do_action( 'wps_deals_after_main_content' );
			} elseif ( is_post_type_archive( WPS_DEALS_POST_TYPE ) || is_tax( WPS_DEALS_POST_TAXONOMY ) || is_tax( WPS_DEALS_POST_TAGS ) ) {
				
				if( apply_filters( 'wps_deals_show_page_title', true ) ) {
					echo '<h1 class="page-title">'. wps_deals_page_title().'</h1>';
				}
				
				echo '<div class="deals-archive '. $deal_size.' deals-row">';
				
				do_action( 'wps_deals_theme_before_main_content' );
				
				do_action( 'wps_deals_archive_description' );
					
				do_action( 'wps_deals_archive_deals' );
					
				echo '</div>';
			}
		}
	}
}

?>