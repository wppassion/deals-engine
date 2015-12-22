<?php 

/**
 * Empty Cart Message Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/notices/empty-cart.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-empty-cart">
	<?php if( $undo ) {
		echo '<div class="deals-cart-success deals-message deals-success" style="display:block">'.
				'<span> ' . sprintf( __( '%s removed. %sUndo?%s', 'wpsdeals' ), get_the_title( $dealid ), '<a href="' . esc_url( $undo_url ) . '">', '</a>') . '</span>'.
			'</div>';
	}
	?>
	<div class="deals-message deals-error empty-cart-msg">
		<span><?php echo apply_filters( 'wps_deals_empty_cart_message', __( 'Your cart is empty.', 'wpsdeals' ) ); ?></span>
	</div>
	<?php if( $deals_shop_url ) { ?>
		<a href="<?php echo esc_url($deals_shop_url); ?>" class="deals-shop deals-button btn-deals-shop">
			&larr;  <?php echo apply_filters( 'wps_deals_shop_text', __( 'Deals Shop', 'wpsdeals' ) ); ?> 
		</a> <?php
	} ?>
</div>