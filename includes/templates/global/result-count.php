<?php

/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * Override this template by copying it to yourtheme/deals-engine/global/result-count.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

$loop = null;
$loop = new WP_Query();
$loop->query( $args );

?>

<p class="deals-result-count deals-col-6">
	<?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $loop->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

	if ( 1 == $total ) {
		_e( 'Showing the single result', 'wpsdeals' );
	} elseif ( $total <= $per_page || -1 == $per_page ) {
		printf( __( 'Showing all %d results', 'wpsdeals' ), $total );
	} else {
		printf( _x( 'Showing %1$d–%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'wpsdeals' ), $first, $last, $total );
	}
	?>
</p>