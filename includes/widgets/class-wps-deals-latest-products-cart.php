<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'widgets_init', 'wps_deals_latest_prodcuts_cart_widget' );

/**
 * Register the Reviews Widget
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_latest_prodcuts_cart_widget() {

	register_widget( 'SDE_Deals_Widget_Cart' );
}

/**
 * SDE_Deals_Widget_Cart Widget Class.
 *
 * This class handles everything that needs to be handled with the widget:
 * to display the latest Deals added to the shopping cart
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
class SDE_Deals_Widget_Cart extends WP_Widget {

	public $render, $cart;

	/**
	 * Widget setup.
	 */
	function __construct() {
	
		global $wps_deals_render, $wps_deals_cart;
		
		$this->render = $wps_deals_render;
		$this->cart = $wps_deals_cart;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'deals-widget-shopping-cart', 'description' => __( 'Display the user\'s Cart in the sidebar.', 'wpsdeals' ) );

		/* Create the widget. */
		//$this->WP_Widget( 'wps-deals-latest-products-cart', __( 'Deals Engine - Cart', 'wpsdeals' ), $widget_ops );
		WP_Widget::__construct( 'wps-deals-latest-products-cart', __( 'Deals Engine - Cart', 'wpsdeals' ), $widget_ops );
	
	}
	
	/**
	 * Outputs the content of the widget
	 */
	function widget( $args, $instance ) {
	
		global $wpdb,$post,$wps_deals_options;
		
		extract( $args );
		
		$hide_empty_cart = $instance['hide_empty_carrt'];
		$cartdata = $this->cart->get();
		$cartproducts = $cartdata['products'];
		
		$html = '';
		
		if( empty( $cartproducts ) && $hide_empty_cart ) {
			$wrapper_class = 'deals-cart-widget deals-hide';
		} else {
			$wrapper_class = 'deals-cart-widget deals-show';
		}
		
		echo '<div class="' . $wrapper_class . '">';
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		//limit to show orders
		//$limit = $instance['limit'];
		
		if( $post->ID != $wps_deals_options['payment_checkout_page'] )  { 
		
			echo $before_widget;
			
			if ( $title )
				echo $before_title . $title . $after_title;
				
				$html .= '<div class="deals-row deals-clearfix">';
			
				$html .= '<div id="deals-cart-widget" class="deals-widget deals-col-12">';
				
				$html .= $this->render->wps_deals_cart_widget_content();
				
				$html .= '</div>';
				
				$html .= '</div>';
				
			echo $html;
	    	echo $after_widget;
		}
		
		echo '</div>';	    
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
		$instance['hide_empty_carrt'] = isset( $new_instance['hide_empty_carrt'] ) ? $new_instance['hide_empty_carrt'] : '';
		
        return $instance;
		
    }
	
	/*
	 * Displays the widget form in the admin panel
	 */
	function form( $instance ) {
	
		$defaults = array( 'title' => __( 'Cart', 'wpsdeals' ), 'hide_empty_carrt' => '' );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wpsdeals'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'hide_empty_carrt' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'hide_empty_carrt' ); ?>" value="1" <?php checked( $instance['hide_empty_carrt'], '1', true ); ?> />
			<label for="<?php echo $this->get_field_id( 'hide_empty_carrt' ); ?>"><?php _e( 'Hide empty cart', 'wpsdeals'); ?></label>
		</p>
		<?php /*<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'wpsdeals'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo $instance['limit']; ?>" />
		</p>*/?>

		<?php
	}
}