<?php

/**
 * Ordering template, used on the Deals home page and Deals archives.
 * 
 * Override this template by copying it to yourtheme/deals-engine/global/orderby.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-ordering deals-col-12">

	<form class="deals-ordering-form deals-right" method="get" action="">
	
		<select name="dealsorderby" class="deals-orderby">
			<?php
				$catalog_orderby = apply_filters( 'wps_deals_catalog_orderby', array(
					'menu_order' => __( 'Default sorting', 'wpsdeals' ),
					'popularity' => __( 'Sort by popularity', 'wpsdeals' ),
					'rating'     => __( 'Sort by average rating', 'wpsdeals' ),
					'date'       => __( 'Sort by newness', 'wpsdeals' ),
					'price'      => __( 'Sort by price: low to high', 'wpsdeals' ),
					'price-desc' => __( 'Sort by price: high to low', 'wpsdeals' )
				) );
				
				$default_orderby = apply_filters( 'wps_deals_catalog_orderby', array(
											'date-asc' => __( 'Sort by date (asc)', 'wpsdeals' ),
											'date-desc' => __( 'Sort by date (desc)', 'wpsdeals' ),
											'price-asc' => __( 'Sort by price: low to high', 'wpsdeals' ),
											'price-desc' => __( 'Sort by price: high to low', 'wpsdeals' )
										) );
				
				foreach ( $default_orderby as $id => $name ) {
					echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
				}
				
			?>
		</select>
		
		<?php
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				//check key is dealorderby
				if ( 'dealsorderby' == $key ) continue;
				//check if $_GET is array
				if ( is_array( $val ) ) {
					//foreach loop for making hidden for form fields when it is array
					foreach( $val as $innerVal ) {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
					} //end foreach loop
				} else {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
				}
			} //end foreach for $_GET
		?>
		
	</form>
	
</div>