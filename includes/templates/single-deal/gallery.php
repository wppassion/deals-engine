<?php 

/**
 * Image Template
 * 
 * Override this template by copying it to <ourtheme/deals-engine/includes/templates/single-deal/gallery.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$deal_gallery_ids = !empty($deal_gallery_ids) ? $deal_gallery_ids : '' ;

if( !empty($deal_gallery_ids) ) { ?>

	<div class="deals-single-gallery-image">
		<ul>
			<?php foreach ( $deal_gallery_ids as $deal_gallery_id ){
				$classes = array( 'zoom' );
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title 	= 	esc_attr( get_the_title( $deal_gallery_id ) );
				$image_link		=	wp_get_attachment_url( $deal_gallery_id );
				$image			=	wp_get_attachment_image( $deal_gallery_id, 'shop_thumbnail' );
				
				echo '<li class="deals-gallery-image">
						<a class="'. $image_class .'"  href="'.$image_link.'" rel="prettyPhoto[deals-gallery]" title="'.$image_title.'">
							' . $image . '
					 	</a>
					 </li>';
					
			} ?>
		</ul>
	</div>

<?php } ?>