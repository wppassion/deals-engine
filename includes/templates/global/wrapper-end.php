<?php

/**
 * Content Wrappers End
 *
 * Override this template by copying it to yourtheme/deals-engine/global/wrapper-end.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '</div></div>';
		break;
	case 'twentythirteen' :
		echo '</div></div>';
		break;
	case 'twentyfourteen' :
		echo '</div></div></div>';
		get_sidebar( 'content' );
		break;
	case 'twentyfifteen' :
		echo '</div></article></main></div>';
		break;
	case 'superstore' :
		echo '</div></div></div>';
		add_action( 'wps_deals_after_sidebar', 'sde_after_sidebar_content', 10 );
		break;
	default :
		echo '</div></div>';
		break;
}

function sde_after_sidebar_content() {
	echo '</div>';
}