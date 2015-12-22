<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'widgets_init', 'wps_deals_lists_widget' );

/**
 * Register the Reviews Widget
 *
 * @package Social Deals Engine
 * @since 1.0.
 */
function wps_deals_lists_widget() {
	register_widget( 'Wps_Deals_Lists' );
}

/**
 * Wps_Fbre_Reviews Widget Class.
 *
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update for displaying submitted reviews.
 *
 * @package Social Deals Engine
 * @since 1.0.
 */
class Wps_Deals_Lists extends WP_Widget {

	public $model,$render,$currency;

	/**
	 * Widget setup.
	 */
	function __construct() {
	
		global $wps_deals_model,$wps_deals_render,$wps_deals_currency,$wps_deals_price;
		
		$this->model = $wps_deals_model;
		$this->render = $wps_deals_render;
		$this->currency = $wps_deals_currency;
		$this->price = $wps_deals_price;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wps-deals-lists', 'description' => __( 'A Social Deals widget, which lets you display a list of active Deals.', 'wpsdeals' ) );

		/* Create the widget. */
		//$this->WP_Widget( 'wps-deals-lists', __( 'Deals Engine - Active Deals', 'wpsdeals' ), $widget_ops );
		WP_Widget::__construct( 'wps-deals-lists', __( 'Deals Engine - Active Deals', 'wpsdeals' ), $widget_ops );	
	}
	
	/**
	 * Outputs the content of the widget
	 */
	function widget( $args, $instance ) {
	
		global $post,$wps_deals_options;
			
		extract( $args );
		
		$prefix = WPS_DEALS_META_PREFIX;
		
		// deals main page
		$dealspage = $wps_deals_options['deals_main_page'];
		
		// current date and time
		$today = wps_deals_current_date( 'Y-m-d H:i:s' );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$limit = $instance['limit'];
		$disable_timer = $instance['disable_timer'];
		$deal_size = isset( $instance['deal_size'] ) ? esc_attr( $instance['deal_size'] ) : 'medium';
		$deal_ids = isset( $instance['deal_ids'] ) && !empty( $instance['deal_ids'] ) ? explode( ',', $instance['deal_ids'] ) : array();
		
		// get the color scheme from the settings
		$button_color = $wps_deals_options['deals_btn_color'];
		$btncolor = ( isset( $button_color ) && !empty( $button_color ) ) ? $button_color : 'blue';
		
		// all active deals
		$dealsmetaquery = array( 								
								array(		
										'key' => $prefix . 'start_date',
										'value' => $today,
										'compare' => '<=',
										'type' => 'STRING'
									),
								array(
										'key' => $prefix . 'end_date',
										'value' => $today,
										'compare' => '>=',
										'type' => 'STRING'
									)
								);
								
		//$this_post = $post->ID;
		$this_post = isset($post->ID) ? $post->ID : '';
		$argswidget = array( 'post_type' => WPS_DEALS_POST_TYPE, 'post_status' => '', 'posts_per_page' => $limit, 'meta_query' => $dealsmetaquery, 'orderby' => 'rand' );
		if( !empty( $deal_ids ) ) {
			$argswidget['post__in'] = $deal_ids;
		} else {
			$argswidget['post__not_in'] = array( $this_post );
		}
		
		$loop = null;
		$loop = new WP_Query();
		$loop->query( $argswidget );
		
		$html = '';
		
		if( $loop->have_posts() ) {
        	
        	echo $before_widget;
        
        	$html .= '<div class="deals-row deals-clearfix">';
			
			$html .= '<div class="deals-widget ' . $deal_size . ' deals-col-12">';
        	
    	   	if( $title ) {
				
				$alldeals = '<div class="deals-after-title"><a href="' . get_permalink( $dealspage ) . '">' . __( 'See All','wpsdeals' ) . '</a></div>';
				
	            echo $before_title . $title . $alldeals . $after_title;
    	   	}
    	   	
        	while( $loop->have_posts() ) : $loop->the_post();
		
				// get the value of image url from the post meta box
				//$imgurl = get_post_meta($post->ID,$prefix.'main_image',true);
				
				// get the deal main image
				$imgurl = get_post_meta( $post->ID, $prefix . 'main_image', true );
				
				// add filter to change deal main image of deal by third party plugin
				$imgurl['src'] = apply_filters( 'wps_deals_main_image_src', $imgurl['src'], $post->ID );
		
				// no image
				$imgsrc = isset( $imgurl['src'] ) && !empty( $imgurl['src'] ) ? $imgurl['src'] : apply_filters( 'wps_deals_default_img_src', WPS_DEALS_URL.'includes/images/deals-no-image-big.jpg' );
				
				// get the normal price
				$normalprice = get_post_meta( $post->ID, $prefix . 'normal_price', true );
				
				// get the sales price
				$saleprice = get_post_meta( $post->ID, $prefix . 'sale_price', true );
				
				// get the start date & time
				$startdate = get_post_meta( $post->ID, $prefix . 'start_date', true );
				
				// getthe end date and time
				$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );
				
				// check that the start or end date ar not empty
				if( !empty( $startdate ) || !empty( $enddate ) ) { 
					// check if the start date is in the future
					if( $startdate >= $today ) {
						$counterdate = $startdate;
					} else {
						$counterdate = $enddate;
					}
				}
				
				// calculate saving price
				$yousave = $this->price->wps_deals_get_savingprice( $post->ID );
				
				// get the display price
				$price = $this->price->wps_deals_get_price( $post->ID );
				
				// get the product price 
				$productprice = $this->price->get_display_price( $price, $post->ID );
				
				// get the discount 
				$discount = $this->price->wps_deals_get_discount( $post->ID );
				
				// beginning of the single widget content
		        $html .= '<div class="deals-more-content">';
		        
		        if(!empty($discount) && $discount != '0%') {
			        // discount box			
					$html .=' 	<div class="deals-more-discount-box">	
									<p class="deals-more-discount">
										<span>
											 -&nbsp;' . $discount . '
										</span>
									</p>									
								</div>';
		        }
				// deal image					
				$html .='	<div class="deals-more-content-img">
								<a href="' . get_permalink( $post->ID ) . '" title="' . strip_tags( get_the_title( $post->ID ) ) . '" >
									<img src="' . $imgsrc . '" width="100%" alt="' . strip_tags( get_the_title( $post->ID ) ) . '" />
								</a>
							</div>';
							
				// deal timer
				if( empty( $disable_timer ) ) {
				
					// enqueue the timer
					wp_enqueue_script( 'wps-deals-countdown-timer-scripts' );
				
					$endyear = date( 'Y', strtotime( $counterdate ) );
					$endmonth = date( 'm', strtotime( $counterdate ) );
					$endday = date( 'd', strtotime( $counterdate ) );
					$endhours = date( 'H', strtotime( $counterdate ) );
					$endminute = date( 'i', strtotime( $counterdate ) );
					$endseconds = date( 's', strtotime( $counterdate ) );
						
					$html .= '		<div class="deals-timing deals-timer-home-list deals-end-timer" 
											timer-year="' . $endyear . '"
											timer-month="' . $endmonth . '"
											timer-day="' . $endday . '"
											timer-hours="' . $endhours . '"
											timer-minute="' . $endminute . '"
											timer-second="' . $endseconds . '">
											<span class="timer-icon"></span>
									</div>';					
				}			
							
				// deal title
				$html .= '	<h3 class="deals-more-title">
								' . get_the_title( $post->ID ) . '						
							</h3>';		

				if ( $normalprice !== '' || $price !== '' ) {

					// deal price
					$html .= '	<div class="deals-more-price-box">
									<p class="deals-more-price">
										<del>
											' . $this->price->get_display_price( $normalprice, $post->ID ) . '
										</del>	
									</p>
									<p class="deals-more-price-special">
										<span>
											' . $productprice . '
										</span>
									</p>									
								</div>';													
				}

				// view deal button
				$html .= '	<div class="' . $btncolor . ' deals-button btn-small">
								<a href="' . get_permalink( $post->ID ) . '">	
									' . __( 'See Deal', 'wpsdeals' ) . '	
								</a>																		
							</div>'; 			
					
				$html .= '</div>'; // deals-more-content
				
			endwhile;
			
			$html .= '</div>'; // deals-widget-content
			
			$html .= '</div>'; // deals-row
			
			$cache = $html;
			echo $cache;
			
			echo $after_widget;
        }
	
		wp_reset_query();  
    }
	
	/**
	 * Updates the widget control options for the particular instance of the widget
	 */
	function update( $new_instance, $old_instance ) {
	
        $instance = $old_instance;
		
		// Set the instance to the new instance
		$instance = $new_instance;
		
		// Input fields
		$instance['title'] = strip_tags( $new_instance['title'] ); 
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['deal_ids'] = strip_tags( $new_instance['deal_ids'] );
		$instance['disable_timer'] = isset( $new_instance['disable_timer'] ) ? $new_instance['disable_timer'] : '';
		$instance['deal_size'] = strip_tags( $new_instance['deal_size'] );
		
        return $instance;
		
    }
	
	/*
	 * Displays the widget form in the admin panel
	 */
	function form( $instance ) {
	
		$defaults = array( 'title' => __( 'More Great Deals', 'wpsdeals' ), 'deal_ids' => '', 'limit' => '3', 'disable_price' => '', 'disable_timer' => '', 'deal_size' => 'medium' );
		
		$deal_size = isset( $instance['deal_size'] ) ? esc_attr( $instance['deal_size'] ) : 'medium';
		
        $instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wpsdeals'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'deal_ids' ); ?>"><?php _e( 'Deal Id(s):', 'wpsdeals' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'deal_ids' ); ?>" name="<?php echo $this->get_field_name( 'deal_ids' ); ?>" type="text" value="<?php echo $instance['deal_ids']; ?>" />
			<br /><span class="description wps-deals-widget-description"><?php _e( 'Enter the Deal id(s) comma(,) seperated.', 'wpsdeals' ); ?></span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'wpsdeals' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo $instance['limit']; ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'disable_timer' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'disable_timer' ); ?>" value="1" <?php checked( $instance['disable_timer'], '1', true ); ?> />
			<label for="<?php echo $this->get_field_id( 'disable_timer' ); ?>"><?php _e( 'Disable Timer', 'wpsdeals'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'deal_size' ); ?>"><?php _e( 'Size:', 'wpsdeals' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'deal_size' ); ?>" id="<?php echo $this->get_field_id( 'deal_size' ); ?>">
				<option value="small" <?php selected( 'small', $deal_size ); ?>><?php _e( 'Small', 'wpsdeals' ); ?></option>
				<option value="medium" <?php selected( 'medium', $deal_size ); ?>><?php _e( 'Theme', 'wpsdeals' ); ?></option>
			</select>
		</p>
		
		<?php
	}
}